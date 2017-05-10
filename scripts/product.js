function Product(args, cartDOM) {
    this.totalPrice = 0;
    this.cartDOM = cartDOM;
    this.name = args.name;
    this.price = Number(args.price);
    this.fileName = args.file_name;
    this.altText = args.alt_text;
    this.description = args.description;
    this.uuid = args.uuid;

    this.catalogPriceDOM = $('<h6 class="text-warning">');
    this.cartPriceDOM = $('<h6 class="text-warning>').text('$ ' + this.price.toFixed(2));
    this.cartPriceTotalDOM = $('<h5 class="text-warning">');
    this.cartCountDOM = $('<p>');
    this.cartNameDOM = $('<h6>').text(this.name);

    this.setCount = function (count) {
        var piece_s;
        if (count > 1) {
            piece_s = ' pieces: ';
        } else {
            piece_s = ' piece: ';
        }
        this.cartCountDOM.text(count + piece_s);
        this.totalPrice = this.price * count;
        this.cartPriceTotalDOM.text('$ ' + this.totalPrice.toFixed(2));
    };


    this.catalogItem = function () {
        var self = this;
        var dom = $('<div class="card">');
        dom.append($('<img class="card-img-top img-fluid">').attr('src', this.fileName).attr('alt', this.altText));
        dom.append(
            $('<div class="card-block">').append(
                $('<h4 class="card-title">').text(this.name)
            ).append(
                $('<div class="row">').append(
                    $('<div class="col-md-12 col-lg-6 col-xl-7">')
                        .append($('<h5 class="text-warning">').text('$ ' + this.price.toFixed(2)))
                        .append($('<a>').attr('href', '#').text('Details >'))
                ).append(
                    $('<div class="col-md-12 col-lg-6 col-xl-5">')
                        .append($('<button class="btn btn-block btn-success">').text('Add').click(
                            function () {
                                var count = addProductToCart(self.uuid);
                                if (count === 1) {
                                    self.cartDOM.append(self.cartItem());
                                }
                                self.setCount(count);
                                updateTotalPrice();
                            }
                        ))
                )));
        return dom;

    };

    this.cartItem = function () {
        var self = this;
        var dom = $('<div class="card mb-3">');
        dom.append($('<div class="row">').append(
            $('<div class="col-md-4 pr-0">')
                .append($('<img class="card-img-left img-fluid">')
                    .attr('src', this.fileName).attr('alt', this.altText))
            ).append(
            $('<div class="col-md-8 pl-0">').append($('<div class="card-block py-0">').append(
                $('<ul class="list-group list-group-flush">')
                    .append($('<li class="list-group-item row p-0">')
                        .append($('<div class="col-md-6">')
                            .append(this.cartNameDOM))
                        .append($('<div class="col-md-6">')
                            .append($('<h6 class="text-warning">')
                                .text('$ ' + this.price.toFixed(2))))
                    )
                    .append($('<li class="list-group-item row p-0">')
                        .append($('<div class="col-md-6">').append(this.cartCountDOM))
                    ))
            ).append($('<div class="card-block row py-0">')
                .append($('<div class="col-md-3">')
                    .append($('<button class="btn btn-success">+</button>').click(function () {
                            var count = addProductToCart(self.uuid);
                            self.setCount(count);
                            updateTotalPrice();
                        })
                    )
                ).append($('<div class="col-md-6 text-center">').append(
                    this.cartPriceTotalDOM
                ))
                .append($('<div class="col-md-3">')
                    .append($('<button class="btn btn-danger">-</button>').click(function () {
                            var count = removeProductFromChart(self.uuid);
                            self.setCount(count);
                            updateTotalPrice();
                        if (count < 1) {
                                dom.remove();
                            } else {
                            }
                        })
                    )
                )
            )
            )
        );

        return dom;
    };
}
var catalogItems = [];
function updateTotalPrice() {
    var total = 0;
    for (product in catalogItems) {
        if (catalogItems.hasOwnProperty(product)) {
            total += catalogItems[product].totalPrice;
        }
    }
    console.log(total);
    $('#total-price').text('$ '+total.toFixed(2));
}


$(document).ready(function () {

    var catalogDOM = $('#product-catalog');
    var cartDOM = $('#product-cart-items');
    $.getJSON('getProducts.php', function (items) {
        items.forEach(function (item) {
            var product = new Product(item, cartDOM);
            catalogItems.push(product);
            catalogDOM.append(product.catalogItem());
            var productInCartCount = getProductInCartCount(product.uuid);
            if (productInCartCount > 0) {
                product.setCount(productInCartCount);
                cartDOM.append(product.cartItem());
            }
        });
        updateTotalPrice();
    });

});


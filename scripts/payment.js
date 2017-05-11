/**
 * Created by niki on 10.05.17.
 */
$.validator.setDefaults({
    errorElement: "div",
    errorClass: "form-control-feedback",
    highlight: function (element, errorClass, validClass) {
        $(element).closest('.form-group').addClass('has-warning');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).closest('.form-group').removeClass('has-warning');
    },
    errorPlacement: function (error, element) {
        if (element.parent('.input-group').length || element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
});

function getPickedProductNames() {
    var products = [];
    for (item in catalogItems) {
        if (catalogItems.hasOwnProperty(item)) {
            productCount = getProductInCartCount(catalogItems[item].uuid);
            if (productCount > 0) {
                products.push(catalogItems[item].name);
            }
        }
    }
    return products;
}
function emptyChart() {
    var products = {};
    for (item in catalogItems) {
        if (catalogItems.hasOwnProperty(item)) {
            productCount = getProductInCartCount(catalogItems[item].uuid);
            if (productCount > 0) {
                localStorage.removeItem(catalogItems[item].uuid);
                catalogItems[item].cartDOM.remove();
            }
        }
    }
    return products;
}
function getPickedProducts() {
    var products = {};
    for (item in catalogItems) {
        if (catalogItems.hasOwnProperty(item)) {
            productCount = getProductInCartCount(catalogItems[item].uuid);
            if (productCount > 0) {
                products[catalogItems[item].uuid] = productCount;
            }
        }
    }
    return products;
}
function showMessage(message, className) {
    var mainDOM = $('#message-box');
    mainDOM.empty();
    var columnDom = $('<div class="col-md-12 order_message">');
    var messageBoxDOM = $('<div class="alert" id="alert_message">').appendTo(columnDom);
    messageBoxDOM.addClass(className);
    var messageTextDOM = $('<p>').appendTo(messageBoxDOM);
    if (typeof message === 'string') {
        messageTextDOM.text(message);
    } else {
        messageBoxDOM.append(message);
    }
    mainDOM.append(columnDom);
}

function generateSuccessMessage() {
    var today = new Date();
    var tomorrow = new Date(today.getTime() + (24 * 60 * 60 * 1000));

    var mainDOM = $('<div>');
    $('<p>').text("Dear Mr/Mrs " +
        $('#first_name').val() +" "+ $('#last_name').val()).appendTo(mainDOM);
    $('<br>').appendTo(mainDOM);

    $('<p>').text(
        "Thank you for purchasing the " +
        getPickedProductNames().join(', the ') +
        ". You will be pleased to know that it will be delivered to the confirmed address " +
        $('#address').val() +
        " on " +
        tomorrow +
        " ready for your celebration.").appendTo(mainDOM);
    $('<br>').appendTo(mainDOM);

    $('<p>').text("Kind regards,").appendTo(mainDOM);
    $('<br>').appendTo(mainDOM);

    $('<p>').text("Your Selling Team").appendTo(mainDOM);
    return mainDOM;
}



function submitResults() {
    $.ajax({
        url: 'buyProducts.php',
        dataType: 'json',
        type: 'post',
        contentType: 'application/json',
        data: JSON.stringify({
            'products': getPickedProducts(),
            'firstName': $('#first_name').val(),
            'lastName': $('#last_name').val(),
            'eMail': $('#e_mail').val(),
            'address': $('#address').val(),
            'creditCardNumber': $('#card_number').val()
        }),
        processData: false,
        statusCode: {
            500: function (response) {
                // for 400 responses the data is contained within the responseJSON property.
                var message = response.responseJSON.message;
                showMessage(message, 'alert-danger');

            },

            400: function (response) {
                // for 400 responses the data is contained within the responseJSON property.
                var message = response.responseJSON.message;
                showMessage(message, 'alert-danger');

            },
            409: function (response) {
                // for 400 responses the data is contained within the responseJSON property.
                var message = response.responseJSON.message;
                showMessage(message, 'alert-danger');


            },
            410: function (response) {
                // for 2XX responses the data is contained right in the object.
                var message = response.responseJSON.message;
                showMessage(message, 'alert-warning');
                setTimeout("location.href = 'index.php';",5000);
            },
            201: function (response) {
                // for 2XX responses the data is contained right in the object.
                var message = generateSuccessMessage();
                showMessage(message, 'alert-success');
                emptyChart();
            }
        }
    });
}


$(document).ready(function(){
    $('#payment-form').validate({
        messages: {
            first_name: "Please enter your First Name.",
            last_name: "Please enter your Last Name.",
            e_mail: "Please enter your E-mail address.",
            address: "Please enter the delivery address.",
            card_number: "Please supply a valid credit card number."
        },
        submitHandler: submitResults
    }).submit(function (event) {
        event.preventDefault();
    });
});



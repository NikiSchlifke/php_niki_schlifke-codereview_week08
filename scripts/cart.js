function addProductToCart(uuid) {
    var itemCount = getProductInCartCount(uuid);
    itemCount++;
    localStorage.setItem(uuid, itemCount);
    return itemCount;
}

function getProductInCartCount(uuid) {
    var itemCount = 0;
    if (localStorage.hasOwnProperty(uuid)) {
        itemCount = localStorage.getItem(uuid);
    }
    return itemCount;
}

function removeProductFromChart(uuid) {
    var itemCount = getProductInCartCount(uuid);
    itemCount--;
    if (itemCount < 1 )  {
        localStorage.removeItem(uuid);
        return 0;
    }
    localStorage.setItem(uuid, itemCount);
    return itemCount;
}


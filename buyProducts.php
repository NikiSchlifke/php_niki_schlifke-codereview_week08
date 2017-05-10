<?php
require_once 'initdb.php';
require_once 'includes/apiHelpers.php';




if (isset($_POST)) {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        if (
            !isset($data['products']) ||
            !isset($data['email']) ||
            !isset($data['firstName']) ||
            !isset($data['lastName']) ||
            !isset($data['address']) ||
            !isset($data['creditCartNumber'])
        ) { showError(400, 'Missing Input'); }

        $products = array_unique($data['products']);
        $email = $data['email'];
        $firstName = $data['firstName'];
        $lastName = $data['lastName'];
        $address = $data['address'];
        $creditCardNumber = $data['creditCartNumber'];

        $addressId = getFirstOrAddRecord($getAddressSQL, $addAddressSQL, [
            'street' => $address,
            'regionId' => 1
        ]);

        $customerId = getFirstOrAddRecord($getCustomerSQL, $addCustomerSQL, [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'addressId' => $addressId
        ]);

        $userId = getFirstOrAddRecord($getUserSQL, $addUserSQL, [
            'eMail' => $email
        ], [
            'eMail' => $email,
            'password' => 'none'
        ]);

        $cartId = addRecord($addCartSQL, [
            'customerId' => $customerId
        ]);

        $billId = addRecord($addBillSQL, [
            'creditCardNumber' => $creditCardNumber,
            'cartId' => $cartId
        ]);

        foreach ($products as $productUUID => $productCount) {

            $productId = getFirstRecord($selectProductSQL, [
                'uuid' => $productUUID
            ]);
            $cartCompositionId = addRecord($addCartCompositionSQL, [
                'productId' => $productId,
                'productCount' => $productCount,
                'cartId' => $cartId
            ]);
        }



        echo json_encode(['status' => 'ok', 'message' => 'Product purchased successfully.']);

        http_response_code(201);
        exit();
    } catch (\UnexpectedValueException $exception) {
        showError(400, 'Database error: '.$exception->getMessage());
    }
}
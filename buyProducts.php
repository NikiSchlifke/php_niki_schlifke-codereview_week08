<?php
require_once 'initdb.php';
require_once 'includes/apiHelpers.php';




if (isset($_POST)) {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        error_log(json_encode($data));
        if (
            !isset($data['products']) ||
            !isset($data['eMail']) ||
            !isset($data['firstName']) ||
            !isset($data['lastName']) ||
            !isset($data['address']) ||
            !isset($data['creditCardNumber'])
        ) { showError(400, 'Missing Input'); }

        $products = $data['products'];
        $eMail = $data['eMail'];
        $firstName = $data['firstName'];
        $lastName = $data['lastName'];
        $address = $data['address'];
        $creditCardNumber = $data['creditCardNumber'];

        $addressId = getFirstOrAddRecord($getAddressSQL, $addAddressSQL, [
            ':street' => $address,
            ':regionId' => 1
        ]);

        $customerId = getFirstOrAddRecord($getCustomerSQL, $addCustomerSQL, [
            ':firstName' => $firstName,
            ':lastName' => $lastName,
            ':addressId' => $addressId
        ]);

        $userId = getFirstOrAddRecord($getUserSQL, $addUserSQL, [
            ':eMail' => $eMail
        ], [
            ':eMail' => $eMail,
            ':password' => 'none',
            ':customerId' => $customerId
        ]);

        $cartId = addRecord($addCartSQL, [
            ':customerId' => $customerId
        ]);

        $billId = addRecord($addBillSQL, [
            ':creditCardNumber' => $creditCardNumber,
            ':cartId' => $cartId
        ]);
        foreach ($products as $productUUID => $productCount) {
            $productId = getFirstRecord($selectProductSQL, [
                ':uuid' => $productUUID
            ]);
            error_log("User $userId buys product $productId ($productUUID)");

            $cartCompositionId = addRecord($addCartCompositionSQL, [
                ':productId' => $productId,
                ':productCount' => $productCount,
                ':cartId' => $cartId
            ]);
        }



        echo json_encode(['status' => 'ok', 'message' => 'Product purchased successfully.']);

        http_response_code(201);
        exit();
    } catch (\UnexpectedValueException $exception) {
        showError(400, 'Database error: '.$exception->getMessage());
    }
}
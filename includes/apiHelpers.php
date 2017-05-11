<?php
header('Content-Type: application/json');

function showError($httpCode, $message) {
    global $dbh;
    http_response_code($httpCode);
    echo json_encode(['status' => 'error', 'message' => $message.json_encode($dbh->errorInfo())]);
    exit();
}

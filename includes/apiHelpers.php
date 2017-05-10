<?php
header('Content-Type: application/json');

function showError($httpCode, $message) {
    global $con;
    http_response_code($httpCode);
    echo json_encode(['status' => 'error', 'message' => $message, 'dberror' => $con->error]);
    exit();
}

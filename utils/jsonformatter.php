<?php 

//  create global function for json response
function json_response($data, $status = 200) {
    header('Content-Type: application/json');
    http_response_code($status);
    $data = [
        'status_code' => $status,
        'data' => $data
    ];
    echo json_encode($data);
    exit;
}
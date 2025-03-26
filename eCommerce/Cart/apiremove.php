<?php
$data = json_decode(file_get_contents("php://input"), true);
http_response_code(200);
echo json_encode(["message" => "Item removed"]);

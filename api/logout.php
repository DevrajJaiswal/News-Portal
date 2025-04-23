<?php
session_start();

include "../admin/config.php";
header("Content-Type: application/json");

$logout = session_unset();

if ($logout) {
    echo json_encode([
        "status" => 200,
        "message" => "User Logout Successfully!"
    ]);
} else {
    echo json_encode([
        "status" => 401,
        "message" => "Something went wrong!"
    ]);
}
?>
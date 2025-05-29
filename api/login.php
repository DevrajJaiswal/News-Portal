<?php
session_start();
include "../admin/config.php";
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$error = [];
if (!isset($data['username']) || empty($data['username'])) {
    $error[] = "Username required!";
}

if (!isset($data['password']) || empty($data['password'])) {
    $error[] = "Password required!";
}

if (count($error) == 0) {
    $username = mysqli_real_escape_string($conn, $data['username']);
    $password = md5($data['password']);
    $sql = "select * from user where username='{$username}' and password ='{$password}'";

    $result = mysqli_query($conn, $sql) or die("Query Failed");

    if (mysqli_num_rows($result) > 0) {
        
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['firstname'] = $row['first_name'];
        $_SESSION['lastname'] = $row['last_name'];
        $_SESSION['role'] = $row['role'];

        echo json_encode([
            "status" => 200,
            "message" => "User Authentication Successfully!"
        ]);
    } else {
        // echo "<div class='alert alert-danger'> Username or Password wrong!</div>";
        echo json_encode([
            "status" => 400,
            "message" => "Username or Password wrong!"
        ]);
    }
} else {
    echo json_encode([
        "status" => 400,
        "error" => $error,
        "message" => "User Authentication failed!"
    ]);
}
?>
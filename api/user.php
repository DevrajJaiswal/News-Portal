<?php
include "../admin/config.php";
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["action"]) || empty($data["action"])) {
    echo json_encode([
        "status" => 404,
        "message" => "Action(get_user / add_user / update_user / delete_user) is required!"
    ]);
    exit;
} else {
    $action = $data["action"];

    // Get Users start
    if ($action == "get_users") {
        $page_limit = 2;

        if (isset($data['page'])) {
            $page = $data['page'];
        } else {
            $page = 1;
        }

        $offset = ($page - 1) * $page_limit;

        $sql1 = "select user_id, first_name, last_name, username, role from user order by user_id desc limit {$offset},{$page_limit}";
        $result = mysqli_query($conn, $sql1) or die('query failed');

        if (mysqli_num_rows($result) > 0) {

            $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        // Finding total users for pagination
        $sql2 = "select * from user";
        $result = mysqli_query($conn, $sql2);
        $total_users = mysqli_num_rows($result);

        if ($total_users > 0) {
            echo json_encode([
                "status" => 200,
                "users" => $users,
                "total_users" => $total_users,
                "page_limit" => $page_limit,
                "message" => "User found Successfully!"
            ]);
        } else {
            echo json_encode([
                "status" => 404,
                "message" => "No User found!"
            ]);
        }
    }
    // Get Users end

    // Delete Users start
    if ($action == "delete_user") {
        $user_id = $data["userId"];

        $sql1 = "DELETE FROM user WHERE user_id = '{$user_id}' LIMIT 1;";
        if (mysqli_query($conn, $sql1)) {
            echo json_encode([
                "status" => 200,
                "message" => "User deleted Successfully!"
            ]);
        } else {
            echo json_encode([
                "status" => 404,
                "message" => "User not deleted Successfully!"
            ]);
        }
    }
    // Delete Users end
}
?>
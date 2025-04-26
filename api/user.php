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

    switch ($action) {
        case "add_user":

            if (isset($data['userInfo']) && !empty($data['userInfo'])) {

                if (!is_array($data['userInfo'])) {
                    echo json_encode([
                        "status" => 404,
                        "message" => "Invalid format: user Information must be an object"
                    ]);
                    exit;
                }

                $fname = mysqli_real_escape_string($conn, $data['userInfo']['fName']);
                $lname = mysqli_real_escape_string($conn, $data['userInfo']['lName']);
                $user = mysqli_real_escape_string($conn, $data['userInfo']['userName']);
                $password = mysqli_real_escape_string($conn, md5($data['userInfo']['password']));
                $role = mysqli_real_escape_string($conn, $data['userInfo']['role']);

                if ($fname == '' || $lname == '' || $user == '' || $user == '' || $role == '') {
                    echo json_encode([
                        "status" => 404,
                        "message" => "Please provide user Information in json formate!"
                    ]);
                    exit;
                }
                $sql1 = "select username from user where username = '{$user}'";

                $result = mysqli_query($conn, $sql1) or die('query failed');

                if (mysqli_num_rows($result) > 0) {
                    echo json_encode([
                        "status" => 409,
                        "message" => "User name already Exist!"
                    ]);
                } else {

                    $sql2 = "insert into user(first_name, last_name, username, password, role) values('{$fname}','{$lname}','{$user}','{$password}','{$role}')";

                    if (mysqli_query($conn, $sql2)) {
                        echo json_encode([
                            "status" => 201,
                            "added user" => $data['userInfo'],
                            "message" => "User added Successfully!"
                        ]);
                    } else {
                        echo json_encode([
                            "status" => 404,
                            "message" => "Something went wrong!"
                        ]);
                    }
                }
            } else {
                echo json_encode([
                    "status" => 404,
                    "message" => "Please provide User Information!"
                ]);
            }
            break;
        case "edit_user":// Edit User start
            if (!isset($data["userId"]) || empty($data["userId"])) {
                echo json_encode([
                    "status" => 404,
                    "message" => "User ID is required!"
                ]);
                exit;
            }

            $user_id = $data["userId"];

            $sql = "select user_id, first_name, last_name, username, role from user where user_id={$user_id}";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($user = mysqli_fetch_assoc($result)) {
                    echo json_encode([
                        "status" => 200,
                        "user" => $user,
                        "message" => "User Fetched Successfully in form"
                    ]);
                }
            } else {
                echo json_encode([
                    "status" => 404,
                    "message" => "No User found associated with ID no. {$user_id}"
                ]);
            }
            // Edit User end
            break;
        case "update_user":

            if (isset($data['userInfo']) && !empty($data['userInfo'])) {

                if (!is_array($data['userInfo'])) {
                    echo json_encode([
                        "status" => 400,
                        "message" => "Invalid format: user Information must be an object"
                    ]);
                    exit;
                }

                $userId = mysqli_real_escape_string($conn, $data['userInfo']['userId']);
                $fname = mysqli_real_escape_string($conn, $data['userInfo']['fName']);
                $lname = mysqli_real_escape_string($conn, $data['userInfo']['lName']);
                $user = mysqli_real_escape_string($conn, $data['userInfo']['userName']);
                $role = mysqli_real_escape_string($conn, $data['userInfo']['role']);

                if ($userId == '' || $fname == '' || $lname == '' || $user == '' || $user == '' || $role == '') {
                    echo json_encode([
                        "status" => 404,
                        "message" => "Please provide user Information in json formate!"
                    ]);
                    exit;
                }

                $sql1 = "SELECT username FROM user WHERE username = '{$user}' AND user_id != {$userId}";

                $result = mysqli_query($conn, $sql1);

                if (mysqli_num_rows($result) > 0) {
                    echo json_encode([
                        "status" => 409,
                        "message" => "User name already Exist!"
                    ]);
                    exit;
                } else {

                    $sql2 = "update user set first_name= '{$fname}', last_name= '{$lname}', username='{$user}', role='{$role}' where user_id='{$userId}'";

                    if (mysqli_query($conn, $sql2)) {
                        echo json_encode([
                            "status" => 200,
                            "message" => "User Updated Successfully!"
                        ]);
                    } else {
                        echo json_encode([
                            "status" => 500,
                            "message" => "Server error!"
                        ]);
                    }
                }
            } else {
                echo json_encode([
                    "status" => 500,
                    "message" => "Please provide User Information!"
                ]);
            }
            break;
        case "delete_user": // Delete Users start
            if ($action == "delete_user") {
                if (!isset($data["userId"]) || empty($data["userId"])) {
                    echo json_encode([
                        "status" => 404,
                        "message" => "User ID is required!"
                    ]);
                    exit;
                }

                $user_id = $data["userId"];

                $sql1 = "DELETE FROM user WHERE user_id = '{$user_id}' LIMIT 1;";
                if (mysqli_query($conn, $sql1)) {
                    echo json_encode([
                        "status" => 200,
                        "message" => "User deleted Successfully!"
                    ]);
                } else {
                    echo json_encode([
                        "status" => 500,
                        "message" => "Server error!"
                    ]);
                }
            }
            // Delete Users end
            break;

        case "get_users":    // Get Users start
            $page_limit = 10;

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
            // Get Users end
            break;

        default:
            echo json_encode([
                "status" => 404,
                "message" => "Please provide valid Action(get_user / add_user / update_user / delete_user) is required!"
            ]);
    }
    // Get Users end


}
?>
<?php include "header.php";

if ($_SESSION['role']==0) {
    header("Location: {$hostname}/admin/post.php");
}

$user_id = $_GET['id'];
$sql1 = "delete from user where user_id='{$user_id}'";
$sql2 = "select * from user";
if (mysqli_query($conn, $sql1)) {
    echo 'test';
    $user_count = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($user_count) > 0) {
        header("Location: {$hostname}/admin/users.php");
    } else {
        header("Location: {$hostname}/admin/add-user.php");
    }
}

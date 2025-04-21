<?php
include "config.php";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);
    $sql = "select * from user where username='{$username}' and password ='{$password}'";

    $result = mysqli_query($conn, $sql) or die("Query Failed");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['firstname'] = $row['first_name'];
            $_SESSION['lastname'] = $row['last_name'];
            $_SESSION['role'] = $row['role'];

            header("Location: {$hostname}/admin/users.php");
        }
    } else {
        echo "<div class='alert alert-danger'> Username or Password wrong!</div>";
    }
}
?>
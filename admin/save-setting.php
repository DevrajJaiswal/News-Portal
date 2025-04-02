<?php
include "config.php";

if (empty($_FILES['logo']['name'])) {
    echo "file not uploaded";
    $file_name = $_POST['old-logo'];
} else {
    echo "file uploaded";
    $errors = array();

    $file_name = $_FILES['logo']['name'];
    $file_tmp = $_FILES['logo']['tmp_name'];
    $file_size = $_FILES['logo']['size'];
    $file_type = $_FILES['logo']['type'];
    $exp = explode('.', $file_name);
    $file_ext = end($exp);

    $extensions = array("jpeg", "jpg", "png", "avif");

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "This extension file not allowed, Please choose a JPG, Png or avif file";
    }

    if ($file_size > 2097152) {
        $errors[] = "File size must be 2mb or lower";
    }
    unlink("images/" . $_POST['old-logo']);
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/" . $file_name);
    } else {
        print_r($errors);
        die();
    }
}


$sql = "update setting set website_name='{$_POST['website_name']}', logo='{$file_name}', footer_desc='{$_POST['footer_desc']}'";

if (mysqli_multi_query($conn, $sql)) {
    header("location: {$hostname}/admin/post.php");
} else {
    echo "<div class='alert alert-danger'>Query Failed.</div>";
}


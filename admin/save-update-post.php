<?php

include "config.php";
if (empty($_FILES['new-image']['name'])) {
    $file_name = $_POST['old-image'];
} else {
    $errors = array();

    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $exp = explode('.', $file_name);
    $file_ext = end($exp);
    $extensions = array("jpeg", "jpg", "png", "avif");
    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "This extension file not allowed, Please choose a JPG, Png or avif file";
    }

    if ($file_size > 2097152) {
        $errors[] = "File size must be 2mb or lower";
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "upload/" . $file_name);
    } else {
        print_r($errors);
        die();
    }
}

if ($_POST['new_category'] == $_POST['old_category']) {
    $sql = "update post set title='{$_POST['post_title']}', description='{$_POST['postdesc']}',
        category={$_POST['old_category']}, post_img='{$file_name}' where post_id={$_POST['post_id']};";

    if (mysqli_query($conn, $sql)) {
        header("location: {$hostname}/admin/post.php");
    } else {
        echo "<div class='alert alert-danger'>Query Failed.</div>";
    }
} else {
    $sql = "update post set title='{$_POST['post_title']}', description='{$_POST['postdesc']}',
            category={$_POST['new_category']}, post_img='{$file_name}' where post_id={$_POST['post_id']};";
    $sql .= "update category set post= post + 1 where category_id={$_POST['new_category']};";
    $sql .= "update category set post= post - 1 where category_id={$_POST['old_category']};";

    echo "New Category {$_POST['new_category']}  and old category {$_POST['old_category']}";

    if (mysqli_multi_query($conn, $sql)) {
        header("location: {$hostname}/admin/post.php");
    } else {
        echo "<div class='alert alert-danger'>Query Failed.</div>";
    }
}

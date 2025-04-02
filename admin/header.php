<?php include "config.php";

$url=$_SERVER['PHP_SELF'];
$base_url=basename($url);
// echo $base_url;
switch ($base_url) {
case "post.php": $title="Post"; break;
case "category.php": $title= "Category"; break;
case "setting.php": $title= "Setting"; break;
case "add-post.php": $title= "Add Post"; break;
case "update-post.php": $title= "Update Post"; break;
case "add-user.php": $title= "Add User"; break;
case "update-user.php": $title= "Update User"; break;
case "add-category.php": $title= "Add Category"; break;
case "update-category.php": $title= "Update Category"; break;
default: $title= "Users";
}

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: {$hostname}/admin/");
}

$sql = "select * from setting";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
     <link rel="shortcut icon" href="images/<?php  ?>" type="image/x-icon">
    <title><?php echo $title ." - Admin Panel"; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="../css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header-admin">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <a href="post.php"><img class="logo" src="images/<?php echo $row['logo']; ?>"></a>
                </div>
                <!-- /LOGO -->
                <!-- LOGO-Out -->
                <div class="col-md-offset-6  col-md-3 text-right">
                    <a href="logout.php" class="admin-logout">Hlo! <?php echo $_SESSION['firstname'] /* . " " . $_SESSION['lastname']; */ ?>, logout</a>
                </div>
                <!-- /LOGO-Out -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="admin-menubar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="admin-menu">
                        <li>
                            <a href="post.php">Post</a>
                        </li>
                        <?php
                        if ($_SESSION['role'] == 1) {

                        ?>
                            <li>
                                <a href="category.php">Category</a>
                            </li>
                            <li>
                                <a href="users.php">Users</a>
                            </li>
                            <li>
                                <a href="setting.php">Setting</a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->
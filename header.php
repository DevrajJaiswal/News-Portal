<?php include 'config.php'; 

$url=$_SERVER['PHP_SELF'];
$base_url=basename($url);
// echo $base_url;
switch ($base_url) {
case "author.php": $title="Author"; break;
case "category.php": $title= "Category"; break;
case "search.php": $title= "Search"; break;
case "single.php": $title= "Single Post"; break;
default: $title= "Home";
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
    <link rel="shortcut icon" href="images/news.png" type="image/x-icon">
    <title><?php echo $title ." - News Portal"; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class=" col-md-offset-4 col-md-4">
                    <a href="index.php" id="logo"><img src="admin/images/<?php echo $row['logo']; ?>"></a>
                </div>
                <!-- /LOGO -->
            </div>
        </div>
    </div>

    <!-- /HEADER end-->

    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $sql = "select * from category where post > 0";
                    $result = mysqli_query($conn, $sql)  or die('query failed');

                    if (mysqli_num_rows($result) > 0) {

                    ?>
                        <ul class='menu'>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <li><a href='category.php?category=<?php echo $row['category_name'] ?>'><?php echo $row['category_name'] ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    <?php
                    } else {
                        echo "No Category Found";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->
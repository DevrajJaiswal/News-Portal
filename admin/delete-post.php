<?php include 'config.php';

$p_id = $_GET['p_id'];
$c_id = $_GET['c_id'];

$sql1 = "select * from post where post_id= {$p_id};";

$result=mysqli_query($conn, $sql1);
$row=mysqli_fetch_assoc($result);
echo "upload/".$row['post_img'];
unlink("upload/".$row['post_img']);

$sql = "delete from post where post_id= {$p_id};";
$sql .= "update category set post= post - 1 where category_id={$c_id}";
if (mysqli_multi_query($conn, $sql)) {
    header("location: {$hostname}/admin/post.php");
} else {
    echo "<div class='alert alert-danger'>Query Failed.</div>";
}

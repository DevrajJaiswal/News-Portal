<?php include "header.php";

if ($_SESSION['role'] == 0) {
    header("Location: {$hostname}/admin/post.php");
}
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <?php
                $page_limit = 6;

                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $offset = ($page - 1) * $page_limit;
                $sql = "select * from category order by category_id desc limit {$offset},{$page_limit}";
                $result = mysqli_query($conn, $sql)  or die('query failed');

                if (mysqli_num_rows($result) > 0) {

                ?>
                    <table class="content-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Category Name</th>
                            <th>No. of Posts</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {

                            ?>
                                <tr>
                                    <td class='id'><?php echo $row['category_id']; ?></td>
                                    <td><?php echo $row['category_name']; ?></td>
                                    <td><?php echo $row['post']; ?></td>
                                    <td class='edit'><a href='update-category.php?<?php echo $row['category_id'] ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-category.php?<?php echo $row['category_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                            <?php

                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo "No Category Found";
                }
                ?>

                <?php
                // Pagination code
                $sql1 = "select * from category";
                $result = mysqli_query($conn, $sql1);
                $rows = mysqli_num_rows($result);
                if ($rows > $page_limit) {
                    $total_page = ceil($rows / $page_limit);
                    echo "<ul class='pagination admin-pagination'>";
                    $i = 1;
                    if ($page > 1) {
                        $pre = $page - 1;
                        echo "<li><a href='category.php?page={$pre}'>Prev</a></li>";
                    }
                    while ($i <= $total_page) {
                        if ($i == $page) {
                            $is_active = "active";
                        } else {
                            $is_active = "";
                        }

                        echo "<li class='{$is_active}'><a href='category.php?page={$i}'>{$i}</a></li>";

                        $i++;
                    }
                    if ($total_page > $page) {
                        $nex = $page + 1;
                        echo "<li><a href='category.php?page={$nex}'>Next</a></li>";
                    }
                    echo "</ul>";
                }
                ?>

                <!-- <ul class='pagination admin-pagination'>
                        <li class="active"><a>1</a></li>
                        <li><a>2</a></li>
                        <li><a>3</a></li>
                    </ul> -->
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
<?php include "header.php";
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">add post</a>
            </div>
            <div class="col-md-12">
                <?php
                $page_limit = 5;

                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $offset = ($page - 1) * $page_limit;
                if ($_SESSION['role'] == 1) {
                    $sql = "select post.post_id, post.title, post.post_date, category.category_id, category.category_name, user.first_name from post 
                            left join category on post.category= category.category_id 
                            left join user on post.author = user.user_id order by post.post_id desc limit {$offset},{$page_limit}";

                    $result = mysqli_query($conn, $sql)  or die('query failed');
                } else {
                    $sql = "select * from post 
                            left join category on post.category= category.category_id 
                            left join user on post.author = user.user_id where user.user_id={$_SESSION['user_id']} 
                            order by post.post_id desc limit {$offset},{$page_limit}";

                    $result = mysqli_query($conn, $sql)  or die('query failed');
                }

                if (mysqli_num_rows($result) > 0) {

                ?>
                    <table class="content-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Author</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php
                            $sr_no = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td class='id'>{$sr_no}</td>";
                                echo "<td>{$row['title']}</td>";
                                echo "<td>{$row['category_name']}</td>";
                                echo "<td>{$row['post_date']}</td>";
                                echo "<td>{$row['first_name']}</td>";
                                echo "<td class='edit'><a href='update-post.php?id={$row['post_id']}'><i class='fa fa-edit'></i></a></td>";
                                echo "<td class='delete'><a href='delete-post.php?p_id={$row['post_id']}&c_id={$row['category_id']}'><i class='fa fa-trash-o'></i></a></td>";
                                echo "</tr>";
                                $sr_no++;
                            }
                            ?>
                        </tbody>
                    </table>
                <?php  } else {
                    echo "<div class='alert alert-danger'>No Post available!</div>";
                }  ?>

                <?php
                // Pagination code
                if ($_SESSION['role'] == 1) {
                    $sql = "select * from Post";
                    $result = mysqli_query($conn, $sql)  or die('query failed');
                } else {
                    $sql1 = "select * from Post left join user on user.user_id=post.author where user.user_id={$_SESSION['user_id']}";
                    $result = mysqli_query($conn, $sql1)  or die('query failed');
                }

                $rows = mysqli_num_rows($result);
                if ($rows > $page_limit) {
                    $total_page = ceil($rows / $page_limit);
                    /*  echo "total page " . $total_page; */
                    echo "<ul class='pagination admin-pagination'>";
                    $i = 1;
                    if ($page > 1) {
                        $pre = $page - 1;
                        echo "<li><a href='post.php?page={$pre}'>Prev</a></li>";
                    }
                    while ($i <= $total_page) {
                        if ($i == $page) {
                            $is_active = "active";
                        } else {
                            $is_active = "";
                        }

                        echo "<li class='{$is_active}'><a href='post.php?page={$i}'>{$i}</a></li>";

                        $i++;
                    }
                    if ($total_page > $page) {
                        $nex = $page + 1;
                        echo "<li><a href='post.php?page={$nex}'>Next</a></li>";
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
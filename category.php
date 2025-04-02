<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    if (isset($_GET['category'])) {
                        $category = $_GET['category'];
                        $sql1 = "select * from post where category='$category'";
                        $result1 = mysqli_query($conn, $sql1) or die('query failed');
                        $rows = mysqli_fetch_assoc($result1);
                    }
                    ?>

                    <h2 class="page-heading"><?php echo $_GET['category']; ?></h2>
                    <?php
                    $page_limit = 4;

                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $offset = ($page - 1) * $page_limit;

                    $sql2 = "select post.post_id, post.title, post.description, post.post_date, post.post_img, post.author, category.category_id, category.category_name, user.first_name, user.last_name from post 
                            left join category on post.category= category.category_id 
                            left join user on post.author = user.user_id where category_name='{$category}' order by post.post_date desc limit {$offset},{$page_limit}";

                    $result = mysqli_query($conn, $sql2) or die('query failed');

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?post_id=<?php echo $row['post_id']; ?>"><img
                                                src="admin/upload/<?php echo $row['post_img']; ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a
                                                    href='single.php?post_id=<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a>
                                            </h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a
                                                        href='category.php?category=<?php echo $row['category_name']; ?>'><?php echo $row['category_name']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php?auth_id=<?php echo $row['author']; ?>'><?php echo $row['first_name'] . " " . $row['last_name']; ?></a>
                                                    <!-- in link author.php -->
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $row['post_date']; ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo substr($row['description'], 0, 120) . "..."; ?>
                                            </p>
                                            <a class='read-more pull-right'
                                                href='single.php?post_id=<?php echo $row['post_id']; ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else {
                        echo "<div class='alert alert-danger'>No Post available!</div>";
                    } ?>

                    <?php
                    // Pagination code
                    $sql3 = "select * from post where category='{$category}'";
                    $result = mysqli_query($conn, $sql3) or die('query failed');

                    $rows = mysqli_num_rows($result);
                    if ($rows > $page_limit) {
                        $total_page = ceil($rows / $page_limit);
                        /*  echo "total page " . $total_page; */
                        echo "<ul class='pagination admin-pagination'>";
                        $i = 1;
                        if ($page > 1) {
                            $pre = $page - 1;
                            echo "<li><a href='category.php?category={$category}&page={$pre}'>Prev</a></li>";
                        }
                        while ($i <= $total_page) {
                            if ($i == $page) {
                                $is_active = "active";
                            } else {
                                $is_active = "";
                            }

                            echo "<li class='{$is_active}'><a href='category.php?category={$category}&page={$i}'>{$i}</a></li>";

                            $i++;
                        }
                        if ($total_page > $page) {
                            $nex = $page + 1;
                            echo "<li><a href='category.php?category={$category}&page={$nex}'>Next</a></li>";
                        }
                        echo "</ul>";
                    }
                    ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
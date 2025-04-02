<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    $post_id = $_GET['post_id'];
                    $sql = "select post.post_id, post.title, post.description, post.post_date, post.post_img, post.author, category.category_id, category.category_name, user.first_name, user.last_name from post 
                            left join category on post.category= category.category_id 
                            left join user on post.author = user.user_id where post_id= {$post_id}";

                    $result = mysqli_query($conn, $sql)  or die('query failed');

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <div class="post-content single-post">
                                <h3><?php echo $row['title']; ?></h3>
                                <div class="post-information">
                                    <span>
                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                        <?php echo $row['category_name']; ?>
                                    </span>
                                    <span>
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <a href='author.php?auth_id=<?php echo $row['author']; ?>'><?php echo $row['first_name'] . " " . $row['last_name']; ?></a>
                                    </span>
                                    <span>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <?php echo $row['post_date']; ?>
                                    </span>
                                </div>
                                <img class="single-feature-image" src="admin/upload/<?php echo $row['post_img']; ?>" alt="" />
                                <p class="description">
                                <?php echo $row['description']; ?>
                                </p>
                            </div>
                    <?php }
                    } else {
                        echo "<div class='alert alert-danger'>No Post available!</div>";
                    }  ?>

                </div>
                <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<div id="sidebar" class="col-md-4">
    <!-- search box -->
     <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->

     <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
        $recent_limit = 3;

        $sql1 = "select * from post";
        $row1 = mysqli_num_rows(mysqli_query($conn, $sql1));

        $offset = $row1 - 3;

        $sql = "select post.post_id, post.title, post.description, post.post_date, post.post_img, category.category_id, category.category_name, user.first_name, user.last_name from post 
        left join category on post.category= category.category_id 
        left join user on post.author = user.user_id order by post.post_date desc limit {$offset},{$recent_limit}";

        $result = mysqli_query($conn, $sql)  or die('query failed');

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="recent-post">
                    <a class="post-img" href="single.php?post_id=<?php echo $row['post_id']; ?>">
                        <img src="admin/upload/<?php echo $row['post_img']; ?>" alt="" />
                    </a>
                    <div class="post-content">
                        <h5>
                            <a href='single.php?post_id=<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a>
                        </h5>
                        <span>
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            <a href='category.php?category=<?php echo $row['category_name']; ?>'><?php echo $row['category_name']; ?></a>
                        </span>
                        <span>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo $row['post_date']; ?>
                        </span>
                        <a class="read-more" href="single.php?post_id=<?php echo $row['post_id']; ?>">read more</a>
                    </div>
                </div>
        <?php }
        } else {
            echo "<div class='alert alert-danger'>No Post available!</div>";
        }  ?>
    </div>
    <!-- /recent posts box -->
</div>
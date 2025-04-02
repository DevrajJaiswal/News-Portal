<?php include "header.php";
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php
                $post_id = $_GET['id'];

                $sql = "select post.post_id, post.title,post.description, post.post_date, post.category, post.post_img, category.category_id, category.category_name, user.first_name from post 
                        left join category on post.category= category.category_id 
                        left join user on post.author = user.user_id where post_id={$post_id}";

                $result = mysqli_query($conn, $sql)  or die('query failed');

                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <!-- Form for show edit-->
                        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <input type="hidden" name="post_id" class="form-control" value="<?php echo $row['post_id']; ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTile">Title</label>
                                <input type="text" name="post_title" class="form-control" id="exampleInputUsername" value="<?php echo $row['title']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Description</label>
                                <textarea name="postdesc" class="form-control" required rows="5">
                                <?php echo $row['description']; ?>
                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCategory">Category</label>
                                <input type="hidden" name="old_category" value="<?php echo $row['category']; ?>" >
                                <select class="form-control" name="new_category">
                                    <option value="" disabled> Select Category</option>
                                    
                                    <?php
                                    $sql1 = "select * from category";

                                    $result1 = mysqli_query($conn, $sql1)  or die('query failed');

                                    if (mysqli_num_rows($result1) > 0) {
                                        while ($row1 = mysqli_fetch_assoc($result1)) {
                                            if ($row1['category_id'] == $row['category']) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                            echo "<option {$selected} value='{$row1['category_id']}'> {$row1['category_name']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Post image</label>
                                <input type="file" name="new-image">
                                <img src="upload/<?php echo $row['post_img']; ?>" height="150px">
                                <input type="hidden" name="old-image" value="<?php echo $row['post_img']; ?>">
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                        </form>
                        <!-- Form End -->
                <?php  }
                } else {
                    echo "<div class='alert alert-danger'>No Post available!</div>";
                }  ?>

            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
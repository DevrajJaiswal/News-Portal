<?php include "header.php";
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Website Setting</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php
                $sql = "select * from setting";
                $result = mysqli_query($conn, $sql) or die("Query Failed!");

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <!-- Form for show edit-->
                        <form action="save-setting.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <label for="exampleInputTile">Website Title</label>
                                <input type="text" name="website_name" class="form-control" value="<?php echo $row["website_name"]; ?>">
                            </div>

                            <div class="form-group">
                                <label for="logo">Website logo</label>
                                <input type="file" name="logo" >
                                <img src="images/<?php echo $row["logo"]; ?>" height="70px">
                                <input type="hidden" name="old-logo" value="<?php echo $row['logo']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="footer_desc"> Footer Description</label>
                                <textarea name="footer_desc" class="form-control" rows="2">
                                <?php echo $row["footer_desc"]; ?>
                                </textarea>
                            </div>
                            <input type="submit" name="update" class="btn btn-primary" value="Update" />
                        </form>
                        <?php
                    }
                }
                ?>
                <!-- Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
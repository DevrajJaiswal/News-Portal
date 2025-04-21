<?php
$sql = "select * from setting";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

?>
<!-- Footer -->
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span><?php echo $row['footer_desc']; ?> <a href="http://www.devrajjaiswal.in">Devraj Jaiswal</a></span>
            </div>
        </div>
    </div>
</div>
<!-- /Footer -->
</body>

<script src="../js/jquery.js"></script>
<script src="../js/login.js"></script>
<script src="../js/user.js"></script>
<script src="../js/post.js"></script>
<script src="../js/category.js"></script>
<script src="../js/search.js"></script>
<script src="../js/script.js"></script>

</html>

<!-- style="width:100%; position: fixed; bottom:0; left:0; margin-top:30px" -->
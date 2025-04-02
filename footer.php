<?php
$sql = "select * from setting";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

?>
<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span><?php echo $row['footer_desc']; ?> <a href="http://www.devrajjaiswal.in">Devraj Jaiswal</a></span>
            </div>
        </div>
    </div>
</div>
</body>
</html>

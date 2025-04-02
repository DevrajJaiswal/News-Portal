<?php include "header.php";
if ($_SESSION['role'] == 0) {
    header("Location: {$hostname}/admin/post.php");
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
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
                $sql = "select * from user order by user_id desc limit {$offset},{$page_limit}";
                $result = mysqli_query($conn, $sql)  or die('query failed');

                if (mysqli_num_rows($result) > 0) {

                ?>
                    <table class="content-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Full Name</th>
                            <th>User Name</th>
                            <th>Role</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php
                            $sr_no = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td class='id'><?php echo $sr_no ?></td>
                                    <td><?php echo $row['first_name'] . ' ' . $row['last_name']  ?></td>
                                    <td><?php echo $row['username'] ?></td>

                                    <?php if ($row['role'] == 1) {
                                        $roles = "Admin";
                                    } else {
                                        $roles = "Normal User";
                                    } ?>
                                    <td><?php echo $roles ?></td>
                                    <td class='edit'><a href='update-user.php?id=<?php echo $row['user_id'] ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-user.php?id=<?php echo $row['user_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                            <?php $sr_no++;
                            } ?>
                        </tbody>
                    </table>
                <?php

                } ?>

                <?php
                // Pagination code
                $sql1 = "select * from user";
                $result = mysqli_query($conn, $sql1);
                $rows = mysqli_num_rows($result);
                if ($rows > $page_limit) {
                    $total_page = ceil($rows / $page_limit);
                    /*  echo "total page " . $total_page; */
                    echo "<ul class='pagination admin-pagination'>";
                    $i = 1;
                    if ($page > 1) {
                        $pre = $page - 1;
                        echo "<li><a href='users.php?page={$pre}'>Prev</a></li>";
                    }
                    while ($i <= $total_page) {
                        if ($i == $page) {
                            $is_active = "active";
                        } else {
                            $is_active = "";
                        }

                        echo "<li class='{$is_active}'><a href='users.php?page={$i}'>{$i}</a></li>";

                        $i++;
                    }
                    if ($total_page > $page) {
                        $nex = $page + 1;
                        echo "<li><a href='users.php?page={$nex}'>Next</a></li>";
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
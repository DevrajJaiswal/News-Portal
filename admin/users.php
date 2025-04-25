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
                <span class="add-new">add user</span>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S. No.</th>
                        <th>Full Name</th>
                        <th>User Name</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <!-- Users will appear here  -->
                    </tbody>
                </table>
                <ul class='pagination admin-pagination'>
                    <!-- Pagination will appear here  -->
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Model form end  -->
<div id="modelForm">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <h1 class="heading">Add User</h1>
                <!-- Form Start -->
                <form action="" method="POST" id="userForm" autocomplete="off">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name"
                            required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="user" id="user" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                            required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role" id="role">
                            <option value="0">Normal User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <input type="submit" name="save" id="saveButton" class="btn btn-primary" value="Save" required />
                </form>
                <!-- Form End-->
                <span id="closeModelForm">X</span>
            </div>
        </div>
    </div>
</div>
<!-- Model form end  -->
<?php include "footer.php"; ?>
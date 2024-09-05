<?php include "includes/admin_header.php"; ?>
<?php
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        $query = "SELECT * FROM users WHERE user_id = '{$user_id}' ";
        $select_user_profile_query = mysqli_query($connection, $query);
        confirm_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_user_profile_query)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image= $row['user_image'];
            $user_role = $row['user_role'];
        }
    }
?>
<?php
    if (isset($_POST['edit_user'])) {
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_role = $_POST['user_role'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];

        $query = "UPDATE users SET ";
        $query .= "username = '{$username}', ";
        $query .= "user_password = '{$user_password}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}' ";
        $query .= "WHERE user_id = {$user_id}";

        $update_profile = mysqli_query($connection, $query);
        confirm_query($connection, $update_profile);
        header("Location: users.php");
    }
?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small><?php echo $username; ?></small>
                    </h1>                    
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
                        </div>

                        <div class="form-group">
                            <label for="role">Select Role</label>
                            <select name="user_role" id="role">
                                <option value="subscriber"><?php echo $user_role;?></option>
                                <?php 
                                    if ($user_role == 'admin') {
                                        echo "<option value='subscriber'>subscriber</option>";
                                    }
                                    else {
                                        echo "<option value='admin'>admin</option>";
                                    }
                                ?>      
                            </select>
                        </div>

                        <!-- <div class="form-group">
                            <label for="post_image">Post Image</label>
                            <input type="file" name="image">
                        </div> -->

                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
                        </div>

                        <div class="form-group">
                            <label for="">E-mail</label>
                            <input type="text" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="edit_user" value="Update Profile">
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>
<?php
    if (isset($_GET['edit_user'])) {
        $user_to_edit_id = $_GET['edit_user'];
    }
    $query = "SELECT * FROM users WHERE user_id = {$user_to_edit_id}";
    $select_users_by_id = mysqli_query($connection, $query);
    
    while ($row = mysqli_fetch_assoc($select_users_by_id)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_role = $row['user_role'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_image = $row['user_image'];
        $user_email = $row['user_email'];
    }

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
        $query .= "WHERE user_id = {$user_to_edit_id}";

        $update_user = mysqli_query($connection, $query);
        confirm_query($connection, $update_user);
        header("Location: users.php");
    }
?>

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
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
    </div>
</form>
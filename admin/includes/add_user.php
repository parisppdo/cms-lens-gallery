<?php
    if (isset($_POST['create_user'])) {
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_role = $_POST['user_role'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];

        $query = "INSERT INTO users";
        $query .= "(username, user_password, user_firstname, user_lastname, user_email, ";
        $query .= "user_role) ";
        $query .= "VALUES ('{$username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', ";
        $query .= "'{$user_email}', '{$user_role}')";

        $create_user_query = mysqli_query($connection, $query);

        confirm_query($connection, $create_user_query);
        header("Location: users.php");
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="">Password</label>
        <input type="text" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <label for="role">Select Role</label>
        <select name="user_role" id="role">
            <option value="subscriber">Subscriber</option>
            <option value="admin">Admin</option>       
        </select>
    </div>

    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div> -->

    <div class="form-group">
        <label for="">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="">E-mail</label>
        <input type="text" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>
</form>
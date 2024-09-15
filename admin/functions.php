<?php

function users_online($connection) {
    if (isset($_GET['onlineusers'])) {
        $session = session_id();
        $current_time = time();
        $inactive_threshold = 60;
        $inactive_limit = $current_time - $inactive_threshold;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $select_online_users_query = mysqli_query($connection, $query);
        confirm_query($connection, $select_online_users_query);
        $count = mysqli_num_rows($select_online_users_query);

        if ($count == null) {
            mysqli_query($connection, "INSERT INTO users_online (session, last_activity_time) VALUES ('$session', '$current_time')");
        }
        else {
            mysqli_query($connection, "UPDATE users_online SET last_activity_time = '$current_time' WHERE session = '$session'");
        }

        $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE last_activity_time >= '$inactive_limit'");
        return $users_online = mysqli_num_rows($users_online_query);
    }
    else {
        return "Error";
    }
}


function confirm_query($connection, $result) {  
    if (!$result) {
        die("QUERY FAILED ." . mysqli_error($connection));
    }
}

function add_lens($connection) {
    //global $connection;
    if (isset($_POST['submit'])) {
        $lens_name = $_POST['lens_name'];
        if ($lens_name == "" || empty($lens_name)) {
            echo "This field should not be empty";
        }
        else {
            $query = "INSERT INTO lenses(lens_name) ";
            $query .= "VALUE('{$lens_name}')";

            $create_lens_query = mysqli_query($connection, $query);

            if (!$create_lens_query) {
                die('QUERY FAILED' . mysqli_error($connection));
            }
            header("Location: lenses.php");
        }
    }
}

function find_all_lenses($connection) {
    $query = "SELECT * FROM lenses";
    $select_lenses = mysqli_query($connection, $query);
    
    while ($row = mysqli_fetch_assoc($select_lenses)) {
        $lens_id = $row['lens_id'];
        $lens_name = $row['lens_name'];

        echo "<tr>";
        echo "<td>{$lens_id}</td>";
        echo "<td>{$lens_name}</td>";
        echo "<td><a href='lenses.php?delete={$lens_id}'>Delete</a></td>";
        echo "<td><a href='lenses.php?edit={$lens_id}'>Edit</a></td>";
        echo "<tr>";
    }
}

function delete_lens($connection) {
    if (isset($_GET['delete'])) {
        $lens_to_delete_id = $_GET['delete'];
        $query = "DELETE FROM lenses WHERE lens_id = {$lens_to_delete_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: lenses.php");
    }
}

?>
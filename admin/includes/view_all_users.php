<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Member Since</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);
            
            while ($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image= $row['user_image'];
                $user_role = $row['user_role'];

                echo "<tr>";
                echo "<td>$user_id</td>";
                echo "<td>$username</td>";
                echo "<td>$user_firstname</td>";

                // $query = "SELECT * FROM lenses WHERE lens_id = {$post_lens_id}";
                // $select_lens = mysqli_query($connection, $query);
                
                // while ($row = mysqli_fetch_assoc($select_lens)) {
                //     $lens_id = $row['lens_id'];
                //     $lens_name = $row['lens_name'];    

                // echo "<td>{$lens_name}</td>";
                // }
                
                echo "<td>$user_lastname</td>";
                echo "<td>$user_email</td>";
                echo "<td>$user_role</td>";

                // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                // $select_related_post_query = mysqli_query($connection, $query);

                // confirm_query($connection, $select_related_post_query);
                // while ($row = mysqli_fetch_assoc($select_related_post_query)) {
                //     $post_id = $row['post_id'];
                //     $post_title = $row['post_title'];                  
                // }        

                // echo "<td><a href='../post.php?p_id={$post_id}'>$post_title</a></td>";
                echo "<td>-</td>";
                echo "<td><a href='comments.php?approve={$user_id}'>Approve</a></td>";
                echo "<td><a href='comments.php?unapprove={$user_id}'>Unapprove</a></td>";
                echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </tbody>  
</table>  

<?php
    if (isset($_GET['approve'])) {
        $comment_to_approve_id = $_GET['approve'];
        
        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$comment_to_approve_id}";
        $approve_query = mysqli_query($connection, $query);
        header("Location: comments.php");
    }

    if (isset($_GET['unapprove'])) {
        $comment_to_unapprove_id = $_GET['unapprove'];
        
        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$comment_to_unapprove_id}";
        $unapprove_query = mysqli_query($connection, $query);
        header("Location: comments.php");
    }

    if (isset($_GET['delete'])) {
        $user_to_delete_id = $_GET['delete'];
        
        $query = "DELETE FROM users WHERE user_id = {$user_id}";
        $delete_user_query = mysqli_query($connection, $query);
        header("Location: users.php");
    }
?>
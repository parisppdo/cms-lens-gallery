<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT * FROM comments";
            $select_comments = mysqli_query($connection, $query);
            
            while ($row = mysqli_fetch_assoc($select_comments)) {
                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_email = $row['comment_email'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];

                echo "<tr>";
                echo "<td>$comment_id</td>";
                echo "<td>$comment_author</td>";
                echo "<td>$comment_content</td>";

                // $query = "SELECT * FROM lenses WHERE lens_id = {$post_lens_id}";
                // $select_lens = mysqli_query($connection, $query);
                
                // while ($row = mysqli_fetch_assoc($select_lens)) {
                //     $lens_id = $row['lens_id'];
                //     $lens_name = $row['lens_name'];    

                // echo "<td>{$lens_name}</td>";
                // }
                
                echo "<td>$comment_email</td>";
                echo "<td>$comment_status</td>";

                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                $select_related_post_query = mysqli_query($connection, $query);

                confirm_query($connection, $select_related_post_query);
                while ($row = mysqli_fetch_assoc($select_related_post_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];                  
                }        

                echo "<td><a href='../post.php?p_id={$post_id}'>$post_title</a></td>";
                echo "<td>$comment_date</td>";
                echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
                echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
                echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
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
        $comment_to_delete_id = $_GET['delete'];
        
        $query = "DELETE FROM comments WHERE comment_id = {$comment_to_delete_id}";
        $delete_comment_query = mysqli_query($connection, $query);
        header("Location: comments.php");
    }
?>
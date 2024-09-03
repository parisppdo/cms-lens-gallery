<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Lens</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT * FROM posts";
            $select_posts = mysqli_query($connection, $query);
            
            while ($row = mysqli_fetch_assoc($select_posts)) {
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_lens_id = $row['post_lens_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                echo "<tr>";
                echo "<td>$post_id</td>";
                echo "<td>$post_author</td>";
                echo "<td>$post_title</td>";

                $query = "SELECT * FROM lenses WHERE lens_id = {$post_lens_id}";
                $select_lens = mysqli_query($connection, $query);
                
                // WHILE LOOP MIGHT BE OBSOLETE HERE
                while ($row = mysqli_fetch_assoc($select_lens)) {
                    $lens_id = $row['lens_id'];
                    $lens_name = $row['lens_name'];    

                echo "<td>{$lens_name}</td>";
                }
                
                
                echo "<td>$post_status</td>";
                echo "<td><img src='../images/$post_image' alt='image' width='100'></td>";
                echo "<td>$post_tags</td>";
                echo "<td>$post_comment_count</td>";
                echo "<td>$post_date</td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </tbody>  
</table>  

<?php
    if (isset($_GET['delete'])) {
        $post_to_delete_id = $_GET['delete'];
        
        $query = "DELETE FROM posts WHERE post_id = {$post_to_delete_id}";
        $delete_post_query = mysqli_query($connection, $query);
        header("Location: posts.php");
    }
?>
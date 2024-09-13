<?php
    if (isset($_GET['upload']) && $_GET['upload'] == 'success') {
        echo "<p class='bg-success'><b>Post Added Successfully!</b></p>";
    }

    if (isset($_POST['checkBoxArray'])) {
        foreach ($_POST['checkBoxArray'] as $post_id) {
            $bulk_option = $_POST['bulk_option'];
            switch ($bulk_option) {
                case 'published':
                    $query = "UPDATE posts SET post_status = '{$bulk_option}' ";
                    $query .= "WHERE post_id='{$post_id}'";
                    $update_to_published_status_query = mysqli_query($connection, $query);
                    confirm_query($connection, $update_to_published_status_query);
                    break;

                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_option}' ";
                    $query .= "WHERE post_id='{$post_id}'";
                    $update_to_draft_status_query = mysqli_query($connection, $query);
                    confirm_query($connection, $update_to_draft_status_query);
                    break;

                case 'delete':
                    $query = "DELETE FROM posts ";
                    $query .= "WHERE post_id='{$post_id}'";
                    $delete_post_query = mysqli_query($connection, $query);
                    confirm_query($connection, $delete_post_query);
                    break;

                case 'clone':
                    $query = "SELECT * FROM posts ";
                    $query .= "WHERE post_id='{$post_id}'";
                    $select_post_query = mysqli_query($connection, $query);
                    confirm_query($connection, $select_post_query);

                    while ($row = mysqli_fetch_array($select_post_query)) {
                        $post_title = $row['post_title'];
                        $post_lens_id = $row['post_lens_id'];
                        $post_author = $row['post_author'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_content = $row['post_content'];
                        $post_date = $row['post_date'];
                    }

                    $query = "INSERT INTO posts";
                    $query .= "(post_lens_id, post_title, post_author, post_date, post_image, ";
                    $query .= "post_content, post_tags, post_status) ";
                    $query .= "VALUES ('{$post_lens_id}', '{$post_title}', '{$post_author}', now(), ";
                    $query .= "'{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";
            
                    $clone_query = mysqli_query($connection, $query);
                    confirm_query($connection, $clone_query);
                    //header("Location: posts.php?upload=success");

                    break;


            }
        }
    }
?>

<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_option" id="">
                <option value="" selected hidden>Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>
        </div>
        <div class="col-xs-4" style="margin-bottom: 10px;">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
        </div>
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>
                <th>id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Lens</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Views</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "SELECT * FROM posts ORDER BY post_id DESC";
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
                    $post_views_count = $row['post_views_count'];
                    echo "<tr>";
                    ?>
                    <td><input class='checkBoxes' type='checkbox' 
                    name='checkBoxArray[]' value="<?php echo $post_id; ?>"></td><!-- CHECKBOX -->
                    <?php
                    echo "<td>$post_id</td>";
                    echo "<td>$post_author</td>";
                    echo "<td>$post_title</td>";

                    $query = "SELECT * FROM lenses WHERE lens_id = {$post_lens_id}";
                    $select_lens = mysqli_query($connection, $query);
                    
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
                    echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                    echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
                    echo "<td>{$post_views_count}</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>  
    </table>  
</form>
<?php
    if (isset($_GET['delete'])) {
        $post_to_delete_id = $_GET['delete'];
        
        $query = "DELETE FROM posts WHERE post_id = {$post_to_delete_id}";
        $delete_post_query = mysqli_query($connection, $query);
        header("Location: posts.php");
    }
?>

<?php
    if (isset($_GET['p_id'])) {
        $post_to_edit_id = $_GET['p_id'];
    }
    $query = "SELECT * FROM posts WHERE post_id = {$post_to_edit_id}";
    $select_posts_by_id = mysqli_query($connection, $query);
    
    while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_lens_id = $row['post_lens_id'];
        $post_status = $row['post_status'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
    }

    if (isset($_POST['update_post'])) {
        $post_author = $_POST['author'];
        $post_title = $_POST['title'];
        $post_lens_id = $_POST['post_lens_id'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];

        move_uploaded_file($post_image_temp, "../images/$post_image");
        if (empty($post_image)) {
            $query = "SELECT * FROM posts WHERE post_id = $post_to_edit_id ";
            $select_image = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_array($select_image)) {
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_lens_id = '{$post_lens_id}', ";
        $query .= "post_date = now(), ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_image = '{$post_image}' ";
        $query .= "WHERE post_id = {$post_to_edit_id}";

        $update_post = mysqli_query($connection, $query);
        confirm_query($connection, $update_post);
        header("Location: posts.php");
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
            <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
    </div>
    
    <div class="form-group">
        <select name="post_lens_id" id="">
            <?php
                $query = "SELECT * FROM lenses";
                $select_lens = mysqli_query($connection, $query);
                confirm_query($connection, $select_lens);
                
                //WHILE LOOP MIGHT BE OBSOLETE HERE
                while ($row = mysqli_fetch_assoc($select_lens)) {
                    $lens_id = $row['lens_id'];
                    $lens_name = $row['lens_name'];   
                
                    echo "<option value='{$lens_id}'>{$lens_name}</option>";
                } 
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="title">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="author">
    </div>
    
    <div class="form-group">
        <label for="">Select Status</label>
        <select name="post_status" id="">
            <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
            <?php

                if ($post_status == 'published') {
                    echo "<option value='draft'>draft</option>";
                }
                else {
                    echo "<option value='published'>published</option>";
                }

            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
    </div>
    
    <div class="form-group">
        <img src="../images/<?php echo $post_image; ?>" width="100" alt="">
        <input type="file" name="image">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>"type="text" class="form-control" name="post_tags">
    </div>
    
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
</form>
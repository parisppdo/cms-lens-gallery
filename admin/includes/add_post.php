<?php
    if (isset($_POST['create_post'])) {
        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_lens_id = $_POST['post_lens_id'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        $post_comment_count = 5;

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO posts";
        $query .= "(post_lens_id, post_title, post_author, post_date, post_image, ";
        $query .= "post_content, post_tags, post_comment_count, post_status) ";
        $query .= "VALUES ('{$post_lens_id}', '{$post_title}', '{$post_author}', now(), ";
        $query .= "'{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}')";

        $create_post_query = mysqli_query($connection, $query);

        confirm_query($connection, $create_post_query);
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
            <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="post_lens">Choose Post Lens</label>
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
        <input type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>
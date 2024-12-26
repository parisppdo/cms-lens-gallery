<?php include "includes/header.php"; ?>

<?php
// Comment submition logic is put before page to avoid "Warning: Cannot modify header information - headers already sent by..."
if (isset($_POST['create_comment'])) {
    $post_id = $_GET['p_id'];

    $comment_author = $_POST['comment_author'];
    $comment_email = $_POST['comment_email'];
    $comment_content = $_POST['comment_content'];

    if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
        $query = "INSERT INTO comments (";
        $query .= "comment_post_id, ";
        $query .= "comment_author, ";
        $query .= "comment_email, ";
        $query .= "comment_content, ";
        $query .= "comment_status, ";
        $query .= "comment_date) ";
        $query .= "VALUES (";
        $query .= "$post_id, ";
        $query .= "'{$comment_author}', ";
        $query .= "'{$comment_email}', ";
        $query .= "'{$comment_content}', ";
        $query .= "'unapproved', ";
        $query .= "now())";

        $create_comment_query = mysqli_query($connection, $query);
        confirm_query($connection, $create_comment_query);

        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
        $query .= "WHERE post_id = {$post_id}";
        $increase_comment_count = mysqli_query($connection, $query);
        confirm_query($connection, $increase_comment_count);
        header("Location: post.php?p_id={$post_id}&action=submitted");
    } else {
        echo "<script>alert('Fields cannot be empty')</script>";
    }
}
?>

    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];

                $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $post_id";
                $views_query = mysqli_query($connection, $query);
                confirm_query($connection, $views_query);

                $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
                $select_all_posts_query = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_status = $row['post_status'];
                    $post_tags = $row['post_tags'];
                    $post_tags = preg_replace('/\s*,\s*/', ',', $post_tags); // removes space before and after comma
                    $post_tags = explode(',', $post_tags);
                    ?>
                    <h1 class="page-header">
                        Vintage Lens Blog<br>
                        <small>Photos by old manual lenses!</small>
                    </h1>

                    <!-- Comment submit message -->
                    <?php
                    if (isset($_GET['action']) && $_GET['action'] == 'submitted') {
                        echo "<p class='bg-success'>Comment submitted for approval!</p>";
                    }

                    ?>

                    <!-- First Blog Post -->
                    <?php if ($post_status == 'published'): ?>
                    <h2>
                        <a href="#"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                    <hr>
                    <p><?php echo $post_content ?></p>
                    <div class="post-tags">
                        <strong>Tags:</strong>
                        <?php
                        foreach ($post_tags as $tag) {
                            echo "<form method='POST' action='search.php' style='display:inline;'>
                                    <input type='hidden' name='search' value='" . htmlspecialchars($tag) . "'>
                                    <button name='submit' type='submit' class='btn btn-default btn-xs'>" . htmlspecialchars($tag) . "</button>
                                    </form> ";
                        }
                        ?>
                    </div>
                    <hr>
                    <?php else: ?>
                        <div class="alert alert-warning" role="alert">
                            <strong>Warning!</strong> Post not yet approved!
                        </div>
                    <?php endif; ?>
                    <?php

                }
            } else {
                header("Location: index.php");
            }
            ?>
            <!-- Blog Comments -->

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" name="comment_author" class="form-control" name="comment_author">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="comment_email" class="form-control" name="comment_email">
                    </div>
                    <div class="form-group">
                        <label for="comment">Your Comment</label>
                        <textarea class="form-control" name="comment_content" rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->
            <?php
            $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
            $query .= "AND comment_status = 'approved' ";
            $query .= "ORDER BY comment_id DESC";
            $select_comment_query = mysqli_query($connection, $query);
            confirm_query($connection, $select_comment_query);

            while ($row = mysqli_fetch_assoc($select_comment_query)) {
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];
                ?>
                <!-- Comment -->
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

<?php include "includes/footer.php"; ?>
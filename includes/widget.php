<div class="well">
    <h4>Latest Posts</h4>
    <?php
        $query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT 5";
        $select_latest_posts_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_latest_posts_query)) {
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            echo "<li>$post_title by $post_author</li>";
        }
    ?>
</div>
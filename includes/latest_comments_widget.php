<div class="well">
    <h4>Latest Comments</h4>
    <ul style="list-style-type: none;">
        <?php
        $query = "SELECT post_id, comment_author, post_title
                    FROM posts JOIN comments WHERE comment_post_id = post_id
                    ORDER BY comment_id DESC
                    LIMIT 5;";
        $select_latest_comments_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_latest_comments_query)) {
            $post_id = $row['post_id'];
            $comment_author = $row['comment_author'];
            $post_title = $row['post_title'];
            echo "<li>$comment_author on <a href='post.php?p_id=$post_id'>$post_title</a></li>";
        }
        ?>
    </ul>
</div>
<?php session_start() ?>
<?php include "../functions.php"; ?>
<?php include "../../includes/db.php"; ?>

<?php
    echo users_online($connection);
?>
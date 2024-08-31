<form action="" method="post">
    <div class="form-group">
        <label for="lens_name">Edit Lens</label>
        <?php
            if (isset($_GET['edit'])) {
                $lens_to_edit_id = $_GET['edit'];
                $query = "SELECT * FROM lenses WHERE lens_id = {$lens_to_edit_id}";
                $select_lense = mysqli_query($connection, $query);
                
                // WHILE LOOP MIGHT BE OBSOLETE HERE
                while ($row = mysqli_fetch_assoc($select_lense)) {
                    $lens_id = $row['lens_id'];
                    $lens_name = $row['lens_name'];    
        ?>
            <input value="<?php if(isset($lens_name)) {echo $lens_name;} ?>" type="text" class="form-control" name="lens_name">
        <?php 
                }                                        
            }
        ?>
        <?php
            /// UPDATE QUERY
            if (isset($_POST['update_lens'])) {
                $new_lens_name = $_POST['lens_name'];
                $query = "UPDATE lenses SET lens_name = '{$new_lens_name}' ";
                $query .= "WHERE lens_id = {$lens_id}";
                $update_query = mysqli_query($connection, $query);
                if (!$update_query) {
                    die("Query Failed" . mysqli_error($connection));
                }
                //header("Location: lenses.php");
            }
        ?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_lens" value="Update Lens">
    </div>
</form>
<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>
                        <div class="col-xs-6">
                            <?php
                                if (isset($_POST['submit'])) {
                                    $lens_name = $_POST['lens_name'];
                                    if ($lens_name == "" || empty($lens_name)) {
                                        echo "This field should not be empty";
                                    }
                                    else {
                                        $query = "INSERT INTO lenses(lens_name) ";
                                        $query .= "VALUE('{$lens_name}')";

                                        $create_lens_query = mysqli_query($connection, $query);

                                        if (!$create_lens_query) {
                                            die('QUERY FAILED' . mysqli_error($connection));
                                        }
                                    }

                                }
                            ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="lens_name">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Lens">
                                </div>
                            </form>
                        </div><!--Add Lens Form-->
                        <div class="col-xs-6">
                        <?php

                        $query = "SELECT * FROM lenses";
                        $select_lenses = mysqli_query($connection, $query);

                        ?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Lens Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php

                                while ($row = mysqli_fetch_assoc($select_lenses)) {
                                    $lens_id = $row['lens_id'];
                                    $lens_name = $row['lens_name'];

                                    echo "<tr>";
                                    echo "<td>{$lens_id}</td>";
                                    echo "<td>{$lens_name}</td>";
                                    echo "<tr>";
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>
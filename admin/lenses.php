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
                            <?php add_lens($connection); ?> <!--ADD LENSES QUERY-->
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="lens_name">Add Lens</label>
                                    <input type="text" class="form-control" name="lens_name">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Lens">
                                </div>
                            </form>
                            <?php
                                // UPDATE QUERY
                                if (isset($_GET['edit'])) {
                                    $lens_id = $_GET['edit'];
                                    include "includes/update_lenses.php";
                                }
                            
                            ?>
                        </div><!--Add Lens Form-->
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Lens Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php find_all_lenses($connection); ?> <!--FIND LENSES QUERY-->
                                <?php delete_lens($connection); ?><!--DELETE LENSES QUERY-->
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
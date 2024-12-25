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
                        Welcome to <?php echo $_SESSION['user_role']; ?> menu
                        <small><?php echo $_SESSION['username']; ?></small>
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
                                <th>Lens Name</th>
                                <th>Status</th>
                                <?php if (isAdmin()): ?>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>
                                <?php list_lenses_html($connection); ?> <!--LIST LENSES QUERY-->
                                <?php delete_lens($connection); ?><!--DELETE LENSES QUERY-->
                                <?php
                                    if (isset($_GET['approve'])) {
                                        $lens_to_approve_id = $_GET['approve'];

                                        $query = "UPDATE lenses SET lens_status = 'approved' WHERE lens_id = {$lens_to_approve_id}";
                                        $approve_query = mysqli_query($connection, $query);
                                        header("Location: lenses.php");
                                    }

                                    if (isset($_GET['unapprove'])) {
                                        $lens_to_unapprove_id = $_GET['unapprove'];

                                        $query = "UPDATE lenses SET lens_status = 'unapproved' WHERE lens_id = {$lens_to_unapprove_id}";
                                        $unapprove_query = mysqli_query($connection, $query);
                                        header("Location: lenses.php");
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
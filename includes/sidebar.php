<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Search by tag</h4>
        <form action="search.php" method="POST">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Login -->
    <?php if (($_SESSION['user_role']) === 'user'): ?>
        <div class="well">
            <h4>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h4>
            <p class="text-warning">Your registration is yet to be approved!</p>
            <a href="./includes/logout.php" class="btn btn-info btn-xs">Log Out</a>
        </div>
    <?php elseif (($_SESSION['user_role']) === 'admin' || ($_SESSION['user_role']) === 'subscriber'): ?>
        <div class="well">
            <h4>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h4>
            <a href="./includes/logout.php" class="btn btn-info btn-xs">Log Out</a>
        </div>
    <?php else: ?>
        <div class="well">
            <h4>Admin Login</h4>
            <form action="includes/login.php" method="POST">
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="Enter Username">
                </div>
                <div class="input-group">
                    <input name="password" type="password" class="form-control" placeholder="Enter Password">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" name="login" type="submit">Submit</button>
                    </span>
                </div>
            </form>
            <!-- /.input-group -->
        </div>
    <?php endif; ?>
    <!-- Blog Categories Well -->

    <div class="well">
        <?php

        $query = "SELECT * FROM lenses";
        $select_all_lenses_sidebar = mysqli_query($connection, $query);

        ?>
        <h4>View Post By Lens</h4>
        <div class="row">
            <div class="col-lg-12">
                <form action="./lens.php" method="get">
                    <select name='lens_id' id='lens_id' class=''>
                        <option value='-1'>Select Lens</option>
                        <?php

                        while ($row = mysqli_fetch_assoc($select_all_lenses_sidebar)) {
                            $lens_name = $row['lens_name'];
                            $lens_id = $row['lens_id'];
                            echo "<option value='$lens_id'>$lens_name</option>";
                        }
                        ?>
                    </select>
                </form>
                <script type="text/javascript">
                    (function() {
                        var dropdown = document.getElementById( "lens_id" );
                        function onLensChange() {
                            if ( dropdown.options[ dropdown.selectedIndex ].value > 0 ) {
                                dropdown.parentNode.submit();
                            }
                        }
                        dropdown.onchange = onLensChange;
                    })();
                </script>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Latest Posts Widget -->
    <?php include "latest_posts_widget.php"; ?>

    <!-- Latest Comments Widget -->
    <?php include "latest_comments_widget.php"; ?>

</div>
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
                <div class="well">
                    <h4>Admin Login</h4>
                    <form action="includes/login.php" method="POST">
                        <div class="form-group">
                            <input name="username" type="text" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="input-group">
                            <input name="password" type="passwird" class="form-control" placeholder="Enter Password">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" name="login" type="submit">Submit</button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                
                <div class="well">
                    <?php

                    $query = "SELECT * FROM lenses";
                    $select_all_lenses_sidebar = mysqli_query($connection, $query);

                    ?>
                    <h4>View Post By Lens</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php

                                    while ($row = mysqli_fetch_assoc($select_all_lenses_sidebar)) {
                                        $lens_name = $row['lens_name'];
                                        $lens_id= $row['lens_id'];
                                        echo "<li><a href='lens.php?lens_id={$lens_id}'>{$lens_name}</a></li>";
                                    }

                                ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"; ?>                        

            </div>
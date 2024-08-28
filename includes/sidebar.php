<div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
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

                <!-- Blog Categories Well -->
                
                <div class="well">
                    <?php

                    $query = "SELECT * FROM lenses";
                    $select_all_lenses_sidebar = mysqli_query($connection, $query);

                    ?>
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php

                                    while ($row = mysqli_fetch_assoc($select_all_lenses_sidebar)) {
                                        $lens_name = $row['lens_name'];
                                        echo "<li><a href='#'>{$lens_name}</a></li>";
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
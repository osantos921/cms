<div class="col-md-4">
    <?php global $search; ?>
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control" value="<?php echo htmlspecialchars($search); ?>">
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
        if (!isset($_SESSION['username'])) {
        ?>
            <h4>Login</h4>
            <form action="authenticate/login.php" method="post">
                <div class="form-group">
                    <label for="username">User Name</label>
                    <input name="username" type="text" class="form-control" placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control" placeholder="Enter Password">
                </div>

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="login" value="Sign In">
                    <input class="btn btn-primary" type="submit" name="signup" value="Sign Up">
                </div>
            </form>
            <!-- /.input-group -->
        <?php } else { ?>
            <div class="user-details">
                <img src="images/<?php echo $_SESSION['userImage']; ?>" alt="User Image" width="100">
                <h2>Welcome, <?php echo $_SESSION['firstName']; ?> <?php echo $_SESSION['lastName']; ?>!</h2>
                <p><strong>User Name:</strong> <?php echo $_SESSION['username']; ?></p>
                <p><strong>Email:</strong> <?php echo $_SESSION['userEmail']; ?></p>
                <p><strong>Role:</strong> <?php echo $_SESSION['userRole']; ?></p>

                <div class="form-group">
                    <a href="post.php?source_post=add_post" class="btn btn-primary">Add Post</a>
                    <a href="authenticate/logout.php" class="btn btn-primary">Log Out</a>
                </div>
            </div>

        <?php } ?>
    </div>

    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    $select_all_category_sidebar = GetCategories($con);

                    while ($row = mysqli_fetch_assoc($select_all_category_sidebar)) {
                        $cat_id =  $row['catId'];
                        $cat_title =  $row['catTitle'];
                        echo  "<li><a href='category.php?c_id={$cat_id}'>{$cat_title}</a></li>";
                    }
                    ?>
                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>

    <?php
    if (isset($_SESSION['username'])) {
    ?>
        <!-- Side Widget Well -->
        <div class="well">
            <h4></h4>
            <form action="authenticate/login.php" method="post">
                <div class="form-group">
                    <input class="btn btn-custom btn-lg btn-block btn-primary" type="submit" name="change_password" value="Change Password">
                    <input class="btn btn-custom btn-lg btn-block btn-primary" type="submit" name="inactive_account" value="Deactivate Account">
                </div>
            </form>
        </div>

    <?php } ?>

</div>
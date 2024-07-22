<?php include "includes/db.php"; ?>
<?php include "functions/data.php"; ?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Home Page</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $getCategories_navigation = GetCategories($con);
                while ($row = mysqli_fetch_assoc($getCategories_navigation)) {
                ?>

                    <li>
                        <a href="#"><?php echo $row['catTitle']; ?></a>
                    </li>

                <?php
                }
                if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'Admin'){
                ?>
                <li>
                        <a href="admin/index.php">Admin</a>
                </li>
                <?php } ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
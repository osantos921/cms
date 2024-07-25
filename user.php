<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">
            <h1 class="page-header">
                Page Blog
                <small>Registration</small>
            </h1>
            
            <!-- Blog Post -->
            <?php
            
            if (isset($_GET['source_user'])) {
                $source = $_GET['source_user'];
            } else {
                $source = '';
            }
            switch ($source) {
                case 'change_password';
                    include "forms/change_password.php";
                    break;                  
                default:
                    include "forms/create_user.php";
                    break;
            }
            
            
            
            
            ?>
        
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>
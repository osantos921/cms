<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">

            <?php

            if (isset($_GET['source_post'])) {
                $source = $_GET['source_post'];
            } else {
                $source = '';
            }
            switch ($source) {
                case 'add_post';
                    include "forms/new_post.php";
                    break;
                    case 'edit_post';
                    include "forms/edit_post.php";
                    break;
                default:
                    include "forms/view_post.php";
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
<?php include "includes/header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            CMS Admin
                            <small>Author</small>
                        </h1>
                        <h2 class="bg-info">Post</h2>  
                                            
                <!-- /.row -->
                <?php
                    if (isset($_GET['source_post'])) {
                        $source = $_GET['source_post'];
                    } else {
                        $source = '';
                    }
                    switch ($source) {
                        case 'add_post';
                           include "forms/add_post.php";
                            break;
                        case 'edit_post';
                           include "forms/edit_post.php";
                            break;                      
                        default:
                            include "forms/view_all_post.php";
                            break;
                    }
                    ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php include "includes/footer.php"; ?>
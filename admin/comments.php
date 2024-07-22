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
                            <small><?php echo getUser(); ?></small>
                        </h1>
                        <h2 class="bg-info">Comments</h2>  
                                            
                <!-- /.row -->
                <?php
                 include "forms/view_all_comment.php";              
                    ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php include "includes/footer.php"; ?>
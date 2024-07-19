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
                    <h2 class="bg-info">User</h2>

                    <!-- /.row -->
                    <?php
                    if (isset($_GET['source_user'])) {
                        $source = $_GET['source_user'];
                    } else {
                        $source = '';
                    }
                    switch ($source) {
                        case 'add_user';
                            include "forms/add_user.php";
                            break;
                        case 'edit_user';
                            include "forms/edit_user.php";
                            break;
                        default:
                            include "forms/view_all_user.php";
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
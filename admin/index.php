<?php include "includes/header.php"; ?>


<?php

function getPostCount($con)
{
    $qry = "SELECT * FROM posts where inactive = 0";
    $select_all_post = mysqli_query($con, $qry);
    return mysqli_num_rows($select_all_post);
}

function getCommentCount($con)
{
    $qry = "SELECT * FROM comments where inactive = 0";
    $select_all_comment = mysqli_query($con, $qry);
    return mysqli_num_rows($select_all_comment);
}

function getUserCount($con)
{
    $qry = "SELECT * FROM users where inactive = 0";
    $select_all_user = mysqli_query($con, $qry);
    return mysqli_num_rows($select_all_user);
}

function getCategoryCount($con)
{
    $qry = "SELECT * FROM categories where inactive = 0";
    $select_all_category = mysqli_query($con, $qry);
    return mysqli_num_rows($select_all_category);
}

?>


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
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-file-text fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class='huge'><?php echo getPostCount($con); ?></div>
                                            <div>Posts</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="posts.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class='huge'><?php echo getCommentCount($con); ?></div>
                                            <div>Comments</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="comments.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-user fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class='huge'><?php echo getUserCount($con); ?></div>
                                            <div> Users</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="users.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class='huge'><?php echo getCategoryCount($con); ?></div>
                                            <div>Categories</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="categories.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="panel-info">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-desktop fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class='huge'>1</div>
                                            <div>Home Page</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="../index.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                <div class="col-lg-6">                 
                        <h2 class="text-center">Pie Statistics</h2>
                        <canvas id="adminPieChart" width="50" height="50"></canvas>                  
                </div>

                <div class="col-lg-6">                  
                        <h2 class="text-center">Bar Statistics</h2>
                        <canvas id="adminChart" width="50" height="50"></canvas>                  
                </div>
            </div>


                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->
            <!-- Add the canvas element for the pie chart -->

        </div>
        <!-- /#wrapper -->


        <?php include "includes/footer.php"; ?>

        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                var ctx = document.getElementById('adminPieChart').getContext('2d');
                var adminPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Posts', 'Comments', 'Users', 'Categories'],
                        datasets: [{
                            label: 'Count',
                            data: [
                                <?php echo getPostCount($con); ?>,
                                <?php echo getCommentCount($con); ?>,
                                <?php echo getUserCount($con); ?>,
                                <?php echo getCategoryCount($con); ?>
                            ],
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(255, 99, 132, 0.2)'
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 99, 132, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw;
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>

        <script>
            // JavaScript to create the chart
            document.addEventListener('DOMContentLoaded', (event) => {
                var ctx = document.getElementById('adminChart').getContext('2d');
                var adminChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Posts', 'Comments', 'Users', 'Categories'],
                        datasets: [{
                            label: 'Count',
                            data: [<?php echo getPostCount($con); ?>, <?php echo getCommentCount($con); ?>, <?php echo getUserCount($con); ?>, <?php echo getCategoryCount($con); ?>],
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(255, 99, 132, 0.2)'
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 99, 132, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>
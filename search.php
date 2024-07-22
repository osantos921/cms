<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>
<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">
                Page Blog
                <small>Posts</small>
            </h1>

            <?php
            // Pagination settings
            $posts_per_page = 5;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $start = ($page - 1) * $posts_per_page;

            // Search functionality
            $search = "";
            $search_qry = null;
            $total_posts = 0;
            // Function to get the total number of posts
            function getTotalPosts($con, $search)
            {
                if ($search) {
                    $search = mysqli_real_escape_string($con, $search);
                    $qry = "SELECT COUNT(*) FROM posts WHERE postTags LIKE '%$search%'";
                } else {
                    $qry = "SELECT COUNT(*) FROM posts WHERE inActive = 0";
                }
                $result = mysqli_query($con, $qry);
                return mysqli_fetch_array($result)[0];
            }

            function getSearchPosts($con, $search = "", $start, $posts_per_page)
            {
                if ($search) {
                    $search = mysqli_real_escape_string($con, $search);
                    $qry = "SELECT * FROM posts WHERE postTags LIKE '%$search%' AND inActive = 0 ORDER BY postId DESC LIMIT $start, $posts_per_page";
                } else {
                    $qry = "SELECT * FROM posts WHERE inActive = 0 ORDER BY postId DESC LIMIT $start, $posts_per_page";
                }
                return mysqli_query($con, $qry);
            }

            if (isset($_POST['search'])) {

                $search = $_POST['search'];
            }

            if (isset($_GET['search'])) {

                $search = $_GET['search'];
            }

            $total_posts = getTotalPosts($con, $search);
            $posts = getSearchPosts($con, $search, $start, $posts_per_page);

            //  $qry = "SELECT * FROM posts WHERE postTags LIKE '%$search%'";
            // $search_qry = mysqli_query($con, $qry);

            if (!$posts) {
                die("Search Qry Failed" . mysqli_error($con));
            }

            $count = mysqli_num_rows($posts);
            if ($count == 0) {
                echo "No result";
            } else {

                while ($row = mysqli_fetch_assoc($posts)) {
                    $post_id = $row['postId'];
                    $post_title =  $row['postTitle'];
                    $post_author =  $row['postAuthor'];
                    $post_date =  $row['postDate'];
                    $post_image =  $row['postImage'];
                    $post_content =  $row['postContent'];

            ?>
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                    <hr>
                    <p><?php echo $post_content ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
            <?php
                }
            }
            ?>
            <!-- Pager -->
            <ul class="pager">
                <?php if ($page > 1) : ?>
                    <li class="previous">
                        <a href="?page=<?php echo $page - 1; ?><?php if (!empty($search)) echo '&search=' . urlencode($search); ?>">&larr; Older</a>
                    </li>
                <?php endif; ?>

                <?php if ($page * $posts_per_page < $total_posts) : ?>
                    <li class="next">
                        <a href="?page=<?php echo $page + 1; ?><?php if (!empty($search)) echo '&search=' . urlencode($search); ?>">Newer &rarr;</a>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- First Blog Post -->

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php" ?>
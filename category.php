<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

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
            if (isset($_GET['c_id'])) {
                $cat_id = $_GET['c_id'];
            }

            $qry = "SELECT * FROM posts WHERE postCategoryId=$cat_id AND inActive = 0";
            $select_all_posts_qry = mysqli_query($con, $qry);

            while ($row = mysqli_fetch_assoc($select_all_posts_qry)) {
                $post_id =  $row['postId'];
                $post_title =  $row['postTitle'];
                $post_author =  $row['postAuthor'];
                $post_date =  $row['postDate'];
                $post_image =  $row['postImage'];
                $post_content =  $row['postContent'];
            ?>

                <!-- First Blog Post -->
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
            ?>
            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->
    <hr>

    <?php include "includes/footer.php"; ?>
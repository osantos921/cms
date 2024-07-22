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
            $posts_per_page = 5;

            // Get the current page number from the URL, default is 1
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

            // Calculate the starting post index
            $start = ($page - 1) * $posts_per_page;

            // Get the total number of posts
            $total_posts_query = "SELECT COUNT(*) FROM posts";
            $total_posts_result = mysqli_query($con, $total_posts_query);
            $total_posts_row = mysqli_fetch_array($total_posts_result);
            $total_posts = $total_posts_row[0];

            // Calculate the total number of pages
            $total_pages = ceil($total_posts / $posts_per_page);

            // Fetch the posts for the current page
            $query = "SELECT * FROM posts WHERE inactive = 0  ORDER BY postId DESC LIMIT $start, $posts_per_page";
            $select_all_post = mysqli_query($con, $query);

            //$select_all_post = GetPosts($con);
            while ($row = mysqli_fetch_assoc($select_all_post)) {
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
                <?php if ($page > 1) : ?>
                    <li class="previous">
                        <a href="?page=<?php echo $page - 1; ?>">&larr; Older</a>
                    </li>
                <?php endif; ?>

                <?php if ($page < $total_pages) : ?>
                    <li class="next">
                        <a href="?page=<?php echo $page + 1; ?>">Newer &rarr;</a>
                    </li>
                <?php endif; ?>
            </ul>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php"; ?>
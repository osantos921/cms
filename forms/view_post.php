<!-- Blog Post -->
<?php
if (isset($_GET['p_id'])) {
    $post_id = $_GET['p_id'];
    $qry = "SELECT * FROM posts WHERE postId = $post_id";
    $select_edit_post_qry = mysqli_query($con, $qry);
    $row = mysqli_fetch_assoc($select_edit_post_qry);

    $post_title = $row['postTitle'];
    $post_author = $row['postAuthor'];
    $post_date = $row['postDate'];
    $post_image = $row['postImage'];
    $post_content = $row['postContent'];

    UpdatePostCommentCount($con, $post_id);
}

function UpdatePostCommentCount($con, $post_id)
{
    $post_id = (int) $post_id;
    $count = GetCommentPostCount($con, $post_id);

    if ($count === false) {
        die('Failed to get comment count: ' . mysqli_error($con));
    }

    $qry = "UPDATE posts SET ";
    $qry .= "postCommentCount = {$count} WHERE ";
    $qry .= "postId = {$post_id}";

    $update_count_qry = mysqli_query($con, $qry);
    if (!$update_count_qry) {
        die('Qry Failed' . mysqli_error($con));
    }
}
?>
<!-- Title -->
<h1><?php echo  $post_title; ?> </h1>

<!-- Author -->
<p class="lead">
    by <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo  $post_author; ?></a>
</p>

<hr>

<!-- Date/Time -->
<p><span class="glyphicon glyphicon-time"></span> <?php echo  $post_date; ?></p>

<hr>

<!-- Preview Image -->
<img class="img-responsive" src="images/<?php echo  $post_image; ?>" alt="">

<hr>

<!-- Post Content -->
<p class="lead">
<p><?php echo  $post_content; ?></p>
<hr>

<?php

if (isset($_POST['submit_comment'])) {
    newComment($con);
}

function newComment($con)
{
    $post_id = $_GET['p_id'];
    $comment_author =  mysqli_real_escape_string($con, $_POST['comment_author']);
    $comment_email =  mysqli_real_escape_string($con, $_POST['comment_email']);
    $comment_content =  mysqli_real_escape_string($con, $_POST['comment_content']);

    $comment_status = 'Draft';
    $inActive =  0;

    if (empty($comment_author) || empty($comment_email) || empty($comment_content)) {
        echo "<script>alert('This field should not be empty. , " . "Comment" . "!');</script>";
    } else {

        $qry = "INSERT INTO comments(commentPostId,commentDate,commentAuthor,commentEmail,commentContent,commentStatus,inActive)VALUES";
        $qry .= "('{$post_id}',now(),'{$comment_author}','{$comment_email}','{$comment_content}','{$comment_status}','{$inActive}')";

        $new_comment_qry = mysqli_query($con, $qry);
        if (!$new_comment_qry) {
            die('Qry Failed' . mysqli_error($con));
        }

        echo "<script>
                    alert('Post has been save successfully!');    
                    window.location.href = 'post.php?p_id={$post_id}';  
                    </script>";


        exit();
    }
}

if (isset($_POST['edit_post'])) {
    echo "<script>
    window.location.href = 'post.php?source_post=edit_post&p_id={$post_id}';  
    </script>";
}

?>

<?php
if (isset($_SESSION['userId'])) {
    $name = $_SESSION['firstName'] . ' ' . $_SESSION['lastName'];
    $email =  $_SESSION['userEmail'];
    $role =  $_SESSION['userRole'];
?>
    <!-- Comments Form -->
    <div class="well">

        <h4>Leave a Comment:</h4>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="comment_author">Name</label>
                <input type="text" class="form-control" name="comment_author" value="<?php echo $name; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="comment_email">Email</label>
                <input type="text" class="form-control" name="comment_email" value="<?php echo $email; ?>" readonly>
            </div>
            <div class="form-group">
                <textarea class="form-control" rows="3" name="comment_content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit_comment">Submit</button>
            <?php
            if ($role == 'Admin') {
            ?>
                <button type="submit" class="btn btn-primary" name="edit_post">Edit Post</button>
            <?php } ?>
        </form>
    </div>

    <hr>

<?php } ?>
<!-- Posted Comments -->

<!-- Comment -->
<?php
$select_all_comment = GetComment($con, $post_id);
while ($row = mysqli_fetch_assoc($select_all_comment)) {
    $comment_author = $row['commentAuthor'];
    $comment_content = $row['commentContent'];
    $comment_date = $row['commentDate'];
?>
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="images/<?php echo $post_image; ?>" width="50" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading"><?php echo $comment_author; ?>
                <small><?php echo $comment_date; ?></small>
            </h4>
            <?php echo $comment_content; ?>
        </div>
    </div>

<?php } ?>

<!-- Comment -->
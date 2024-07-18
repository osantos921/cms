<?php
if (isset($_POST['new_post'])) {
    newPost($con);
}
function newPost($con)
{
    $post_author = mysqli_real_escape_string($con, $_POST['post_author']);
    $post_title =  mysqli_real_escape_string($con, $_POST['post_title']);
    $post_category =  mysqli_real_escape_string($con, $_POST['post_category']);
    $post_status =  mysqli_real_escape_string($con, $_POST['post_status']);

    $post_image =  $_FILES['post_image']['name'];
    $post_image_temp =  $_FILES['post_image']['tmp_name'];

    $post_tags =  mysqli_real_escape_string($con, $_POST['post_tags']);
    $post_content = mysqli_real_escape_string($con, $_POST['post_content']);
    $post_comment_count = 0;
    $post_view_count =  0;
    $post_User = 'Admin';
    $inActive =  0;

    if (empty($post_title) || empty($post_content)) {
        echo "<script>alert('This field should not be empty. , " . "Title or Content" . "!');</script>";
    } else {

        $qry = "INSERT INTO posts(postAuthor,postTitle,postCategoryId,postStatus,postImage,postTags,postContent,postCommentCount,postViewCount,postDate,postUser,inActive)VALUES";
        $qry .= "('{$post_author}','{$post_title}','{$post_category}','{$post_status}','{$post_image}','{$post_tags}','{$post_content}','{$post_comment_count}','{$post_view_count}', now(),'{$post_User}','{$inActive}')";

        $new_category_qry = mysqli_query($con, $qry);
        if (!$new_category_qry) {
            die('Qry Failed' . mysqli_error($con));
        }
        
        move_uploaded_file($post_image_temp, "../images/$post_image");

        echo "<script>
        alert('Post has been save successfully!');
        window.location.href = 'posts.php';
        </script>";
        exit();
    }
}

if (isset($_POST['cancel_post'])) {
    echo "<script>
    window.location.href = 'posts.php';
    </script>";
    exit();
}

?>

<div class="col-xs-12">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="post_author">Author</label>
            <input type="text" class="form-control" name="post_author">
        </div>
        <div class="form-group">
            <label for="post_title">Title</label>
            <input type="text" class="form-control" name="post_title">
        </div>
        <div class="form-group">
            <label for="post_category">Category</label>
            <select class="form-control" name="post_category" id="post_category">
                <?php
                $qry = "SELECT * FROM categories where inActive = 0";
                $select_all_categories = mysqli_query($con, $qry);
                while ($row = mysqli_fetch_assoc($select_all_categories)) {
                    $cat_id = $row['catId'];
                    $cat_title = $row['catTitle'];
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="post_status">Status</label>
            <select class="form-control" name="post_status" id="post_status">
                <?php
                $status_array = ['Draft', 'Published'];
                foreach ($status_array as $status) {
                    echo "<option value='{$status}'>{$status}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="post_image">Image</label>
            <input type="file" class="form-control" name="post_image">
        </div>
        <div class="form-group">
            <label for="post_tags">Tags</label>
            <input type="text" class="form-control" name="post_tags">
        </div>
        <div class="form-group">
            <label for="post_content">Comment</label>
            <textarea class="form-control" name="post_content" rows="4"></textarea>
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="new_post" value="Add Post">
            <input class="btn btn-primary" type="submit" name="cancel_post" value="Cancel Post">
        </div>
    </form>
</div>
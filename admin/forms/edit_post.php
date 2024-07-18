<?php
if (isset($_GET['editPostId'])) {
    $post_id = $_GET['editPostId'];
    $qry = "SELECT * FROM posts WHERE postId = $post_id";
    $select_edit_post_qry = mysqli_query($con, $qry);
    $row = mysqli_fetch_assoc($select_edit_post_qry);

    $post_author = $row['postAuthor'];
    $post_title =  $row['postTitle'];
    $post_category =  $row['postCategoryId'];
    $post_status = $row['postStatus'];

    $post_image = $row['postImage'];

    $post_tags =  $row['postTags'];
    $post_content = $row['postContent'];
}


if (isset($_POST['edit_post'])) {
    editPost($con);
}
function editPost($con)
{
    $post_id = $_POST['post_id'];
    $post_author = mysqli_real_escape_string($con, $_POST['post_author']);
    $post_title =  mysqli_real_escape_string($con, $_POST['post_title']);
    $post_category =  mysqli_real_escape_string($con, $_POST['post_category']);
    $post_status =  mysqli_real_escape_string($con, $_POST['post_status']);

    $post_image =  $_FILES['post_image']['name'];
    $post_image_temp =  $_FILES['post_image']['tmp_name'];

    $post_tags =  mysqli_real_escape_string($con, $_POST['post_tags']);
    $post_content = mysqli_real_escape_string($con, $_POST['post_content']);


    if (empty($post_title) || empty($post_content)) {
        echo "<script>alert('This field should not be empty. , " . "Title or Content" . "!');</script>";
    } else {

        if (empty($post_image)) {
            $img_post_qry = "SELECT * FROM posts WHERE postId = $post_id";
            $select_post_img = mysqli_query($con, $img_post_qry);
            $row = mysqli_fetch_assoc($select_post_img);
            $post_image = $row['postImage'];
        } else {
            move_uploaded_file($post_image_temp, "../images/$post_image");
        }

        $qry = "UPDATE posts SET ";
        $qry .= "postAuthor = '{$post_author}', ";
        $qry .= "postTitle = '{$post_title}', ";
        $qry .= "postCategoryId = '{$post_category}', ";
        $qry .= "postImage = '{$post_image}', ";
        $qry .= "postTags = '{$post_tags}', ";
        $qry .= "postStatus = '{$post_status}', ";
        $qry .= "postContent = '{$post_author}' ";
        $qry .= "WHERE postId = {$post_id} ";

        $update_post_qry = mysqli_query($con, $qry);
        if (!$update_post_qry) {
            die('Qry Failed' . mysqli_error($con));
        }

        echo "<script>
        alert('Post has been updated successfully!');
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
            <input value=<?php if (isset($post_id)) {
                                echo $post_id;
                            } ?> class="form-control" type="hidden" name="post_id">
            <label for="post_author">Author</label>
            <input type="text" value=<?php if (isset($post_author)) {
                                            echo $post_author;
                                        } ?> class="form-control" name="post_author">
        </div>
        <div class="form-group">
            <label for="post_title">Title</label>
            <input type="text" value=<?php if (isset($post_title)) {
                                            echo $post_title;
                                        } ?> class="form-control" name="post_title">
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
                    $selected_cat_id = ($cat_id == $post_category) ? 'selected' : '';
                    echo "<option value='{$cat_id}' {$selected_cat_id}>{$cat_title}</option>";
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
                    $selected_status = ($status == $post_status) ? 'selected' : '';
                    echo "<option value='{$status}' {$selected_status}>{$status}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="post_image">Current Image</label>
            <img class='img-responsive' src="../images/<?php echo $post_image; ?>" width="100" alt="Current Image">
        </div>
        <div class="form-group">
            <label for="post_image">Change Image</label>
            <input type="file" class="form-control" name="post_image">
        </div>
        <div class="form-group">
            <label for="post_tags">Tags</label>
            <input type="text" value=<?php if (isset($post_tags)) {
                                            echo $post_tags;
                                        } ?> class="form-control" name="post_tags">
        </div>
        <div class="form-group">
            <label for="post_content">Comment</label>
            <textarea class="form-control" name="post_content" rows="4"><?php if (isset($post_content)) {
                                                                            echo $post_content;
                                                                        } ?></textarea>
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="edit_post" value="Update Post">
            <input class="btn btn-primary" type="submit" name="cancel_post" value="Cancel Post">
        </div>
    </form>
</div>
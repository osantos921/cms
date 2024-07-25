<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_GET['deletePostId'])) {
    getDeletePost($con);
}

function getDeletePost($con)
{
    $post_id = $_GET['deletePostId'];
    $qry = "DELETE FROM posts WHERE ";
    $qry .= "postId = '{$post_id}'";
    $delete_post_qry =  mysqli_query($con, $qry);
    if (!$delete_post_qry) {
        die('Qry Failed' . mysqli_error($con));
    }

    echo "<script>
    window.location.href = 'posts.php';
    </script>";
    exit();
}

if (isset($_GET['published_Id'])) {
    getPublished($con);
}

function getPublished($con)
{
    $post_id = $_GET['published_Id'];
    $qry = "UPDATE posts SET ";
    $qry .= "postStatus = 'Published' WHERE ";
    $qry .= "postId = '{$post_id}'";
    $delete_post_qry =  mysqli_query($con, $qry);
    if (!$delete_post_qry) {
        die('Qry Failed' . mysqli_error($con));
    }

    echo "<script>
    window.location.href = 'posts.php';
    </script>";
    exit();
}

if (isset($_POST['published_selected'])) {
    if (isset($_POST['postCheckbox'])) {
        foreach ($_POST['postCheckbox'] as $p_id) {
            getPublished_Selected($con, $p_id);
        }
        echo "<script>
        window.location.href = 'posts.php';
        </script>";
        exit();
    }
}

function getPublished_Selected($con, $id)
{
    $qry = "UPDATE posts SET ";
    $qry .= "postStatus = 'Published' WHERE ";
    $qry .= "postId = '{$id}'";
    $delete_post_qry =  mysqli_query($con, $qry);
    if (!$delete_post_qry) {
        die('Qry Failed' . mysqli_error($con));
    }
}

if (isset($_POST['draft_selected'])) {
    if (isset($_POST['postCheckbox'])) {
        foreach ($_POST['postCheckbox'] as $p_id) {
            getDraft_Selected($con, $p_id);
        }
        echo "<script>
        window.location.href = 'posts.php';
        </script>";
        exit();
    }
}

function getDraft_Selected($con, $id)
{
    $qry = "UPDATE posts SET ";
    $qry .= "postStatus = 'Draft' WHERE ";
    $qry .= "postId = '{$id}'";
    $delete_post_qry =  mysqli_query($con, $qry);
    if (!$delete_post_qry) {
        die('Qry Failed' . mysqli_error($con));
    }
}

if (isset($_POST['delete_selected'])) {
    if (isset($_POST['postCheckbox'])) {
        foreach ($_POST['postCheckbox'] as $p_id) {
            getDeletePost_Selected($con, $p_id);
        }
        echo "<script>
        window.location.href = 'posts.php';
        </script>";
        exit();
    }
}

function getDeletePost_Selected($con, $id)
{
    $qry = "DELETE FROM posts WHERE ";
    $qry .= "postId = '{$id}'";
    $delete_post_qry =  mysqli_query($con, $qry);
    if (!$delete_post_qry) {
        die('Qry Failed' . mysqli_error($con));
    }

}

?>

<script>
    function redirectToGet() {
        window.location.href = 'posts.php?source_post=add_post';
    }

    function toggleSelectAll(source) {
        checkboxes = document.getElementsByName('postCheckbox[]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = source.checked;
        }
    }

    function confirmDelete() {
        return confirm('Are you sure you want to delete this comment?');
    }

    function confirmDeleteIfNeeded(event) {
        if (event.submitter && event.submitter.name === 'delete_selected') {
            return confirmDelete();
        }
        return true;
    }

</script>

<div class="col-xs-12">
    <form action="" method="post" onsubmit="return confirmDeleteIfNeeded(event)">
        <div class="form-group">
            <button class="btn btn-primary" type="button" onclick="redirectToGet()">Add Posts</button>
            <button class="btn btn-success" type="submit" name="draft_selected">Draft Selected</button>
            <button class="btn btn-success" type="submit" name="published_selected">Published Selected</button>
            <button class="btn btn-danger" type="submit" name="delete_selected">Delete Selected</button>
        </div>
        <div class="form-group">
            <table class="table table-bordered table-hover">
                <thread>
                    <tr>
                        <th><input type="checkbox" onclick="toggleSelectAll(this)"></th>
                        <th>ID</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Category ID</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Tags</th>
                        <th>Content</th>
                        <th>Date</th>
                        <th>Published</th>
                        <th>View Post</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thread>
                <tbody>
                    <?php
                    //ALl Posts
                    $qry = "SELECT * FROM posts where inactive = 0 ORDER BY postId DESC";
                    $select_all_posts = mysqli_query($con, $qry);
                    while ($row = mysqli_fetch_assoc($select_all_posts)) {
                        $post_id =  $row['postId'];
                        $post_author =  $row['postAuthor'];
                        $post_title =  $row['postTitle'];
                        $post_category =  $row['postCategoryId'];
                        $category_title =  getCategory($con, $row['postCategoryId']);
                        $post_status =  $row['postStatus'];
                        $post_image =  $row['postImage'];
                        $post_tags =  $row['postTags'];
                        $post_content =  $row['postContent'];
                        $post_date =  $row['postDate'];
                        echo  "<tr>";
                        echo  "<td><input type='checkbox' name='postCheckbox[]' value='{$post_id}'></td>";
                        echo  "<td>{$post_id}</td>";
                        echo  "<td>{$post_author}</td>";
                        echo  "<td>{$post_title}</td>";
                        echo  "<td>{$post_category}</td>";
                        echo  "<td>{$category_title}</td>";
                        echo  "<td>{$post_status}</td>";
                        echo  "<td><img class='img-responsive' width='100' src='../images/{$post_image}' alt='Image'><br>Path: {$post_image}</td>";
                        echo  "<td>{$post_tags}</td>";
                        echo  "<td>{$post_content}</td>";
                        echo  "<td>{$post_date}</td>";
                        echo  "<td> <a href='posts.php?published_Id={$post_id}'>Published</a></td>";
                        echo  "<td> <a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                        echo  "<td> <a href='posts.php?source_post=edit_post&editPostId={$post_id}'>Edit</a></td>";
                        echo  "<td> <a onClick=\"javascript: return confirm('Are you sure to delete?') \" href='posts.php?deletePostId={$post_id}'>Delete</a></td>";
                        echo  "</tr>";
                    }

                    function getCategory($con, int $catId)
                    {
                        $qry = "SELECT * FROM categories WHERE catId = $catId AND inactive = 0";
                        $select_all_category = mysqli_query($con, $qry);
                        $row = mysqli_fetch_assoc($select_all_category);
                        return $row['catTitle'] ?? '';
                    }

                    ?>

                </tbody>
            </table>
        </div>
    </form>
</div>
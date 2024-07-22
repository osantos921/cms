<?php

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
?>

<script>
    function redirectToGet() {
        window.location.href = 'posts.php?source_post=add_post';
    }
</script>
<div class="col-xs-12">
    <div class="form-group">
        <button class="btn btn-primary" type="button" onclick="redirectToGet()">Add Posts</button>
    </div>
    <table class="table table-bordered table-hover">
        <thread>
            <tr>
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
                $category_title =  getCategory($con,$row['postCategoryId']);
                $post_status =  $row['postStatus'];
                $post_image =  $row['postImage'];
                $post_tags =  $row['postTags'];
                $post_content =  $row['postContent'];
                $post_date =  $row['postDate'];
                echo  "<tr>";
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
                echo  "<td> <a href='posts.php?source_post=edit_post&editPostId={$post_id}'>Edit</a></td>";
                echo  "<td> <a href='posts.php?deletePostId={$post_id}'>Delete</a></td>";
                echo  "</tr>";                
            }

            function getCategory($con,int $catId)
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
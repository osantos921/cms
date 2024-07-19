<?php
/*
if (isset($_GET['deletePostId'])) {
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
} */

if(isset($_POST['submit_approved']))
{
    getApprove($con);
}

if(isset($_POST['submit_unapproved']))
{
    getUnApprove($con);
}

if(isset($_POST['submit_delete']))
{
    getDelete($con);
}
function getApprove($con)
{
    $comment_id = $_POST['c_Id'];
    $qry = "UPDATE comments SET ";
    $qry .= "commentStatus = 'Approved' ";
    $qry .= "WHERE commentId = $comment_id";
    $approved_comment_qry =  mysqli_query($con, $qry);
    if (!$approved_comment_qry) {
        die('Qry Failed' . mysqli_error($con));
    }
    echo "<script>
    window.location.href = 'comments.php';
    </script>";
    exit();
}
function getUnApprove($con)
{
    $comment_id = $_POST['c_Id'];
    $qry = "UPDATE comments SET ";
    $qry .= "commentStatus = 'UnApproved' ";
    $qry .= "WHERE commentId = $comment_id";
    $unapproved_comment_qry =  mysqli_query($con, $qry);
    if (!$unapproved_comment_qry) {
        die('Qry Failed' . mysqli_error($con));
    }
    echo "<script>
    window.location.href = 'comments.php';
    </script>";
    exit();
}
function getDelete($con)
{
    $comment_id = $_POST['c_Id'];
    $qry = "DELETE FROM comments ";
    $qry .= "WHERE commentId = $comment_id";
    $delete_comment_qry =  mysqli_query($con, $qry);
    if (!$delete_comment_qry) {
        die('Qry Failed' . mysqli_error($con));
    }
    echo "<script>
    window.location.href = 'comments.php';
    </script>";
    exit();
}
?>

<div class="col-xs-12">   
    <table class="table table-bordered table-hover">
        <thread>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Email</th>
                <th>Comment</th>
                <th>Date</th>
                <th>Status</th>
                <th>InActive</th>
                <th>Approved</th>
                <th>UnApproved</th>
                <th>Delete</th>
            </tr>
        </thread>
        <tbody>
            <?php
            //ALl Posts
            $qry = "SELECT * FROM comments where inactive = 0";
            $select_all_comments = mysqli_query($con, $qry);
            while ($row = mysqli_fetch_assoc($select_all_comments)) {
                $comment_id =  $row['commentId'];
                $comment_post_title =  getPost($con, $row['commentPostId']);
                $comment_author =  $row['commentAuthor'];
                $comment_email =  $row['commentEmail'];
                $comment_content =  $row['commentContent'];
                $comment_date =  $row['commentDate'];
                $comment_status =  $row['commentStatus'];
                $inActive =  $row['inActive'];
                echo  "<tr>";
                echo  "<td>{$comment_id}</td>";
                echo  "<td>{$comment_post_title}</td>";
                echo  "<td>{$comment_author}</td>";
                echo  "<td>{$comment_email}</td>";
                echo  "<td>{$comment_content}</td>";
                echo  "<td>{$comment_date}</td>";
                echo  "<td>{$comment_status}</td>";
                echo  "<td>{$inActive}</td>";
                echo "<td>
                        <form method='post' action='' enctype='multipart/form-data'>
                            <input type='hidden' name='source_comment' value='Approved'>
                            <input type='hidden' name='c_Id' value='{$comment_id}'>
                            <input class='btn btn-primary' type='submit' name='submit_approved' value='Approve'>
                        </form>
                    </td>";
                echo "<td>
                        <form method='post' action='' enctype='multipart/form-data'>
                            <input type='hidden' name='source_comment' value='UnApproved'>
                            <input type='hidden' name='c_Id' value='{$comment_id}'>
                            <input class='btn btn-primary' type='submit' name='submit_unapproved' value='UnApprove'>
                        </form>
                    </td>";
                echo "<td>
                        <form method='post' action='' enctype='multipart/form-data'>
                            <input type='hidden' name='source_comment' value='Delete'>
                            <input type='hidden' name='c_Id' value='{$comment_id}'>
                            <input class='btn btn-primary' type='submit' name='submit_delete' value='Delete'>
                        </form>
                    </td>";
                echo  "</tr>";
            }

            function getPost($con, int $postId)
            {
                $qry = "SELECT * FROM posts WHERE postId = $postId AND inactive = 0";
                $select_all_category = mysqli_query($con, $qry);
                $row = mysqli_fetch_assoc($select_all_category);
                return $row['postTitle'] ?? '';
            }

            ?>

        </tbody>
    </table>
</div>
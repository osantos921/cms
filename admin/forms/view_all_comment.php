<?php

if (isset($_POST['submit_approved'])) {
    getApprove($con);
}

if (isset($_POST['submit_unapproved'])) {
    getUnApprove($con);
}

if (isset($_POST['submit_delete'])) {
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


if (isset($_POST['approved_selected'])) {
    if (isset($_POST['postCheckbox'])) {
        foreach ($_POST['postCheckbox'] as $c_id) {
            getApprove_selected($con, $c_id);
        }
        echo "<script>
        window.location.href = 'comments.php';
        </script>";
        exit();
    }
}
function getApprove_selected($con,$id)
{
    $qry = "UPDATE comments SET ";
    $qry .= "commentStatus = 'Approved' ";
    $qry .= "WHERE commentId = $id";
    $approved_comment_qry =  mysqli_query($con, $qry);
    if (!$approved_comment_qry) {
        die('Qry Failed' . mysqli_error($con));
    }  
}
if (isset($_POST['unapproved_selected'])) {
    if (isset($_POST['postCheckbox'])) {
        foreach ($_POST['postCheckbox'] as $c_id) {
            getUnApprove_selected($con, $c_id);
        }
        echo "<script>
        window.location.href = 'comments.php';
        </script>";
        exit();
    }
}
function getUnApprove_selected($con,$id)
{
    $qry = "UPDATE comments SET ";
    $qry .= "commentStatus = 'UnApproved' ";
    $qry .= "WHERE commentId = $id";
    $approved_comment_qry =  mysqli_query($con, $qry);
    if (!$approved_comment_qry) {
        die('Qry Failed' . mysqli_error($con));
    }  
}
if (isset($_POST['delete_selected'])) {
    if (isset($_POST['postCheckbox'])) {
        foreach ($_POST['postCheckbox'] as $c_id) {
            getDelete_selected($con, $c_id);
        }
        echo "<script>
        window.location.href = 'comments.php';
        </script>";
        exit();
    }
}
function getDelete_selected($con,$id)
{
    $qry = "DELETE from comments ";
    $qry .= "WHERE commentId = $id";
    $approved_comment_qry =  mysqli_query($con, $qry);
    if (!$approved_comment_qry) {
        die('Qry Failed' . mysqli_error($con));
    }  
}

?>

<script>  
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
            <input class="btn btn-success" type="submit" name="approved_selected" value="Approved Selected">
            <input class="btn btn-success" type="submit" name="unapproved_selected" value="UnAprroved Selected">            
            <input class="btn btn-danger"  type="submit" name="delete_selected" value="Delete Selected">
        </div>
        <table class="table table-bordered table-hover">
            <thread>
                <tr>
                    <th><input type="checkbox" onclick="toggleSelectAll(this)"></th>
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
                $qry = "SELECT * FROM comments WHERE inactive = 0 ORDER BY commentId DESC";
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
                    echo  "<td><input type='checkbox' name='postCheckbox[]' value='{$comment_id}'></td>";
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
                            <input class='btn btn-success' type='submit' name='submit_approved' value='Approve'>
                        </form>
                    </td>";
                    echo "<td>
                        <form method='post' action='' enctype='multipart/form-data'>
                            <input type='hidden' name='source_comment' value='UnApproved'>
                            <input type='hidden' name='c_Id' value='{$comment_id}'>
                            <input class='btn btn-success' type='submit' name='submit_unapproved' value='UnApprove'>
                        </form>
                    </td>";
                    echo "<td>
                        <form method='post' action='' enctype='multipart/form-data' onsubmit='return confirmDelete()'>
                            <input type='hidden' name='source_comment' value='Delete'>
                            <input type='hidden' name='c_Id' value='{$comment_id}'>
                            <input class='btn btn-danger'  type='submit' name='submit_delete' value='Delete'>
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
    </form>
</div>
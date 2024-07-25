<?php

if (isset($_POST['update_password'])) {
    // getCreateUser($con);
    postChange_password($con);
}

function postChange_password($con)
{
    if (!isset($_GET['u_id'])) {       
        echo "<script>
            alert('User ID not set!');
            </script>";
        return;
    }

    $user_id =  $_GET['u_id'];
    $password = $_POST['current_password'];   
    $db_user_password = GetUserPassword($con, $user_id);
    
    if (verifyPassword($password, $db_user_password)) {

        $salt =  getRandSalt($con);
        $new_password = $_POST['new_password'];
        $new_password = crypt($new_password, $salt);
        $qry = "UPDATE users SET ";
        $qry .= "userPassword= '{$new_password}' WHERE ";
        $qry .= "userId= $user_id";

        $changepassword_qry =  mysqli_query($con, $qry);
        if (!$changepassword_qry) {
            die('Qry Failed' . mysqli_error($con));
        }

        echo "<script>
            alert('Password has been successfully changed!');
            window.location.href = 'index.php';
            </script>";
        exit();
    } else {
        echo "<script>
            alert('Incorrect Current Password!');
            </script>";
        return;
    }
}



if (isset($_POST['cancel_user'])) {
    echo "<script>
    window.location.href = 'index.php';
    </script>";
    exit();
}
?>

<div class="col-xs-12">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input class="form-control" type="hidden" name="user_id">
            <label for="current_password">Current Password</label>
            <input type="password" class="form-control" name="current_password">
        </div>
        <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" class="form-control" name="new_password">
        </div>
        <div class="form-group">
            <input class="btn btn-custom btn-lg btn-block btn-primary" type="submit" name="update_password" value="Update Password">
            <input class="btn btn-custom btn-lg btn-block btn-primary" type="submit" name="cancel_user" value="Cancel">
        </div>
    </form>
</div>
<?php

if (isset($_POST['create_user'])) {
    getCreateUser($con);
}

function getCreateUser($con)
{
    $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    $user_password = mysqli_real_escape_string($con, $_POST['user_password']);
    $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $user_image =  $_FILES['user_image']['name'];
    $user_image_temp =  $_FILES['user_image']['tmp_name'];
    $user_role = 'Subscriber';
    //$rand_salt = 'user';
    $inactive = 0;

    $rand_salt = getRandSalt($con);
    $user_password = crypt($user_password,$rand_salt);

    echo  $rand_salt;
    if (empty($user_image)) {      
        $user_image = 'user.jpg';
    } else {
        move_uploaded_file($user_image_temp, "../images/$user_image");
    }

    if (empty($user_name) || empty($user_password)) {
        echo "<script>alert('This field should not be empty. , " . "User Name or Password" . "!');</script>";
    } else {

        $qry = "INSERT INTO users(userName,userPassword,firstName,lastName,userImage,userEmail,userRole,inActive)VALUES";
        $qry .="('{$user_name}','{$user_password}','{$first_name}','{$last_name}','{$user_image}','{$user_email}','{$user_role}',$inactive)";
      
        $save_user_qry =  mysqli_query($con, $qry);
        if (!$save_user_qry) {
            die('Qry Failed' . mysqli_error($con));
        }

        echo "<script>
            alert('User has been saved successfully!');
            window.location.href = 'index.php';
            </script>";
        exit();
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
            <label for="user_name">User Name</label>
            <input type="text" class="form-control" name="user_name">
        </div>
        <div class="form-group">
            <label for="user_password">Password</label>
            <input type="password" class="form-control" name="user_password">
        </div>
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" name="first_name">
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" name="last_name">
        </div>
        <div class="form-group">
            <label for="user_email">User Email</label>
            <input type="email" class="form-control" name="user_email">
        </div>
        <div class="form-group">
            <label for="user_image">User Image</label>
            <input type="file" class="form-control" name="user_image">
        </div>              
        <div class="form-group">
            <input class="btn btn-custom btn-lg btn-block" type="submit" name="create_user" value="Register">
            <input class="btn btn-custom btn-lg btn-block" type="submit" name="cancel_user" value="Cancel">
        </div>
    </form>
</div>
<?php

if (isset($_POST['save_user'])) {
    getSaveUser($con);
}

function getSaveUser($con)
{
    $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    $user_password = mysqli_real_escape_string($con, $_POST['user_password']);
    $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $user_image =  $_FILES['user_image']['name'];
    $user_image_temp =  $_FILES['user_image']['tmp_name'];
    $user_role = mysqli_real_escape_string($con, $_POST['user_role']);
    $inactive = 0;

    $rand_salt = getRandSalt($con);
    $user_password = crypt($user_password,$rand_salt);

    if (empty($user_image)) {

        if ($user_role != 'Admin') {
            $user_image = 'user.jpg';
        } else {
            $user_image = 'admin.jpg';
        }
        
    } else {
        move_uploaded_file($user_image_temp, "../images/$user_image");
    }

    if (empty($user_name) || empty($user_password)) {
        echo "<script>alert('This field should not be empty. , " . "User Name or Password" . "!');</script>";
    } else {

        $qry = "INSERT INTO users(userName,userPassword,firstName,lastName,userImage,userEmail,userRole,inActive)VALUES";
        $qry .= "('{$user_name}','{$user_password}','{$first_name}','{$last_name}','{$user_image}','{$user_email}','{$user_role}',$inactive)";

        $save_user_qry =  mysqli_query($con, $qry);
        if (!$save_user_qry) {
            die('Qry Failed' . mysqli_error($con));
        }

        echo "<script>
            alert('User has been saved successfully!');
            window.location.href = '../admin/users.php';
            </script>";
        exit();
    }
}


if (isset($_POST['cancel_user'])) {
    echo "<script>
    window.location.href = '../admin/users.php';
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
            <label for="user_role">Role</label>
            <select class="form-control" name="user_role" id="user_role">
                <?php
                $role_array = ['Admin', 'Subsciber'];
                foreach ($role_array as $role) {
                    echo "<option value='{$role}'>{$role}</option>";
                }
                ?>
            </select>

        </div>      
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="save_user" value="Save User">
            <input class="btn btn-primary" type="submit" name="cancel_user" value="Cancel User">
        </div>
    </form>
</div>
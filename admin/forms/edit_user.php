<?php

if (isset($_GET['u_Id'])) {
    $userId = $_GET['u_Id'];
    $qry = "SELECT * FROM users WHERE userId = $userId";
    $select_edit_user_qry = mysqli_query($con, $qry);
    $row = mysqli_fetch_assoc($select_edit_user_qry);

    $user_id = $row['userId'];
    $user_name = $row['userName'];
    $user_password = $row['userPassword'];
    $first_name = $row['firstName'];
    $last_name = $row['lastName'];
    $user_email = $row['userEmail'];
    $user_image = $row['userImage'];
    $user_role = $row['userRole'];
    $rand_salt = $row['randSalt'];
    $inactive = 0;
}

?>


<div class="col-xs-12">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input value=<?php if (isset($user_id)) {
                                echo $user_id;
                            } ?> class="form-control" type="hidden" name="user_id">
            <label for="user_name">User Name</label>
            <input type="text" value=<?php if (isset($user_name)) {
                                            echo $user_name;
                                        } ?> class="form-control" name="user_name">
        </div>
        <div class="form-group">
            <label for="user_password">Password</label>
            <input type="text" value=<?php if (isset($user_password)) {
                                            echo $user_password;
                                        } ?> class="form-control" name="user_password">
        </div>
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" value=<?php if (isset($first_name)) {
                                            echo $first_name;
                                        } ?> class="form-control" name="first_name">
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" value=<?php if (isset($last_name)) {
                                            echo $last_name;
                                        } ?> class="form-control" name="last_name">
        </div>
        <div class="form-group">
            <label for="user_email">User Email</label>
            <input type="email" value=<?php if (isset($user_email)) {
                                            echo $user_email;
                                        } ?> class="form-control" name="user_email">
        </div>
        <div class="form-group">
            <label for="user_image">Current Image</label>
            <img class='img-responsive' src="../images/<?php echo $user_image; ?>" width="100" alt="Current Image">
        </div>
        <div class="form-group">
            <label for="user_image">Change Image</label>
            <input type="file" class="form-control" name="user_image">
        </div>
        <div class="form-group">
            <label for="user_role">Role</label>
            <select class="form-control" name="user_role" id="user_role">
                <?php
                $role_array = ['Admin', 'Subsciber'];
                foreach ($role_array as $role) {
                    $userroleselected = ($role == $user_role) ? 'selected' : '';
                    echo "<option value='{$role}' {$userroleselected}>{$role}</option>";
                }
                ?>
            </select>

        </div>
        <div class="form-group">
            <label for="rand_salt">Salt</label>
            <input type="text" value=<?php if (isset($rand_salt)) {
                                            echo $rand_salt;
                                        } ?> class="form-control" name="rand_salt">
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
            <input class="btn btn-primary" type="submit" name="cancel_user" value="Cancel User">
        </div>
    </form>
</div>

<?php

if (isset($_POST['update_user'])) {
    getUpdateUser($con);
}
function getUpdateUser($con)
{
    
    $user_id = $_POST['user_id'];
    $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    $user_password = mysqli_real_escape_string($con, $_POST['user_password']);
    $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $user_image =  $_FILES['user_image']['name'];
    $user_image_temp =  $_FILES['user_image']['tmp_name'];
    $user_role = mysqli_real_escape_string($con, $_POST['user_role']);
    $rand_salt = mysqli_real_escape_string($con, $_POST['rand_salt']);
    $inactive = 0;

    if (empty($user_image)) {
        $img_user_qry = "SELECT * FROM users WHERE userId = $user_id";
        $select_user_img = mysqli_query($con, $img_user_qry);
        $row = mysqli_fetch_assoc($select_user_img);
        $user_image = $row['userImage'];
    } else {
        move_uploaded_file($user_image_temp, "../images/$user_image");
    }

    if (empty($user_name) || empty($user_password)) {
        echo "<script>alert('This field should not be empty. , " . "User Name or Password" . "!');</script>";
    } else {
        $qry = "UPDATE users SET ";
        $qry .= "userName = '{$user_name}', ";
        $qry .= "userPassword = '{$user_password}', ";
        $qry .= "firstName = '{$first_name}', ";
        $qry .= "lastName = '{$last_name}', ";
        $qry .= "userImage = '{$user_image}', ";
        $qry .= "userEmail = '{$user_email}', ";
        $qry .= "userRole = '{$user_role}', ";
        $qry .= "randSalt = '{$rand_salt}', ";
        $qry .= "inActive = '{$inactive}' ";
        $qry .= "WHERE userId = '{$user_id}'";

        $update_user_qry =  mysqli_query($con, $qry);
        if (!$update_user_qry) {
            die('Qry Failed' . mysqli_error($con));
        }

        echo "<script>
            alert('User has been updated successfully!');
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
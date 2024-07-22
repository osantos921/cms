<?php

if (isset($_SESSION['userId'])) {

    $user_id =  $_SESSION['userId'];
    $user_name =  $_SESSION['username'];
    $first_name = $_SESSION['firstName'];
    $last_name =  $_SESSION['lastName'];
    $user_email = $_SESSION['userEmail'];
    $user_image =  $_SESSION['userImage'];
    $user_role =  $_SESSION['userRole'];
    $inactive = 0;
}

?>


<div class="col-xs-12">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="user_image"></label>
            <img class='img-responsive' src="../images/<?php echo $user_image; ?>" width="100" alt="Current Image">
        </div>

        <div class="form-group">
            <input value=<?php if (isset($user_id)) {
                                echo $user_id;
                            } ?> class="form-control" type="hidden" name="user_id" readonly>
            <label for="user_name">User Name</label>
            <input type="text" value=<?php if (isset($user_name)) {
                                            echo $user_name;
                                        } ?> class="form-control" name="user_name" readonly>
        </div>
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" value=<?php if (isset($first_name)) {
                                            echo $first_name;
                                        } ?> class="form-control" name="first_name" readonly>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" value=<?php if (isset($last_name)) {
                                            echo $last_name;
                                        } ?> class="form-control" name="last_name" readonly>
        </div>
        <div class="form-group">
            <label for="user_email">User Email</label>
            <input type="email" value=<?php if (isset($user_email)) {
                                            echo $user_email;
                                        } ?> class="form-control" name="user_email" readonly>
        </div>
        <div class="form-group">
            <label for="user_role">Role</label>
            <input type="text" value=<?php if (isset($user_role)) {
                                            echo $user_role;
                                        } ?> class="form-control" name="user_role" readonly>

        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">        
        </div>
    </form>
</div>

<?php

if (isset($_POST['update_profile'])) {
    echo "<script>
    window.location.href = 'users.php?source_user=edit_user&u_Id={$user_id}';
    </script>";
    exit();
    
}

?>
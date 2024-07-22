<?php

if (isset($_GET['deleteUserId'])) {
    $user_id = $_GET['deleteUserId'];
    $qry = "DELETE FROM users WHERE ";
    $qry .= "userId = '{$user_id}'";
    $delete_user_qry =  mysqli_query($con, $qry);
    if (!$delete_user_qry) {
        die('Qry Failed' . mysqli_error($con));
    }

    echo "<script>
    window.location.href = 'users.php';
    </script>";
    exit();
} 

?>

<script>
    function redirectToGet() {
        window.location.href = 'users.php?source_user=add_user';
    }
</script>
<div class="col-xs-12">
    <div class="form-group">
        <button class="btn btn-primary" type="button" onclick="redirectToGet()">Add User</button>
    </div>
    <table class="table table-bordered table-hover">
        <thread>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Password</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Image</th>
                <th>Role</th>
                <th>Rand Salt</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thread>
        <tbody>
            <?php
            //ALl Posts
            $qry = "SELECT * FROM users where inactive = 0 ORDER BY userId DESC";
            $select_all_users = mysqli_query($con, $qry);
            while ($row = mysqli_fetch_assoc($select_all_users)) {
                $user_id =  $row['userId'];
                $username =  $row['userName'];
                $user_password =  $row['userPassword'];
                $first_name =  $row['firstName'];
                $last_name =  $row['lastName'];
                $user_email =  $row['userEmail'];
                $user_image =  $row['userImage'];
                $user_role =  $row['userRole'];
                $rand_salt =  $row['randSalt'];
                $inactive =  $row['inActive'];
                echo  "<tr>";
                echo  "<td>{$user_id}</td>";
                echo  "<td>{$username}</td>";
                echo  "<td>{$user_password}</td>";
                echo  "<td>{$first_name}</td>";
                echo  "<td>{$last_name}</td>";
                echo  "<td>{$user_email}</td>";
                echo  "<td><img class='img-responsive' width='100' src='../images/{$user_image}' alt='Image'><br>Path: {$user_image}</td>";
                echo  "<td>{$user_role}</td>";
                echo  "<td>{$rand_salt}</td>";
                echo  "<td> <a href='users.php?source_user=edit_user&u_Id={$user_id}'>Edit</a></td>";
                echo  "<td> <a href='users.php?deleteUserId={$user_id}'>Delete</a></td>";
                echo  "</tr>";
            }
        
            ?>

        </tbody>
    </table>
</div>
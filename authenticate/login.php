<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>

<?php include "../includes/db.php"; ?>
<?php include "../functions/utilities.php"; ?>

<?php
function login_user($con)
{

    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Fetch user data from the database
    $qry = "SELECT * FROM users WHERE userName = '{$username}' and inActive = 0";
    $select_user_qry = mysqli_query($con, $qry);

    if (!$select_user_qry) {
        die('Query Failed' . mysqli_error($con));
    }

    $user_found = mysqli_fetch_assoc($select_user_qry);

    if ($user_found) {
        $db_user_id = $user_found['userId'];
        $db_username = $user_found['userName'];
        $db_user_password = $user_found['userPassword'];
        $db_first_name = $user_found['firstName'];
        $db_last_name = $user_found['lastName'];
        $db_user_role = $user_found['userRole'];
        $db_user_email = $user_found['userEmail'];
        $db_user_image = $user_found['userImage'];

        $salt = getRandSalt($con);
        // Verify the password
        if (verifyPassword($password,$db_user_password)) {
            // Set session variables
            $_SESSION['userId'] = $db_user_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['firstName'] = $db_first_name;
            $_SESSION['lastName'] = $db_last_name;
            $_SESSION['userRole'] = $db_user_role;
            $_SESSION['userEmail'] = $db_user_email;
            $_SESSION['userImage'] = $db_user_image;

            // Redirect to dashboard or home page
            if ($db_user_role == "Admin") {
                header("Location: ../admin/index.php");
            } else {
                header("Location: ../index.php");
            }
            exit();
        } else {
            header("Location: ../index.php");
        }
    } else {
        header("Location: ../index.php");
    }
}


if (isset($_POST['login'])) {
    login_user($con);
}

if (isset($_POST['signup'])) {
    header("Location: ../user.php");
}

function getUser()
{
    if (isset($_SESSION['userId'])) {
        return isset($_SESSION['firstName'], $_SESSION['lastName']) ? $_SESSION['firstName'] . " " . $_SESSION['lastName'] : "";
    }
    return "";
}

?>
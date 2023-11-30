<?php
include './control-panel/config.php';
// function get_safe_value($conn,$str)
// {
//     if($str!='')
//     {
//         return mysqli_real_escape_string($conn,$str);
//     }
// }
// if (isset($_POST['register'])) {
//     $username         = get_safe_value($conn, $_POST['user-name']);
//     $user_password    = get_safe_value($conn, $_POST['user-password']);
//     $user_email       = get_safe_value($conn, $_POST['user-email']);
//     $user_number      = get_safe_value($conn, $_POST['user-number']);
//     $choose_security  = get_safe_value($conn, $_POST['security']);
//     $security_ans     = get_safe_value($conn, $_POST['security_ans']);
//     $hashed_password  = password_hash($user_password, PASSWORD_DEFAULT);
//     $sql_registration = "INSERT INTO user_login_details (user_name, user_email, user_password, user_phone, choose_security, security_ans)
//                          VALUES ('$username', '$user_email', '$hashed_password', '$user_number', '$choose_security', '$security_ans')";

//     if (mysqli_query($conn, $sql_registration)) {
//         $_SESSION['message'] = 'Registration Successful';
//         header('location: login.php');
//         exit();
//     } else {
//         $_SESSION['message'] = 'Server Error. Please try again.';
//     }
    
if (isset($_POST['register'])) {
    $username = get_safe_value($conn, $_POST['user-name']);
    $user_password = get_safe_value($conn, $_POST['user-password']);
    $user_email = get_safe_value($conn, $_POST['user-email']);
    $user_number = get_safe_value($conn, $_POST['user-number']);
    $choose_security = get_safe_value($conn, $_POST['security']);
    $security_ans = get_safe_value($conn, $_POST['security_ans']);
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

    // Check if email already exists
    $check_email_query = "SELECT user_email FROM user_login_details WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $check_email_query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['message'] = 'Email already exists.';
        header('location: register_new_user.php'); // Redirect back to registration form
        exit();
    }

    // Email doesn't exist, proceed with registration
    $sql_registration = "INSERT INTO user_login_details (user_name, user_email, user_password, user_phone, choose_security, security_ans)
                         VALUES ('$username', '$user_email', '$hashed_password', '$user_number', '$choose_security', '$security_ans')";

    if (mysqli_query($conn, $sql_registration)) {
        $_SESSION['message'] = 'Registration Successful';
        header('location: login.php');
        exit();
    } else {
        $_SESSION['message'] = 'Server Error. Please try again.';
    }

} elseif (isset($_POST['login'])) {
    $user_email = get_safe_value($conn,$_POST['user-email']);
    $user_password = get_safe_value($conn,$_POST['user-password']);

    $sql = "SELECT * FROM user_login_details WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($user_password, $row['user_password'])) {
            $_SESSION['auth'] = true;

            // Corrected code to access user data from $row
            $user_id = $row['user_id'];
            $u_name = $row['user_name'];
            $u_email = $row['user_email'];

            $_SESSION['auth_user'] = [
                'user_id' => $user_id,
                'name' => $u_name,
                'email' => $u_email,
            ];

            $_SESSION['message'] = 'Login Successful !';
            header('location: index.php');
            exit();
        } else {
            header('location: login.php');
            $_SESSION['message'] = 'Invalid Please try again !';
        }
    } else {
        header('location: login.php');
        $_SESSION['message'] = 'User not found. Please check your email address.';
    }

} elseif (isset($_POST['verify_password'])) {
    $update_security = get_safe_value($conn, $_POST['update_security']);
    $security_answer = get_safe_value($conn, $_POST['security_answer']);
    $update_password = get_safe_value($conn, $_POST['update_password']);

    $sql = "SELECT * FROM user_login_details WHERE choose_security = '$update_security' AND security_ans = '$security_answer'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['user_id'];
        $hashed_password = password_hash($update_password, PASSWORD_DEFAULT);
        $update_sql = "UPDATE user_login_details SET user_password = '$hashed_password' WHERE user_id = $user_id";
        $update_result = mysqli_query($conn, $update_sql);

        if ($update_result) {
            $_SESSION['message'] = 'Password changed successfully';
            header('location: login.php');
            exit();
        } else {
            header('location: login.php');
            $_SESSION['message'] = 'Failed to change password. Please try again later.';
        }
    } else {
        header('location: login.php');
        $_SESSION['message'] = 'Security question or answer is incorrect. Please try again.';
    }
}
?>

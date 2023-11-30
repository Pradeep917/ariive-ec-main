<?php
// session_start();
$servername = "localhost";
$username = "root";
$dbpassword = "";
$dbname = "ariivetest";
$conn = mysqli_connect($servername, $username, $dbpassword, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

require_once('vendor/autoload.php');
$google_client = new Google_Client();
$google_client->setClientId('443605670567-mmbm03pvjom5adl2oep2kkhrso7pi2nf.apps.googleusercontent.com');
$google_client->setClientSecret('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');
$google_client->setRedirectUri('https://ariive.co.in/login_with_google.php');
$google_client->addScope('email');
$google_client->addScope('profile');

if (isset($_GET["code"])) {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];
        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();
        $_SESSION['user_email_address'] = $data['email'];
        $_SESSION['user_first_name'] = $data['given_name'];
        $_SESSION['user_last_name'] = $data['family_name'];
        $_SESSION['user_image'] = $data['picture'];
        // $_SESSION['login_button'] = false;

        $user_email = $_SESSION['user_email_address'];
        $access_token = $token['access_token']; // Access Token
        $query = "SELECT user_email, google_token_id FROM user_login_details WHERE user_email = '$user_email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
            $user_first_name = $_SESSION['user_first_name'];
            $user_last_name = $_SESSION['user_last_name'];
            $user_image = $_SESSION['user_image'];
            $sql = "INSERT INTO user_login_details (user_email, user_name, user_last_name, google_token_id) 
                    VALUES ('$user_email', '$user_first_name', '$user_last_name', '$access_token')";
            if (mysqli_query($conn, $sql)) {
                $last_id = mysqli_insert_id($conn);
                $_SESSION['auth'] = true;
                $_SESSION['auth_user'] = [
                    'user_id' => $last_id,
                    'name' => $user_first_name,
                    'email' => $user_email,
                ];
                $_SESSION['message'] ='Logged In Successfully!';

                // $_SESSION['message'] = 'Welcome To Login Ariive!';
                header('location:index.php');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            $user_first_name = $_SESSION['user_first_name'];
            $user_last_name = $_SESSION['user_last_name'];
            $sql = "UPDATE user_login_details 
                    SET user_name = '$user_first_name', user_last_name = '$user_last_name', google_token_id = '$access_token' 
                    WHERE user_email = '$user_email'";
            $user_id = "SELECT `user_id` FROM `user_login_details` WHERE user_email = '$user_email'";
            $result_id = mysqli_query($conn, $user_id);
            while ($row_result_id = mysqli_fetch_assoc($result_id)) {
                $user_update_id = $row_result_id['user_id'];
            }
            if (mysqli_query($conn, $sql)) {
                $updated_user_id = mysqli_insert_id($conn);
                $_SESSION['auth'] = true;
                $_SESSION['auth_user'] = [
                    'user_id' => $user_update_id,
                    'name' => $user_first_name,
                    'email' => $user_email,
                ];
                $_SESSION['message'] ='Logged In Successfully!';

                header('location:index.php');
            } else {
                echo "Error: " . mysqli_error($conn);
                echo "Query: " . $sql;
            }
        }
    }
}
?>
<a href="<?= $google_client->createAuthUrl() ?>" class="img-fluid" style="margin-left:15%;">
    <img src='assets/images/icon/logingoogle.png'></a>
<?php 



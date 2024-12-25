<?php
$showError = "false";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconnect.php';
    
    $user_email = $_POST['signupEmail'];
    $username = $_POST['userName'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupcPassword'];

    // Check if email already exists
    $existsql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $existsql);
    $numRows = mysqli_num_rows($result);

    if ($numRows > 0) {
        $showError = "Email already in use!";
    } else {
        if ($pass == $cpass) {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_name`, `user_pass`, `timestamp`) VALUES ('$user_email', '$username', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $showAlert = true;
                header("Location: /index.php?signupsuccess=true");
                exit();
            } else {
                $showError = "There was an error signing you up.";
            }
        } else {
            $showError = "Passwords do not match!";
        }
    }

    header("Location: /index.php?signupsuccess=false&error=" . urlencode($showError));
    exit();
}
?>

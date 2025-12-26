<?php

if (isset($_GET['token'])) {

    $conn = mysqli_connect("localhost", "root", "", "register"); 
    $token_1=substr($_GET["token"],0,32);

    $token = mysqli_real_escape_string($conn, $token_1);

    // Check if the token exists in the database
    $token_check_query = mysqli_query($conn, "SELECT * FROM `users` WHERE `reset_token`='$token'");
    if (mysqli_num_rows($token_check_query) == 1) {
        // Token is valid, allow the user to reset the password
        // Display a form to set a new password
        if (isset($_POST['submit-btn'])) {
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

            if ($password === $confirm_password) {
                // Hash the new password
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                // Update the user's password in the database
                $update_query = mysqli_query($conn, "UPDATE `users` SET `password`='$hashed_password', `reset_token`=NULL WHERE `reset_token`='$token'");
                if ($update_query) {
                    $message = "Your password has been successfully reset.";
                    header("Location: login.php");
                    exit();
                } else {
                    $error = "Failed to reset password. Please try again.";
                }
            } else {
                $error = "Passwords do not match.";
            }
        }
    } else {
        $error = "Invalid or expired token.";
    }
} else {
    $error = "Token not provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="" method="post" autocomplete="">
                <h2 class="text-center">Forgot Password</h2>
                    <p class="text-center">It's quick and easy.</p>
                    <?php
                        if (isset($error)) {
                            echo '<div>'.$error.'</div>';
                        }
                        if (isset($message)) {
                            echo '<div>'.$message.'</div>';
                        }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Enter Your New Password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="confirm_password" placeholder="Enter Your Confirm Password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="submit-btn" value="Reset Password">
                    </div>
                </form>
            </div>
    </div>
</div>
</body>
</html>

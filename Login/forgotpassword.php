<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

if (isset($_POST['submit-btn'])) {

    $message = array();
    
    $conn = mysqli_connect("localhost", "root", "", "register"); 

    $email = mysqli_real_escape_string($conn,$_POST['email']);

    // Generate a unique token
    $token = substr(bin2hex(random_bytes(32)),0,32);

    // Update the user's reset_token in the database
    $update_query = mysqli_query($conn, "UPDATE `users` SET `reset_token`='$token' WHERE `email`='$email'");
    if ($update_query) {
        // Send email with reset link
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'manasaher123@gmail.com';
            $mail->Password   = 'cslfmracbjrrqmxb';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('manasaher123@gmail.com', 'Manas'); // Sender's email address and name
            $mail->addAddress($email); // Recipient's email address

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Reset Your Password';
            $mail->Body    = "To reset your password, please click the following link: <a href='http://localhost:8080/Quickshop/Login/resetpassword.php?token=$token'>Reset Password</a>";
            
            $mail->send();
            $message[] = "Password reset link has been sent to your email.";
        } catch (Exception $e) {
            $message[] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $message[] = "Failed to generate reset link. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="forgotpassword.php" method="post" autocomplete="">
                <h2 class="text-center">Forgot Password</h2>
                    <p class="text-center">It's quick and easy.</p>
                    <?php
                        if (isset($message)) {
                            foreach ($message as $msg) {
                                echo '<div>'.$msg.'</div>';
                            }
                        }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Enter Your Email" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="submit-btn" value="Submit">
                    </div>
                </form>
            </div>
    </div>
</div>
</body>
</html>

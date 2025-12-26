<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './vendor/autoload.php';

if(isset($_POST["register"]))
{
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $mail = new PHPMailer(true);

    try{
        $mail->SMTPDebug = 0;

        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';

        $mail->SMTPAuth = true;

        $mail->Username = 'manasaher123@gmail.com';

        $mail->Password = 'gpqytnzzslbfxbcy';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->SMTPSecure = 'tls';

        $mail->Port = 587;
        $mail->setFrom('manasaher123@gmail.com','Manas Aher');

        $mail->addAddress($email,$name);
        $mail-> addReplyTo('manasaher123@gmail.com',"Manas");

        $mail->isHTML(true);

        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

        $mail->Subject = 'Email verification';
        $mail->Body = '<p>Your verification code is: <b style="font: size 30px;">' . $verification_code . '</b></p>';

        $mail->send();

        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

        $conn =mysqli_connect("localhost", "root", "", "register");
        $email_verified_at=date("l jS \of F Y h:i:s A");
        $sql = "INSERT INTO users(name, phone, email, password, verification_code, email_verified_at) VALUES ('" . $name . "','" . $phone . "','" . $email . "','" . $encrypted_password . "','" . $verification_code . "','".$email_verified_at."')";
        mysqli_query($conn, $sql);

        header("Location: email-verification.php?email=" . $email);
        exit();
    }
    catch(Exception $e)
    {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
    <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="signup.php" method="POST" autocomplete="">
                    <h2 class="text-center">Signup Form</h2>
                    <p class="text-center">It's quick and easy.</p>
                    <?php if(isset($_GET['error'])) { ?>
                        <p class="error">
                            <?php echo $_GET['error']; ?>
                        </p>
                    <?php } ?>
                    <?php if(isset($_GET['success'])) { ?>
                        <p class="success">
                            <?php echo $_GET['success']; ?>
                        </p>
                    <?php } ?>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" id="name" placeholder="Enter Your Name" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="phone" name="phone" id="numberInput" placeholder="Enter Your Phone Number" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" id="email" placeholder="Email Address" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="register" value="Signup">
                    </div>
                    <div class="link login-link text-center">Already a member? <a href="login.php">Login here</a></div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("numberInput").addEventListener("input", function() {
            var input = this.value.replace(/\D/g, ''); // Remove non-digit characters
            if (input.length > 10) {
                input = input.slice(0, 10); // Limit to 10 characters
            }
            this.value = input;
        });
    </script>
</body>
</html>
<?php

if(isset($_POST['verify_email'])){
    $email = $_POST["email"];
    $verification_code=$_POST["verification_code"];

    $conn = mysqli_connect("localhost", "root", "", "register");

    $sql = "UPDATE users SET email_verified_at = NOW() WHERE email = '" . $email . "' AND verification_code = '" . $verification_code ."'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) == 0){
        header("Location: email-verification.php?error=verification code is invalid");

        exit();
    }

    header("Location: login.php?success=Your email has been verified successfully");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>verification Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
  
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form method="POST" autocomplete="">
                    <h2 class="text-center">Email Verification</h2>
                    <p class="text-center">
                        <?php
                    if(isset($_GET["error"])){
                        echo $_GET["error"];
                    }
                    ?>
                    </p>
                    <div class="form-group">
                        <input class="form-control" type="hidden" name="email" value="<?php echo $_GET['email'];?>" required>
                        <input class="form-control" type="text" name="verification_code" placeholder="Enter Verification Code" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="verify_email" value="Verify">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>
<?php
session_start();

// Redirect if already logged in
if(isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

@include '../config.php';

$error = '';
$success = '';

if(isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if(!$result) {
        $error = "Database error: " . mysqli_error($conn);
    } elseif(mysqli_num_rows($result) == 0) {
        $error = "Email not found";
    } else {
        $user = mysqli_fetch_object($result);

        if(!password_verify($password, $user->password)) {
            $error = "Password is incorrect";
        } elseif ($user->email_verified_at == null) {
            $error = "Please verify your email first";
        } else {
            // Successful login
            $_SESSION['email'] = $user->email;
            header("Location: ../index.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login Form</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4 form login-form">
            <form action="" method="POST" autocomplete="off">
                <h2 class="text-center">Login Form</h2>
                <p class="text-center">Login with your email and password.</p>

                <?php if($error != ''): ?>
                    <p class="error" style="color:red;"><?php echo $error; ?></p>
                <?php endif; ?>

                <?php if(isset($_GET['success'])): ?>
                    <p class="success" style="color:green;"><?php echo htmlspecialchars($_GET['success']); ?></p>
                <?php endif; ?>

                <div class="form-group">
                    <input class="form-control" type="email" name="email" id="email" placeholder="Email Address" required>
                </div>

                <div class="form-group">
                    <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                </div>

                <a class="link forget-pass text-left" href="forgotpassword.php">Forgot password?</a>
                <br><br>

                <div class="form-group">
                    <input class="form-control button" type="submit" name="login" value="Login">
                </div>

                <div class="link login-link text-center">
                    Not yet a member? <a href="signup.php">Signup now</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

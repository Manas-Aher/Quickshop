<?php
session_start();
unset($_SESSION['email']);
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Logged Out</title>
<meta http-equiv="refresh" content="2.5;url=../index.php">

<style>
    * {
        box-sizing: border-box;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
    }

    body {
        margin: 0;
        height: 100vh;
        background: rgba(0,0,0,0.35);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal {
        background: #ffffff;
        width: 360px;
        border-radius: 10px;
        padding: 28px 26px;
        text-align: center;
        box-shadow: 0 25px 60px rgba(0,0,0,0.25);
        animation: fadeIn 0.25s ease;
    }

    .icon {
        width: 54px;
        height: 54px;
        border-radius: 50%;
        border: 2px solid #d1d5db;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        font-size: 22px;
        color: #374151;
    }

    h2 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        color: #111827;
    }

    p {
        margin-top: 8px;
        font-size: 14px;
        color: #6b7280;
    }

    .loader {
        margin: 18px auto 0;
        width: 24px;
        height: 24px;
        border: 3px solid #e5e7eb;
        border-top-color: #111827;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.97); }
        to { opacity: 1; transform: scale(1); }
    }
</style>
</head>

<body>

<div class="modal">
    <div class="icon">✓</div>
    <h2>Logged out successfully</h2>
    <p>You will be redirected shortly</p>
    <div class="loader"></div>
</div>

</body>
</html>


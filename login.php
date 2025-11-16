<?php
session_start();

// Simple login check
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === "admin" && $password === "admin123") {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Login gagal!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; }
        .login-box { width: 300px; margin: 100px auto; padding: 20px; background: white; border-radius: 5px; }
        .form-group { margin: 10px 0; }
        input[type="text"], input[type="password"] { width: 100%; padding: 8px; }
        button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
        <form method="POST">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required value="admin">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required value="admin123">
            </div>
            <button type="submit">Login</button>
        </form>
        <p><small>Username: admin, Password: admin123</small></p>
    </div>
</body>
</html>
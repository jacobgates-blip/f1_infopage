<?php
session_start();
require('conn_1dt.php');

if (isset($_POST['login_btn'])) {
    $email = trim($_POST['email'] ?? '');
    $pwd   = $_POST['pwd'] ?? '';

    if ($email === '' || $pwd === '') {
        header('Location: ../login.php?error=empty_fields');
        exit;
    }

    // Check against the new 'admins' table
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($pwd, $admin['password'])) {
        $_SESSION['id']        = $admin['id'];
        $_SESSION['firstname'] = $admin['firstname'];
        // Redirect straight to the results manager
        header('Location: ../manage_results.php');
        exit;
    }

    header('Location: ../login.php?error=invalid_credentials');
    exit;
}

header('Location: ../login.php');
exit;

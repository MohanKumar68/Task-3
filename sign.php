<?php
session_start();
require_once 'dtcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
    try {
        $stmt->execute([$fullname, $email, $password]);
        $_SESSION['message'] = "Registration successful! Please login.";
        header("Location: task3.html");
    } catch(PDOException $e) {
        $_SESSION['error'] = "Email already exists!";
        header("Location: task3.html");
    }
}
?>

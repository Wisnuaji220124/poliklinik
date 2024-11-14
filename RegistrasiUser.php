<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        echo "Password tidak sama!";
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password_hash')";

        if ($conn->query($sql) === TRUE) {
            echo "Registrasi berhasil!";
            header("Location: loginUser.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>

<form method="POST" action="">
    <label>Username</label>
    <input type="text" name="username" required>
    <label>Password</label>
    <input type="password" name="password" required>
    <label>Konfirmasi Password</label>
    <input type="password" name="confirm_password" required>
    <button type="submit">Register</button>
</form>


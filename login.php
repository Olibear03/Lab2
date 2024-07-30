<?php
$servername='localhost:3307';
$user='root';
$password='';
$database='registertbl';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli($servername, $user, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: homepage.php");
            exit();
        } else {
            $error = "Wrong Password";
        }
    } else {
        $error = "Username not exist";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Username" required>
        <br>
        <input type="password" name="password" placeholder="Password" required>
        <br>
        <button type="submit">Login</button>
    </form>
    <?php
    if (isset($error)) {
        echo "<p>$error</p>";
    }
    ?>
    <a href="register.php">Register</a>
</body>
</html>

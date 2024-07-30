<?php
$servername='localhost:3307';
$user='root';
$password='';
$database='registertbl';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $conn = new mysqli($servername, $user, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Username" required>
        <br>
        <input type="password" name="password" placeholder="Password" required>
        <br>
        <button type="submit">Register</button>
    </form>
    <a href="login.php">Login</a>
</body>
</html>

<?php
$servername='localhost:3307';
$user='root';
$password='';
$database='registertbl';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $conn = new mysqli($servername, $user, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM users WHERE id = $user_id";

    if ($conn->query($sql) === TRUE) {
        echo "Account deleted successfully!";
        header("Location: homepage.php");
        exit();
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
    <title>Delete Account</title>
</head>
<body>
    <h2>Delete Account</h2>
    <p>Are you sure you want to delete this account?</p>
    <form method="post" action="">
        <button type="submit">Confirm Delete</button>
    </form>
    <a href="homepage.php">Cancel</a>
</body>
</html>

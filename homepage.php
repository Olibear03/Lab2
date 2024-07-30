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

$conn = new mysqli($servername, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, username FROM users";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <h3>Registered Users:</h3>
    <table border="1">
        <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td>Hidden</td>
                <td>
                    <a href="update_account.php?id=<?php echo $row['id']; ?>">Update</a> |
                    <a href="delete_account.php?id=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>

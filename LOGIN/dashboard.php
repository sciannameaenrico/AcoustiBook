<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Dashboard</title><link rel="stylesheet" href="style.css"></head>
<body>
<h2>Benvenuto, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>
<p>Sei loggato correttamente.</p>
<a href="logout.php">Logout</a>
</body>
</html>
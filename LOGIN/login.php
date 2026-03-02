<?php
session_start();
require "dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["pwd"];
	try{
      $stmt = $pdo->prepare("SELECT id, pwd FROM users WHERE username = :username");
      $stmt->execute(['username'=> $username]);
      
      $user=$stmt->fetch(PDO::FETCH_ASSOC);
      
      $stmt2 = $pdo->prepare("SELECT id, pwd FROM users WHERE username = :username");
      $stmt2->execute(['username'=> $username]);
      
      $user2=$stmt2->fetch(PDO::FETCH_ASSOC);
      
      
      if (password_verify($password, $password_hash)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["username"] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            $errore = "Password errata.";
        }
    }
    catch(PDOException $e){
    	$errore= "Errore nella connesscione al database". $e->getMessage();
    }
  
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title><link rel="stylesheet" href="style.css"></head>
<body>
<h2>Login</h2>


<?php if (!empty($errore)) echo "<p style='color:red'>$errore</p>"; ?>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Accedi</button>
</form>

<p>Non hai un account? <a href="register.php">Registrati</a></p>
</body>
</html>
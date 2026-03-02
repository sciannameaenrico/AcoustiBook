<?php
require "dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $email    = trim($_POST["email"]);
    $password = $_POST["password"];


    if (empty($username) || empty($email) || empty($password)) {
        die("Compila tutti i campi.");
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $token = password_hash($password_hash, PASSWORD_DEFAULT);

    
    $query="INSERT INTO users (username,pwd,email,token,autentificato)
        		VALUES (:username, :pwd, :email, :token, 0)";
                
        $stmt= $pdo ->prepare($query);
      
        $ex= $stmt -> execute ([
        		'username' => $username,
                'pwd' => $password_hash,
                'email' => $email,
                'token'=> $token,

                 ]);
                
    

    if ($ex) {
        echo "Registrazione avvenuta con successo. Abbiamo mandato un email di conferma";

        $to = $email;
        $subject = 'Email di conferma';
        $message = "Conferma dell'email: http://enricosciannamea.altervista.org/Tepsit2/Login/check.php?t=$token";

        mail($to, $subject, $message);

    } else {
        echo "Errore: username o email già esistenti.";
    }

    
}
?>

<!DOCTYPE html>
<html>
<head><title>Registrazione</title><link rel="stylesheet" href="style.css"></head>
<body>
<h2>Registrati</h2>
<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Registrati</button>
</form>
</body>
</html>
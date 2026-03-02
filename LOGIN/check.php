<?php
require "dbconnect.php";

$token = $_GET["t"];

    $sql = "SELECT id FROM users WHERE token = :token";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['token' => $token]);
    $user = $stmt->fetch();

    if ($user) {
        $update = "UPDATE users SET autentificato = 1 WHERE token = :token";
        $stmt2 = $pdo->prepare($update);
        $stmt2->execute(['token' => $token]);

        echo "Autenticazione avvenuta con successo!";
    } else {
        echo "Token o utente non valido.";
    }

?>
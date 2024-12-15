<?php
try {
    $conn = new PDO('mysql:host=localhost;dbname=db', 'root', 'root');
    echo "Connexion établie";
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

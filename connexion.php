<?php


$nom_serveur = "localhost";
$nom_base_de_donne = "db";
$utilisateur = "root";
$motpass = "root";

try{
    $connexion = new PDO("mysql:host=$nom_serveur;dbname=$nom_base_de_donne",$utilisateur, $motpass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $connexion;
}catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
<?php
session_start();
include 'connexion.php';

if (!empty($_POST['id'])) {
    // Modification de la demande existante
    $sql = "UPDATE nouvelledemande SET nomu=?, agenceu=?, inventaireu=?, marqueu=?, dateu=?, referenceu=?, observationu=? WHERE id=?";

    $req = $connexion->prepare($sql);
    $req->execute(array(
        $_POST['nomu'],
        $_POST['agenceu'],
        $_POST['inventaireu'],
        $_POST['marqueu'],
        $_POST['dateu'],
        $_POST['referenceu'],
        $_POST['observationu'],
        $_POST['id']
    ));
} else {
    // Ajout d'une nouvelle demande
    $sql = "INSERT INTO nouvelledemande (nomu, agenceu, inventaireu, marqueu, dateu, referenceu, observationu) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $req = $connexion->prepare($sql);
    $req->execute(array(
        $_POST['nomu'],
        $_POST['agenceu'],
        $_POST['inventaireu'],
        $_POST['marqueu'],
        $_POST['dateu'],
        $_POST['referenceu'],
        $_POST['observationu']
    ));
}

// Vérification du succès de l'opération
if ($req->rowCount() != 0) {
    $_SESSION['message']['text'] = "Demande modifiée ou ajoutée avec succès";
    $_SESSION['message']['type'] = "success";
} else {
    $_SESSION['message']['text'] = "Aucune modification ou ajout effectué";
    $_SESSION['message']['type'] = "warning";
}

header('Location: profile.php');
?>

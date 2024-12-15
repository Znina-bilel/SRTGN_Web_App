<?php
session_start();
include 'connexion.php';

if (
    !empty($_POST['id'])
    && !empty($_POST['equipement_type'])
    && !empty($_POST['marque'])
    && !empty($_POST['reference'])
    && !empty($_POST['etat'])
) {
    $sql = "UPDATE equipement SET equipement_type=?, marque=?, reference=?,etat=? WHERE id=?";
    
    $req = $connexion->prepare($sql);
    $req->execute(array(
        $_POST['equipement_type'],
        $_POST['marque'],
        $_POST['reference'],
        $_POST['etat'],
        $_POST['id']
    ));

    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "Equipement modifié avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Rien n'a été modifié";
        $_SESSION['message']['type'] = "warning";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: gererEquipement.php');
?>

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
    
    $sql = "INSERT INTO $nom_base_de_donne.equipement (id,equipement_type,marque,reference,etat)  VALUES(?,?,?,?,?)";
    

    $req=$connexion->prepare($sql);
    $req->execute(array(
        $_POST['id'],
        $_POST['equipement_type'],
        $_POST['marque'],
        $_POST['reference'],
        $_POST['etat']
    ));
    if ($req->rowCount() != 0 ) { 
        $_SESSION['message']['text'] = "Equipement ajouté avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Une erreur s'est produite lors de l'ajout de l'equipement";
        $_SESSION['message']['type'] = "danger";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: gererEquipement.php');
?>

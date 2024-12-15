<?php
session_start();
include 'connexion.php';

if (
    !empty($_POST['nomu'])
    && !empty($_POST['agenceu'])
    && !empty($_POST['inventaireu'])
    && !empty($_POST['marqueu'])
    && !empty($_POST['dateu'])
    && !empty($_POST['referenceu'])
    && !empty($_POST['observationu'])
) {
    
    $sql = "INSERT INTO $nom_base_de_donne.nouvelledemande (nomu,agenceu,inventaireu,marqueu,dateu,referenceu,observationu,datedtrait,dateftrait,descriptionu)  VALUES(?,?,?,?,?,?,?,?,?,?)";
    

    $req=$connexion->prepare($sql);
    $req->execute(array(
        $_POST['nomu'],
        $_POST['agenceu'],
        $_POST['inventaireu'],
        $_POST['marqueu'],
        $_POST['dateu'],
        $_POST['referenceu'],
        $_POST['observationu'],
        $_POST['datedtrait'],
        $_POST['dateftrait'],
        $_POST['descriptionu'] 
    ));
    if ($req->rowCount() != 0) { 
        $_SESSION['message']['text'] = "Demande traité avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Une erreur s'est produite lors du traitement de demande";
        $_SESSION['message']['type'] = "danger";
    }
    
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: intervention.php');
?>

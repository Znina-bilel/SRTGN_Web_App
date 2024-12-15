<?php
session_start();
include 'connexion.php';
if (
    !empty($_POST['id'])
    && !empty($_POST['namee'])
    && !empty($_POST['user_name'])
    && !empty($_POST['passwordd'])
) {
    
    $sql = "INSERT INTO $nom_base_de_donne.adminn (id,namee,user_name,passwordd)  VALUES(?,?,?,?)";
    

    $req=$connexion->prepare($sql);
    $req->execute(array(
        $_POST['id'],
        $_POST['namee'],
        $_POST['user_name'],
        $_POST['passwordd']
    ));
    if ($req->rowCount() != 0 ) { 
        $_SESSION['message']['text'] = "Admi ajouté avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Une erreur s'est produite lors de l'ajout de l'utilisateur";
        $_SESSION['message']['type'] = "danger";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: gererAdministrateur.php');
?>

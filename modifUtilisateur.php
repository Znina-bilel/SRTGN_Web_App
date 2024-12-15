<?php
session_start();
include 'connexion.php';

if (
    !empty($_POST['id'])
    && !empty($_POST['namea'])
    && !empty($_POST['user_name'])
    && !empty($_POST['passworda'])
) {
    $sql = "UPDATE users SET namea=?, user_name=?, passworda=? WHERE id=?";
    
    $req = $connexion->prepare($sql);
    $req->execute(array(
        $_POST['namea'],
        $_POST['user_name'],
        $_POST['passworda'],
        $_POST['id']
    ));

    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "Utilisateur modifié avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Rien n'a été modifié";
        $_SESSION['message']['type'] = "warning";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: gererUtilisateur.php');
?>

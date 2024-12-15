<?php
session_start();
include 'connexion.php';

if (
    !empty($_POST['id'])
    && !empty($_POST['namee'])
    && !empty($_POST['user_name'])
    && !empty($_POST['passwordd'])
) {
    $sql = "UPDATE adminn SET namee=?, user_name=?, passwordd=? WHERE id=?";
    
    $req = $connexion->prepare($sql);
    $req->execute(array(
        $_POST['namee'],
        $_POST['user_name'],
        $_POST['passwordd'],
        $_POST['id']
    ));

    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "Administrateur modifié avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Rien n'a été modifié";
        $_SESSION['message']['type'] = "warning";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: gererAdministrateur.php');
?>

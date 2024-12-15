<?php
session_start();
include 'connexion.php';

function generateUniqueId() {
    // Generate a unique ID using the current timestamp and a random number
    return md5(uniqid(rand(), true));
}

if (
    !empty($_POST['namea'])
    && !empty($_POST['user_name'])
    && !empty($_POST['passworda'])
) {
    $id = generateUniqueId();

    $sql = "INSERT INTO $nom_base_de_donne.users (id, namea, user_name, passworda) VALUES (?, ?, ?, ?)";

    $req = $connexion->prepare($sql);
    $req->execute(array(
        $id,
        $_POST['namea'],
        $_POST['user_name'],
        $_POST['passworda']
    ));

    if ($req->rowCount() != 0) { 
        $_SESSION['message']['text'] = "Utilisateur ajouté avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Une erreur s'est produite lors de l'ajout de l'utilisateur";
        $_SESSION['message']['type'] = "danger";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: gererUtilisateur.php');
?>

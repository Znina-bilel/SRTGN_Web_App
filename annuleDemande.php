<?php

include 'connexion.php';
if (
    !empty($_GET['id']) &&
    !empty($_GET['idu'])
    ){
        $sql="UPDATE nouvelledemande SET etat=? WHERE id=?";
        $req=$connexion->prepare($sql);
    $req->execute(array(
        $_POST['nomu'],
        $_POST['agenceu'],
        $_POST['inventaireu'],
        $_POST['marqueu'],
        $_POST['dateu'],
        $_POST['referenceu'],
        $_POST['observationu'] 
    ));
    if ($req->rowCount() != 0 ) {}
    }
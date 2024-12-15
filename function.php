<?php
include_once 'connexion.php';

function getDemande($idu, $id = null) {
    if (!empty($id)) {
        $sql = "SELECT * FROM nouvelledemande WHERE idu = ? AND id = ?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute([$idu, $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    } else {
        $sql = "SELECT * FROM nouvelledemande WHERE idu = ?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute([$idu]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}


function getUser($id=null){
    if (!empty($id)) {
        $sql = "SELECT * FROM users WHERE id=?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    }else{
        $sql = "SELECT * FROM users";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}


function getAdmin($id=null){
    if (!empty($id)) {
        $sql = "SELECT * FROM adminn WHERE id=?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    }else{
        $sql = "SELECT * FROM adminn";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

function getEq($id=null){
    if (!empty($id)) {
        $sql = "SELECT * FROM equipement WHERE id=?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    }else{
        $sql = "SELECT * FROM equipement";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

function getNotification($id = null) {
    if (!empty($id)) {
        $sql = "SELECT * FROM nouvelledemande WHERE  id = ?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute([ $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    } else {
        $sql = "SELECT * FROM nouvelledemande ";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute([]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}
function getIntervention($id = null) {
    if (!empty($id)) {
        $sql = "SELECT * FROM nouvelledemande WHERE id = ? AND descriptionu IS NOT NULL AND datedtrait IS NOT NULL AND dateftrait IS NOT NULL";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    } else {
        $sql = "SELECT * FROM nouvelledemande WHERE descriptionu IS NOT NULL AND datedtrait IS NOT NULL AND dateftrait IS NOT NULL";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}


function getRecuDemande($id = null) {
    $sql = "SELECT nomu, agenceu, inventaireu, marqueu, dateu, referenceu, observationu, tel, mail, serviceu, n.id FROM nouvelledemande AS n, infoutilisateur AS i WHERE n.idu=i.idu";

    if ($id !== null) {
        $sql .= " AND n.id = ? LIMIT 1";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    } else {
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}

function deleteDemande($id) {
    $sql = "DELETE FROM nouvelledemande WHERE id = ?";
    $stmt = $GLOBALS['connexion']->prepare($sql);
    $stmt->execute([$id]);
}

function deleteUser($id) {
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $GLOBALS['connexion']->prepare($sql);
    $stmt->execute([$id]);
}

function deleteAdmin($id) {
    $sql = "DELETE FROM adminn WHERE id = ?";
    $stmt = $GLOBALS['connexion']->prepare($sql);
    $stmt->execute([$id]);
}

function deleteEq($id) {
    $sql = "DELETE FROM equipement WHERE id = ?";
    $stmt = $GLOBALS['connexion']->prepare($sql);
    $stmt->execute([$id]);
}

function deleteNotification($id) {
    $sql = "DELETE FROM notificationn WHERE id = ?";
    $stmt = $GLOBALS['connexion']->prepare($sql);
    $stmt->execute([$id]);
}
// Assurez-vous que la session est démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


?>

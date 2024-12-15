<?php

include 'entete.php';


// Supprimer la demande si l'action est 'delete'
if (!empty($_GET['id']) && !empty($_GET['action']) && $_GET['action'] == 'delete') {
    $idDemandeASupprimer = $_GET['id'];
    deleteDemande($idDemandeASupprimer);
    $_SESSION['message'] = ['type' => 'success', 'text' => 'Demande supprimée avec succès.'];
    header("Location: profile.php"); // Assurez-vous que rien n'est affiché avant cette ligne
    exit();
}
// Récupérer l'ID de la demande si disponible
$idDemande = (!empty($_GET['id'])) ? $_GET['id'] : null;

// Initialiser le tableau $demande pour éviter des erreurs plus tard dans le code
$demande = [];

// Si l'ID est disponible, récupérer les détails de la demande
if ($idDemande !== null) {
    // Vous devriez également vérifier si la demande existe avant de l'assigner à $demande
    $demandeDetails = getDemande($_SESSION['id'], $idDemande);

    if (!empty($demandeDetails)) {
        $demande = $demandeDetails;
    } else {
        // Rediriger ou afficher un message d'erreur, selon votre logique
        header("Location: profile.php");
        exit();
    }
}

// Traitement de la modification
if (isset($_POST['modifier'])) {
  // Vérifier si tous les champs nécessaires sont renseignés
  if (
      !empty($_POST['id']) &&
      !empty($_POST['nomu']) &&
      !empty($_POST['agenceu']) &&
      !empty($_POST['inventaireu']) &&
      !empty($_POST['marqueu']) &&
      !empty($_POST['dateu']) &&
      !empty($_POST['referenceu']) &&
      !empty($_POST['observationu'])
  ) {
      // Effectuer la mise à jour de la demande
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

      if ($req->rowCount() != 0) {
          $_SESSION['message']['text'] = "Demande modifiée avec succès";
          $_SESSION['message']['type'] = "success";
      } else {
          $_SESSION['message']['text'] = "Rien n'a été modifié";
          $_SESSION['message']['type'] = "warning";
      }
  } else {
      $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
      $_SESSION['message']['type'] = "danger";
  }

  // Redirection après la modification
  header('Location: profile.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Titre</title>
    
<style>
   body {
  font-family: sans-serif;
  font-size: 16px;
}

form {
  width: 100%;
  margin: 0;
  padding: 20px;
  border: 1px solid #ccc;
}

label {
  display: block;
  font-weight: bold;
  width: 200px;
}

input, select {
  width: 100%;
  padding: 10px 15px;
  border-radius: 3px;
}

input[type="submit"] {
  background-color: #000;
  color: #fff;
  cursor: pointer;
}

.promotion {
  margin-top: 20px;
}

.genre {
  margin-top: 20px;
}

.ajouter {
  margin-top: 20px;
}

.header {
  background-color: #000;
  color: #fff;
  padding: 20px;
  text-align: center;
}

.content {
  background-color: #fff;
  padding: 20px;
}

.input-group {
  margin-bottom: 10px;
}

.input-group > label {
  margin-right: 10px;
}

.form-style {
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 1px 3px #ccc;
}

.form-style > * {
  font-size: 18px;
}

.form-style > label {
  font-weight: normal;
}

.form-style > input, .form-style > select {
  border-radius: 3px;
  padding: 10px 15px;
}

.form-style > input[type="submit"] {
  background-color: #000;
  color: #fff;
  cursor: pointer;
}

.form-style > input {
  width: 250px;
}
.s {
  background-color: #f8e986;
  color: #000;
  cursor: pointer;
  width: 100px;
  border-radius: 15px;
  padding: 15px;
  font-size:14px;
  margin-top: 20px;
  &:hover {
    background-color: #ccc;
    color: #000;
  }
}
.alert {
  margin: 10px;
  padding: 15px;
  color: white;
  border-radius: 10px;
}
.alert.danger{
  background-color: #f44336;
}
.alert.success{
  background-color: #25da7c;
}
.alert.danger{
  background-color: #e69e2b;
}
.mtable{
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-top: 20px;
}
th, td {
  padding: 10px;
  
}

th {
  background-color: #f9f9f9;
  text-align: center;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
.page {
  margin: 0;
  border: initial;
  border-radius: initial;
  width: initial;
  min-height: initial;
  box-shadow: initial;
  background: initial;
  page-break-after: always;
}
</style>
</head>
<body>
<div class="home-content">
    <div class="box">
        <form action="<?= !empty($_GET['id']) ? "modifDemande.php" : "ajoutDemande.php" ?>" method="post">
          <!-- Ajoutez un champ caché pour stocker l'ID de la demande -->
          <input type="hidden" name="id" value="<?= !empty($_GET['id']) ? $_GET['id'] : '' ?>">
            <table border=0>
                <tr>
                    <td><label for="nomu">Nom utilisateur</label></td>
                    <td>
                        <input value="<?= (!empty($_GET['id']) && !empty($demande['nomu'])) ? $demande['nomu'] : (isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "") ?>" type="text" name="nomu" id="nomu" value="<?php
                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            }

                            if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
                                echo $_SESSION['user_name']; // Correction ici
                            } else {
                                header("Location: index.php");
                                exit();
                            }
                        ?>">
                    </td>
                    <td><label for="agenceu">Agence</label></td>
                    <td><input value="<?= !empty($_GET['id']) ? $demande['agenceu'] : "" ?>" type="text" name="agenceu" id="agence" placeholder="Saisir l'agence "></td>
                </tr>

                <tr>
                    <td><label for="inventaireu">Inventaire</label></td>
                    <td>
                        <select name="inventaireu" id="inventaireu">
                            <option <?= !empty($_GET['id']) && $demande['inventaireu']== "Ordinateur" ? "selected" : "" ?> value="Ordinateur">Ordinateur</option>
                            <option <?= !empty($_GET['id']) && $demande['inventaireu']== "Imprimante" ? "selected" : "" ?> value="Imprimante">Imprimante</option>
                            <option <?= !empty($_GET['id']) && $demande['inventaireu']== "Scanner" ? "selected" : "" ?> value="Scanner">Scanner</option>
                            <option <?= !empty($_GET['id']) && $demande['inventaireu']== "Moniteur" ? "selected" : "" ?> value="Moniteur">Moniteur</option>
                            <option <?= !empty($_GET['id']) && $demande['inventaireu']== "Onduleur" ? "selected" : "" ?> value="Onduleur">Onduleur</option>
                        </select>
                    </td>
                    <td><label for="marqueu">Marque</label></td>
                    <td>
                        <select name="marqueu" id="marqueu">
                            <!-- La liste des marques sera mise à jour dynamiquement par JavaScript -->
                        </select>
                    </td>
                    
                </tr>
                <tr>
                    <td><label for="dateu">Date d'achat</label></td>
                    <td><input value="<?= !empty($_GET['id']) ? $demande['dateu'] : "" ?>" type="datetime-local" name="dateu" id="dateu" placeholder="Saisir la date d'achat "></td>
                    <td><label for="referenceu">Reference</label></td>
                    <td><input value="<?= !empty($_GET['id']) ? $demande['referenceu'] : "" ?>" type="number" name="referenceu" id="referenceu" placeholder="Saisir la reference "></td>

                </tr>
                <tr>
                    <td><label for="observationu">Observation</label></td>
                    <td colspan="3"><input value="<?= !empty($_GET['id']) ? $demande['observationu'] : "" ?>" type="text" name="observationu" id="observationu" placeholder="Saisir l'observation "></td>
                </tr>
            </table>
           
            <button type="submit" class='s' name="<?= !empty($_GET['id']) ? 'modifier' : 'ajouter' ?>">
            <?= !empty($_GET['id']) ? 'Modifier' : 'Ajouter' ?>
            </button>

            <?php
if (!empty($_SESSION['message']['text'])) {
?>
    <div class="alert <?= $_SESSION['message']['type'] ?>">
        <?= $_SESSION['message']['text'] ?>
    </div>
<?php
}
?>

        <div class="box">
            <table id="table-demandes" class="mtable">
                <tr>
                    <th>Nom utilisateur</th>
                    <th>Agence</th>
                    <th>Inventaire</th>
                    <th>Marque</th>
                    <th>Date d'achat</th>
                    <th>Reference</th>
                    <th>Observation</th>
                    <th colspan="3">Action</th>
                </tr>
                <?php
                // Récupérez l'ID de l'utilisateur actuel
$idu = isset($_SESSION['id']) ? $_SESSION['id'] : null;
// Utilisez la fonction ajustée pour récupérer les demandes de cet utilisateur
if (!empty($_SESSION['id'])) {
  $idu = $_SESSION['id'];

  // Récupérez les détails de la demande pour cet utilisateur
  $demandes = getDemande($idu);

  // Reste du code...
}


                if (!empty($demandes) && is_array($demandes)) {
                    foreach ($demandes as $key => $value) {
                        ?>
                        <tr>
                            <td><?= $value['nomu'] ?></td>
                            <td><?= $value['agenceu'] ?></td>
                            <td><?= $value['inventaireu'] ?></td>
                            <td><?= $value['marqueu'] ?></td>
                            <td><?= date('d/m/Y H:i:s', strtotime($value['dateu'])) ?></td>
                            <td><?= $value['referenceu'] ?></td>
                            <td><?= $value['observationu'] ?></td>
                            <td><a href="?id=<?= $value['id'] ?>"><i style="color:green;" class='bx bxs-edit-alt'></i></a></td>

                            <td><a href="?id=<?= $value['id'] ?>&action=delete" onclick="return confirm('Voulez-vous vraiment supprimer cette demande ?')">
                                    <i style="color:red;" class='bx bx-trash'></i>
                                </a></td>
                            <td><a href="recuDemande.php?id=<?= $value['id'] ?>"><i class='bx bx-receipt'></i></a></td>
                            
                            <?php
                        }
                    }
                    ?>
            </table>
        
        </form>
    </div>
</div>

<script>
    document.getElementById('inventaireu').addEventListener('change', function () {
        var inventaire = this.value;
        var marques = document.getElementById('marqueu');

        // Effacer les options existantes
        marques.innerHTML = '';

        // Ajouter les options en fonction de l'inventaire sélectionné
        if (inventaire === 'Ordinateur') {
            var marquesOrdinateur = ['Dell', 'Lenovo', 'HP'];
            addOptionsToSelect(marques, marquesOrdinateur);
        } else if (inventaire === 'Imprimante') {
            var marquesImprimante = ['Laser', 'jet d’encre', 'Matriciel'];
            addOptionsToSelect(marques, marquesImprimante);
        } else if (inventaire === 'Scanner') {
            var marquesScanner = ['Scanner à plat', 'Scanner à chargeur', 'Scanner sur imprimante multifonction', 'Scanner portable', 'Scanner polyvalent'];
            addOptionsToSelect(marques, marquesScanner);
        } else if (inventaire === 'Moniteur') {
            var marquesMoniteur = ['Moniteur LCD', 'Moniteur TFT', 'Moniteurs LED', 'Moniteur DLP', 'Écran tactile', 'Moniteur à écran plasma'];
            addOptionsToSelect(marques, marquesMoniteur);
        } else if (inventaire === 'Onduleur') {
            var marquesOnduleur = ['Online double conversion', 'Line-interactive', 'Offline'];
            addOptionsToSelect(marques, marquesOnduleur);
        }
        // Ajoutez d'autres cas pour les autres types d'inventaire si nécessaire
    });

    // Fonction pour ajouter des options à la liste déroulante
    function addOptionsToSelect(selectElement, optionsArray) {
        for (var i = 0; i < optionsArray.length; i++) {
            var option = document.createElement('option');
            option.value = optionsArray[i];
            option.text = optionsArray[i];
            selectElement.appendChild(option);
        }
    }


    document.querySelectorAll('.envoyerDemande').forEach(function (button) {
    button.addEventListener('click', function (event) {
        event.preventDefault();

        var confirmation = confirm("Voulez-vous vraiment envoyer cette demande ?");

        if (confirmation) {
            var demandeId = this.getAttribute('data-demande-id');

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert("Demande envoyée avec succès");

                    // Ajoutez une nouvelle ligne à la table avec les données de la demande
                    var table = document.getElementById('table-demandes');
                    var newRow = table.insertRow();

                    // Ajoutez des cellules avec les données de la demande (ajustez selon votre structure)
                    var cell1 = newRow.insertCell(0);
                    var cell2 = newRow.insertCell(1);
                    // ... continuez pour chaque cellule

                    // Remplacez les valeurs factices ci-dessous par les données réelles de la demande
                    cell1.innerHTML = 'Nom utilisateur';
                    cell2.innerHTML = 'Agence';
                    // ... continuez pour chaque cellule
                }
            };

            var formData = new FormData();
            formData.append('action', 'envoyerDemande');
            formData.append('demandeId', demandeId);

            xhr.open('POST', 'ajoutNotification.php', true);
            xhr.send(formData);
        }
    });
});

</script>

<?php include 'pied.php'; ?>

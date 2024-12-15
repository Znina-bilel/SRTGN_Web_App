<?php
include 'enteteA.php';


// Supprimer la demande si l'action est 'delete'
if (!empty($_GET['id']) && !empty($_GET['action']) && $_GET['action'] == 'delete') {
    $idDemandeASupprimer = $_GET['id'];
    deleteDemande($idDemandeASupprimer);
    $_SESSION['message'] = ['type' => 'success', 'text' => 'Demande supprimée avec succès.'];
    header("Location: notification.php"); // Assurez-vous que rien n'est affiché avant cette ligne
    exit();
}
if (!empty($_GET['id'])) {
    $demande = getNotification($_GET['id']);
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Titre</title>
    
<style>
  form {
  position: absolute;
  top: 50%;
  left: 40%;
  transform: translate(-50%, -50%);
  width: 500px;
  margin: 0 auto;
  padding: 20px;
}
.mtable {
  width: 950px; /* Occupe toute la largeur disponible */
  border-collapse: collapse;
  border-spacing: 0;
  margin-top: 40px; /* Ajustez la marge supérieure si besoin */
  table-layout: fixed; /* Force les colonnes à respecter la largeur définie */
}

.mtable th,
.mtable td {
  padding: 10px; /* Ajustez le padding des cellules si besoin */
  text-align: left; /* Alignez le texte à gauche */
}

.mtable th {
  background-color: #f0f0f0; /* Couleur de fond pour les en-têtes de colonne */
}
.s{
  /* position: absolute; */
  position: relative;
  top: 30px; /* Ajustez la valeur si besoin */
  right: 0;
  background-color: #f8e986;
  color: #000;
  cursor: pointer;
  width: 100px;
  border-radius: 15px;
  padding: 15px;
  font-size: 14px;
}

.s:hover {
  background-color: #ccc;
  color: #000;
}
.table{
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-top: 750px;
}




body {
  font-family: sans-serif;
  font-size: 16px;
  display:flex;
}

.form label {
  font-weight: bold;
  margin-bottom: 10px;
  
}

/* styles pour les champs de saisie */
input{
  
  padding: 10px;
  border: 1px solid #ccc;
  margin-bottom: 10px;
  width: 250%;
}
label {
  display: block;
  font-weight: bold;
  width: 110%;
}

input, select {
  width: 110%;
  padding: 10px 15px;
  border-radius: 3px;
  border:1px solid;
}

.alert {
  margin: 10px;
  padding: 15px;
  color: white;
  border-radius: 10px;
  position: relative; /* Positionnez l'alert relativement au formulaire */
  margin-top: 60px; /* Créez un espace entre le bouton et l'alert */
  width: 900px;
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

.form-container {
  position: relative;
}

th, td {
  padding: 10px;
  width: 110%;
}

th {
  background-color: #f9f9f9;
  text-align: center;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
.mtable td input {
  border: 1px solid #ccc;
}
.f{
  width: 110%;
  padding: 10px 15px;
  border-radius: 3px;
 
}
.y{
  width: 110%;
  padding: 10px 15px;
  border-radius: 3px;
}
.o{
  width: 105%;
  padding: 10px 15px;
  border-radius: 3px;
}


</style>
</head>
<div class="home-content">
    <div class="box">
        <form action="ajoutIntervention.php" method="post" class="<?= (!empty($_GET['id']) ? 'form-appear' : ''); ?>">
            <table border=0 class="table">
                <tr>
                    <td><label class="y" for="nomu">Nom utilisateur</label></td>
                    <td>
                        <input value="<?= (!empty($_GET['id']) && !empty($demande['nomu'])) ? $demande['nomu'] : (isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "") ?>" type="text" name="nomu" id="nomu" value="<?php
                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            }

                            if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
                                echo $_SESSION['user_name']; // Correction ici
                            } else {
                                header("Location: indexA.php");
                                exit();
                            }
                        ?>">
                    </td>
                    <td><label class="y" for="agenceu">Agence</label></td>
                    <td><input  class="f" value="<?= !empty($_GET['id']) ? $demande['agenceu'] : "" ?>" type="text" name="agenceu" id="agenceu" placeholder="Saisir l'agence "></td>
                </tr>

                <tr>
                    <td><label class="y" for="inventaireu">Inventaire</label></td>
                    <td>
                        <select name="inventaireu" id="inventaireu">
                            <option <?= !empty($_GET['id']) && $demande['inventaireu']== "Ordinateur" ? "selected" : "" ?> value="Ordinateur">Ordinateur</option>
                            <option <?= !empty($_GET['id']) && $demande['inventaireu']== "Imprimante" ? "selected" : "" ?> value="Imprimante">Imprimante</option>
                            <option <?= !empty($_GET['id']) && $demande['inventaireu']== "Scanner" ? "selected" : "" ?> value="Scanner">Scanner</option>
                            <option <?= !empty($_GET['id']) && $demande['inventaireu']== "Moniteur" ? "selected" : "" ?> value="Moniteur">Moniteur</option>
                            <option <?= !empty($_GET['id']) && $demande['inventaireu']== "Onduleur" ? "selected" : "" ?> value="Onduleur">Onduleur</option>
                        </select>
                    </td>
                    <td><label class="y" for="marqueu">Marque</label></td>
                    <td>
                        <select  class="f" name="marqueu" id="marqueu">
                            <!-- La liste des marques sera mise à jour dynamiquement par JavaScript -->
                        </select>
                    </td>
                    
                </tr>
                <tr>
                    <td><label class="y" for="dateu">Date d'achat</label></td>
                    <td><input value="<?= !empty($_GET['id']) ? $demande['dateu'] : "" ?>" type="datetime-local" name="dateu" id="dateu" placeholder="Saisir la date d'achat "></td>
                    <td><label class="y" for="referenceu">Reference</label></td>
                    <td><input  class="f" value="<?= !empty($_GET['id']) ? $demande['referenceu'] : "" ?>" type="number" name="referenceu" id="referenceu" placeholder="Saisir la reference "></td>
                    
                </tr>
                <tr><td> <label class="y" for="observationu">Observation</label></td>
                    <td colspan="3"><input class="o" value="<?= !empty($_GET['id']) ? $demande['observationu'] : "" ?>" type="text" name="observationu" id="observationu" placeholder="Saisir l'observation "></td>
                </tr>
                <tr>
                    <td><label class="y" for="datedtrait">Date début traitement</label></td>
                    <td><input value="<?= !empty($_GET['id']) ? $demande['datedtrait'] : "" ?>" type="datetime-local" name="datedtrait" id="datedtrait" placeholder="Saisir la date de début de traitement "></td>
                    <td><label class="y" for="dateftrait">Date fin traitement</label></td>
                    <td><input value="<?= !empty($_GET['id']) ? $demande['dateftrait'] : "" ?>" type="datetime-local" name="dateftrait" id="dateftrait" placeholder="Saisir la date de fin de traitement "></td>
                </tr>
                <tr>
                  <td><label class="y" for="descriptionu">Description</label></td>
                  <td colspan="3">
                      <input class="o" value="<?= !empty($_GET['id']) ? $demande['descriptionu'] : "" ?>" type="text" name="descriptionu" id="descriptionu" placeholder="Saisir la description">
                  </td>
                </tr>

            </table>
           
            <button type="submit" class='s' name="submit"> Ajouter</button>
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
            <table class="mtable">
                <tr>
                    <th>Nom utilisateur</th>
                    <th>Agence</th>
                    <th>Inventaire</th>
                    <th>Marque</th>
                    <th>Date d'achat</th>
                    <th>Reference</th>
                    <th>Observation</th>
                    <th colspan="2">Action</th>
                </tr>
                <?php
                    $a=getNotification();

                    if (!empty($a) && is_array($a)) {
                        foreach ($a as $key => $value) {
                ?>
                        <tr data-id="<?= $value['id'] ?>">
                            <td><?= $value['nomu'] ?></td>
                            <td><?= $value['agenceu'] ?></td>
                            <td><?= $value['inventaireu'] ?></td>
                            <td><?= $value['marqueu'] ?></td>
                            <td><?= date('d/m/Y H:i:s', strtotime($value['dateu'])) ?></td>
                            <td><?= $value['referenceu'] ?></td>
                            <td><?= $value['observationu'] ?></td>
                            <td><a href="?id=<?= $value['id'] ?>"><i style="color:green;" class='bx bxs-edit-alt'></i></a></td>
                            <td><a href="?id=<?= $value['id'] ?>&action=delete" onclick="return confirm('Voulez-vous vraiment supprimer cette demande ?')">
                            <i style="color: red;" class='bx bxs-trash-alt bx-spin' ></i>
                                </a></td>
                            <?php
                        }
                    }
                    ?>
            </table>
        
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Attendez que le DOM soit entièrement chargé avant d'attacher les écouteurs d'événements

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
  })
    


</script>


<?php include 'pied.php'; ?>
  </body>
  </html>
<?php
include 'enteteA.php';
if (!empty($_GET['id'])) {
    $intervention = getIntervention($_GET['id']);
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
  width: 1000px; /* Occupe toute la largeur disponible */
  border-collapse: collapse;
  border-spacing: 0;
  margin-top: 40px; /* Ajustez la marge supérieure si besoin */
  table-layout: fixed; /* Force les colonnes à respecter la largeur définie */
}

.mtable th,
.mtable td {
  padding: 2px; /* Ajustez le padding des cellules si besoin */
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
  font-size: 14px;
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
<div class="home-content">
    <div class="box">
        <form action="" method="post" class="<?= (!empty($_GET['id']) ? 'form-appear' : ''); ?>">
            
            <?php
if (!empty($_SESSION['message']['text'])) {
?>
    <div class="alert <?= $_SESSION['message']['type'] ?>">
        <?= $_SESSION['message']['text'] ?>
    </div>
<?php
}
?>

        
            <table class="mtable">
                <tr>
                    <th>Nom utilisateur</th>
                    <th>Agence</th>
                    <th>Inventaire</th>
                    <th>Marque</th>
                    <th>Date d'achat</th>
                    <th>Reference</th>
                    <th>Observation</th>
                    <th>Date début traitement</th>
                    <th>Date fin traitement</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                <?php
              $a=getIntervention();

              if (!empty($a) && is_array($a)) {
                foreach ($a as $key => $value) {
                ?>
                      <tr>
                            <td><?= $value['nomu'] ?></td>
                            <td><?= $value['agenceu'] ?></td>
                            <td><?= $value['inventaireu'] ?></td>
                            <td><?= $value['marqueu'] ?></td>
                            <td><?= date('d/m/Y H:i:s', strtotime($value['dateu'])) ?></td>
                            <td><?= $value['referenceu'] ?></td>
                            <td><?= $value['observationu'] ?></td>
                            <td><?= date('d/m/Y H:i:s', strtotime($value['datedtrait'])) ?></td>
                            <td><?= date('d/m/Y H:i:s', strtotime($value['dateftrait'])) ?></td>
                            <td><?= $value['descriptionu'] ?></td>
                            <td><a href="recuDemande.php?id=<?= $value['id'] ?>"><i class='bx bx-receipt'></i></a></td>
                            <?php
                }}
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
</script>


<?php include 'pied.php'; ?>
  </body>
  </html>
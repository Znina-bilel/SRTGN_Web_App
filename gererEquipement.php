<?php
include 'enteteA.php';

// Supprimer la demande si l'action est 'delete'
if (!empty($_GET['id']) && !empty($_GET['action']) && $_GET['action'] == 'delete') {
  $idDemandeASupprimer = $_GET['id'];
  deleteEq($idDemandeASupprimer);
  $_SESSION['message'] = ['type' => 'success', 'text' => 'Equipement supprimé(e) avec succès.'];
  header("Location: gererEquipement.php"); // Assurez-vous que rien n'est affiché avant cette ligne
  exit();
}

if (!empty($_GET['id'])) {
  $equipement = getEq($_GET['id']);
}
?>
<style>
   form {
  position: absolute;
  top: 30%;
  left: 40%;
  transform: translate(-50%, -50%);
  width: 500px;
  margin: 0 auto;
  padding: 20px;
}
.mtable {
  width: 900px; /* Occupe toute la largeur disponible */
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
.btn-ajouter {
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

.btn-ajouter:hover {
  background-color: #ccc;
  color: #000;
}
.table{
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-top: 550px;
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
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  margin-bottom: 10px;
  width: 250%;
}
label {
  display: block;
  font-weight: bold;
  width: 200px;
}

input, select {
  width: 250%;
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
</style>

<div class="home-content">
    <div class="box">
        <form action="<?= !empty($_GET['id']) ? "modifEquipement.php" : "ajoutEquipement.php" ?>" method="post" >
        <table border=0 class="table">
                <tr>
                    <td><label for="id">Id equipement</label></td>
                    <td><input value="<?= !empty($_GET['id']) ? $equipement['id'] : "" ?>" type="number" name="id" id="id" placeholder="Saisir l'identifiant de l'utilisateur"></td>
                </tr>
                
                <tr>
                    <td><label for="equipement_type">Nom equipement</label></td>
                    <td>
                        <select name="equipement_type" id="equipement_type">
                            <option <?= !empty($_GET['id']) && $equipement['equipement_type']== "Ordinateur" ? "selected" : "" ?> value="Ordinateur">Ordinateur</option>
                            <option <?= !empty($_GET['id']) && $equipement['equipement_type']== "Imprimante" ? "selected" : "" ?> value="Imprimante">Imprimante</option>
                            <option <?= !empty($_GET['id']) && $equipement['equipement_type']== "Scanner" ? "selected" : "" ?> value="Scanner">Scanner</option>
                            <option <?= !empty($_GET['id']) && $equipement['equipement_type']== "Moniteur" ? "selected" : "" ?> value="Moniteur">Moniteur</option>
                            <option <?= !empty($_GET['id']) && $equipement['equipement_type']== "Onduleur" ? "selected" : "" ?> value="Onduleur">Onduleur</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="marque">Marque </label></td>
                    <td>
                        <select name="marque" id="marque">
                            <!-- La liste des marques sera mise à jour dynamiquement par JavaScript -->
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="reference">Reference</label></td>
                    <td><input value="<?= !empty($_GET['id']) ? $equipement['reference'] : "" ?>" type="text" name="reference" id="reference" placeholder="Saisir la reference de l'equipement"></td>
                </tr>
                <tr>
                    <td><label for="etat">Etat d'equipement</label></td>
                    <td>
                        <select name="etat" id="etat">
                            <option <?= !empty($_GET['id']) && $equipement['etat']== "En service" ? "selected" : "" ?> value="Enservice">En service</option>
                            <option <?= !empty($_GET['id']) && $equipement['etat']== "En attend" ? "selected" : "" ?> value="Enattend">En attend</option>
                            <option <?= !empty($_GET['id']) && $equipement['etat']== "Reformer" ? "selected" : "" ?> value="Reformer">Reformer</option>
                        </select>
                    </td>
                </tr>
               
                
          </table> 
          <button type="submit" class='btn-ajouter'>Ajouter</button> 
          <?php
                if(!empty($_SESSION['message']['text'])) {
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
                <th>Identifiant equipement</th>
                <th>Nom equipement</th>
                <th>Marque</th>
                <th>Reference</th>
                <th>Etat d'equipement</th>
                <th colspan="2">Action</th>
            </tr>
            <?php
              $a=getEq();

              if (!empty($a) && is_array($a)) {
                foreach ($a as $key => $value) {
            ?>
            <tr>
              <td><?= $value['id'] ?></td>
              <td><?= $value['equipement_type'] ?></td>
              <td><?= $value['marque'] ?></td>
              <td><?= $value['reference'] ?></td>
              <td><?= $value['etat'] ?></td>
              <td><a href="?id=<?= $value['id'] ?>"><i style="color:green;" class='bx bxs-edit-alt'></i></a></td>
              <td><a href="?id=<?= $value['id'] ?>&action=delete" onclick="return confirm('Voulez-vous vraiment supprimer cet equipement ?')">
              <i style="color: red;" class='bx bxs-trash-alt bx-spin' ></i>
                                </a></td>
            </tr>
            <?php
                }
              }
            ?>
    </div> 
</div>
</div>

<script>
    document.getElementById('equipement_type').addEventListener('change', function () {
        var inventaire = this.value;
        var marques = document.getElementById('marque');

        // Effacer les options existantes
        marques.innerHTML = '';

        // Ajouter les options en fonction de l'inventaire sélectionné
        if (inventaire === 'Ordinateur') {
            var marquesOrdinateur = ['Dell', 'Lenovo', 'HP','Asus','Acer'];
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

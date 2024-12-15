<?php
include 'enteteA.php';

// Supprimer la demande si l'action est 'delete'
if (!empty($_GET['id']) && !empty($_GET['action']) && $_GET['action'] == 'delete') {
  $idDemandeASupprimer = $_GET['id'];
  deleteUser($idDemandeASupprimer);
  $_SESSION['message'] = ['type' => 'success', 'text' => 'Utilisateur supprimé(e) avec succès.'];
  header("Location: gererUtilisateur.php"); // Assurez-vous que rien n'est affiché avant cette ligne
  exit();
}

if (!empty($_GET['id'])) {
  $utilisateur = getUser($_GET['id']);
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
        <form action="<?= !empty($_GET['id']) ? "modifUtilisateur.php" : "ajoutUtilisateur.php" ?>" method="post" >
        <table border=0 class="table">
                <tr>
                    <td><label for="id">Id utilisateur</label></td>
                    <td><input value="<?= !empty($_GET['id']) ? $utilisateur['id'] : "" ?>" type="number" name="id" id="id" placeholder="Saisir l'identifiant de l'utilisateur"></td>
                </tr>
                
                <tr>
                    <td><label for="namee">Nom utilisateur</label></td>
                    <td><input value="<?= !empty($_GET['id']) ? $utilisateur['namea'] : "" ?>" type="text" name="namea" id="namea" placeholder="Saisir le nom de l'utilisateur"></td>
                </tr>
                <tr>
                    <td><label for="user_name">Prenom utilisateur</label></td>
                    <td><input value="<?= !empty($_GET['id']) ? $utilisateur['user_name'] : "" ?>" type="text" name="user_name" id="user_name" placeholder="Saisir le prenom de l'utilisateur"></td>
                </tr>
                <tr>
                    <td><label for="passwordd">Mot de passe</label></td>
                    <td><input value="<?= !empty($_GET['id']) ? $utilisateur['passworda'] : "" ?>" type="password" name="passworda" id="passworda" placeholder="Saisir le Mot de passe de l'utilisateur"></td>
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
                <th>Identifiant utilisateur</th>
                <th>Nom utilisateur</th>
                <th>Prenom utilisateur</th>
                <th>Mot de passe</th>
                <th colspan="2">Action</th>
            </tr>
            <?php
              $a=getUser();

              if (!empty($a) && is_array($a)) {
                foreach ($a as $key => $value) {
            ?>
            <tr>
              <td><?= $value['id'] ?></td>
              <td><?= $value['namea'] ?></td>
              <td><?= $value['user_name'] ?></td>
              <td><?= $value['passworda'] ?></td>
              <td><a href="?id=<?= $value['id'] ?>"><i style="color:green;" class='bx bxs-edit-alt'></i></a></td>
              <td><a href="?id=<?= $value['id'] ?>&action=delete" onclick="return confirm('Voulez-vous vraiment supprimer ce utilisateur ?')">
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

<?php include 'pied.php'; ?>

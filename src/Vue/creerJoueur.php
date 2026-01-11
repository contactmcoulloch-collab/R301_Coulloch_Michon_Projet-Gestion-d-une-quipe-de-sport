<?php

require __DIR__ . '/../DAO/connexion_DAO.php';
require __DIR__ . '/../DAO/joueur_DAO.php';

/// AFFICHAGE DU FORMULAIRE
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $idJoueur = '';
    $nom = '';
    $prenom = '';
    $licence = '';
    $naissance = '';
    $taille = '';
    $poids = '';
    $statut = '';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Création joueur</title>
</head>
<body>

<h2>Creer le joueur</h2>

<div class="panel">
<form action="index.php?controleur=joueur&action=creer"
 method="post">

IdJoueur:
<input type="text" name="idJoueur" value="<?php echo $idJoueur; ?>"><br>

Nom :
<input type="text" name="Nom" value="<?php echo $nom; ?>"><br>

Prénom :
<input type="text" name="Prenom" value="<?php echo $prenom; ?>"><br>

N° Licence :
<input type="text" name="Licence" value="<?php echo $licence; ?>"><br>

Date de Naissance :
<input type="date" name="DateNaissance" value="<?php echo $dateNaissance; ?>"><br>

Taille : 
<input type="number" name="Taille" value="<?php echo $taille; ?>"><br>

Poids :
<input type="number" name="Poids" value="<?php echo $poids; ?>"><br>

Statut :
<select name="Statut">
<option>Valide</option>   
<option>Malade</option>  
<option>Absent</option> 
</select>
<br>



<input type="submit" value="Creer">
</form>
</div>
</body>
</html>

<?php
}

else {

    $idjoueur = $_POST['idJoueur'];
    $nom = $_POST['Nom'];
    $prenom = $_POST['Prenom'];
    $licence = $_POST['Licence'];
    $naissance = $_POST['DateNaissance'];
    $taille = $_POST['Taille'];
    $poids = $_POST['Poids'];
    $statut = $_POST['Statut'];


    creerJoueur($pdo, $idjoueur, $nom, $prenom, $licence, $naissance, $taille, $poids, $statut);
    header('Location: index.php?controleur=joueur&action=');
}
?>

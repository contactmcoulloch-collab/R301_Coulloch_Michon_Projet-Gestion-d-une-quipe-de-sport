<?php
/// Connexion MySQL
require __DIR__ . '/../DAO/connexion_DAO.php';
require __DIR__ . '/../DAO/joueur_DAO.php';

/// AFFICHAGE DU FORMULAIRE avec données en base
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

$idjoueur=$_GET['idjoueur'];

    $row = lireJoueur($pdo, $idjoueur);
    $idjoueur = $row['IDJOUEUR'];
    $nom = $row['NOM'];
    $prenom = $row['PRENOM'];
    $licence = $row['NUMERODELICENCE'];
    $naissance=$row['DATEDENAISSANCE'];
    $taille=$row['TAILLE'];
    $poids=$row['POIDS'];
    $statut=$row['STATUT'];
$titre="Modification d'un joueur";

require __DIR__ . '/menu.php'; ?>


<form action="index.php?controleur=joueur&action=modifier"
 method="post">

idjoueur:
<input type="text" name="idjoueur" value="<?php echo $idjoueur; ?>"><br>

Nom :
<input type="text" name="Nom" value="<?php echo $nom; ?>"><br>

Prénom :
<input type="text" name="Prenom" value="<?php echo $prenom; ?>"><br>

N° Licence :
<input type="text" name="Licence" value="<?php echo $licence; ?>"><br>

Date de Naissance :
<input type="date" name="DateNaissance" value="<?php echo $naissance; ?>"><br>

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



<input type="submit" value="Modifier">
</form>

</body>
</html>

<?php
}

else {

    $idjoueur = $_POST['idjoueur'];
    $nom = $_POST['Nom'];
    $prenom = $_POST['Prenom'];
    $licence = $_POST['Licence'];
    $naissance = $_POST['DateNaissance'];
    $taille = $_POST['Taille'];
    $poids = $_POST['Poids'];
    $statut = $_POST['Statut'];

    modifierJoueur($pdo, $idjoueur, $nom, $prenom, $licence, $naissance, $taille, $poids, $statut);

    header('Location: index.php?controleur=joueur&action=liste');
}
?>

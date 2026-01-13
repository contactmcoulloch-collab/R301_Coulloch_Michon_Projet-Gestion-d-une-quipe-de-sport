<?php

require __DIR__ . '/../DAO/connexion_DAO.php';
require __DIR__ . '/../DAO/joueur_DAO.php';

/// AFFICHAGE DU FORMULAIRE
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $idJoueur = '';
    $poste = '';
    $titulaire = '';
    $note = '';
    $idMatch = '';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Création joueur</title>
</head>
<body>

<h2>Créer le joueur</h2>

<div class="panel">
<form action="index.php?controleur=joueur&action=creer" method="post">

Id Joueur:
<input type="text" name="idJoueur" value="<?php echo $idJoueur; ?>"><br>

Poste :
<input type="text" name="Poste" value="<?php echo $poste; ?>"><br>

Titulaire :
<select name="Titulaire">
    <option value="1">Oui</option>
    <option value="0">Non</option>
</select><br>

Note :
<input type="number" name="Note" value="<?php echo $note; ?>" step="0.1" min="0" max="10"><br>

Id Match:
<input type="text" name="IdMatch" value="<?php echo $idMatch; ?>"><br>

<input type="submit" value="Créer">
</form>
</div>
</body>
</html>

<?php
} else {
    $idparticiper = $_POST['idParticiper'];
    $idjoueur = $_POST['idJoueur'];
    $poste = $_POST['Poste'];
    $titulaire = $_POST['Titulaire'];
    $note = $_POST['Note'];
    $idMatch = $_POST['IdMatch'];

    creer_participer($pdo, $idparticiper, $idjoueur, $poste, $titulaire, $note, $idMatch);

    header('Location: index.php?controleur=match&action=feuille&idmatch=$row['IDMATCH']');
}
?>
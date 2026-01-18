<?php
/// Connexion MySQL
require __DIR__ . '/../DAO/connexion_DAO.php';
require __DIR__ . '/../DAO/match_DAO.php';
require __DIR__ . '/../DAO/participer_DAO.php';

/// AFFICHAGE DU FORMULAIRE avec données en base
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

$idmatch=$_GET['idmatch'];

    $row = matchs_trouver($pdo, $idmatch);
    $idmatch = $row['IDMATCH'];
    $date = $row['DATE'];
    $heure = $row['HEURE'];
    $equipe = $row['EQUIPEADV'];
    $lieu =$row['LIEU'];
    $domicile=$row['DOMICILE'];
    $victoire=$row['VICTOIRE'];
    $resultat=$row['RESULTAT'];
$titre="Modifier le match";

$inscrits = allParticipants($pdo, $idmatch);

require __DIR__ . '/menu.php'; ?>
</h2>

<form action="index.php?controleur=match&action=modifier"
method="post">

ID Match :<input type="text" name="IDMATCH" value="<?php echo $idmatch; ?>"><br>
Date :<input type="date" name="DATE" value="<?php echo $date; ?>"><br>
Heure :<input type="time" name="HEURE" value="<?php echo $heure; ?>"><br>
Adversaire :<input type="text" name="EQUIPEADV" value="<?php echo $equipe; ?>"><br>
Lieu :<input type="text" name="LIEU" value="<?php echo $lieu; ?>"><br>
Domicile (1=oui, 0=non) :<input type="text" name="DOMICILE" value="<?php echo $domicile; ?>"><br>
Victoire (1=oui, 0=non)  :<input type="text" name="VICTOIRE" value="<?php echo $victoire; ?>"><br>
Résultat :<input type="text" name="RESULTAT" value="<?php echo $resultat; ?>"><br>
<input type="submit" value="Sauvegarder">
</form>

<form action="index.php?controleur=match&action=noter" method="post">
<table>
                <thead>
                        <tr><th colspan="5"> Joueurs inscrits a ce match :</th></tr>
                <tr>
                        <th>Nom</h>
                        <th>No Licence</th>
                        <th>Poste</th>
                        <th>Titulaire</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($inscrits as $joueurOccupe) {
                        echo "<tr><td>" . $joueurOccupe['NOM'] . "  " . $joueurOccupe['PRENOM'] . "</td><td>" . $joueurOccupe['NUMERODELICENCE'] . "</td><td>" . $joueurOccupe['POSTE'] . "</td><td>" . $joueurOccupe['TITULAIRE'];
                        echo "</td><td>" . "<a href='index.php?controleur=feuille&action=retirer&idmatch=" . $idmatch . "&idjoueur=" . $joueurOccupe['IDJOUEUR'] . "'> retirer du match </a>" . "</td></tr>";
                    }
                    ?>

                </tbody>
            </table>
            </form>

</body>
</html>

<?php
}
else {

    $idmatch = $_POST['IDMATCH'];

    $date     = $_POST['DATE'];
    $heure    = $_POST['HEURE'];
    $equipeadv   = $_POST['EQUIPEADV'];
    $lieu     = $_POST['LIEU'];
    $domicile      = $_POST['DOMICILE'];
    $victoire = $_POST['VICTOIRE'];
    $resultat = $_POST['RESULTAT'];

     matchs_modifier($pdo, $idmatch, $date, $heure, $equipeadv, $lieu, $domicile, $victoire, $resultat);


   header('Location: index.php?controleur=match&action=liste');
}
?>

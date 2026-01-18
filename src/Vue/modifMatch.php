<?php
/// Connexion MySQL
require __DIR__ . '/../DAO/connexion_DAO.php';
require __DIR__ . '/../DAO/match_DAO.php';
require __DIR__ . '/../DAO/participer_DAO.php';
require __DIR__ . '/../DAO/joueur_DAO.php';
/// AFFICHAGE DU FORMULAIRE avec données en base
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $idmatch = $_GET['idmatch'];

    $row = matchs_trouver($pdo, $idmatch);
    $idmatch = $row['IDMATCH'];
    $date = $row['DATE'];
    $heure = $row['HEURE'];
    $equipe = $row['EQUIPEADV'];
    $lieu = $row['LIEU'];
    $domicile = $row['DOMICILE'];
    $victoire = $row['VICTOIRE'];
    $resultat = $row['RESULTAT'];
    $titre = "Modifier le match";

    $inscrits = allParticipants($pdo, $idmatch);

    require __DIR__ . '/menu.php'; ?>
    </h2>
    <h3>Informations du Match</h3> 
    <form action="index.php?controleur=match&action=modifier" method="post">

        ID Match :<input type="text" name="IDMATCH" value="<?php echo $idmatch; ?>"><br>
        Date :<input type="date" name="DATE" value="<?php echo $date; ?>"><br>
        Heure :<input type="time" name="HEURE" value="<?php echo $heure; ?>"><br>
        Adversaire :<input type="text" name="EQUIPEADV" value="<?php echo $equipe; ?>"><br>
        Lieu :<input type="text" name="LIEU" value="<?php echo $lieu; ?>"><br>
        Domicile :<select name="DOMICILE">
            <option value="1" <?php if ($domicile == "1") {
                echo "SELECTED";
                } ?>>Oui</option>
            <option value="0" <?php if ($domicile == "0") {
                echo "SELECTED";
                } ?>>Non</option>
        </select>
        <br>
        <br>
        <input type="submit" value="Sauvegarder">
    </form>
    <h3>Saisi des Résultats du Match</h3>
    <form action="index.php?controleur=match&action=noter" method="post">
        Victoire :<select name="VICTOIRE">
            <option value="2" <?php if ($victoire == "2") {
                echo "SELECTED";
            } ?>>Gagné</option>
            <option value="1" <?php if ($victoire == "1") {
                echo "SELECTED";
            } ?>>Match nul</option>
            <option value="0" <?php if ($victoire == "0") {
                echo "SELECTED";
            } ?>>Perdu</option>
        </select>
        <br>
        Résultat :<input type="text" name="RESULTAT" value="<?php echo $resultat; ?>"><br>
        <br>
        <br>
        <table>
            <thead>
                <tr>
                    <th colspan="5"> Joueurs inscrits a ce match :</th>
                </tr>
                <tr>
                    <th>Nom</h>
                    <th>No Licence</th>
                    <th>Poste</th>
                    <th>Titulaire</th>
                    <th>Note (/10)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                echo "<input type='hidden' name='IDMATCH' value=".$idmatch.">";
                foreach ($inscrits as $joueurOccupe) {
                    $i++;
                    echo "<tr><td>" . $joueurOccupe['NOM'] . "  " . $joueurOccupe['PRENOM'] . "</td>
                    <td>" . $joueurOccupe['NUMERODELICENCE'] . "</td>
                        <td>" . $joueurOccupe['POSTE'] . "</td>
                        <td>" . $joueurOccupe['TITULAIRE'];
                    echo "</td><td>" . "<input type='numeric' name='note_" . $i . "' value =".$joueurOccupe['NOTE']."> 
                    <input type ='hidden' name = 'idjoueur_" . $i . "' value=".$joueurOccupe['IDJOUEUR']."></td>";}
                ?>

            </tbody>
        </table>
        <br>
        <input type="submit" value="Sauvegarder">
    </form>

    </body>

    </html>

    <?php
} else {
    if ($action == "modifier") {
        $idmatch = $_POST['IDMATCH'];

        $date = $_POST['DATE'];
        $heure = $_POST['HEURE'];
        $equipeadv = $_POST['EQUIPEADV'];
        $lieu = $_POST['LIEU'];
        $domicile = $_POST['DOMICILE'];
    matchs_modifier($pdo, $idmatch, $date, $heure, $equipeadv, $lieu, $domicile, $victoire, $resultat);
    } else {
        var_dump($_POST);
        foreach (array_keys($_POST) as $key) {
            $kd = substr($key,0,5);
            var_dump($kd);
            if ($kd == "note_") {
                $idj = "idjoueur_" . substr($key,5);
                var_dump($idj);
                updateJoueurNote($pdo, $_POST[$idj],$_POST['IDMATCH'], $_POST[$key]);
            }
        }
        $idmatch = $_POST['IDMATCH'];
        $victoire = $_POST['VICTOIRE'];
        $resultat = $_POST['RESULTAT'];
        updateMatchResultat($pdo,$idmatch,$victoire,$resultat);
    }


    header('Location: index.php?controleur=match&action=liste');
}
?>
<?php

require __DIR__ . '/../DAO/connexion_DAO.php';
require __DIR__ . '/../DAO/joueur_DAO.php';


/// AFFICHAGE DU FORMULAIRE
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $idJoueur = $_GET['idjoueur'];
    $joueur = lireJoueur($pdo, $idJoueur);
    $commentaires = listerCommentaires($pdo, $idJoueur);

    $titre ="Planifier un match";
    require __DIR__ . '/menu.php';

?>
<h4>Saisie d'un commentaire pour : 
         <?php echo $joueur['NOM'] . ' ' . $joueur['PRENOM'] ?>
</h4> 
            
            <div class="panel">
            <form action="index.php?controleur=joueur&action=commenter"
             method="post">
            
            Titre  commentaire :
            <input type="text" name="TITRE" value=""><br>
            
            Détail commentaire :
            <textarea name="DETAIL" rows="3" cols="100"></textarea><br>
            <input type="hidden" name="IDJOUEUR" value="<?php echo $joueur['IDJOUEUR'] ?>"><br>
            <input type="submit" value="Creer">
            </form>
</div>

<div class="panel">
<table>
    <thead>
        <th>Titre</th><th>Détail</th>
</thead>
    <tbody>
        <?php 

foreach ($commentaires as $com) {
    echo '<tr><td> ';
    echo $com['TITRE'] ;
    echo '</td><td>' ;
    echo $com['TEXTE'] ;
    echo '</td></tr>';
    } 
        ?>
</tbody>
</table>

</div>
<br>



</div>
</body>
</html>

<?php
}

else {

    $idjoueur = $_POST['IDJOUEUR'];
    $detail = $_POST['DETAIL'];
    $titre =  $_POST['TITRE'];


    creerCommentaire($pdo, $idjoueur, $titre, $detail);
    header('Location: index.php?controleur=joueur&action=liste');
}
?>

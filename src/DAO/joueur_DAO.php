<?php
function listerJoueurs(PDO $linkpdo)
{
    $lreq = "SELECT * FROM JOUEUR";
    $req = $linkpdo->prepare($lreq);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}
function listerCommentaires(PDO $linkpdo, $idjoueur)
{
    $lreq = "SELECT * FROM COMMENTAIRE WHERE IDJOUEUR = :idjoueur";
    $req = $linkpdo->prepare($lreq);
    $req->execute(['idjoueur' => $idjoueur]);
    $commentaires = $req->fetchAll(PDO::FETCH_ASSOC);
    return $commentaires;
}

function lireJoueur(PDO $linkpdo, $id)
{
    $lreq = "SELECT * FROM JOUEUR where IDJOUEUR = :id";
    $req = $linkpdo->prepare($lreq);
    $req->execute(['id'  => $id]);
    $joueur = $req->fetch(PDO::FETCH_ASSOC);
    return $joueur;
}

function creerJoueur(PDO $linkpdo, $id, $nom, $prenom, $licence, $datenais, $taille, $poids, $statut)
{
    $req = $linkpdo->prepare(
        "INSERT INTO JOUEUR 
        ( IDJOUEUR,
            NOM,
            PRENOM,
            NUMERODELICENCE,
            DATEDENAISSANCE,
            TAILLE,
            POIDS,
            STATUT
        ) 
             VALUES (
            :id,
             :nom,
             :prenom,
             :licence,
             :datenais,
             :taille,
             :poids,
             :statut
             )
             "
    );
    $var = array(
        'id' => $id,
        'nom' => $nom,
        'prenom' => $prenom,
        'licence' => $licence,
        'datenais' => $datenais,
        'taille' => $taille,
        'poids' => $poids,
        'statut' => $statut,
    );

        $req->execute($var);

}

function creerCommentaire(PDO $linkpdo, $idjoueur, $titre, $texte)
{
    $lreq = "SELECT max(IDCOMM) as oldid FROM COMMENTAIRE";
    $req = $linkpdo->prepare($lreq);
    $req->execute();
    $resid = $req->fetch(PDO::FETCH_ASSOC);

    $req = $linkpdo->prepare(
        "INSERT INTO COMMENTAIRE
        ( IDCOMM,
            TITRE,
            TEXTE,
            IDJOUEUR
        ) 
             VALUES (
            :id,
             :titre,
             :texte,
             :idjoueur
             )
             "
    );
    $var = array(
        'id' => $resid['oldid']+1,
        'titre' => $titre,
        'texte' => $texte,
        'idjoueur' => $idjoueur,
    );

        $req->execute($var);

}

function modifierJoueur(PDO $linkpdo, $idjoueur, $nom, $prenom, $licence, $datenais, $taille, $poids, $statut)
{
   $req = $linkpdo->prepare(
        "UPDATE JOUEUR 
         SET NOM = :nom,
             PRENOM = :prenom,
             NUMERODELICENCE = :licence,
             DATEDENAISSANCE = :datenais,
             TAILLE = :taille,
             POIDS = :poids,
             STATUT = :statut
         WHERE IDJOUEUR = :idjoueur"

    );
    $var = array(
        'nom' => $nom,
        'prenom' => $prenom,
        'licence' => $licence,
        'datenais' => $datenais,
        'taille' => $taille,
        'poids' => $poids,
        'statut' => $statut,
        'idjoueur' => $idjoueur,
    );

        $req->execute($var);
  }

function supprimerJoueur(PDO $linkpdo, $id)
{
    $req = $linkpdo->prepare(
        'DELETE FROM JOUEUR WHERE IDJOUEUR = :id;'

    );
    $var = array(
        'id' => $id
    );

        $req->execute($var);
 }

 function listerJoueursDispos(PDO $linkpdo, $idmatch)
 {
     $req = $linkpdo->prepare("
         SELECT j.* FROM JOUEUR j
          WHERE j.STATUT NOT IN ('Absent','Malade')
          AND   j.IDJOUEUR NOT IN (   
             SELECT p2.IDJOUEUR
            FROM PARTICIPER p2
            WHERE p2.IDMATCH = :idmatch 
            )");
    $var = array(
        ':idmatch'=> $idmatch
    );
        $req->execute($var);
        $joueurs = $req->fetchAll(PDO::FETCH_ASSOC);
        return $joueurs;
 
 }

 function postePrefere(PDO $linkpdo, $idjoueur){
    $req = $linkpdo->prepare("SELECT p.POSTE
FROM PARTICIPER p
WHERE p.IDJOUEUR = :idjoueur
GROUP BY p.POSTE
HAVING COUNT(*) = (
  SELECT MAX(cnt)
  FROM (
    SELECT COUNT(*) AS cnt
    FROM PARTICIPER
    WHERE IDJOUEUR = :idjoueur
    GROUP BY POSTE
  ));");
      $var = array(
        ':idjoueur'=> $idjoueur
    );
        return $req->execute($var);
 }
 function countTitulaire(PDO $linkpdo,$idjoueur){
    $req = $linkpdo->prepare("SELECT COUNT(*) FROM PARTICIPER WHERE IDJOUEUR = :idjoueur
    AND TITULAIRE = 'Titulaire';");
        $var = array(
        ':idjoueur'=> $idjoueur
    );
        return $req->execute($var);
 }

 function countRemplace(PDO $linkpdo,$idjoueur){
    $req = $linkpdo->prepare("SELECT COUNT(*) FROM PARTICIPER WHERE IDJOUEUR = :idjoueur
    AND TITULAIRE = 'Remplaçant';");
        $var = array(
        ':idjoueur'=> $idjoueur
    );
        return $req->execute($var);
 }

 function moyenneEval(PDO $linkpdo,$idjoueur){
    $req = $linkpdo->prepare('SELECT AVG(NOTE) FROM PARTICIPER WHERE IDJOUEUR = :idjoueur;');
    $var = array(
        ':idjoueur'=> $idjoueur
    );
        return $req->execute($var);
 }

 function pourcentageVictoire(PDO $linkpdo,$idjoueur){
    $req = $linkpdo->prepare('SELECT COUNT(*)
FROM PARTICIPER p
JOIN LE_MATCH m ON m.IDMATCH = p.IDMATCH
WHERE p.IDJOUEUR = :idjoueur
  AND m.VICTOIRE = 1;
');
    $nbPart = $linkpdo->prepare('SELECT COUNT(*) FROM PARTICIPER WHERE IDJOUER = :idjoueur;');
     $var = array(
        ':idjoueur'=> $idjoueur
    );

    $victoires = $req->execute($var);
    $nb = $nbPart->execute($var);
    return ($victoires*100)/ $nb;
 }

 function nbSelectionConsecutive(PDO $linkpdo,$idjoueur){
    $req = $linkpdo->prepare('');

 }

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
    $req->execute(['id' => $id]);
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
        'id' => $resid['oldid'] + 1,
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
        ':idmatch' => $idmatch
    );
    $req->execute($var);
    $joueurs = $req->fetchAll(PDO::FETCH_ASSOC);
    return $joueurs;

}

function postePrefere(PDO $linkpdo, $idjoueur)
{
    $req = $linkpdo->prepare("SELECT p.POSTE, COUNT(*) AS nb
FROM PARTICIPER p
WHERE p.IDJOUEUR = :idjoueur
GROUP BY p.POSTE
HAVING nb = (
    SELECT MAX(cnt)
    FROM (
        SELECT COUNT(*) AS cnt
        FROM PARTICIPER
        WHERE IDJOUEUR = :idjoueur
        GROUP BY POSTE
    ) x
);");
    $var = array(
        ':idjoueur' => $idjoueur
    );
    $req->execute($var);
    $poste = $req->fetch(PDO::FETCH_ASSOC);
    return $poste["POSTE"];
    }
function countTitulaire(PDO $linkpdo, $idjoueur)
{
    $req = $linkpdo->prepare("SELECT COUNT(*) as nb FROM PARTICIPER WHERE IDJOUEUR = :idjoueur
    AND TITULAIRE = 'Titulaire';");
    $var = array(
        ':idjoueur' => $idjoueur
    );
     $req->execute($var);
     $t = $req->fetch(PDO::FETCH_ASSOC);
     return $t['nb'];
}

function countRemplace(PDO $linkpdo, $idjoueur)
{
    $req = $linkpdo->prepare("SELECT COUNT(*) as nb FROM PARTICIPER WHERE IDJOUEUR = :idjoueur
    AND TITULAIRE = 'Remplaçant';");
    $var = array(
        ':idjoueur' => $idjoueur
    );
    $req->execute($var);
     $t = $req->fetch(PDO::FETCH_ASSOC);
     return $t['nb'];
}

function moyenneEval(PDO $linkpdo, $idjoueur)
{
    $req = $linkpdo->prepare('SELECT AVG(NOTE) as m FROM PARTICIPER WHERE IDJOUEUR = :idjoueur;');
    $var = array(
        ':idjoueur' => $idjoueur
    );
    $req->execute($var);
    $m = $req->fetch(PDO::FETCH_ASSOC)['m'];
     return $m;
}

function pourcentageVictoire(PDO $linkpdo, $idjoueur)
{
    $req = $linkpdo->prepare('SELECT COUNT(*) as nb
FROM PARTICIPER p
JOIN LE_MATCH m ON m.IDMATCH = p.IDMATCH
WHERE p.IDJOUEUR = :idjoueur
  AND m.VICTOIRE = 2;
');
    $var = array(
        ':idjoueur' => $idjoueur
    );
    $req->execute($var);
    $nVic = $req->fetch(PDO::FETCH_ASSOC)['nb'];
    
    
    $reqNbPart = $linkpdo->prepare('SELECT COUNT(*) as nb FROM PARTICIPER WHERE IDJOUEUR = :idjoueur;');
    $reqNbPart->execute($var);
    $nParts = $reqNbPart->fetch(PDO::FETCH_ASSOC)['nb'];
  
    if ($nParts > 0 ) {
        return ($nVic * 100) / $nParts;
    } else {
        return 0;
    }
}

function nbSelectionConsecutive(PDO $linkpdo, $idjoueur)
{
    $req = $linkpdo->prepare('');
    $var = array(
        ':idjoueur' => $idjoueur
    );
}



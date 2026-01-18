<?php

function allParticipants(PDO $linkpdo, $idmatch): array
{
    $lreq = "SELECT j.IDJOUEUR, j.NOM, j.PRENOM, j.NUMERODELICENCE, p.NOTE, p.POSTE, p.TITULAIRE FROM JOUEUR j, PARTICIPER p where j.IDJOUEUR = p.IDJOUEUR AND p.IDMATCH= :idmatch;";
 //   $lreq = "SELECT JOUEUR.*, POSTE, TITULAIRE, IDMATCH FROM JOUEUR, PARTICIPER where PARTICIPER.IDMATCH = :idmatch AND PARTICIPER.IDJOUEUR = JOUEUR.IDJOUEUR;";
    $req = $linkpdo->prepare($lreq);
    $req->execute(['idmatch'  => $idmatch]);
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function creer_participer(PDO $linkpdo, $idparticiper, $poste, $titulaire, $note, $idjoueur, $idmatch): ?array
{
    $req = $linkpdo->prepare(
        "INSERT INTO PARTICIPER 
        (
        IDPARTICIPER,
        POSTE,
        TITULAIRE,
        NOTE,
        IDJOUEUR,
        IDMATCH
        ) 
        VALUES (
        :id,
        :poste,
        :titulaire,
        :note,
        :idjoueur,
        :idmatch
        )"
    );

    $var = array(
        'id' => $idparticiper,
        'poste' => $poste,
        'titulaire' => $titulaire,
        'note' => $note, // Assuming note is an integer type
        'idjoueur' => $idjoueur,
        'idmatch' => $idmatch,
    );

    try {
        $req->execute($var);
    }
    catch (Exception $e) {
        return ['Erreur : ' . $e->getMessage()];
    }
    return [];
}

function modifier_participer(PDO $linkpdo, $idparticiper, $poste, $titulaire, $note, $idjoueur, $idmatch): ?array
{
    $stmt = "UPDATE PARTICIPER SET
        POSTE = :poste,
        TITULAIRE = :titulaire,
        NOTE = :note,
        IDJOUEUR = :idjoueur,
        IDMATCH = :idmatch
        WHERE IDPARTICIPER = :id";

    $req = $linkpdo->prepare($stmt);
    
    $var = array(
        'poste' => $poste,
        'titulaire' => $titulaire,
        'note' => $note, // Assuming note is an integer type
        'idjoueur' => $idjoueur,
        'idmatch' => $idmatch,
        'id' => $idparticiper
    );

    try {
        $req->execute($var);
    }
    catch (Exception $e) {
        return ['Erreur : ' . $e->getMessage()];
    }
    return [];
}

function supprimer_participer(PDO $linkpdo, $id): ?array
{
    $req = $linkpdo->prepare(
        'DELETE FROM PARTICIPER WHERE IDPARTICIPER = :id;'
    );
    $var = array(
        'id' => $id
    );

    try {
        $req->execute($var);
    }
    catch (Exception $e) {
        return ['Erreur : ' . $e->getMessage()];
    }
    return [];
}

function retirer_joueurs(PDO $linkpdo, $idjoueur,$idmatch): ?array
{
    $req = $linkpdo->prepare(
        'DELETE FROM PARTICIPER WHERE IDJOUEUR = :idjoueur and IDMATCH = :idmatch;'
    );
    $var = array(
        'idjoueur' => $idjoueur,
        'idmatch' => $idmatch
    );

    try {
        $req->execute($var);
    }
    catch (Exception $e) {
        return ['Erreur : ' . $e->getMessage()];
    }
    return [];
}

function ajouter_joueurs(PDO $linkpdo, $poste,$titulaire,$note,$idjoueur,$idmatch): ?array
{
    $req = $linkpdo->prepare(
        'INSERT INTO PARTICIPER (POSTE,TITULAIRE,NOTE,IDJOUEUR,IDMATCH)
        VALUES(:poste,:titulaire,:note,:idjoueur,:idmatch);'
    );
    $var = array(
        'poste' => $poste,
        'titulaire' => $titulaire,
        'note' => $note,
        'idjoueur' => $idjoueur,
        'idmatch' => $idmatch
    );

    try {
        $req->execute($var);
    }
    catch (Exception $e) {
        return ['Erreur : ' . $e->getMessage()];
    }
    return [];
}
?>
<?php
declare(strict_types=1);

/** @return array<int, array<string,mixed>> */
function matchs_lister(PDO $linkpdo): array
{
    $lreq = "SELECT * FROM LE_MATCH";
    $req = $linkpdo->prepare($lreq);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

/** @return array<string,mixed>|null */
function matchs_trouver(PDO $linkpdo, $id): ?array
{
    $lreq = "SELECT * FROM LE_MATCH where IDMATCH = :id";
    $req = $linkpdo->prepare($lreq);
    $req->execute(['id'  => $id]);
    $match = $req->fetch(PDO::FETCH_ASSOC);
    return $match;
}

function matchs_creer(PDO $linkpdo, $idmatch, $date, $heure, $equipeadv, $lieu, $domicile, $victoire, $resultat): ?array
{
    $req = $linkpdo->prepare(
        "INSERT INTO LE_MATCH 
        (
        IDMATCH,
        DATE,
        HEURE,
        EQUIPEADV,
        LIEU,
        DOMICILE,
        VICTOIRE,
        RESULTAT
        ) 
             VALUES (
        :id,
        :date,
        :heure,
        :equipeadv,
        :lieu,
        :domicile,
        :victoire,
        :resultat
            )
             "
    );
    $var = array(
        'id' => $idmatch,
        'date' => $date,
        'heure' => $heure,
        'equipeadv' => $equipeadv,
        'lieu' => $lieu,
        'domicile' => $domicile,
        'victoire' => $victoire,
        'resultat' => $resultat,
    );

    try {
        $req->execute($var);
    }
    catch (Exception $e) {
        return ['Erreur : ' . $e->getMessage()];
    }
    return [];

}

function matchs_modifier(PDO $linkpdo, $idmatch, $date, $heure, $equipeadv, $lieu, $domicile, $victoire, $resultat): ?array
{
    $stmt = "UPDATE LE_MATCH SET
        DATE = :date,
        HEURE = :heure,
        EQUIPEADV = :equipeadv,
        LIEU = :lieu,
        DOMICILE = :domicile,
        VICTOIRE = :victoire,
        RESULTAT = :resultat
        WHERE IDMATCH = :id";

    
    $req = $linkpdo->prepare($stmt);
    
    $var = array(
        'date' => $date,
        'heure' => $heure,
        'equipeadv' => $equipeadv,
        'lieu' => $lieu,
        'domicile' => $domicile,
        'victoire' => $victoire,
        'resultat' => $resultat,
        'id' => $idmatch
    );
    applog("modif match   var: " . implode(" / ", $var));
    applog($stmt);

    try {
        $req->execute($var);
    }
    catch (Exception $e) {
        return ['Erreur : ' . $e->getMessage()];
    }
    return [];
 }

function matchs_supprimer(PDO $linkpdo, $id): ?array
{
    applog("DELETE LE_MATCH " . $id);
    $req = $linkpdo->prepare(
        'DELETE FROM LE_MATCH WHERE IDMATCH = :id;'

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


/** @return string[] */
function matchs_valider( $idmatch, $date, $heure, $equipeadv, $lieu, $domicile, $victoire, $resultat): array
{
    $erreurs = [];

    $idmatch = trim($idmatch);
    if ($idmatch === '') {
        $erreurs[] = "id invalide.";
    }


    return $erreurs;
}

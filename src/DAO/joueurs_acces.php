<?php
declare(strict_types=1);

/** @return array<int, array<string,mixed>> */
function joueurs_lister(PDO $linkpdo): array
{
    $lreq = "SELECT * FROM JOUEUR";
    $req = $linkpdo->prepare($lreq);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
    //$stmt = $pdo->query("SELECT id, nom, date_entree, date_sortie FROM joueurs ORDER BY nom ASC");
    //return $stmt->fetchAll();
}

/** @return array<string,mixed>|null */
function joueurs_trouver(PDO $linkpdo, $id): ?array
{
    applog('Recherche joueur ' . $id);
    $lreq = "SELECT * FROM JOUEUR where IDJOUEUR = :id";
    $req = $linkpdo->prepare($lreq);
    $req->execute(['id'  => $id]);
    $joueur = $req->fetch(PDO::FETCH_ASSOC);
    applog('Joueur trouvé : ' . print_r($joueur));
    return $joueur;
}

function joueurs_creer(PDO $linkpdo, $id, $nom, $prenom, $licence, $datenaiss, $taille, $poids, $statut): ?array
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

    try {
        $req->execute($var);
    }
    catch (Exception $e) {
        return ['Erreur : ' . $e->getMessage()];
    }
    return [];

}

function joueurs_modifier(PDO $linkpdo, $idjoueur, $nom, $prenom, $licence, $datenais, $taille, $poids, $statut): ?array
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

    try {
        $req->execute($var);
    }
    catch (Exception $e) {
        return ['Erreur : ' . $e->getMessage()];
    }
    return [];
 }

function joueurs_supprimer(PDO $linkpdo, $id): ?array
{
    applog("DELETE JOUEUR " . $id);
    $req = $linkpdo->prepare(
        'DELETE FROM JOUEUR WHERE IDJOUEUR = :id;'

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
function joueurs_valider( $idjoueur, $nom, $prenom, $licence, $datenaiss, $taille, $poids, $statut): array
{
    $erreurs = [];

    $nom = trim($nom);
    if ($nom === '' || mb_strlen($nom) < 2) {
        $erreurs[] = "Nom invalide (min 2 caractères).";
    }


    return $erreurs;
}

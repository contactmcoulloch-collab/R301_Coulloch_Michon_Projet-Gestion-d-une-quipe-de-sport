<?php
class Joueur
{

    private String $id;
    private String $nom;
    private String $prenom;
    private String $numLicence;
    private DateTime $dateDeNaissance;
    private int $taille;
    private int $poids;
    private String $statut;
    private array(50) $commentaires;

    function __construct(String $id, String $n, String $p, String $numL, DateTime $ddn, int $t, int $pds, String $stat){
        this->id = $id;
        this->nom = $n;
        this->prenom = $p;
        this->numLicence = $numL;
        this->dateDeNaissance = $ddn;
        this->taille = $t;
        this->poids = $pds;
        this->statut = $stat;
    }

    fuction addComment(String $id, String $t, String $txt){
        this->commentaires[$id] = new Commentaire($id,$t,$txt);
    }
}
?>
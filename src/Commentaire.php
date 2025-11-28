<?php 
class Commentaire
{

    private $id;
    private $titre;
    private $texte;

    function __construct(String $id, String $t, String $txt){
        this->id = $id;
        this->titre = $t;
        this->texte = $txt;
    }
}
?>
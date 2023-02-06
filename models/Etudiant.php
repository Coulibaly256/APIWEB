<?php
class Etudiant{
    // Toutes les méthodes et propriétés nécessaires à la gestion des données de la table etudiant
    private $table = "etudiant";
    private $connexion = null;

    // les propriétés de l'objet etudiant
    public $idEtudiant;
    public $nomEtudiant;
    public $prenomEtudiant;
    public $genre;
    public $date_naissance;

    public function __construct($db)
    {
        if ($this->connexion == null)
        $this->connexion = $db; 
 
    }

    // Lecture des étudiants

    public function readAll()
        {
            // On écrit la requête
            //$sql = "SELECT nomEtudiant, prenomEtudiant, date_naissance, idPromotion, intitule FROM $this->table e LEFT JOIN promotion p ON idPromotion ORDER BY e.date_creation DESC";
            $sql = "SELECT * FROM $this->table";
            

            // On éxecute la requête
            $req = $this->connexion->query($sql);

            // On retourne le resultat
            return $req;
        }
    public function update(){
        $sql="UPDATE $this->table set nomEtudiant=:nomEtudiant, prenomEtudiant=:prenomEtudiant, genre=:genre, date_naissance=:date_naissance WHERE idEtudiant=:idEtudiant";
        //Préparation de la requete
        $req=$this->connexion->prepare($sql);

        //execution de la requete
        $re=$req->execute([
            ":idEtudiant"=>$this->idEtudiant,
            ":nomEtudiant"=>$this->nomEtudiant,
            ":prenomEtudiant"=>$this->prenomEtudiant,
            ":genre"=>$this->genre,
            ":date_naissance"=>$this->date_naissance,
        ]);
        if($re){
            return true;
        }else{
            return false;
        } 
    }   

}
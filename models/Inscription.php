<?php
class Inscription{
    // Toutes les méthodes et propriétés nécessaires à la gestion des données de la table etudiant
    private $table = "inscription";
    private $connexion = null;

    // les propriétés de l'objet etudiant
    public $idInscription;
    public $date_inscription;
    public $idEtudiant;
    public $idPromotion;
    public $idUtilisateur;

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
        $sql="UPDATE $this->table set date_inscription=:date_inscription, idEtudiant=:idEtudiant, idPromotion=:idPromotion, idUtilisateur=:idUtilisateur WHERE idInscription=:idInscription";
        //Préparation de la requete
        $req=$this->connexion->prepare($sql);

        //execution de la requete
        $re=$req->execute([
            ":idInscription"=>$this->idInscription,
            ":date_inscription"=>$this->date_inscription,
            ":idEtudiant"=>$this->idEtudiant,
            ":idPromotion"=>$this->idPromotion,
            ":idUtilisateur"=>$this->idUtilisateur,
        ]);
        if($re){
            return true;
        }else{
            return false;
        } 
    }   

}
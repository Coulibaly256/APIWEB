<?php
class Utilisateur{

    // Toutes les méthodes et propriétés nécessaires à la gestion des données de la table etudiant
    private $table = "utilisateur";
    private $connexion = null;

    // les propriétés de l'objet etudiant
    public $idUtilisateur;
    public $nom_utilisateur;
    public $mot_de_passe;

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
        $sql="UPDATE $this->table set nom_utilisateur=:nom_utilisateur, mot_de_passe=:mot_de_passe WHERE idUtilisateur=:idUtilisateur";

        //Préparation de la requete
        $req=$this->connexion->prepare($sql);

        //execution de la requete
        $re=$req->execute([
            ":idUtilisateur"=>$this->idUtilisateur,
            ":nom_utilisateur"=>$this->nom_utilisateur,
            ":mot_de_passe" =>$this->mot_de_passe,
        ]);
        if($re){
            return true;
        }else{
            return false;
        } 
    }   

}
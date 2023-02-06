<?php
// Les entetes requises 

header("Access-Control-Origin:*");
header("Content-type:application/json; charset=UTF-8");
header("Access-Control-Allow-Methods:PUT");
require_once('../config/Database.php');
require_once('../models/Utilisateur.php');

if($_SERVER['REQUEST_METHOD']==="PUT"){
    // on ninstancie la base de donées

$database = new Database();
$db = $database->getConnexion();

//on instancie l'objet article

$utilisateur=new utilisateur($db);


// on recupere les infos envoyés
$data=json_decode(file_get_contents("php://input"));
if(!empty($data->idUtilisateur) && !empty($data->nom_utilisateur) && !empty($data->mot_de_passe)){
    //on hydrate l'objet étudiant
    $utilisateur->idUtilisateur=intval($data->idUtilisateur);
    $utilisateur->nom_utilisateur=htmlspecialchars($data->nom_utilisateur);
    $utilisateur->mot_de_passe=htmlspecialchars($data->mot_de_passe);
    


    $result=$utilisateur->update();
    if($result){
        http_response_code(201);
        echo json_encode(['message' =>"Etudiant modifié avec succes"]);
    }else{
        http_response_code(503);
        echo json_encode(['message' =>"Modification etudiant a echoué"]);
    }
}else{
    echo json_encode(['message' => 'les Données ne sont pas au complet']);
}
}else{
    http_response_code(405);
    echo json_encode(['message'=>"la methode n'est pas autorisé"]);
}
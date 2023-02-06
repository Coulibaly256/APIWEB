<?php
// les entêtes requises
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset= UTF-8");
header("Access-Control-Allow-Methods: GET");


require_once '../config/Database.php';
require_once '../models/Inscription.php';

if ($_SERVER['REQUEST_METHOD'] === "GET"){
    // On instancie la base de données
$database = new Database();
$db = $database->getConnexion();

// On instancie l'objet etudiant
$inscription = new Inscription($db);

// Récupération des données
$statement = $inscription->readAll();

if($statement->rowCount() > 0){
    $data = [];

    $data[] = $statement->fetchAll();

    // On renvoie ses données sous format json
    http_response_code(200);
    echo json_encode($data);

}else{
        echo json_encode(["message" => "Aucune données à renvoyer"]);
    }
}else{
    http_response_code(405);
    echo json_encode(['message'=>"la méthode n'est pas autorisée"]);
}

?>
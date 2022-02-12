<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/database.php';
include_once '../objects/antena.php';

$database = new Database();
$db = $database->getConnection();

$datos = new Antenas($db);

$data = json_decode(file_get_contents("php://input"));

$datos->prueba = $data->prueba;
$datos->fecha = $data->fecha;

if (
    !empty($datos->prueba) &&
    $datos->deleteD() &&
    $datos->deleteO()
) {

    echo json_encode(
        array(
            "mensaje" => "exitoso"
        )
    );
}else{
    echo json_encode(
        array(
            "mensaje" => "fallido"
        )
    );
}

<?php
//cabezeras de control y acceso a la api
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/database.php';
include_once '../objects/antena.php';
//instancia a clase para conectar a bdd
$database = new Database();
$db = $database->getConnection();
//instancai a clase del modelo
$datos = new Antenas($db);
//en data se guardaran los datos enviados para consumir la api
$data = json_decode(file_get_contents("php://input"));

    //pasamos los datos a la calse
    $datos->fecha = $data->fecha;
    $datos->prueba = $data->prueba;
    $datos->tag = $data->tag;
//llamamos al metodo getD para obtener registros de la tabla
    if (
        $datos->getD()
    ) {

        $registrosDirecional = $datos->getD();
        //y retornamos un jdon con la lista de los datos obtenidos
        echo json_encode(array("listaD" => $registrosDirecional));
    }

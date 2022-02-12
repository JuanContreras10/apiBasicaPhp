<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/database.php';
include_once '../objects/antena.php';
include_once '../objects/complementaria.php';
//instancia a clase Database y conexion a bdd
$database = new Database();
$db = $database->getConnection();
//instancia modelo antenas 
$datos = new Antenas($db);
$complementaria = new Complementaria($db);

$data = json_decode(file_get_contents("php://input"));

//$estimaciones = [57, 114, 171, 228, 285];
$estimacion1 = 57;
$estimacion2 = 114;
$estimacion3 = 171;
$estimacion4 = 228;
$estimacion5 = 285;

$metrajesD[] = 0;
$metrajesO[] = 0;

$datos->prueba = $data->prueba;

$metrajesDirecional = $datos->getMetrajesDireccional();
$metrajesOmnidireccional = $datos->getMetrajesOmnidirecional();

foreach ($metrajesDirecional as $row) {
    if ($row["metraje"] != " ") {
        $metrajesD[] =  $row["metraje"];
    }
}

foreach ($metrajesOmnidireccional as $row) {
    if ($row["metraje"] != " ") {
        $metrajesO[] =  $row["metraje"];
    }
}

$unionMetraje = $metrajesO + $metrajesD;
$entregable = [];


for ($i = 0; $i < sizeof($unionMetraje); $i++) {



    $datos->fecha = $data->fecha;
    $datos->prueba = $data->prueba;
    $datos->tag = $data->tag;
    $datos->metraje = $unionMetraje[$i];

    if (
        $datos->getLecturasDireccional() &&
        $datos->getLecturasOmnidireccional()
    ) {

        $registrosDirecional = $datos->getLecturasDireccional();
        $registrosOmnidireccional = $datos->getLecturasOmnidireccional();
       

        foreach ($registrosDirecional as $row) {
            if ($row["hora_tag"] != " ") {
                $hora_tag_D[] =  $row["hora_tag"];
                $minutosD[] = $row["tiempo_estimado"];
            }
        }


        foreach ($registrosOmnidireccional as $row) {
            if ($row["hora_tag"] != " ") {
                $hora_tag_O[] =  $row["hora_tag"];
                $minutosO[] = $row["tiempo_estimado"];
            }
        }


        $unionTag = $hora_tag_O + $hora_tag_D;
        $maximoHora = max($minutosO, $minutosD);

        

        for ($j = 0; $j < sizeof($maximoHora); $j++) {
          
            switch ($maximoHora[$j]) {
                case "60":
                  
                    $porcentaje = (sizeof($unionTag) * 100) / $estimacion1;

                    if ($porcentaje > 100) {
                        $porcentaje = 100;
                        http_response_code(201);
                        $entregable[$i] = array(
                            "tag" => $data->tag,
                            "censos" => sizeof($unionTag),
                            "metraje" => strval($unionMetraje[$i]),
                            "porcentajeLecturas" => $porcentaje
                        );
                    }else{
                        http_response_code(201);
                        $entregable[$i] = array(
                            "tag" => $data->tag,
                            "censos" => sizeof($unionTag),
                            "metraje" => strval($unionMetraje[$i]),
                            "porcentajeLecturas" => $porcentaje
                        );
                    }

                    break;

                case "120":
                    $porcentaje = (sizeof($unionTag) * 100) / $estimacion2;
                    if ($porcentaje > 100) {
                        $porcentaje = 100;
                        http_response_code(201);
                        $entregable[$i] = array(
                            "tag" => $data->tag,
                            "censos" => sizeof($unionTag),
                            "metraje" => strval($unionMetraje[$i]),
                            "porcentajeLecturas" => $porcentaje
                        );
                    }else{
                        http_response_code(201);
                        $entregable[$i] = array(
                            "tag" => $data->tag,
                            "censos" => sizeof($unionTag),
                            "metraje" => strval($unionMetraje[$i]),
                            "porcentajeLecturas" => $porcentaje
                        );
                    }
                    

                    break;

                case "180":
                    $porcentaje = (sizeof($unionTag) * 100) / $estimacion3;
                    if ($porcentaje > 100) {
                        $porcentaje = 100;
                        http_response_code(201);
                        $entregable[$i] = array(
                            "tag" => $data->tag,
                            "censos" => sizeof($unionTag),
                            "metraje" => strval($unionMetraje[$i]),
                            "porcentajeLecturas" => $porcentaje
                        );
                    }else{
                        http_response_code(201);
                        $entregable[$i] = array(
                            "tag" => $data->tag,
                            "censos" => sizeof($unionTag),
                            "metraje" => strval($unionMetraje[$i]),
                            "porcentajeLecturas" => $porcentaje
                        );
                    }

                    break;

                case "240":
                    $porcentaje = (sizeof($unionTag) * 100) / $estimacion4;
                    if ($porcentaje > 100) {
                        $porcentaje = 100;
                        http_response_code(201);
                        $entregable[$i] = array(
                            "tag" => $data->tag,
                            "censos" => sizeof($unionTag),
                            "metraje" => strval($unionMetraje[$i]),
                            "porcentajeLecturas" => $porcentaje
                        );
                    }else{
                        http_response_code(201);
                        $entregable[$i] = array(
                            "tag" => $data->tag,
                            "censos" => sizeof($unionTag),
                            "metraje" => strval($unionMetraje[$i]),
                            "porcentajeLecturas" => $porcentaje
                        );
                    }

                    break;

                case "300":
                    $porcentaje = (sizeof($unionTag) * 100) / $estimacion5;
                    if ($porcentaje > 100) {
                        $porcentaje = 100;
                        http_response_code(201);
                        $entregable[$i] = array(
                            "tag" => $data->tag,
                            "censos" => sizeof($unionTag),
                            "metraje" => strval($unionMetraje[$i]),
                            "porcentajeLecturas" => $porcentaje
                        );
                    }else{
                        http_response_code(201);
                        $entregable[$i] = array(
                            "tag" => $data->tag,
                            "censos" => sizeof($unionTag),
                            "metraje" => strval($unionMetraje[$i]),
                            "porcentajeLecturas" => $porcentaje
                        );
                    }


                    break;
            }
        }

        if ($minutosD != null && $minutosO != null) {
            $minutosD = [];
            $minutosO = [];
        }

        if ($hora_tag_D != null && $hora_tag_O != null) {
            $hora_tag_D = [];
            $hora_tag_O = [];
        }
    }else{
        $registrosDirecional = [];
        $registrosOmnidireccional = [];
        $unionTag = [];
        $maximoHora  = [];
    }
}

$listafinal = [];

for ($i = 0; $i <= sizeof($entregable); $i++) {
    if (array_key_exists($i, $entregable)) {
        array_push($listafinal, $entregable[$i]);
    }
}
echo json_encode(array(
    "lista" => $listafinal,
    "tamanoO" => sizeof($registrosOmnidireccional),
    "tamañoD" => sizeof($registrosDirecional),
    "tamañoUnion" => sizeof($unionTag),
    "tamañoMaximoHoras" => sizeof($maximoHora)
));


<?php

class Complementaria
{

    private $conn;
    private $table_name = "complementaria";

    public $id_complementaria;
    public $prueba;
    public $antena;
    public $metraje;
    public $tag;
    public $porcentaje_efectividad;
    public $lecturas;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function insertComplementaria()
    {
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    prueba = :prueba,
                    metraje = :metraje,
                    tag = :tag,
                    porcentaje_efectividad = :porcentaje_efectividad,
                    lecturas = :lecturas";

        $stmt = $this->conn->prepare($query);

        $this->prueba=htmlspecialchars(strip_tags($this->prueba));
        $this->antena=htmlspecialchars(strip_tags($this->antena));
        $this->metraje=htmlspecialchars(strip_tags($this->metraje));
        $this->tag=htmlspecialchars(strip_tags($this->tag));
        $this->porcentaje_efectividad=htmlspecialchars(strip_tags($this->porcentaje_efectividad));
        $this->lecturas=htmlspecialchars(strip_tags($this->lecturas));

        $stmt->bindParam(':prueba', $this->prueba);
        $stmt->bindParam(':metraje', $this->metraje);
        $stmt->bindParam(':tag', $this->tag);
        $stmt->bindParam(':porcentaje_efectividad', $this->porcentaje_efectividad);
        $stmt->bindParam(':lecturas', $this->lecturas);

        if($stmt->execute()){
            return true;
        }
     
        return false;
        
    }
}

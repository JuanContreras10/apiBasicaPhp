<?php
/**
 * modelo de antenas y metos con select,inserts, updates, deletes a la bdd
 */
class Antenas
{

    private $conn;
    private $table_name_1 = "pruebas_direccional";
    private $table_name_2 = "pruebas_omnidireccional";

    public $antena;
    public $metraje;
    public $prueba;
    public $fecha;
    public $hora_incial;
    public $tag;
    public $hora_tag;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function getDatos()
    {
        $query = "SELECT 
                    pruebas_omnidireccional.antena as antena_omnidireccional,
                    pruebas_direccional.antena as antena_direccional,
                    pruebas_omnidireccional.metraje as metraje_omnidireccional,
                    pruebas_direccional.metraje as metraje_direccional,
                    pruebas_omnidireccional.hora_inicial as hora_inicial_omnidireccional,
                    pruebas_direccional.hora_inicial as hora_inicial_direccional, 
                    pruebas_omnidireccional.tag as tag_omnidireccional,
                    pruebas_direccional.tag as tag_direccional,
                    pruebas_omnidireccional.hora_tag as hora_tag_omnidireccional,
                    pruebas_direccional.hora_tag as hora_tag_direecional 
                    FROM " . $this->table_name_2 . " 
                    INNER JOIN " . $this->table_name_1 . " 
                    on pruebas_omnidireccional.id_prueba = pruebas_direccional.id_prueba";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getLecturasDireccional()
    {
        $query = "SELECT * 
                    FROM " . $this->table_name_1 . " 
                    WHERE fecha = :fecha 
                    AND prueba = :prueba
                    AND tag = :tag 
                    AND metraje = :metraje";

        $stmt = $this->conn->prepare($query);

        $this->fecha = htmlspecialchars(strip_tags($this->fecha));
        $this->prueba = htmlspecialchars(strip_tags($this->prueba));
        $this->tag = htmlspecialchars(strip_tags($this->tag));
        $this->metraje = htmlspecialchars(strip_tags($this->metraje));

        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":prueba", $this->prueba);
        $stmt->bindParam(":tag", $this->tag);
        $stmt->bindParam(":metraje", $this->metraje);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getLecturasOmnidireccional()
    {
        $query = "SELECT * 
                    FROM " . $this->table_name_2 . " 
                    WHERE fecha = :fecha 
                    AND prueba = :prueba
                    AND tag = :tag 
                    AND metraje = :metraje";

        $stmt = $this->conn->prepare($query);

        $this->fecha = htmlspecialchars(strip_tags($this->fecha));
        $this->prueba = htmlspecialchars(strip_tags($this->prueba));
        $this->tag = htmlspecialchars(strip_tags($this->tag));
        $this->metraje = htmlspecialchars(strip_tags($this->metraje));

        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":prueba", $this->prueba);
        $stmt->bindParam(":tag", $this->tag);
        $stmt->bindParam(":metraje", $this->metraje);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getMetrajesDireccional()
    {

        $query = "SELECT DISTINCT metraje 
                  FROM " . $this->table_name_1 . " 
                  WHERE prueba = :prueba";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":prueba", $this->prueba);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getMetrajesOmnidirecional()
    {

        $query = "SELECT DISTINCT metraje 
                  FROM " . $this->table_name_2 . " 
                  WHERE prueba = :prueba";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":prueba", $this->prueba);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getD()
    {
        $query = "SELECT * 
                    FROM " . $this->table_name_1 . " 
                    WHERE fecha = :fecha 
                    AND prueba = :prueba
                    AND tag = :tag ";

        $stmt = $this->conn->prepare($query);

        $this->fecha = htmlspecialchars(strip_tags($this->fecha));
        $this->prueba = htmlspecialchars(strip_tags($this->prueba));
        $this->tag = htmlspecialchars(strip_tags($this->tag));

        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":prueba", $this->prueba);
        $stmt->bindParam(":tag", $this->tag);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getO()
    {
        $query = "SELECT * 
                    FROM " . $this->table_name_2 . " 
                    WHERE fecha = :fecha 
                    AND prueba = :prueba
                    AND tag = :tag ";

        $stmt = $this->conn->prepare($query);

        $this->fecha = htmlspecialchars(strip_tags($this->fecha));
        $this->prueba = htmlspecialchars(strip_tags($this->prueba));
        $this->tag = htmlspecialchars(strip_tags($this->tag));

        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":prueba", $this->prueba);
        $stmt->bindParam(":tag", $this->tag);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function deleteD()
    {
        $query = "DELETE FROM ". $this->table_name_1. " 
                WHERE prueba = :prueba 
                AND fecha = :fecha";

        $stmt = $this->conn->prepare($query);

        $this->prueba = htmlspecialchars(strip_tags($this->prueba));
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));

        $stmt->bindParam(":prueba", $this->prueba);
        $stmt->bindParam(":fecha", $this->fecha);

        if($stmt->execute()){
            return true;
        }
     
        return false;

    }

    function deleteO()
    {
        $query = "DELETE FROM ". $this->table_name_1. " 
                WHERE prueba = :prueba 
                AND fecha = :fecha";

        $stmt = $this->conn->prepare($query);

        $this->prueba = htmlspecialchars(strip_tags($this->prueba));
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));

        $stmt->bindParam(":prueba", $this->prueba);
        $stmt->bindParam(":fecha", $this->fecha);

        if($stmt->execute()){
            return true;
        }
     
        return false;

    }



}

?>
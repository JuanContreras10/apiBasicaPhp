<?php
/**
 * clase de conexion con PDO
 * puedes modificar los datos de conexion para que se ajusten a tu desarrollo
 */
class Database
{
    // variables privadas que se insertaran en PDO
    private $host = "localhost";
    private $db_name = "pruebas_campo";
    private $username = "root";
    private $password = "";

    public $conn;
    //metodo para poder conectarnos a la bdd
    public function getConnection()
    {
        //nuestra variable con declarada arriba
        $this->conn = null;
        //contry catch para obtenar algun error que se pueda presentar crearmos la conexion a la bdd
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        //se retorna la variable conn con la conexion establecida
        return $this->conn;
    }
}
?>

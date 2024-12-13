<?php 
class DbWork {
    public $conexion;
    public $error;
    public $db;
    public $numrows;
    private $user;
    private $pass;

    function connect() {
        $this->user = 'root';
        $this->pass = '';
        $this->db = 'webpage_app';
        $str_conn="mysql:host=localhost;dbname=".$this->db.";charset=UTF8";
        try{
            $this->conexion = new PDO($str_conn, $this->user, $this->pass);
            $this->error = "SIN ERROR";
            return true;
        }
        catch (PDOException $e){
            $this->error = 'Connection failed: ' . $e->getMessage();
            return false; 
        }
    }

    function execute($sql=null) {
        if (empty($sql)) {
            $this->error = "No se recibio sentencia SQL para ejecutar.";
        } else {
            if (empty($this->conexion)) {
                # code...
                $this->error = "No existe conexion activa a base de datos.";
                return false;
            } else {
                try {
                    $rs = $this->conexion->query($sql);
                    if ($rs===false) {
                        return false;
                    }
                    $this->numrows = $rs->rowCount();
                    return $rs;
                } catch (PDOException $e) {
                    $this->error = $e->getMessage();
                    return false;
                }
            }
        }
    }
}
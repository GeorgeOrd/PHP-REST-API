<?php

class  db
{
    /*Se ubica la información de nuestra BD en el archivo 
    config para evitar problemas de referencia*/
    private $server;
    private $user;
    private $password;
    private $database;
    private $port;
    private $conexion;

    function __construct()
    {
        $dataList = $this->dbConnect();
        foreach ($dataList as $key => $value) {
            $this->server = $value['server'];
            $this->user = $value['user'];
            $this->password = $value['password'];
            $this->database = $value['database'];
            $this->port = $value['port'];
        }

        $this->conexion = new mysqli($this->server, $this->user, $this->password, $this->database, $this->port);

        if ($this->conexion->connect_errno) {
            echo "Error de conexion a la base de datos";
            die();
        }
    }
    //Conexion a la base de datps
    private function dbConnect()
    {
        $dir = dirname(__FILE__);
        $jsondata = file_get_contents($dir . "/" . "config");
        return json_decode($jsondata, true);
    }

    //Funcion para evitar errores con caracteres especiales del español
    private function convertUTF8($array)
    {
        array_walk_recursive($array, function (&$item, $key) {
            if (!mb_detect_encoding($item, 'utf-8', true)) {

                $item = utf8_encode($item);
            }
        });
        return $array;
    }

    public function getInfo($sql)
    {
        $result = $this->conexion->query($sql);
        $resultArray = array();
        foreach ($result as $key) {
            $resultArray[] = $key;
        }
        return $this->convertUTF8($resultArray);
    }

    public function nonQuery($sql)
    {
        $result = $this->conexion->query($sql);
        return $this->conexion->affected_rows;
    }

    //Metodo para INGRESAR información en uan columna
    public function nonQueryID($sql)
    {
        $result = $this->conexion->query($sql);
        $rows = $this->conexion->affected_rows;
        if ($rows >= 1) {
            return $this->conexion->insert_id;
        } else {
            return 0;
        }
    }
}

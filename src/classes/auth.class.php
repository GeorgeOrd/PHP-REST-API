<?php
require_once 'src/database/db.php';
require_once 'response.class.php';

//Herencia de clases
class auth extends db
{

    public function login($json)
    {
        $_response = new responses;
        $data = json_decode($json, true);
        if (!isset($data['user']) || !isset($data['password'])) {
            return $_response->error__400();
        } else {
            $user = $data['user'];
            $password = $data['password'];
            $data = $this->getEmpData($user);
            if ($data) {
                if ($password == $data[0]['emp_cedula']) {
                } else {
                    return $_response->error__200("El #de cedula es incorrecto");
                }
            } else {
                return $_response->error__200("El empleado $user no existe");
            }
        }
    }

    private function getEmpData($emp_name)
    {
        $query = "SELECT * FROM tbl_empleado WHERE emp_nombre =  '$emp_name'";
        $emp_data = parent::getInfo($query);

        if (isset($emp_data[0]["emp_nombre"])) {
            return $emp_data;
        } else {
            return 0;
        }
    }

    //     private function insertToken($userid)
    //     {
    //         $val = true;
    //         $token = bin2hex(openssl_random_pseudo_bytes(16, $val));
    //         $date = date("Y-m-d H:i");
    //     }
}

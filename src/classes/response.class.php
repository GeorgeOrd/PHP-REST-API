<?php

class responses
{

    private $response = [
        'status' => "ok",
        "result" => array()
    ];

    public function error__405()
    {
        $this->response['status'] = "error";
        $this->response['result'] = array(
            "error_id" => "405",
            "error_message" => "Metodo no permitido"
        );
        return $this->response;
    }

    public function error__400()
    {
        $this->response['status'] = "error";
        $this->response['result'] = array(
            "error_id" => "400",
            "error_msg" => "Datos incompletos o con formato incorrecto"
        );
        return $this->response;
    }

    public function error__200($value = "Datos Incorrectos")
    {
        $this->response['status'] = "error";
        $this->response['result'] = array(
            "error_id" => "200",
            "error_m" => $value
        );
        return $this->response;
    }
}

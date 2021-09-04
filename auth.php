<?php
require_once 'src/classes/auth.class.php';
require_once 'src/classes/response.class.php';

$_response = new responses;
$_auth = new auth;

//Solo se obtiene la informacion por el metodo POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $post_body = file_get_contents("php://input");
    $login = $_auth->login($post_body);
    print_r(json_encode($login));
} else {
    echo "metodo no permitido";
}

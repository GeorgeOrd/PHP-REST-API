<?php

include "src/database/db.php";

$con = new db();
$compra = "SELECT tbl_empleado.emp_nombre,tbl_empleado.emp_apellido,tbl_empleado.emp_cedula,
        tbl_cliente.cln_nombre, tbl_cliente.cln_apellido, tbl_cliente.cln_cedula, tbl_cliente.cln_correo,
        tbl_producto.prd_nombre, tbl_producto.prd_precio,tbl_compra.cmp_cantidad,
        tbl_compra.cmp_fecha FROM tbl_compra
        JOIN tbl_empleado ON tbl_empleado.emp_id = tbl_compra.id_empleado
        JOIN tbl_cliente ON tbl_cliente.cln_id = tbl_compra.id_cliente
        JOIN tbl_producto ON tbl_producto.prd_id = tbl_compra.id_producto";
$res = $con->getInfo($compra);

function arrayToXML($array, &$xmlVentaInfo)
{
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            if (!is_numeric($key)) {
                $subnode = $xmlVentaInfo->addChild("$key");
                arrayToXML($value, $subnode);
            } else {
                $subnode = $xmlVentaInfo->addChild("item$key");
                arrayToXML($value, $subnode);
            }
        } else {
            $xmlVentaInfo->addChild("$key", htmlspecialchars("$value"));
        }
    }
}

$xmlVentaInfo = new SimpleXMLElement("<?xml version='1.0'?><DetalleCompra></DetalleCompra>");


arrayToXML($res, $xmlVentaInfo);


$xml_file = $xmlVentaInfo->asXML('facturas.xml');


if ($xml_file) {
    echo 'Se ha generado el XML de manera existosa.';
} else {
    echo 'error generando el xml.';
}

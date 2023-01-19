<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/dataBase/DBEntradas.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/dataBase/DBSaidas.php';

if (isset($_REQUEST['dataBusca'])) {
    $data = $_REQUEST['dataBusca'];

    $_REQUEST['listaEntradas'] = listarEntradas($data);
    $_REQUEST['listaSaidas'] = listarSaidas($data);
}

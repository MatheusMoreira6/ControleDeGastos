<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/dataBase/DBEntradas.php';

if (isset($_REQUEST['dataBusca'])) {
    $data = $_REQUEST['dataBusca'];

    $_REQUEST['listaEntradas'] = listarEntradas($data);
}

if (isset($_POST['idDeletarEntrada'])) {
    $id = $_POST['idDeletarEntrada'];

    deletarEntrada($id);

    $_POST['idDeletarEntrada'] = null;

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

if (
    isset($_POST['nomeEntrada']) &
    isset($_POST['categoriaEntrada']) &
    isset($_POST['dataEntrada']) &
    isset($_POST['valorEntrada']) &
    isset($_POST['descricaoEntrada'])
) {
    $nomeEntrada = $_POST['nomeEntrada'];
    $categoriaEntrada = $_POST['categoriaEntrada'];
    $dataEntrada = $_POST['dataEntrada'];
    $valorEntrada = $_POST['valorEntrada'];
    $descricaoEntrada = $_POST['descricaoEntrada'];

    inserirEntrada($nomeEntrada, $descricaoEntrada, $categoriaEntrada, $dataEntrada, $valorEntrada);

    $_POST['nomeEntrada'] = null;
    $_POST['categoriaEntrada'] = null;
    $_POST['dataEntrada'] = null;
    $_POST['valorEntrada'] = null;
    $_POST['descricaoEntrada'] = null;

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

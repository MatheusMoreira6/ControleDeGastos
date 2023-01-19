<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/dataBase/DBSaidas.php';

if (isset($_REQUEST['dataBusca'])) {
    $data = $_REQUEST['dataBusca'];

    $_REQUEST['listaSaidas'] = listarSaidas($data);
}

if (isset($_POST['idDeletarSaida'])) {
    $id = $_POST['idDeletarSaida'];

    deletarSaida($id);

    $_POST['idDeletarSaida'] = null;

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

if (
    isset($_POST['nomeSaida']) &
    isset($_POST['categoriaSaida']) &
    isset($_POST['dataSaida']) &
    isset($_POST['valorSaida']) &
    isset($_POST['descricaoSaida'])
) {
    $nomeSaida = $_POST['nomeSaida'];
    $categoriaSaida = $_POST['categoriaSaida'];
    $dataSaida = $_POST['dataSaida'];
    $valorSaida = $_POST['valorSaida'];
    $descricaoSaida = $_POST['descricaoSaida'];

    inserirSaida($nomeSaida, $descricaoSaida, $categoriaSaida, $dataSaida, $valorSaida);

    $_POST['nomeSaida'] = null;
    $_POST['categoriaSaida'] = null;
    $_POST['dataSaida'] = null;
    $_POST['valorSaida'] = null;
    $_POST['descricaoSaida'] = null;

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

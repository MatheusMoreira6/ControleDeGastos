<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/dataBase/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/entidades/Entrada.php';

function listarEntradas($data)
{
    $conexao = Conexao::getConexao();

    $dataEntrada = explode("-", mysqli_real_escape_string($conexao, $data));
    $anoEntrada = $dataEntrada[0];
    $mesEntrada = $dataEntrada[1];

    $primeiroDia = $anoEntrada . "-" . $mesEntrada . "-01";
    $ultimoDia = $anoEntrada . "-" . $mesEntrada . "-" . date("t", mktime(0, 0, 0, $mesEntrada, '01', $anoEntrada));

    $query = "SELECT * FROM ENTRADAS WHERE DATA_ENTRADA >= '$primeiroDia' AND DATA_ENTRADA <= '$ultimoDia'";

    $resultado = $conexao->query($query);

    $arrayEntradas = [];
    if ($resultado->num_rows > 0) {
        foreach ($resultado as $valores) {
            $entrada = new Entrada();

            $entrada->setId($valores["ID"]);
            $entrada->setNome($valores["NOME"]);
            $entrada->setDescricao($valores["DESCRICAO"]);
            $entrada->setCategoria($valores["CATEGORIA"]);
            $entrada->setDataEntrada($valores["DATA_ENTRADA"]);
            $entrada->setValor($valores["VALOR"]);

            $arrayEntradas[] = $entrada;
        }
    }
    return ($arrayEntradas);
}

function inserirEntrada($nome, $descricao, $categoria, $dataEntrada, $valor)
{
    $conexao = Conexao::getConexao();
    $nome = mysqli_real_escape_string($conexao, $nome);
    $descricao = mysqli_real_escape_string($conexao, $descricao);
    $categoria = mysqli_real_escape_string($conexao, $categoria);
    $dataEntrada = mysqli_real_escape_string($conexao, $dataEntrada);
    $valor = mysqli_real_escape_string($conexao, $valor);
    $valor = str_replace(",", ".", $valor);

    $query = "INSERT INTO ENTRADAS (NOME, DESCRICAO, CATEGORIA, DATA_ENTRADA, VALOR) VALUES ('$nome', '$descricao', '$categoria', '$dataEntrada', '$valor')";


    if (!$conexao->query($query)) {
        echo "Error: " . $query . "<br>" . mysqli_error($conexao);
    }
}

function deletarEntrada($id)
{
    $conexao = Conexao::getConexao();
    $id = mysqli_real_escape_string($conexao, $id);

    $query = "DELETE FROM ENTRADAS WHERE ID = '$id'";

    if (!$conexao->query($query)) {
        echo "Error: " . $query . "<br>" . mysqli_error($conexao);
    }
}

function fecharConexaoEntrada()
{
    mysqli_close(Conexao::getConexao());
}

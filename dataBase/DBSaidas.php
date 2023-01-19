<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/dataBase/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/entidades/Saida.php';

function listarSaidas($data)
{
    $conexao = Conexao::getConexao();

    $dataSaida = explode("-", mysqli_real_escape_string($conexao, $data));
    $anoSaida = $dataSaida[0];
    $mesSaida = $dataSaida[1];

    $primeiroDia = $anoSaida . "-" . $mesSaida . "-01";
    $ultimoDia = $anoSaida . "-" . $mesSaida . "-" . date("t", mktime(0, 0, 0, $mesSaida, '01', $anoSaida));

    $query = "SELECT * FROM SAIDAS WHERE DATA_SAIDA >= '$primeiroDia' AND DATA_SAIDA <= '$ultimoDia'";

    $resultado = $conexao->query($query);

    $arraySaidas = [];
    if ($resultado->num_rows > 0) {
        foreach ($resultado as $valores) {
            $saida = new Saida();

            $saida->setId($valores["ID"]);
            $saida->setNome($valores["NOME"]);
            $saida->setDescricao($valores["DESCRICAO"]);
            $saida->setCategoria($valores["CATEGORIA"]);
            $saida->setDataSaida($valores["DATA_SAIDA"]);
            $saida->setValor($valores["VALOR"]);

            $arraySaidas[] = $saida;
        }
    }

    return ($arraySaidas);
}

function inserirSaida($nome, $descricao, $categoria, $dataSaida, $valor)
{
    $conexao = Conexao::getConexao();
    $nome = mysqli_real_escape_string($conexao, $nome);
    $descricao = mysqli_real_escape_string($conexao, $descricao);
    $categoria = mysqli_real_escape_string($conexao, $categoria);
    $dataSaida = mysqli_real_escape_string($conexao, $dataSaida);
    $valor = mysqli_real_escape_string($conexao, $valor);
    $valor = str_replace(",", ".", $valor);

    $query = "INSERT INTO SAIDAS (NOME, DESCRICAO, CATEGORIA, DATA_SAIDA, VALOR) VALUES ('$nome', '$descricao', '$categoria', '$dataSaida', '$valor')";

    if (!$conexao->query($query)) {
        echo "Error: " . $query . "<br>" . mysqli_error($conexao);
    }
}

function deletarSaida($id)
{
    $conexao = Conexao::getConexao();
    $id = mysqli_real_escape_string($conexao, $id);

    $query = "DELETE FROM SAIDAS WHERE ID = '$id'";

    if (!$conexao->query($query)) {
        echo "Error: " . $query . "<br>" . mysqli_error($conexao);
    }
}

function fecharConexaoSaida()
{
    mysqli_close(Conexao::getConexao());
}

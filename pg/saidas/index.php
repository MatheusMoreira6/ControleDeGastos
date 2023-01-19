<?php
if (empty($_REQUEST['dataBusca'])) {
    $_REQUEST['dataBusca'] = date("Y-m");
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/funcoes/telaSaidas.php';

$listaSaidas = $_REQUEST['listaSaidas'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Saídas | Controle de Gastos</title>

    <link rel="stylesheet" href="/css/stylepg.css">
    <link rel="shortcut icon" href="/img/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>
    <header>
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo">
                    <i class="material-icons" id="iconLogo">monetization_on</i>CG | Saídas
                </a>

                <a href="#" class="sidenav-trigger" data-target="mobile-demo">
                    <i class="material-icons">menu</i>
                </a>

                <ul class="right hide-on-med-and-down" id="nav-mobile">
                    <li>
                        <form id="formularioDataBarra" action="./" method="post">
                            <input id="dataInputBarra" type="month" name="dataBusca" value="<?php echo ($_REQUEST['dataBusca']) ?>">
                            <a class="right" id="botaoBuscarBarra" type="submit"><i class="material-icons">search</i></a>
                        </form>
                    </li>
                    <li>
                        <a href="/"><i class="material-icons left">home</i>Home</a>
                    </li>
                    <li>
                        <a href="/pg/entradas/"><i class="material-icons left">add_circle</i>Entradas</a>
                    </li>
                    <li>
                        <a href=""><i class="material-icons left">exit_to_app</i>Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <ul class="sidenav" id="mobile-demo">
            <li id="liInput">
                <form id="formularioDataMobile" action="./" method="post">
                    <input id="dataInputMobile" type="month" name="dataBusca" value="<?php echo ($_REQUEST['dataBusca']) ?>">
                    <a class="right" id="botaoBuscarMobile" type="submit"><i class="material-icons">search</i></a>
                </form>
            </li>
            <li>
                <a href="/"><i class="material-icons left">home</i>Home</a>
            </li>
            <li>
                <a href="/pg/entradas/"><i class="material-icons left">add_circle</i>Entradas</a>
            </li>
            <li>
                <a href=""><i class="material-icons left">exit_to_app</i>Logout</a>
            </li>
        </ul>
    </header>

    <main>
        <div class="row">
            <div class="col s12 m12 l8 conteudo">
                <div class="z-depth-2 conteudoInterno">
                    <div id="tituloBotoes">
                        <h2 class="titulo">Saídas</h2>

                        <div id="botoes">
                            <button class="btn modal-trigger" data-target="modalBoxCadastrar">
                                <i class="material-icons">add</i>
                            </button>
                            <button class="btn modal-trigger" data-target="modalBoxDeletar">
                                <i class="material-icons">delete</i>
                            </button>
                        </div>
                    </div>

                    <hr>

                    <table class="striped responsive-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Categoria</th>
                                <th>Data</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody id="saidas">
                            <?php
                            foreach ($listaSaidas as $saida) {
                                $id = $saida->getId();
                                $nome = $saida->getNome();
                                $descricao = $saida->getDescricao();
                                $categoria = $saida->getCategoria();
                                $data = $saida->getDataSaida();
                                $valor = $saida->getValor();

                                echo ("
                                    <tr>
                                        <td>$id</td>
                                        <td>$nome</td>
                                        <td>$descricao</td>
                                        <td class='categoria'>$categoria</td>
                                        <td>$data</td>
                                        <td class='valor'>$valor</td>
                                    </tr>
                                ");
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col s12 m12 l4 conteudo">
                <div class="z-depth-2 center conteudoInterno">
                    <h2 class="titulo">Resumo</h2>

                    <hr>

                    <div id="pizzaContainer"></div>

                    <h4 class="flow-text" id="saldo"></h4>
                </div>
            </div>
        </div>

        <div id="modalBoxCadastrar" class="modal modal-fixed-footer">
            <h3 class="center">Cadastrar Saída</h3>

            <hr>

            <div class="modal-content">
                <div class="row">
                    <form class="col s12" id="formularioCadastrar" action="/funcoes/telaSaidas.php" method="post">
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="nomeSaida" class="validate" name="nomeSaida" placeholder="" type="text">
                                <label for="nomeSaida">Nome</label>
                            </div>
                            <div class="input-field col s6">
                                <select id="categoriaSaida" name="categoriaSaida">
                                    <option value="" disabled selected>Selecione</option>
                                    <option value="Boleto">Boleto</option>
                                    <option value="Fatura">Fatura</option>
                                    <option value="Divida">Divida</option>
                                    <option value="Outro">Outro</option>
                                </select>
                                <label>Categoria</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="dataSaida" class="validate" name="dataSaida" type="date" value="">
                                <label for="dataSaida">Data</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="valorSaida" class="validate" name="valorSaida" placeholder="R$" type="text">
                                <label for="valorSaida">Valor</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="descricaoSaida" class="validate" name="descricaoSaida" placeholder="" type="text">
                                <label for="descricaoSaida">Descrição</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="modal-close waves-effect waves-green btn-flat" id="salvar">Salvar</button>
                <button class="modal-close waves-effect waves-green btn-flat">Cancelar</button>
            </div>
        </div>

        <div id="modalBoxDeletar" class="modal modal-fixed-footer">
            <h3 class="center">Deletar Saida</h3>

            <hr>

            <div class="modal-content">
                <div class="row">
                    <form class="col s12" id="formularioDeletar" action="/funcoes/telaSaidas.php" method="post">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="idSaida" class="validate" name="idDeletarSaida" placeholder="Informe o ID" type="number">
                                <label for="idSaida">ID</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="modal-close waves-effect waves-green btn-flat" id="deletar">Deletar</button>
                <button class="modal-close waves-effect waves-green btn-flat">Cancelar</button>
            </div>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="/js/componentes.js"></script>
    <script type="text/javascript" src="/js/modal.js"></script>
    <script type="text/javascript" src="./js/grafico.js"></script>
</body>

</html>
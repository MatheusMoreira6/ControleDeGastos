<?php
if (empty($_REQUEST['dataBusca'])) {
    $_REQUEST['dataBusca'] = date("Y-m");
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/funcoes/telaInicial.php';

$listaEntradas = $_REQUEST['listaEntradas'];
$listaSaidas = $_REQUEST['listaSaidas'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Controle de Gastos</title>

    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./img/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>
    <header>
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo">
                    <i class="material-icons" id="iconLogo">monetization_on</i>Controle de Gastos
                </a>

                <a href="#" class="sidenav-trigger" data-target="mobile-demo">
                    <i class="material-icons">menu</i>
                </a>

                <ul class="right hide-on-med-and-down" id="nav-mobile">
                    <li>
                        <form id="formularioDataBarra" action="/" method="post">
                            <input id="dataInputBarra" type="month" name="dataBusca" value="<?php echo ($_REQUEST['dataBusca']) ?>">
                            <a class="right" id="botaoBuscarBarra" type="submit"><i class="material-icons">search</i></a>
                        </form>
                    </li>
                    <li>
                        <a href="./pg/entradas/"><i class="material-icons left">add_circle</i>Entradas</a>
                    </li>
                    <li>
                        <a href="./pg/saidas/"><i class="material-icons left">remove_circle</i>Saídas</a>
                    </li>
                    <li>
                        <a href=""><i class="material-icons left">exit_to_app</i>Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <ul class="sidenav" id="mobile-demo">
            <li id="liInput">
                <form id="formularioDataMobile" action="/" method="post">
                    <input id="dataInputMobile" type="month" name="dataBusca" value="<?php echo ($_REQUEST['dataBusca']) ?>">
                    <a class="right" id="botaoBuscarMobile" type="submit"><i class="material-icons">search</i></a>
                </form>
            </li>
            <li>
                <a href="./pg/entradas/"><i class="material-icons left">add_circle</i>Entradas</a>
            </li>
            <li>
                <a href="./pg/saidas/"><i class="material-icons left">remove_circle</i>Saídas</a>
            </li>
            <li>
                <a href=""><i class="material-icons left">exit_to_app</i>Logout</a>
            </li>
        </ul>
    </header>

    <main>
        <div class="row">
            <div class="col s12 m12 l4 conteudo">
                <div class="z-depth-2 conteudoInterno">
                    <h2 class="center">Entradas</h2>

                    <hr>

                    <table class="striped responsive-table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Valor</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody id="entradas">
                            <?php
                            foreach ($listaEntradas as $entrada) {
                                $nome = $entrada->getNome();
                                $valor = $entrada->getValor();
                                $data = $entrada->getDataEntrada();

                                echo ("
                                    <tr>
                                        <td>$nome</td>
                                        <td class='entrada'>$valor</td>
                                        <td>$data</td>
                                    </tr>
                                ");
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col s12 m12 l4 conteudo">
                <div class="z-depth-2 conteudoInterno">
                    <h2 class="center">Saídas</h2>

                    <hr>

                    <table class="striped responsive-table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Valor</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody id="saidas">
                            <?php
                            foreach ($listaSaidas as $saida) {
                                $nome = $saida->getNome();
                                $valor = $saida->getValor();
                                $data = $saida->getDataSaida();

                                echo ("
                                    <tr>
                                        <td>$nome</td>
                                        <td class='saida'>$valor</td>
                                        <td>$data</td>
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
                    <h2>Resumo</h2>

                    <hr>

                    <div id="pizzaContainer"></div>

                    <h4 class="flow-text" id="saldo"></h4>
                </div>
            </div>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="./js/componentes.js"></script>
    <script type="text/javascript" src="./js/grafico.js"></script>
</body>

</html>
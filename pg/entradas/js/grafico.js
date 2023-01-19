$(function () {
    //Implementação da soma dos dados para o grafico
    var valores = document.getElementsByClassName("valor");
    var totalEntradas = 0.0;

    for (var i = 0; i < valores.length; i++) {
        var string = valores[i].innerHTML;

        string = string.replace("R$&nbsp;", "");
        string = string.replace(" ", "");
        string = string.replace(".", "");
        string = string.replace(",", ".");

        totalEntradas += parseFloat(string);
    }

    var saldo = document.getElementById("saldo");
    var valorFinal = totalEntradas.toLocaleString("pt-BR", { style: "currency", currency: "BRL", minimumFractionDigits: 2, maximumFractionDigits: 2 });
    saldo.innerHTML = "Total: " + valorFinal;

    var categorias = document.getElementsByClassName("categoria");

    var totalSalario = 0.0;
    var totalVenda = 0.0;
    var totalEmprestimo = 0.0;
    var totalOutro = 0.0;

    for (var i = 0; i < categorias.length; i++) {
        var string = categorias[i].innerHTML;

        if (string == "Salario") {
            totalSalario += 1;
        } else if (string == "Venda") {
            totalVenda += 1;
        } else if (string == "Emprestimo") {
            totalEmprestimo += 1;
        } else if (string == "Outro") {
            totalOutro += 1;
        }
    }

    //Implementação do Gráfico de Pizza
    google.charts.load('current', { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    document.body.onresize = function () {
        google.charts.setOnLoadCallback(drawChart);
    };

    function drawChart() {
        const container = document.querySelector('#pizzaContainer');
        var sizeContainer = container.clientWidth - 20;

        const data = new google.visualization.arrayToDataTable([
            ['Categoria', 'Valor'],
            ['Salario', totalSalario],
            ['Venda', totalVenda],
            ['Emprestimo', totalEmprestimo],
            ['Outros', totalOutro]
        ]);
        const options = {
            pieHole: 0.4,
            height: sizeContainer,
            width: sizeContainer,
            legend: {
                position: 'bottom',

                textStyle: {
                    fontSize: 14,
                }
            },
            chartArea: {
                width: '80%',
                height: '80%',
            }
        };

        const chart = new google.visualization.PieChart(container);
        chart.draw(data, options);
    }
});
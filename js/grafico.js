$(function () {
    //Implementação da soma dos dados para o grafico
    var entradas = document.getElementsByClassName("entrada");
    var saidas = document.getElementsByClassName("saida");

    var totalEntradas = 0.0;
    var totalSaidas = 0.0;

    for (var i = 0; i < entradas.length; i++) {
        var string = entradas[i].innerHTML;

        string = string.replace("R$&nbsp;", "");
        string = string.replace(" ", "");
        string = string.replace(".", "");
        string = string.replace(",", ".");

        totalEntradas += parseFloat(string);
    }

    for (var i = 0; i < saidas.length; i++) {
        var string = saidas[i].innerHTML;

        string = string.replace("R$&nbsp;", "");
        string = string.replace(" ", "");
        string = string.replace(".", "");
        string = string.replace(",", ".");

        totalSaidas += parseFloat(string);
    }

    var saldo = document.getElementById("saldo");
    var valorFinal = parseFloat(totalEntradas - totalSaidas);
    valorFinal = valorFinal.toLocaleString("pt-BR", { style: "currency", currency: "BRL", minimumFractionDigits: 2, maximumFractionDigits: 2 });
    saldo.innerHTML = "Saldo: " + valorFinal;

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
            ['Operação', 'Valor'],
            ['Entrada', totalEntradas],
            ['Saída', totalSaidas],
        ]);
        const options = {
            pieHole: 0.4,
            height: sizeContainer,
            width: sizeContainer,
            legend: 'none',
            chartArea: {
                width: '80%',
                height: '80%'
            }
        };

        const chart = new google.visualization.PieChart(container);
        chart.draw(data, options);
    }
});
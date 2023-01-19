$(function () {
    $(document).ready(function () {
        $('.modal').modal();
        $('select').formSelect();
    });

    $("#salvar").click(function () {
        $("#formularioCadastrar").submit();
    });

    $("#deletar").click(function () {
        $("#formularioDeletar").submit();
    })
});
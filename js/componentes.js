$(function () {
    $(document).ready(function () {
        $('.sidenav').sidenav();
    });

    $("#botaoBuscarBarra").click(function () {
        $("#formularioDataBarra").submit();
    });

    $("#botaoBuscarMobile").click("click", function () {
        $("#formularioDataMobile").submit();
    })
});
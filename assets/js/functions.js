// Sidebar
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

//  Datepicker
$(function() {
    $("#nascimento").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
    });
});

//Jquery Mask && Ajax filtro subcategorias
$(document).ready(function(){
    $('#nascimento').mask('00/00/0000');
    
    $('#categoria_user').change(function(){
        let idCategoria = $('#categoria_user').val();

        let url = 'filtrarSubcategorias/' + idCategoria;
         console.log(url)
        $.ajax({
            type: 'POST',
            data: {idCategoria: idCategoria},
            url: url,
            success: function(msg) {
                $("#subcategoria").html(msg)
            }
        });
    });
});
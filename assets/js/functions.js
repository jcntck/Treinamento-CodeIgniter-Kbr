// Sidebar
$("#menu-toggle").click(function (e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

//  Datepicker
$(function () {
    $("#nascimento").datepicker({
        altFormat: 'dd/mm/yy',
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
    });
});

//Jquery Mask , Ajax filtro subcategorias, JCROP
$(document).ready(function () {

    $('#nascimento').mask('00/00/0000');

    $('#categoria_user').change(function () {
        let idCategoria = $('#categoria_user').val();

        let urlBase = 'http://' + window.location.hostname + '/codeigniter/usuarios/filtrarSubcategorias';
        let local = window.location.pathname.split('/')[3]
        if (local == 'create') {
            $.ajax({
                type: 'POST',
                data: { idCategoria: idCategoria },
                url: urlBase,
                success: function (json) {
                    let subcategorias = JSON.parse(json)
                    let option = "<option value=''>-- Selecione uma subcategoria --</option>"
                    if (subcategorias.length > 0) {
                        $.each(subcategorias, function (i, obj) {
                            if (idCategoria == obj.categoria_id) {
                                if (i == 0) option += "<option value='" + obj.id + "' selected>" + obj.titulo + "</option>"
                                else option += "<option value='" + obj.id + "'>" + obj.titulo + "</option>"
                            }
                        })
                    }
                    $("#subcategoria").html(option);
                }
            });
        } else {
            $.ajax({
                type: 'POST',
                data: { idCategoria: idCategoria },
                url: urlBase,
                success: function (json) {
                    let subcategorias = JSON.parse(json)
                    let option = "<option value=''>-- Selecione uma subcategoria --</option>"
                    if (subcategorias.length > 0) {
                        $.each(subcategorias, function (i, obj) {
                            if (idCategoria == obj.categoria_id) {
                                option += "<option value='" + obj.id + "'>" + obj.titulo + "</option>"
                            }
                        })
                    }
                    $("#subcategoria").html(option);
                }
            });
        }
    });


    $("#seleciona-imagem").change(function () {

        if (typeof (FileReader) != "undefined") {
            let image_holder = $("#imagem-box");
            image_holder.empty();

            let reader = new FileReader();
            reader.onload = function (e) {
                let image = $("<img />", {
                    "src": e.target.result,
                    "class": "img-thumbnail"
                }).appendTo(image_holder);

                image.Jcrop({
                    aspectRatio: 1,
                    onChange: atualizaCoordenadas,
                    onSelect: atualizaCoordenadas
                });
                defineTamanhoImagem(e.target.result, image);
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        }
    });
});

function atualizaCoordenadas(c) {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#wcrop').val(c.w);
    $('#hcrop').val(c.h);
};

function defineTamanhoImagem(imgOriginal, imgVisualizacao) {
    var image = new Image();
    image.src = imgOriginal;

    image.onload = function () {
        $('#wvisualizacao').val(imgVisualizacao.width());
        $('#hvisualizacao').val(imgVisualizacao.height());
        $('#woriginal').val(this.width);
        $('#horiginal').val(this.height);
    }
}

// Datatable
$(document).ready(function () {
    $('#table').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
        },
        "order": [[0, 'desc']]
    });
});
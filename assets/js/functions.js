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
var jcrop_api;
//Jquery Mask , Ajax filtro subcategorias, JCROP
$(document).ready(function () {
    $('#nascimento').mask('00/00/0000');

    $('#categoria_user').change(function () {
        let idCategoria = $('#categoria_user').val();

        let url = 'filtrarSubcategorias/' + idCategoria;
        console.log(url)
        $.ajax({
            type: 'POST',
            data: { idCategoria: idCategoria },
            url: url,
            success: function (msg) {
                $("#subcategoria").html(msg)
            }
        });
    });

    $("#seleciona-imagem").change(function () {
        // const file = $(this)[0].files[0];
        // const fileReader = new FileReader();
        // var oImage = document.getElementById('preview');

        // if (this.files && this.files[0]) {

        //     fileReader.onload = function () {
        //         $('#preview').attr('src', fileReader.result);

        //         if (typeof jcrop_api != 'undefined') {
        //             jcrop_api.destroy();
        //             jcrop_api = null;
        //             $('#preview').width(oImage.naturalWidth);
        //             $('#preview').height(oImage.naturalHeight);
        //         }

        //         $('#preview').Jcrop({
        //             boxWidth: 200,
        //             boxHeight: 200,
        //             aspectRatio: 1,
        //             onSelect: atualizaCoordenadas,
        //             onChange: atualizaCoordenadas
        //         }, function () {
        //             jcrop_api = this;
        //         });
        //         defineTamanhoImagem(fileReader.result, )
        //     }

        //     fileReader.readAsDataURL(file);
        // }
        if (typeof (FileReader) != "undefined") {
            let image_holder = $("#imagem-box");
            image_holder.empty();

            let reader = new FileReader();
            reader.onload = function (e) {
                let image = $("<img />", {
                    "src": e.target.result,
                    "class": "img-thumbnail",
                    "style": "width: 200px;"
                }).appendTo(image_holder);
                image.Jcrop({
                    onChange: atualizaCoordenadas,
                    onSelect: atualizaCoordenadas,
                    minSize: [64, 64],
                    boxWidth: 200,
                    boxHeight: 200
                });
                defineTamanhoImagem(e.target.result, image);
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        }
    });

    $('#recortar-imagem').click(function () {
        if (parseInt($('#wcrop').val())) return true;
        alert('Selecione a área de corte para continuar.');
        return false;
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

// Teste datatable
$(document).ready( function () {
    $('#table').DataTable( {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
        },
        "order": [[ 0, 'desc']]
    } );
} );
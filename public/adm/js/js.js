$(document).ready(function(){
    // inicia datepicker
    md.initFormExtendedDatetimepickers();

    $(".gerar_WYSIWYG").froalaEditor({
        heightMin: 300,
        heightMax: 1000
    });
    // monta as mascaras
    $("input[data-mask]").each(function(){
        var mascara = $(this).attr("data-mask");
        $(this).mask(mascara, {reverse: true});
    });
});


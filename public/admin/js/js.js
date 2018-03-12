$(document).ready(function(){
    $(".gerar_rows form").each(function(){
       adicionaRows($(this));
    });
});

function adicionaRows(obj) {
    var colunas = 0;

    $(obj).find("[class^='col-md-']").each(function(){
        if(colunas == 12){
            $(this).insertBefore("</div>");
            colunas = 0;
        }
        else if(colunas == 0){
            $(this).insertBefore("<div class='row'>");
        }
        colunas = colunas + contaColunas($(this));

        if(colunas > 12){
            $(this).insertBefore("</div>");
            colunas = 0;
        }
    });
    if(colunas > 0){
        $(obj).find("[class^='col-md-']:last-child").insertBefore("</div>");
    }
}

function contaColunas(obj) {
    var classes = $(obj).attr("class").split(" ");
    for(i = classes.length -1; i >=0; i-- ){
        if(classes[i].includes("col-md-")){
            var arr = classes[i].split("-");
            return arr[2];
        }
    }
}
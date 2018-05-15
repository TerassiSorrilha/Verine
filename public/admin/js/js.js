$(document).ready(function(){
    // inicia datepicker
    md.initFormExtendedDatetimepickers();

    $(".gerar_rows form").each(function(){
       //new Rows(this);
    });

    $(".gerar_WYSIWYG").froalaEditor({
        heightMin: 300,
        heightMax: 1000
    });
});

class Rows {
    constructor (obj){
        this.colunas = 0;
        this.html = "<div class='row'>\n";

        elemento = this;
        $(obj).find("[class^='col-md-']").each(function(){
            elemento.adiciona(this);
        });
    }
    adiciona (obj){
        this.colunas += this.contaColunas($(obj));

        if(this.colunas > 12){
            this.html += "</div>";
            this.colunas = 0;
        }

        if(this.colunas == 0){
            this.html += "<div class='row'>\n";
        }

        // adiciona ao html aqui
        this.html += obj.outerHTML;

        if(this.colunas == 12){
            this.html += "</div>";
            this.colunas = 0;
        }

    }

    contaColunas(obj) {
        var classes = $(obj).attr("class").split(" ");
        for(i = classes.length -1; i >=0; i-- ){
            if(classes[i].includes("col-md-")){
                var arr = classes[i].split("-");
                return parseInt(arr[2]);
            }
        }
    }
}


function adicionaRows(obj) {
    var colunas = 0;
    var ultima_col;
    $(obj).find("[class^='col-md-']").each(function(){
        if(colunas == 12){
            $(this).insertBefore("</div>\n");
            colunas = 0;
        }
        if(colunas == 0){
            $(this).insertAfter("<div class='row'>\n");
        }
        console.log($(this));
        colunas = colunas + parseInt(contaColunas($(this)));
        ultima_col = this;

        if(colunas > 12){
            $(this).insertBefore("</div>\n");
            colunas = 0;
        }
    });

    if(colunas > 0){
        $(ultima_col).insertAfter("</div>\n");
    }

}


function fecha(){
    var d = new Date();
    let dia =d.getDate()
    let mes = d.getUTCMonth()+ 1
    let año = d.getFullYear()

    if (mes <10 ){
        mes = "0"+mes
    }
    if (dia<10){
        dia = "0"+dia
    }

    document.ppal.Clock.value= dia + "/"+ mes+ "/" + año;
}

$(document).ready(function(){
    if (x==1){
        document.getElementById('modal').style.display = "flex";
    }
})


fecha();




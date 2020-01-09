
var fecha=new Date();

var mes = [
    "01",
    "02",
    "03",
    "04",
    "05",
    "06",
    "07",
    "08",
    "09",
    "10",
    "11",
    "12"
    ];

    document.getElementById("fecha").innerHTML=fecha.getDate()+ '-'+mes[fecha.getMonth()]+'-'+fecha.getFullYear();
    document.getElementById("copyright").innerHTML='<i class="fa fa-copyright"></i> Joaquín Corugedo '+fecha.getFullYear();
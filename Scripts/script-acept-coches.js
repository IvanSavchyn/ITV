function eliminarCoche(matricula) {
    var enviar = "matricula="+ matricula + "&function=eliminarCoche";
    enviarDatos(enviar);
}
function aceptarCoche(matricula) {
    var enviar = "matricula="+ matricula + "&function=aceptarCoche";
    enviarDatos(enviar);
}
function enviarDatos(enviar) {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           alert(this.responseText);
    }
 
    }
    xmlhttp.open("POST","ScriptsPHP/controlador.php",true);
    xmlhttp.setRequestHeader('Content-Type',"application/x-www-form-urlencoded");
    xmlhttp.send(enviar);
}
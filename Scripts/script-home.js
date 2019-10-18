function modificarCoche(matricula, id) {
    var a = document.getElementById(id);
    var tipo = a.options[a.selectedIndex].value;

    var enviar = "matricula=" + matricula + "&tipo=" + tipo + "&function=modificarCoche";
    enviarDatos(enviar);

}
function eliminarCoche(matricula, id_div) {
    var enviar = "matricula=" + matricula + "&function=eliminarCoche";
    enviarDatos(enviar);
}
function pagar(matricula) {
    var enviar = "matricula=" + matricula + "&function=pagar";
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

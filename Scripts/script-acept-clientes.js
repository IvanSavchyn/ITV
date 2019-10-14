function eliminarCliente(dni) {
    var enviar = "dni="+ dni + "&function=eliminarCliente";
    enviarDatos(enviar);
}
function aceptarCliente(dni) {
    var enviar = "dni="+ dni + "&function=aceptarCliente";
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
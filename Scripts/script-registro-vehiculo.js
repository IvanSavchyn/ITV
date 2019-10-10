app.controller("registrarCoche", function($scope) {
   $scope.registrarCoche = function() {
       var valido = true;
       var matricula = document.getElementById("matricula").value;
       var marca = document.getElementById("marca").value;
       
       var radio = document.getElementsByName("tipo_vehiculo");
       var tipo = "";
       if(radio[0].checked) {
           tipo = "privado";
       }else {
           tipo = "publico";
       }
       
       matricula = matricula.trim();
       marca = marca.trim();
       
       if(marca.length == 0) {
           document.getElementById("marca").style.border = "1px solid red";
           valido = false;
       }
       else {
           document.getElementById("marca").style.border = "1px solid #BEBEBE";
       }
       
       if(matricula.length == 0) {
           document.getElementById("matricula").style.border = "1px solid red";
           valido = false;
       }
       else {
           document.getElementById("matricula").style.border = "1px solid #BEBEBE";
           if((matricula.length > 8) || (matricula.length < 7)) {
               alert("Matricula debe contener entre 7 y 8 caracteres");
               document.getElementById("matricula").style.border = "1px solid red";
               valido = false;
           }
       }
       
       
       if(valido) {
           var enviar = "matricula=" + matricula + "&marca=" + marca + "&tipo=" + tipo + "&function=registrarCoche";
           enviarDatos(enviar);
       }
       
       
   } 
});

function enviarDatos(enviar) {
    
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           console.log(this.responseText);
    }
 
    }
    xmlhttp.open("POST","ScriptsPHP/controlador.php",true);
    xmlhttp.setRequestHeader('Content-Type',"application/x-www-form-urlencoded");
    xmlhttp.send(enviar);
}
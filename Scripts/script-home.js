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
function modificarDatos() {
    var nombres = ["nombre","apellidos","email","telefono","direccion","contr","contr2"];
            var datos = [];
            var valido = true;
            for(var i = 0; i < nombres.length; i++) {
                datos.push({
                    nombre: nombres[i],
                    valor: document.getElementById(nombres[i]).value.toString()
                });
            }
            
            for(var i = 0; i < nombres.length; i++) {
                datos[i].valor = datos[i].valor.trim();
                if(datos[i].valor.length == 0) {
                    document.getElementById(datos[i].nombre).style.border = "1px solid red";
                   valido = false;
                }
                else {
                    document.getElementById(datos[i].nombre).style.border = "1px solid #BEBEBE";
                }
                
            }
            if(!valido) {
                alert("Rellena todos los campos!");
            }else {
                if(datos[0].valor.length != 9) {
                    valido = false;
                    document.getElementById(datos[0].nombre).style.border = "1px solid red";
                }
                 
                if(!angular.equals(datos[6].valor, datos[7].valor)) {
                    valido =  false;
                    alert("Contraseñas no coinciden!");
                }
                else {
                    if((datos[6].valor.length < 6) || (datos[6].valor.length > 15)) {
                        valido = false;
                        alert("Contraseña debe contener entre 6 y 15 caracteres");
                    }
                }
               
            }
            
            if(valido) {
                
               
                 var enviar = "";
                for(var i = 0; i < datos.length - 1; i++) {
                    enviar += datos[i].nombre + "=" + datos[i].valor + "&";
                }
            } 

}
function cambiarContrasenia() {
    var c1 = document.getElementById("contr").value.toString();
    var c2 = document.getElementById("contr2").value.toString();
    var enviar = "contr=" + c1 + "&contr2=" + c2 + "&function=cambiarContrasenia";
    if(!comprobarContr(enviar)) {
        return "ContraseniaIncorrecta";
    }
    else {
        return "1";
    }
    
}
function enviarDatos(enviar) {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var respusta = this.responseText;
            alert(respusta);
            setTimeout("document.location.href = 'home.php'", 1000);
    }

    }
    xmlhttp.open("POST","ScriptsPHP/controlador.php",true);
    xmlhttp.setRequestHeader('Content-Type',"application/x-www-form-urlencoded");
    xmlhttp.send(enviar);
}
function comprobarContr(enviar) {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.open("POST","ScriptsPHP/controlador.php",true);
    xmlhttp.setRequestHeader('Content-Type',"application/x-www-form-urlencoded");
    xmlhttp.send(enviar);

    xmlhttp.onreadystatechange = function() {
        while((this.readyState != 4) && (this.status != 200)) {
            return this.responseText;
        }
    }
}
app.controller("modificar", function($scope, $http) {
    $scope.modificarContrasenia = function(){
            $http.post("ScriptsPHP/controlador.php", {data:{            
                function: "cambiarContrasenia",
                contr: $scope.contr, 
                contr2: $scope.contr2
            }}).then(function mySuccess(response) {
                 alert(response.data);
              });
        }
});

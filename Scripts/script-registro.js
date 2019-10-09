
    app.controller("registro", function($scope) {
        $scope.registrar = function() {
            var nombres = ["dni","nombre","apellidos","email","telefono","direccion","contr","contr2"];
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
                
                datos.pop();
                 var enviar = "";
                for(var i = 0; i < datos.length; i++) {
                    enviar += datos[i].nombre + "=" + datos[i].valor;
                    if(i != datos.length - 1){
                        enviar += "&";
                    }
                }
                console.log(enviar);
                enviarDatos("chrome.extension.getURL('../ScriptsPHP/www.php')", enviar);
            }
            

        };
    });
function enviarDatos(archivo, enviar) {
    
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           console.log(this.responseText);alert("1");
    }else {
        alert(this.statusText);
    }
       
        
  
    }

    xmlhttp.open("POST",archivo,true);
    xmlhttp.setRequestHeader('Content-Type',"application/x-www-form-urlencoded");
    xmlhttp.send(enviar);
}
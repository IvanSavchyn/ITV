app.controller("registrarCoche", function($scope, $http) {
   $scope.registrarCoche = function() {
       var valido = true;
       var matricula = document.getElementById("matricula").value;
       var marca = document.getElementById("marca").value;
       var dni = document.getElementById("dni_cliente").value;
       var radio = document.getElementsByName("tipo_vehiculo");
       var tipo = "";
       var doc = document.querySelector("#archivo");


       if((doc === undefined)||(doc.files.length == 0)) {
           valido = false;
           document.getElementById("archivo").style.border = "1px solid red";
       }
       else {
           document.getElementById("archivo").style.border = "1px solid #177817";
       }
       if(radio[0].checked) {
           tipo = "privado";
       }else {
           tipo = "publico";
       }

       matricula = matricula.trim();
       marca = marca.trim();
       dni = dni.trim();

       if(marca.length == 0) {
           document.getElementById("marca").style.border = "1px solid red";
           valido = false;
       }
       else {
           document.getElementById("marca").style.border = "1px solid #BEBEBE";
       }

       if(dni.length != 9) {
            document.getElementById("dni_cliente").style.border = "1px solid red";
            valido = false;
       }
       else {
            document.getElementById("dni_cliente").style.border = "1px solid #BEBEBE";
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
         const formData = new FormData();
    		   formData.append('file', doc.files[0], "file_"+matricula+".xml");

           let configuracion = {
                headers: {
                "Content-Type": undefined,
                },
                transformRequest: angular.identity,
          };

          $http
              .post("ScriptsPHP/comprobarXML.php", formData, configuracion)
              .then(function (respuesta) {
                
                    if(angular.equals("true", respuesta.data)) {
                      var enviar = "matricula=" + matricula + "&dni_cliente=" + dni +"&marca=" + marca + "&tipo=" + tipo + "&function=registrarCoche";
                      enviarDatos(enviar);
                    }
                    else {
                      alert("No es documento XML o esta mal formado!");
                    }

              })
              .catch(function (detallesDelError) {
                   console.warn("Error al enviar archivos:", detallesDelError);
              })
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
            var respusta = this.responseText;
            alert(respusta);

    }

    }
    xmlhttp.open("POST","ScriptsPHP/controlador.php",true);
    xmlhttp.setRequestHeader('Content-Type',"application/x-www-form-urlencoded");
    xmlhttp.send(enviar);
}

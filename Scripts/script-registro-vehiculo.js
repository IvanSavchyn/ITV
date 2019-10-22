app.controller("registrarCoche", function($scope) {
   $scope.registrarCoche = function() {
       var valido = true;
       var matricula = document.getElementById("matricula").value;
       var marca = document.getElementById("marca").value;
       var dni = document.getElementById("dni_cliente").value;
       var radio = document.getElementsByName("tipo_vehiculo");
       var tipo = "";
       var doc = document.getElementById("archivo").files[0];

       
       if(doc === undefined) {
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
           var enviar = "matricula=" + matricula + "$dni_cliente=" + dni +"&marca=" + marca + "&tipo=" + tipo + "&function=registrarCoche" + "&file="+doc;
           enviarDatos(enviar);
       }
    
   } 
});


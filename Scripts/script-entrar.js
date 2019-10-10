app.controller("entrar", function($scope){
   $scope.entrar = function() {
       var correcto = true;
       var dni = document.getElementById("dni").value;
       var contr = document.getElementById("contr").value;
       
       dni = dni.trim();
       contr = contr.trim();
       
       if(dni.length != 9) {
           document.getElementById("dni").style.border = "1px solid red";
           correcto = false;
       }
       else {
           document.getElementById("dni").style.border = "1px solid #BEBEBE";
       }
       
       if((contr.length >= 6)&&(contr.length <= 15)) {
           document.getElementById("contr").style.border = "1px solid #BEBEBE";
       }
       else {
           document.getElementById("contr").style.border = "1px solid red";
           correcto = false;
       }
       
       if(correcto) {
           var enviar = "dni=" + dni + "&contr=" + contr + "&function=entrar";
           var res = enviarDatos(enviar);
           if(angular.equals(res, "user")) {
               document.location.href = "home.php";
           }
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
           return this.responseText;
    }
 
    }
    xmlhttp.open("POST","ScriptsPHP/controlador.php",true);
    xmlhttp.setRequestHeader('Content-Type',"application/x-www-form-urlencoded");
    xmlhttp.send(enviar);
}
function modificarCoche(matricula, id) {
    var a = document.getElementById(id);
    var tipo = a.options[a.selectedIndex].value;

    var enviar = "matricula=" + matricula + "&tipo=" + tipo + "&function=modificarCoche";
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
    $scope.modificarDatos = function(){
            var contr = document.getElementById("contr").value.toString();
            var contr2 = document.getElementById("contr2").value.toString();
            var contr3 = document.getElementById("contr3").value.toString();

            if(contr.trim() == '') {
              contr = '-1';
              contr2 = '-1';
            }
            else {
              if(angular.equals(contr2, contr3) == false) {
                document.getElementById("contr2").style.border = "1px solid red";
                document.getElementById("contr3").style.border = "1px solid red";
                contr = '-1';
                contr2 = '-1';
              }
              else {
                document.getElementById("contr2").style.border = "1px solid #BEBEBE";
                document.getElementById("contr3").style.border = "1px solid #BEBEBE";
              }
            }

            $http.post("ScriptsPHP/controlador.php", {data:{
                function: "modificarDatos",
                contr: contr,
                contr2: contr2,
                es_admin: 0,
                dni: document.getElementById("dni").value.toString(),
                nombre: document.getElementById("nombre").value.toString(),
                apellidos: document.getElementById("apellidos").value.toString(),
                email: document.getElementById("email").value.toString(),
                telefono: document.getElementById("telefono").value.toString(),
                direccion: document.getElementById("direccion").value.toString()
            }}).then(function mySuccess(response) {
                 var resp = response.data;
                 if(!angular.equals("-1", resp.error)) {
                   alert(resp.error);
                 }
                 else {
                   if(!angular.equals("-1", resp.info)) {
                     console.log("3");
                     alert(resp.info);
                   }
                   if(!angular.equals("-1", resp.contr)){
                     console.log("4");
                     alert(resp.contr)
                   }
                 }
              });
        }
      $scope.eliminarCoche = function(matricula, idDiv) {
        $http.post("ScriptsPHP/controlador.php", {data:{
            function: "eliminarCoche",
            id: matricula,
        }}).then(function mySuccess(response) {
             var resp = response.data;
             console.log(resp);
             if(!angular.equals("-1", resp.error)) {
               alert(resp.error);
             }
             else {
               alert(resp.info);
               if(resp.codigo == 0) {
                 document.location.href = 'home.php';
               }
             }
          });
      }
});

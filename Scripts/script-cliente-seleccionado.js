app.controller("modificar", function($scope, $http){
    $scope.modificarDatos = function() {
      $http.post("ScriptsPHP/controlador.php", {data:{
          function: "modificarDatos",
          contr: -1,
          contr2: -1,
          es_admin: 1,
          dni: document.getElementById("dni").value.toString(),
          nombre: document.getElementById("nombre").value.toString(),
          apellidos: document.getElementById("apellidos").value.toString(),
          email: document.getElementById("email").value.toString(),
          telefono: document.getElementById("telefono").value.toString(),
          direccion: ""
      }}).then(function mySuccess(response) {
           var resp = response.data;
           console.log(response.data);
           if(!angular.equals("-1", resp.error)) {
             alert(resp.error);
           }
           else {
             if(!angular.equals("-1", resp.info)) {
               console.log("3");
               alert(resp.info);
             }
           }
        });
    };
    $scope.eliminarCliente = function() {
      $http.post("ScriptsPHP/controlador.php", {data:{
          function: "eliminarCliente",
          dni: document.getElementById("dni").value.toString()
      }}).then(function mySuccess(response) {
           var resp = response.data;
           console.log(resp);
           if(!angular.equals("-1", resp.error)) {
             alert(resp.error);
           }
           else {
             alert(resp.info);
             if(resp.codigo == 0) {
               document.location.href = 'clientes.php';
             }
           }
        });
    };
    $scope.eliminarCoche = function(matricula) {
      matricula = matricula.trim();
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
               document.location.href = 'clientes.php';
             }
           }
        });
    };
    $scope.asignarBahia = function(idPago) {
      var a = document.getElementById("select"+idPago);
      var bahia = a.options[a.selectedIndex].value;
      $http.post("ScriptsPHP/controlador.php", {data:{
          function: "asignarBahia",
          pago: idPago,
          bahia: bahia
      }}).then(function mySuccess(response) {
           var resp = response.data;

           if(!angular.equals("-1", resp.error)) {
             alert(resp.error);
           }
           else {
            alert(resp.info);
            if(resp.codigo == 0) {
              document.location.href = 'cliente_seleccionado.php';
            }
           }
        });
    };
});
function modificarCoche(matricula, id) {
    var a = document.getElementById(id);
    var tipo = a.options[a.selectedIndex].value;

    var enviar = "matricula=" + matricula + "&tipo=" + tipo + "&function=modificarCoche";
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
    }

    }
    xmlhttp.open("POST","ScriptsPHP/controlador.php",true);
    xmlhttp.setRequestHeader('Content-Type',"application/x-www-form-urlencoded");
    xmlhttp.send(enviar);
}

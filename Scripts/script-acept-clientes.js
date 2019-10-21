
app.controller("aceptClientes", function($scope, $http) {
    $scope.aceptar = function(dni, cont){
            if(cont == 1) {
              var func = "aceptarCliente";
            }
            else {
              var func = "eliminarCliente";
            }

            $http.post("ScriptsPHP/controlador.php", {data:{
                function: func,
                dni: dni,
            }}).then(function mySuccess(response) {
                 var resp = response.data;
                 console.log(resp);
                 if(!angular.equals("-1", resp.error)) {
                   alert(resp.error);
                 }
                 else {
                   alert(resp.info);
                   if(resp.codigo == 0) {
                     document.getElementById(dni).style.display = "none";
                   }
                 }
              });

        }
});

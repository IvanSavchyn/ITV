
app.controller("aceptCoches", function($scope, $http) {
    $scope.aceptar = function(matricula, cont){
            if(cont == 1) {
              var func = "aceptarCoche";
            }
            else {
              var func = "eliminarCoche";
            }

            $http.post("ScriptsPHP/controlador.php", {data:{
                function: func,
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
                     document.getElementById(matricula).style.display = "none";
                   }
                 }
              });

        }
});

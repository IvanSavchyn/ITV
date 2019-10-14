app.controller("clientes", function($scope){
    $scope.limpiar = function() {
        document.getElementsByName("dni")[0].value = "";
        document.getElementsByName("nombre")[0].value = "";
        document.getElementsByName("apellidos")[0].value = "";
        document.getElementsByName("email")[0].value = "";
        document.getElementsByName("telefono")[0].value = "";
    };
});

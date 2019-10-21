app.controller("panelAdmin", function($scope, $http) {
    $scope.insertarParqueadero = function() {
        
        $http.post("ScriptsPHP/controlador.php", {data:{
            function: "insertarParqueadero",
            id: document.getElementById("parck1").value.toString(),
            nombre: document.getElementById("parck2").value.toString(),
            ubicacion: document.getElementById("parck1").value.toString()
        }}).then(function mySuccess(response) {
             var resp = response.data;

             if(!angular.equals("-1", resp.error)) {
               alert(resp.error);
             }
             else {
                 if(!angular.equals("0", resp.codigo)) {
                    alert(resp.info);
                    document.location.href = "panel_admin.php";
                 }
                 else {
                    alert(resp.info);
                 }
               
             }
          });
    };
    $scope.eliminarParqueadero = function(idParq) {
        $http.post("ScriptsPHP/controlador.php", {data:{
            function: "eliminarParqueadero",
            id: idParq
        }}).then(function mySuccess(response) {
             var resp = response.data;
             if(!angular.equals("-1", resp.error)) {
               alert(resp.error);
             }
             else {              
                if(0 == resp.codigo) {
                    alert(resp.info);
                    document.getElementById("div_parck"+idParq).style.display = "none";
                 }
                 else {
                    alert(resp.info);
                 }
             }
          });
    };
    $scope.insertarBahia = function() {
        var p = document.getElementById("bahia2");
        var parq = p.options[p.selectedIndex].value;
        var d = document.getElementById("bahia3");
        var dispon = d.options[d.selectedIndex].value;

        $http.post("ScriptsPHP/controlador.php", {data:{
            function: "insertarBahia",
            id: document.getElementById("bahia1").value.toString(),
            idParqueadero: parq,
            disponible: dispon
        }}).then(function mySuccess(response) {
             var resp = response.data;
             if(!angular.equals("-1", resp.error)) {
               alert(resp.error);
             }
             else {              
                if(0 == resp.codigo) {
                    alert(resp.info);
                    document.location.href = "panel_admin.php";
                 }
                 else {
                    alert(resp.info);
                 }
             }
          });
    }
    $scope.eliminarBahia = function(idBahia) {
        $http.post("ScriptsPHP/controlador.php", {data:{
            function: "eliminarBahia",
            id: idBahia
        }}).then(function mySuccess(response) {
             var resp = response.data;
             
             if(!angular.equals("-1", resp.error)) {
               alert(resp.error);
             }
             else {              
                if(0 == resp.codigo) {
                    alert(resp.info);
                    document.getElementById("div_bahia"+idBahia).style.display = "none";
                 }
                 else {
                    alert(resp.info);
                 }
             }
          });
    }
    $scope.modificarBahia = function(id) {
        var p = document.getElementById("parck_bahia"+id);
        var parq = p.options[p.selectedIndex].value;
        var d = document.getElementById("disponible_bahia"+id);
        var dispon = d.options[d.selectedIndex].value;

        $http.post("ScriptsPHP/controlador.php", {data:{
            function: "modificarBahia",
            id: id,
            idParqueadero: parq,
            disponible: dispon
        }}).then(function mySuccess(response) {
             var resp = response.data;
             if(!angular.equals("-1", resp.error)) {
               alert(resp.error);
             }
             else {              
                if(0 == resp.codigo) {
                    alert(resp.info);
                 }
                 else {
                    alert(resp.info);
                 }
             }
          });
    }
    $scope.modificarTarifa = function(tipo) {
        var cost = document.getElementById("costo"+tipo).value.toString();
        cost = parseFloat(cost);
        $http.post("ScriptsPHP/controlador.php", {data:{
            function: "modificarTarifa",
            tipo: tipo,
            costo: cost
        }}).then(function mySuccess(response) {
             var resp = response.data;
             if(!angular.equals("-1", resp.error)) {
               alert(resp.error);
             }
             else {              
                    alert(resp.info);
             }
          });
    }

});
var menu_on = false;    
    var app = angular.module("myITV", []);
        app.controller("myCTRL", function($scope) {            
            $scope.abrir_menu = function() {
                    document.getElementById('menu').classList.add("mov_out");
                    document.getElementById('bloquear').style.display = "block";
                    document.getElementById('img_menu').style.display = "none";         
                    setTimeout("document.getElementById('menu').classList.remove('mov_in')", 800);
                           
            };
            $scope.cerrar_menu = function() {
                document.getElementById('menu').classList.add("mov_in");
                document.getElementById('bloquear').style.display = "none";
                setTimeout("document.getElementById('img_menu').style.display = 'block'", 400);
                document.getElementById('menu').classList.remove("mov_out");
            };
        });
        app.controller("go_to", function($scope, $http) {
            $scope.open_home = function () {
                document.location.href = "entrar.php";
            }
           $scope.open_login = function() {
               document.location.href = "entrar.html";
           }; 
           $scope.open_registr = function() {
               document.location.href = "registro.html";
           };
            $scope.open_registrar_vehiculo = function() {
                document.location.href = "registrar_vehiculo.php";
            };
            $scope.open_clientes = function() {
                document.location.href = "clientes.php";
            }
            $scope.open_validar_cliente = function() {
                document.location.href = "validar_usuario.php";
            }
            $scope.open_validar_coches = function() {
                document.location.href = "validar_coches.php";
            }
            $scope.open_config = function() {
                document.location.href = "panel_admin.php";
            }
            $scope.salir = function () {
                $http.post("ScriptsPHP/controlador.php", {data:{
                    function: "salir"
                }}).then(function mySuccess(response) {
                     var resp = response.data;
                     if(!angular.equals("-1", resp.error)) {
                       alert(resp.error);
                     }
                     else {              
                            if(resp.codigo == 0) {
                                document.location.href = "entrar.html";
                            }
                            else {
                                alert("No se pudo salir");
                            }
                         
                     }
                  });
            }
        });
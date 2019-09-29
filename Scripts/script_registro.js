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
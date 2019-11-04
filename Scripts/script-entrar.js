app.controller("entrar", function($scope, $http){
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
           $http.post("ScriptsPHP/controlador.php", {data:{
               function: "entrar",
               dni: dni,
               contr: contr
           }}).then(function mySuccess(response) {
                var resp = response.data;

                if(!angular.equals("-1", resp.error)) {
                  alert(resp.error);
                }
                else {

                  if(resp.codigo == 0) {
                      if(angular.equals("admin", resp.info)) {
                        document.location.href = "panel_admin.php";
                      }
                      else {
                        document.location.href = "home.php";
                      }
                      document.getElementById("dni").value = "";
                      document.getElementById("contr").value = "";
                  }
                  else{
                    alert(resp.info);
                  }
                }
             });
       }
   }
});

<?php 
    session_start();

    $dni = $_SESSION["dni"];

    //if(is_null($dni) || $dni == '') {
        //header("Location: entrar.html");
    //}
?>
<html>
    <head>
        <link rel="stylesheet" href="Style/style-index.css">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js">
        </script>
        <script src="Scripts/index.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Playfair Display SC' rel='stylesheet'>
        <link href="Style/style-home.css" rel="stylesheet">
        <meta charset="UTF-8">
    </head>
<body ng-app="myITV">
    <div id="bloquear" ng-controller="myCTRL" ng-click="cerrar_menu()"></div>
    <div id="menu">
        <div id="menu_items">
        <div class="menu_item" ng-controller="go_to" ng-click="open_registr()"><a href="registro.html">Registrar vehiculo</a><img src="Images/add-user-button.png" class="img_item_menu"></div>
        <br>
        <div class="menu_item" ng-controller="go_to" ng-click="open_login()"><a href="entrar.html">Entrar</a><img src="Images/play-button-inside-a-circle.png" class="img_item_menu"></div>

        </div>
    </div>
    <div id="cabeza">
        <div id="img_menu" ng-controller="myCTRL" ng-click="abrir_menu()"></div>
        <div id="social">
            <a href="https://twitter.com/?lang=es" target="_blank"><img src="Images/twitter.png" class="img_social"></a>
            <a href="https://es-es.facebook.com/" target="_blank"><img src="Images/facebook.png" class="img_social"></a>
            <a href="https://www.instagram.com/_tine_es/?hl=es" target="_blank"><img src="Images/instagram.png" class="img_social"></a>
            <a href="https://www.youtube.com" target="_blank"><img src="Images/youtube.png" class="img_social"></a>
        </div>
        <h1 id="name">ITV</h1>

    </div>

    <h2>Mis datos</h2>
    <?php 
        echo "
             <div id='div_datos'>
                <div id='div_datos_1' class='datos'>
                    <h3>DNI</h3>
                    <input type='text' class='inputs' disabled value='" . $_SESSION["dni"] . "'><br>
                    <h3>Nombre</h3>
                    <input type='text' class='inputs' value='" . $_SESSION["nombre"] . "'><br>
                    <h3>Apellidos</h3>
                    <input type='text' class='inputs' value='" . $_SESSION["apellidos"] . "'><br>
                </div>
                <div id='div_datos_2' class='atos'>
                    <h3>Email</h3>
                    <input type='text' class='inputs' value='" . $_SESSION["email"] . "'><br>
                    <h3>Telefono</h3>
                    <input type='text' class='inputs' value='" . $_SESSION["telefono"] . "'><br>
                    <h3>Dirección</h3>
                    <input type='text' class='inputs' value='" . $_SESSION["direccion"] . "'><br>
                </div>
                <div id='div_datos_3' class='datos'>
                    <h3>Contraseña</h3>
                    <input type='password' class='inputs'><br>
                    <h3>Nueva contraseña</h3>
                    <input type='text' class='inputs'><br>
                    <h3>Repetir Contraseña</h3>
                    <input type='text' class='inputs'><br>
                </div>
                <button id='bot_modificar'>Modificar</button>
            </div>
        ";
    ?>
    
    <h2>Mis coches</h2>
    
     <?php 
        include ("ScriptsPHP/controlador2.php");
        $controlador = new Controlador2();
        if($controlador->ComprobarConexion()) {
            $coches = $controlador->getCochesCliente($_SESSION["dni"]);
            if(is_null($coches)) {
                
            }
            else {
                
            }
        }
        else {
            echo "<h2>No se puede conectar a base de datos!</h2>";
        }
        $controlador->Desconectar();
    ?>
    <div class='div_coches'>
        <p class='veh_inf'>Información del vehículo</p>
        <div class='coche'>
            <div class='coche_1'>
                <h3 class='text_coche'>Matricula</h3>
                <input type='text' class='inputs_2' disabled value='1872 HWN'><br>
            </div>
            <div class='coche_2'>
                <h3 class='ext_coche'>Marca</h3>
                <input type='text' class='inputs_2' disabled value='SEAT'><br>
            </div>
            <div class='coche_3'>
                <h3 class='text_coche'>Tipo</h3>
                <select class='select_tipo_coche'>
                    <option value='privado'>Privado</option>
                    <option value='publico'>Publico</option>
                </select>
            </div>
            <button class='bot_modificar_coche'>Modificar</button>
            <button class='bot_eliminar_coche'>Eliminar coche</button>
            
            <p class='pago_inf'>Información del pago</p>
            <div class='div_pago'>
                <div class='pago_1'>
                    <h3 class='text_coche'>Numero de pago</h3>
                    <input type='text' class='inputs_2' disabled value='x75834'><br>
                </div>
                <div class='pago_2'>
                    <h3 class='text_coche'>Costo</h3>
                    <input type='text' class='inputs_2' disabled value='25€'><br>
                </div>
                <div class='pago_3'>
                    <h3 class='text_coche'>Fecha</h3>
                    <input type='text' class='inputs_2' disabled value='1.10.2019'><br>
                </div>
                <div class='pago_4'>
                    <h3 class='text_coche'>Hora</h3>
                    <input type='text' class='inputs_2' disabled value='20:17'><br>
                </div>
                <!--
                <p class='p_no_realizado'>Pago no realizado!</p>
                <button class='bot_pagar'>Pagar</button>
                -->
            </div>
            <p class='inf_parqueadero'>Informacion del parqueadero</p>
            <div class='div_parqueadero'>
                
                <div class='parqueadero'>
                    <h3 class='text_coche'>Parqueadero</h3>
                    <input type='text' class='inputs_2' disabled value='CAlle 12 '><br>
                </div>
                <div class='bahia'>
                    <h3 class='text_coche'>Bahia</h3>
                    <input type='text' class='inputs_2' disabled value='3'><br>
                </div>
                
                <!--
                <p class='park_no_asignado'>Parqueadero no asignado!</p>
                -->
            </div>
            
                 
                
            </div>
            
        </div>
    

    <!-- un coment -->
</body>
</html>
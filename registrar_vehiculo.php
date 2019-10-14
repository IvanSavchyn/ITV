<?php
    session_start();

    if(is_null($_SESSION["user"])) {
        //header("Location: entrar.html");
    }
?>
<html>
    <head>
        
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
        <script src="Scripts/index.js"></script>
        <script src="Scripts/script-registro-vehiculo.js"></script>
        
        <link href='https://fonts.googleapis.com/css?family=Playfair Display SC' rel='stylesheet'>
        <link rel="stylesheet" href="Style/style-index.css">
        <link href="Style/style-registrar-vehiculo.css" rel="stylesheet">
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
    <br><br>
    <?php 
        include "ScriptsPHP/ModeloVo/PersonaVo.php";
        $cliente = unserialize($_SESSION["user"]);
        if(strcmp($cliente->getAceptado(), "admin") == 0) {
            echo "
                <div id='div_datos' style='height: 88%;'> 
                <h2>Registro del vehiculo</h2><br><br>
                <h3>DNI de cliente: </h3>
                <input type='text' class='inputs' id='dni_cliente'>
                <h3>Matricula</h3>
                <input type='text' class='inputs' id='matricula'><br>
                <h3>Marca</h3>
                <input type='text' class='inputs' id='marca'><br>
                <h3>El vehiculo es ...</h3>
                <div id='div_radios'>
                    <input type='radio' name='tipo_vehiculo' value='privado' checked> Privado
                    <input type='radio' name='tipo_vehiculo' value='publico' style='position: relative; margin-left: 30%;'> Publico<br>
                </div>
                <button id='bot_registrar' ng-controller='registrarCoche' ng-click='registrarCoche()'>Registrar</button>
            </div>
            ";
        }
        else {
            echo "
            <div id='div_datos' style='height: 75%;'> 
                <h2>Registro del vehiculo</h2><br><br>
                <h3 style='display: none;'>DNI de cliente: </h3>
                <input type='text' class='inputs' id='dni_cliente' style='display: none;' value='" . $cliente->getDni() . "'>
                <h3>Matricula</h3>
                <input type='text' class='inputs' id='matricula'><br>
                <h3>Marca</h3>
                <input type='text' class='inputs' id='marca'><br>
                <h3>El vehiculo es ...</h3>
                <div id='div_radios'>
                    <input type='radio' name='tipo_vehiculo' value='privado' checked> Privado
                    <input type='radio' name='tipo_vehiculo' value='publico' style='position: relative; margin-left: 30%;'> Publico<br>
                </div>
                <button id='bot_registrar' ng-controller='registrarCoche' ng-click='registrarCoche()'>Registrar</button>
            </div>
            ";
        }
    ?>

    <!-- un coment -->
</body>
</html>
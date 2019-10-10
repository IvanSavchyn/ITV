<html>
    <head>
        <link rel="stylesheet" href="Style/style-index.css">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js">
        </script>
        <script src="Scripts/index.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Playfair Display SC' rel='stylesheet'>
        <link href="Style/style-validar-clientes.css" rel="stylesheet">
        <meta charset="UTF-8">
    </head>
<body ng-app="myITV">
    <div id="bloquear" ng-controller="myCTRL" ng-click="cerrar_menu()"></div>
    <div id="menu">
        <div id="menu_items">
        <div class="menu_item" ng-controller="go_to" ng-click="open_registr()"><a href="#">Registrar cliente</a><img src="Images/add-user-button.png" class="img_item_menu"></div>
        <div class="menu_item" ng-controller="go_to" ng-click="open_registrar_vehiculo()"><a href="registro.html">Registrar vehiculo</a><img src="Images/add-plus-button.png" class="img_item_menu"></div>
        <div class="menu_item" ng-controller="go_to" ng-click="open_clientes()"><a href="#">Clientes</a><img src="Images/two-men.png" class="img_item_menu"></div>
        <div class="menu_item" ng-controller="go_to" ng-click="open_validar_cliente()"><a href="#">Validar cliente</a><img src="Images/verification-mark.png" class="img_item_menu"></div>
        <div class="menu_item" ng-controller="go_to" ng-click="open_validar_coches()"><a href="#">Validar Coches</a><img src="Images/front-car.png" class="img_item_menu"></div>
        <div class="menu_item" ng-controller="go_to" ng-click="open_config()"><a href="#">Configuracion</a><img src="Images/settings-cogwheel-button.png" class="img_item_menu"></div>
        <div class="menu_item" ng-controller="go_to" ng-click="salir()"><a href="#">Salir</a><img src="Images/settings-cogwheel-button.png" class="img_item_menu"></div>

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
    <h2>Clientes</h2>
    <?php 
        include ("ScriptsPHP/controlador2.php");
        $controlador2 = new Controlador2();
        if($controlador2->ComprobarConexion()) {
            $clientes = $controlador2->getClientes("false");
            if($clientes != null) {
                for($i = 0; $i < sizeof($clientes); $i++) {
                    echo "
                        <div id='div_datos'>
                            <div id='div_datos_1' class='datos'>
                                <h3>DNI</h3>
                                <input disabled type='text' class='inputs' value='" . $clientes[$i]->getDni() . "'><br>
                                <h3>Email</h3>
                                <input disabled type='text' class='inputs' value='" . $clientes[$i]->getEmail() . "'><br>
                            </div>
                            <div id='div_datos_2' class='datos'>
                                <h3>Nombre</h3>
                                <input disabled type='text' class='inputs' value='" . $clientes[$i]->getNombre() . "'><br>
                                <h3>Telefono</h3>
                                <input disabled type='text' class='inputs' value='" . $clientes[$i]->getTelefono() . "'><br>
                            </div>
                            <div id='div_datos_3' class='datos'>
                                <h3>Apellidos</h3>
                                <input disabled type='text' class='inputs' value='" . $clientes[$i]->getApellidos() . "'><br>
                            </div>
                            <button id='bot_eliminar_cliente'>Eliminar</button>
                            <button id='bot_aceptar'>Aceptar</button>
                        </div>
                    ";
                }
            }
            else {
                echo "<script>console.log('error');</script>";
            }
        }
        else {
            echo "<script>console.log('error en conectar a base de datos');</script>";
        }
        $controlador2->Desconectar();
    ?>
    

</body>
</html>
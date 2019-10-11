<html>
    <head>
        <link rel="stylesheet" href="Style/style-index.css">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js">
        </script>
        <script src="Scripts/index.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Playfair Display SC' rel='stylesheet'>
        <link href="Style/style-clientes.css" rel="stylesheet">
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
    <div id="barra_buscar">
        <div id="div_datos_1" class="datos">
            <h3>DNI</h3>
            <input type="text" class="inputs"><br>
            <h3>Email</h3>
            <input type="text" class="inputs"><br>
        </div>
        <div id="div_datos_2" class="datos">
            <h3>Nombre</h3>
            <input type="text" class="inputs"><br>
            <h3>Telefono</h3>
            <input type="text" class="inputs"><br>
        </div>
        <div id="div_datos_3" class="datos">
            <h3>Apellidos</h3>
            <input type="text" class="inputs"><br>
        </div>
        <button id="bot_buscar">Buscar</button>
        <div id="limpiar_campos"></div>
    </div>
    
    <div class="div_clientes">
        <div class="cliente">
            <div class="cliente_1">
                <h3 class="text_coche">DNI</h3>
                <input type="text" class="inputs_2" disabled value="x1234567Y"><br>
            </div>
            <div class="cliente_2">
                <h3 class="text_coche">Nombre</h3>
                <input type="text" class="inputs_2" disabled value="Neil"><br>
            </div>
            <div class="cliente_3">
                <h3 class="text_coche">Apellidos</h3>
                <input type="text" class="inputs_2" disabled value="Armstrong"><br>
            </div>
            <button class="bot_abrir_cliente">Abrir</button>
        </div>
        <div id="noHayClientes">
            <p id="textNoHayClientes">No hay clientes!</p>
        </div>
    </div>

</body>
</html>
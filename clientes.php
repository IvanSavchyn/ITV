<?php
    session_start();
    include "ScriptsPHP/ModeloVo/PersonaVo.php";

    if(is_null($_SESSION["user"])) {
        header("Location: entrar.html");
    }
    else {
      $user = unserialize($_SESSION["user"]);
      if(strcmp("admin", $user->getAceptado()) != 0) {
        header("Location: home.php");
      }
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="Style/style-index.css">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js">
        </script>
        <script src="Scripts/index.js"></script>
        <script src="Scripts/script-clientes.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Playfair Display SC' rel='stylesheet'>
        <link href="Style/style-clientes.css" rel="stylesheet">
        <meta charset="UTF-8">
        <link href="http://адрес_сайта/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    </head>
<body ng-app="myITV">
    <div id="bloquear" ng-controller="myCTRL" ng-click="cerrar_menu()"></div>
    <div id="menu">
        <div id="menu_items">
        <div class='menu_item' ng-controller='go_to' ng-click='open_registrar_vehiculo()'><a href='#'>Registrar vehiculo</a><img src='Images/add-plus-button.png' class='img_item_menu'></div>
        <div class='menu_item' ng-controller='go_to' ng-click='open_clientes()'><a href='#'>Clientes</a><img src='Images/two-men.png' class='img_item_menu'></div>
        <div class='menu_item' ng-controller='go_to' ng-click='open_validar_cliente()'><a href='#'>Validar cliente</a><img src='Images/verification-mark.png' class='img_item_menu'></div>
        <div class='menu_item' ng-controller='go_to' ng-click='open_validar_coches()'><a href='#'>Validar Coches</a><img src='Images/front-car.png' class='img_item_menu'></div>
        <div class='menu_item' ng-controller='go_to' ng-click='open_config()'><a href='#'>Configuracion</a><img src='Images/settings-cogwheel-button.png' class='img_item_menu'></div>
        <div class='menu_item' ng-controller='go_to' ng-click='salir()'><a href='#'>Salir</a><img src='Images/cancel-button.png' class='img_item_menu'></div>

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
      <?php
        $buscar = unserialize($_SESSION["user_buscar"]);
        if(!is_null($buscar)) {
          echo "
            <form action='ScriptsPHP/controlador.php' method='POST'>
                <div id='div_datos_1' class='datos'>
                    <h3>DNI</h3>
                    <input type='text' class='inputs' name='dni' value='" . $buscar->getDni() . "'><br>
                    <h3>Email</h3>
                    <input type='text' class='inputs' name='email' value='" . $buscar->getEmail() . "'><br>
                </div>
                <div id='div_datos_2' class='datos'>
                    <h3>Nombre</h3>
                    <input type='text' class='inputs' name='nombre' value='" . $buscar->getNombre() . "'><br>
                    <h3>Telefono</h3>
                    <input type='text' class='inputs' name='telefono' value='" . $buscar->getTelefono() . "'><br>
                </div>
                <div id='div_datos_3' class='datos'>
                    <h3>Apellidos</h3>
                    <input type='text' class='inputs' name='apellidos' value='" . $buscar->getApellidos() . "'><br>
                    <input type='text' class='inputs' name='function' style='display: none;' value='buscarCliente'>
                </div>
                <button id='bot_buscar' type='submit'>Buscar</button>
                <div id='limpiar_campos' ng-controller='clientes' ng-click='limpiar()'></div>
            </form>
          ";
        }
        else {
          echo "
            <form action='ScriptsPHP/controlador.php' method='POST'>
                <div id='div_datos_1' class='datos'>
                    <h3>DNI</h3>
                    <input type='text' class='inputs' name='dni'><br>
                    <h3>Email</h3>
                    <input type='text' class='inputs' name='email'><br>
                </div>
                <div id='div_datos_2' class='datos'>
                    <h3>Nombre</h3>
                    <input type='text' class='inputs' name='nombre'><br>
                    <h3>Telefono</h3>
                    <input type='text' class='inputs' name='telefono'><br>
                </div>
                <div id='div_datos_3' class='datos'>
                    <h3>Apellidos</h3>
                    <input type='text' class='inputs' name='apellidos'><br>
                    <input type='text' class='inputs' name='function' style='display: none;' value='buscarCliente'>
                </div>
                <button id='bot_buscar' type='submit'>Buscar</button>
                <div id='limpiar_campos' ng-controller='clientes' ng-click='limpiar()'></div>
            </form>
          ";
        }
      ?>
    </div>
    <?php
        $buscar = unserialize($_SESSION["user_buscar"]);
        if(!is_null($buscar)) {
          include ("ScriptsPHP/controlador2.php");
          $controlador = new Controlador2();
          if($controlador->ComprobarConexion()) {
              $clientes = $controlador->buscarClientes();
              if(!is_null($clientes)) {
                echo "<div class='div_clientes'>";
                  for($i = 0; $i < sizeof($clientes); $i++) {
                    echo "
                      <div class='cliente'>
                          <div class='cliente_1'>
                              <h3 class='text_coche'>DNI</h3>
                              <input type='text' class='inputs_2' disabled value='" . $clientes[$i]->getDni() . "'><br>
                          </div>
                          <div class='cliente_2'>
                              <h3 class='text_coche'>Nombre</h3>
                              <input type='text' class='inputs_2' disabled value='" . $clientes[$i]->getNombre() . "'><br>
                          </div>
                          <div class='cliente_3'>
                              <h3 class='text_coche'>Apellidos</h3>
                              <input type='text' class='inputs_2' disabled value='" . $clientes[$i]->getApellidos() . "'><br>
                          </div>
                          <form action='ScriptsPHP/controlador.php' method='POST'>
                            <input type='text' class='inputs' name='function' style='display: none;' value='selectCliente'>
                            <input type='text' class='inputs' name='dni' style='display: none;' value='" . $clientes[$i]->getDni() . "'>
                            <button class='bot_abrir_cliente'>Abrir</button>
                          </form>
                      </div>
                    ";
                  }
                echo "</div>";
              }
              else {
                echo "
                    <div class='div_clientes'>
                      <div id='noHayClientes'>
                          <p id='textNoHayClientes'>No hay clientes!</p>
                      </div>
                    </div>
                ";
              }
          }
          else {
              echo "<h2>No se puede conectar a base de datos!</h2>";
          }
          $controlador->Desconectar();
        }
    ?>

</body>
</html>

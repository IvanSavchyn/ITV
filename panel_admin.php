<html>
    <head>
        <link rel="stylesheet" href="Style/style-index.css">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js">
        </script>
        <script src="Scripts/index.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Playfair Display SC' rel='stylesheet'>
        <link href="Style/style-panel-admin.css" rel="stylesheet">
        <title>Configuracion</title>
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


    <h2>Parqueadero</h2>
    <?php
    include "ScriptsPHP/Controlador2.php";
    echo "
      <div id='parqueaderos'>
          <div class='insertar'>
              <h3 class='insert_parqueadero'>Insertar</h3>
              <div class='div_datos_1' class='datos'>
                  <h3>ID</h3>
                  <input type='text' class='inputs' id='parck1'><br>
              </div>
              <div class='div_datos_2' class='datos'>
                  <h3>Nombre</h3>
                  <input type='text' class='inputs' id='parck2'><br>
              </div>
              <div class='div_datos_3' class='datos'>
                  <h3>Ubicacion</h3>
                  <input type='text' class='inputs' id='parck3'><br>
              </div>
              <button class='bot_insertar' ng-controller='panelAdmin' ng-click='insertar(1)'>Añadir</button>
        </div>
    ";
    $controlador = new Controlador2();
    if($controlador->ComprobarConexion()) {
      $parck = $controlador->selectParqueaderos();
      if(!is_null($parck)) {
        echo "<div class='div_parqueaderos'>
          <h3 class='insert_parqueadero'>Parqueaderos</h3>
        ";
          for($i = 0; $i < sizeof($parck); $i++) {
            echo "
            <div class='parqueadero' id='parck" . $parck[$i]->getId() . "'>
                <div class='div_datos_1' class='datos'>
                    <h3>ID</h3>
                    <input type='text' class='inputs' disabled value='" . $parck[$i]->getId() . "'><br>
                </div>
                <div class='div_datos_2' class='datos'>
                    <h3>Nombre</h3>
                    <input type='text' class='inputs' disabled value='" . $parck[$i]->getNombre() . "'><br>
                </div>
                <div class='div_datos_3' class='datos'>
                    <h3>Ubicacion</h3>
                    <input type='text' class='inputs' disabled value='" . $parck[$i]->getUbicacion() . "'><br>
                </div>
                <button class='bot_eliminar' ng-controller='panelAdmin' ng-click='eliminar(\"parck" . $parck[$i]->getId() . "\", 1)'>Eliminar</button>
            </div>
            ";
          }
          //Fin div_parqueaderos
          echo "</div>";
          //Fin div "parqueaderos"
          echo "</div>";
      }
      else {
        echo "
        <div class='parqueadero' id=''>
            <h2>No hay parqueaderos!</h2>
        </div>
        ";
        //Fin div "parqueaderos"
        echo "</div>";
      }
      echo "<h2>Bahia</h2>";
      echo "<div class='bahias'>";
      echo "
        <div class='insertar'>
            <h3 class='insert_parqueadero'>Insertar</h3>
            <div class='div_datos_1' class='datos'>
                <h3>ID</h3>
                <input type'tex' class='inputs' id='bahia1'><br>
            </div>
            <div class='div_datos_2' class='datos'>
                <h3>Parqueadero</h3>
                <select class='selecT' id='bahia2'>";
                  for($j = 0; $j < sizeof($parck); $j++) {
                    echo "<option value='" . $parck[$j]->getId() . "'>ID: " . $parck[$j]->getId() . " Nombre: " . $parck[$j]->getNombre() . "</option>";
                  }
                echo "</select>
            </div>
            <div class='div_datos_3' class='datos'>
                <h3>Disponible</h3>
                <select class='selecT' id=bahia3>
                        <option value='true'>Si</option>
                        <option value='false'>No</option>
                </select>
            </div>
            <button class='bot_insertar' ng-controller='panelAdmin' ng-click='insertar(2)'>Añadir</button>
        </div>
      ";
      $bahias = $controlador->selectBahias();
      if(!is_null($bahias)) {
          echo "
            <div class='div_bahias'>
            <h3 class='insert_parqueadero'>Bahias</h3>
          ";
          for($i = 0; $i < sizeof($bahias); $i++) {
              echo "   <div class='bahia'>
                      <div class='div_datos_1' class='datos'>
                          <h3>ID</h3>
                          <input disabled type='text' class='inputs' value='" . $bahias[$i]->getIdBahia() . "'><br>
                      </div>
                      <div class='div_datos_2' class='datos'>
                          <h3>Parqueadero</h3>
                          <select class='selecT'>";
                            for($j = 0; $j < sizeof($parck); $j++) {
                              if(strcmp($parck[$j]->getId(), $bahias[$i]->getIdParqueadero()) == 0) {
                                echo "<option value='" . $parck[$j]->getId() . "' selected='true'>ID: " . $parck[$j]->getId() . " Nombre: " . $parck[$j]->getNombre() . "</option>";
                              }
                              else {
                                echo "<option value='" . $parck[$j]->getId() . "'>ID: " . $parck[$j]->getId() . " Nombre: " . $parck[$j]->getNombre() . "</option>";
                              }
                            }
                          echo "</select>
                      </div>
                      <div class='div_datos_3' class='datos'>
                          <h3>Disponible</h3>
                          <select class='selecT'>";
                                if(strcmp($bahias[$i]->getDisponible(), "true") == 0) {
                                  echo "<option value='true' selected='true'>Si</option>
                                  <option value='false'>No</option>";
                                }
                                else {
                                  echo "<option value='true'>Si</option>
                                  <option value='false' selected='true'>No</option>";
                                }
                          echo "</select>
                      </div>
                      <button class='bot_modificar'>Modificar</button>
                      <button class='bot_eliminar_bahia'>Eliminar</button>
                  </div>";
          }
          //Fin div bahias
          echo "</div>";
      }
      else {
        echo "<div class='div_bahias'>
        <h2>No hay bahias</h2>
        </div></div>";
      }
      echo "</div>";
      echo "<h2>Tarifas</h2>";
      $tarifas = $controlador->selectTarifas();
      //Fin div tarifas
      echo "<div class='tarifas'>
      <div class='div_tarifas'>";
      if(!is_null($tarifas)) {
        for($i = 0; $i < sizeof($tarifas); $i++) {
          echo "
            <div class='tarifa'>
                <div class='div_datos_1' class='datos' style='width: 40%; left: 0%'>
                    <h3>Tipo</h3>
                    <input disabled type='text' class='inputs' value='" . $tarifas[$i]->getTipo() . "'><br>
                </div>
                <div class='div_datos_2' class='datos' style='width: 40%; left: 35%'>
                    <h3>Costo €</h3>
                    <input type='text' class='inputs' value='" . $tarifas[$i]->getCosto() . "' id='tarifa" . $tarifas[$i]->getTipo() ."'><br>
                </div>
                <button class='bot_insertar' ng-controller='panelAdmin' ng-click='modificar(\"" . $tarifas[$i]->getTipo() . "\")'>Modificar</button>
            </div>
          ";
        }
      }
      else {
        echo "<div class='tarifa'>
          <h2>No hay tarifas!</h2>
        </div>";
      }
      echo "</div><div>";
    }
    else {
      echo "<h2>No se puede conectar a base de datos!</h2>";
    }
    $controlador->Desconectar();
    ?>
    <!-- un coment -->
</body>
</html>

<html>
    <head>
        <link rel="stylesheet" href="Style/style-index.css">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js">
        </script>
        <script src="Scripts/index.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Playfair Display SC' rel='stylesheet'>
        <link href="Style/style-cliente-seleccionado.css" rel="stylesheet">
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

    <h2>Cliente</h2>

    <?php
        include ("ScriptsPHP/controlador2.php");
        $controlador = new Controlador2();
        if($controlador->ComprobarConexion()) {
            $cliente = $controlador->getClientePorDni("123456789");
            if(!is_null($cliente)) {
                echo "
                    <div id='div_datos'>
                        <div id='div_datos_1' class='datos'>
                            <h3>DNI</h3>
                            <input disabled type='text' class='inputs' value='" . $cliente->getDni() . "'<br>
                            <h3>Email</h3>
                            <input type='text' class='inputs' value='" . $cliente->getEmail() . "'><br>
                        </div>
                        <div id='div_datos_2' class='datos'>
                            <h3>Nombre</h3>
                            <input type='text' class='inputs' value='" . $cliente->getNombre() . "'><br>
                            <h3>Telefono</h3>
                            <input type='text' class='inputs' value='" . $cliente->getTelefono() . "'><br>
                        </div>
                        <div id='div_datos_3' class='datos'>
                            <h3>Apellidos</h3>
                            <input type='text' class='inputs' value='" . $cliente->getApellidos() . "'><br>
                        </div>
                        <button id='bot_modificar'>Modificar</button>
                        <button id='bot_eliminar_cliente'>Eliminar</button>
                    </div>
                    <h2>Coches</h2>
                ";
                $coches = $controlador->getCochesCliente($cliente->getDni());
                if(!is_null($coches)) {
                    echo "<div class='div_coches'>";
                        for($i = 0; $i < sizeof($coches); $i++) {
                            echo "
                                <p class='veh_inf'>Información del vehículo</p>
                                    <div class='coche'>
                                        <div class='coche_1'>
                                            <h3 class='text_coche'>Matricula</h3>
                                            <input type='text' class='inputs_2' disabled value='" . $coches[$i]->getId() . "'><br>
                                        </div>
                                        <div class='coche_2'>
                                            <h3 class='ext_coche'>Marca</h3>
                                            <input type='text' class='inputs_2' disabled value='" . $coches[$i]->getMarca() . "'><br>
                                        </div>
                                        <div class='coche_3'>
                                            <h3 class='text_coche'>Tipo</h3>";
                                            if(strcmp($coches[$i]->getTipo(), "privado") == 0) {
                                                echo "<select class='select_tipo_coche'>
                                                            <option value='privado' selected='true'>Privado</option>
                                                            <option value='publico'>Publico</option>
                                                    </select>";
                                            }else {
                                                echo "<select class='select_tipo_coche'>
                                                            <option value='privado'>Privado</option>
                                                            <option value='publico' selected='true'>Publico</option>
                                                    </select>";
                                            }

                                        echo "

                                        </div>
                                        <button class='bot_modificar_coche'>Modificar</button>
                                        <button class='bot_eliminar_coche'>Eliminar coche</button>

                                    ";
                                $pago = $controlador->getPago($coches[$i]->getId());
                                
                            if(!is_null($pago)) {
                                echo "
                                    <p class='pago_inf'>Información del pago</p>
                                        <div class='div_pago'>
                                    <div class='pago_1'>
                                        <h3 class='text_coche'>Numero de pago</h3>
                                        <input type='text' class='inputs_2' disabled value='" . $pago->getId() . "'><br>
                                    </div>
                                    <div class='pago_2'>
                                        <h3 class='text_coche'>Costo</h3>
                                        <input type='text' class='inputs_2' disabled value='" . $pago->getCosto() . "'><br>
                                    </div>
                                    <div class='pago_3'>
                                        <h3 class='text_coche'>Fecha</h3>
                                        <input type='text' class='inputs_2' disabled value='" . $pago->getFecha() . "'><br>
                                    </div>
                                    <div class='pago_4'>
                                        <h3 class='text_coche'>Hora</h3>
                                        <input type='text' class='inputs_2' disabled value='" . $pago->getHora() . "'><br>
                                    </div>

                                    </div>
                                ";
                                //Cerrar div 'pago'
                                $bahia = $controlador->getBahia($pago->getIdBahia());
                                $bahias = $controlador->getBahias();
                                if(strcmp($pago->getIdBahia(), "") == 0) {
                                        echo "
                                            <p class='inf_parqueadero'>Informacion del Bahia</p>
                                                <div class='div_parqueadero'>
                                                    <div class='parqueadero'>
                                                        <h3 class='text_coche'>Parqueadero</h3>
                                                        <select class='select_parqueadero'>
                                                            <option value=''></option>
                                                        </select>
                                                    </div>
                                                    <div class='bahia'>
                                                        <h3 class='text_coche'>Bahia</h3>
                                                        <select class='select_bahia'>
                                                            <option value=''></option>";
                                                            for($j = 0; $j < sizeof($bahias); $j++) {
                                                                echo "<option value='" . $bahias[$j]->getIdBahia() . "'>" . $bahias[$j]->getIdBahia() . " :Disponible " . $bahias[$j]->getDisponible() ."</option>";
                                                            }
                                                       echo "</select>
                                                    </div>
                                                    <button class='bot_asignar'>Asignar parqueadero</button>


                                                </div>
                                        ";

                                }else {

                                    $parqueadero = $controlador->getParqueadero($bahia->getIdParqueadero());

                                    echo "
                                            <p class='inf_parqueadero'>Informacion del Bahia</p>
                                                <div class='div_parqueadero'>
                                                    <div class='parqueadero'>
                                                        <h3 class='text_coche'>Parqueadero</h3>
                                                        <select class='select_parqueadero'>
                                                            <option value=''>ID: " . $parqueadero->getId() . " Nombre: " . $parqueadero->getNombre() . " Direccion: " . $parqueadero->getUbicacion() . "</option>
                                                        </select>
                                                    </div>
                                                    <div class='bahia'>
                                                        <h3 class='text_coche'>Bahia</h3>
                                                        <select class='select_bahia'>";
                                                            for($j = 0; $j < sizeof($bahias); $j++) {
                                                                if(strcmp($bahia->getIdBahia(), $bahias[$j]->getIdBahia()) == 0) {
                                                                    echo "<option value='" . $bahias[$j]->getIdBahia() . "' selected='true'>" . $bahias[$j]->getIdBahia() . " :Disponible " . $bahias[$j]->getDisponible() ."</option>";
                                                                }
                                                                else {
                                                                    echo "<option value='" . $bahias[$j]->getIdBahia() . "'>" . $bahias[$j]->getIdBahia() . " :Disponible " . $bahias[$j]->getDisponible() ."</option>";
                                                                }
                                                            }
                                                        echo "</select>
                                                    </div>
                                                    <button class='bot_asignar'>Asignar parqueadero</button>


                                                </div>
                                        ";
                                }


                            }
                            else {
                                echo "<p class='pago_inf'>Información del pago</p>
                                        <div class='div_pago'>
                                    <p class='p_no_realizado'>Pago no realizado!</p>
                                    </div>
                                ";
                            }
                            //Cerrar div 'coche'
                            echo "</div>";
                        }
                    //Cerrar div 'div_coches'
                    echo "</div>";
                }
                else {
                    echo "<div class='div_coches' style='height: 30%;'>
                            <p class='p_no_realizado'>Cliente no tiene coches registrados!</p>
                        </div>
                        ";
                }

            }
            else {
                 echo "<h2>Cliente no encontrado!</h2>";
            }
        }
        else {
           echo "<h2>No se puede conectar a base de datos!</h2>";
        }
        $controlador->Desconectar();


?>
</body>
</html>

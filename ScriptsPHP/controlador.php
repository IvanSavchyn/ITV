<?php
    include("ModeloVo/PersonaVo.php");
    include("ModeloVo/VehiculoVo.php");
    include("ModeloDao/PersonaDao.php");
    include("ModeloDao/VehiculoDao.php");
    include("Logica/Conector.php");
    include("ModeloDao/TarifaDao.php");

    $func = strval($_POST["function"]);
    $bd = new Conector();
    if($bd->getBD() != null) {
        if(strcmp($func, "registrar") == 0) {
            echo registrarCliente($bd->getBD());
        }
        if(strcmp($func, "registrarCoche") == 0) {
            echo registrarCoche($bd->getBD());
        }
        if(strcmp($func, "entrar") == 0) {
            echo entrar($bd->getBD());
        }
        if(strcmp($func, "buscarCliente") == 0) {
            buscarClientes();
        }
        if(strcmp($func, "selectCliente") == 0) {
            selectCliente();
        }
        if(strcmp($func, "eliminarCliente") == 0) {
            echo eliminarCliente($bd->getBD());
        }
        if(strcmp($func, "aceptarCliente") == 0) {
            echo aceptarCliente($bd->getBD());
        }
        if(strcmp($func, "eliminarCoche") == 0) {
            echo eliminarCoche($bd->getBD());
        }
        if(strcmp($func, "aceptarCoche") == 0) {
            echo aceptarCoche($bd->getBD());
        }
        if(strcmp($func, "modificarCoche") == 0) {
            echo modificarCoche($bd->getBD());
        }
        if(strcmp($func, "eliminarCoche") == 0) {
            echo eliminarCoche($bd->getBD());
        }
        if(strcmp($func, "pagar") == 0) {
            echo pagar($bd->getBD());
        }
    }
    else {
        echo "Error en conectarse a base de datos" . $bd->getError();
    }
    $bd->Desconectar();


    function registrarCliente($bd) {
        $resultado = "";
        $personaVo = new PersonaVo($_POST["dni"], $_POST["nombre"], $_POST["apellidos"], $_POST["email"], $_POST["telefono"], $_POST["direccion"],"false", $_POST["contr"]);

        $personaDao = new PersonaDao($bd);
            if(!$personaDao->clienteExiste($personaVo)) {
                 $result = $personaDao->registrarCliente($personaVo);
                 if(strcmp("insertado", $result) == 0) {
                     $resultado = "Cliente registrado!";
                 }
                else {
                    $resultado = $result;
                 }
             }
            else {
                $resultado = "Cliente ya esta registrado!";
             }
        return $resultado;
    }

    function registrarCoche($bd) {
        $resultado = "";

        $vehiculoVo = new VehiculoVo($_POST["matricula"],$_POST["marca"], "false", $_POST["dni_cliente"], $_POST["tipo"]);

        $vehiculoDao = new VehiculoDao($bd);

        if(!$vehiculoDao->cocheExiste($vehiculoVo)) {
            $result = $vehiculoDao->registrarVehiculo($vehiculoVo);
            if(strcmp("insertado", $result) == 0) {
                $resultado = "Coche registrado!";
            }
            else {
                $resultado = $result;
            }
        }
        else {
            $resultado = "Coche ya esta registrado!";
        }
        return $resultado;
    }
    function entrar($bd) {
        $result = "";
        $persona = new PersonaVo($_POST["dni"], "", "", "", "", "","", $_POST["contr"]);
        $personaDao = new PersonaDao($bd);

        $persona = $personaDao->entrar($persona);
        if(is_null($persona)) {
            $result = "incorrecto";
        }
        else {
            iniciarSession($persona);
            if(strcmp($persona->getAceptado(), "admin") == 0) {
                $result = "admin";
                header("Location: ../clientes.php");
            }
            else {
                $result = "user";
                header("Location: ../home.php");
            }

        }
        return $result;
    }
    function iniciarSession($persona) {
        session_start();
        $_SESSION["user"] = serialize($persona);
        $_SESSION["user_buscar"] = serialize(null);
        $_SESSION["cliente_seleccionado"] = "";
    }
    function buscarClientes() {
      session_start();
      $persona_buscar = new PersonaVo($_POST["dni"], $_POST["nombre"], $_POST["apellidos"], $_POST["email"], $_POST["telefono"], "", "", "");
      $_SESSION["user_buscar"] = serialize($persona_buscar);
      header("Location: ../clientes.php");
    }
    function selectCliente() {
        session_start();
        $_SESSION["cliente_seleccionado"] = $_POST["dni"];
        header("Location: ../cliente_seleccionado.php");
    }
    function eliminarCliente($bd) {
        $persona = new PersonaDao($bd);
        return $persona->eliminarCliente($_POST["dni"]);
    }
    function aceptarCliente($bd) {
        $persona = new PersonaDao($bd);
        return $persona->aceptarCliente($_POST["dni"]);
    }
    function eliminarCoche($bd) {
        $vehiculo = new VehiculoDao($bd);
        return $vehiculo->eliminarCoche($_POST["matricula"]);
    }
    function aceptarCoche($bd){
        $vehiculo = new VehiculoDao($bd);
        return $vehiculo->aceptarCoche($_POST["matricula"]);
    }
    function modificarCoche($bd) {
        $vehiculo = new VehiculoDao($bd);
        return $vehiculo->modificarCoche($_POST["matricula"], $_POST["tipo"]);
    }
    function pagar($bd) {
        $tarifaDao = new TarifaDao($bd);
        $vehiculo = new VehiculoDao($bd);
        $coche = $vehiculo->getCoche($_POST["matricula"]);
        $tarifa = $tarifaDao->getTarifa($coche->getTipo());
        if(!is_null($tarifa)) {
            setlocale(LC_ALL, "es_ES");
            $fecha = date("Y-m-d");
            $t = time();
            $hora = $t / 3600 % 24;
            $min = $t / 60 % 60;
            if($hora + 2 == 24) {
              $hora = 00 . "";
            }
            elseif ($hora + 2 == 25) {
              $hora = 01 . "";
            }
            else {
              $hora += 2;
            }
            $hora = $hora . ":" . $min;
            $pago = new PagoVo("",null,$_POST["matricula"], $hora, $fecha, $tarifa->getCosto());
            $pagoDao = new PagoDao($bd);
            if($pagoDao->pagar($pago)) {
              echo "Pagado correctamente!";
            }
            else {
              echo "Error en pagar!";
            }
        }
        else {
          echo "Error!";
        }
    }


?>

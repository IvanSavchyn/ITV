<?php 
    include("ModeloVo/PersonaVo.php");
    include("ModeloVo/VehiculoVo.php");
    include("ModeloDao/PersonaDao.php");
    include("ModeloDao/VehiculoDao.php");
    include("Logica/Conector.php");
    
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
        $vehiculoVo = new VehiculoVo($_POST["matricula"],$_POST["marca"], "false","123456789",$_POST["tipo"]);
        
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
            }
            else {
                $result = "user";
            }
            
        }
        return $result;
    }
    function iniciarSession($persona) {
        session_start();
        $_SESSION["dni"] = $persona->getDni();
        $_SESSION["nombre"] = $persona->getNombre();
        $_SESSION["apellidos"] = $persona->getApellidos();
        $_SESSION["email"] = $persona->getEmail();
        $_SESSION["telefono"] = $persona->getTelefono();
        $_SESSION["Direccion"] = $persona->getDireccion();
        $_SESSION["aceptado"] = $persona->getAceptado();
        $_SESSION["contr"] = $persona->getContrasenia();
    }

?>
<?php 
    include ("ModeloVo/PersonaVo.php");
    include ("ModeloDao/PersonaDao.php");
    $func = strval($_POST["function"]);
    if(strcmp($func, "registrar") == 0) {
        registrarCliente();
    }
    

    function registrarCliente() {
        $personaVo = new PersonaVo($_POST["dni"], $_POST["nombre"], $_POST["apellidos"], $_POST["email"], $_POST["telefono"], $_POST["direccion"], $_POST["contr"], "");
        
        $personaDao = new PersonaDao();
        if(strcmp($personaDao->conectar(), "1") == 0) {
            if(!$personaDao->clienteExiste($personaVo)) {
                $result = $personaDao->registrarCliente($personaVo);
                if(strcmp("insertado", $result) == 0) {
                    echo "Cliente registrado!";
                }
                else {
                    echo $result;
                }
            }
            else {
                echo "Cliente ya esta registrado!";
            }
            $personaDao->desconectar();
        }
        else {
            echo "No se puede conectar a base de datos";
        }
        
    }

?>
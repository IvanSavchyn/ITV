<?php
    include("Logica/Conector.php");
    foreach ( glob(  'C:/xampp/htdocs/ITV/ITV/ScriptsPHP/ModeloVo/*.php') as $filename)
    {
        include_once $filename;
    }
    foreach ( glob(  'C:/xampp/htdocs/ITV/ITV/ScriptsPHP/ModeloDao/*.php') as $filename)
    {
        include_once $filename;
    }

    $json = file_get_contents('php://input');

    //Comprobamos si datos eran enviados de un request Angular
    if(json_decode($json)) {
        $es_angular = true;
    }
    else {
        $es_angular = false;
    }




    $bd = new Conector();
    if($bd->getBD() != null) {
        if($es_angular == false) {
            $func = strval($_POST["function"]);
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
                selectCliente($bd->getBD());
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
            $obj = json_decode($json);
            $func = $obj->data->function;
            if(strcmp($func, "modificarDatos") == 0) {
              $resp = modificarDatos($bd->getBD(), $obj);
              $resp["error"]="-1";
              echo json_encode($resp);
            }
            if(strcmp($func, "eliminarCliente") == 0) {
                $resp = eliminarCliente($bd->getBD(), $obj->data->dni);
                $resp["error"]="-1";
                echo json_encode($resp);
            }
            if(strcmp($func, "aceptarCliente") == 0) {
                $resp = aceptarCliente($bd->getBD(), $obj->data->dni);
                $resp["error"]="-1";
                echo json_encode($resp);
            }
            if(strcmp($func, "eliminarCoche") == 0) {
                $resp = eliminarCoche($bd->getBD(), $obj->data->id);
                $resp["error"]="-1";
                echo json_encode($resp);
            }
            if(strcmp($func, "aceptarCoche") == 0) {
                $resp = aceptarCoche($bd->getBD(),  $obj->data->id);
                $resp["error"]="-1";
                echo json_encode($resp);
            }
            if(strcmp($func, "asignarBahia") == 0) {
                $resp = asignarBahia($bd->getBD(), $obj);
                $resp["error"]="-1";
                echo json_encode($resp);
            }
        }


    }
    else {
      if($es_angular == false) {
        echo "Error en conectarse a base de datos" . $bd->getError();
      }
      else {
        $resp = array("error" =>"Error en conectarse a base de datos");
        echo json_encode($resp);
      }
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
    function selectCliente($bd) {
        session_start();
        $personaDao = new PersonaDao($bd);
        $_SESSION["cliente_seleccionado"] = serialize($personaDao->getClientePorDni($_POST["dni"]));;
        header("Location: ../cliente_seleccionado.php");
    }
    function eliminarCliente($bd, $dni) {
        $result = array();
        $persona = new PersonaDao($bd);
        if($persona->eliminarCliente($dni)) {
          $result["info"] = "Cliente Eliminado!";
          $result["codigo"] = "0";
        }
        else {
          $result["info"] = "No se puede eliminar cliente!";
          $result["codigo"] = "-1";
        }
        return $result;
    }
    function aceptarCliente($bd, $dni) {
        $result = array();
        $persona = new PersonaDao($bd);
        if($persona->aceptarCliente($dni)) {
          $result["info"] = "Cliente Aceptado!";
          $result["codigo"] = "0";
        }
        else {
          $result["info"] = "No se puede aceptar cliente!";
          $result["codigo"] = "-1";
        }
        return $result;
    }
    function eliminarCoche($bd, $id) {
        $result = array();
        $vehiculo = new VehiculoDao($bd);
        if($vehiculo->eliminarCoche($id)) {
          $result["info"] = "Coche eliminado!";
          $result["codigo"] = "0";
        }
        else {
          $result["info"] = "No se puede eliminar el coche!";
          $result["codigo"] = "-1";
        }
        return $result;
    }
    function aceptarCoche($bd, $id){
        $result = array();
        $vehiculo = new VehiculoDao($bd);
        if($vehiculo->aceptarCoche($id)) {
          $result["info"] = "Coche aceptado!";
          $result["codigo"] = "0";
        }
        else {
          $result["info"] = "No se puede aceptar el coche!";
          $result["codigo"] = "-1";
        }
        return $result;

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
              echo "Paga realizado correctamente!";
            }
            else {
              echo "Pago no realizado!";
            }
        }
        else {
          echo "Error!";
        }
    }
    function cambiarContrasenia($bd, $obj, $respuesta) {
        $persona = unserialize($_SESSION["user"]);
        if(strcmp($persona->getContrasenia(), $obj->data->contr) == 0) {
            if(strcmp($persona->getContrasenia(), $obj->data->contr2) != 0) {
                $persona->setNuevaContrasenia($obj->data->contr2);
                $personaDao = new PersonaDao($bd);
                if($personaDao->modificarContrasenia($persona)) {
                    $persona->setContrasenia($obj->data->contr2);
                    $_SESSION["user"] = serialize($persona);
                    $respuesta["contr"]="Contraseña modificada!";
                 }
                else {
                    $respuesta["contr"]="No se puede modificar contraseña!";
                }
            }
            else {
                $respuesta["contr"]="Nueva contraseña no puede coincidir con contraseña actual!";
            }
        }
        else {
            $respuesta["contr"]="Contraseña incorrecta!";
        }
        return $respuesta;
    }
    function modificarDatos($bd, $obj) {
       $respuesta = array();
       session_start();

       if(strcmp("-1", $obj->data->contr) != 0) {
         $respuesta = cambiarContrasenia($bd, $obj, $respuesta);
       }
       else {
         $respuesta["contr"]="-1";
       }

       if($obj->data->es_admin == 0) {
         $pers = unserialize($_SESSION["user"]);
          $persona = new PersonaVo($obj->data->dni, $obj->data->nombre, $obj->data->apellidos, $obj->data->email, $obj->data->telefono, $obj->data->direccion, "","");
       }
       else {
         $pers = unserialize($_SESSION["cliente_seleccionado"]);
         $persona = new PersonaVo($obj->data->dni, $obj->data->nombre, $obj->data->apellidos, $obj->data->email, $obj->data->telefono, $pers->getDireccion(), "","");
       }
       if(comprobarNuevosDatos($obj, $pers)) {

         $personaDao = new PersonaDao($bd);
         if($personaDao->modificarDatos($persona)) {
           if($obj->data->es_admin == 0) {
             $_SESSION["user"] = serialize($personaDao->getClientePorDni($obj->data->dni));
             $respuesta["info"]="Datos se han modificado!";
           }
           else {
             $_SESSION["cliente_seleccionado"] = serialize($personaDao->getClientePorDni($obj->data->dni));
             $respuesta["info"]="Datos se han modificado!";
           }
         }
         else {
          $respuesta["info"]="No se puede modificar datos!";
         }
       }
       else {
         $respuesta["info"]="-1";
       }
       return $respuesta;
    }
    function comprobarNuevosDatos($obj, $persona) {

      $modificar = false;
      if(strcmp($obj->data->nombre, $persona->getNombre()) != 0) {
        $modificar = true;
      }
      if(strcmp($obj->data->apellidos, $persona->getApellidos()) != 0) {
        $modificar = true;
      }
      if(strcmp($obj->data->email, $persona->getEmail()) != 0) {
        $modificar = true;
      }
      if(strcmp($obj->data->telefono, $persona->getTelefono()) != 0) {
        $modificar = true;
      }
      //admin no puede modificar direccion
      if($obj->data->es_admin == 0) {
        if(strcmp($obj->data->direccion, $persona->getDireccion()) != 0) {
          $modificar = true;
        }
      }
      return $modificar;
    }
    function asignarBahia($bd, $obj) {
      $result = array();
      $pago = new PAgoVo($obj->data->pago, $obj->data->bahia, "","","","");
      $pagoDao = new PagoDao($bd);
      if($pagoDao->asignarBahia($pago)) {
        $result["info"] = "Bahia asignada correctamente!";
        $result["codigo"] = 0;
      }
      else {
        $result["info"] = "No se puede asignar bahia!";
        $result["codigo"] = -1;
      }
      return $result;
    }


?>

<?php

    class PersonaDao {
        private $bd;

        public function __construct($bd) {
            $this->bd = $bd;
        }

        public function registrarCliente($cliente) {
            $consulta = "INSERT INTO personas VALUES('" . $cliente->getDni() ."' , '" . $cliente->getNombre() . "' , '" . $cliente->getApellidos() . "', '" . $cliente->getEmail() . "' , '" . $cliente->getTelefono() . "' , '" . $cliente->getDireccion() . "' ,'false', '" . $cliente->getContrasenia() . "');";

            if(mysqli_query($this->bd, $consulta)) {
                return "insertado";
            }
            else {
                return mysqli_error($this->bd);
            }


        }
        public function clienteExiste($cliente) {
            $consulta = "SELECT * FROM personas WHERE dni = '" . $cliente->getDni() ."';";
            $result = mysqli_query($this->bd, $consulta);
            if(mysqli_num_rows($result) == 0) {
                return false;
            }
            else {
                return true;
            }
        }
        public function getClientes($aceptado) {

            $consulta = "SELECT * FROM personas WHERE aceptado = '" . $aceptado ."';";
            $result = mysqli_query($this->bd, $consulta);
            if(mysqli_num_rows($result) == 0) {
                return null;
            }
            else {
                $clientes = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $persona = new PersonaVo($row["dni"], $row["nombre"], $row["apellidos"], $row["email"], $row["telefono"], $row["direccion"], $row["aceptado"], "");

                    array_push($clientes, $persona);
                }
                return $clientes;
            }
        }
        public function getClientePorDni($dni) {

            $consulta = "SELECT * FROM personas WHERE dni = '" . $dni ."';";
            $result = mysqli_query($this->bd, $consulta);
            if(mysqli_num_rows($result) == 0) {
                return null;
            }
            else {
                $row = mysqli_fetch_assoc($result);
                $persona = new PersonaVo($row["dni"] , $row["nombre"],  $row["apellidos"] , $row["email"] , $row["telefono"], $row["direccion"], $row["aceptado"], $row["contrasenia"]);

                return $persona;
            }
        }
        public function entrar($cliente) {

            $consulta = "SELECT * FROM personas WHERE dni = '" . $cliente->getDni() ."' AND contrasenia='" . $cliente->getContrasenia() . "';";
            $result = mysqli_query($this->bd, $consulta);
            if(mysqli_num_rows($result) == 0) {
                return null;
            }
            else {
                $row = mysqli_fetch_assoc($result);
                $persona = new PersonaVo($row["dni"], $row["nombre"], $row["apellidos"], $row["email"], $row["telefono"], $row["direccion"], $row["aceptado"], $row["contrasenia"]);
                return $persona;
            }
        }
        public function buscarClientes($dni, $nombre, $apellidos, $email, $telefono) {
            $consulta = "SELECT * FROM personas WHERE aceptado = 'true'";
            $cont = 0;
            if(strcmp($dni, "") != 0) {
              $consulta .= "AND dni = '" . $dni . "' ";
            }

            if(strcmp($nombre, "") != 0) {
                $consulta .= "AND nombre = '" . $nombre . "' ";
            }
            if(strcmp($apellidos, "") != 0) {
                $consulta .= "AND apellidos = '" . $apellidos . "' ";
            }
            if (strcmp($email, "") != 0) {
              $consulta .= "AND email = '" . $email . "' ";
            }
            if (strcmp($telefono, "") != 0) {
              $consulta .= "AND telefono = '" . $telefono . "' ";
            }
            $consulta .= ";";

            $result = mysqli_query($this->bd, $consulta);
            if(mysqli_num_rows($result) == 0) {
              return null;
            }
            else {
              $clientes = array();
              while($row = mysqli_fetch_assoc($result)) {
                $cliente = new PersonaVo($row["dni"], $row["nombre"], $row["apellidos"],  $row["email"],  $row["telefono"], $row["direccion"], "", "");
                array_push($clientes, $cliente);
              }
              return $clientes;
            }
        }
        public function eliminarCliente($dni) {
            $consulta = "DELETE FROM personas WHERE dni = '" . $dni . "';";
            if(mysqli_query($this->bd, $consulta)) {
                return true;
            }
            else {
                return false;
            }
        }
        public function aceptarCliente($dni){
            $consulta = "UPDATE personas SET aceptado='true' WHERE dni = '" . $dni . "';";
            if(mysqli_query($this->bd, $consulta)) {
                return true;
            }
            else {
                return false;
            }
        }
        public function modificarContrasenia($persona) {
            $consulta = "UPDATE personas SET contrasenia='" . $persona->getNuevaContrasenia() . "' WHERE dni='" . $persona->getDni() . "';";
            if(mysqli_query($this->bd, $consulta)) {
                return true;
            }
            else {
                return false;
            }
        }
        public function modificarDatos($persona) {
          $consulta = "UPDATE personas SET nombre='" . $persona->getNombre() . "', apellidos='" . $persona->getApellidos() . "', email='" . $persona->getEmail() . "', telefono='" . $persona->getTelefono() . "', direccion='" . $persona->getDireccion() . "' WHERE dni = '" . $persona->getDni() . "';";
          if(mysqli_query($this->bd, $consulta)) {
            return true;
          }
          else {
            return false;
          }
        }
    }
?>

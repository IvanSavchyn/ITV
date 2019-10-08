<?php

public class ParqueaderoVo {
    private $id;
    private $nombre;
    private $ubicacion;
    
    public function __construct($id, $nombre, $ubicacion) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->ubicacion = $ubicacion;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    public function setNombre($nombre) {
         $this->nombre = $nombre;
    }
    public function setUbicacion($ubicacion) {
        $this->ubicacion = $ubicacion;
    }
    public function getId() {
        return $this->id;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function getUbicacion() {
        return $this->ubicacion;
    }
}

?>
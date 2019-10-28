<?php
namespace App\GenerarHorario;
class Maestros {

    protected $name; //nombre del maestro
    protected $horario;   //horario del maestro
    public function __construct($name) {
        $this->name = $name;        
    }
    
    public function setHorario($horario) {        
        $this->horario = $horario;
    }
    
    public function getName() {
        return $this->name;
    }        
}

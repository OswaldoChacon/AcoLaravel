<?php
namespace App\GenerarHorario;
use App\GenerarHorario\Problema; 

Class Ant{
    protected $id; //id
    protected $recorrido; // 1/violaciones
    protected $violaciones; //violaciones suaves entero
    protected $intViolacionesDuras; //violaciones duras entero
    protected $problema; //clase problema
    public $timeSlots; //creo que no funciona para naada
    protected $Ai; // //las asignaciones
    protected $Vi; //violaciones por Ai
    protected $cListAlready; //asignacioones booleanas

    public function __construct($id, $problema)
    {
        $this->id =$id;
        $this->problema =$problema;   
    }

    public function seTcantidadDeViolaciones($countVi){
        $this->violaciones = $countVi;
    }
    public function seTcantidadDeViolacionesDuras($timeslot, $value){
        $this->ViolacionesDuras[$timeslot] = $value;
        // this.ViolacionesDuras.set(timeslot, value);
    }
    public function SetViolaciones($timeslot , $violaciones) {
        $this->Vi[$timeslot] = $violaciones;
    }
    public function setIntViolacionesDuras($value){
        $this->intViolacionesDuras = $value;
    }
    public function setRecorrido($recorrido){
        $this->recorrido = $recorrido;
    }
    public function getAi() {
        return $Ai;
    }

    public function getVi() {
        return $Vi;
    }    
}

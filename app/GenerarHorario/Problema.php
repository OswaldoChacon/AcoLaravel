<?php
namespace App\GenerarHorario;
use App\GenerarHorario\Maestros; 
use App\GenerarHorario\Eventos; 
class Problema{
    protected $eventos;// = new ArrayList<>();
    //Arraylist de clase maestro
    protected $maestros = [];// = new ArrayList<>();
    //Arraylist entero donde se almacenan los espacios de tiempo
    protected $timeslot;// = new ArrayList<>();
    
    public function __construct($maestros, $eventos)
    {
        for($i = 0; $i<count($maestros);$i++){
            maestros[$i] = new Maestros();

        }
        for($i = 0; $i<count($eventos);$i++){

        }       
    }

}

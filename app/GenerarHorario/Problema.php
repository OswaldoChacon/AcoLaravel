<?php

namespace App\GenerarHorario;

use App\GenerarHorario\Maestros;
use App\GenerarHorario\Eventos;

class Problema
{
    protected $eventos = []; // = new ArrayList<>();
    //Arraylist de clase maestro
    protected $maestros = []; // = new ArrayList<>();
    //Arraylist entero donde se almacenan los espacios de tiempo
    protected $timeslot = []; // = new ArrayList<>();

    protected $aux_maestros = [];
    // protected $aux_timeslot_common = [];
    public function __construct($eventosConMaestros, $maestros_et)
    {
        // for($i = 0; $i<count($maestrosParticipantes);$i++){
        foreach ($maestros_et as $jurado) {
            $this->maestros[] = new Maestros($jurado->nombre, $jurado->horas);
        }
        // dd($this->maestros);
        foreach ($eventosConMaestros as $evento) {
            unset($aux_maestro);
            foreach ($this->maestros as $maestro) {
                if (in_array($maestro->nombre, $evento->maestros))
                    $aux_maestro[] = $maestro;
            }
            $this->eventos[] = new Eventos($evento->id, $evento->titulo, $aux_maestro);
        }
        // dd("hola");
        foreach ($this->eventos as $evento) {            
            // unset($aux_timeslot_common);
            $evento->setPosibleEspaciosT($this->getEspaciosEnComun($evento));
            $evento->setSizeComun(sizeof($evento->espaciosComun));
        }
    }
    public function getListMaestros()
    {
        return $this->eventos;
    }
    public function getEspaciosEnComun($evento)
    {
        // unset($this->aux_timeslot_common);
        $maestro_1 = sizeof($evento->maestroList[0]->horario);
        $maestro_2 = sizeof($evento->maestroList[1]->horario);
        $maestro_3 = sizeof($evento->maestroList[2]->horario);   
        $aux_timeslot_common = [];      
        $i = $j = $k = 0;
        while ($i < $maestro_1 && $j < $maestro_2 && $k < $maestro_3) {                      
            if ($evento->maestroList[0]->horario[$i] == $evento->maestroList[1]->horario[$j] && $evento->maestroList[1]->horario[$j] == $evento->maestroList[2]->horario[$k]) {
                $aux_timeslot_common[] = $evento->maestroList[0]->horario[$i];                
                $i++;
                $j++;
                $k++;
            }            
            else if ($evento->maestroList[0]->horario[$i] < $evento->maestroList[1]->horario[$j]) {
                $i++;
            } else if ($evento->maestroList[1]->horario[$j] < $evento->maestroList[2]->horario[$k]) {
                $j++;
            } else {
                $k++;
            }
        }        
        return $aux_timeslot_common;
    }
    public function validarExisteEspaciosEnComun(){
        foreach($this->eventos as $evento){
            if($evento->sizeComun <1){
                return false;
            }
            return true;
        }

    }
}

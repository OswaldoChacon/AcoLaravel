<?php

namespace App\GenerarHorario;

use App\GenerarHorario\Maestros;
use App\GenerarHorario\Eventos;
use Illuminate\Support\Facades\Session;

class Problema
{
    public $eventos = []; // = new ArrayList<>();
    //Arraylist de clase maestro
    public $maestros = []; // = new ArrayList<>();
    //Arraylist entero donde se almacenan los espacios de tiempo
    public $timeslots = []; // = new ArrayList<>();
    
    public $timeslotsHoras = [];    
    
    public function __construct($eventosConMaestros, $maestros_et, $espaciosDeTiempo)    
    {
        $this->timeslotsHoras = $espaciosDeTiempo;        
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
        // dd($this->eventos);
        foreach ($this->eventos as $evento) {            
            $evento->setPosibleEspaciosT($this->getEspaciosEnComun($evento));
            $evento->setSizeComun(sizeof($evento->espaciosComun));
        }
        // dd($espaciosDeTiempo);
        // foreach ($espaciosDeTiempo as $timeslots) {
            for($i= 0; $i< sizeof($espaciosDeTiempo); $i++){
            $this->timeslots[] = "$i";
        }
        // dd($this->timeslots);
        // dd("pu");
        // dd($this->timeslots);
        
        // dd($this->eventos);
        // dd("ppp");
        $this->ordenarEventos();
        if (!$this->validarExisteEspaciosEnComun()) {            
        }        
    }
    public function getListMaestros()
    {
        return $this->eventos;
    }
    public function getEspaciosEnComun($evento)
    {
        $test =array();
        // unset($this->aux_timeslot_common);
        $maestro_1 = sizeof($evento->maestroList[0]->horario);
        $maestro_2 = sizeof($evento->maestroList[1]->horario);
        $maestro_3 = sizeof($evento->maestroList[2]->horario);

        $maestro_1 = ($evento->maestroList[0]->horario);
        $maestro_2 = ($evento->maestroList[1]->horario);
        $maestro_3 = ($evento->maestroList[2]->horario);

        $aux_timeslot_common = array_intersect($maestro_1, $maestro_2,$maestro_3);        
        $aux_timeslot_common = array_values($aux_timeslot_common);       
        
        foreach($evento->maestroList as $maestros){
            $test[] = $maestros->horario;
        }
        // dd($test);
        $result = call_user_func_array('array_intersect', $test);
        $result=array_values($result);
        // dd($result);
        // return $aux_timeslot_common;
        return $result;
    }
    public function ordenarEventos()
    {     
        $flag = true;
        // $temp;
        while ($flag) {
            $flag = false;
            for ($i = 0; $i < sizeof($this->eventos) - 1; $i++) {
                // dd(sizeof($this->eventosOrdenados));
                if ($this->eventos[$i]->sizeComun > $this->eventos[$i + 1]->sizeComun) {                    
                    $temp = $this->eventos[$i];
                    $this->eventos[$i] = $this->eventos[$i + 1];
                    $this->eventos[$i + 1] = $temp;
                    $flag = true;
                }
            }
        }
    }
    public function validarExisteEspaciosEnComun()
    {
        foreach ($this->eventos as $evento) {
            if ($evento->sizeComun < 1) {
                // dd($evento);
                return false;
                // return $evento;
            }
            return true;
        }
    }
}

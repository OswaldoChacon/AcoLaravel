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
    // public $eventosOrdenados = [];

    // public $aux_maestros = [];
    // protected $aux_timeslot_common = [];
    public function __construct($eventosConMaestros, $maestros_et, $espaciosDeTiempo)    
    {
        $this->timeslotsHoras = $espaciosDeTiempo;
        // dd($this->timeslotsHoras);
        // dd($maestros_et);
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
            // dd($evento);
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
            // return response()->json([ 'hello' => '404'], 404);
            // return response()->json("espacios en comun", 422);
            // dd("l");3            
        }
        // dd($this->eventos);
        // dd($this->eventos);
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

        $maestro_1 = ($evento->maestroList[0]->horario);
        $maestro_2 = ($evento->maestroList[1]->horario);
        $maestro_3 = ($evento->maestroList[2]->horario);

        $aux_timeslot_common = array_intersect($maestro_1, $maestro_2,$maestro_3);
        $aux_timeslot_common = array_values($aux_timeslot_common);
        // dd($aux_timeslot_common);
        // if($evento->maestroList[0]->horario[0] ==  $evento->maestroList[1]->horario[0]){
        //     dd("puto");
        // }        
        // $i = $j = $k = 0;                        
        // while ($i < $maestro_1 && $j < $maestro_2 && $k < $maestro_3) {
        //     if ($evento->maestroList[0]->horario[$i] == $evento->maestroList[1]->horario[$j] && $evento->maestroList[1]->horario[$j] == $evento->maestroList[2]->horario[$k]) {                
        //         $aux_timeslot_common[] = $evento->maestroList[0]->horario[$i];
        //         $i++;
        //         $j++;
        //         $k++;
        //     } else if ($evento->maestroList[0]->horario[$i] < $evento->maestroList[1]->horario[$j]) {
        //         $i++;
        //     } else if ($evento->maestroList[1]->horario[$j] < $evento->maestroList[2]->horario[$k]) {
        //         $j++;
        //     } else {
        //         $k++;
        //     }
        // }        
        return $aux_timeslot_common;
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

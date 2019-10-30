<?php

namespace App\GenerarHorario;

use App\GenerarHorario\Problema;
use App\GenerarHorario\Ant;

class Main
{
    public $alpha; // = 1.0;
    public $beta; // = 2.0;
    public $q; // = 50.0;
    public $rho; // = 0.1; //Evaporacion    
    public $numberIteration; // = 1; //limite de iteraciones
    public $numberOfAnts; // = 1; //hormigas usadas
    public $estancado; // = 30;
    public $t_max; // = 1 / rho;        
    public $t_minDenominador; // = 5;
    public $t_min; // = t_max / t_minDenominador;        


    public $ants = []; //List<Ant> ants = new ArrayList<>(); //hormigas creadas    
    public $cList = []; //List<Integer> cList = new ArrayList<>(); //timeslots para asignar    
    public $breaks = []; //List<Integer> breaks = new ArrayList<>(); //timeslots para especificar receso
    public $eventosOrdenados = []; //List<Eventos> eventosOrdenados = new ArrayList<>();

    // Random random = new Random(); //numero random    
    public $matrizPheromoneT = array();  //matriz de asignacion de evento a Ts
    public $pheromone;
    public $Ni_et = []; //List<Double> Ni_et = new ArrayList<>();
    public $probabilidad = []; //List<Double> probabilidad = new ArrayList<>();
    public $problema; //Problema problema;
    public $eventos; //int eventos;
    public $salones; //int salones;
    public $timeslot; //int timeslot;
    public $TSCommon = []; //List<Integer> TSCommon = new ArrayList<>();
    public $recorrdio; //Double recorrido;
    public $currentLocalBest; //Ant currentLocalBest;
    public $currentGlobalBest; //Ant currentGlobalBest;
    public $bestSoFar; //Ant bestSoFar;
    public $encontroGlobal = false; //boolean encontroGlobal = false;
    public $contadorGlobal = 0; //int contadorGlobal = 0;
    public $eventosProgramados = []; //List<Eventos> eventosProgramados = new ArrayList<>();
    public $eventosProgramados2 = []; //List<Eventos> eventosProgramados2 = new ArrayList<>()



    public function __construct($eventosConMaestros, $maestros_et, $espaciosDeTiempo, $alpha, $beta, $q, $evaporation, $iterations, $ants, $estancado, $t_max, $t_minDenominador, $num_aulas)
    {
        // dd($espaciosDeTiempo);
        $problema = new Problema($eventosConMaestros, $maestros_et, $espaciosDeTiempo);
        $this->alpha = $alpha;
        $this->beta = $beta;
        $this->q = $q;
        $this->evaporation = $evaporation;
        $this->numberIteration = $iterations;
        $this->numberOfAnts = $ants;
        $this->estancado = $estancado;
        $this->t_max = $t_max;
        $this->t_minDenominador = $t_minDenominador;
        // $this->t_min = $this->t_max/$this->t_minDenominador;
        $this->salones = $num_aulas;

        //inicializarMatrices
        $this->pheromone = 0.0;
        $this->eventos = sizeof($problema->eventos);
        $this->timeslot = sizeof($problema->timeslots);
        // dd($problema->timeslots);
        $this->matrizPheromoneT = array(); //new Double[eventos][timeslot];
        $this->matrizSolucion = array(); //new String[timeslot][salones];        

        for ($i = 0; $i < $this->eventos; $i++) {
            for ($j = 0; $j < $this->timeslot; $j++) {
                $this->matrizPheromoneT[$i][$j] = $t_max;
                //System.out.print(matrizPheromoneT[i][j] + "\t");
            }
        }
        // dd($this->matrizPheromoneT);        
        for ($i = 0; $i < $this->numberOfAnts; $i++) {
            $this->ants[] = new Ant($i, $problema);
        }
        $this->cList = $problema->timeslots;
        // dd($this->cList);
        // for (int i = 0; i < ants.size(); i++) {
        foreach ($this->ants as $ant) {
            for ($j = 0; $j < sizeof($this->cList); $j++) {
                $ant->cListAlready[] = false;
                $ant->Vi[] = 0;
                $ant->ViolacionesDuras[] = 0;
            }
        }
        // dd($this->ants);
    }
    public function start()
    { 
        $currentIndex = 0;
        for ($i = 0; $i < sizeof($this->cList); $i++) {
            $this->Ni_et[] =0.0;
            //Ai.add(0.0);
            $this->probabilidad[] = 0.0;
        }
        // dd($this->probabilidad);
        for ($i = 0; $i < $this->numberIteration; $i++) {
            $this->reset();
        }
    }
    public function reset(){
        // for (int i = 0; i < ants.size(); i++) {
            foreach($this->ants as $ant){
            // $ant->Ai ();
            unset($ant->Ai);
            for ($j = 0; $j < sizeof($this->cList); $j++) {
                $ant->cListAlready[$j] = false;//.set(j, false);
            }
        }
    }
}

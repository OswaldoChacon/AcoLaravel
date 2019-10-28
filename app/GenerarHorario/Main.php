<?php
namespace App\GenerarHorario;
use App\GenerarHorario\Problema; 
class Main{
    public function __construct($maestros,$eventos)
    {
        $problema = new Problema($maestros,$eventos);
    }
    public function inicializarMatrices(){

    }
}
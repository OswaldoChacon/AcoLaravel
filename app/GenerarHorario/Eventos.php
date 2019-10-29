<?php
namespace App\GenerarHorario;
class Eventos {

protected $id;
protected $name;
//protected Maestros maestro;
public $maestroList = []; //List<Maestros> maestroList = new ArrayList<>();
public $espaciosComun = [];//List<Integer> espaciosComun = new ArrayList<>();
protected $sizeComun;//int sizeComun;
//protected int espaciosComun[];

public function __construct($id, $name, $maestroList )
{
    $this->id = $id;
    $this->name = $name;
    $this->maestroList = $maestroList;
}    

public function setMaestros($maestro) {
    $this->maestroList = $maestro;
}

public function setPosibleEspaciosT($lista) {
    $this->espaciosComun = $lista;
}
public function setSizeComun($sizeComun){
    $this->sizeComun = $sizeComun;
}

public function getSizePosiblesEspacios() {        
    return $this->sizeComun;
}

public function getIdEvento() {
    return $this->id;
}    
}

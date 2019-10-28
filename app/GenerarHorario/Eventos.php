<?php
namespace App\GenerarHorario;
class Eventos {

protected $id;
protected $name;
//protected Maestros maestro;
protected $maestroList; //List<Maestros> maestroList = new ArrayList<>();
protected $espaciosComun;//List<Integer> espaciosComun = new ArrayList<>();
protected $sizeComun;//int sizeComun;
//protected int espaciosComun[];

public function __construct($id, $name)
{
    $this->id = id;
    $this->name = name;
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

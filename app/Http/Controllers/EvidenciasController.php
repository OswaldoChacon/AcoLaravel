<?php

namespace App\Http\Controllers;

use App\Diapositiva;
use App\Hoja;
use App\Impreso;
use App\Resume;
use Illuminate\Http\Request;

class EvidenciasController extends Controller
{
    public function index()
    {
    	$hojas = Hoja::all();

    	return view('seminario.evaluaciones.index', compact('hojas'));
    }

    public function show($id)
    {
    	$hoja = Hoja::findOrFail($id);

    	return view('seminario.evaluaciones.showProject', compact('hoja'));
    }

    public function destroy($id)
    {
    	Hoja::findOrFail($id)->delete();

    	return back();
    }

    public function editSheets($id)
    {
        $hoja = Hoja::findOrFail($id);

        // $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->get()->count();

        return view('editarHojaEvaluacion.editarHoja', compact('hoja'));
    }

    public function updateSheet(Request $request, $id)
    {
        // dd($request->datos);
        // return $request->all();
        $hoja = Hoja::findOrFail($id);

        $hoja->update($request->all());

        // $hoja->impresos()->sync($request->impresos);
        // $hoja->impresos()->sync(array($request->impresos => array('evaluacion' => $request->evaluacion)));
        // $hoja->impresos()->sync([$request->impresos => ['evaluacion' => $request->evaluacion]]);
        // $hoja->impresos()->attach($request->impresos, array('evaluacion' => $request->evaluacion));
        // $hoja->impresos()->attach([$request->impresos => ['evaluacion' => $request->evaluacion]]);
        foreach ($request->datos as $key => $value) {
            //dd($value); 
            if(isset($value['impre'])){
               $hoja->impresos()->syncWithoutDetaching([$value['impre'] => ['evaluacion' => $value['evalu']]]); 
            }
           
           if(isset($value['diapo'])){
               $hoja->diapositivas()->syncWithoutDetaching([$value['diapo'] => ['evaluacion' => $value['evalu']]]);
           } 

           if(isset($value['resume'])){
               $hoja->resumes()->syncWithoutDetaching([$value['resume'] => ['evaluacion' => $value['evalu']]]);
           }
        }

        return redirect()->route('editSheets', $hoja->id);
    }

    public function editarImpreso($id)
    {
        $hoja = Hoja::findOrFail($id);
        $impresos = Impreso::with(['hojas' => function($query) use ($id) {
                    $query->where('hoja_id', $id);
        }])->get();
// dd($impresos);
        // $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->get()->count();

        return view('editarHojaEvaluacion.editarImpreso', compact('hoja', 'impresos'));
        
    }

     public function editarDiapo($id)
    {
        $hoja = Hoja::findOrFail($id);
        $diapositivas = Diapositiva::all();

        return view('editarHojaEvaluacion.editarDiapo', compact('hoja', 'diapositivas'));
    }

    public function editarResumen($id)
    {
        $hoja = Hoja::findOrFail($id);
        $resumes = Resume::all();

        return view('editarHojaEvaluacion.editarResumen', compact('hoja', 'resumes'));
    }

    public function actualizarHoja(Request $request, $id)
    {
        // dd($request);
        $hoja = Hoja::findOrFail($id);

        $hoja->update($request->all());

        return redirect()->route('sheets')->with('info', 'Calificación Actualizada Correctamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Diapositiva;
use App\Docente;
use App\Hoja;
use App\Impreso;
use App\Notificacione;
use App\ProyectoForo;
use App\Resume;
use Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class HojasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:docentes');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seminario.evaluaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hoja = Hoja::findOrFail($id);

        $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->get()->count();

        return view('seminario.evaluaciones.show', compact('hoja','notificacione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hoja = Hoja::findOrFail($id);
        $impresos = Impreso::with(['hojas' => function($query) use ($id) {
                    $query->where('hoja_id', $id);
        }])->get();
// dd($impresos);
        $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->get()->count();

        return view('seminario.evaluaciones.edit', compact('hoja', 'impresos', 'notificacione'));
        
    }

    public function editDiapo($id)
    {
        $hoja = Hoja::findOrFail($id);
        $diapositivas = Diapositiva::with(['hojas' => function($query) use ($id) {
                    $query->where('hoja_id', $id);
        }])->get();

        $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->get()->count();

        return view('seminario.evaluaciones.editDiapo', compact('hoja', 'diapositivas', 'notificacione'));
    }

    public function editResumen($id)
    {
        $hoja = Hoja::findOrFail($id);
        $resumes = Resume::with(['hojas' => function($query) use ($id) {
                    $query->where('hoja_id', $id);
        }])->get();

        $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->get()->count();

        return view('seminario.evaluaciones.editResumen', compact('hoja', 'resumes', 'notificacione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
           // if(isset($value['resume'])){
           //     $hoja->resumes()->syncWithoutDetaching($value);
           // }    
        }
        // exit();
        
        // $hoja->impresos()->attach($request->impresos , ['evaluacion' => $request->evaluacion]);
        // $hoja->impresos()->updateExistingPivot($request->impresos, 'evaluacion' => $request->evaluacion);

        return redirect()->route('evaluaciones.show', $hoja->id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateCalificacion(Request $request, $id)
    {
        // dd($request);
        $hoja = Hoja::findOrFail($id);

        $hoja->update($request->all());

        return redirect()->route('showprojects')->with('info', 'Calificación Asignada Correctamente.');
    }

    public function showAssignedProject($id)
    {
        $proyecto = ProyectoForo::findOrFail($id);

        $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->get()->count();

        return view('docentes.showAssignedProject', compact('notificacione', 'proyecto'));
    }

    public function CreateEvaluateProject(Request $request, $id)
    {
        // return $request;
        $proyecto = ProyectoForo::findOrFail($id);

        $proyecto->docentes()->detach(Auth::guard('docentes')->user()->id);

        $hoja = Hoja::create($request->all());

        // $hoja->proyectoforo()->associate($proyecto)->save();
        // $hoja->proyectosforos()->sync($proyecto);
        $hoja->proyectosforos()->attach($proyecto, ['docente_id' => Auth::guard('docentes')->user()->id]);

        return redirect()->route('evaluaciones.show', $hoja->id);
    }

    public function showEvaluation($id)
    {
        $hoja = Hoja::findOrFail($id);

        $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->get()->count();

        return view('docentes.showEvaluation', compact('notificacione', 'hoja'));
    }

    public function downloadEvaluation($id)
    {
      
        $proyecto = ProyectoForo::findOrFail($id);

        $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->get()->count();

        $pdf = PDF::loadView('docentes.showEvaluationDownload', compact('proyectos', 'notificacione'));

        return $pdf->download();
    }

    public function showAssignedProjectEvaluation($id)
    {
        $proyecto = ProyectoForo::findOrFail($id);

        $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->get()->count();

        return view('docentes.showAssignedProjectEvaluation', compact('notificacione', 'proyecto'));
    }

}












<?php

namespace App\Http\Controllers;

use App\Foro;
use App\Http\Requests\CreateSeminarioRequest;
use App\Http\Requests\UpdateSeminarioRequest;
use App\ProyectoForo;
use App\Seminario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SeminariosController extends Controller
{
    /**|
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $foros = DB::table('foros')->get();
        $seminarios = Seminario::all();
        // $foros = Foro::all();

        return view('seminario.seminarios.index', compact('seminarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $foros = DB::table('foros')->get();
        $seminarios = Seminario::all();
        // $foros = Foro::all();
        $foros = Foro::pluck('noforo', 'id');
        // $seminarios = Foro::with('seminario')->get();

       return view('seminario.seminarios.create', compact('seminarios','foros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSeminarioRequest $request)
    {
        // Guardar
        // DB::table('seminarios')->insert([
        //     "titulo" => $request->input('titulo'),
        //     "numeroSeminario" => $request->input('numeroSeminario'),
        //     "periodo" => $request->input('periodo'),
        //     "anio" => $request->input('anio'),
        //     "foro_id" => $request->input('foro_id'),
        //     "created_at" => Carbon::now(),
        //     "updated_at" => Carbon::now(),
        // ]);

        $seminario = new Seminario;
        $seminario->titulo = $request->input('titulo');
        $seminario->numeroSeminario = $request->input('numeroSeminario');
        $seminario->periodo = $request->input('periodo');
        $seminario->anio = $request->input('anio');
        $seminario->foro_id = $request->input('foro_id');
        $seminario->save();
       // Seminario::create($request->all());

        // Redireccionar
        return redirect()->route('seminarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $seminario = DB::table('seminarios')->where('id_seminario', $id)->first();
        $seminario = Seminario::findOrFail($id);

        return view('seminario.seminarios.show', compact('seminario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $seminario = DB::table('seminarios')->where('id_seminario', $id)->first();
        
        $seminario = Seminario::findOrFail($id);

        return view('seminario.seminarios.edit', compact('seminario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
         */
    public function update(UpdateSeminarioRequest $request, $id)
    {
        // Actualizamos
        // DB::table('seminarios')->where('id_seminario', $id)->update([
        //     "numeroSeminario" => $request->input('numeroSeminario'),
        //     "periodo" => $request->input('periodo'),
        //     "anio" => $request->input('anio'),
        //     "foro_id" => $request->input('foro_id'),
        //     "updated_at" => Carbon::now(),
        // ]);

        // $seminario = Seminario::findOrFail($primaryKey);
        // $seminario->update($request->all()); 
        // Seminario::findOrFail($primaryKey)->update($request->all()); 
        $seminario = Seminario::findOrFail($id);

        $seminario->update($request->all());

        return back()->with('info', 'Seminario actualizado');

        //Redireccionamos
        // return back()->with('info', 'Seminario actualizado');
        // return redirect()->route('seminarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Eliminar Seminario
        // DB::table('seminarios')->where('id_seminario', $id)->delete();
        Seminario::findOrFail($id)->delete();

        // Redireccionar
        return redirect()->route('seminarios.index');
    }

    public function projects($id)
    {   
        $proyectos = ProyectoForo::findOrFail($id)->where([
                            ['seminario_id', '=', $id], 
                            ['calificacion', '>=', 70],
                        ])
                        ->get();

        // $proyectos = DB::table('proyecto_Foros')
        //                 ->where([
        //                     ['seminario_id', '=', $id], 
        //                     ['calificacion', '>=', 70],
        //                 ])
        //                 ->get();

        return view('seminario.seminarios.projects', compact('proyectos'));
    }
}











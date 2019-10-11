<?php

namespace App\Http\Controllers;

use App\Docente;
use App\Foro;
use App\Notificacione;
use App\ProyectoForo;
use Illuminate\Http\Request;

class JuradosController extends Controller
{
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
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proyecto = ProyectoForo::findOrFail($id);

        $docentes = Docente::pluck('nombre', 'id');

        return view('seminario.jurados.edit', compact('proyecto', 'docentes'));
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
        $proyecto = ProyectoForo::findOrFail($id);

        $proyecto->update($request->all());

        $proyecto->docentes()->sync($request->docentes);

        return back();
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

    public function projects()
    {
        $foros = Foro::all();

        // $proyectos = ProyectoForo::findOrFail($id)->where([
                            // ['id_foro', '=', $id]
                        // ])
                        // ->get();

        return view('seminario.jurados.Jprojects', compact('foros'));
    }
}

<?php

namespace App\Http\Controllers\mantenimiento;

use App\Http\Controllers\Controller;
use App\Http\Controllers\mantenimiento\AsignaturaController as MantenimientoAsignaturaController;
use App\Models\Catalogo_area_asignatura;
use App\Models\Catalogo_cc_asignatura;
use App\Models\Mantenimiento\Asignatura;
use Illuminate\Http\Request;
class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //lee todos los registros
        //$Asignatura = Asignatura::all();

        $Asignatura = asignatura::join('catalogo_cc_asignatura', 'asignatura.codigo_cc', '=', 'catalogo_cc_asignatura.codigo')
        ->join('catalogo_area_asignatura', 'asignatura.codigo_area', '=', 'catalogo_area_asignatura.codigo')
        ->select('asignatura.id_asignatura','asignatura.nombre', 'asignatura.codigo', 'catalogo_cc_asignatura.descripcion as nombre_cc', 'catalogo_area_asignatura.descripcion as nombre_area')
        ->get();

        //return $Asignatura;
        return view('mantenimiento.index', compact('Asignatura'));
        //return view('mantenimiento.index')->with('Asignatura',$Asignatura);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Abrir formulario para un nuevo registro
        $catalogo_cc_asignatura = Catalogo_cc_asignatura::pluck('descripcion','codigo')->toarray();
        $catalogo_area_asignatura = Catalogo_area_asignatura::pluck('descripcion','codigo')->toarray();

        return view('mantenimiento.create', compact('catalogo_cc_asignatura','catalogo_area_asignatura'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // para guardar en la base de datos el nuevo registro
        $asignatura = Asignatura::create($request->all());
        return $asignatura;
        //return redirect()->route('mantenimiento.asignatura.edit',$asignatura);
        //return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Asignatura $asignatura)
    {
        // muestra un registro en específico.
        return view('mantenimiento.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Asignatura $asignatura)
    {
        // para abrir un formulario para edición de un registro

        return $asignatura;
        //return view('mantenimiento.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asignatura $asignatura)
    {
        // para actualizar lainformación del registro en la base de datos
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asignatura $asignatura)
    {
        // para eliminar un solo registro
    }
}

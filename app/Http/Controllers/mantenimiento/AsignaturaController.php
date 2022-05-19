<?php

namespace App\Http\Controllers\mantenimiento;

use App\Http\Controllers\Controller;
use App\Http\Controllers\mantenimiento\AsignaturaController as MantenimientoAsignaturaController;
use App\Models\Catalogo_area_asignatura;
use App\Models\Catalogo_cc_asignatura;
use App\Models\CatalogoServicioEducativo;
use App\Models\Mantenimiento\Asignatura as Asignaturas;
use App\Models\CatalogoEstatus;
use Illuminate\Http\Request;

$catalogo_cc_asignatura = array(); $catalogo_area_asignatura = array(); $catalogo_estatus = array(); $catalogo_servicio_educativo = array();

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
        
        $Asignatura = Asignaturas::join('catalogo_cc_asignatura', 'asignatura.codigo_cc', '=', 'catalogo_cc_asignatura.codigo')
        ->join('catalogo_area_asignatura', 'asignatura.codigo_area', '=', 'catalogo_area_asignatura.codigo')
        ->join('catalogo_servicio_educativo', 'asignatura.codigo_servicio_educativo', '=', 'catalogo_servicio_educativo.codigo')
        ->join('catalogo_estatus','asignatura.codigo_estatus', '=', 'catalogo_estatus.codigo')
        ->select('asignatura.id_asignatura','asignatura.nombre', 'asignatura.codigo', 'asignatura.estatus', 'catalogo_cc_asignatura.descripcion as nombre_cc', 'catalogo_area_asignatura.descripcion as nombre_area',
        'catalogo_servicio_educativo.descripcion as nombre_servicio_educativo','catalogo_estatus.descripcion as nombre_estatus')
        ->get();

       // return view('mantenimiento.index', compact('Asignatura'));
        return view('mantenimiento.asignatura.index')->with('asignatura',$Asignatura);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Abrir formulario para un nuevo registro
        global $catalogo_cc_asignatura, $catalogo_area_asignatura, $catalogo_servicio_educativo, $catalogo_estatus;

        $this->estados_asignaturas();
        
        return view('mantenimiento.asignatura.create', compact('catalogo_cc_asignatura','catalogo_area_asignatura','catalogo_servicio_educativo','catalogo_estatus'));
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
        global $catalogo_cc_asignatura, $catalogo_area_asignatura, $catalogo_servicio_educativo, $catalogo_estatus;

        $request->validate(
            ['nombre'=>'required',
            'codigo'=>'required']
        );
        $asignatura = Asignaturas::create($request->all());

        $mensaje = 'El Registro se Registro correctamente.';

        $this->estados_asignaturas();

        $asignatura = Asignaturas::latest('id')->first();
        return view('mantenimiento.asignatura.edit', compact('asignatura','catalogo_cc_asignatura','catalogo_area_asignatura','catalogo_servicio_educativo','mensaje','catalogo_estatus'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Asignaturas $asignatura)
    {
        // muestra un registro en específico.
        return view('mantenimiento.asignatura.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Asignaturas $asignatura, $id_asignatura)
    {
        // para abrir un formulario para edición de un registro
        global $catalogo_cc_asignatura, $catalogo_area_asignatura, $catalogo_servicio_educativo, $catalogo_estatus;

        $this->estados_asignaturas();
        
        $asignatura = Asignaturas::where('id_asignatura', $id_asignatura)->firstOrFail();
        return view('mantenimiento.asignatura.edit', compact('asignatura','catalogo_cc_asignatura','catalogo_area_asignatura','catalogo_servicio_educativo','catalogo_estatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asignaturas $asignatura, $id_asignatura)
    {
        // para actualizar lainformación del registro en la base de datos
        // para guardar en la base de datos el nuevo registro
        global $catalogo_cc_asignatura, $catalogo_area_asignatura, $catalogo_servicio_educativo, $catalogo_estatus;

        $request->validate(
            ['nombre'=>'required',
            'codigo'=>'required']
        );
        $asignatura = Asignaturas::where('id_asignatura', $id_asignatura)->firstOrFail();
        
        $input = $request->all();

        $asignatura->fill($input)->save();

        // para abrir un formulario para edición de un registro
        $this->estados_asignaturas();

        $mensaje = 'El Registro se actualizó correctamente.';

        return view('mantenimiento.asignatura.edit', compact('asignatura','catalogo_cc_asignatura','catalogo_area_asignatura','catalogo_servicio_educativo','mensaje','catalogo_estatus'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asignaturas $asignatura, $id_asignatura)
    {
        // para eliminar un solo registro
        $asignaturas = Asignaturas::where('id_asignatura', $id_asignatura)->firstOrFail();
        $asignaturas->delete();

        return redirect()->route('mantenimiento.asignatura.index')->with('mensaje','ok');
    }

    public function estados_asignaturas(){
        global $catalogo_cc_asignatura, $catalogo_area_asignatura, $catalogo_servicio_educativo, $catalogo_estatus;


        $catalogo_cc_asignatura = Catalogo_cc_asignatura::pluck('descripcion','codigo')->toarray();
        $catalogo_area_asignatura = Catalogo_area_asignatura::pluck('descripcion','codigo')->toarray();
        $catalogo_servicio_educativo = CatalogoServicioEducativo::pluck('descripcion','codigo')->toarray();
        $catalogo_estatus = CatalogoEstatus::pluck('descripcion','codigo')->toarray();
    }
}

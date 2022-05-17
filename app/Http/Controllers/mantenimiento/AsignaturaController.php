<?php

namespace App\Http\Controllers\mantenimiento;

use App\Http\Controllers\Controller;
use App\Http\Controllers\mantenimiento\AsignaturaController as MantenimientoAsignaturaController;
use App\Models\Catalogo_area_asignatura;
use App\Models\Catalogo_cc_asignatura;
use App\Models\CatalogoServicioEducativo;
use App\Models\Mantenimiento\Asignatura as Asignaturas;
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

        $Asignatura = Asignaturas::join('catalogo_cc_asignatura', 'asignatura.codigo_cc', '=', 'catalogo_cc_asignatura.codigo')
        ->join('catalogo_area_asignatura', 'asignatura.codigo_area', '=', 'catalogo_area_asignatura.codigo')
        ->join('catalogo_servicio_educativo', 'asignatura.codigo_servicio_educativo', '=', 'catalogo_servicio_educativo.codigo')
        ->select('asignatura.id_asignatura','asignatura.nombre', 'asignatura.codigo', 'catalogo_cc_asignatura.descripcion as nombre_cc', 'catalogo_area_asignatura.descripcion as nombre_area',
        'catalogo_servicio_educativo.descripcion as nombre_servicio_educativo')
        ->get();

       // return view('mantenimiento.index', compact('Asignatura'));
        return view('mantenimiento.index')->with('asignatura',$Asignatura);
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
        $catalogo_servicio_educativo = CatalogoServicioEducativo::pluck('descripcion','codigo')->toarray();

        return view('mantenimiento.create', compact('catalogo_cc_asignatura','catalogo_area_asignatura','catalogo_servicio_educativo'));
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
        $request->validate(
            ['nombre'=>'required',
            'codigo'=>'required']
        );
        $asignatura = Asignaturas::create($request->all());

        $catalogo_cc_asignatura = Catalogo_cc_asignatura::pluck('descripcion','codigo')->toarray();
        $catalogo_area_asignatura = Catalogo_area_asignatura::pluck('descripcion','codigo')->toarray();
        $catalogo_servicio_educativo = CatalogoServicioEducativo::pluck('descripcion','codigo')->toarray();
        $mensaje = 'El Registro se Registro correctamente.';

        return view('mantenimiento.edit', compact('asignatura','catalogo_cc_asignatura','catalogo_area_asignatura','catalogo_servicio_educativo','mensaje'));

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
        return view('mantenimiento.show');
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
        $catalogo_cc_asignatura = Catalogo_cc_asignatura::pluck('descripcion','codigo')->toarray();
        $catalogo_area_asignatura = Catalogo_area_asignatura::pluck('descripcion','codigo')->toarray();
        $catalogo_servicio_educativo = CatalogoServicioEducativo::pluck('descripcion','codigo')->toarray();

        $asignatura = Asignaturas::where('id_asignatura', $id_asignatura)->firstOrFail();
        return view('mantenimiento.edit', compact('asignatura','catalogo_cc_asignatura','catalogo_area_asignatura','catalogo_servicio_educativo'));
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
        $request->validate(
            ['nombre'=>'required',
            'codigo'=>'required']
        );
        $asignatura = Asignaturas::where('id_asignatura', $id_asignatura)->firstOrFail();
        
        $input = $request->all();

        $asignatura->fill($input)->save();

        // para abrir un formulario para edición de un registro
        $catalogo_cc_asignatura = Catalogo_cc_asignatura::pluck('descripcion','codigo')->toarray();
        $catalogo_area_asignatura = Catalogo_area_asignatura::pluck('descripcion','codigo')->toarray();
        $catalogo_servicio_educativo = CatalogoServicioEducativo::pluck('descripcion','codigo')->toarray();
        $mensaje = 'El Registro se actualizó correctamente.';

        return view('mantenimiento.edit', compact('asignatura','catalogo_cc_asignatura','catalogo_area_asignatura','catalogo_servicio_educativo','mensaje'));
        
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

        $mensaje = 'El Registro se eliminó correctamente.';
        return redirect()->route('mantenimiento.asignatura.index')->with('mensaje','El registro se eliminó correctamente.');
    }
}

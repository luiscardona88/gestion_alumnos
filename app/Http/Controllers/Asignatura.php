<?php

namespace App\Http\Controllers;

use App\Models\asignaturas_model;
use App\Models\Alumnos_model;
use App\Models\Horarios_modelo;

use Illuminate\Http\Request;

class Asignatura extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos=asignaturas_model::all();
       return json_encode($datos);
        
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
        $datos= $request->input('datos_enviar');
        
        $datos=json_decode($datos);
        $id_alumno= $datos->id_alumno;
        $alumno=Alumnos_model::find($id_alumno);


        $datos=$datos->asignatura_propiedad;
        $array_syn=array();
        foreach($datos as $d){
            array_push($array_syn,$d);
           

        }
       // return $array_syn;
        $alumno->asignaturas()->sync($array_syn);       
        return json_encode(array("resultado"=>"OK"));
       
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
        //
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
        //
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


    public function muestra_horarios(Request $request)
    {
      
        $id_asignatura=$request->id_asignatura;
        $datos=Horarios_modelo::where(["fecha_registro"=>now(),"id_asignatura"=>$id_asignatura])->get();
        return json_encode($datos);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\asignaturas_model;
use App\Models\Alumnos_model;
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
        //$datos->pluck(["nombre"]);
       //return response()->json($datos,200, [], JSON_UNESCAPED_UNICODE);

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
        /*
        return response('OK', 200)
        ->header('Content-Type', 'text/plain');
         */

        return json_encode(array("resultado"=>"OK"));
        //return back()->with("status","agregado con exito");

        //return $datos;
        //return $request->all();
        //dd(json_decode($request->getContent(), true));

        //return $request->all();
        //$datos= $request->input('data_asign');
        //$datos=json_decode($datos);
       // dd($datos[0]->asignatura_propiedad);
        //$datos=$request->json();
        
       // dd(json_decode($request->getContent(), true));

       //dd($request->input("_token"));
       //return $request->all();
       //return $request->all();
       //$name = $request->input('data_asign');
       //return $name;
       // return $request->json()->all();
       /*
       $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        dd($data);

        */
       // $datos=json_decode($request->asignar_asignatura);
       
        //dd($datos);
       
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
}

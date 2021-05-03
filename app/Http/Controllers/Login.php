<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login_model;
use App\Models\Login_modelo;

class Login extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function validaLogin(Request $request)
     {
       
        $datos= $request->input('datos_enviar');
        
        $datos=json_decode($datos);
        $nombre= $datos->username;
        $password= $datos->password;

      $data= Login_modelo::where(["nombre"=>$nombre,"password"=> $password])
                           // ->first()
                            ->count();
                           
      //echo "tu nombre es" .$data[0]->nombre;
      echo json_encode(array("existe"=>$data));

     }
    public function index()
    {
        //
        return view("Login.index");
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

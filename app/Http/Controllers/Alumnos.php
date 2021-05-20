<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumnos_model;
use App\Models\Registro_model;
use App\Http\Requests\AlumnosRequest;
use App\Models\asignaturas_model;
use App\Models\Alumnos_files_model;
use Illuminate\Support\Facades\Mail;


use DB;

class Alumnos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        DB::listen(function($query)
        {
       // echo "<code>" . $query->sql."</code/>";
        //echo "<code>" . $query->time."</code/>";
        
        });

        
     }

    public function sendMail($data=array())
    {

        
        Mail::send('emails.email', $data, function ($message) {
            $message->from('luiscardona-3f4137@inbox.mailtrap.io', 'John Doe');
            $message->sender('luiscardona-3f4137@inbox.mailtrap.io', 'John Doe');
            $message->to('luiscardona-3f4137@inbox.mailtrap.io', 'John Doe');
            $message->subject('Gracias por escribirnos');
            $message->priority(3);
        });

        dd(Mail::failures());

        if(Mail::failures())
        {
            return "Mensaje no enviado";
        }
        else
        {
            return "Mensaje enviado";
        }
    }
    public function index()
    {

        
         $datos=Alumnos_model::with(["asignaturas","files"])->get();
         $asignatura1 = new asignaturas_model();
         $asignatura1->nombre = "ItSolutionStuff.com";
         $asignatura1->fecha_registro=date("Y-m-d");

         $asignatura2 = new asignaturas_model();
         $asignatura2->nombre = "ItSolutionStuff.com 2";
         $asignatura2->fecha_registro=date("Y-m-d");

         $data=array();
         $data["title"]="datos de prueba";
         $this->sendMail($data);
         return view("Alumnos.index",["datos"=>$datos]);
    }
  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function subirFile(Request $request)
     {
       
       try
       {
        $id_alumno=$request->id_alumno;
        $path=$request->imagen->store("public");    
        Alumnos_files_model::create(["id_alumno"=> $id_alumno,"ruta_path"=>$path,"status"=>0]);
        return "Subido con exito";
       }
       catch(\Exception $ex)
       {
         echo $ex->getMessage();
       }
   

     }
     public function asignar_asignaturas()
     {
        $datos=Alumnos_model::all();
        
        return view("Alumnos.asignar_asignatura",["datos"=>$datos]);

     }
    public function create()
    {   
        return view("Alumnos.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store2(AlumnosRequest $request)

    {
        $nombre=$request->nombre;
        DB::transaction(function () use($nombre){

            Registro_model::create(["detalles"=>"index:".date("Y-m-d")]);

            Alumnos_model::create(["nombre"=> $nombre,"estatus"=>0]);
         
          });
          return back()->with("status","agregado con exito");

    }
    public function store(AlumnosRequest $request)
    {      
        Registro_model::create(["detalles"=>"index:".date("Y-m-d")]);       
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
        return view("Alumnos.show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datos=Alumnos_model::findOrfail($id);      
        return view("Alumnos.edit",["datos"=>$datos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlumnosRequest $request,Alumnos_model $alumno)
    {
        //
        $alumnos_object=Alumnos_model::findOrfail($request->id);    
         $alumnos_object->update(array("nombre"=>$request->nombre));
         echo "OK";
        
    }
    public function update2($id)
    {
        //
        echo "si";
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alumnos_object=Alumnos_model::findOrfail($id);
        $id=$alumnos_object->delete();
        echo $id;
        //
    }

    public function listar_imagenes()
    {

        $data=Alumnos_model::findOrfail(21);
        dd($data->files);
       //$data=Alumnos_files_model::find("1");
       // dd($data->alumnos());


    }
    public function image_download(PostImage $imagen)
    {
       Storage::disk("local")->download($imagen->imagen);
    }

    public function image_delete(PostImage $imagen)
    {
        $image->delete();
        Storage::disk("local")->delete($imagen->imagen);
        return back()->with("estatus","Imagen Eliminada con exito");
    }
}

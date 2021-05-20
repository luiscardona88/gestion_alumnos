<html>
<body>
    @extends('master')
    <div  id="app">


        

        <example-component> </example-component>
    <!--<button type="button" class="btn btn-success btn-sm"> NUEVO*</button>!-->
    <a href="Alumnos/create"> Nuevo</a>
    <table border="1" class="table table-bordered table-striped">
    <thead>
<th>ID </th>
<th> NOMBRE</th>
<th> </th>
<th> </th>
<th> Asignaturas</th>
<th> Documentos</th>
    </thead>
    @foreach ($datos as $item)
    <tr> 
        <td> {{$item->id}} </td>
        <td> {{$item->nombre}} </td> 
        <td> <button  onclick="eliminar({{$item->id}})" class="btn btn-danger btn-sm">Eliminar </button> </td> 
        <td> <button onclick="editar({{$item->id}})" class="btn btn-dark btn-sm text-white">Actualizar </button> </td>           
        <td> 
            @foreach ($item->asignaturas as $asign)
                {{$asign->nombre.","}}
            @endforeach       
         </td> 
         <td> 
            @foreach ($item->files as $file)
            @php           
            if($file->ruta_path!=""):
               $doc= explode("/",$file->ruta_path,);            
         endif;
        @endphp
         
            <button type="button"  onclick="modal_imagen('{{$doc[1]}}')"> file </button>
        @endforeach  
        </td>
    </tr>
  @endforeach
</table>


<div class="modal_imagen" tabindex="-1" role="dialog" id="modal_imagen" style="display: none">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">imagenes</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('subirFile')}}" enctype="multipart/form-data" class="form form-inline">
            <input type="hidden" value="id_alumno" name="id_alumno" id="id_alumno"/>
            <input type="hidden" value="{{ csrf_token() }}" name="_token"/>
           
            <iframe src="" id="frame_image" style="width:100%"> </iframe>
            </form>
        </div>
        <div class="modal-footer">    
            <button type="submit" class="btn btn-danger btn-block">Eliminar </button>      
        </div>
      </div>
    </div>
</div>

</div>
    <script>
        function modal_imagen(id)
        {
           // alert("el id es" + id);
        $("#frame_image").prop("src","http://localhost/gestion_alumnos/storage/app/public/" + id)
          $("#modal_imagen").show();
        }
        function eliminar(id)
        {
                $.ajax({url:"Alumnos/" + id,
                    method:"DELETE",
                data:{"_token":"{{ csrf_token() }}"},
            success:function(data)
            {
                if($.trim(data)>=1)
                {
                  alert("ELIMINADO CON EXITO!!");
                  window.location.reload(true);

                }
            //console.log(data);
            }

            });
        }
   function editar(id)
   {
   window.location.href="Alumnos/"+ id + "/edit";

   }
        </script>
</body>
</html>


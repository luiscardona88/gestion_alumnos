<html>
   
    <input type="hidden" name="id_alumno_temp" id="id_alumno_temp"/>
    @extends('master')
<body>
  <div id="app">
    <example-component> </example-component>
  @if (session("status"))
    <div class="alert alert-success">
          CREADO EXITOSAMENTE
    </div>
@endif
    <!--<button type="button" class="btn btn-success btn-sm"> NUEVO*</button>!-->
    <div class="modal" tabindex="-1" role="dialog" id="modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Asignaturas</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <table class="table table-bordered table-striped" id="tabla_asignaturas">
             <thead>
                 <th> </th>
                 <th>Nombre </th>
             </thead>
             <tbody>
             </tbody>
             </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="guardar_asign()">Guardar</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
    <a href="Alumnos/create"> Nuevo</a>
<table border="1" class="table table-bordered table-striped">
    <thead>
<th>ID </th>
<th> NOMBRE</th>
<th> </th>
<th> </th>
<th> </th>
    </thead>
    @foreach ($datos as $item)
    <tr> 
        <td> {{$item->id}} </td>
        <td> {{$item->nombre}} </td> 
        <td> <button  disabled  onclick="eliminar({{$item->id}})" class="btn btn-danger btn-sm">Eliminar </button> </td> 
        <td> <button  disabled onclick="editar({{$item->id}})" class="btn btn-dark btn-sm text-white">Actualizar </button> </td> 
         <td> <button  onclick="asignar_modal({{$item->id}})" class="btn btn-dark btn-sm"> Asignar Asignaturas</button> </td>     
    </tr>
  @endforeach
</table>
    <script>
     class asignar_asignatura
     {
      asignatura_propiedad="";
      array_lista=[];
      constructor(alumno_param)
      {
        this.id_alumno=alumno_param;

      }
       agrega_asignaturas(elemento)
       {

          this.array_lista.push(elemento);
          this.asignatura_propiedad= this.array_lista;
       }
      
     }

        function guardar_asign()
        {
            let id_alumno_temp=$("#id_alumno_temp").val();
            let class_asign= new asignar_asignatura(id_alumno_temp);

            $(".checks_asig").each(function(index,me)
            {
                if($(me).is(":checked")==true)
                {
                    class_asign.agrega_asignaturas($(this).val());
                }

            });
            
          //alert(JSON.stringify(class_asign));
          let datos_enviar=JSON.stringify(class_asign);
            $.ajax({
                 url:"/blog/public/Asignatura/store",
                 method:"POST",
                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                 
                 dataType: "json",
                 processData: true,
                data:{datos_enviar},
              
            })
                .done(function(data)
                {
                                 
                    if($.trim(data.resultado)=="OK")
                    {
                       
                      alert("AGREGADO CON EXITO!!!");
                      $("#modal").hide();
                      window.location.reload(true);
                    }
                      console.log(data);
                });
        }
function listar_asignaturas()
{
let row="";
    $.ajax({url:"/blog/public/Asignatura",
                    method:"GET",
                data:{"_token":"{{ csrf_token() }}"},
            success:function(data)
            {
                let object_data=JSON.parse(data);
                console.log(data);
                for(var d in object_data)
                {
                   // alert(object_data[d].nombre);
                    row+="<tr> <td><input value=" + object_data[d].id + " class='checks_asig' id='checks_asig' type='checkbox' name='lista_checks[]'/> </td><td><a href=#>"+ object_data[d].nombre + "</a></td> </tr>";
                }
              
                $("#tabla_asignaturas > tbody").append(row);
            }

            });
}
function asignar_modal(id)
{
    $("#id_alumno_temp").val(id);
    listar_asignaturas();
$("#modal").modal();
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
            }

            });
        }
   function editar(id)
   {
   window.location.href="Alumnos/"+ id + "/edit";

   }
        </script>
      </div>
</body>
</html>


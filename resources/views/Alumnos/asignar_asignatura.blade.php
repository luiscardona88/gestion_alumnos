<html>
    <input type="hidden" name="id_alumno_temp" id="id_alumno_temp"/>
    @extends('master')
<body>
  <div id="app">
    <li v-for="(item,index) in lista_asignaturas" :key="index">
      @{{ index }}
    </li>
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
             <tbody id="table_body_asign"> <!--lista_asignaturas!-->             
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

    <div class="modal" tabindex="-1" role="dialog" id="modal_upload">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Asignaturas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{route('subirFile')}}" enctype="multipart/form-data" class="form form-inline">
              <input type="hidden" value="id_alumno" name="id_alumno" id="id_alumno"/>
              <input type="hidden" value="{{ csrf_token() }}" name="_token"/>
              Subir Tarea<input type="file" name="imagen" id="imagen"/>
              <br>
              <br>
              <button type="submit" class="btn btn-success">Subir </button>
              </form>
          </div>
          <div class="modal-footer">          
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
<th> </th>
    </thead>
    @foreach ($datos as $item)
    <tr> 
        <td> {{$item->id}} </td>
        <td> {{$item->nombre}} </td> 
        <td> <button  disabled  onclick="eliminar({{$item->id}})" class="btn btn-danger btn-sm">Eliminar </button> </td> 
        <td> <button  disabled onclick="editar({{$item->id}})" class="btn btn-dark btn-sm text-white">Actualizar </button> </td> 
         <td> <button  onclick="asignar_modal({{$item->id}})" class="btn btn-dark btn-sm"> Asignar Asignaturas</button> </td>
         <td> <button  onclick="subir_file({{$item->id}})" class="btn btn-primary btn-sm"> Subir Tarea</button> </td>    
    </tr>
  @endforeach
</table>
</div>
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
                    
          let datos_enviar=JSON.stringify(class_asign);
            $.ajax({
                 url:"{{route('store_asignatura')}}",
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
}

function subir_file(id)
{
$("#modal_upload").modal();
$("#id_alumno").val(id);

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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
      <script>
      new Vue({
      el: "#app",
      data () {
    return {
      lista_asignaturas: null
    }
  },
      beforeCreate()
        {                 
        },
       created()
       {
        this.evento_asign();
       },

      methods:{
        evento_asign:function()
        {
          let row="";
          axios.get('/gestion_alumnos/public/Asignatura', {
                    params: {
                      "_token": "{{ csrf_token() }}"
                    }
                
              }).then(response => {
                this.lista_asignaturas = response.data
                console.log(this.lista_asignaturas);
                let tabla_rows="";
                for(var d in this.lista_asignaturas )
                {                
                  tabla_rows+="<tr> <td><input value=" + this.lista_asignaturas[d].id + " class='checks_asig' id='checks_asig' type='checkbox' name='lista_checks[]'/> </td><td><a href=#>"+ this.lista_asignaturas[d].nombre + "</a></td> </tr>";
                }
               
                document.getElementById("table_body_asign").innerHTML=tabla_rows;                
                }).catch(e => {
                    console.log(e)
                })                
      }
      }  
    })   
</script>
</body>
</html>


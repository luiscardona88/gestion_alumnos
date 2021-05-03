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
    </tr>
  @endforeach
</table>
</div>
    <script>
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


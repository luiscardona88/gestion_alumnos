<html>
    <head>
        @extends('master')
    </head>
<body>

<form method="POST" action="http://localhost/blog/public/Alumnos/{{$datos->id}}" id="form">
    <input type="hidden" name="id" value="{{$datos->id}}">
    {{ method_field('PUT') }}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
<table border=1 class="table table-bordered table-striped">
<tr>
<th>nombre </th>
<th>fecha_registro </th>
<th>estatus </th>
</tr>
<tbody>
    <tr>
    <td> <input type="text" name="nombre" value="{{$datos->nombre}}"></td>
    <td>    <input type="text" name="fecha_registro"  value=" {{$datos->fecha_registro}}"/> </td>
    <td>    <input type="checkbox" name="estatus"  value=" {{$datos->estatus}}"/> </td>
    </tr>
    <tfoot>
     <tr>
       <td colspan="3">
        <div class="form-group row">
           
        <div class="offset-5 col-md-6">
        <button type="submit" class="btn btn-danger" > Actualizar</button> 
    </div>
    </div>

        
    </td>
     </tr>
    </tfoot>
</tbody>
</table>
<script>
$(document).ready(function()
{



});

    </script>
<!--
<script>

function actualizar(id)
   {

alert("el id es" + id);

        $.ajax({url:"/Alumnos/1/update",
                method:"PUT",
            data:{"_token":"{{ csrf_token() }}"},
        success:function(data)
        {
        console.log(data);
        }

        })


   }
    </script>!-->


</form>
</body>

</html>


<html>
    <head>
        @extends('master')
    </head>
<body>
<div id="app">
@if (session("status"))
    <div class="alert alert-success">
          CREADO EXITOSAMENTE
    </div>
@endif
<form method="POST" action="{{route('guardar_alumnos')}}" id="form">
<!--{{ method_field('PUT') }}!-->
    <input type="hidden" name="id" value="">
 
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
<table border=1 class="table table-bordered table-striped">
<tr>
<th>nombre </th>
<th>fecha_registro </th>
<th>estatus </th>
</tr>
<tbody>
    <tr>
    <td> <input type="text" name="nombre" value=""></td>
    <td>    <input type="text" name="fecha_registro"  value=""/> </td>
    <td>    <input type="checkbox" name="estatus"  value=""/> </td>
    </tr>
    <tfoot>
     <tr>
       <td colspan="3">
        <div class="form-group row">
           
        <div class="offset-5 col-md-6">
        <button type="submit" class="btn btn-danger" > NUEVO</button> 
    </div>
    </div>
    </td>
     </tr>
    </tfoot>
</tbody>
</table>
</div>
</form>
</body>
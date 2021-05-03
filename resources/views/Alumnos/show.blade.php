<html>
    <head>
        @extends('master')
    </head>
<body>
<form method="POST" action="{{route("Alumnos.store")}}">
    @csrf
<label><strong>Nombrex: </strong> </label><input type="text" name="nombre"/>
<button type="submit" class="btn btn-danger"> Enviar</button>
</form>
</body>
</html>
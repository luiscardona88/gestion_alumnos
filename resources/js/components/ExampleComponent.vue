<template>
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Inicio</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

     <li class="nav-item active" v-for="(value, key) in lista_menu">
        <a class="nav-link"  :href="value" >{{ key }}<span class="sr-only"></span></a>
      </li>

    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
  </div>
</nav>
    </div>
</template>

<script>
    export default {
      
        beforeCreate()
        {
            fetch("http://localhost/blog/public/Menu/index/")
        .then(response=>response.json())
          .then(json=>this.lista_menu=json);        
        

        },
        mounted() 
        {
            console.log('Component mounted.')
            //alert("OK");
            console.log(this.lista_menu);
        }
        ,
        created() 
        {
                //alert("creado!!!");
                 console.log("Pruebas");
        }
    ,
      data: function () {
          return {
            lista_menu:""
        
        };
      },


    };
</script>

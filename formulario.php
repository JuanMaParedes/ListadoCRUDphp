<?php include("recupera.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos/style.css">
    <title>Desarrollo Web</title>
</head>
<body>
    <header>
        <div id="portada">
            <h2>ADMINISRTRACION DE ALUMNOS</h2>
        </div>
        
    </header>

    <main>
        <section id="formulario">
           <form id="form" action="recibe.php" method="POST">
            <input type="hidden" id="action" name="action" value="agregar" >
            <div class="campo d-none" id="campoId" >
                <p>Id:</p>
                <input type="text" value="<?= $_GET["id"]; ?>" id="id" name="id" >
                <button type="button" class="btn btn-warning">Buscar</button>
             </div>
            <div class="campo">
               <p>Nombre:</p>
               <input type="text" id="nombre" value="<?= $nombre; ?>" name="nombre">
               <p id="errorN"></p>
            </div >
            <div class="campo">
                <p>Apellido:</p>
                <input type="text" id="apellido" value="<?= $apellido; ?>" name="apellido">
                <p id="errorA"></p>
            </div>
            <div class="campo">
                <p>Edad:</p>
                <input type="number" id="edad" value="<?= $edad; ?>" name="edad">
                <p id="errorE"></p>
            </div>
            <br>
            <div id="botones">
                <button type="button" id="bGuardar" class="btn btn-primary <?php if(!isset($_GET["nuevo"])){echo "d-none";}  ?>"onclick="guardar()">Guardar</button>
                <button type="button"  class="btn btn-success <?php if( isset($_GET["nuevo"]) && ($_GET["nuevo"] == 1 )){echo "d-none";}  ?>" onclick="editar()" >Editar</button>
                <button type="button"  class="btn btn-danger <?php if( isset($_GET["nuevo"]) && ($_GET["nuevo"] == 1 )){echo "d-none";}  ?>" onclick="eliminar()" >Eliminar</button>
            </div>
            
            
        </form> 
        </section>
        
    </main>
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="./script.js"></script>
    <script>
    function pNuevo() {
        bGuardar= getElementById("bGuardar");
        bGuardar.className = "btn btn-primary";
    }

    function guardar(){
            let control=validar();
            console.log(control);
            if(control){
              swal({
                    title:"Agregar a la lista",
                    text: "El Alumno se agrego a la lista",
                    icon: "success",
                    time: "3s",
              
                  })
                 setTimeout(()=>{
                    form.submit();
                  }, 3000);
            } 
            
        } 

    

    function editar(){
        let form= document.getElementById("form");
        let nombre= document.getElementById("nombre").value;
        let apellido= document.getElementById("apellido").value;
        let edad= document.getElementById("edad").value;
        document.getElementById("action").value= "editar";
        swal({
            title:"Editar Alumno",
            text: "¿Esta seguro que quiere editar al alumno?",
            icon: "warning",
            buttons:["No","Si"]
      
          }).then((respuesta)=>{
            if(respuesta){
            swal({text: 'El Alumno a sido editado con exito',
              icon:'success'})
              setTimeout(()=>{
                form.submit();
                  }, 3000);
              
            }
          });
        
        
    }
    function eliminar(){
        document.getElementById("action").value= "eliminar";
        swal({
            title:"Eliminar Alumno",
            text: "¿Esta seguro que quiere eliminar al alumno?",
            icon: "warning",
            buttons:["No","Si"]
      
          }).then((respuesta)=>{
            if(respuesta){
            swal({text: 'El Alumno a sido eliminado con exito',
              icon:'success'})
              setTimeout(()=>{
                form.submit();
                  }, 3000);
              
            }
          });
    }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
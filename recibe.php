<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos/recibe.css">
    <title>Document</title>
</head>
<body>
    <header class="bg-info" style="width: 100%; text-align: center;">
        <h3>Listado de Alumnos</h3>
    </header>
    <table >
        <td></td>
        <td class="bg-secondary rounded-bottom "><h5>Nombre</h5></td>
        <td class="bg-secondary rounded-bottom"><h5>Apellido</h5></td>
        <td class="bg-secondary rounded-bottom"><h5>Edad</h5></td>
    

   
</body>

</html>
<?php
include("accion.php");

/* var_dump($_SERVER); */
/* if( isset($_GET["nombre"]) && isset($_GET["apellido"]) && isset($_GET["edad"])){
    
    
}else{
    echo "No se encontro alguna variable";
} */
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    echo "correcto ";
}
$action= $_POST["action"] ;

$nombre= $_POST["nombre"] ; 
$apellido= $_POST["apellido"] ; 
$edad= $_POST["edad"];

$id= $_POST["id"];

/* if ( (trim($nombre) =="") ||  (trim($apellido) == "") ||  ($edad == "")){
    echo "No se permiten campos vacios";
}else{
    if ((strlen($nombre)< 5) || (strlen($nombre)>40) || (strlen($apellido)< 5) || (strlen($apellido)>40) || !(is_numeric($edad)) ){
        echo "Nombre y Apellido deben ser mayor a 5 caracteres y a 40 caracteres";
    }else{
        echo "Lo ingresado fue: ".$nombre." ".$apellido." ".$edad;
        $cant= strlen($nombre);
        echo "<p>nombre tiene: ".$cant." letras</p>";
    }
    
} */

function validarTexto($cadenaStr){
    $value= false;
    if ( trim($cadenaStr) ==""){
        echo "No se permiten campos vacios";
    }else{
        if ((strlen($cadenaStr)< 3) || (strlen($cadenaStr)>40)){
            echo "Nombre y Apellido deben ser entre 3 y 40 caracteres";
        }else{
            $value=true;
        }
    }
    return $value;

}

function validarNumero($numero){
    $value=false;
    if(is_numeric($numero)){
        $value= true;
    }
    return $value;
        
}


function agregar($nombre,$apellido,$edad, $conn){
    if ((validarTexto($nombre)) && (validarTexto($apellido) && (validarNumero($edad)))){
        /* $servername= "localhost";
        $usename= "root";
        $password=""; */
    
        try {
           // $conn = new PDO("mysql:host=$servername;dbname=practicaDesarrollo", $usename,$password);
            
    
            $stmt= $conn->prepare("INSERT INTO persona (nombre,apellido,edad) VALUES (?,?,?)");
            $stmt->bindParam(1, $nombre);
            $stmt->bindParam(2, $apellido);
            $stmt->bindParam(3, $edad);
            //execute
            $stmt->execute();

    
        } catch (PDOException $e) {
            echo "Coneccion fallida: " .$e->getMessage();
    
        }
        echo "Conexion Realizada";        
    
    }

}

function editar($id, $nomb,$ape, $eda, $conn){
    if ((validarTexto($nomb)) && (validarTexto($ape) && (validarNumero($eda)))){
        /* echo "Lo ingresado fue: ".$nombre." ".$apellido." ".$edad; */
       /*  $servername= "localhost";
        $usename= "root";
        $password=""; */
    
        try {
           // $conn = new PDO("mysql:host=$servername;dbname=practicaDesarrollo", $usename,$password);
            
            $stmt= $conn->prepare("UPDATE persona SET nombre=?,apellido=?,edad=? WHERE id=$id");
        
            $stmt->bindParam(1, $nomb);
            $stmt->bindParam(2, $ape);
            $stmt->bindParam(3, $eda);
            //execute
            $stmt->execute();
            
    
            
            // $stmt;
          
    
        } catch (PDOException $e) {
            echo "Coneccion fallida: " .$e->getMessage();
    
        }
                
    
    }

}
function eliminar($id,$conn){
    /* $servername= "localhost";
    $usename= "root";
    $password=""; */
    
    try {
        //$conn = new PDO("mysql:host=$servername;dbname=practicaDesarrollo", $usename,$password);
        echo ("DELETE FROM `persona` WHERE `persona`.`id` = $id");
        $stmt= $conn->prepare("DELETE FROM `persona` WHERE `persona`.`id` = $id");
         
        //execute
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Coneccion fallida: " .$e->getMessage();

    }
    echo "Conexion Realizada"; 
            
}

function listado($conn){
    /* $servername= "localhost";
    $usename= "root";
    $password=""; */
    
    try {
        //$conn = new PDO("mysql:host=$servername;dbname=practicaDesarrollo", $usename,$password);
        $stmt= $conn->prepare("SELECT * FROM `persona`");
         
        //execute
        $stmt->execute();
        $array=$stmt->fetchAll(PDO::FETCH_NUM);
       // echo "<table>";
        for ($i=0; $i < count($array) ; $i++) {
            echo "<tr>";
            for ($j=0; $j<count($array[$i]); $j++) { 
                if($j==0){
                    echo "<td><a href='formulario.php?id=".$array[$i][$j]."'><button type='button' id='bGuardar' class='btn btn-primary'>Ver</button></a></td>";
                    }
                if($j==1){
                    echo "<td>".$array[$i][$j]."</td>";
                    }
                if($j==2){
                    echo "<td>".$array[$i][$j]."</td>";
                    }
                if($j==3){
                    echo "<td>".$array[$i][$j]."</td>";
                    }
                  
                
            }
            echo "</tr>";
            
            } 
            echo "</table>";
            echo "<a href='formulario.php?nuevo=1'><button type='button' class='btn btn-success'>Nuevo</button></a>";
    } catch (PDOException $e) {
        echo "Coneccion fallida: " .$e->getMessage();

    }
    /* echo "Conexion Realizada";  */
}

switch ($action) {
    case 'agregar':  
        agregar($nombre,$apellido,$edad,$conn);
        header("location: index.html");
        
        break;
    case 'editar':
         editar($id,$nombre,$apellido,$edad,$conn);
         header("location: index.html");       
        break;
    case 'eliminar':
        eliminar($id,$conn);
        header("location: index.html");  
        break;
    case 'listado':
        listado($conn);
        break;
    
    default:
        # code...
        break;
}






?>
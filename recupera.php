<?php
$servername= "localhost";
$usename= "root";
$password="";
$nombre="";
$apellido="";
$edad=0;    
try {
    $conn = new PDO("mysql:host=$servername;dbname=practicaDesarrollo", $usename,$password);
    if (isset($_GET["id"])){
        $id= $_GET["id"];
        $stmt= $conn->prepare("SELECT nombre, apellido, edad FROM `persona` WHERE id=$id");
        $stmt->execute();
         $array=$stmt->fetchAll(PDO::FETCH_ASSOC);

       
        for ($i=0; $i < count($array) ; $i++) { 
             $nombre=$array[0]["nombre"];
              
       
            $apellido=$array[0]["apellido"];
              
          
            $edad=$array[0]["edad"];
        
        }
    
    }
   
   
   

        
    //execute
    
} catch (PDOException $e) {
    echo "Coneccion fallida: " .$e->getMessage();

}






?>
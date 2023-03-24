function validar(){
    let nombre= document.getElementById("nombre").value;
    let apellido= document.getElementById("apellido").value;
    let edad= document.getElementById("edad").value;
    var errN= document.getElementById("errorN");
    var errA= document.getElementById("errorA");
    var errE= document.getElementById("errorE");

    var control= false;
    console.log("Hola");
    if ((nombre.trim().length > 25) || (nombre.trim().length < 3 )){
        console.log("Nombre debe ser mayor a 3 y menor a 40 caracteres");
        errN.innerHTML= "El nombre debe ser mayor 3 y menor a 40 caracteres";
        errN.style.color="#Ff0000";
        control= false;
    }else{
        errN.innerHTML="";
        if ((apellido.trim().length > 25) || (apellido.trim().length <  3)){
            console.log("Apellido debe ser mayor 3 y menor a 40 caracteres");
            errA.innerHTML= "El apellido debe ser mayor 3 y menor a 40 caracteres";
            errA.style.color="#Ff0000";
            control= false;
        }else{
            errA.innerHTML="";
            if (isNaN(edad)){
                console.log("Edad debe ser un numero");
                errE.innerHTML= "Edad debe ser un valor numerico";
                errE.style.color="#Ff0000";
                control= false;
            }else{
               control=true;
            
                }
        }
        
    }
    return control;

}

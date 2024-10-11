let email = document.getElementById("email")
let tipoDocumento = document.getElementById("tipoDocumento")
let numeroDocumento = document.getElementById("numeroDocumento")
let centro = document.getElementById("centro")
let nombre = document.getElementById("nombre")
let apellidos = document.getElementById("apellidos")
let telefono = document.getElementById("telefono")
let localidad = document.getElementById("localidad")
let sexo = document.getElementById("sexo")
let fnacimiento = document.getElementById("fnacimiento")
let estudios = document.getElementById("estudios")
let slaboral = document.getElementById("slaboral")
let comoconocido = document.getElementById("comoconocido")
let rminima_si = document.getElementById("rminima_si")
let rminima_no = document.getElementById("rminima_no")
let botelin = document.getElementById("boletin")
let consentimineto = document.getElementById("consentimiento")
let boton = document.getElementById("boton")
let formulario=document.getElementById("formulario")





nombre.addEventListener("input" ,()=>{
    nombre.value=nombre.value.replace("1","")
    nombre.value=nombre.value.replace("2","")
    nombre.value=nombre.value.replace("3","")
    nombre.value=nombre.value.replace("4","")
    nombre.value=nombre.value.replace("5","")
    nombre.value=nombre.value.replace("6","")
    nombre.value=nombre.value.replace("7","")
    nombre.value=nombre.value.replace("8","")
    nombre.value=nombre.value.replace("9","")
    nombre.value=nombre.value.replace("0","")
    nombre.value=nombre.value.replace("/","")
    nombre.value=nombre.value.replace("_","")
    nombre.value=nombre.value.replace("%","")
    nombre.value=nombre.value.replace("!","")
    nombre.value=nombre.value.replace("$","")
    nombre.value=nombre.value.replace("@","")
    nombre.value=nombre.value.replace("#","")
    nombre.value=nombre.value.replace("  "," ")
})

apellidos.addEventListener("input",()=>{
    apellidos.value=apellidos.value.replace("1","")
    apellidos.value=apellidos.value.replace("2","")
    apellidos.value=apellidos.value.replace("3","")
    apellidos.value=apellidos.value.replace("4","")
    apellidos.value=apellidos.value.replace("5","")
    apellidos.value=apellidos.value.replace("6","")
    apellidos.value=apellidos.value.replace("7","")
    apellidos.value=apellidos.value.replace("8","")
    apellidos.value=apellidos.value.replace("9","")
    apellidos.value=apellidos.value.replace("0","")
    apellidos.value=apellidos.value.replace("/","")
    apellidos.value=apellidos.value.replace("_","")
    apellidos.value=apellidos.value.replace("%","")
    apellidos.value=apellidos.value.replace("!","")
    apellidos.value=apellidos.value.replace("$","")
    apellidos.value=apellidos.value.replace("@","")
    apellidos.value=apellidos.value.replace("#","")
    apellidos.value=apellidos.value.replace("  "," ")
})

//tratar los datos y limpiar los caracteres antes de ser enviado a la base de datos



function corregirTexto(input) {

    
        input.value=input.value.replace("á", "a")
        input.value=input.value.replace("é", "e")
        input.value=input.value.replace("í", "i")
        input.value=input.value.replace("ó", "o")
        input.value=input.value.replace("ú", "u")
        input.value=input.value.replace("à", "a")
        input.value=input.value.replace("è", "e")
        input.value=input.value.replace("ì", "i")
        input.value=input.value.replace("ò", "o")
        input.value=input.value.replace("ù", "u")
        input.value=input.value.replace("ü", "u")
        input.value=input.value.replace("'", " ")
        input.value=input.value.replace("Ç", "c")
        input.value=input.value.replace("â", "a")
        input.value=input.value.replace("ê", "e")
        input.value=input.value.replace("î", "i")
        input.value=input.value.replace("ô", "o")
        input.value=input.value.replace("û", "u")
        input.value=input.value.replace("Á", "A")
        input.value=input.value.replace("É", "E")
        input.value=input.value.replace("Í", "I")
        input.value=input.value.replace("Ó", "O")
        input.value=input.value.replace("Ú", "U")
        input.value=input.value.replace("À", "A")
        input.value=input.value.replace("È", "E")
        input.value=input.value.replace("Ì", "I")
        input.value=input.value.replace("Ò", "O")
        input.value=input.value.replace("Ù", "U")   
        input.value=input.value.replace("Ü", "U")
        input.value=input.value.replace("Â", "a")
        input.value=input.value.replace("Ê", "e")
        input.value=input.value.replace("Î", "i")
        input.value=input.value.replace("Ô", "O")
        input.value=input.value.replace("Û", "u")
        input.value=input.value.replace("ñ", "n")
        input.value=input.value.replace("Ñ", "N")
}

//mensaje de error

let errorEmail=document.getElementById("error-email")
let errorNumeroDocumento=document.getElementById("numdoc-error")
let errorTel=document.getElementById("tel-error")
let errorTipoDocumento=document.getElementById("errorTipoDocumento");

//AQUI VAMOS A VALIDAR TODOS LOS DATOS EN TIEMPO REAL, MIENTRAS EL USUARIO LOS ESTE INGRESANDO CON UN EVENTI TIPO INPUT

let regTexto= /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{3,}\.[a-zA-Z]{2,6}$/ //para regular el email
let regNumDoc= /^[0-9TRWAGMYFPDXBNJZSQVHLCKEtrwagmyfpdxbnjzsqvhlcke]{9} $/

email.addEventListener("change",()=>{ 

    if(regTexto.test(email.value)){
        errorEmail.textContent="";
        errorEmail.style.display="none";
    }
    else{
        errorEmail.style.display="block"
        errorEmail.textContent="Correo Inválido";
    }

})

numeroDocumento.addEventListener("change", ()=>{
 let cantidad= numeroDocumento.value
 
  
    if(cantidad.length == 9){

        errorNumeroDocumento.textContent="";
        errorNumeroDocumento.style.display="none";
    }else{
        errorNumeroDocumento.style.display="block"
        errorNumeroDocumento.textContent="Documento Inválido";

    }

    if(numeroDocumento.value == numeroDocumento.value.toLowerCase()){
        numeroDocumento.value=numeroDocumento.value.toUpperCase();
    }
})


//este evento es para no dejar escribir texto al usuario en el campo telefono
telefono.addEventListener("input", ()=>{
    telefono.value=telefono.value.replace(/[^0-9]/g,"")
})


telefono.addEventListener("change", ()=>{

    if(telefono.value.length == 9 && (telefono.value[0] == 9 ||  telefono.value[0] == 8 ||  telefono.value[0] == 7 ||  telefono.value[0] == 6) ){

        errorTel.textContent="";
        errorTel.style.display="none";
    }else{
        errorTel.style.display="block";
        errorTel.textContent="Telefono Inválido"
    }

})


// boton.addEventListener("click", ()=>{


// //avisa EMAIL vacio
//     if(email.value == ""){
//         errorEmail.style.display="block"
//         errorEmail.textContent="Ingrese Email"
//     }else{
//         errorEmail.style.display="none"
//         errorEmail.textContent=""
//     }
// //avisa TIPO DOCUMENTO vacio
//     if(tipoDocumento.value !== ""){
//         errorTipoDocumento.style.display="block";
//         errorTipoDocumento.textContent="Seleccione un documento válido";
//     }else{
//         errorTipoDocumento.style.display="none";
//         errorTipoDocumento.textContent="";
//     }
// //avisa NUMERO DOCUMENTO vacio
//     if(numeroDocumento.value == ""){
//         errorNumeroDocumento.style.display="block";
//         errorNumeroDocumento.textContent="Ingrese un documento válido";
//     }else{
//         errorNumeroDocumento.style.display="none";
//         errorNumeroDocumento.textContent="";
//     }
  
// })
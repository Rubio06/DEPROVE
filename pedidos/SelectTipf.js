const tipfGuardar = () => {
    let tipf = document.getElementById("tipificacion").value;
    let t = tipificacion.value;

    document.getElementById("prueba").disabled = false;
    document.getElementById("prueba").selectedIndex = 0;
    document.getElementById("prueba1").style.display = "none";
    document.getElementById("prueba2").style.display = "none";
    document.getElementById("prueba3").style.display = "none";
    document.getElementById("prueba4").style.display = "none";
    document.getElementById("prueba5").style.display = "none";


    switch (t) {
        case "":
            document.getElementById("prueba0").innerHTML = "";
            document.getElementById("prueba").disabled = true;
            break;
        case "CONTACTO EFECTIVO":
            document.getElementById("prueba0").innerHTML = "VENTA";
            document.getElementById("prueba1").innerHTML = "NO INTERESADO";
            document.getElementById("prueba2").innerHTML = "VOLVER A LLAMAR";
            document.getElementById("prueba3").innerHTML = "NO CALIFICA";
            document.getElementById("prueba4").innerHTML = "NO LLAMAR";
            document.getElementById("prueba5").innerHTML = "PROVINCIA";
            document.getElementById("prueba1").style.display = "block";
            document.getElementById("prueba2").style.display = "block";
            document.getElementById("prueba3").style.display = "block";
            document.getElementById("prueba4").style.display = "block";
            document.getElementById("prueba5").style.display = "block";
            break;
        case "CONTACTO NO EFECTIVO":
            document.getElementById("prueba0").innerHTML = "NUMERO EQUIVOCADO";
            document.getElementById("prueba1").innerHTML =
                "USUARIO CONTESTA, NO ES EL TITULAR";
            document.getElementById("prueba2").innerHTML = "TITULAR FALLECIDO";
            document.getElementById("prueba3").innerHTML = "SU LINEA ES COORPORATIVA";
            document.getElementById("prueba1").style.display = "block";
            document.getElementById("prueba2").style.display = "block";
            document.getElementById("prueba3").style.display = "block";
            break;
        case "NO CONTACTO":
            document.getElementById("prueba0").innerHTML = "NO CONTESTA";
            document.getElementById("prueba1").innerHTML = "NUMERO NO EXISTE";
            document.getElementById("prueba2").innerHTML = "BUZON DE VOZ";
            document.getElementById("prueba3").innerHTML =
                "LINEA SUPENDIDA / BLOQUEADA";
            document.getElementById("prueba4").innerHTML = "NUMERO OCUPADO";
            document.getElementById("prueba5").innerHTML = "CLIENTE RECHAZA LLAMADA";
            document.getElementById("prueba1").style.display = "block";
            document.getElementById("prueba2").style.display = "block";
            document.getElementById("prueba3").style.display = "block";
            document.getElementById("prueba4").style.display = "block";
            document.getElementById("prueba5").style.display = "block";
            break;
            // case "INFORMATIVO":
            //document.getElementById("prueba0").innerHTML = "SEGUIMIENTO";
            //break;
    }
    tipif();
    // document.getElementById('prueba').innerHTML=`${t}`;
};

//function to reset select

const resetSelect = () => {
    document.getElementById("tipificacion").selectedIndex = 0;
    document.getElementById("prueba").selectedIndex = 0;
    document.getElementById("prueba0").innerHTML = "";
    document.getElementById("prueba1").style.display = "none";
    document.getElementById("prueba2").style.display = "none";
    document.getElementById("prueba3").style.display = "none";
    document.getElementById("prueba4").style.display = "none";
    document.getElementById("prueba5").style.display = "none";
};
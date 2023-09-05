dataTra = new FormData();

const recoger = () => {
    dataTra = new FormData();
    dataTra.append("nombre", document.getElementById("nombre").value);
    dataTra.append("apellido", document.getElementById("apellido").value);
    dataTra.append("dni", document.getElementById("dniDoc").value);
    dataTra.append("telf", document.getElementById("telefono").value);
    dataTra.append("estado_civil", document.getElementById("estadoCivil").value);
    dataTra.append("email", document.getElementById("email").value);
    dataTra.append("direccion", document.getElementById("direccion").value);
    dataTra.append("banco", document.getElementById("banco").value);
    dataTra.append("fecha_naci", document.getElementById("fechaNacimiento").value);
    dataTra.append("numero_cuenta", document.getElementById("nroCuenta").value);
    dataTra.append("cci_cuenta", document.getElementById("nroCCI").value);
    dataTra.append("afp_onp", document.getElementById("afpOnp").value);
    dataTra.append("reclutadora", document.getElementById("reclutadora").value);
    dataTra.append("idsede", document.getElementById("sede").value);
    dataTra.append("idarea", document.getElementById("area").value);
    dataTra.append("idcargo", document.getElementById("cargo").value);
}

const limpiar = () => {
    document.getElementById("nombre").value = "";
    document.getElementById("apellido").value = "";
    document.getElementById("telefono").value = "";
    document.getElementById("email").value = "";
    document.getElementById("direccion").value = "";
    document.getElementById("fechaNacimiento").value = "";
    document.getElementById("nroCuenta").value = "";
    document.getElementById("nroCCI").value = "";
}


const Grabar = () => {
    recoger();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
            if(this.response=="encontrado"){
                alerta.mal("Esta persona ya está en la empresa");
            }
            else if(this.response=="nada"){
                alerta.mal("error");
            }
            else if(this.response=="falta"){
                alerta.mal("Llene su nombre, apellido, dni, y su telefono");
            }
            else if(this.response=="1"){
                window.close();
                setTimeout(() => {
                    alerta.bien("Postulacion correcta");
                    limpiar();
                }, 1000)
            }
            else{
                alerta.mal("ocurrio un error");
            }
        }
    };
    xmlhttp.open("POST", "./subirtra.php", true);
    dataTra.append("op", "SubirDatos");
    xmlhttp.send(dataTra);
}
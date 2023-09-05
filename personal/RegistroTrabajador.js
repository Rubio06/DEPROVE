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
    dataTra.append("cuota_ojt", document.getElementById("cuotap").value);
    dataTra.append("fecha_c", document.getElementById("fechaLimiteOJT").value);
    dataTra.append("reclutadora", document.getElementById("reclutadora").value);
    dataTra.append("capacitador", document.getElementById("capacitador").value);
    dataTra.append("campaña", document.getElementById("campaña").value);
    dataTra.append("jefe", document.getElementById("coordinador").value);
    dataTra.append("empresa", document.getElementById("empresa").value);
    dataTra.append("estado", document.getElementById("estado").value);
    dataTra.append("modalidad", document.getElementById("modalidad").value);
    dataTra.append("turno", document.getElementById("turno").value);
    dataTra.append("fecha_in", document.getElementById("fechaInicioPlanilla").value);
    dataTra.append("fecha_ojt", document.getElementById("fechaInicioOJT").value);
    dataTra.append("fecha_capa", document.getElementById("fechaInicioCapacitacion").value);
    dataTra.append("CUSPP", document.getElementById("CUSPP").value);
    dataTra.append("Sueldo", document.getElementById("sueldo").value);
    dataTra.append("hora_ingre", document.getElementById("hora_ingre").value);
    dataTra.append("fecha_cese_op", document.getElementById("fechaCese").value);
    dataTra.append("fecha_cese_pla", document.getElementById("fechaCesePla").value);
    dataTra.append("fecha_VD", document.getElementById("fechaInicioVacaciones").value);
    dataTra.append("fecha_VH", document.getElementById("fechaFinVacaciones").value);
    dataTra.append("fecha_DESD", document.getElementById("fechaInicioDescMed").value);
    dataTra.append("fecha_DESH", document.getElementById("fechaFinDescMed").value);
    dataTra.append("motivo_cese", document.getElementById("nota").value);
    dataTra.append("idsede", document.getElementById("sede").value);
    dataTra.append("idarea", document.getElementById("area").value);
    dataTra.append("idcargo", document.getElementById("cargo").value);
}

const limpiar = () => {
    document.getElementById("nombre").value = "";
    document.getElementById("apellido").value = "";
    document.getElementById("telefono").value = "";
    document.getElementById("estadoCivil").value = "";
    document.getElementById("email").value = "";
    document.getElementById("direccion").value = "";
    document.getElementById("banco").value = "";
    document.getElementById("fechaNacimiento").value = "";
    document.getElementById("nroCuenta").value = "";
    document.getElementById("nroCCI").value = "";
    document.getElementById("afpOnp").value = "";
    document.getElementById("cuota").value = "";
    document.getElementById("cuotap").value = "";
    document.getElementById("fecha_cuota").value = "";
    document.getElementById("reclutadora").value = "";
    document.getElementById("capacitador").value = "";
    document.getElementById("campaña").value = "";
    document.getElementById("coordinador").value = "";
    document.getElementById("empresa").value = "";
    document.getElementById("estado").value = "";
    document.getElementById("modalidad").value = "";
    document.getElementById("turno").value = "";
    document.getElementById("fechaInicioPlanilla").value = "";
    document.getElementById("fechaInicioOJT").value = "";
    document.getElementById("fechaInicioCapacitacion").value = "";
    document.getElementById("CUSPP").value = "";
    document.getElementById("sueldo").value = "";
    document.getElementById("hora_ingre").value = "";
    document.getElementById("fechaCese").value = "";
    document.getElementById("fechaCesePla").value = "";
    document.getElementById("fechaInicioVacaciones").value = "";
    document.getElementById("fechaFinVacaciones").value = "";
    document.getElementById("fechaInicioDescMed").value = "";
    document.getElementById("fechaFinDescMed").value = "";
    document.getElementById("nota").value = "";
}


const Grabar = () => {
    recoger();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
            window.close();
            setTimeout(() => {
                alerta.bien("Se guardo el trabajador");
                limpiar();
            }, 1000)
        }
    };

    console.log()
    xmlhttp.open("POST", "./subirtra.php", true);
    dataTra.append("op", "SubirDatos");
    xmlhttp.send(dataTra);
}
const Editar = () => {
    recoger();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
            window.close();
        }
    };
    xmlhttp.open("POST", "./subirtra.php", true);
    dataTra.append("op", "editarDatos");
    dataTra.append("id", idaeditar);
    xmlhttp.send(dataTra);
}
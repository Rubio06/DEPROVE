
dataTra = new FormData();
const recoger = () => {
    dataTra = new FormData();
        dataTra.append("serie",document.getElementById("serie").value);
        dataTra.append("razon",document.getElementById("razon").value);
        dataTra.append("rucdev",document.getElementById("rucdev").value);
        dataTra.append("direccion",document.getElementById("direccion").value);
        dataTra.append("distrito",document.getElementById("distrito").value);
        dataTra.append("pais",document.getElementById("pais").value);
        dataTra.append("departamento",document.getElementById("departamento").value);
        dataTra.append("ciudad",document.getElementById("ciudad").value);
        dataTra.append("nom_locacion",document.getElementById("nom_locacion").value);
        dataTra.append("direc_locacion",document.getElementById("direc_locacion").value);
        dataTra.append("numero",document.getElementById("numero").value);
        dataTra.append("numero2",document.getElementById("numero2").value);
        dataTra.append("numero3",document.getElementById("numero3").value);
        dataTra.append("persona",document.getElementById("persona").value);
        dataTra.append("num_auto",document.getElementById("num_auto").value);
        dataTra.append("num_reg",document.getElementById("num_reg").value);
        dataTra.append("anulacion",document.getElementById("anulacion").value);
        dataTra.append("compras",document.getElementById("compras").value);
        dataTra.append("caja",document.getElementById("caja").value);
        dataTra.append("descuentos",document.getElementById("descuentos").value);
        dataTra.append("host",document.getElementById("host").value);
        dataTra.append("correo",document.getElementById("correo").value);
        dataTra.append("contraseña",document.getElementById("contraseña").value);
        dataTra.append("boleta",document.getElementById("boleta").value);
        dataTra.append("factura",document.getElementById("factura").value);
        dataTra.append("ticket",document.getElementById("ticket").value);
        dataTra.append("credito",document.getElementById("credito").value);
        dataTra.append("debito",document.getElementById("debito").value);
        dataTra.append("tu",document.getElementById("tu").value);
        dataTra.append("tipo",document.getElementById("tipo").value);

}
const limpiar = () => {
    document.getElementById("serie").value="";
    document.getElementById("razon").value="";
    document.getElementById("rucdev").value="";
    document.getElementById("direccion").value="";
    document.getElementById("distrito").value="";
    document.getElementById("pais").value="";
    document.getElementById("departamento").value="";
    document.getElementById("ciudad").value="";
    document.getElementById("nom_locacion").value="";
    document.getElementById("direc_locacion").value="";
    document.getElementById("numero").value="";
    document.getElementById("numero2").value="";
    document.getElementById("numero3").value="";
    document.getElementById("persona").value="";
    document.getElementById("num_auto").value="";
    document.getElementById("num_reg").value="";
    document.getElementById("anulacion").value="";
    document.getElementById("compras").value="";
    document.getElementById("caja").value="";
    document.getElementById("descuentos").value="";
    document.getElementById("host").value="";
    document.getElementById("correo").value="";
    document.getElementById("contraseña").value="";
    document.getElementById("boleta").value="";
    document.getElementById("factura").value="";
    document.getElementById("ticket").value="";
    document.getElementById("credito").value="";
    document.getElementById("debito").value="";
    document.getElementById("tu").value="";
   

}
const GrabarLoca = () => {
    recoger();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
            // window.close();
            setTimeout(() => {
                alerta.bien("Se guardo serie");
                bajarKo();
                document.getElementById('miModal').style.display ="none";
                limpiar();
            }, 1000)
        }
    };

    console.log()
    xmlhttp.open("POST", "../../subirtra.php", true);
    dataTra.append("op", "SubirLoca");
    xmlhttp.send(dataTra);
}
const bajarKo = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tbTec").innerHTML=this.response;
        }
    };
    xmlhttp.open("POST", "../../subirtra.php", true);
    dataTra.append("op", "BajarKo");
    xmlhttp.send(dataTra);
}
window.onload=bajarKo();


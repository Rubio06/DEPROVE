dataTra = new FormData();
const recoger = () => {
    dataTra = new FormData();
        dataTra.append("plan",document.getElementById("plan").value);
        dataTra.append("pesoVenta",document.getElementById("pesoVenta").value);
        dataTra.append("pesoVentaTienda",document.getElementById("pesoVentaTienda").value);
        dataTra.append("mes",document.getElementById("mes").value);

}
const limpiar = () => {
    document.getElementById("plan").value="";
    document.getElementById("pesoVenta").value="";
    document.getElementById("pesoVentaTienda").value="";
    document.getElementById("mes").value=mesActu;
}
const Grabar = () => {
    recoger();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alerta.bien("Se guardo Peso de venta");
            bajarPeso();
            document.getElementById('miModal').style.display ="none";
            limpiar();
        }
    };
    xmlhttp.open("POST", "../../subirtra.php", true);
    dataTra.append("op", "SubirPeso");
    xmlhttp.send(dataTra);
}
const bajarPeso = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tbPeso").innerHTML=this.response;
        }
    };
    xmlhttp.open("POST", "../../subirtra.php", true);
    dataTra.append("op", "BajarPeso");
    xmlhttp.send(dataTra);
}
window.onload=bajarPeso();
// const Editar = () => {
//     recoger();
//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             window.close();
//         }
//     };
//     xmlhttp.open("POST", "./subirtra.php", true);
//     dataTra.append("op", "editarDatos");
//     dataTra.append("id", idaeditar);
//     xmlhttp.send(dataTra);
// }
// const eliminar = () => {

//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             console.log(this.response);
//         }
//     };
//     xmlhttp.open("POST", "./subirtra.php", true);
//     data = new FormData();
//     sql = "DELETE FROM trabajador WHERE id='003515227'"
//     data.append("query", sql)
//     xmlhttp.send(data); 
// }



dataTra = new FormData();
const recoger = () => {
    dataTra = new FormData();
        dataTra.append("plan",document.getElementById("plan").value);
        dataTra.append("tecnica",document.getElementById("tecnica").value);
        dataTra.append("Tfechadesde",document.getElementById("Tfechadesde").value);
        dataTra.append("Tfechahasta",document.getElementById("Tfechahasta").value);

}
const limpiar = () => {
    document.getElementById("plan").value="";
    document.getElementById("tecnica").value="";
    document.getElementById("Tfechadesde").value="";
    document.getElementById("Tfechahasta").value="";
}
const GrabarTec = () => {
    recoger();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
            // window.close();
            setTimeout(() => {
                alerta.bien("Se guardo tecnica");
                bajarTec();
                document.getElementById('miModal').style.display ="none";
                limpiar();
            }, 1000)
        }
    };

    console.log()
    xmlhttp.open("POST", "../../subirtra.php", true);
    dataTra.append("op", "SubirTec");
    xmlhttp.send(dataTra);
}
const bajarTec = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tbTec").innerHTML=this.response;
        }
    };
    xmlhttp.open("POST", "../../subirtra.php", true);
    dataTra.append("op", "BajarTec");
    xmlhttp.send(dataTra);
}
window.onload=bajarTec();


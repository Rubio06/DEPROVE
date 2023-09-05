
dataTra = new FormData();
const recoger = () => {
    dataTra = new FormData();
        dataTra.append("plan",document.getElementById("plan").value);
        dataTra.append("promocion",document.getElementById("promocion").value);
        dataTra.append("Pfechadesde",document.getElementById("Pfechadesde").value);
        dataTra.append("Pfechahasta",document.getElementById("Pfechahasta").value);

}
const limpiar = () => {
    document.getElementById("plan").value="";
    document.getElementById("promocion").value="";
    document.getElementById("Pfechadesde").value="";
    document.getElementById("Pfechahasta").value="";
}
const GrabarPro = () => {
    recoger();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
            // window.close();
            setTimeout(() => {
                alerta.bien("Se guardo Promocion");
                bajarPro();
                document.getElementById('miModal').style.display ="none";
                limpiar();
            }, 1000)
        }
    };

    console.log()
    xmlhttp.open("POST", "../../subirtra.php", true);
    dataTra.append("op", "SubirPro");
    xmlhttp.send(dataTra);
}
const bajarPro = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tbPro").innerHTML=this.response;
        }
    };
    xmlhttp.open("POST", "../../subirtra.php", true);
    dataTra.append("op", "BajarPro");
    xmlhttp.send(dataTra);
}
window.onload=bajarPro();


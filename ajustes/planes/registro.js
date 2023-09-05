
dataTra = new FormData();
const recoger = () => {
    dataTra = new FormData();
        dataTra.append("Pventa",document.getElementById("Pventa").value);
        dataTra.append("Ptipo",document.getElementById("Ptipo").value);
        dataTra.append("Pcategoria",document.getElementById("Pcategoria").value);
        dataTra.append("plan",document.getElementById("plan").value);
        dataTra.append("habi-desa",document.getElementById("habi-desa").checked);   
}

const limpiar = () => {
    document.getElementById('Pventa').value="";
    document.getElementById('Ptipo').value="";
    document.getElementById('Pcategoria').value="";
    document.getElementById('plan').value="";
    document.getElementById('habi-desa').value="";
}

const botonPlane = () => {
    recoger();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
            // window.close();
            setTimeout(() => {
                alerta.bien("Se guardo los Planes");
                bajarData();
                document.getElementById('miModal').style.display ="none";
                limpiar();
            }, 1000)
        }
    };
    console.log()
    xmlhttp.open("POST", "../subirtra.php", true);
    dataTra.append("op", "SubirDatos");
    xmlhttp.send(dataTra);
}
const bajarData = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tbPlan").innerHTML=this.response;
        }
    };
    xmlhttp.open("POST", "../subirtra.php", true);
    dataTra.append("op", "BajarDatos");
    xmlhttp.send(dataTra);
}
const subirTipoPlan = () => {
    Nuevo=prompt("Ingrese nombre del tipo:");
    if(Nuevo==null || Nuevo ==""){
        return;
    }
    if(confirm("¿Desea subir '"+Nuevo+"'")){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("Ptipo").innerHTML=this.response;
            }
        };
        xmlhttp.open("POST", "../subirtra.php", true);
        dataTra.append("op", "SubirTipoPlan");
        dataTra.append("Nuevo", Nuevo);
        xmlhttp.send(dataTra);
    }
}
const BajarTipoPlan = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("Ptipo").innerHTML=this.response;
        }
    };
    xmlhttp.open("POST", "../subirtra.php", true);
    dataTra.append("op", "BajarTipoPlan");
    xmlhttp.send(dataTra);
}
window.onload=bajarData();

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


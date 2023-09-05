// modal cargo
let modal = document.getElementById('miModal');
let flex = document.getElementById('flex');
let abrir = document.getElementById('Rcargo');
let cerrar = document.getElementById('close');
let modificaCuota = 0;

abrir.addEventListener('click', function() {
    modal.style.display = 'block';
});

cerrar.addEventListener('click', function() {
    modal.style.display = 'none';
});

window.addEventListener('click', function(e) {
    if (e.target == flex) {
        modal.style.display = 'none';
    }
});


// modal sede
let modalse = document.getElementById('miModalse');
let flexse = document.getElementById('flexse');
let abrirse = document.getElementById('Rsede');
let cerrarse = document.getElementById('closese');

abrirse.addEventListener('click', function() {
    modalse.style.display = 'block';
});

cerrarse.addEventListener('click', function() {
    modalse.style.display = 'none';
});

window.addEventListener('click', function(e) {
    if (e.target == flex) {
        modalse.style.display = 'none';
    }
});


// modal area
let modalarea = document.getElementById('miModalarea');
let flexarea = document.getElementById('flexarea');
let abrirarea = document.getElementById('Rarea');
let cerrararea = document.getElementById('closearea');

abrirarea.addEventListener('click', function() {
    modalarea.style.display = 'block';
});

cerrararea.addEventListener('click', function() {
    modalarea.style.display = 'none';
});

window.addEventListener('click', function(e) {
    if (e.target == flex) {
        modalarea.style.display = 'none';
    }
});


//modal banco

// modal area
let modalban = document.getElementById('miModalban');
let flexban = document.getElementById('flexban');
let abrirban = document.getElementById('Rban');
let cerrarban = document.getElementById('closeban');

abrirban.addEventListener('click', function() {
    modalban.style.display = 'block';
});

cerrarban.addEventListener('click', function() {
    modalban.style.display = 'none';
});

window.addEventListener('click', function(e) {
    if (e.target == flex) {
        modalban.style.display = 'none';
    }
});


// modal reclutamiento
let modalreclu = document.getElementById('miModalreclu');
let flexreclu = document.getElementById('flexreclu');
let abrirreclu = document.getElementById('Rreclu');
let cerrarreclu = document.getElementById('closereclu');

abrirreclu.addEventListener('click', function() {
    modalreclu.style.display = 'block';
});

cerrarreclu.addEventListener('click', function() {
    modalreclu.style.display = 'none';
});

window.addEventListener('click', function(e) {
    if (e.target == flex) {
        modalreclu.style.display = 'none';
    }
});


const bajarCuota = () => {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                modificaCuota = 0;
                document.getElementById("cuotaModificar").value = "Personalizar";
                document.getElementById("cuota").disabled = true;
                document.getElementById("cuota").value = this.response;
            }
        };
        xmlhttp.open("POST", "./subirtra.php", true);
        data = new FormData();
        data.append("car", document.getElementById("modalidad").value);
        data.append("fecha", document.getElementById("fecha_cuota").value);
        data.append("op", "bajarCuota");
        xmlhttp.send(data);
    }
    //CARGO REGISTRO
const ListarCuotas = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("listaCuotas").innerHTML = this.response;
        }
    };
    xmlhttp.open("POST", "./subirtra.php", true);
    data = new FormData();

    data.append("dni", document.getElementById("dniDoc").value)
    data.append("op", "ListarCuotas")
    xmlhttp.send(data);
}

const botonCargo = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.response != "") {
                console.log(this.response);
                document.getElementById("cargo").innerHTML = this.response;
                document.getElementById("IngreCargo").value = "";
                modal.style.display = 'none';
            } else {
                alertify.alert("No funciona");
            }
        }
    };
    xmlhttp.open("POST", "./subirtra.php", true);
    data = new FormData();
    data.append("car", document.getElementById("IngreCargo").value)
    data.append("op", "subircargo")
    xmlhttp.send(data);
}



//SEDE REGISTRO
const botonSede = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.response != "") {
                console.log(this.response);
                document.getElementById("sede").innerHTML = this.response;
                document.getElementById("IngreSede").value = "";
                modalse.style.display = 'none';
            } else {
                alert("No funciona");
            }
        }
    };
    xmlhttp.open("POST", "./subirtra.php", true);
    data = new FormData();
    data.append("sed", document.getElementById("IngreSede").value)
    data.append("op", "subirsede")
    xmlhttp.send(data);
}


// AREA REGISTRO
const botonArea = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.response != "") {
                console.log(this.response);
                document.getElementById("area").innerHTML = this.response;
                document.getElementById("IngreArea").value = "";
                modalarea.style.display = 'none';
            } else {
                alert("No funciona");
            }
        }
    };
    xmlhttp.open("POST", "./subirtra.php", true);
    data = new FormData();

    data.append("ar", document.getElementById("IngreArea").value)
    data.append("op", "subirarea")
    xmlhttp.send(data);
}


// RECLUTAMIENTO REGISTRO
const botonReclu = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.response != "") {
                console.log(this.response);
                document.getElementById("campaña").innerHTML = this.response;
                document.getElementById("IngreReclu").value = "";
                modalreclu.style.display = 'none';
            } else {
                alert("No funciona");
            }
        }
    };
    xmlhttp.open("POST", "./subirtra.php", true);
    data = new FormData();

    data.append("reclu", document.getElementById("IngreReclu").value)
    data.append("op", "subirreclu")
    xmlhttp.send(data);
}


// BANCO REGISTRO
const botonBan = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.response != "") {
                console.log(this.response);
                document.getElementById("banco").innerHTML = this.response;
                document.getElementById("IngreBanco").value = "";
                modalban.style.display = 'none';
            } else {
                alert("No funciona");
            }
        }
    };
    xmlhttp.open("POST", "./subirtra.php", true);
    data = new FormData();

    data.append("ba", document.getElementById("IngreBanco").value)
    data.append("op", "subirbanco")
    xmlhttp.send(data);
}

const DesactivarPla = () => {
    document.getElementById("tabla").style.display = "none";
}
const ActivarPla = () => {
    document.getElementById("tabla").style.display = "block";
}





document.getElementById("cuotaModificar").addEventListener("click", function(e) {
    if (document.getElementById("cuota").disabled) {
        document.getElementById("cuota").disabled = false;
        document.getElementById("cuotaModificar").value = "Dar defecto";
    } else {
        document.getElementById("cuota").disabled = true;
        document.getElementById("cuotaModificar").value = "Personalizar";
    }
    modificaCuota = 1;
});
document.getElementById("btnCuota").addEventListener("click", function(e) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.response == "bien" || this.response == "editado") {
                alerta.bien("Se subio la cuota")
                modificaCuota = 0;
                document.getElementById("cuota").disabled = true;
                document.getElementById("cuotaModificar").value = "Personalizar";
                ListarCuotas();
                bajarCuota();
            } else {
                console.log(this.response);
            }
        }
    };
    xmlhttp.open("POST", "./subirtra.php", true);
    data = new FormData();
    data.append("dni", document.getElementById("dniDoc").value);
    data.append("fecha", document.getElementById("fecha_cuota").value);
    data.append("cantidad", document.getElementById("cuota").value);
    data.append("edita", modificaCuota);
    data.append("op", "subirCuota");
    xmlhttp.send(data);
});

document.getElementById("fecha_cuota").addEventListener("change", bajarCuota());
document.getElementById("modalidad").addEventListener("change", bajarCuota());
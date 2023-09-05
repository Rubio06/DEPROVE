// ALMACEN

let modal = document.getElementById('miModal');
let flex = document.getElementById('flex');
let abrir = document.getElementById('almacen');
let cerrar = document.getElementById('close');

abrir.addEventListener('click', function() {
    modal.style.display = 'block';
});

cerrar.addEventListener('click', function() {
    modal.style.display = 'none';
});

//   AFILIACION

let modalAfili = document.getElementById('miModalAfili');
let flexAfili = document.getElementById('flexAfili');
let abrirAfili = document.getElementById('afiliacion');
let cerrarAfili = document.getElementById('closeAfili');

abrirAfili.addEventListener('click', function() {
    modalAfili.style.display = 'block';
});

cerrarAfili.addEventListener('click', function() {
    modalAfili.style.display = 'none';
});

//   VALIDACION
let modalVali = document.getElementById('miModalVali');
let flexVali = document.getElementById('flexVali');
let abrirVali = document.getElementById('validacion');
let cerrarVali = document.getElementById('closeVali');

abrirVali.addEventListener('click', function() {
    modalVali.style.display = 'block';
});

cerrarVali.addEventListener('click', function() {
    modalVali.style.display = 'none';
});

//   DESPACHO
let modalDes = document.getElementById('miModalDes');
let flexDes = document.getElementById('flexDes');
let abrirDes = document.getElementById('despacho');
let cerrarDes = document.getElementById('closeDes');

abrirDes.addEventListener('click', function() {
    modalDes.style.display = 'block';
});

cerrarDes.addEventListener('click', function() {
    modalDes.style.display = 'none';
});



//   ACTIVACION
let modalActi = document.getElementById('miModalActi');
let flexActi = document.getElementById('flexActi');
let abrirActi = document.getElementById('activacion');
let cerrarActi = document.getElementById('closeActi');

abrirActi.addEventListener('click', function() {
    modalActi.style.display = 'block';
});

cerrarActi.addEventListener('click', function() {
    modalActi.style.display = 'none';
});

//   HFC

let modalHfc = document.getElementById('miModalHfc');
let flexHfc = document.getElementById('flexHfc');
let abrirHfc = document.getElementById('ValidadorHFC');
let cerrarHfc = document.getElementById('closeHfc');

abrirHfc.addEventListener('click', function() {
    modalHfc.style.display = 'block';
});

cerrarHfc.addEventListener('click', function() {
    modalHfc.style.display = 'none';
});

//   llamar

let modalLLa = document.getElementById('miModalLLa');
let flexLLa = document.getElementById('flexLLa');
let abrirLLa = document.getElementById('llamar');
let cerrarLLa = document.getElementById('closeLLa');

abrirLLa.addEventListener('click', function() {
    modalLLa.style.display = 'block';
    setTimeout(()=>{
        document.getElementsByClassName('contenido-modalLLa')[0].style.width="90%";
        document.getElementsByClassName('contenido-modalLLa')[0].style.height="80%";
        document.getElementsByClassName('contenido-modalLLa')[0].style.translate="0";
    },100);
    setTimeout(()=>{
        document.getElementsByClassName('contenido-modalLLa')[0].children[0].style="height: 120px;";
        document.getElementsByClassName('contenido-modalLLa')[0].children[1].style.display="";
    },700)
    document.children[0].style.overflow = "hidden";
});
cerrarLLa.addEventListener('click', function() {
    setTimeout(()=>{modalLLa.style.display = 'none';},900)
    setTimeout(()=>{
        document.getElementsByClassName('contenido-modalLLa')[0].children[0].style.contentVisibility="hidden";
        document.getElementsByClassName('contenido-modalLLa')[0].children[1].style.display="none";
    },200)
    document.getElementsByClassName('contenido-modalLLa')[0].style="";
    document.children[0].style.overflow = "";
});

//Reclamo
let modalRe = document.getElementById('miModalRe');
let flexRe = document.getElementById('flexRe');
let abrirRe = document.getElementById('reclamo');
let cerrarRe = document.getElementById('closeRe');

abrirRe.addEventListener('click', function() {
    modalRe.style.display = 'block';
});
cerrarRe.addEventListener('click', function() {
    modalRe.style.display = 'none';
});



// ------------------CLIENTE-------------------
let modalCli = document.getElementById('miModalCli');
let flexCli = document.getElementById('flexCli');
let abrirCli = document.getElementById('ingresoCliente');
let cerrarCli = document.getElementById('closeCli');

// abrirCli.addEventListener('click', function() {
//     modalCli.style.display = 'block';
// });
cerrarCli.addEventListener('click', function() {
    modalCli.style.display = 'none';
    document.getElementById("mostratNatural").style.display = 'none';
    document.getElementById("mostrarRazon").style.display = 'none';
    document.getElementById("mRazon").checked = false;
    document.getElementById("mostrarNatural").checked = false;
    limpiarNatural();
    limpiarRazon();
    
});

// --------------Mostrar Perfiles de Cliente-----------

const mostrarNatural = ()=>{

document.getElementById("mostratNatural").style = "display: block;display:flex; flex-direction: column; justify-content: space-around;height:100%;"
document.getElementById("mostrarRazon").style.display = 'none';

}
const mRazon = ()=>{
    document.getElementById("mostrarRazon").style = "display: block;display:flex; flex-direction: column; justify-content: space-around;height:100%;"

    document.getElementById("mostratNatural").style.display = 'none'  

}

// Registro tipi almacen

const botonAlmacen = () => {
    let tipialmacen = document.getElementById('ingTipfAlmacen').value.toLocaleUpperCase('en-US');

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
            modal.style.display = 'none';
            document.getElementById("tipfAlmacen").innerHTML = this.response;
        }
    };
    xmlhttp.open("POST", "./tipificacion/", true);
    data = new FormData();
    data.append("tipificacion", tipialmacen)
    data.append("tabla", "tipialmacen")
    xmlhttp.send(data);

    document.getElementById('ingTipfAlmacen').value = "";

}

//REGISTRO TIPI 

const botonAfili = () => {
    let tipiafilicacion = document.getElementById('ingTipAfili').value.toLocaleUpperCase('en-US');

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
            modalAfili.style.display = 'none';
            document.getElementById("tipfAfilicion").innerHTML = this.response;
        }
    };

    xmlhttp.open("POST", "./tipificacion/", true);
    data = new FormData();
    data.append("tipificacion", tipiafilicacion)
    data.append("tabla", "tipiafilicacion")
    xmlhttp.send(data);

    document.getElementById('ingTipAfili').value = "";
}


const botonVali = () => {
    let tipivalidacion = document.getElementById('ingTipVali').value.toLocaleUpperCase('en-US');

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
            modalVali.style.display = 'none';
            document.getElementById("tipfValidacion").innerHTML = this.response;
          
        }
    };

    xmlhttp.open("POST", "./tipificacion/", true);
    data = new FormData();
    data.append("tipificacion", tipivalidacion)
    data.append("tabla", "tipivalidacion")
    xmlhttp.send(data);
    document.getElementById('ingTipVali').value = "";

}

const botonDes = () => {
    let tipidespacho = document.getElementById('ingTipDes').value.toLocaleUpperCase('en-US');

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
            modalDes.style.display = 'none';
            document.getElementById("tipfDesapacho").innerHTML = this.response;
        }
    };
    xmlhttp.open("POST", "./tipificacion/", true);
    data = new FormData();
    data.append("tipificacion", tipidespacho)
    data.append("tabla", "tipidespacho")
    xmlhttp.send(data); 
    document.getElementById('ingTipDes').value = "";

}

const botonActi = () => {

    let tipiactivacion = document.getElementById('ingTipActi').value.toLocaleUpperCase('en-US');

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
            modalActi.style.display = 'none';
            document.getElementById("tipfActivacion").innerHTML = this.response;
        }
    };
    xmlhttp.open("POST", "./tipificacion/", true);
    data = new FormData();
    data.append("tipificacion", tipiactivacion)
    data.append("tabla", "tipiactivacion")
    xmlhttp.send(data); 
    document.getElementById('ingTipActi').value = "";

}

const botonHfc = () => {
    let tipihfc = document.getElementById('ingTipHfc').value.toLocaleUpperCase('en-US');
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
            modalHfc.style.display = 'none';
            document.getElementById("tipfValidadorHFC").innerHTML = this.response;

        }
    };
    xmlhttp.open("POST", "./tipificacion/", true);
    data = new FormData();
    data.append("tipificacion", tipihfc)
    data.append("tabla", "tipihfc")
    xmlhttp.send(data); 
    document.getElementById('tipihfc').value = "";

}

const botonReclamo = () =>{

    let reclamo = document.getElementById('ingReclamo').value.toLocaleUpperCase('en-US');

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
            modalRe.style.display = 'none';
            document.getElementById("tipfReclamo").innerHTML = this.response;
     
        }
    };
 
    xmlhttp.open("POST", "./tipificacion/", true);
    data = new FormData();
    data.append("tipificacion", reclamo)
    data.append("tabla", "reclamo")
    xmlhttp.send(data); 
    document.getElementById('ingReclamo').value = "";
}
// -----INGRESAR CLIENTE-----------
dataTra = new FormData();
const recogerNatural = () => {
    dataTra = new FormData();
        dataTra.append("mostrarNatural",document.getElementById("mostrarNatural").value);
        dataTra.append("ingreso_dni",document.getElementById("ingreso_dni").value);
        dataTra.append("ingreso_Nombre",document.getElementById("ingreso_Nombre").value);
        dataTra.append("ingreso_Apellido",document.getElementById("ingreso_Apellido").value);
        dataTra.append("ingreso_Correo",document.getElementById("ingreso_Correo").value);
     

}
const botonCliente = () =>{
    recogerNatural()
    var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        console.log(this.response);
        // window.close();
        setTimeout(() => {
            modalCli.style.display = 'none';
            limpiarNatural();
        }, 1000)
    }
};
console.log()
xmlhttp.open("POST", "subirtra.php", true);
dataTra.append("op", "SubirNatural");
xmlhttp.send(dataTra);
}
const limpiarNatural = () => {
    document.getElementById('ingreso_dni').value="";
    document.getElementById('ingreso_Nombre').value="";
    document.getElementById('ingreso_Apellido').value="";
    document.getElementById('ingreso_Correo').value="";    
}
const recogerRazon =() => {
    dataTra = new FormData();
    dataTra.append("mRazon",document.getElementById("mRazon").value);
    dataTra.append("ingresa_RUC",document.getElementById("ingresa_RUC").value);
    dataTra.append("Ingresa_Razon",document.getElementById("Ingresa_Razon").value);
    dataTra.append("Razon_correo",document.getElementById("Razon_correo").value);
    dataTra.append("Razon_Distrito",document.getElementById("Razon_Distrito").value);
    dataTra.append("Razon_direc",document.getElementById("Razon_direc").value);
}
const botonRazon = () =>{
recogerRazon()
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        console.log(this.response);
        // window.close();
        setTimeout(() => {
            modalCli.style.display = 'none';
            limpiarRazon();
        }, 1000)
    }
};
console.log()
xmlhttp.open("POST", "subirtra.php", true);
dataTra.append("op", "SubirRazon");
xmlhttp.send(dataTra);
}
const limpiarRazon =() =>{
document.getElementById("ingresa_RUC").value="";
document.getElementById("Ingresa_Razon").value="";
document.getElementById("Razon_correo").value="";
document.getElementById("Razon_Distrito").value="";
document.getElementById("Razon_direc").value="";
}	






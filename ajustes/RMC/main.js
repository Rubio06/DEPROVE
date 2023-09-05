let modal = document.getElementById('miModalre');
let flex = document.getElementById('flexre');
let abrir = document.getElementById('registro');
let cerrar = document.getElementById('closere');
let op = "insertar";

abrir.addEventListener('click', function() {
    modal.style.display = 'block';
});

cerrar.addEventListener('click', function() {
    modal.style.display = 'none';
});

const subirbotonCuota=()=>{
var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.response=="editar"){
                if(confirm("¿Desea editar las cuotas de  fecha?")){
                    op="editar";
                    subirbotonCuota();
                }
            }
            else if(this.response=="existe"){
                op="insertar";
                alerta.mal("Ya existe este registro");
            }
            else if(this.response=="1" || this.response=="111"){
                op="insertar";
                alerta.bien("Guardado");
            }
            else{
                alerta.mal("Ocurrio un error");
                console.log(this.response);
            }
        }
    };
    xmlhttp.open("POST", "./insertar.php",true);
    data = new FormData();
    data.append("fecha",document.getElementById("Fecha").value);
    data.append("par",document.getElementById("Par").value);
    data.append("mini",document.getElementById("Mini").value);
    data.append("full",document.getElementById("Full").value);
    data.append("op",op);
    xmlhttp.send(data);
}

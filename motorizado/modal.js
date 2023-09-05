idaEditar=0;
const abrirModal =(id)=>{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.response!="" || this.response!=null){
                document.getElementById("modal").style.display="block";
                document.getElementById("blur").style="height:100%;width:100%";
                try {
                    data=JSON.parse(this.response);
                    document.getElementById("conte-sub").innerHTML = data[0];
                    idaEditar=id;
                    if(data[1]==""){
                        document.getElementById("EmpresaAMostrar").innerHTML = "No hay empresa";
                    }
                    else{
                        document.getElementById("EmpresaAMostrar").innerHTML = data[1];
                    }
                    
                } catch (error) {
                    console.log(error)
                }
            }
            else{
                console.log("mal");
                idaEditar=0;
            }
        }
    };
    xmlhttp.open("POST","./buscar.php",true);
    data= new FormData();
    data.append("id",id)
    xmlhttp.send(data);
}
const CerrarModal = () =>{
    document.getElementById("modal").style.display="";
    document.getElementById("blur").style="";
    document.getElementById("info").value="";
    document.getElementById("info").style="background-color:white;height:40px;";
    idaEditar=0;
}
document.getElementById("btn_estado").addEventListener("click",() =>{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
            if(this.response!="" || this.response!=null){
                console.log("bien");
                Actualizar();
                CerrarModal();
            }
            else{
                console.log("mal");
            }
        }
    };
    xmlhttp.open("POST","./buscar.php",true);
    data= new FormData();
    data.append("info",document.getElementById("info").value)
    data.append("id",idaEditar)
    xmlhttp.send(data)}
);
const Actualizar = () =>{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("cuerpotabla").innerHTML=(this.response);
        }
    };
    xmlhttp.open("POST","./buscar.php",true);
    data= new FormData();
    data.append("actualizar","")
    xmlhttp.send(data)
}
window.onload = Actualizar();
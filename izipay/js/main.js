// function Guardar() {
//     //Variables que proviene del formulario de insertar.php
//     var serie = $('#serie').val();
//     var numero = $('#numero').val();
//     var empresa = $('#empresa').val();
//     var fechaemision = $('#fechaemision').val();
//     var nombredni = $('#nombredni').val();
//     var codigoficha = $('#codigoficha').val();
//     var clienters = $('#clienters').val();


//     var rucdni = $('#rucdni').val();
//     var direccion = $('#direccion').val();
//     var codigounico = $('#codigounico').val();

//     var textproducto = $('#textproducto').val();
//     // var contadoefectivo = $('#contadoefectivo').val();
//     if (document.getElementById('contadoefectivo').checked) {
//         contadoefectivo = "CONTADO";
//     } else {
//         if (document.getElementById('rbdcontado2').checked) {
//             contadoefectivo = "CREDITO";
//         } else {
//             contadoefectivo = "";
//         }
//     }

//     if (document.getElementById('rbdias1').checked) {
//         dias = "30 DIAS";
//     } else {
//         if (document.getElementById('rbdias2').checked) {
//             dias = "60 DIAS";
//         } else {
//             dias = "";
//         }
//     }


//     if (document.getElementById('rbpagotarjeta').checked) {
//         pago = "TARJETA";
//     } else if (document.getElementById('rbpagoefectivo').checked) {
//         pago = "EFECTIVO";
//     } else if (document.getElementById('rbpagoizipay').checked) {
//         pago = "IZIPAY";

//     } else {
//         pago = "";

//     }
//     $.get("grabarbd.php", {
//         // empresa:empresa,
//         serie: serie,
//         numero: numero,
//         empresa: empresa,
//         fechaemision: fechaemision,
//         nombredni: nombredni,
//         codigoficha: codigoficha,
//         clienters: clienters,
//         rucdni: rucdni,
//         codigounico: codigounico,
//         direccion: direccion,
//         textproducto: textproducto,
//         contadoefectivo: contadoefectivo,
//         dias: dias,
//         pago: pago
//     });

seleccionado=0;
const Guardar = () =>{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("contetabla").innerHTML=(this.response);
            document.getElementById("contetabla").scrollTop=1500;
            // Typical action to be performed when the document is ready:
            // document.getElementById("demo").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("POST", "./grabarbd.php", true);
    data = new FormData();
    if(document.getElementsByName("dias")[0].checked){
        dias="30";
    }
    else{
        dias="60";
    }
    if(document.getElementsByName("contado")[0].checked){
        contadoefectivo="CONTADO";
    }
    else{
        contadoefectivo="CREDITO";
    }
    if(document.getElementsByName("pagos")[0].checked){
        pago="TARJETA";
    }
    else if(document.getElementsByName("pagos")[1].checked){
        pago="EFECTIVO";
    }
    else{
        pago="IZIPAY";
    }
    data.append("serie", document.getElementById("serie").value);
    data.append("numero", document.getElementById("numero").value);
    data.append("empresa", document.getElementById("empresa").value);
    data.append("fechaemision", document.getElementById("fechaemision").value);
    data.append("nombredni", document.getElementById("nombredni").value);
    data.append("codigoficha", document.getElementById("codigoficha").value);
    data.append("clienters", document.getElementById("clienters").value);
    data.append("rucdni", document.getElementById("rucdni").value);
    data.append("codigounico", document.getElementById("codigounico").value);
    data.append("direccion", document.getElementById("direccion").value);
    data.append("textproducto", document.getElementById("textproducto").value);
    data.append("estado", document.getElementById("estado").value);

    data.append("contadoefectivo", contadoefectivo);
    data.append("dias", dias);
    data.append("pago", pago);
    xhttp.send(data);

    
    document.getElementById("serie").value = "";
    document.getElementById("numero").value = "";
    document.getElementById("empresa").value = "";
    document.getElementById("fechaemision").value = "";
    document.getElementById("nombredni").value = "";
    document.getElementById("codigoficha").value = "";
    document.getElementById("clienters").value = "";
    document.getElementById("rucdni").value = "";
    document.getElementById("codigounico").value = "";
    document.getElementById("direccion").value = "";
    document.getElementById("textproducto").value = "";
    document.getElementById("contadoefectivo").value = "";
    document.getElementById("dias").value = "";
    document.getElementById("pago").value = "";
    
}

const sacarDataOption = () => {
    if(document.getElementById("codigoficha").children.length==0){
        document.getElementById("clienters").innerHTML = "";
        document.getElementById("rucdni").innerHTML = "";
        document.getElementById("direccion").innerHTML = "";
        document.getElementById("empresa").innerHTML = "";


    }
    else{
        data=JSON.parse(document.getElementById("codigoficha").value);
        document.getElementById("rucdni").value=data[2];
        document.getElementById("clienters").value=data[3];
        document.getElementById("direccion").value=data[4];
        document.getElementById("empresa").value=data[5];

        console.log(data);


    }
}

const BuscarCodigo = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("codigoficha").innerHTML = this.response;
            sacarDataOption();
        }
    };
    xmlhttp.open("POST", "./procesar.php", true);
    data = new FormData();
    data.append("buscando", document.getElementById("buscador").value)
    data.append("op", "buscarCodigo")
    xmlhttp.send(data);
}

const BucarProveedor = () => {
    if(document.getElementById("nombredni").value==""){
        document.getElementById("codigoficha").innerHTML = "";
        document.getElementById("clienters").innerHTML = "";
        document.getElementById("rucdni").innerHTML = "";
        document.getElementById("direccion").innerHTML = "";
        document.getElementById("empresa").innerHTML = "";

    }
    else{
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("codigoficha").innerHTML = this.response;
                sacarDataOption();
            }
        };
        xmlhttp.open("POST", "./procesar.php", true);
        data = new FormData();
        data.append("busqueda", document.getElementById("nombredni").value)
        data.append("op", "buscar")
        xmlhttp.send(data);
    }
}

function recogerDatos(){
    if(document.getElementsByName("dias")[0].checked){
        dias="30";
    }
    else{
        dias="60";
    }
    if(document.getElementsByName("contado")[0].checked){
        contadoefectivo="CONTADO";
    }
    else{
        contadoefectivo="CREDITO";
    }
    if(document.getElementsByName("pagos")[0].checked){
        pago="TARJETA";
    }
    else if(document.getElementsByName("pagos")[1].checked){
        pago="EFECTIVO";
    }
    else{
        pago="IZIPAY";
    }
    data.append("serie", document.getElementById("serie").value);
    data.append("numero", document.getElementById("numero").value);
    data.append("empresa", document.getElementById("empresa").value);
    data.append("fechaemision", document.getElementById("fechaemision").value);
    data.append("nombredni", document.getElementById("nombredni").value);
    data.append("codigoficha", document.getElementById("codigoficha").value);
    data.append("clienters", document.getElementById("clienters").value);
    data.append("rucdni", document.getElementById("rucdni").value);
    data.append("codigounico", document.getElementById("codigounico").value);
    data.append("direccion", document.getElementById("direccion").value);
    data.append("textproducto", document.getElementById("textproducto").value);
    data.append("contadoefectivo", contadoefectivo);
    data.append("dias", dias);
    data.append("pago", pago);
    xhttp.send(data);
}

function subirEdicion() {
    recogerDatos();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
            window.close();
        }
    };
    xmlhttp.open("POST", "./grabarbd.php",true);
        data = new FormData();
        sql="update productos set serie='"+serie
        +"', numero='"+numero
        +"', empresa='"+empresa
        +"', fechaemision='"+fechaemision
        +"', nombredni='"+nombredni
        +"', buscador='"+buscador
        +"', codigoficha='"+codigoficha
        +"', clienters='"+clienters
        +"', rucdni='"+rucdni
        +"', direccion='"+direccion
        +"', codigounico='"+codigounico
        +"', textproducto='"+textproducto
        +"', contadoefectivo='"+contadoefectivo
        +"', rbdcontado2='"+rbdcontado2
        +"', rbpagotarjeta='"+rbpagotarjeta
        +"', rbpagoefectivo='"+rbpagoefectivo
        +"', rbpagoizipay='"+rbpagoizipay + "' where id='"+id+"'";
        data.append("editar",sql);
        data.append("op","editar");
        xmlhttp.send(data);
        document.getElementById("contenedor1").reset();
}

const abrir_deta = (n) => {
    document.getElementById("id").value = n;
    document.getElementById("id").click();
}

const eliminar_Data = (e) => {
    document.getElementById("id").value = e;
    document.getElementById("id").click();
}

const Editar = () => {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            actualizarTabla();
        }
    };
    xhttp.open("POST", "./procesar.php", true);
    data = new FormData();
    if(document.getElementsByName("dias")[0].checked){
        dias="30";
    }
    else{
        dias="60";
    }
    if(document.getElementsByName("contado")[0].checked){
        contadoefectivo="CONTADO";
    }
    else{
        contadoefectivo="CREDITO";
    }
    if(document.getElementsByName("pagos")[0].checked){
        pago="TARJETA";
    }
    else if(document.getElementsByName("pagos")[1].checked){
        pago="EFECTIVO";
    }
    else{
        pago="IZIPAY";
    }
    data.append("serie", document.getElementById("serie").value);
    data.append("numero", document.getElementById("numero").value);
    data.append("empresa", document.getElementById("empresa").value);
    data.append("fechaemision", document.getElementById("fechaemision").value);
    data.append("nombredni", document.getElementById("nombredni").value);
    data.append("codigoficha", document.getElementById("codigoficha").value);
    data.append("clienters", document.getElementById("clienters").value);
    data.append("rucdni", document.getElementById("rucdni").value);
    data.append("codigounico", document.getElementById("codigounico").value);
    data.append("direccion", document.getElementById("direccion").value);
    data.append("textproducto", document.getElementById("textproducto").value);
    data.append("estado", document.getElementById("estado").value);

    data.append("contadoefectivo", contadoefectivo);
    data.append("dias", dias);
    data.append("pago", pago);
    data.append("op", "editar");
    data.append("id", seleccionado);
    xhttp.send(data);

    
    document.getElementById("serie").value = "";
    document.getElementById("numero").value = "";
    document.getElementById("empresa").value = "";
    document.getElementById("fechaemision").value = "";
    document.getElementById("nombredni").value = "";
    document.getElementById("codigoficha").value = "";
    document.getElementById("clienters").value = "";
    document.getElementById("rucdni").value = "";
    document.getElementById("codigounico").value = "";
    document.getElementById("direccion").value = "";
    document.getElementById("textproducto").value = "";
}

const Eliminar = () => {
    if(confirm("¿Desea elimiar el registro"+seleccionado+"?")){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.response);
                try {
                    document.getElementById("registro_"+seleccionado).outerHTML="";
                    seleccionado=0;
                } catch (error) {}         
            }
        };
        xmlhttp.open("POST", "./procesar.php",true);
        data = new FormData();

        data.append("op","eliminar");
        data.append("id",seleccionado);
        xmlhttp.send(data);
    }
    // document.getElementById("serie").value = "";
    // document.getElementById("numero").value = "";
    // document.getElementById("empresa").value = "";
    // document.getElementById("fechaemision").value = "";
    // document.getElementById("nombredni").value = "";
    // document.getElementById("codigoficha").value = "";
    // document.getElementById("clienters").value = "";
    // document.getElementById("rucdni").value = "";
    // document.getElementById("codigounico").value = "";
    // document.getElementById("direccion").value = "";
    // document.getElementById("textproducto").value = "";
    // document.getElementById("contadoefectivo").value = "";
    // document.getElementById("dias").value = "";
    // document.getElementById("pago").value = ""
}

const actualizarTabla = () => {
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("contetabla").innerHTML=this.response;
        }
    };
    xmlhttp.open("POST", "./procesar.php",true);
        data = new FormData();
        data.append("op","actualizarTabla");
        xmlhttp.send(data);
}

const obtenerCodigo = (n) =>{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try{
                document.getElementById("registro_"+seleccionado).style.background ="";
            }catch(exception){}
            seleccionado=n;
            datos=JSON.parse(this.response);
            console.log(datos);
            keys=['serie','numero','empresa','fechaemision','clienters','rucdni','direccion','codigounico','textproducto'];
            for(i=0;i<keys.length;i++){
                document.getElementById(keys[i]).value=datos[keys[i]];
            }
            document.getElementById("registro_"+n).style.background ="rgb(121, 226, 107)";
        }
    };
    xmlhttp.open("POST", "./procesar.php",true);
        data = new FormData();
        data.append("op","obtenerCodigo");
        data.append("id",n);
        xmlhttp.send(data);

}
window.onload= setTimeout(() => {
    actualizarTabla();
}, 100);

const pActi=()=>{

    if(document.getElementById("check1").checked){

    
        document.getElementById("fondo").style.display="none"; 
        document.getElementById("check2").checked= false;
        document.getElementById("fondo2").style.display="block";
        document.getElementById("codigounico").value="";
        document.getElementById("monto").value="";
         
    }else{
        document.getElementById("fondo").style.display="block";
        // document.getElementById("serie").value="";
        // document.getElementById("numero").value="";
        document.getElementById("empresa").value="";
        document.getElementById("codigoficha").value="";   
        document.getElementById("nombredni").value="";  
        document.getElementById("buscador").value=""; 
        document.getElementById("clienters").value="";
        document.getElementById("rucdni").value="";
        document.getElementById("direccion").value="";
    }
}

const sActi=()=>{
    if(document.getElementById("check2").checked){
       
          document.getElementById("fondo2").style.display="none";
          document.getElementById("check1").checked= false;
        document.getElementById("fondo").style.display="block";
        // document.getElementById("serie").value="";
        // document.getElementById("numero").value="";
        document.getElementById("empresa").value="";
        document.getElementById("codigoficha").value="";   
        document.getElementById("nombredni").value="";  
        document.getElementById("buscador").value="";
        document.getElementById("clienters").value="";
        document.getElementById("rucdni").value="";
        document.getElementById("direccion").value="";
        document.getElementById("clienters").disabled=false;
        document.getElementById("rucdni").disabled=false;
        document.getElementById("direccion").disabled=false;
                
    }else{
        document.getElementById("fondo2").style.display="block";
        document.getElementById("codigounico").value="";
          document.getElementById("monto").value="";
          document.getElementById("clienters").value="";
        document.getElementById("rucdni").value="";
        document.getElementById("direccion").value="";
        document.getElementById("clienters").disabled=true;
        document.getElementById("rucdni").disabled=true;
        document.getElementById("direccion").disabled=true;
        
    }
}

// FORMATO DE TEXTO AR


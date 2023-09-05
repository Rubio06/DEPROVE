var dataPed = new FormData();
function jalarDatosTbPed(){
    dataPed = new FormData();
    pedidosTotal=[];
    for(n=1;n<4;n++){
        if(document.getElementById("Postpago"+n).checked || document.getElementById("Prepago"+n).checked){
            ped=[];
            ped.push(document.getElementById("PesoVenta"+n).innerHTML.substring(12));
            /* 1 */ ped.push(document.getElementById("seleccionTipoPlan"+n).value);
            /* 2 */ ped.push(document.getElementById("seleccionPlan"+n).value);
            /* 3 */ ped.push(document.getElementById("cargofijoPlan"+n).value);
            /* 4 */ ped.push(document.getElementById("cuotaPlan"+n).value);
            /* 5 */ ped.push(document.getElementById("cuotasPlan"+n).value);
            /* 6 */ ped.push(document.getElementById("lineaportarPlan"+n).value);
            /* 7 */ ped.push(document.getElementById("operadorPlan"+n).value); 
            ped.push(document.getElementById("rentaadelantadaPlan"+n).value);
            ped.push(document.getElementById("imeiPlan" +n).value);
            /* 10 */ ped.push(document.getElementById("inicialPlan"+n).value);
            ped.push(document.getElementById("imeiSisacPlan"+n).value);
            ped.push(document.getElementById("imeiAreaPlan"+n).value);
            /* 13 */ ped.push(document.getElementById("iccPlan"+n).value);
            ped.push(document.getElementById("precioPlan"+n).value);
            /* 15 */ ped.push(document.getElementById("iccSisacPlan"+n).value);
            ped.push(document.getElementById("iccAreaPlan"+n).value);
            pedidosTotal.push(ped);
        }
    }
    console.log("pedidosTotal:");
    console.log(pedidosTotal);
    dataPed.append("pedidosTotal", JSON.stringify(pedidosTotal))
    dataPed.append("sec", document.getElementById("Sec").value.toString());
    dataPed.append("empresa", document.getElementById("empressa").value.toString());
    dataPed.append("fechaHora", document.getElementById("fechaHora").value.toString());
    dataPed.append("distrito", document.getElementById("distrito").value.toString());
    dataPed.append("direccion", document.getElementById("direccion").value.toString());
    dataPed.append("referencia", document.getElementById("referencia").value.toString());
    dataPed.append("fechaPactada", document.getElementById("fechaPactada").value.toString());
    dataPed.append("coorx", document.getElementById("coordenadasX").value.toString());
    dataPed.append("delivery", document.getElementById("delivery").value.toString());
    dataPed.append("asumeAses", document.getElementById("asumeAses").value.toString());
    dataPed.append("asumeCoord", document.getElementById("asumeCoord").value.toString());
    dataPed.append("asumeEmpr", document.getElementById("asumeEmpr").value.toString());
    dataPed.append("asumeMotori", document.getElementById("asumeMotori").value.toString());
    dataPed.append("cliente", document.getElementById("cliente").value.toString());
    dataPed.append("dni", document.getElementById("dniCliente").value.toString());
    dataPed.append("telf1", document.getElementById("telefRefCliente1").value.toString());
    dataPed.append("telf2", document.getElementById("telefRefCliente2").value.toString());
    dataPed.append("correo", document.getElementById("correoCliente").value.toString());
    dataPed.append("observacionCliente", document.getElementById("observacionCliente").value.toString());
    dataPed.append("idasesor", document.getElementById("asesor").innerHTML.toString());
    dataPed.append("tipfAlma", document.getElementById("tipfAlmacen").value.toString());
    dataPed.append("fechaAlma", document.getElementById("almacenFecha").value.toString());
    //afiliacion 
    dataPed.append("tipAfili", document.getElementById("tipfAfilicion").value.toString());
    dataPed.append("fechaAfili", document.getElementById("fechaAfilicion").value.toString());
    dataPed.append("obsAfili", document.getElementById("observacionAfiliacion").value.toString());
    // Validación
    dataPed.append("tipfVali", document.getElementById("tipfValidacion").value.toString());
    dataPed.append("fechaVali", document.getElementById("fechaValidacion").value.toString());
    dataPed.append("feDiferidoVali", document.getElementById("diferidoValidacion").value.toString());
    dataPed.append("obsVali", document.getElementById("observacionValidacion").value.toString());
    // Despacho
    dataPed.append("tipfDes", document.getElementById("tipfDesapacho").value.toString());
    dataPed.append("feEntraDes", document.getElementById("fechaentregaDespacho").value.toString());
    dataPed.append("feReproDes", document.getElementById("fechareprogramDespacho").value.toString());
    dataPed.append("motoDes", document.getElementById("monitorizado").value.toString());
    dataPed.append("xDes", document.getElementById("despachoCoordenadasX").value.toString());
    dataPed.append("yDes", document.getElementById("despachoCoordenadasY").value.toString());
    dataPed.append("obsDes", document.getElementById("observacionDespacho").value.toString());
    // activación
    dataPed.append("tipActi", document.getElementById("tipfActivacion").value.toString());
    dataPed.append("feActiClaro", document.getElementById("fechaActivacionClaro").value.toString());
    dataPed.append("feEntreActi", document.getElementById("fechaEntregaActivacion").value.toString());
    dataPed.append("reActi", document.getElementById("tipfReclamo").value.toString());
    dataPed.append("obsActi", document.getElementById("observacionActivacion").value.toString());
    //HFC
    dataPed.append("tipHfc", document.getElementById("tipfValidadorHFC").value.toString());
    dataPed.append("feContratoHfc", document.getElementById("fechaudiocontratoValidadorHFC").value.toString());
    dataPed.append("feInsHfc", document.getElementById("fechainstalacionValidadorHFC").value.toString());
    dataPed.append("obsHfc", document.getElementById("observacionValidadorHFC").value.toString());
}
const subirRegistro = () => {
    jalarDatosTbPed();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.response=="1 - 1"){
                window.location.href = "./";
            }
        }
        console.log(this.response);
    };
    console.log()
    xmlhttp.open("POST", "./comun.php", true);
    dataPed.append("q", "SubirPedidos")
    xmlhttp.send(dataPed);
    // LimpiarForm();
}

function LimpiarForm(){
    document.getElementById("Sec").value="";
    document.getElementById("empressa").value="";
    document.getElementById("distrito").value="";
    document.getElementById("direccion").value="";
    document.getElementById("referencia").value="";
    document.getElementById("fechaPactada").value="";
    document.getElementById("coordenadasX").value="";
    // document.getElementById("coordenadasY").value="";
    document.getElementById("delivery").value="";
    document.getElementById("asumeAses").value="";
    document.getElementById("asumeCoord").value="";
    document.getElementById("asumeEmpr").value="";
    document.getElementById("asumeMotori").value="";
    document.getElementById("cliente").value="";
    document.getElementById("dniCliente").value="";
    document.getElementById("telefRefCliente1").value="";
    document.getElementById("telefRefCliente2").value="";
    document.getElementById("correoCliente").value="";
    document.getElementById("observacionCliente").value="";
    document.getElementById("asesor").value="";
    document.getElementById("tipfAlmacen").value="";
    document.getElementById("almacenFecha").value="";
    //afiliacion 
     document.getElementById("tipfAfilicion").value="";
     document.getElementById("fechaAfilicion").value="";
     document.getElementById("observacionAfiliacion").value="";
    // Validación
    document.getElementById("tipfValidacion").value="";
    document.getElementById("fechaValidacion").value="";
    document.getElementById("diferidoValidacion").value="";
    document.getElementById("observacionValidacion").value="";
    // Despacho
    document.getElementById("tipfDesapacho").value="";
    document.getElementById("fechaentregaDespacho").value="";
    document.getElementById("fechareprogramDespacho").value="";
    document.getElementById("monitorizado").value=""; 
    document.getElementById("despachoCoordenadasX").value="";
    document.getElementById("despachoCoordenadasY").value=""; 
    document.getElementById("observacionDespacho").value="";
    // activación
    document.getElementById("tipfActivacion").value="";
    document.getElementById("fechaActivacionClaro").value="";
    document.getElementById("fechaEntregaActivacion").value="";
    document.getElementById("tipfReclamo").value="";
    document.getElementById("observacionActivacion").value="";
    //HFC
    document.getElementById("tipfValidadorHFC").value="";
    document.getElementById("fechaudiocontratoValidadorHFC").value="";
    document.getElementById("fechainstalacionValidadorHFC").value="";
    document.getElementById("observacionValidadorHFC").value="";
}
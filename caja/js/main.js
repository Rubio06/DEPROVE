
    
    //MODAL IZIPAY
    
    let modal = document.getElementById('miModal');
    let flex = document.getElementById('flex');
    let abrir = document.getElementById('ajusteIzi');
    let cerrar = document.getElementById('close');

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

//MODAL INGRESARBANCOS

    let modal1 = document.getElementById('miModal1');
    let flex1 = document.getElementById('flex1');
    let abrir1 = document.getElementById('modal-banco');
    let cerrar1 = document.getElementById('close1');

    abrir1.addEventListener('click', function() {
        modal1.style.display = 'block';
         
    });

    cerrar1.addEventListener('click', function() {
        modal1.style.display = 'none';
         
    });

    window.addEventListener('click', function(e) { 
        if (e.target == flex) {
            modal1.style.display = 'none';
             
    }
});


//MODAL TIPOS

let modal3 = document.getElementById('miModal3');
let flex3 = document.getElementById('flex3');
let abrir3 = document.getElementById('modal-tipo');
let cerrar3 = document.getElementById('close3');

abrir3.addEventListener('click', function() {
    modal3.style.display = 'block';
     
});

cerrar3.addEventListener('click', function() {
    modal3.style.display = 'none';
     
});

window.addEventListener('click', function(e) { 
    if (e.target == flex) {
        modal3.style.display = 'none';
         
}
});

//MODAL PERIODO


let modal2 = document.getElementById('miModal2');
let flex2 = document.getElementById('flex2');
let abrir2 = document.getElementById('modal-periodo');
let cerrar2 = document.getElementById('close2');

abrir2.addEventListener('click', function() {
    modal2.style.display = 'block';
     
});

cerrar2.addEventListener('click', function() {
    modal2.style.display = 'none';
     
});

window.addEventListener('click', function(e) { 
    if (e.target == flex) {
        modal2.style.display = 'none';
         
}
});



function calcular(){
    v = document.getElementById('montoVoucher').value;
    b = document.getElementById('montoBanco').value;

    total=((100*b)/v);
    total=100-total; 

    porcentIzi.value=parseFloat(total.toFixed(2))+"%";
}

//CHEKED

const presionarCheck = (n) => {
    if (document.getElementById("factura").checked) {
        console.log("factura");

    } else {
        console.log("boleta");
    }
}

// function ocularItem(){
//     concepto = document.getElementById("concepto").style.display = "block";

//     if(concepto == 3){
//         concepto = document.getElementById("concepto").style.display = "block";

//     }

// }

ocultar();


function ocultar() {
    document.getElementById("contenedor1").style.display = "block";
    // document.getElementById("contenedor1").reset();
    // value
    n = document.getElementById("concepto").value;
    f1 = document.getElementById("form1");
    form3 = document.getElementById("form3");
    f4 = document.getElementById("destino");
    f5 = document.getElementById("motorizado");
    f6 = document.getElementById("referencia");
    f7 = document.getElementById("trabajadores");
    f8 = document.getElementById("ajuste");
    f9 = document.getElementById("con");
    f10 = document.getElementById("gene-monto");
    f12 = document.getElementById("observaarea");
    f13 = document.getElementById("observaciones");
    f14 = document.getElementById("observaciones2");
    // f15 = document.getElementById("observaciones5");
    // f16 = document.getElementById("gene-empresa");
    f18 = document.getElementById("observacioncomprobante");
    tituloobserva = document.getElementById("titulo-observa");
    trabajadores = document.getElementById("trabajadores");
    nombreusuario = document.getElementById("nombreusuario");
    dnitrabajador = document.getElementById("dnitrabajador");
    monto1 = document.getElementById("monto1");
    motorizado = document.getElementById("motorizado");
    recarga = document.getElementById("recarga");
    primerformulario = document.getElementById("primerformulario");
    empresaini = document.getElementById("empresaini");
    empresa = document.getElementById("empresa");
    autoizacion = document.getElementById("autorizacion");

    

    // lblconcepto = document.getElementById("lblconcepto");


    f1.style.display = "block";
    // f3.style.display = "block";
    f4.style.display = "block";
    f5.style.display = "block";
    f6.style.display = "block";
    f7.style.display = "block";
    f8.style.display = "block";
    f9.style.display = "block";
    f10.style.display = "block";
    autoizacion.style.display = "block";
    f12.style.display = "block";
    f13.style.display = "block";
    f14.style.display = "block";
    primerformulario.style.display = "block";

    monto1.style.display = "block";
    motorizado.style.display = "block";
    recarga.style.display = "block";
    empresaini.style.display = "block";
    empresa.style.display = "block";






    //LIQUIDACION
    if (n == "LIQUIDACION") {
        f1.style.display = "none";
        f7.style.display = "none";
        f8.style.display = "none";

        // f15.style.display = "none";
        // f16.style.display = "none";
        f14.style.position = "absolute";
        f14.style.top = "950px";
        form3.style.position = "absolute";
        form3.style.top = "300px";
        // f6.style.display = "none";
        recarga.style.display = "none";
        monto1.style.display = "none";
        motorizado.style.display = "none";
        // document.getElementById("lblconcepto").innerHTML = "FECHA CONCEPTO";
        document.getElementById("cambioconcepto").innerHTML = "FECHA CONCEPTO";
        document.getElementById("voucher").innerHTML = "FECHA DE VAUCHER";
        document.getElementById("lbldeposito").innerHTML = "FECHA DE VENTA";

    //DEPOSITO
    } else if (n == "DEPOSITO") {
        form1.style.position = "absolute";
        form1.style.top = "880px";
        form3.style.position = "absolute";
        form3.style.top = "870px";

        f14.style.position = "absolute";
        f14.style.top = "1600px";

        recarga.style.display = "none";
        // autoizacion.style.display = "none";


        // f14.style.top = "690px";
        f4.style.display = "none";
        f6.style.display = "none";
        f5.style.display = "none";
        f7.style.display = "none";
        monto1.style.display = "none";
        motorizado.style.display = "none";
        document.getElementById("cambioconcepto").innerHTML = "FECHA CONCEPTO";

        document.getElementById("lbldeposito").innerHTML = "FECHA DEPOSITO";
        document.getElementById("voucher").innerHTML = "FECHA DE VAUCHER";

    // GASTOS    
    } else if (n == "GASTOS") {

        recarga.style.display = "none";
        f4.style.display = "none";
        f6.style.display = "none";
        f5.style.display = "none";
        f7.style.display = "none";
        form1.style.position = "absolute";
        form1.style.top = "880px";
        form3.style.position = "absolute";
        form3.style.top = "860px";
        f14.style.position = "absolute";
        f14.style.top = "1605px";
        monto1.style.display = "none";
        motorizado.style.display = "none";
        document.getElementById("cambioconcepto").innerHTML = "FECHA CONCEPTO";
        // autoizacion.style.display = "none";

        document.getElementById("lbldeposito").innerHTML = "FECHA GASTOS";
        document.getElementById("voucher").innerHTML = "FECHA DE VAUCHER";



    // LIQIDACION MOTORIZADO
    } else if (n == "LIQUIDACION MOTORIZADO") {

        f1.style.display = "none";
        trabajadores.style.display = "none";

        f4.style.display = "none";
        // f3.style.display = "none";
        f7.style.display = "none";
        // f15.style.display = "none";
        // f6.style.display = "none";
        // trabajadores.style.position = "absolute";
        // trabajadores.style.top = "860px";
        recarga.style.display = "none";
        empresaini.style.display = "none";
        empresa.style.display = "none";
        form3.style.position = "absolute";
        form3.style.top = "275px";

        f14.style.position = "absolute";
        f14.style.top = "1010px";
        monto1.style.display = "block";
        document.getElementById("cambioconcepto").innerHTML = "FECHA QUE ENTEGO EL DINERO EL MOTORIZADO";
        document.getElementById("voucher").innerHTML = "FECHA DE VAUCHER (DEPOSITO MOTORIZADO)";
        document.getElementById("lbldeposito").innerHTML = "FECHA DE VENTA";


    //SUELDO   
    } else if (n == "SUELDO") {
        f1.style.display = "none";
        f4.style.display = "none";
        f5.style.display = "none";
        f8.style.display = "none";
        f10.style.display = "none";
        recarga.style.display = "none";
        // empresainicio.style.display = "none";
        // autoizacion.style.display = "none";

        trabajadores.style.position = "absolute";
        trabajadores.style.top = "880px";
        form3.style.position = "absolute";
        form3.style.top = "990px";
        f14.style.position = "absolute";
        f14.style.top = "1635px";

        empresaini.style.display = "none";
        empresa.style.display = "none";

        monto1.style.display = "none";
        motorizado.style.display = "none";
        document.getElementById("cambioconcepto").innerHTML = "FECHA CONCEPTO";

        document.getElementById("voucher").innerHTML = "FECHA DE VAUCHER";
        document.getElementById("lbldeposito").innerHTML = "FECHA SUELDO";


    //BONO
    } else if (n == "BONO") {
        f1.style.display = "none";
        f4.style.display = "none";
        f5.style.display = "none";
        f8.style.display = "none";
        f10.style.display = "none";
        // empresainicio.style.display = "none";
        // autoizacion.style.display = "none";

        recarga.style.display = "none";
        trabajadores.style.position = "absolute";
        trabajadores.style.top = "880px";
        form3.style.position = "absolute";
        form3.style.top = "990px";
        f14.style.position = "absolute";
        f14.style.top = "1635px";
        empresaini.style.display = "none";
        empresa.style.display = "none";

        monto1.style.display = "none";
        motorizado.style.display = "none";
        document.getElementById("cambioconcepto").innerHTML = "FECHA CONCEPTO";
        document.getElementById("voucher").innerHTML = "FECHA DE VAUCHER";
        document.getElementById("lbldeposito").innerHTML = "FECHA BONO";
    //COMISION
    } else if (n == "COMISION") {

        f1.style.display = "none";
        f4.style.display = "none";
        f5.style.display = "none";
        f8.style.display = "none";
        f10.style.display = "none";
        recarga.style.display = "none";
        trabajadores.style.position = "absolute";
        trabajadores.style.top = "880px";
        form3.style.position = "absolute";
        form3.style.top = "990px";
        f14.style.position = "absolute";
        f14.style.top = "1635px";
        // empresainicio.style.display = "none";
        // autoizacion.style.display = "none";

        monto1.style.display = "none";

        motorizado.style.display = "none";
        document.getElementById("cambioconcepto").innerHTML = "FECHA CONCEPTO";
        empresaini.style.display = "none";
        empresa.style.display = "none";
        document.getElementById("lbldeposito").innerHTML = "FECHA COMISION";
        nombreusuario.style.display = "none";
        document.getElementById("voucher").innerHTML = "FECHA DE VAUCHER";
    //LIQUIDACION PERSONAL
    } else if (n == "LIQUIDACION PERSONAL") {
        f1.style.display = "none";
        f4.style.display = "none";
        f5.style.display = "none";
        f8.style.display = "none";
        f10.style.display = "none";
        // empresainicio.style.display = "none";
        // autoizacion.style.display = "none";

        recarga.style.display = "none";

        motorizado.style.display = "none";

        trabajadores.style.position = "absolute";
        trabajadores.style.top = "880px";
        form3.style.position = "absolute";
        form3.style.top = "990px";
        f14.style.position = "absolute";
        f14.style.top = "1635px";

        empresaini.style.display = "none";
        empresa.style.display = "none";
        monto1.style.display = "none";
        document.getElementById("cambioconcepto").innerHTML = "FECHA CONCEPTO";
        document.getElementById("voucher").innerHTML = "FECHA DE VAUCHER";

        document.getElementById("lbldeposito").innerHTML = "F. LIQUIDACION PERSONAL";
    //ADELANTO
    } else if (n == "ADELANTO") {
        f1.style.display = "none";
        f4.style.display = "none";
        f5.style.display = "none";
        f8.style.display = "none";
        f10.style.display = "none";
        // empresainicio.style.display = "none";

        recarga.style.display = "none";
        // autoizacion.style.display = "none";

        trabajadores.style.position = "absolute";
        trabajadores.style.top = "880px";
        form3.style.position = "absolute";
        form3.style.top = "990px";
        f14.style.position = "absolute";
        f14.style.top = "1635px";

        empresaini.style.display = "none";
        empresa.style.display = "none";
        // f20.style.position = "absolute";

        monto1.style.display = "none";
        motorizado.style.display = "none";

        document.getElementById("cambioconcepto").innerHTML = "FECHA CONCEPTO";
        document.getElementById("voucher").innerHTML = "FECHA DE VAUCHER";
        document.getElementById("lbldeposito").innerHTML = "FECHA DE ADELANTO";


    } else if (n == "RECARGA"){      
  
        f1.style.display = "none";
        f7.style.display = "none";
        f8.style.display = "none";
        // f15.style.display = "none";
        // f16.style.display = "none";
        f14.style.position = "absolute";
        f14.style.top = "990px";
        trabajadores.style.position = "relative";
        trabajadores.style.top = "-80px";
        // f6.style.display = "none";
        motorizado.style.display = "none";
        primerformulario.style.display = "none";
        recarga.style.position = "adsolute";
        recarga.style.top = "570px";
        form3.style.position = "absolute";
        form3.style.top = "350px";
        document.getElementById("voucher").innerHTML = "FECHA DE VAUCHER";
        document.getElementById("cambioconcepto").innerHTML = "FECHA CONCEPTO";
        monto1.style.display = "none";
        document.getElementById("lbldeposito").innerHTML = "F. LIQUIDACION MOTORIZADO";



    } else if (n == "FULL RECARGA"){
        f1.style.display = "none";
        f7.style.display = "none";
        f8.style.display = "none";
        // f15.style.display = "none";
        // f16.style.display = "none";
        f14.style.position = "absolute";
        f14.style.top = "990px";
        trabajadores.style.position = "relative";
        trabajadores.style.top = "-80px";
        // f6.style.display = "none";
        primerformulario.style.display = "none";
        recarga.style.top = "570px";
        form3.style.position = "absolute";
        form3.style.top = "350px";
        motorizado.style.display = "none";
        document.getElementById("cambioconcepto").innerHTML = "FECHA CONCEPTO";
        document.getElementById("voucher").innerHTML = "FECHA DE VAUCHER";
        monto1.style.display = "none";
        document.getElementById("lbldeposito").innerHTML = "F. LIQUIDACION MOTORIZADO";


    } else if (n == "SEPARACION DE EQUIPOS"){
        f1.style.display = "none";
        f7.style.display = "none";
        f8.style.display = "none";
        // f15.style.display = "none";
        // f16.style.display = "none";
        f14.style.position = "absolute";
        f14.style.top = "990px";
        trabajadores.style.position = "relative";
        trabajadores.style.top = "-80px";
        // f6.style.display = "none";
        motorizado.style.display = "none";
        recarga.style.top = "570px";
        form3.style.position = "absolute";
        form3.style.top = "350px";

        primerformulario.style.display = "none";

        document.getElementById("voucher").innerHTML = "FECHA DE VAUCHER";
        monto1.style.display = "none";

        document.getElementById("cambioconcepto").innerHTML = "FECHA CONCEPTO";


        document.getElementById("lbldeposito").innerHTML = "F. LIQUIDACION MOTORIZADO";



    } else if (n == "OTROS INGRESOS"){
        f1.style.display = "none";
        f7.style.display = "none";
        f8.style.display = "none";
        // f15.style.display = "none";
        // f16.style.display = "none";
        f14.style.position = "absolute";
        f14.style.top = "990px";
        trabajadores.style.position = "relative";
        trabajadores.style.top = "-80px";
        // f6.style.display = "none";
        motorizado.style.display = "none";
        document.getElementById("voucher").innerHTML = "FECHA DE VAUCHER";
        primerformulario.style.display = "none";
        recarga.style.top = "570px";
        form3.style.position = "absolute";
        form3.style.top = "350px";
        monto1.style.display = "none";
        document.getElementById("cambioconcepto").innerHTML = "FECHA CONCEPTO";
        document.getElementById("lbldeposito").innerHTML = "F. LIQUIDACION MOTORIZADO";
    }
    console.log(n);
     
}


function selectcheck(){
    $("#factura").on('change', function(ev){
        ev.preventDefault();
        $("#boleta").prop("checked", false);

        if(document.getElementById("factura").checked){
            document.getElementById("doc1").disabled=false;
            document.getElementById("doc2").disabled=false;
            document.getElementById("proveedor").disabled=false;
            document.getElementById("proveedor").disabled=false;
            document.getElementById("suministro").disabled=false;
            document.getElementById("fechafactura").disabled=false;
            document.getElementById("textdireccion").disabled=false;
            document.getElementById("observacioncomprobante").disabled=false;

        }else{
            document.getElementById("doc1").disabled=true;
            document.getElementById("doc2").disabled=true;
            document.getElementById("proveedor").disabled=true;
            document.getElementById("suministro").disabled=true;
            document.getElementById("fechafactura").disabled=true;
            document.getElementById("textdireccion").disabled=true;
            document.getElementById("observacioncomprobante").disabled=true;

            document.getElementById("doc1").value="";
            document.getElementById("doc2").value="";
            document.getElementById("proveedor").value="";
            document.getElementById("suministro").value="";
            document.getElementById("fechafactura").value="";
            document.getElementById("textdireccion").value="";
            document.getElementById("observacioncomprobante").value="";
        }
    });

    $("#boleta").on('change', function(ev){
        ev.preventDefault();
        $("#factura").prop("checked", false);

        if(document.getElementById("boleta").checked){
            document.getElementById("doc1").disabled=false;
            document.getElementById("doc2").disabled=false;
            document.getElementById("proveedor").disabled=false;
            document.getElementById("proveedor").disabled=false;
            document.getElementById("suministro").disabled=false;
            document.getElementById("fechafactura").disabled=false;
            document.getElementById("textdireccion").disabled=false;
            document.getElementById("observacioncomprobante").disabled=false;

        }else{
            document.getElementById("doc1").disabled=true;
            document.getElementById("doc2").disabled=true;
            document.getElementById("proveedor").disabled=true;
            document.getElementById("suministro").disabled=true;
            document.getElementById("fechafactura").disabled=true;
            document.getElementById("textdireccion").disabled=true;
            document.getElementById("observacioncomprobante").disabled=true;

            document.getElementById("doc1").value="";
            document.getElementById("doc2").value="";
            document.getElementById("proveedor").value="";
            document.getElementById("suministro").value="";
            document.getElementById("fechafactura").value="";
            document.getElementById("textdireccion").value="";
            document.getElementById("observacioncomprobante").value="";


        }


    });
}



function seleccionEmpresa(){
    $("#deposito").on('change', function(ev){
        ev.preventDefault();
        $("#cuentaterceros").prop("checked", false);

        if(document.getElementById("deposito").checked){
            
            document.getElementById("inputoperacion").disabled=false;
            document.getElementById("selectbanco").disabled=false;
            document.getElementById("fechavoucher").disabled=false;
            document.getElementById("horavoucher").disabled=false;
            document.getElementById("modal-banco").disabled=false;

            // document.getElementById("selectmotorizado").disabled=false;



        }else{
            document.getElementById("inputoperacion").disabled=true;
            document.getElementById("selectbanco").disabled=true;
            document.getElementById("fechavoucher").disabled=true;
            // document.getElementById("selectmotorizado").disabled=true;
            document.getElementById("horavoucher").disabled=true;
            document.getElementById("modal-banco").disabled=true;

            document.getElementById("inputoperacion").value="";
            document.getElementById("selectbanco").value="";
            document.getElementById("fechavoucher").value="";
            document.getElementById("horavoucher").value="";
            // document.getElementById("selectmotorizado").value="";



        }

    });

    $("#cuentaterceros").on('change', function(ev){
        ev.preventDefault();
        $("#deposito").prop("checked", false);

        if(document.getElementById("cuentaterceros").checked){

            document.getElementById("inputoperacion").disabled=false;
            document.getElementById("selectbanco").disabled=false;
            document.getElementById("fechavoucher").disabled=false;
            document.getElementById("horavoucher").disabled=false;
            document.getElementById("modal-banco").disabled=false;


            // document.getElementById("selectmotorizado").disabled=false;


        }else{

            document.getElementById("inputoperacion").disabled=true;
            document.getElementById("selectbanco").disabled=true;
            document.getElementById("fechavoucher").disabled=true;
            document.getElementById("horavoucher").disabled=true;

            // document.getElementById("selectmotorizado").disabled=true;

            document.getElementById("inputoperacion").value="";
            document.getElementById("selectbanco").value="";
            document.getElementById("fechavoucher").value="";
            document.getElementById("horavoucher").value="";
            // document.getElementById("selectmotorizado").value="";
            document.getElementById("modal-banco").disabled=true;



        }

    });
}

tipoIE = "";
concepto = "";
nombreusuario = "";
fregistro = "";
conceptofecha = "";
montoform = ""; 
cjdestino = "";
selectmotorizado = ""; 
ref = "";
inputoperacion = ""; 
selectbanco = "";
fechavoucher = "";
horavoucher = "";
fechaconfirmacion = "";
observaarea = "";
empresa = "";
doc1 = "";
doc2 = "";
proveedor = 
suministro = "";
fechafactura = "";
textdireccion = "";
observacioncomprobante = ""
porcentIzi = "";
deposito = "";
cuentaterceros = "";
nautorizacion = "";
tipotrabajador = "";
periodotrabajador = "";
trabajador = "";
tipotrabajador = ""; 
fechaconcep = "";
dnitrabajador = "";
nombrecliente = "";
fechaconcepto = "";
numtelefono = "";
vendedor = "";
autorizacion = "";
documento = "";
dnicliente = "";


function recogerDatos(){
    tipoIE = document.getElementById("tipo").innerHTML.substring(0,3);
    concepto = document.getElementById("concepto").value;
    nombreusuario = document.getElementById("nombreusuario").value;
    fregistro = document.getElementById("fregistro").value;
    conceptofecha = document.getElementById("conceptofecha").value;
    montoform = document.getElementById("montoform").value;
    cjdestino = document.getElementById("cjdestino").value;
    selectmotorizado = document.getElementById("selectmotorizado").value;
    ref = document.getElementById("ref").value;
    inputoperacion = document.getElementById("inputoperacion").value;
    selectbanco = document.getElementById("selectbanco").value;
    fechavoucher = document.getElementById("fechavoucher").value;
    horavoucher = document.getElementById("horavoucher").value;
    fechaconfirmacion = document.getElementById("fechaconfirmacion").value;
    observaarea = document.getElementById("observaarea").value;
    empresa = document.getElementById("empresa").value;
    doc1 = document.getElementById("doc1").value;
    doc2 = document.getElementById("doc2").value;
    proveedor = document.getElementById("proveedor").value;
    suministro = document.getElementById("suministro").value;
    fechafactura = document.getElementById("fechafactura").value;
    textdireccion = document.getElementById("textdireccion").value;
    observacioncomprobante = document.getElementById("observacioncomprobante").value;
    porcentIzi = document.getElementById("porcentIzi").value;
    // cuentaempresa = document.getElementById("cuentaempresa").value;
    if(document.getElementById("deposito").checked){
        deposito = "CTA EMPRESA";
    }
    else{
        
        if(document.getElementById("cuentaterceros").checked){
            deposito = "CTA TERCEROS";
        }else{
            deposito = "";

        }
    }
    cuentaterceros = document.getElementById("cuentaterceros").value;
    nautorizacion = document.getElementById("nautorizacion").value;
    tipotrabajador = document.getElementById("tipotrabajador").value;
    periodotrabajador = document.getElementById("periodotrabajador").value;
    trabajador = document.getElementById("trabajador").value;
    tipotrabajador = document.getElementById("tipotrabajador").value;
    fechaconcep = document.getElementById("fechaconcep").value;
    dnitrabajador = document.getElementById("dnitrabajador").value;
    nombrecliente = document.getElementById("nombrecliente").value;
    fechaconcepto = document.getElementById("fechaconcepto").value;
    numtelefono = document.getElementById("numtelefono").value;
    vendedor = document.getElementById("vendedor").value;
    autorizacion = document.getElementById("autorizacion").value;
    if(document.getElementById("factura").checked){
        documento = "FACTURA";
    }
    else{
        if(document.getElementById("boleta").checked){
            documento = "BOLETA";
            
        }else{
            documento = "";
        }
    }
    dnicliente = document.getElementById("dnicliente").value;
}

function subir() {
    recogerDatos();

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
        }
    };
    xmlhttp.open("POST", "./insertar.php",true);
    try{
        console.log(document.getElementById("concepto").value);
        if(concepto=="LIQUIDACION PERSONAL"||concepto=="SUELDO"||concepto=="BONO"||concepto=="COMISION" || concepto=="ADELANTO"){
            data = new FormData();
            sql="INSERT INTO formulario VALUES"
            for(i=0;i<arraydatos.length;i++){
                sql+="(null,'"+ tipoIE
                +"', (select if((select max(f.codigo)+1 from formulario f where f.tipoIE='"+tipoIE
                +"')!='',(select max(f.codigo)+1 from formulario f where f.tipoIE='"+tipoIE+"'),1)),'"+nombreusuario
                +"', '"+concepto
                +"', '"+fregistro
                +"', '"+conceptofecha
                +"', '"+arraydatos[i][1]
                +"', '"+arraydatos[i][3]
                // +"', '"+arraydatos[i][2]
                +"', '"+cjdestino
                +"', '"+selectmotorizado
                +"', '"+ref
                +"', '"+nautorizacion
                +"', '"+autorizacion
                +"', '"+tipotrabajador
                +"', '"+periodotrabajador
                +"', '"+arraydatos[i][2]
                +"', '"+arraydatos[i][0]
                +"', '"+fechaconcep
                +"', '"+documento
                +"', '"+doc1
                +"', '"+doc2
                +"', '"+inputoperacion
                +"', '"+proveedor
                +"', '"+suministro 
                +"', '"+fechafactura
                +"', '"+textdireccion
                +"', '"+observacioncomprobante
                +"', '"+porcentIzi
                +"', '"+selectbanco
                +"', '"+fechavoucher
                +"', '"+horavoucher
                +"', '"+fechaconfirmacion
                +"', '"+deposito
                +"', '"+observaarea
                +"', '"+dnicliente
                +"', '"+nombrecliente
                +"', '"+fechaconcepto
                +"', '"+numtelefono
                // +"', '"+cuentaterceros
                +"', '"+vendedor+"')";
                if(i<(arraydatos.length-1)){
                    sql+=",";
                }
                else{
                    sql+=";";
                }
            }
        }
        else{
        data = new FormData();
        sql="INSERT INTO formulario VALUES (null,'"+ tipoIE
        +"', (select if((select max(f.codigo)+1 from formulario f where f.tipoIE='"+tipoIE
        +"')!='',(select max(f.codigo)+1 from formulario f where f.tipoIE='"+tipoIE+"'),1)),'"+nombreusuario
        +"', '"+concepto
        +"', '"+fregistro
        +"', '"+conceptofecha
        +"', '"+montoform
        +"', '"+empresa
        +"', '"+cjdestino
        +"', '"+selectmotorizado
        +"', '"+ref
        +"', '"+nautorizacion
        +"', '"+autorizacion
        +"', '"+tipotrabajador
        +"', '"+periodotrabajador
        +"', '"+trabajador
        +"', '"+dnitrabajador
        +"', '"+fechaconcep
        +"', '"+documento
        +"', '"+doc1
        +"', '"+doc2
        +"', '"+inputoperacion
        +"', '"+proveedor
        +"', '"+suministro 
        +"', '"+fechafactura
        +"', '"+textdireccion
        +"', '"+observacioncomprobante
        +"', '"+porcentIzi
        +"', '"+selectbanco
        +"', '"+fechavoucher
        +"', '"+horavoucher
        +"', '"+fechaconfirmacion
        +"', '"+deposito
        +"', '"+observaarea
        +"', '"+dnicliente
        +"', '"+nombrecliente
        +"', '"+fechaconcepto
        +"', '"+numtelefono
        // +"', '"+cuentaterceros
        +"', '"+vendedor+"')";
            // cartg.location.reload();
        }
        // console.log(sql);
        data.append("query",sql);
        xmlhttp.send(data);

        document.getElementById("contenedor1").reset();
        
        cartg=window.open("./","_self");
         
    }
    catch(error){
        console.log(error);
         
    }
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
    xmlhttp.open("POST", "./buscar.php",true);
        data = new FormData();
        sql="update formulario set nombreusuario='"+nombreusuario
        +"', concepto='"+concepto
        +"', fecharegistro='"+fregistro
        +"', conceptofecha='"+conceptofecha
        +"', monto='"+montoform
        +"', empresa='"+empresa
        +"', cajadestino='"+cjdestino
        +"', motorizado='"+selectmotorizado
        +"', referencia='"+ref
        +"', nautorizacion='"+nautorizacion
        +"', autorizacion='"+autorizacion
        +"', tipo='"+tipotrabajador
        +"', periodo='"+periodotrabajador
        +"', trabajador='"+trabajador
        +"', dnitrabajador='"+dnitrabajador
        +"', fechaconcep='"+fechaconcep
        +"', documento='"+documento
        +"', serie='"+doc1
        +"', numero='"+doc2
        +"', numerooperacion='"+inputoperacion
        +"', provedor='"+proveedor
        +"', slrc='"+suministro 
        +"', fechafactura='"+fechafactura
        +"', direccion='"+textdireccion
        +"', observacioncompro='"+observacioncomprobante
        +"', izipay='"+porcentIzi
        +"', banco='"+selectbanco
        +"', fechavoucher='"+fechavoucher
        +"', horavoucher='"+horavoucher
        +"', fechaconfirmacion='"+fechaconfirmacion
        +"', deposito='"+deposito
        +"', observacion='"+observaarea
        +"', dnicliente='"+dnicliente
        +"', nombrecliente='"+nombrecliente
        +"', fechaconcepto='"+fechaconcepto
        +"', numtelefono='"+numtelefono
        // +"', '"+cuentaterceros
        +"', vendedor='"+vendedor+"' where id='"+idaEditar+"'";
        data.append("editar",sql);
        data.append("op","editar");
        xmlhttp.send(data);
        document.getElementById("contenedor1").reset();
}
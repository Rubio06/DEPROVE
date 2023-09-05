
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

    window.addEventListener('click', function(e) {
        console.log(e.target);
        if (e.target == flex) {
            modal.style.display = 'none';
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





ocultar();


function ocultar() {
    document.getElementById("contenedor1").style.display = "block";
    document.getElementById("contenedor1").reset();
    n = document.getElementById("concepto").selectedIndex;

    f1 = document.getElementById("form1");
    f3 = document.getElementById("form1");
    form3 = document.getElementById("form3");

    f4 = document.getElementById("destino");
    f5 = document.getElementById("motorizado");
    f6 = document.getElementById("referencia");
    f7 = document.getElementById("trabajadores");
    f8 = document.getElementById("ajuste");
    f9 = document.getElementById("con");
    f10 = document.getElementById("gene-monto");
    f11 = document.getElementById("observa");
    f12 = document.getElementById("observaarea");
    f13 = document.getElementById("observaciones");
    f14 = document.getElementById("observaciones2");



    f15 = document.getElementById("observaciones5");
    f16 = document.getElementById("gene-empresa");
    f18 = document.getElementById("observacioncomprobante");
    f19 = document.getElementById("areatxt");
    tituloobserva = document.getElementById("titulo-observa");

    trabajadores = document.getElementById("trabajadores");

    nombreusuario = document.getElementById("nombreusuario");




    f1.style.display = "block";
    f3.style.display = "block";
    f4.style.display = "block";
    f5.style.display = "block";
    f6.style.display = "block";
    f7.style.display = "block";
    f8.style.display = "block";
    f9.style.display = "block";
    f10.style.display = "block";

    f12.style.display = "block";
    f13.style.display = "block";
    f14.style.display = "block";


    //LIQUIDACION
    if (n == 0) {
        f1.style.display = "none";
        f7.style.display = "none";
        f8.style.display = "none";
        f15.style.display = "none";
        f16.style.display = "none";
        f14.style.position = "relative";
        f14.style.top = "70px";
        f11.style.display = "none";
        trabajadores.style.position = "relative";
        trabajadores.style.top = "-80px";


        document.getElementById("lbldeposito").innerHTML = "FECHA DE LIQUIDACION";

    //DEPOSITO
    } else if (n == 1) {
        form1.style.position = "relative";
        form1.style.top = "-140px";

        f14.style.top = "690px";
        f4.style.display = "none";
        f6.style.display = "none";
        f5.style.display = "none";
        f7.style.display = "none";
        f17.style.display = "none";
        f11.style.display = "none";
        f11.style.display = "none";

        document.getElementById("lbldeposito").innerHTML = "FECHA DEPOSITO";



    // GASTOS    
    } else if (n == 2) {
        f4.style.display = "none";
        f6.style.display = "none";
        f5.style.display = "none";
        f7.style.display = "none";
        f11.style.display = "none";
        form1.style.position = "relative";
        form1.style.top = "-150px";

        f14.style.position = "relative";
        f14.style.top = "700px";
        document.getElementById("lbldeposito").innerHTML = "FECHA GASTOS";





    //LIQIDACION MOTORIZADO
    } else if (n == 3) {
        f4.style.display = "none";
        f3.style.display = "none";
        f7.style.display = "none";
        f15.style.display = "none";
        f11.style.display = "none";
            
        form3.style.position = "relative";
        form3.style.top = "-800px";

        f14.style.position = "relative";
        f14.style.top = "70px";


        document.getElementById("lbldeposito").innerHTML = "F. LIQUIDACION MOTORIZADO";

    //SUELDO   
    } else if (n == 4) {
        f1.style.display = "none";
        f4.style.display = "none";
        f5.style.display = "none";
        f8.style.display = "none";
        f10.style.display = "none";
        f11.style.display = "none";
        f14.style.position = "relative";
        f14.style.top = "560px";
        trabajadores.style.position = "relative";
        trabajadores.style.top = "-150px";


        document.getElementById("lbldeposito").innerHTML = "FECHA SUELDO";

    //BONO
    } else if (n == 5) {
        f1.style.display = "none";
        f4.style.display = "none";
        f5.style.display = "none";
        f8.style.display = "none";
        f10.style.display = "none";
        f11.style.display = "none";

        trabajadores.style.position = "relative";
        trabajadores.style.top = "-150px";

        f14.style.position = "relative";
        f14.style.top = "580px";

        document.getElementById("lbldeposito").innerHTML = "FECHA BONO";
    //COMISION
    } else if (n == 6) {
        f1.style.display = "none";
        f4.style.display = "none";
        f5.style.display = "none";
        f8.style.display = "none";
        f10.style.display = "none";
        f11.style.display = "none";
        f14.style.position = "relative";
        f14.style.top = "580px";

        document.getElementById("lbldeposito").innerHTML = "FECHA COMISION";
        nombreusuario.style.display = "none";

    //LIQUIDACION PERSONAL
    } else if (n == 7) {
        f1.style.display = "none";
        f4.style.display = "none";
        f5.style.display = "none";
        f8.style.display = "none";
        f10.style.display = "none";
        f11.style.display = "none";
        f14.style.position = "relative";
        f14.style.top = "580px";


        document.getElementById("lbldeposito").innerHTML = "F. LIQUIDACION PERSONAL";
    //ADELANTO
    } else if (n == 8) {
        f1.style.display = "none";
        f4.style.display = "none";
        f5.style.display = "none";
        f8.style.display = "none";
        f10.style.display = "none";

        f19.style.display = "none";
        f14.style.position = "relative";
        f14.style.top = "580px";

        // f20.style.position = "absolute";


        document.getElementById("lbldeposito").innerHTML = "FECHA DE ADELANTO";


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
            document.getElementById("selectmotorizado").disabled=false;



        }else{
            document.getElementById("inputoperacion").disabled=true;
            document.getElementById("selectbanco").disabled=true;
            document.getElementById("fechavoucher").disabled=true;
            document.getElementById("selectmotorizado").disabled=true;
            document.getElementById("horavoucher").disabled=true;

            document.getElementById("inputoperacion").value="";
            document.getElementById("selectbanco").value="";
            document.getElementById("fechavoucher").value="";
            document.getElementById("horavoucher").value="";
            document.getElementById("selectmotorizado").value="";



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
            document.getElementById("selectmotorizado").disabled=false;


        }else{

            document.getElementById("inputoperacion").disabled=true;
            document.getElementById("selectbanco").disabled=true;
            document.getElementById("fechavoucher").disabled=true;
            document.getElementById("horavoucher").disabled=true;
            document.getElementById("selectmotorizado").disabled=true;

            document.getElementById("inputoperacion").value="";
            document.getElementById("selectbanco").value="";
            document.getElementById("fechavoucher").value="";
            document.getElementById("horavoucher").value="";
            document.getElementById("selectmotorizado").value="";



        }

    });
}

function irEgresos(){
    location.href = "registro.php";
}


function subir() {
    cadena="";
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

    if(document.getElementById("factura").checked){
        documento = "FACTURA";
    }
    else{
        documento = "BOLETA";
    }

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
        deposito = "CTA TERCEROS";
    }



    cuentaterceros = document.getElementById("cuentaterceros").value;
    nautorizacion = document.getElementById("nautorizacion").value;
    tipotrabajador = document.getElementById("tipotrabajador").value;
    periodotrabajador = document.getElementById("periodotrabajador").value;
    trabajador = document.getElementById("trabajador").value;
    opmonto = document.getElementById("opmonto").value;
    areatxt = document.getElementById("areatxt").value;
    montotrabajador = document.getElementById("montotrabajador").value;
    tipotrabajador = document.getElementById("tipotrabajador").value;

    
    ///aqui

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.response);
            }
        };
        console.log()
        xmlhttp.open("POST", "./insertar.php",true);
        data = new FormData();
        sql="INSERT INTO formulario VALUES (null,'"+nombreusuario
        +"', '"+concepto
        +"', '"+fregistro
        +"', '"+conceptofecha
        +"', '"+montoform
        +"', '"+empresa
        +"', '"+cjdestino
        +"', '"+selectmotorizado
        +"', '"+ref
        +"', '"+nautorizacion
        +"', '"+tipotrabajador
        +"', '"+periodotrabajador
        +"', '"+trabajador
        +"', '"+opmonto
        +"', '"+montotrabajador
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
        // +"', '"+cuentaterceros
        +"', '"+observaarea+"');";

        // data.append("query",sql)
    xmlhttp.send(data);

    document.getElementById("contenedor1").reset();

    console.log(sql);
    // cartg=window.open("index.php","_self");
    // cartg.location.reload();

}



// function ajax(){
//     var xmlhttp= new XMLHttRequest();
//     xmlhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {

//         }
//     }
//     xmlhttp.open("GET", "./index?op=");
//     xmlhttp.send();
// }

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>insercion Datos</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/estilos_form.css">
    <link rel="stylesheet" href="../../css/login.css">
    <style>
        body{
            padding-bottom: 40px;
        }
        table{
            width: max-content;
            margin-bottom: 0;
        }
        td{
            padding: 5px 15px;
            /* border: 1px solid black; */
        }
        th{
            border-left: 1px #337afb dashed;
            padding: 5px 15px;
        }
        .invent,.cinvent{
            width: 95%;
            max-width: max-content;
            margin: auto;
            overflow-x: scroll;
            max-height: 450px;
        }
        .invent::-webkit-scrollbar{
            background: white;
            height: 5px;
            width: 5px;
        }
        .invent::-webkit-scrollbar-thumb{
            background: green;
            border-radius: 5px;
        }
        
        .invent::-webkit-scrollbar{
            background: white;
            height: 5px;
        }
        .invent::-webkit-scrollbar-thumb{
            background: green;
            border-radius: 5px;
        }

        .cinvent>table>thead>tr>th:nth-child(1),
        .invent>table>tbody>tr>td:nth-child(1){
            width: 30px;
        }
        .cinvent>table>thead>tr>th:nth-child(2),
        .cinvent>table>thead>tr>th:nth-child(5),
        .cinvent>table>thead>tr>th:nth-child(7),
        .cinvent>table>thead>tr>th:nth-child(8),
        .cinvent>table>thead>tr>th:nth-child(10),
        .cinvent>table>thead>tr>th:nth-child(11),
        .cinvent>table>thead>tr>th:nth-child(12),
        .cinvent>table>thead>tr>th:nth-child(13),
        .cinvent>table>thead>tr>th:nth-child(14),
        .invent>table>tbody>tr>td:nth-child(2),
        .invent>table>tbody>tr>td:nth-child(5),
        .invent>table>tbody>tr>td:nth-child(7),
        .invent>table>tbody>tr>td:nth-child(8),
        .invent>table>tbody>tr>td:nth-child(10),
        .invent>table>tbody>tr>td:nth-child(11),
        .invent>table>tbody>tr>td:nth-child(12),
        .invent>table>tbody>tr>td:nth-child(13),
        .invent>table>tbody>tr>td:nth-child(14){
            width: 150px;
        }
        
        .cinvent>table>thead>tr>th:nth-child(3),
        .cinvent>table>thead>tr>th:nth-child(4),
        .invent>table>tbody>tr>td:nth-child(3),
        .invent>table>tbody>tr>td:nth-child(4){
            width: 120px;
        }
        
        .cinvent>table>thead>tr>th:nth-child(6),
        .invent>table>tbody>tr>td:nth-child(6){
            width: 192px;
        }
        .cinvent>table>thead>tr>th:nth-child(9),
        .invent>table>tbody>tr>td:nth-child(9){
            width: 290px;
        }
        .invent>table>tbody>tr>td{
            user-select: text;
        }
    </style>
</head>
<body>
    <?php include("../../header.php") ?>
    <div id='blur2' onclick='abrir_codigo(2)'></div>
    <div id='bg' class='bg'>
        <div  id="group" class="form-box" style="display:none">
            <form id="regis_code">
                <h2 style="text-align:center;">CREAR CODIGO</h2>
                <div class="packform">
                    <label>Codigo: </label>
                    <input type="text" name="ingreso_codigo" id="ingreso_codigo">
                </div>
                
                <div class="packform">
                    <label>Producto: </label>
                    <select name="ingreso_producto" id="ingreso_producto" onchange="tipoIngresoProducto(this.value);">
                        <option value="1">Equipo</option>
                        <option value="2">Chip</option>
                    </select>
                </div>
    
                <div id="pack_ingreso_marca" class="packform">
                    <label>Marca: </label>
                    <input type="text" name="ingreso_marca" id="ingreso_marca">
                </div>
                
                <div class="packform">
                    <label>Modelo: </label>
                    <input type="text" name="ingreso_modelo" id="ingreso_modelo">
                </div>
    
                <div id="pack_ingreso_color" class="packform">
                    <label>Color: </label>
                    <input type="text" name="ingreso_color" id="ingreso_color">
                </div>
                <button type="submit" class="submit-btn">CREAR CODIGO</button>
            </form>
        </div>
        <div id="group1" class="form-box" style="display: flex;justify-content: space-evenly;width: 80%;margin: auto;">
            <form id="edit_code">
                <h2 style="text-align:center;">CODIGOS</h2>
                <div class="packform">
                    <label>Codigo: </label>
                    <input type="text" id="actu_codigo2" disabled>
                    <input type="hidden" name="actu_codigo" id="actu_codigo">
                </div>
                
                <div class="packform">
                    <label>Producto: </label>
                    <select name="actu_producto" id="actu_producto" onchange="tipoActuProducto(this.value);">
                        <option value="1">Equipo</option>
                        <option value="2">Chip</option>
                    </select>
                </div>
    
                <div id="pack_actu_marca" class="packform">
                    <label>Marca: </label>
                    <input type="text" name="actu_marca" id="actu_marca">
                </div>
                
                <div class="packform">
                    <label>Modelo: </label>
                    <input type="text" name="actu_modelo" id="actu_modelo">
                </div>
    
                <div id="pack_actu_color" class="packform">
                    <label>Color: </label>
                    <input type="text" name="actu_color" id="actu_color">
                </div>
                <button type="submit" class="submit-btn">EDITAR CODIGO</button>
            </form>
            <div style="width: 50%;margin: 5px 0;">
                <div id="headCode" class="cinvent" style="overflow: hidden;">
                    <table>
                        <thead>
                            <th>N°</th>
                            <th>CODIGO</th>
                            <th>PRODUCTO</th>
                            <th>MARCA</th>
                            <th>COLOR</th>
                            <th>MODELO</th>
                            <th>ELIMINAR</th>
                        </thead>
                    </table>
                </div>
                <div onscroll="document.getElementById('headCode').scrollLeft=this.scrollLeft;" class="invent" style="height: 80%;">
                    <table id="listGuia">
                        <tbody>
                            <tr onclick="mandarCode(this.children)">
                                <td>1</td>
                                <td>CODIGO</td>
                                <td>PRODUCTO</td>
                                <td>MARCA</td>
                                <td>COLOR</td>
                                <td>MODELO</td>
                                <td>ELIMINAR</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="formulario">
        <h1 style="text-align: center;">INGRESO DE EQUIPOS</h1>
        <div class="flex">
            <input type="hidden" name="fecha_registro" id="fecha_registro">

            <div class="packform derecha">
                <div class="packform mitad">
                    <label>Locacion actual: </label>
                    <input type="text" disabled="true" value="Locacion prueba" name="locacion_ingreso" id="locacion_ingreso">
                </div>
            </div>
            <div style="width: 98%;">
                <div class="borde flex">
                    <span>OPERACION</span>
                    <div class="packform" style="width: 98%;">
                        <label> </label>
                        <select onchange="insal(this.value)" name="" id="">
                            <option value="1">INGRESO</option>
                            <option value="2">SALIDA</option>
                        </select>
                    </div>
                    <div id="prov" class="packform" style="width: 98%;">
                        <label>Proveedor: </label>
                        <select id="proovedor">
                            <option value="1">CLARO</option>
                            <option value="2">OLO</option>
                        </select>
                    </div>
                </div>
            </div>
            <form class="borde" id="ingreso" style="width: 98%;">
                <div class="packform derecha">
                    <div class="packform">
                        <label>Codigo: </label>
                        <input id="codigo_guia" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' type="text" oninput='busqueda();'>
                        <input type="button" value="..." style="width: fit-content;" onclick="abrir_codigo(3)">
                    </div>
                </div>
                <div class="packform borde" style="display: flex;width: 30%;float: right;flex-wrap: wrap;">
                    <span>N° de digitos de: </span>
                    <label style="width: 40%;">IMEI: </label>
                    <input type="text" name="" id="maxIMEI" style="width: 50%;" value="15">
                    <label style="width: 40%;">ICC: </label>
                    <input type="text" name="" id="maxICC" style="width: 50%;" value="18">
                </div>

                <div class="packform mitad">
                    <label>Guia: </label>
                    <input id="guiaclaro" type="text" name="" id="">
                </div>
                
                <div class="packform mitad">
                    <label>Fecha de Factura: </label>
                    <input id="ff" type="date">
                </div>
    
                <div class="packform mitad">
                    <label>Fecha de Ingreso: </label>
                    <input id="fi" type="date">
                </div>    
            
                <div class="packform mitad">
                    <label>Empresa: </label>
                    <select id="empresa">
                        <option value="DEPROVE">DEPROVE</option>
                        <option value="KOMUNICATE">KOMUNICATE</option>
                    </select>
                </div>

                <div id="ingresoCelu">
                    
                    <div class="packform mitad">
                        <label>Producto: </label>
                        <select id="producto" disabled="true">
                            <option value="0">Ponga un codigo</option>
                        </select>
                    </div>
        
                    <div class="packform mitad">
                        <label>Marca: </label>
                        <select id="marca" disabled="true">
                            <option value="0">Ponga un codigo</option>
                        </select>
                    </div>
                    
                    <div class="packform mitad">
                        <label>Modelo: </label>
                        <select id="modelo" disabled="true">
                            <option value="0">Ponga un codigo</option>
                        </select>
                    </div>
        
                    <div class="packform mitad">
                        <label>Color: </label>
                        <select disabled="true" id="color">
                            <option value="0">Ponga un codigo</option>
                        </select>
                    </div>
                </div>
                
                <div class="packform mitad">
                    <label>Valorización: </label>
                    <input type="text" id="valor" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode ==46;' />
                </div>
                <div class="packform descripcion">
                    <label>Descripcion: </label>
                    <input id="descripcion" type="text" id="descripcion">
                </div>
            </form>

        <form class="packform borde" style="display:none; width: 98%;" id="salida">
            <div class="packform mitad">
                <label>Locacion llegada: </label>
                <input type="text" name="" id="locacion_llegada">
            </div>
            <div class="packform mitad">
                <label>Transportador: </label>
                <input type="number" name="" id="dni_transportador">
            </div>
            <div class="packform">
                <label>Producto: </label>
                <select onchange="tipoProducto(this.value);" >
                    <option value="1">Equipo</option>
                    <option value="2">Chip</option>
                </select>
            </div>
        </form>

        <div id="navimei" class="packform borde" style="flex-wrap: wrap; display:none;">
            <span>ICC/IMEI</span>
            <div id="CCIC" class="packform mitad">
                <label id="lbl_cci">ICC: </label>
                <input id="CCI" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" oninput="cargacci()">
            </div>
            <div id="CCI2C" class="mitad packform" style="display: block;">
                <div>
                    <input type="checkbox" id="ICC2CH" onclick="activados(this.checked)" style="width: 20px;height: 20px;margin: 0;">
                    <label id="lbl_cci2">HASTA: </label>
                </div>
                <input id="CCI2" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" oninput="cargacci()" disabled style="border: 1px solid #fff;">
            </div>
        </div>
    </div>
    </div>

    <div id="cinvent" class="cinvent" style="overflow: hidden;">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Guia claro</th>
                    <th>Fecha factura</th>
                    <th>Fecha ingreso</th>
                    <th>Codigo de equipo</th>
                    <th>ICC/IMEI</th>
                    <th>Producto</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Color</th>
                    <th>Empresa</th>
                    <th>Valorizacion</th>
                    <th>Descripcion</th>
                    <th style="padding: 5px 18px;">Funciones</th>
                </tr>
            </thead>
        </table>
    </div>
    <div onscroll="mover(this.scrollLeft)" id="invent" class="invent">
        <table>
            <tbody id="mostrarprod">

            </tbody>
        </table>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
<script src="https://code.jquery.com/jquery-latest.js"></script>
<script>
    //   alertify.confirm("Titulo","cuerpo","onaccept","oncancel")
    carcar=setTimeout(function(){console.log("");},1);
    
    var cont=0,conteo=0,edita=0;

    let datos=[];
    
    let Aproducto=['','Equipo','Chip'];
    decimales=0;

    default_producto=document.getElementById("ingresoCelu").innerHTML;
    
    
    var fechaf=document.getElementById("ff"),fechai=document.getElementById("fi"),prov=document.getElementById("prov"),fechaf_c=document.getElementById("ff-c"),
    hoy=new Date().toISOString().split("T")[0];

    fechaf.value=hoy;
    fechai.value=hoy;
    document.getElementById("fecha_registro").value=hoy;

    fechaf.max = hoy;
    fechai.max = hoy;
    abrir=1;
    
    tipoProducto(1);
    llenar_prov();
    $("#group").slideUp();
    $("#group1").slideUp();

    function listarCodigos(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.response=="" || this.response==null){
                    document.getElementById("ingresoCelu").innerHTML=default_producto;
                }
                else{
                    tbody=document.createElement("tbody");
                    tbody.innerHTML=this.response;
                    document.getElementById("listGuia").innerHTML=tbody.outerHTML;
                }
            }
        };
        xmlhttp.open("GET","../subir.php?q=listarCodigos",true);
        xmlhttp.send();
    }

    function mover(n){
        document.getElementById("cinvent").scrollLeft=n;
    };

    function mandarCode(childs){
        document.getElementById("actu_codigo2").value=(childs[1].innerText);
        document.getElementById("actu_codigo").value=(childs[1].innerText);
        if(childs[2].innerText=="Chip"){
            document.getElementById("actu_producto").value=(2);
            tipoActuProducto(2);
        }
        else{
            document.getElementById("actu_producto").value=(1);
            tipoActuProducto(1);
        }
        document.getElementById("actu_marca").value=(childs[3].innerText);
        document.getElementById("actu_color").value=(childs[4].innerText);
        document.getElementById("actu_modelo").value=(childs[5].innerText);
    }
    
    function eliminarCode(n){
        if(confirm("¿Desea eliminar el código"+n+"?")){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(this.response!=null){
                        console.log(this.response);
                        alertify.success("Se eliminó el codigo "+n)
                        document.getElementById("Code_"+n).outerHTML="";
                        document.getElementById("edit_code").reset(); 
                    }
                    else{
                        console.log(this.response);
                    }
                }
            };
            xmlhttp.open("POST","../subir.php?q=eliminarCode");
            var data = new FormData();
            data.append("codigo",n);
            xmlhttp.send(data);
        }
    }

    function maximoDigitos(id,max){
        elemento=document.getElementById(id);
        console.log(elemento.value.length);
        if(elemento.value.length>=max){
            elemento.value=elemento.value.substring(0,max);
        }
    }

    function abrir_codigo(abrir){
        if(abrir==1){
            $("#blur2").addClass("filter");
            $("#bg").slideDown();
            $("#group").slideDown();
        }
        else if(abrir==2){
            $("#bg").slideUp();
            setTimeout(function() {
                tipoIngresoProducto(1);
                tipoActuProducto(1);
                $("#blur2").removeClass("filter");
                $("#group").slideUp();
                $("#group1").slideUp();
                document.getElementById("edit_code").reset(); 
                document.getElementById("regis_code").reset(); 
            },500);
        }
        else if(abrir==3){
            listarCodigos();
            $("#blur2").addClass("filter");
            $("#bg").slideDown();
            $("#group1").slideDown();
        }
    }

    function tipoProducto(n){
        if(n==null){
            n=document.getElementById("producto").value;
        }
        if(n==1){
            document.getElementById('CCIC').style.width='98%'; 
            document.getElementById('CCI2C').style.display='none'; 
            document.getElementById('lbl_cci').innerHTML='IMEI: ';
        }
        else if(n==2){
            $('#CCI2C').slideDown();
            document.getElementById('CCIC').style.width='';  
            activados(false);
        }
    }

    function tipoIngresoProducto(n) {
        if(n==1){
            //Equipo
            document.getElementById("ingreso_color").value="";
            
            document.getElementById("group").style.height="365px";
            document.getElementById("pack_ingreso_marca").style.display="flex";
            document.getElementById("pack_ingreso_color").style.display="flex";
        }
        else if(n==2){
            //Chip
            
            document.getElementById("group").style.height="265px";
            document.getElementById("ingreso_color").value="BLANCO";
            document.getElementById("pack_ingreso_marca").style.display="none";
            document.getElementById("pack_ingreso_color").style.display="none";
        }
    }

    function tipoActuProducto(n) {
        if(n==1){
            //Equipo
            document.getElementById("actu_color").value="";
            
            document.getElementById("group1").style.height="365px";
            document.getElementById("pack_actu_marca").style.display="flex";
            document.getElementById("pack_actu_color").style.display="flex";
        }
        else if(n==2){
            //Chip
            
            document.getElementById("group1").style.height="265px";
            document.getElementById("actu_color").value="BLANCO";
            document.getElementById("pack_actu_marca").style.display="none";
            document.getElementById("pack_actu_color").style.display="none";
        }
    }

    function llenar_prov(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.response);
                if(this.response=="" || this.response==null){
                    setTimeout(llenar_prov(),-50);
                }
                else{
                    prov=document.getElementById("proovedor");
                    prov.innerHTML=this.response;
                }
            }
        };
        xmlhttp.open("GET","../subir.php?q=llenar_prov",true);
        xmlhttp.send();
    }
    function buscar(n){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.response==15){
                    document.getElementById("ingresoCelu").innerHTML=default_producto;
                    if(confirm("No se encontró el codigo '"+n+"' :c\n¿Desea crearlo?")){
                        abrir_codigo(1);
                        document.getElementById("ingreso_codigo").value=n;
                    }
                }
                else{
                    document.getElementById("navimei").style.display="flex";
                    document.getElementById("ingresoCelu").innerHTML=this.response;
                    alertify.success("Encontrado :D");
                }
                tipoProducto();
            }
        };
        xmlhttp.open("GET","../subir.php?q=encontrarCodigo&codigo="+n,true);
        xmlhttp.send();
    }

    function busqueda(){;
        clearTimeout(carcar);
        carcar=setTimeout(function(){
            ce=document.getElementById("codigo_guia").value;
            //chip 7 digitos
            //equipo 8 digitos
            if(ce.length==7 ||ce.length==8){
                alertify.warning("buscando, por favor espere");
                buscar(document.getElementById("codigo_guia").value);
            }
            else if(ce.length>8){
                alertify.error("numero muy grande ("+ce.length+")");
            }
            else{
                document.getElementById("ingresoCelu").innerHTML=default_producto;
                document.getElementById("navimei").style.display="none";
            }
            console.log(ce+"\n"+ce.length);
        },1000);
    }

    function activados(bool){
        lbl_cci=document.getElementById("lbl_cci");
        lbl_cci2=document.getElementById("lbl_cci2");
        cci2=document.getElementById("CCI2");
        if(bool){
            lbl_cci.innerText="DESDE: ";
            lbl_cci2.innerText="HASTA: ";
            cci2.disabled=false;
            cci2.style.border= "1px solid rgb(18 255 255)";
        }
        else{
            lbl_cci.innerText="ICC: ";
            lbl_cci2.innerText="CONSECUTIVOS";
            cci2.disabled=true;
            cci2.style.border= "1px solid #fff";
        }
    }

    function cargacci(){
        clearTimeout(carcar);
        carcar=setTimeout(function(){
            cci=document.getElementById("CCI").value;
            producto=document.getElementById("producto").value;
            cg=document.getElementById("guiaclaro").value;
            console.log(cci.length);
            maxIMEI=document.getElementById("maxIMEI").value;
            maxICC=document.getElementById("maxICC").value;
            if(cg==null || cg==""){
                document.getElementById("CCI").value="";
                alertify.error("Falta colocar la guia");
            }
            else{
                if(producto==1){
                    if(cci.length==maxIMEI){
                        cciMasivo(cci);
                        document.getElementById("CCI").value="";
                    }
                    else if(cci.length>maxIMEI){
                        console.log("el número es muy largo");
                    }
                }
                else if(producto==2 && document.getElementById("ICC2CH").checked){
                    cci2=document.getElementById("CCI2").value;
                    if(cci.length==maxICC && cci2.length==maxICC){
                        cciCoorelativo();
                    }
                    else if(cci.length==maxICC){
                        document.getElementById("CCI2").focus();
                    }
                    else if(cci.length>maxICC){
                        alert("El número es muy largo")
                    }
                }
                else if(producto==2){
                    if(cci.length==maxICC){
                        cciMasivo(cci);
                        document.getElementById("CCI").value="";
    
                    }
                    else if(cci.length>maxICC){
                        alert("El número es muy largo")
                    }
                }
                else{
                    document.getElementById("CCI").value="";
                    alert("por favor use un codigo");
                }
            }
        },5);
    }

    function cciMasivo(cci){
        ce=document.getElementById("CCI").value;
        ce=document.getElementById("codigo_guia").value,
        prov=document.getElementById("proovedor").value,
        gc=document.getElementById("guiaclaro").value,
        fr=document.getElementById("fecha_registro").value,
        ff=document.getElementById("ff").value,
        fi=document.getElementById("fi").value,
        empresa=document.getElementById("empresa").value,
        marca=document.getElementById("marca").options[document.getElementById("marca").selectedIndex].text,
        modelo=document.getElementById("modelo").options[document.getElementById("modelo").selectedIndex].text,
        producto=document.getElementById("producto").options[document.getElementById("producto").selectedIndex].text,
        color=document.getElementById("color").options[document.getElementById("color").selectedIndex].text,
        valor=document.getElementById("valor").value,
        descripcion=document.getElementById("descripcion").value;
        conteo+=1
        cont=conteo;
        datos[cont-1]=[gc,prov,fr,ff,fi,ce,cci,document.getElementById("empresa").value,valor,descripcion];
        cadena=document.createElement("tr");
        cadena.id="Prod"+cont;
        cadena.class="producto";
        cadena.innerHTML="<td id='cont"+cont+"'>"+cont+
                "</td><td id='gc"+cont+"'>"+gc+
                "</td><td id='ff"+cont+"'>"+ff+
                "</td><td id='fi"+cont+"'>"+fi+
                "</td><td id='ce"+cont+"'>"+ce+
                "</td><td id='_CCI"+cont+"'>"+cci+
                "</td><td id='producto"+cont+"'>"+producto+
                "</td><td id='marca"+cont+"'>"+marca+
                "</td><td id='modelo"+cont+"'>"+modelo+
                "</td><td id='color"+cont+"'>"+color+
                "</td><td id='empresa"+cont+"'>"+empresa+
                "</td><td id='valor"+cont+"'> S/."+valor+
                "</td><td id='descripcion"+cont+"'>"+descripcion+
                '</td><td id="funciones'+cont+'" class=""><input value="✎" type="button" onclick="actualizar('+cont+');" class="btn-actu-prod"><input value="🗑" type="button" onclick="eliminar('+cont+');" class="btn-remo-prod">'+
                "</td>"
            document.getElementById("mostrarprod").append(cadena);
    }
    
    function cciCoorelativo(){
        inicio=0;fin=0;
        cci= document.getElementById("CCI").value;
        cci2=document.getElementById("CCI2").value;
        if(cci.length==maxICC){
            if(cci2.length==maxICC||cci2.length==0){
                inicio=parseInt(cci.substring(cci.length-5,cci.length));
                if(cci2.length==0){fin=inicio+1;}
                else{fin=parseInt(cci2.substring(cci2.length-5,cci2.length));}
                if(fin>inicio){
                    ccifijo=cci.substring(0,cci.length-5);
                    ce=document.getElementById("codigo_guia").value,
                    gc=document.getElementById("guiaclaro").value,
                    prov=document.getElementById("proovedor").value,
                    fr=document.getElementById("fecha_registro").value,
                    ff=document.getElementById("ff").value,
                    fi=document.getElementById("fi").value,
                    empresa=document.getElementById("empresa").options[document.getElementById("empresa").selectedIndex].text,
                    modelo=document.getElementById("modelo").options[document.getElementById("modelo").selectedIndex].text,
                    producto=document.getElementById("producto").options[document.getElementById("producto").selectedIndex].text,
                    valor=document.getElementById("valor").value,
                    descripcion=document.getElementById("descripcion").value;
                    inicio=inicio-1;
                    if(cci2.length==0){fin=inicio+1;}
                    total=fin-inicio;
                    while(inicio<fin){
                        console.log(inicio+" ~ "+fin);
                        inicio+=1;
                        conteo+=1;
                        cont=conteo;
                        datos[cont-1]=[gc,prov,fr,ff,fi,ce,ccifijo+inicio,document.getElementById("empresa").value,valor,descripcion];
                        cadena=document.createElement("tr");
                        cadena.id="Prod"+cont;
                        cadena.class="producto";
                        cadena.innerHTML="<td id='cont"+cont+"'>"+cont+
                                "</td><td id='gc"+cont+"'>"+gc+
                                "</td><td id='ff"+cont+"'>"+ff+
                                "</td><td id='fi"+cont+"'>"+fi+
                                "</td><td id='ce"+cont+"'>"+ce+
                                "</td><td id='_CCI"+cont+"'>"+ccifijo+inicio+
                                "</td><td id='producto"+cont+"'>"+producto+
                                "</td><td id='marca"+cont+"'>---"+
                                "</td><td id='modelo"+cont+"'>"+modelo+
                                "</td><td id='color"+cont+"'>---"+
                                "</td><td id='empresa"+cont+"'>"+empresa+
                                "</td><td id='valor"+cont+"'> S/."+valor+
                                "</td><td id='descripcion"+cont+"'>"+descripcion+
                                '</td><td id="funciones'+cont+'" class=""><input value="✎" type="button" onclick="actualizar('+cont+');" class="btn-actu-prod"><input value="🗑" type="button" onclick="eliminar('+cont+');" class="btn-remo-prod">'+
                                "</td>"
                            document.getElementById("mostrarprod").append(cadena);
                    }
                    document.getElementById("CCI").value="";
                    document.getElementById("CCI2").value="";
                    alertify.success("Se cargó un total de "+total+" registros")
                }
                else{
                    alertify.error("El ICC limite es menor que el de inicio");
                }
            }
            else{
                alertify.error("El ICC limite no es correcto("+cci2.length+")");
            }
        }
        else{
            console.log("El ICC es muy corto para chip");
        }
    }

    function subir(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.response);
                if(this.response!=null){
                    var data=$.parseJSON(this.response);
                    if(data[0]=="Subido"){
                        alertify.success("se subieron todos los datos");
                        document.getElementById("mostrarprod").innerHTML="";
                        datos=[];
                        conteo=0;

                    }
                    else if(data[0]=="Dupli"){
                        i=0;
                        alertify.error("Se encontraron ICC/IMEI duplicados");
                        alertify.success("Se subieron los datos que no estan duplicados");
                        while(i<data[1].length){
                            console.log(data[1][i]);
                            document.getElementById("Prod"+(data[1][i]+1)).style.background="red";
                            i++;
                        }
                    }
                    else{
                        alertify.error("Ocurrio un error");
                        for(n=0;n<data.length;n++){
                            console.log(data[n]);
                        }
                    }
                }
            }
        };
        xmlhttp.open("POST","../subir.php?q=subirTabla");
        var data = new FormData();
        data.append("data",JSON.stringify(datos));
        xmlhttp.send(data);
    }

    function modifActualizar(){
        cont=edita;
        document.getElementById("guiaclaro").disabled=false;
        document.getElementById("ff").disabled=false;
        document.getElementById("fi").disabled=false;
        document.getElementById("empresa").disabled=false;
        document.getElementById("proovedor").disabled=false;

        CCI=document.getElementById("CCI").value;
        ce=document.getElementById("codigo_guia").value,
        prov=document.getElementById("proovedor").value,
        gc=document.getElementById("guiaclaro").value,
        fr=document.getElementById("fecha_registro").value,
        ff=document.getElementById("ff").value,
        fi=document.getElementById("fi").value,
        empresa=document.getElementById("empresa").value,
        marca=document.getElementById("marca").options[document.getElementById("marca").selectedIndex].text,
        modelo=document.getElementById("modelo").options[document.getElementById("modelo").selectedIndex].text,
        producto=document.getElementById("producto").options[document.getElementById("producto").selectedIndex].text,
        color=document.getElementById("color").options[document.getElementById("color").selectedIndex].text,
        valor=document.getElementById("valor").value,
        descripcion=document.getElementById("descripcion").value;
        
        cadena=
            "<tr class='producto' id='Prod"+cont+"'><td id='cont"+cont+"'>"+cont+
            "</td><td id='gc"+cont+"'>"+gc+
            "</td><td id='ff"+cont+"'>"+ff+
            "</td><td id='fi"+cont+"'>"+fi+
            "</td><td id='ce"+cont+"'>"+ce+
            "</td><td id='_CCI"+cont+"'>"+CCI+
            "</td><td id='producto"+cont+"'>"+producto+
            "</td><td id='marca"+cont+"'>"+marca+
            "</td><td id='modelo"+cont+"'>"+modelo+
            "</td><td id='color"+cont+"'>"+color+
            "</td><td id='empresa"+cont+"'>"+empresa+
            "</td><td id='valor"+cont+"'> S/."+valor+
            "</td><td id='descripcion"+cont+"'>"+descripcion+
            '</td><td id="funciones'+cont+'" class=""><input value="✎" type="button" onclick="actualizar('+cont+');" class="btn-actu-prod"><input value="🗑" type="button" onclick="eliminar('+cont+');" class="btn-remo-prod">'+
            "</td></tr>"
            
        document.getElementById("Prod"+edita).outerHTML= cadena;
        datos[cont-1]=[gc,prov,fr,ff,fi,ce,cci,document.getElementById("empresa").value,valor,descripcion];
        edita=0;
        document.getElementById("btnSubir").innerHTML='GRABAR';
        document.getElementById("btnSubir").onclick=function() { subir(); };
        tipoProducto();
        document.getElementById("CCI").oninput=function() { cargacci(); };
    }

    function actualizar(n){
        edita=n;
        ce=document.getElementById("ce"+n).innerHTML,
        gc=document.getElementById("gc"+n).innerHTML,
        ff=document.getElementById("ff"+n).innerHTML,
        fi=document.getElementById("fi"+n).innerHTML,
        empresa=document.getElementById("empresa"+n).innerHTML,
        CCI=document.getElementById("_CCI"+n).innerHTML,
        producto=document.getElementById("producto"+n).innerHTML,
        modelo=document.getElementById("modelo"+n).innerHTML,
        marca=document.getElementById("marca"+n).innerHTML,
        color=document.getElementById("color"+n).innerHTML,
        valor=document.getElementById("valor"+n).innerHTML,
        descripcion=document.getElementById("descripcion"+n).innerHTML;
        tipoProducto(1);
        
        if(producto=="Equipo"){
            maxIMEI=document.getElementById("maxIMEI").value;
            document.getElementById("CCI").oninput=function() { maximoDigitos(this.id,maxIMEI); };    
        }
        else if(producto=="Chip"){
            maxICC=document.getElementById("maxICC").value;
            document.getElementById('lbl_cci').innerHTML='ICC: ';
            document.getElementById("CCI").oninput=function() { maximoDigitos(this.id,maxICC); };    
        }
        
        document.getElementById("guiaclaro").disabled=true;
        document.getElementById("ff").disabled=true;
        document.getElementById("fi").disabled=true;
        document.getElementById("empresa").disabled=true;
        document.getElementById("proovedor").disabled=true;

        document.getElementById("btnSubir").onclick=function() { modifActualizar(); };
        document.getElementById("btnSubir").innerHTML='ACTUALIZAR';
        
        document.getElementById("codigo_guia").value=  ce;
        document.getElementById("guiaclaro").value=  gc;
        document.getElementById("ff").value=  ff;
        document.getElementById("fi").value=  fi;
        document.getElementById("empresa").value=  empresa;
        if(producto=="DEPROVE"){document.getElementById("empresa").value=1;}
        else{document.getElementById("producto").value=2;}
        document.getElementById("CCI").value=  CCI;
        document.getElementById("marca").options[document.getElementById("marca").selectedIndex].text=  marca;
        if(producto=="Chip"){document.getElementById("producto").value=2;}
        else{document.getElementById("producto").value=1;}
        document.getElementById("modelo").options[document.getElementById("modelo").selectedIndex].text=  modelo;
        document.getElementById("color").options[document.getElementById("color").selectedIndex].text=  color;
        document.getElementById("valor").value=  (valor.substring(4, valor.length));
        document.getElementById("descripcion").value=  descripcion ;
        

    }

    function eliminar(n){
        document.getElementById("Prod"+n).outerHTML="";
        console.log(n)
        datos.splice(n-1, 1);
        if(datos.length==0){

        }
        for(n;n<conteo;n){
            n=n+1;
            document.getElementById("Prod"+n).id="Prod"+(n-1);
            document.getElementById("cont"+n).innerHTML=(n-1);
            document.getElementById("cont"+n).id="cont"+(n-1);
            document.getElementById("ce"+n).id="ce"+(n-1),
            document.getElementById("gc"+n).id="gc"+(n-1),
            document.getElementById("ff"+n).id="ff"+(n-1),
            document.getElementById("fi"+n).id="fi"+(n-1),
            document.getElementById("empresa"+n).id="empresa"+(n-1),
            document.getElementById("_CCI"+n).id="_CCI"+(n-1),
            document.getElementById("producto"+n).id="producto"+(n-1),
            document.getElementById("modelo"+n).id="modelo"+(n-1),
            document.getElementById("marca"+n).id="marca"+(n-1),
            document.getElementById("color"+n).id="color"+(n-1),
            document.getElementById("valor"+n).id="valor"+(n-1),
            document.getElementById("descripcion"+n).id="descripcion"+(n-1);
            document.getElementById("funciones"+n).innerHTML='<input value="✎" type="button" onclick="actualizar('+(n-1)+');" class="btn-actu-prod"><input value="🗑" type="button" onclick="eliminar('+(n-1)+');" class="btn-remo-prod">';
            document.getElementById("funciones"+n).id="funciones"+(n-1);
        }
        conteo=conteo-1;
    }

    $(document).ready(function() {
        $('#regis_code').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: '../subir.php',
                data: $(this).serialize(),
                success: function(respuesta){
                    if(respuesta == "0"){
                        alertify.error('No hay conexion con la base');
                        return false;
                    }
                    else if (respuesta == "1"){
                        alertify.error('Ocurrio un Error');
                    }
                    else if (respuesta == "51"){
                        alertify.success('Se subio a la bd');
                        buscar(document.getElementById("ingreso_codigo").value);
                        abrir_codigo(2);
                        alertify.warning('Recogiendo datos');
                        document.getElementById("regis_code").reset(); 
                        tipoIngresoProducto(1);
                    }
                    else{
                        alertify.error('Error desconocido');
                        console.log(respuesta);
                    }
                }
            });
            return false;
        });
    });

    $(document).ready(function() {
        $('#edit_code').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: '../subir.php',
                data: $(this).serialize(),
                success: function(respuesta){
                    if(respuesta == "0"){
                        alertify.error('No hay conexion con la base');
                        return false;
                    }
                    else if (respuesta == "1"){
                        alertify.error('Ocurrio un Error');
                    }
                    else if (respuesta == "51"){
                        console.log(respuesta);
                        alertify.success('Se actualizó correctamente');
                        child=document.getElementById("Code_"+document.getElementById("actu_codigo").value).children;
                        child[1].innerText=document.getElementById("actu_codigo").value;
                        if(document.getElementById("actu_producto").value==2){
                            child[2].innerText="Chip";
                        }
                        else{
                            child[2].innerText="Equipo";
                        }
                        child[3].innerText=document.getElementById("actu_marca").value.toUpperCase();
                        child[4].innerText=document.getElementById("actu_color").value.toUpperCase();
                        child[5].innerText=document.getElementById("actu_modelo").value.toUpperCase();
                        document.getElementById("edit_code").reset(); 
                    }
                    else{
                        alertify.error('Error desconocido');
                        console.log(respuesta);
                    }
                }
            });
            return false;
        });
    });

    function insal(op){
        funcion=op;
        tipoProducto(1);
        if(op==1){
            $('#salida').slideUp(); //salida
            $("#ingreso").slideDown(); //ingreso
            document.getElementById("ingreso").reset(); 
            fechaf.value=hoy;
            fechai.value=hoy;
            document.getElementById("fecha_registro").value=hoy;
            document.getElementById("ingresoCelu").innerHTML=default_producto;
            $("#prov").slideDown(); //proveedor
            $("table").slideDown(); //tabla
            $("#navimei").slideUp(); //salida
        }
        if(op==2){
            $("#navimei").slideDown(); //salida
            document.getElementById("salida").style.display="block"; //salida
            document.getElementById("salida").reset(); 
            $("#ingreso").slideUp(); //ingreso
            $("#prov").slideUp(); //proveedor
            $("table").slideUp(); //tabla
        }
    }
</script>
<footer>
    <button id="btnSubir" onclick="subir();return false;">GRABAR</button>
</footer>
</html>
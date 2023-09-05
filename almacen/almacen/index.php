<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/estilos_form.css">
    <title>ALMACEN</title>
    <style>
        #encabezado{
            display: flex;
            width: 90%;
            margin: auto;
        }
        #encabezado>div{
            margin:15px;
        }
        #encabezado>div:nth-child(1)>div{
            justify-content: space-between;
        }
        #encabezado>div:nth-child(1)>div>label{
            width: 50%;
        }
        #encabezado>div:nth-child(2)>div{    
            width: max-content;
            justify-content: flex-start;
        }
        #contadorStock{
            align-items: center;
            width: 350px;
            border: 1px #337afb solid;
            margin: 0 5px;
        }
        #contadorVendidos{
            align-items: center;
            width: 350px;
            border: 1px #337afb solid;
            margin: 0 5px;
        }
        table{
            width: max-content;
            margin-bottom: 0;
        }
        select{
            min-width: 190px;
        }
        td{
            padding: 5px 15px;
        }
        th{
            border-left: 1px #337afb dashed;
            padding: 5px 14.5px;
        }
        #invent,#cinvent{
            width: 95%;
            margin: auto;
            overflow-x: scroll;
            max-height: 450px;
        }
        #invent::-webkit-scrollbar{
            background: white;
            height: 5px;
            width: 5px;
        }
        #invent::-webkit-scrollbar-thumb{
            background: green;
            border-radius: 5px;
        }
        
        #invent>div:nth-child(1)::-webkit-scrollbar{
            background: white;
            height: 5px;
        }
        #invent>div:nth-child(1)::-webkit-scrollbar-thumb{
            background: green;
            border-radius: 5px;
        }

        #invent>table>tbody>tr>td:nth-child(1),#invent>table>tbody>tr>td:nth-child(2),#invent>table>tbody>tr>td:nth-child(3),#invent>table>tbody>tr>td:nth-child(4) {
            width: 100px;
        }
        #cinvent>table>thead>tr>th:nth-child(2),
        #cinvent>table>thead>tr>th:nth-child(3),
        #cinvent>table>thead>tr>th:nth-child(5),
        #cinvent>table>thead>tr>th:nth-child(6),
        #cinvent>table>thead>tr>th:nth-child(7),
        #cinvent>table>thead>tr>th:nth-child(9),
        #cinvent>table>thead>tr>th:nth-child(10),
        #invent>table>tbody>tr>td:nth-child(5),
        #invent>table>tbody>tr>td:nth-child(6),
        #invent>table>tbody>tr>td:nth-child(8),
        #invent>table>tbody>tr>td:nth-child(9),
        #invent>table>tbody>tr>td:nth-child(12),
        #invent>table>tbody>tr>td:nth-child(13){
            width: 170px;
        }
        #cinvent>table>thead>tr>th:nth-child(4),
        #cinvent>table>thead>tr>th:nth-child(7),
        #invent>table>tbody>tr>td:nth-child(7),
        #invent>table>tbody>tr>td:nth-child(10){
            width: 280px;
        }
        #cinvent>table>thead>tr>th:nth-child(8),
        #invent>table>tbody>tr>td:nth-child(11){
            width: 190px;
        }
    </style>
</head>
<body>
    <?php include("../../header.php") ?>
    <div>

        <table id="contadorStock">
        </table>
        <div style="display:flex;flex-direction: column;display: none;">
            <div style="display: flex;">
                <div class="packform mitad">
                    DESDE:<input type="date">
                </div>
                <div class="packform mitad">
                    HASTA:<input type="date">
                </div>
            </div>
            <table id="contadorVendidos">
                <thead>
                    <tr>
                        <th colspan="3">EQUIPOS VENDIDOS</th>
                    </tr>
                </thead>
                <tr>
                    <td>LOCALIZACION</td>
                    <td>DEPROVE</td>
                    <td>KOMUNICATE</td>
                </tr>
                <tr>
                    <td>ALMACEN</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>TDA ATE</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>TDA PROCERES</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>TDA CHIMU</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>CALL CENTER</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr style="background:yellow;">
                    <td>GOBAL</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
            </table>
        </div>
    </div>
    <div id="encabezado">
        <div style="width: max-content;">
            <div class="packform">
                <label>Empresa</label>
                <select name="" id="">
                    <option value="0">--Empresa--</option>
                </select>
            </div>
            <div class="packform">
                <label>Marca</label>
                <select name="" id="">
                    <option value="0">--Modelo--</option>
                </select>
            </div>
            <div class="packform">
                <label>Modelo</label>
                <select name="" id="">
                    <option value="0">--Seleccione una marca--</option>
                </select>
            </div>
            <div class="packform">
                <label>Localización</label>
                <select name="" id="">
                    <option value="0">--Localizacion--</option>
                </select>
            </div>
        </div>
        <div class="mitad">
            <div class="packform" onclick="if(document.getElementById('busqequipos').checked){document.getElementById('busqequipos').checked=false;}else{document.getElementById('busqequipos').checked=true;} buscar()">
                <input id="busqequipos" type="checkbox" onclick="if(document.getElementById('busqequipos').checked){document.getElementById('busqequipos').checked=false;}else{document.getElementById('busqequipos').checked=true;} buscar()">
                <label>Excluir Chips</label>
            </div>
            <div class="packform" onclick="if(document.getElementById('busqstock').checked){document.getElementById('busqstock').checked=false;}else{document.getElementById('busqstock').checked=true;} buscar()">
                <input id="busqstock" type="checkbox" onclick="if(document.getElementById('busqstock').checked){document.getElementById('busqstock').checked=false;}else{document.getElementById('busqstock').checked=true;} buscar()">
                <label>Equipos en stock</label>
            </div>
            <div class="packform" onclick="if(document.getElementById('busqdesc').checked){document.getElementById('busqdesc').checked=false;}else{document.getElementById('busqdesc').checked=true;} buscar()">
                <input id="busqdesc" type="checkbox" onclick="if(document.getElementById('busqdesc').checked){document.getElementById('busqdesc').checked=false;}else{document.getElementById('busqdesc').checked=true;} buscar()">
                <label>Con descripcion</label>
            </div>
            <div class="packform">
                <label>buscar IMEI/ICC:</label>
                <input id="busqicc" type="number" oninput="buscar()" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            </div>
        </div>
        <div class="packform" style="display:none;">
            <div class="packform">
                <label>DESDE:</label>
                <input type="date" name="" id="">
            </div>
            <div class="packform">
                <label>HASTA:</label>
                <input type="date" name="" id="">
            </div>
        </div>
    </div>
    
    <h1 style="text-align: center;">ALMACEN</h1>
    <div id="cinvent" style="overflow: hidden;">
        <table>
            <thead>
                <tr>
                    <th colspan="4">FECHA</th>
                    <th rowspan="2">ICC/IMEI</th>
                    <th rowspan="2">MARCA</th>
                    <th rowspan="2">MODELO</th>
                    <th rowspan="2">COLOR</th>
                    <th rowspan="2">VALORIZACION</th>
                    <th rowspan="2">DESCRIPCION</th>
                    <th rowspan="2">LOCALIZACION</th>
                    <th rowspan="2">TRASLADADO POR</th>
                    <th rowspan="2">ESTADO</th>
                </tr>
                <tr>
                    <th style="width: 100px;">REGISTRO</th>
                    <th style="width: 100px;">FACTURA</th>
                    <th style="width: 100px;">INGRESO</th>
                    <th style="width: 100px;">VENTA</th>
                </tr>
            </thead>
        </table>
    </div>
    <div onscroll="mover(this.scrollLeft)" id="invent">
        <table id="mostrarprod">
        </table>
    </div>
</body>
<script>
    carcar=setTimeout(function(){},1);
    var cargarmas = new XMLHttpRequest();
    i=1;
    guard=1;
    td=document.createElement("td");
    tr=document.createElement("tr");
    td.setAttribute("colspan","13");
    tr.id="cargandoTabla";
    td.style.minWidth=(document.getElementById("cinvent").offsetWidth-30)+"px";
    td.innerHTML="Cargando tabla...";
    td.style.background="gray";
    td.style.color="white";
    tr.append(td);
    scrol_invent=0;
    pred="";
    hijos=tr.children;
    var busqueda = new XMLHttpRequest();
    listarProd();
    contarStockEmpresas();
    // contarVendidoEmpresas();
    document.getElementById("mostrarprod").append(tr);
    function contarStockEmpresas(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("contadorStock").innerHTML=(this.response)
            }
        }
        xmlhttp.open("GET","../subir.php?q=contarStockEmpresas",true);
        xmlhttp.send();
    }
    function contarVendidoEmpresas(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                document.getElementById("contadorVendidos").innerHTML=(this.response)
            }
        }
        xmlhttp.open("GET","../subir.php?q=contarVendidoEmpresas",true);
        xmlhttp.send();
    }
    function obtener_filtros(){
        filtros="WHERE ";
        if(document.getElementById("busqequipos").checked==true){
            filtros+=" codigos.tipo=1 and";
        }
        if(document.getElementById("busqstock").checked==true){
            filtros+=" codigos.tipo=1 and inventario.estado='STOCK' and";
        }
        if(document.getElementById("busqdesc").checked==true){
            filtros+=" inventario.descripcion!='' and";
        }
        if(document.getElementById("busqicc").value!=""){
            filtros+=" inventario.icc like '%"+document.getElementById("busqicc").value+"%' and";
        }
        filtros+=" inventario.icc>0 ";
        return filtros;

    }
    function listarProd(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            tbody=document.createElement("tbody");
            tbody.id="Prod_0";
            if(this.response==""){
                td.innerText="No hay datos en el inventario";
                td.style.background="red";
                i=0;
            }
            else{
                td.innerHTML="Cargando tabla...";
                td.style.background="gray";
                tbody.innerHTML=(this.response);
                document.getElementById("mostrarprod").append(tbody);
            }
            document.getElementById("mostrarprod").append(tr);
            }
        }
        xmlhttp.open("POST","../subir.php?q=listarProd",true);
        var data = new FormData();
        data.append("i",0);
        data.append("filtros",'');
        xmlhttp.send(data);
    }



    
    function buscar(){
        if(obtener_filtros()=="WHERE  inventario.icc>0 "){
            i=guard;
            td.style.background="gray";
            td.innerHTML="Cargando tabla...";
            document.getElementById("mostrarprod").append(tr);
            if(pred==""){
                listarProd();
            }
            else{
                document.getElementById("mostrarprod").innerHTML=pred;
                document.getElementById("invent").scrollTop=scrol_invent;
                pred="";
            }
        }
        else{
            clearTimeout(carcar);
            carcar=setTimeout(function(){
            busqueda.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    i=1;
                    if(pred==""){
                        pred=document.getElementById("mostrarprod").innerHTML;
                        scrol_invent=document.getElementById("invent").scrollTop;
                        guard=i;
                    }
                    document.getElementById("mostrarprod").innerHTML="";
                    tbody=document.createElement("tbody");
                    if(this.response==""){
                        td.innerText="No se encontraron productos con esos parametros";
                        td.style.background="red";
                        i=0;
                    }
                    else{
                        td.innerHTML="Cargando tabla...";
                        td.style.background="gray";
                        tbody.innerHTML=(this.response);
                        document.getElementById("invent").scrollTop=0;
                        document.getElementById("mostrarprod").append(tbody);
                    }
                    document.getElementById("mostrarprod").append(tr);
                }
            }
            busqueda.open("POST","../subir.php?q=listarProd",true);
            var data = new FormData();
            data.append("i",0);
            data.append("filtros",obtener_filtros());
            busqueda.send(data);
            },200);
        }
    }






    function mover(n) {
        if(document.getElementById("invent").scrollTop+document.getElementById("invent").offsetHeight>=document.getElementById("mostrarprod").offsetHeight){
            cargarmas.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(this.response==null || this.response==''){
                        td.innerText="MAXIMO";
                        td.style.background="red";
                        document.getElementById("cargandoTabla").innerHTML=tr.innerHTML;
                    }
                    else{
                        if(i>4){
                            document.getElementById("Prod_"+(i-5)).outerHTML="";
                        }
                        td.innerHTML="Cargando tabla...";
                        td.style.background="gray";
                        tbody=document.createElement("tbody");
                        tbody.id="Prod_"+i;
                        tbody.innerHTML=(this.response);
                        document.getElementById("cargandoTabla").outerHTML=(tbody.outerHTML)
                        document.getElementById("mostrarprod").append(tr);
                        setTimeout(function(){i=i+1;},100 );
                    }
                }
            }
            cargarmas.open("POST","../subir.php?q=listarProd",true);
            var data = new FormData();
            data.append("i",i);
            data.append("filtros",obtener_filtros());
            cargarmas.send(data);
        }
        else if(document.getElementById("invent").scrollTop<=document.getElementById("invent").offsetHeight){
            if(i>4){
                cargarmas.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if(this.response==null || this.response==''){
                            td.innerHTML="Cargando tabla...";
                            td.style.background="gray";
                            document.getElementById("Prod_"+(i-5)).outerHTML="";
                            tbody=document.createElement("tbody");
                            tbody.id="Prod_"+i;
                            tbody.innerHTML=(this.response);
                            document.getElementById("cargandoTabla").innerHTML=(tbody.outerHTML)+document.getElementById("cargandoTabla").innerHTML;
                            document.getElementById("mostrarprod").append(tr);
                            setTimeout(function(){i=i-1;},100 );
                        }
                    }
                }
                cargarmas.open("POST","../subir.php?q=listarProd",true);
                var data = new FormData();
                data.append("i",i-5);
                data.append("filtros",obtener_filtros());
                cargarmas.send(data);
            }
        }
        document.getElementById("cinvent").scrollLeft=n;
    };
</script>
</html>
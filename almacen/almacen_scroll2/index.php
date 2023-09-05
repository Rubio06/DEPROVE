<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/estilos_form.css">
    <title>ALMACEN</title>
    <style>
        body{
            padding-bottom: 25px;
        }
        #encabezado{
            /* height: 300px; */
            display: flex;
            width: 90%;
            margin: auto;
            /* overflow: hidden; */
            justify-content: space-between;
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
        td{
            padding: 5px 15px;
        }
        th{
            border-left: 1px #337afb dashed;
            padding: 5px 14.5px;
        }
        #scroll>table>thead>tr>th{
            background: white;
        }
        #scroll{
            overflow: scroll; 
            width: 95%;
            margin: auto;
            max-height: 450px;
        }
        #scroll::-webkit-scrollbar{
            background: white;
            height: 5px;
            width: 5px;
        }
        #scroll::-webkit-scrollbar-thumb{
            background: green;
            border-radius: 5px;
        }

        #scroll>table>tbody>tr>td:nth-child(1),
        #scroll>table>tbody>tr>td:nth-child(2),
        #scroll>table>tbody>tr>td:nth-child(3),
        #scroll>table>tbody>tr>td:nth-child(4) {
            width: 100px;
        }
        #scroll>table>thead>tr>th:nth-child(2),
        #scroll>table>thead>tr>th:nth-child(3),
        #scroll>table>thead>tr>th:nth-child(5),
        #scroll>table>thead>tr>th:nth-child(6),
        #scroll>table>thead>tr>th:nth-child(7),
        #scroll>table>thead>tr>th:nth-child(9),
        #scroll>table>thead>tr>th:nth-child(10),
        #scroll>table>tbody>tr>td:nth-child(5),
        #scroll>table>tbody>tr>td:nth-child(6),
        #scroll>table>tbody>tr>td:nth-child(8),
        #scroll>table>tbody>tr>td:nth-child(9),
        #scroll>table>tbody>tr>td:nth-child(12),
        #scroll>table>tbody>tr>td:nth-child(13){
            width: 170px;
        }
        #scroll>table>thead>tr>th:nth-child(4),
        #scroll>table>thead>tr>th:nth-child(7),
        #scroll>table>tbody>tr>td:nth-child(7),
        #scroll>table>tbody>tr>td:nth-child(10){
            width: 280px;
        }
        #scroll>table>thead>tr>th:nth-child(8),
        #scroll>table>tbody>tr>td:nth-child(11){
            width: 190px;
        }
    </style>
</head>
<body>
    <header>
        <?php include("../../header.php") ?>
    </header>
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
        <div class="packform mitad">
            <label>buscar IMEI/ICC:</label>
            <input id="busqicc" type="number" oninput="buscar()" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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
    <div id="scroll" onscroll="mover()">
        <table style="position: sticky;top: 0;" >
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
    td.style.minWidth=(document.getElementById("mostrarprod").offsetWidth-30)+"px";
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
        filtros="WHERE ";
        if(document.getElementById("busqicc").value!="" && document.getElementById("busqicc").value!=null){
            filtros+=" inventario.icc like '%"+document.getElementById("busqicc").value+"%' and";
        }
        filtros+=" inventario.icc>0 ";

        if(document.getElementById("busqicc").value==null || document.getElementById("busqicc").value==""){
            i=guard;
            td.style.background="gray";
            td.innerHTML="Cargando tabla...";
            document.getElementById("mostrarprod").append(tr);
            if(pred==""){
                listarProd();
            }
            else{
                document.getElementById("mostrarprod").innerHTML=pred;
                document.getElementById("scroll").scrollTop=scrol_invent;
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
                        scrol_invent=document.getElementById("scroll").scrollTop;
                        guard=i;
                    }
                    document.getElementById("mostrarprod").innerHTML="";
                    tbody=document.createElement("tbody");
                    if(this.response==""){
                        td.innerText="No se encontró ese codigo unico";
                        td.style.background="red";
                        i=0;
                    }
                    else{
                        td.innerHTML="Cargando tabla...";
                        td.style.background="gray";
                        tbody.innerHTML=(this.response);
                        document.getElementById("scroll").scrollTop=0;
                        document.getElementById("mostrarprod").append(tbody);
                    }
                    document.getElementById("mostrarprod").append(tr);
                }
            }
            busqueda.open("POST","../subir.php?q=listarProd",true);
            var data = new FormData();
            data.append("i",0);
            data.append("filtros",filtros);
            busqueda.send(data);
            },200);
        }
    }
    function mover() {
        filtros="WHERE ";
        if(document.getElementById("busqicc").value!="" && document.getElementById("busqicc").value!=null){
            filtros+=" inventario.icc like '%"+document.getElementById("busqicc").value+"%' and";
        }
        filtros+=" inventario.icc>0 ";
        if(document.getElementById("scroll").scrollTop+document.getElementById("scroll").offsetHeight>=document.getElementById("mostrarprod").offsetHeight){
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
            data.append("filtros",filtros);
            cargarmas.send(data);
        }
        else if(document.getElementById("scroll").scrollTop<=document.getElementById("scroll").offsetHeight){
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
                data.append("filtros",filtros);
                cargarmas.send(data);
            }
        }
    };
</script>
</html>
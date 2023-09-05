<?php
  require_once("../../coneccion.php");
  $conexion=Db::conectar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REPORTE PEDIDOS</title>
    <style>
        table{
            border-collapse: collapse;
            text-align:center;
        }
        td{
            padding:5px 10px;
        }
        td:nth-child(1){
            position:sticky;
            left:0;
        }
        td:nth-child(1)>p{
            background:white;
        }
        #max{
            width:90%;
            height:70vh;
            max-height:4000px;
            overflow:auto;
            margin:auto;
            border:1px solid black;
            border-radius:10px;
        }
        .cabeza{
            background: blue !important;
            color:white;
        }
        .cabeza2{
            min-width:300px;
            max-width:40%;
        }
        .conte-filtro{
            width: 90%;
            padding:5px 10px;
            margin: 10px auto;
            background:#959393;
            border-radius:15px;
            color:white;
        }
        .conte-filtro>div{
            display:inline-block;
        }
        #paginas{
            display: flex;
            width: 40%;
            overflow: hidden;
            margin: 10px auto;
            height: 50px;
            align-items: center;
        }
        #paginas>div{
            display: flex;
            width: 70px;
        }
        #paginas>div>button{
            width: 48%;
            height: 40px;
        }
        #paginas2{
            width: 100% !important;
            overflow: hidden;
            position: relative;
            margin: 5px;
            height: 200px;
            align-items: center;
        }
        #paginas2>div>a{
            padding: 10px 15px;
            margin: 10px;
            background: blue;
            display: inline-block;
            color: white;
            text-align:center;
        }
        #paginas2>div>a>p{
            font-size:12px;
        }
        @media only screen and (max-width: 800px) {
            .cabeza2{
                min-width:20vh;
            }
        }
        table .filter{
            position:absolute;
        }
    </style>
</head>
<body>
    <?php include("../../header.php") ?> 
      <div class="conte-filtro">
        <label for="">TRABAJADORES A MOSTRAR:</label>
        <select name="" id="cantidadamostrar" onchange="cargarTabla();">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="50">50</option>
        </select>
        <br>
        <label for="buscar">Filtrar : </label>
        <!-- <input type="text" name="buscar" id="buscar" oninput="cargarTabla();"> -->
        <div>
            <input type="checkbox" name="" id="actiFecha" onclick="activarFecha()">
            <input type="date" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date("Y-m-d"); ?>" id="buscarFecha" onchange="cargarTabla();" disabled>
        </div>
        <div>
            <input type="checkbox" name="" id="actiCargo" onclick="activarFecha()">
            <select name="" id="buscarCargo" onchange="cargarTabla();" disabled>
                <?php $con=mysqli_query($conexion, "SELECT * from cargo ORDER BY cargo ASC"); $ante="";
                while($x=mysqli_fetch_array($con)){
                    if($ante!=strtoupper(substr($x["cargo"],0,1))){
                        $ante=strtoupper(substr($x["cargo"],0,1));
                        echo '<option disabled>'.$ante.'</option>';
                    }
                    echo '<option value="'.$x["idcargo"].'">'.$x["cargo"].'</option>';
                }
                ?>
                </select>
        </div>
            <input type="checkbox" name="" id="actiEstado" onclick="activarFecha()">
            <select name="" id="buscarEstado" onchange="cargarTabla();" disabled>
                <option value="ACTIVO">ACTIVO</option>
                <option value="CESADO">CESADO</option>
            </select>
        <div>
        </div>
        <div>
            <input type="checkbox" name="" id="actiAsis" onclick="activarFecha()">
            <select name="" id="buscarAsis" onchange="cargarTabla();" disabled>
                <option value="A">ASISTIÓ</option>
                <option value="F">FALTÓ</option>
            </select>
        </div>
        <div>
            <input type="checkbox" name="" id="actiSede" onclick="activarFecha()">
            <select name="" id="buscarSede" onchange="cargarTabla();" disabled>
            <?php $con=mysqli_query($conexion, "SELECT * from sede ORDER BY sede ASC"); $ante="";
                while($x=mysqli_fetch_array($con)){
                if($ante!=strtoupper(substr($x["sede"],0,1))){
                    $ante=strtoupper(substr($x["sede"],0,1));
                    echo '<option disabled>'.$ante.'</option>';
                }
                echo '<option value="'.$x["idsede"].'">'.$x["sede"].'</option>';
                }
                ?>
            </select>
        </div>
      </div>
    </div>
    <div id="max">
        <table style="position:relative;">
            <tbody style="position:sticky;top:0;background:white;z-index:2;">
                <tr>
                    <!-- <td class="cabeza" style="left:-50px;min-width:20px;">#</td> -->
                    <td class="cabeza cabeza2" style="left:0;position:sticky;">NOMBRE DEL ASESOR</td>
                    <td class="cabeza" style="min-width:100px;">Fecha de la operacion</td>
                    <td class="cabeza" style="min-width:100px;">ESTADO</td>
                    <td class="cabeza" style="min-width:200px;">ASISTENCIA</td>
                    <td class="cabeza" style="min-width:200px;">CARGO</td>
                    <td class="cabeza" style="min-width:200px;">RECLUTADOR</td>
                    <td class="cabeza" style="min-width:200px;">COORDINADOR</td>
                    <td class="cabeza" style="min-width:150px;">TOTAL LLAMADAS</td>
                    <td class="cabeza" style="min-width:100px;" >PESO VENTA</td>
                    <td class="cabeza" style="min-width:100px;" >CUOTA</td>
                    <td class="cabeza" style="min-width:100px;" >%</td>
                    <td class="cabeza" style="min-width:100px;" >FORMULA</td>
                    <td class="cabeza" style="min-width:50px;" >VENTA</td>
                    <!-- <td class="cabeza" style="min-width:150px;">APROXIMADO TOTAL TIEMPO</td> -->
                    <td class="cabeza" style="min-width:200px;" >NO INTERESADO</td>
                    <td class="cabeza" style="min-width:200px;" >VOLVER A LLAMAR</td>
                    <td class="cabeza" style="min-width:200px;" >NO CALIFICA</td>
                    <td class="cabeza" style="min-width:200px;" >NO LLAMAR</td>
                    <td class="cabeza" style="min-width:200px;" >PROVINCIA</td>
                    <td class="cabeza" style="min-width:200px;" >NUMERO EQUIVOCADO</td>
                    <td class="cabeza" style="min-width:200px;" >USUARIO CONTESTA, NO ES EL TITULAR</td>
                    <td class="cabeza" style="min-width:200px;" >TITULAR FALLECIDO</td>
                    <td class="cabeza" style="min-width:200px;" >SU LINEA ES COORPORATIVA</td>
                    <td class="cabeza" style="min-width:200px;" >NO CONTESTA</td>
                    <td class="cabeza" style="min-width:200px;" >NUMERO NO EXISTE</td>
                    <td class="cabeza" style="min-width:200px;" >BUZON DE VOZ</td>
                    <td class="cabeza" style="min-width:200px;" >LINEA SUPENDIDA / BLOQUEADA</td>
                    <td class="cabeza" style="min-width:200px;" >NUMERO OCUPADO</td>
                    <td class="cabeza" style="min-width:200px;" >CLIENTE RECHAZA LLAMADA</td>
                </tr>
            </tbody>
            <tbody id="cuerpo">
                
            </tbody>
        </table>
    </div>
    <div id="paginas">
        <div>
            <button onclick='actuPag("--");'><<</button>
            <button onclick='actuPag("-");'><</button>
        </div>
        <div id="paginas2">
            <div style="position: absolute;width: max-content; left:0;">
            </div>
        </div>
        <div>
            <button onclick='actuPag("+");'>></button>
            <button onclick='actuPag("++");'>>></button>
        </div>
    </div>
</body>
</html>

<script>
    i=1;
    const actuPag=(op)=>{
        if(op=="+"&&(i*175<(document.getElementById("paginas2").children[0].offsetWidth-document.getElementById("paginas2").offsetWidth))){
            i++;
        }
        else if(op=="++"&&((i+1)*175<(document.getElementById("paginas2").children[0].offsetWidth-(document.getElementById("paginas2").offsetWidth)))){
            i++;i++;
        }
        else if(op=="-"&&i>0){
            i--;
        }
        else if(op=="--"&&i>1){
            i--;i--;
        }
        console.log(i);
        document.getElementById("paginas2").children[0].style.left="-"+(i*175)+"px";
        // document.getElementById("paginas2").children[0].scroll(0,(i*175));
    }
    const activarFecha = () =>{
        i=0;
        document.getElementById("paginas2").children[0].style.left="0";
        document.getElementById("buscarFecha").disabled=true;
        document.getElementById("buscarCargo").disabled=true;
        document.getElementById("buscarEstado").disabled=true;
        document.getElementById("buscarAsis").disabled=true;
        document.getElementById("buscarSede").disabled=true;
        if(document.getElementById("actiFecha").checked){
            document.getElementById("buscarFecha").disabled=false;
        }
        if(document.getElementById("actiCargo").checked){
            document.getElementById("buscarCargo").disabled=false;
        }
        if(document.getElementById("actiEstado").checked){
            document.getElementById("buscarEstado").disabled=false;
        }
        if(document.getElementById("actiAsis").checked){
            document.getElementById("buscarAsis").disabled=false;
        }
        if(document.getElementById("actiSede").checked){
            document.getElementById("buscarSede").disabled=false;
        }
        cargarTabla("buscar");
    }
    const cargarTabla= (n)=>{
        document.getElementById("cuerpo").style="height:400vh";
        document.getElementById("cuerpo").innerHTML='<div class="filter" style="height: 100%; width: 100%;"></div>';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                try {
                    data=JSON.parse(this.response);
                    console.log(data);
                    document.getElementById("cuerpo").style="";
                    document.getElementById("paginas2").children[0].innerHTML=data[0];
                    document.getElementById("cuerpo").innerHTML=data[1];
                } catch (error) {
                    console.log(this.response);
                }
            }
        };
        xmlhttp.open("POST", "../comun.php", true);
        data = new FormData();
        data.append("q","buscarDetaTotalLlamadas")
        if(document.getElementById("buscarFecha").disabled==false){
            data.append("fecha",document.getElementById("buscarFecha").value);
        }
        if(document.getElementById("buscarCargo").disabled==false){
            data.append("cargo",document.getElementById("buscarCargo").value);
        }
        if(document.getElementById("buscarEstado").disabled==false){
            data.append("estado",document.getElementById("buscarEstado").value);
        }
        if(document.getElementById("buscarAsis").disabled==false){
            data.append("asistencia",document.getElementById("buscarAsis").value);
        }
        if(document.getElementById("buscarSede").disabled==false){
            data.append("sede",document.getElementById("buscarSede").value);
        }
        data.append("indice",parseInt(n-1));
        data.append("cantidadamostrar", parseInt(document.getElementById("cantidadamostrar").value));
        xmlhttp.send(data);
        
    }
    window.onload=cargarTabla(1);
</script>
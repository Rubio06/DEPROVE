<?php
if(!isset($_POST["id"])||$_POST["id"]==""||$_POST["id"]==""){
    echo "<script>alert('No hay un registro seleccionado');window.history.back()</script>";
    die;
}
$ante="../";
require_once("../../crud.php");
$crud=new CRUD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>insercion Datos</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/estilos_form.css">
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
            padding: 5px 14.5px;
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
        .cinvent>table{
            margin-right:15px;
        }
        
        .invent::-webkit-scrollbar{
            background: white;
            height: 5px;
        }
        .invent::-webkit-scrollbar-thumb{
            background: green;
            border-radius: 5px;
        }
        .cinvent>table>thead>tr>th:nth-child(5),
        .invent>table>tbody>tr>td:nth-child(5){
            width: 375px;
        }
        .cinvent>table>thead>tr>th:nth-child(1),
        .invent>table>tbody>tr>td:nth-child(1){
            width: 30px;
        }
        .cinvent>table>thead>tr>th:nth-child(2),
        .cinvent>table>thead>tr>th:nth-child(3),
        .cinvent>table>thead>tr>th:nth-child(4),
        .cinvent>table>thead>tr>th:nth-child(6),
        .cinvent>table>thead>tr>th:nth-child(7),
        .cinvent>table>thead>tr>th:nth-child(8),
        .cinvent>table>thead>tr>th:nth-child(9),
        .cinvent>table>thead>tr>th:nth-child(10),
        .cinvent>table>thead>tr>th:nth-child(12),
        .cinvent>table>thead>tr>th:nth-child(13),
        .cinvent>table>thead>tr>th:nth-child(14),
        .invent>table>tbody>tr>td:nth-child(2),
        .invent>table>tbody>tr>td:nth-child(3),
        .invent>table>tbody>tr>td:nth-child(4),
        .invent>table>tbody>tr>td:nth-child(6),
        .invent>table>tbody>tr>td:nth-child(7),
        .invent>table>tbody>tr>td:nth-child(8),
        .invent>table>tbody>tr>td:nth-child(9),
        .invent>table>tbody>tr>td:nth-child(10),
        .invent>table>tbody>tr>td:nth-child(12),
        .invent>table>tbody>tr>td:nth-child(13),
        .invent>table>tbody>tr>td:nth-child(14){
            width: 150px;
        }
        .cinvent>table>thead>tr>th:nth-child(11),
        .invent>table>tbody>tr>td:nth-child(11){
            width: 200px;
        }
    </style>
</head>
<body>
    <?php include("../../header.php") ?>
    <div id="formulario">
        <input type="hidden" name="nGuia" id="nGuia" value="<?php echo $_POST["id"]; ?>">
        <h1 style="text-align: center;">EDITOR DE GUIAS (<?php echo $_POST["nombre"]; ?>)</h1>
        <div class="flex">
            <input type="hidden" name="fecha_registro" id="fecha_registro">
            <form class="borde" id="ingreso" style="width: 98%;">
                <div id="prov" class="packform" style="width: 98%;">
                    <label>Proveedor: </label>
                    <select id="proovedor">
                        <option value="1">CLARO</option>
                        <option value="2">OLO</option>
                    </select>
                </div>
                <div class="packform derecha">
                    <div class="packform">
                        <label>Codigo: </label>
                        <input id="codigo_guia" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' type="text" oninput='busqueda();'>
                    </div>
                </div>
                <input type="hidden" name="" id="maxIMEI" style="width: 50%;" value="15">
                <input type="hidden" name="" id="maxICC" style="width: 50%;" value="18">

                <div class="packform mitad">
                    <label>Guia: </label>
                    <input id="guiaclaro" type="text" name="" id="" value="<?php echo $_POST["nombre"]; ?>" disabled>
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
                <select>
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
                <th>ICC/IMEI</th>
                <th>Producto</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Color</th>
                <th>Empresa</th>
                <th>Valorizacion</th>
                <th>Descripcion</th>
                <th>Estado</th>
                <th style="padding: 5px 18px;">Funciones</th>
            </tr>
            </thead>
        </table>
    </div><div onscroll="mover(this.scrollLeft)" id="invent" class="invent">
        <table>
            <tbody id="mostrarprod">
                <?php
                $crud->listardetalleGuia($_POST["id"]);
                ?>
            </tbody>
        </table>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
<script src="https://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
(function(){

    var _z = console;
    Object.defineProperty( window, "console", {
        get : function(){
            if( _z._commandLineAPI ){
            throw "No está permitido el uso de consola :c";
                }
            return _z; 
        },
        set : function(val){
            _z = val;
        }
    });
})();
</script>
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

    function editarProd(icc,guia){
        document.getElementById("codigo_guia").value=document.getElementById("codigo_"+icc).value;
        buscar(document.getElementById("codigo_"+icc).value);
    }

    function maximoDigitos(id,max){
        elemento=document.getElementById(id);
        console.log(elemento.value.length);
        if(elemento.value.length>=max){
            elemento.value=elemento.value.substring(0,max);
        }
    }
    function buscarDetalle(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.response==15){
                    document.getElementById("ingresoCelu").innerHTML=default_producto;
                    alertify.error("No se encontró el codigo '"+n)
                }
                else{
                    document.getElementById("ingresoCelu").innerHTML=this.response;
                    alertify.success("Encontrado :D");
                }
            }
        };
        xmlhttp.open("GET","../subir.php?q=buscarGuia&codigo="+document.getElementById("nGuia").value,true);
        xmlhttp.send();
    }

    function mover(n){
        document.getElementById("cinvent").scrollLeft=n;
    };
    function buscar(n){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.response==15 || this.response==""){
                    document.getElementById("ingresoCelu").innerHTML=default_producto;
                    alertify.error("No se encontró el codigo '"+n+"'");
                }
                else{
                    document.getElementById("ingresoCelu").innerHTML=this.response;
                    alertify.success("Encontrado :D");
                }
            }
        };
        xmlhttp.open("GET","../subir.php?q=encontrarCodigo&codigo="+n,true);
        xmlhttp.send();
    }

    function busqueda(){;
        clearTimeout(carcar);
        carcar=setTimeout(function(){
            ce=document.getElementById("codigo_guia");
            //chip 7 digitos
            //equipo 8 digitos
            if(ce.value.length>6){
                if(ce.value.length>8){
                    ce.value=ce.value.substr(0,8);
                }
                alertify.warning("buscando, por favor espere");
                buscar(ce.value);
            }
            else{
                document.getElementById("ingresoCelu").innerHTML=default_producto;
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

    function actualizar(){
    }
</script>
<footer>
    <button id="btnSubir" onclick="subir();return false;">GRABAR</button>
</footer>
</html>
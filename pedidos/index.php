<?php 
require_once("../coneccion.php");
$cn = Db::conectar();
session_start();
if(isset($_POST["usuarioLogin"])){
    $usuario= $_POST["usuarioLogin"];
    $contraseña= $_POST["contrasLogin"];
    $coordinador= $_POST["cordLogin"];
    $session=mysqli_fetch_assoc(mysqli_query($cn,"SELECT t.id,concat(t.nombre,' ',t.apellido) as nombre,ca.cargo FROM usuario u inner join trabajador t on t.id=u.trabajador inner join cargo ca on ca.idcargo=t.idcargo WHERE u.usuario='$usuario' and contraseña='$contraseña'"));
    $session["coordinador"]=$coordinador;
}
else if(isset($_SESSION["id"])){;
    $session=$_SESSION;
}
else{
    echo "<script>alert('Logueate para continuar');window.location.assign(\"//deproveglobal.com/login/?sig=asesor\")</script>";
    die();
}
$_SESSION=$session;
if($_SESSION==null||!isset($_SESSION["id"])){
    die();
}
// echo json_encode($_SESSION);
$hoy= date("Y-m-d");
$coor=Array();
$coordinadoresSql = mysqli_query($cn,"SELECT t.id, concat(t.nombre,' ',t.apellido) as nombre FROM usuario u inner join trabajador t on t.id=u.trabajador inner join cargo ca on ca.idcargo=t.idcargo WHERE ca.cargo in ('COORDINADOR','CAPACITADOR')");
while ($xx=mysqli_fetch_assoc($coordinadoresSql)) {
    $coor[$xx["id"]]=$xx["nombre"];
}
switch ($_SESSION["cargo"]) {
    case "SUPERVISOR ACTIVACION":
        $rsListar = "SELECT pedido.id, pedido.sec,pedido.empresa 'EMPRESA EVALUADORA', concat(fecha,' ',hora) 'FECHA DE REGISTRO', feEntraDes 'FECHA DE ENTREGA', cliente, dni, telref1, tipfDes 'DESPACHO', tipActi 'ACTIVACIÓN', tipAfili 'AFILIADOR', tipfVali 'VALIDACIÓN',tipHfc 'HFC', concat(ase.nombre,' ',ase.apellido) 'ASESOR',if(id_coord=0,'sin coordinador',id_coord) 'COORDINADOR' FROM pedido inner join trabajador ase on pedido.idasesor= ase.id";
        break;
    case "SUPERVISOR JEFE DE OPERACIONES":
        $rsListar = "SELECT pedido.id, concat(fecha,' ',hora) 'FECHA DE REGISTRO', 0 'PESO VENTA','' as 'PLAN',tipfDes 'DESPACHO', tipActi 'ACTIVACIÓN', tipAfili 'AFILIADOR', tipfVali 'VALIDACIÓN',tipHfc 'HFC', motoDes 'MOTORIZADO', distrito,pedido.direccion,concat(ase.nombre,' ',ase.apellido) 'ASESOR',if(id_coord=0,'sin coordinador',id_coord) 'COORDINADOR' FROM pedido inner join trabajador ase on pedido.idasesor= ase.id";
        break;
    case 'SUPERVISOR DESPACHO':
        $rsListar = "SELECT pedido.id, concat(fecha,' ',hora) 'FECHA DE REGISTRO',tipfDes 'DESPACHO',feEntraDes 'FECHA DE ENTREGA', motoDes 'MOTORIZADO', pedido.distrito,  cliente, dni, telref1, telref2, tipfAlma 'ALMACEN', tipAfili 'AFILIADOR', tipfVali 'VALIDACIÓN', feReproDes 'FECHA DE REPROGRAMACIÓN', tipActi 'ACTIVACIÓN', tipHfc 'HFC',concat(ase.nombre,' ',ase.apellido) 'ASESOR',if(id_coord=0,'sin coordinador',id_coord) 'COORDINADOR',feReproDes 'FECHA DE REPROGRAMACIÓN', fechapactada FROM pedido inner join trabajador ase on pedido.idasesor= ase.id ";
    break;
    case str_contains($_SESSION["cargo"],'SUPERVISOR'):
        $rsListar = "SELECT pedido.id, pedido.empresa 'EMPRESA EVALUADORA', concat(fecha,' ',hora) 'FECHA DE REGISTRO', feEntraDes 'FECHA DE ENTREGA', feReproDes 'FECHA DE REPROGRAMACIÓN', fechapactada, delivery, asumeases 'ASUME ASESOR', asumecoord 'ASUME COORDINADOR', cliente, dni, telref1, telref2, correo, tipfAlma 'ALMACEN', tipAfili 'AFILIADOR', tipfVali 'VALIDACIÓN', tipfDes 'DESPACHO', feReproDes 'FECHA DE REPROGRAMACIÓN', tipActi 'ACTIVACIÓN', tipHfc 'HFC', concat(ase.nombre,' ',ase.apellido) 'ASESOR',if(id_coord=0,'sin coordinador',id_coord) 'COORDINADOR' FROM pedido inner join trabajador ase on pedido.idasesor= ase.id";
        break;
    case 'COORDINADOR':
    case 'CAPACITADOR':
        $rsListar = "SELECT pedido.id, pedido.empresa 'EMPRESA EVALUADORA', concat(fecha,' ',hora) 'FECHA DE REGISTRO', feEntraDes 'FECHA DE ENTREGA', feReproDes 'FECHA DE REPROGRAMACIÓN', fechapactada, delivery, asumeases 'ASUME ASESOR', asumecoord 'ASUME COORDINADOR', cliente, dni, telref1, telref2, correo, tipfAlma 'ALMACEN', tipAfili 'AFILIADOR', tipfVali 'VALIDACIÓN', tipfDes 'DESPACHO', feReproDes 'FECHA DE REPROGRAMACIÓN', tipActi 'ACTIVACIÓN', tipHfc 'HFC', concat(ase.nombre,' ',ase.apellido) 'ASESOR',if(id_coord=0,'sin coordinador',id_coord) 'COORDINADOR' FROM pedido inner join trabajador ase on pedido.idasesor= ase.id where id_coord=$_SESSION[id] or ase.id=$_SESSION[id]";
        break;
    default:
        $rsListar = "SELECT pedido.id, pedido.empresa 'EMPRESA EVALUADORA', concat(fecha,' ',hora) 'FECHA DE REGISTRO', feEntraDes 'FECHA DE ENTREGA', feReproDes 'FECHA DE REPROGRAMACIÓN', fechapactada, delivery, asumeases 'ASUME ASESOR', asumecoord 'ASUME COORDINADOR', cliente, dni, telref1, telref2, correo, tipfAlma 'ALMACEN', tipAfili 'AFILIADOR', tipfVali 'VALIDACIÓN', tipfDes 'DESPACHO', feReproDes 'FECHA DE REPROGRAMACIÓN', tipActi 'ACTIVACIÓN', tipHfc 'HFC', concat(ase.nombre,' ',ase.apellido) 'ASESOR',if(id_coord=0,'sin coordinador',id_coord) 'COORDINADOR' FROM pedido inner join trabajador ase on pedido.idasesor= ase.id where ase.id=$_SESSION[id]";
        break;
}
$listar = mysqli_query($cn,$rsListar." order by id desc");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Pedido</title>
    <link rel="stylesheet" href="tablaRegistro.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<h1>Registro de Pedidos</h1>

<button class="botton-check" id="cerrarSession">Terminar la sesión</button>
<button class="botton-check" onclick="window.location.href = './crear.php'">Crear</button>

<div id="filtro">
    <div>
        DESDE: <input type="date" name="" id="fd" value="<?php echo $hoy; ?>" >
        HASTA: <input type="date" name="" id="fh" value="<?php echo $hoy; ?>" >
    </div>
    <div></div>
</div>
<div style="overflow:auto;width: 90%;margin: auto;max-height:600px;margin-top:50px">
<?php $prim=mysqli_fetch_assoc($listar); 
    if($prim!=null){ ?>
        <table border="2" cellspacing="0" align="center">
            <tr style="position: sticky;top: 0;">
            <?php $encabezados=array_keys($prim);
                for($i=0;$i<count($encabezados);$i++){
                    echo '<th>'.strtoupper($encabezados[$i]).'</th>';
                } ?>
            </tr>
            <tbody id=cuerpotabla>
                <tr ondblclick="abrirdeta(<?php echo $prim['id']; ?>)">
                <?php
                for($i=0;$i<count($encabezados);$i++){
                    if($encabezados[$i]=="COORDINADOR" && isset($rslistar["COORDINADOR"])&&isset($coor[$prim["COORDINADOR"]])){
                        echo '<td>'.$coor[$prim["COORDINADOR"]].'</td>';
                    }
                    else{
                        echo '<td>'.$prim[$encabezados[$i]].'</td>';
                    }
                }
                echo '</tr>';
                while($x=mysqli_fetch_assoc($listar)){ 
                    echo "<tr ondblclick=\"abrirdeta($x[id])\">";
                        $max=sizeof($x);
                        for($i=0;$i<$max;$i++){
                            if($encabezados[$i]=="COORDINADOR" && isset($x["COORDINADOR"])&&isset($coor[$x["COORDINADOR"]])){
                                echo '<td class="datos1">'.$coor[$x["COORDINADOR"]].'</td>';
                            }
                            else{
                                echo '<td class="datos1">'.$x[$encabezados[$i]].'</td>';
                            }
                        }
                    echo '</tr>'; 
                } ?>
            </tbody>
        </table>
        <?php }else{
            // echo $rsListar;
            echo "<div style='width:100%;color:red;line-height:150px;background:#c2c2c2;text-align:center;'>USTED NO TIENE NINGUNA FICHA GRABADA</div>";
        } ?>
    </div>
    <!-- <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAn595P3eaZlHhsapN4Tdijem66mMAQ5hs&callback=initMap"> -->
</script>
</body>
</html>
<script>
// function initMap(x,y) {
//     const uluru = { lat: x, lng:y};
//     const map = new google.maps.Map(document.getElementById("map"), {
//         zoom: 4,
//         center: uluru,
//     });
//     const marker = new google.maps.Marker({
//         position: uluru,
//         map: map,
//     });
// }

// window.initMap = initMap;
    function abrirdeta(n){
        var form = $('<form target="ventana" action="./detalle.php" method="post">' +
        '<input type="text" name="id_ped" value="' + n + '" />' +
        '</form>');
        window.open('', 'ventana','Subir','width=320,height=320');
        $('body').append(form);
        form.submit();
        form.remove();
    }

document.getElementById("cerrarSession").addEventListener('click',function(e){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                window.close();
                setTimeout(() => {
                    window.location.href = "./";
                }, 1000);
            }
        };
        xmlhttp.open("POST","./subirtra.php",true);
        var data = new FormData();
        data.append("op","cerrar");
        xmlhttp.send(data);
    });
    const cargaTabla = () =>{
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if(document.getElementById("cuerpotabla").innerHTML!=this.response){
                document.getElementById("cuerpotabla").innerHTML=this.response;
            }
        };
        xmlhttp.open("POST","./comun.php",true);
        var data = new FormData();
        data.append("detaPedidos","detaPedidos");
        xmlhttp.send(data);
    }
    window.load=cargaTabla();
    setInterval(() => {
        cargaTabla();
    }, 30000);
</script>
<?php
require_once("../coneccion.php");
$cn = Db::conectar();
session_start();
if(isset($_POST["id"])){
    if(isset($_POST["info"])){
        echo mysqli_query($cn,"UPDATE pedido set tipfDes='".$_POST["info"]."' where id='".$_POST["id"]."'");
    }
    else{
        $value=mysqli_fetch_assoc(mysqli_query($cn,"select * from pedido where id='".$_POST["id"]."'"));
        echo json_encode(['<div>NOMBRE: <b style="background: rgb(225, 124, 124);">'. $value["cliente"].' </b><br></div>
            <div>DNI: <b style="background: rgb(225, 124, 124);">'. $value["dni"].'</b><br></div>
            <div>DISTRITO: <b style="background: rgb(225, 124, 124);">'. $value["distrito"].' </b><br></div>
            <div>REF LUGAR: <b style="background: rgb(225, 124, 124);">'. $value["direccion"].'</b> <br></div>
            <div>TELF.REF 1: <b style="background: rgb(225, 124, 124);">'. $value["telref1"].'</b><br></div>
            <div>TELF.REF 2: <b style="background: rgb(225, 124, 124);">'. $value["telref2"].'</b><br></div>
            <div>OBSERVACION: <b style="background: rgb(225, 124, 124);">'. $value["observacion"].'</b><br></div>
            <hr>
            <div style="display:flex;justify-content: space-between;">
                <label>DELIBERY:</label>
                <label>'. $value["delivery"].'</label>
            </div>
            <div style="margin-top:10px; text-align:center">------------ PLAN 1 -----------</div>
            <div style="display:flex;justify-content: space-between;">
                <label>CHIP:</label>
                <label>15.00</label>
            </div>
            <div style="display:flex;justify-content: space-between;">
                <label>EQUIPOS:</label>
                <label>15.00</label>
            </div>
            <div style="display:flex;justify-content: space-between;">
                <label>RENTA:</label>
                <label>15.00</label>
            </div>
            <div style="margin-top:10px; text-align:center">------------ PLAN 2 -----------</div>
            <div style="display:flex;justify-content: space-between;">
                <label>CHIP:</label>
                <label>15.00</label>
            </div>
            <div style="display:flex;justify-content: space-between;">
                <label>EQUIPOS:</label>
                <label>15.00</label>
            </div>
            <div style="display:flex;justify-content: space-between;">
                <label>RENTA:</label>
                <label>15.00</label>
            </div>
            <div style="margin-top:10px; text-align:center">------------ PLAN 3 -----------</div>
            <div style="display:flex;justify-content: space-between;">
                <label>CHIP:</label>
                <label>15.00</label>
            </div>
            <div style="display:flex;justify-content: space-between;">
                <label>EQUIPOS:</label>
                <label>15.00</label>
            </div>
            <div style="display:flex;justify-content: space-between;">
                <label>RENTA:</label>
                <label>15.00</label>
            </div>
            <hr>
            <div style="margin-top:10px; float:left;">Pago Total</div>
            <div style="margin-top:10px; float:right;">S/.48.50</div>
        ',$value["empresa"]]);
    }
}
else if(isset($_POST["actualizar"])){
    $listar = mysqli_query($cn,"SELECT id, cliente,feEntraDes,distrito, tipfDes, tipActi,tipAfili from pedido where motoDes=$_SESSION[id_moto]");
    $a=0; 
    $cancelados=Array();
    $entregado=Array();
    $todos=Array();
    while($rslistar=mysqli_fetch_array($listar)){ 
        if($rslistar["tipfDes"]=="CANCELADO"){
            array_push($cancelados,$rslistar);
        }
        else if($rslistar["tipfDes"]=="ENTREGADO"){
            array_push($entregado,$rslistar);
        }
        else{
            array_push($todos,$rslistar);
        }
    }
    for($in=0;$in<sizeof($entregado);$in++){
        $a++;
        echo '<tr style="background-color: lawngreen" ondblclick="abrirModal('.$entregado[$in][0].')">
            <td class="datos1">'.$a.'</td>';
        for($i=1;$i<sizeof($entregado[$in])/2;$i++){?>
            <td class="datos1"><?php echo $entregado[$in][$i];?></td>
        <?php } 
        echo "</tr>";
    }
    for($in=0;$in<sizeof($todos);$in++){
        $a++;
        echo '<tr ondblclick="abrirModal('.$todos[$in][0].')">
            <td class="datos1">'.$a.'</td>';
        for($i=1;$i<sizeof($todos[$in])/2;$i++){?>
            <td class="datos1"><?php echo $todos[$in][$i];?></td>
        <?php } 
        echo "</tr>";
    }
    for($in=0;$in<sizeof($cancelados);$in++){
        $a++;
        echo '<tr style="background-color: #ff513a;color:white;" ondblclick="abrirModal('.$cancelados[$in][0].')">
            <td class="datos1">'.$a.'</td>';
        for($i=1;$i<sizeof($cancelados[$in])/2;$i++){?>
            <td class="datos1"><?php echo $cancelados[$in][$i];?></td>
        <?php } 
        echo "</tr>";
    }
}
?>
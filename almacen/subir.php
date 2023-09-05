<?php
if(!isset($ante)){
    $ante='';
}
require_once($ante."../crud.php");

$crud=new CRUD();


if(isset($_POST["ingreso_codigo"])){
    echo $crud->crear_codigo($_POST["ingreso_codigo"],$_POST["ingreso_producto"],$_POST["ingreso_marca"],$_POST["ingreso_modelo"],$_POST["ingreso_color"]);
}
if(isset($_POST["actu_codigo"])){
    echo $crud->actualizar_codigo($_POST["actu_codigo"],$_POST["actu_producto"],$_POST["actu_marca"],$_POST["actu_modelo"],$_POST["actu_color"]);
}
else if(isset($_GET["q"])){
    $q=$_GET["q"];
    if($q=="encontrarCodigo"){
        echo $crud->buscar_codigo($_GET["codigo"]);
    }
    else if($q=="date"){
        echo date("Y-m-d");
    }
    else if($q=="contarStockEmpresas"){
        echo $crud->contarStockEmpresas();
    }
    else if($q=="contarVendidoEmpresas"){
        echo $crud->contarVendidoEmpresas();
    }
    else if($q=="llenar_prov"){
        echo $crud->llenar_prov();
    }
    else if($q=="listarCodigos"){
        echo $crud->listarCodigos(0);
    }
    else if($q=="valor"){
        echo $crud->limpiarValoracion();
    }
    else if($q=="detalleGuias"){
        echo $crud->detalleGuias($_GET["i"]);
    }
    else if($q=="array"){
        $array=json_decode($_GET["array"]);
        $array=[$array[0],$array[2]];
        echo json_encode($array);
    }
    else if($q=="subirTabla"){
        // $array=json_decode($_GET["data"]);
        $array=json_decode($_POST["data"]);
        $i=0;
        $valor_ant=[];
        $ICC=[];
        $array_guia=[];
        $duplicados=[];
        $sql1="INSERT INTO guia VALUES";
        $sql2="INSERT IGNORE INTO inventario VALUES";
        $sql3="INSERT INTO valoracion VALUES";
        foreach($array as $x){
            if($i!=count($array)&&$i!=0){
                if(!in_array( $x[0],$array_guia)){
                    $sql1=$sql1.",";
                }
                if(!in_array( $x[6],$ICC)){
                    $sql2=$sql2.",";
                }
                if(!in_array([$x[5],$x[0]],$valor_ant)){
                    $sql3=$sql3.",";
                }
            }
            if(!in_array( $x[0],$array_guia)){
                array_push($array_guia,$x[0]);
                $sql1=$sql1." (null,'$x[0]','$x[1]','$x[2]','$x[4]','$x[3]','$x[7]')";
                //$sql1=$sql1." (null,'$x[0]',(select id from proovedores where nombre='$x[1]'),'$x[2]','$x[4]','$x[3]','$x[7]')";
            }
            if(!in_array( $x[6],$ICC)){
                array_push($ICC,$x[6]);
                $sql2=$sql2." ('$x[6]','$x[5]',(select id from guia where codigoGuia='$x[0]'),'$x[7]-ALMACEN PRINCIPAL','STOCK','$x[9]')";
            }
            else{
                array_push($duplicados,$i);
            }
            if(!in_array([$x[5],$x[0]],$valor_ant)){
                array_push($valor_ant,[$x[5],$x[0]]);
                $sql3=$sql3." (null,(select id from guia where codigoGuia='$x[0]'),'$x[5]','$x[8]')";
            }
            $i++;
            $guia_ant= $x[0];
            if($i==count($array)){
                $sql1=$sql1.";";
                $sql2=$sql2.";";
                $sql3=$sql3.";";
            }
        }
        
        // echo json_encode([$duplicados,$sql1,$sql2,$sql3]);
        if($crud->subirGuia($sql1,$array_guia)&&$crud->subirsql($sql2)&&$crud->subirsql($sql3)){
            if($duplicados!=null){
                    echo json_encode(["Dupli",$duplicados]);
            }
            else{
                echo json_encode(["Subido"]);
            }
        }
        else{
            echo json_encode(["Error",[$crud->subirGuia($sql1,$array_guia),$sql1],[$crud->subirsql($sql2),$sql2],[$crud->subirsql($sql3),$sql3]]);
        }
    }
    else if($q=="listarGuias"){
        echo $crud->listarGuias();
    }
    else if($q=="listarProd"){
        echo $crud->listarProductos($_POST["i"],$_POST["filtros"]);
    }
    else if($q=="eliminarCode"){
        echo $crud->eliminarCode($_POST["codigo"]);
    }
}
?>
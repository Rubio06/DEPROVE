<?php 
    include ("../../coneccion.php"); 
    $cn = Db::conectar();
    $consulta = mysqli_query($cn,"select * from numerosllamadas limit ".(($_POST["indice"]-1)*$_POST["cantidad"]).",".$_POST["cantidad"]);
    $data="";
    $paginas="";
    while($x=mysqli_fetch_array($consulta)){
        $id=$x["id"];
        $data=$data.
        "<tr>".
            "<td>".$id."</td>".
            "<td>".$x["cliente"]."</td>".
            "<td>".$x["dni"]."</td>".
            "<td>".$x["referencia"]."</td>".
            "<td>".$x["tipif1"]."</td>".
            "<td>".$x["tipif2"]."</td>".
            "<td>".$x["fecha"]."</td>".
            "<td>".$x["inicio"]."</td>".
            "<td>".$x["fin"]."</td>".
            "<td>".$x["asesor"]."</td>".
            "<td></td>".
        "</tr>";
    }

    $consulta = mysqli_fetch_assoc(mysqli_query(Db::conectar(),"select count(*) as total, sum(if(tipif1='',1,0)) as disp from numerosllamadas;"));
    for($x=0;$x<(int)($consulta["total"]/$_POST["cantidad"]);$x++){
        if(($x+1)==(int)($consulta["total"]/$_POST["cantidad"])){
            $paginas=$paginas."<a href=\"javascript:cargarTabla(".($x+1).")\">".($x+1)." <p>(".($x*$_POST["cantidad"]+1)."-".($consulta["total"]).")</p></a>"; 
        } else{
            $paginas=$paginas."<a href=\"javascript:cargarTabla(".($x+1).")\">".($x+1)." <p>(".($x*$_POST["cantidad"]+1)."-".(($x+1)*$_POST["cantidad"]).")</p></a>";
        }
    }

    echo json_encode([$paginas,$data,$consulta["total"],$consulta["disp"]]);
?>
<?php
if(!isset($ante)){
    $ante='';
}
require_once($ante."../coneccion.php");

class CRUD{
    public function __construct(){}

    public function crear_codigo($codigo,$producto,$marca,$modelo,$color){
        $conexion=Db::conectar();
        $cadena="";
        $marca=strtoupper($marca);
        $modelo=strtoupper($modelo);
        $color=strtoupper($color);

        if($producto=="2"){
            $marca=strtoupper("CHIP");
            $modelo=strtoupper($modelo);
            $color=strtoupper("BLANCO");
        }
        //marca
        $sql_tabla=mysqli_fetch_array(mysqli_query($conexion, "SELECT count(*) as ca, id FROM marca where nombre='$marca'"));
        if($sql_tabla["ca"]==0){
            mysqli_query($conexion, "INSERT INTO marca values (null,'$marca')");
            $sql_tabla=mysqli_fetch_array(mysqli_query($conexion, "SELECT id FROM marca where nombre='$marca'"));
        }
        $id_marca=$sql_tabla["id"];

        //modelo
        $sql_tabla=mysqli_fetch_array(mysqli_query($conexion, "SELECT count(*) as ca, id FROM modelo where nombre='$modelo' and marca='$id_marca'"));
        if($sql_tabla["ca"]==0){
            mysqli_query($conexion, "INSERT INTO modelo values (null,'$modelo','$id_marca');");
            $sql_tabla=mysqli_fetch_array(mysqli_query($conexion, "SELECT id FROM modelo where nombre='$modelo'and marca='$id_marca'"));
        }
        $id_modelo=$sql_tabla["id"];
        
        //color
        $sql_tabla=mysqli_fetch_array(mysqli_query($conexion, "SELECT count(*) as ca, id FROM color where nombre='$color' and modelo='$id_modelo'"));
        if($sql_tabla["ca"]==0){
            mysqli_query($conexion, "INSERT INTO color values (null,'$color','$id_modelo')");
            $sql_tabla=mysqli_fetch_array(mysqli_query($conexion, "SELECT id id FROM color where nombre='$color' and modelo='$id_modelo'"));
        }
        $id_color=$sql_tabla["id"];
        
        if($id_color != null and $id_modelo != null and $id_marca!=null){
            $valido["id"]=$id_modelo;
        }
        else{
            return 1;
        }
        if($valido["id"]!=null){
            if(mysqli_query($conexion, "INSERT INTO codigos values ('$codigo','$producto','".$valido['id']."');")){
                echo 51;
            }
            else{
                echo 1;
            }
        }
        else{
            echo 1;
        }
    }
    public function actualizar_codigo($codigo,$producto,$marca,$modelo,$color){
        $conexion=Db::conectar();
        $cadena="";
        $marca=strtoupper($marca);
        $modelo=strtoupper($modelo);
        $color=strtoupper($color);
        $c=0;

        if($producto=="2"){
            $marca=strtoupper("CLARO");
            $modelo=strtoupper($modelo);
            $color=strtoupper("BLANCO");
        }
        //marca
        $sql_tabla=mysqli_fetch_array(mysqli_query($conexion, "SELECT count(*) as ca, id FROM marca where nombre='$marca'"));
        if($sql_tabla["ca"]==0){
            mysqli_query($conexion, "INSERT INTO marca values (null,'$marca')");
            $sql_tabla=mysqli_fetch_array(mysqli_query($conexion, "SELECT id FROM marca where nombre='$marca'"));
        }
        $id_marca=$sql_tabla["id"];
        
        //modelo
        $sql_tabla=mysqli_fetch_array(mysqli_query($conexion, "SELECT count(*) as ca, id FROM modelo where nombre='$modelo' and marca='$id_marca'"));
        if($sql_tabla["ca"]==0){
            $c=1;
            mysqli_query($conexion, "INSERT INTO modelo values (null,'$modelo','$id_marca');");
            $sql_tabla=mysqli_fetch_array(mysqli_query($conexion, "SELECT id FROM modelo where nombre='$modelo'and marca='$id_marca'"));
        }
        $id_modelo=$sql_tabla["id"];
        
        //color
        $sql_tabla=mysqli_fetch_array(mysqli_query($conexion, "SELECT count(*) as ca, id FROM color where nombre='$color' and modelo='$id_modelo'"));
        if($sql_tabla["ca"]==0){
            if($c==0){
                mysqli_query($conexion, "UPDATE color SET nombre='$color' WHERE modelo='$id_modelo';");
            }
            else{
                mysqli_query($conexion, "INSERT INTO color values (null,'$color','$id_modelo')");
            }
            $sql_tabla=mysqli_fetch_array(mysqli_query($conexion, "SELECT id id FROM color where nombre='$color' and modelo='$id_modelo'"));
        }
        $id_color=$sql_tabla["id"];
        
        if($id_color != null and $id_modelo != null and $id_marca!=null){
            $valido["id"]=$id_modelo;
        }
        else{
            echo 1;
        }
        if($valido["id"]!=null){
            if(mysqli_query($conexion, "UPDATE codigos SET tipo = ".$producto." , id_producto = '".$valido['id']."' WHERE Id = ".$codigo)){
                echo 51;
            }
            else{
                echo 1;
            }
        }
        else{
            echo 1;
        }
    }
    public function listarCodigos($inicio){
        $conexion=Db::conectar();
        $resultado=mysqli_query($conexion, 'SELECT codigos.*,marca.nombre as "marca",modelo.nombre as "modelo",color.nombre as "color" FROM codigos inner join modelo on modelo.id=codigos.id_producto  inner join color on modelo.id=color.modelo inner join marca on marca.id=modelo.marca limit '.($inicio*100).',100;');
        $i=0;
        $productos=array('','Equipo','Chip');
        while ($x = mysqli_fetch_array($resultado)) {
            $i++;
            echo '
                <tr id="Code_'.$x["Id"].'" '.($inicio*100).'_'.$i.' onclick="mandarCode(this.children)">
                    <td>'.$i.'</td>
                    <td>'.$x["Id"].'</td>
                    <td>'.$productos[$x["tipo"]].'</td>
                    <td>'.$x["marca"].'</td>
                    <td>'.$x["color"].'</td>
                    <td>'.$x["modelo"] .'</td>
                    <td><button onclick="eliminarCode('.$x["Id"].')">Eliminar '.$x["Id"].'</button></td>
                </tr>';
        }
        if($i==0){
            echo '
                <tr>
                    <td colspan=6 style="min-width:250px">No hay Codigos para mostrar</td>
                </tr>';
        }
    }
    public function buscar_codigo($codigo){
        $conexion=Db::conectar();
        $valido=mysqli_fetch_array(mysqli_query($conexion, "SELECT count(*) as ca, tipo, id_producto FROM codigos WHERE id='$codigo'"));
        if($valido["ca"]==0){
            echo 15;
        }
        else{
            $equipo=mysqli_fetch_array(mysqli_query($conexion, "SELECT * FROM modelo where id='".$valido['id_producto']."'"));
            ?>
            <div class="packform mitad">
                <label>Producto: </label>
                <select disabled="true" onchange="tipoProducto(this.value);" id="producto">
                    <option value="1" <?php if($valido["tipo"]==1){echo "selected";}?>>Equipo</option>
                    <option value="2" <?php if($valido["tipo"]==2){echo "selected";}?>>Chip</option>
                </select>
            </div>
            <div class="packform mitad">
                <label>Marca: </label>
                <select disabled="true" id="marca">
                    <?php if($valido["tipo"]==1){?>
                    <option value="<?php echo $equipo["marca"]; ?>">
                        <?php 
                            $nombre=mysqli_fetch_array(mysqli_query($conexion, "SELECT nombre FROM marca WHERE id='".$equipo['marca']."'"));
                            echo $nombre["nombre"];
                            ?>
                    </option>
                    <?php } else echo "<option>---</option>"; ?>
                </select>
            </div>
            <div class="packform mitad">
                <label>Modelo: </label>
                <select id="modelo" disabled="true">
                    <option value="<?php echo $equipo['id'];?>">
                        <?php echo $equipo['nombre'];?>
                    </option>
                </select>
            </div>

            <div class="packform mitad">
                <label>Color: </label>
                <select id="color" disabled="true">
                    <?php 
                    if($valido["tipo"]==1){
                        $colors=mysqli_fetch_array(mysqli_query($conexion, "SELECT * FROM color where modelo='".$equipo['id']."'"));
                    ?>
                    <option value="<?php echo $colors['id'];?>">
                        <?php echo $colors['nombre'];?>
                    </option>
                    <?php } else echo "<option>---</option>";?>
                </select>
            </div>
            <?php 
        }
    }
    public function eliminarCode($codigo){
        $conexion=Db::conectar();
        if(mysqli_query($conexion, 'DELETE FROM codigos WHERE Id = '.$codigo)){
            echo "true";
        }
        else{
            echo "false";
        }
    }


    public function detalleGuias($id){
        $conexion=Db::conectar();
        $resultado=mysqli_query($conexion, 'SELECT count(*) as cantidad, modelo.nombre as "modelo",color.nombre as "color", marca.nombre as "marca",valoracion.valor as "valorizacion",inventario.descripcion,inventario.locationActual,inventario.estado FROM inventario INNER JOIN guia on guia.id=inventario.guia inner join codigos on codigos.Id=inventario.codigo inner join modelo on modelo.id=codigos.id_producto  inner join color on modelo.id=color.modelo inner join marca on marca.id=modelo.marca inner join valoracion on valoracion.codigo=codigos.Id and valoracion.guia=guia.id where guia.id='.$id.' GROUP by modelo ;');
        $i=0;
        echo '
        <tr>
            <td>CANTIDAD</td>
            <td>MODELO</td>
            <td>COLOR</td>
            <td>MARCA</td>
            <td>VALORIZACION</td>
        </tr>';
        while ($x = mysqli_fetch_array($resultado)) {
            $i++;
            echo '
            <tr style="background:white">
                <td>'.$x["cantidad"].'</td>
                <td style="width: 325px;">'.$x["modelo"].'</td>
                <td>'.$x["color"].'</td>
                <td>'.$x["marca"].'</td>
                <td>S/.'.number_format($x["valorizacion"],2).'</td>
            </tr>';
        }
        if($i==0){
            echo '
            <tr class="red">
                <td style="min-width: 445px;" colspan=9>No hay productos para mostrar</td>
            </tr>';
        }
    }

    public function llenar_prov(){
        $conexion=Db::conectar();
        $resultado=mysqli_query($conexion, 'SELECT * FROM proovedores where productos="TELEFONOS"');
        $i=0;
        while ($x = mysqli_fetch_array($resultado)) {
            $i++;
            echo '
            <option value="'.$x["id"].'">'.$x["nombre"].'</option>';
        }
        if($i==0){
            echo '
            <tr class="red">
                <td style="min-width: 445px;" colspan=9>No hay productos para mostrar</td>
            </tr>';
        }
    }

    public function subirsql($sql){
        $conexion=Db::conectar();
        return mysqli_query($conexion, $sql);
    }

    public function contarStockEmpresas(){
        $conexion=Db::conectar();
        $resultado=mysqli_query($conexion, 
        "SELECT count(*) as TOTAL, 
        (SELECT COUNT(*) FROM inventario as inv inner join guia AS g on inv.guia=g.id inner join codigos AS co on co.id=inv.codigo  WHERE inv.estado='STOCK' and co.tipo=1 and inv.locationActual=inventario.locationActual and g.empresa='DEPROVE') 
        As DEPROVE,
        (SELECT COUNT(*) FROM inventario as inv inner join guia AS g on inv.guia=g.id inner join codigos AS co on co.id=inv.codigo  WHERE inv.estado='STOCK' and co.tipo=1 and inv.locationActual=inventario.locationActual and g.empresa='KOMUNICATE') 
        As KOMUNICATE,
        inventario.locationActual
            
        from inventario 
        inner join guia on inventario.guia=guia.id 
        inner join codigos on codigos.id=inventario.codigo 
        
        where inventario.estado='STOCK' 
        and codigos.tipo=1 GROUP by inventario.locationActual ORDER BY `inventario`.`locationActual` ASC;
        ");

        $tot_deprove=0;
        $tot_komunicate=0;
        $i=0;
        $ante="";
        ?>
        <thead>
            <tr>
                <th colspan="4">EQUIPOS EN STOCK</th>
            </tr>
            <tr>
                <td>LOCALIZACION</td>
                <td>DEPROVE</td>
                <td>KOMUNICATE</td>
                <td>TOTAL</td>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($x = mysqli_fetch_array($resultado)) {
                $i++;
                $tot_deprove+=$x["DEPROVE"];
                $tot_komunicate+=$x["KOMUNICATE"];
                ?>
            <tr>
                <td><?php echo $x["locationActual"] ?></td>
                <td><?php echo $x["DEPROVE"]; ?></td>
                <td><?php echo $x["KOMUNICATE"]; ?></td>
                <td><?php echo $x["TOTAL"]; ?></td>
            </tr>
            <?php
        }
        if($i==0){
            ?>
            <tr>
                <td colspan=3>No se encontraron dispositivos en stock</td>
            </tr>
            <?php
        }
        ?>
        <!-- <tr>
            <td>TDA-ATE</td>
            <td>2</td>
            <td>3</td>
        </tr>
        <tr>
            <td>TDA-CHIMU</td>
            <td>1</td>
            <td>2</td>
        </tr> -->
        <tr style="background:yellow;">
            <td>GOBAL</td>
            <td><?php echo $tot_deprove; ?></td>
            <td><?php echo $tot_komunicate; ?></td>
            <td><?php echo $tot_komunicate+$tot_deprove; ?></td>
        </tr>
        </tbody>
        <?php
    }

    public function contarVendidoEmpresas(){
        $conexion=Db::conectar();
        $resultado=mysqli_query($conexion, "SELECT count(*) as items, inventario.locationActual, guia.empresa from inventario inner join guia on inventario.guia=guia.id where inventario.guia<(SELECT COUNT(*) from guia) AND inventario.estado='VENDIDO' GROUP by guia.empresa, inventario.locationActual ORDER BY `inventario`.`locationActual` ASC");
        $tot_deprove=0;
        $tot_komunicate=0;
        $deprove=0;
        $komunicate=0;
        $i=0;
        $ante="";
        ?>
        <thead>
            <tr>
                <th colspan="3">EQUIPOS VENDIDOS</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td>LOCALIZACION</td>
            <td>DEPROVE</td>
            <td>KOMUNICATE</td>
        </tr>
        <?php
        while ($x = mysqli_fetch_array($resultado)) {
            $ante=$x["locationActual"];
            if($x["empresa"]=="DEPROVE"){
                $tot_deprove+=$x["items"];
                $deprove=$x["items"];
                $komunicate=0;
            }
            else{
                $tot_komunicate+=$x["items"];
                $komunicate=$x["items"];
                $deprove=0;
            }
        ?>
        <tr>
            <td><?php echo $x["locationActual"]." - ".$x["empresa"] ?></td>
            <td><?php echo $deprove; ?></td>
            <td><?php echo $komunicate; ?></td>
        </tr>
        <?php
        }
        ?>
        <!-- <tr>
            <td>TDA-ATE</td>
            <td>2</td>
            <td>3</td>
        </tr>
        <tr>
            <td>TDA-CHIMU</td>
            <td>1</td>
            <td>2</td>
        </tr> -->
        <tr style="background:yellow;">
            <td>GOBAL</td>
            <td><?php echo $tot_deprove; ?></td>
            <td><?php echo $tot_komunicate; ?></td>
        </tr>
        </tbody>
        <?php
    }

    public function listarGuias(){
        $conexion=Db::conectar();
        $resultado=mysqli_query($conexion, "SELECT guia.*,proovedores.nombre,count(*) as items FROM guia INNER JOIN proovedores on guia.proovedor=proovedores.id inner join inventario as inv on guia.id=inv.guia group by guia.codigoGuia");
        $i=0;
        while ($x = mysqli_fetch_array($resultado)) {
            $i++;
            echo '
            <tr id="List_'.$x["id"].'" ondblclick="detalleGuias('.$x["id"].')">
                <td>'.$i /* # */.'</td>
                <td>'.$x["codigoGuia"] /* Guia */.'</td>
                <td>'.$x["empresa"] /* Empresa */.'</td>
                <td>'.$x["fechaRegistro"] /*FR */.'</td>
                <td>'.$x["FechaIngreso"] /* FI */.'</td>
                <td>'.$x["fechaFactura"] /* FF */.'</td>
                <td>'.$x["nombre"] /* Proovedor */.'</td>
                <td>'.$x["items"] /* N° items */.'</td>
                <td><button onclick="editarGuia('.$x["id"].',\''.$x["codigoGuia"].'\'   )" >EDITAR GUIA</button> </td>
            </tr>';
        }
        if($i==0){
            echo '
            <tr class="red">
                <td style="min-width: 445px;" colspan=9>No hay guias para mostrar</td>
            </tr>';
        }
    }
    public function listardetalleGuia($id){
        $conexion=Db::conectar();
        $tipos=['','Equipo','Chip'];
        $resultado=mysqli_query($conexion, 'SELECT 
        inventario.icc, 
        inventario.codigo, 
        codigos.tipo as "tipo",
        marca.nombre as "marca",
        modelo.nombre as "modelo",
        color.nombre as "color",
        guia.empresa as "empresa",
        valoracion.valor as "valorizacion",
        guia.codigoGuia,
        inventario.descripcion,
        inventario.locationActual,
        inventario.estado
        FROM inventario 
        INNER JOIN guia on guia.id=inventario.guia 
        inner join codigos on codigos.Id=inventario.codigo 
        inner join modelo on modelo.id=codigos.id_producto  
        inner join color on modelo.id=color.modelo 
        inner join marca on marca.id=modelo.marca 
        inner join valoracion on valoracion.codigo=codigos.Id and valoracion.guia=guia.id 
        where guia.id='.$id.';');
        $i=0;
        while ($x = mysqli_fetch_array($resultado)) {
            $i++;
            echo '
            <tr style="background:white">
                <td>'.$i.'</td>
                <td>'.$x["icc"].'</td>
                <td>'.$tipos[$x["tipo"]].'</td>
                <td>'.$x["marca"].'</td>
                <td>'.$x["modelo"].'</td>
                <td>'.$x["color"].'</td>
                <td>'.$x["empresa"].'</td>
                <td>S/.'.number_format($x["valorizacion"],2).'</td>
                <td>'.$x["descripcion"].'</td>
                <td>'.$x["estado"].'</td>
                <td>
                    <input type="hidden" id="codigo_'.$x["icc"].'" value="'.$x["codigo"].'">
                    <button onclick="editarProd('.$x["icc"].',\''.$x["codigoGuia"].'\'   )" >Editar Producto</button> 
                    <button onclick="elimProd('.$x["icc"].',\''.$x["codigoGuia"].'\'   )" >Eliminar Producto</button> 
                </td>
            </tr>';
        }
        if($i==0){
            echo '
            <tr class="red">
                <td style="min-width: 445px;" colspan=9>No hay productos para mostrar</td>
            </tr>';
        }
    }
    public function subirGuia($sql, $array){
        $conexion=Db::conectar();
        $sql2="SELECT COUNT(*) as co,GROUP_CONCAT((SELECT codigoGuia FROM guia as g WHERE g.codigoGuia=guia.codigoGuia)SEPARATOR \"' , '\") as result FROM guia WHERE codigoGuia in (";
        $i=0;
        foreach($array as $x){
            $i++;
            $sql2=$sql2."'".$x."'";
            if($i!=count($array)){
                $sql2=$sql2.",";
            }
            else{
                $sql2=$sql2.");";
            }
        }
        $valido=mysqli_query($conexion, $sql2);
        $man=mysqli_fetch_array($valido);
        if($man["co"]==0){
            $valido=mysqli_query($conexion, $sql);
        }
        else{
            $valido=mysqli_query($conexion, "UPDATE guia SET fechaRegistro='".date("Y-m-d")."' WHERE codigoGuia in ('".$man["result"]."');");
        }
        return $valido;
        
    }

    public function listarProductos($inicio,$Filtros){
        $conexion=Db::conectar();
        $resultado=mysqli_query($conexion, 'SELECT guia.fechaRegistro,guia.FechaIngreso,guia.fechaFactura,inventario.icc,marca.nombre as "marca",modelo.nombre as "modelo",color.nombre as "color",valoracion.valor as "valorizacion",inventario.descripcion,inventario.locationActual,inventario.estado FROM inventario INNER JOIN guia on guia.id=inventario.guia inner join codigos on codigos.Id=inventario.codigo inner join modelo on modelo.id=codigos.id_producto  inner join color on modelo.id=color.modelo inner join marca on marca.id=modelo.marca inner join valoracion on valoracion.codigo=codigos.Id and valoracion.guia=guia.id '.$Filtros.' ORDER BY inventario.icc ASC limit '.($inicio*100).',100;');
        $i=0;
        // FECHA
        // ICC
        // MARCA
        // MODELO
        // COLOR
        // VALORIZACION
        // DESCRIPCION
        // LOCALIZACION
        // TRASLADADO
        // ESTADO
        $inicio=$inicio*100;
        while ($x = mysqli_fetch_array($resultado)) {
            $i++;
            echo '
                <tr '.($inicio+$i).'>
                    <td>'.$x["fechaRegistro"].'</td>
                    <td>'.$x["FechaIngreso"].'</td>
                    <td>'.$x["fechaFactura"].'</td>
                    <td>'.'</td>
                    <td>'.$x["icc"].'</td>
                    <td>'.$x["marca"] .'</td>
                    <td>'.$x["modelo"] .'</td>
                    <td>'.$x["color"].'</td>
                    <td>S/.'.number_format($x["valorizacion"],2).'</td>
                    <td>'.$x["descripcion"].'</td>
                    <td>'.$x["locationActual"].'</td>
                    <td>'.'</td>
                    <td>'.$x["estado"].'</td>
                </tr>';
        }
        if($i==0){

        }
    }
    public function limpiarValoracion(){
        $conexion=Db::conectar();
        $resultado=mysqli_query($conexion, 'SELECT * from valoracion');
        $ante="";
        $i=0;
        $sql="DELETE FROM valoracion WHERE id IN (";
        while ($x = mysqli_fetch_array($resultado)) {
            if($ante==$x["guia"]."-".$x["codigo"]."-".$x["valor"]){
                if($i!=0){$sql=$sql.",";}
                $i=1;
                $sql=$sql.$x["id"];
            }
            $ante=$x["guia"]."-".$x["codigo"]."-".$x["valor"];
        }
        $sql=$sql.")";
        $resultado=mysqli_query($conexion, $sql);
        echo $resultado;
    }

    
    public function subirValor($sql, $array){
        $conexion=Db::conectar();
        $sql2="SELECT COUNT(*) as co,GROUP_CONCAT((SELECT id FROM guia as g WHERE g.codigoGuia=guia.codigoGuia)SEPARATOR ', ') as result FROM guia WHERE codigoGuia in (";
        $i=0;
        $precios=[];
        foreach($array as $x){
            $i++;
            array_push($precios,$x[2]);
            $sql2=$sql2."'".$x[1]."'";
            if($i!=count($array)){
                $sql2=$sql2.",";
            }
            else{
                $sql2=$sql2.");";
            }
        }
        $valido=mysqli_query($conexion, $sql2);
        $man=mysqli_fetch_array($valido);
        if($man["co"]==0){
            $valido=mysqli_query($conexion, $sql);
        }
        else{
            $valido=mysqli_query($conexion, "UPDATE guia SET fechaRegistro=".date("Y-m-d")." WHERE codigoGuia in (".$man["result"].");");
        }
        return $valido;
        
    }
}
?>
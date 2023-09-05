<?php
require_once("../../coneccion.php");
    $cn = Db::conectar();
    $acti = strtoupper($_POST['tipificacion']);
    $tabla = $_POST['tabla'];
    mysqli_query($cn,"INSERT INTO $tabla VALUES (null,'$acti');");
    $sql=mysqli_query($cn,"SELECT * FROM $tabla;");
    while($x=mysqli_fetch_array($sql)){
        if($x[$tabla]==$acti){$s="selected";} else{$s="";} ?>
        <option <?php echo $s;?> value="<?php echo $x[$tabla];?>"><?php echo $x[$tabla];?></option>
        <?php
    }
?>|
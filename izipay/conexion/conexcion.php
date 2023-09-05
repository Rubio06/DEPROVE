<?php

    
function Conectarse(){
    // $servidor="localhost";
    // $basededatos="productos";
    // $usuario ="root";
    // $clave ="";
    
    $servidor="sql818.main-hosting.eu";
    $basededatos="u642438800_deprove";
    $usuario ="u642438800_deprove";
    $clave ="DeproveSac@1234567_";

    $cn = mysqli_connect($servidor,$usuario,$clave) or die ("Error conectando a la base de datos Almacen");
    mysqli_select_db($cn,$basededatos) or die ("Error seleccionado la base de datos Almacen");
    return $cn;
}
?>
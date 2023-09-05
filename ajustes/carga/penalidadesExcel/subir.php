<?php

//  function insertar_datos($id,$cliente,$linea,$importe,$saldo,
//  $inicial,$tipo,$fecha,$empresa,$estado1,$estado2){
//  		global $cn;
//  	$sentencia = "INSERT INTO `documentos`(`id`, `cliente`, `linea`, `importe`, `saldo`, 
// 	`inicial`, `tipo`, `fecha`, `empresa`, `estado1`, `estado2`)
// 	 VALUES ('$id','$cliente','$linea','$importe','$saldo','$inicial','$tipo',
// 	 '$fecha','$empresa','$estado1','$estado2');";
//  	$ejecutar = mysqli_query($cn,$sentencia);
//  	return $ejecutar;
//  }
	require_once ("../../../coneccion.php");
	$cn = Db::conectar();
	$sql = $_POST["query"];
	echo mysqli_query($cn,$sql);
?>
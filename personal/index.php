<?php
  require_once("../coneccion.php");
  $conexion=Db::conectar();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="./css/normalize.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/listado.css" />
  </head>
  <body>
    <?php include("../header.php") ?> 
    <main class="listado-trabajador">
      <h1 class="title">listado trabajadores   (<span id="contadorTrabaj"></span>)</h1>

      <div class="conte-trabajador">
      <button class="btn-trabajador" onclick="op=window.open('./registro.php','_blank','Nuevo','height=960px,width=940px');var timer = setInterval(function() {  if(op.closed) {clearInterval(timer);buscardato();alerta.msg('Cargando nuevos trabajadores');}  }, 1000)">NUEVO TRABAJADOR</button><br>
      </div>

      <div class="conte-filtro">
        <div>
          <label for="buscar">Buscar</label>
          <input type="text" name="buscar" id="buscar" oninput="buscardato()" />
        </div>
        <div>
          <input type="checkbox" onclick="activces()" id="busqActiv">
          <label for="buscar">ESTADO</label>
          <select name="" onchange="buscardato()" id="busqActivos" disabled>
            <option value="ACTIVO">ACTIVO</option>
            <option value="CESADO">CESADO</option>
            <option value="DESCANSO MEDICO">DESCANSO MEDICO</option>
          </select>
        </div>
        <div>
          <input type="checkbox" onclick="activces()" id="busqCarg">
          <label for="buscar">CARGO</label>
          <select onchange="buscardato()" id="busqCargo" disabled>
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
        <div>
          <input type="checkbox" onclick="activces()" id="busqSed">
          <label for="buscar">SEDE</label>
          <select onchange="buscardato()" id="busqSede" disabled>
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
      </main>


      <div class="contenedor">
        <div class="conte-table">
          <table id="myTable"class="listado">
            <thead>
              <tr>
                <th class="enca">Nombre</th>
                <th class="enca">Apellido</th>
                <th class="enca">DNI</th>
                <th class="enca">TELEFONO</th>
                <th class="enca">ESTADO CIVIL</th>
                <th class="enca">EMAIL</th>
                <th class="enca">DIRECCION</th>
                <th class="enca">BANCO</th>
                <th class="enca">FECHA DE NACIMIENTO</th>
                <th class="enca">NUMERO DE CUENTA</th>
                <th class="enca">CCI CUENTA</th>
                <th class="enca">AFP/ONP</th>
                <th class="enca">CUOTA</th>
                <!-- <th class="enca">FECHA CUOTA</th> -->
                <th class="enca">FECHA OJT</th>
                <th class="enca">CUOTA OJT</th>
                <th class="enca">RECLUTADORA</th>
                <th class="enca">CAPACITADOR</th>
                <th class="enca">CAMAPAÑA</th>
                <th class="enca">JEFE INMEDIATO</th>
                <th class="enca">EMPRESA</th>
                <th class="enca">ESTADO</th>  
                <th class="enca">MODALIDAD</th>
                <th class="enca">TURNO</th>
                <th class="enca">FECHA DE INGRESO</th>
                <th class="enca">FECHA INICIO OJT</th>
                <th class="enca">FECHA INICIO DE CAPACITACIÓN</th>
                <th class="enca">CUSPP</th>
                <th class="enca">SUELDO</th>
                <th class="enca">HORA DE INGRESO</th>
                <th class="enca">FECHA CESE OPERACION</th>
                <th class="enca">FECHA CESE PLANILLA</th>
                <th class="enca">VACACCIONES</th>
                <th class="enca">FECHA DESCANSO MEDICO DESDE</th>
                <th class="enca">FECHA DESCANSO MEDICO HASTA</th>
                <th class="enca">MOTIVO DE CESE</th>
                <th class="enca">SEDE</th>
                <th class="enca">AREA</th>
                <th class="enca">CARGO</th>
              </tr>
            </thead>
            <tbody id="cuerpotabla">
            </tbody>
          </table>
        </div>
      </div>
  </body>
</html>

<script>
  carcar=setTimeout(() =>{},1);
  const activces =()=>{
    if(document.getElementById('busqActiv').checked){
      document.getElementById('busqActivos').disabled=false;
    }
    else{
      document.getElementById('busqActivos').disabled=true;
    }
    if(document.getElementById('busqCarg').checked){
      document.getElementById('busqCargo').disabled=false;
    }
    else{
      document.getElementById('busqCargo').disabled=true;
    }
    if(document.getElementById('busqSed').checked){
      document.getElementById('busqSede').disabled=false;
    }
    else{
      document.getElementById('busqSede').disabled=true;
    }
    buscardato();
  }
  const obtenerFiltros = () =>{
    filt=" id>0 ";
    if(document.getElementById("buscar").value!=""){
      valor=document.getElementById("buscar").value;
      filt+="and (trabajador.nombre like '%"+valor+"%' or trabajador.apellido like '%"+valor+"%' or trabajador.id like '%"+valor+"%')";
    }
    if(document.getElementById('busqActiv').checked){
      filt+=" and trabajador.estado = '"+document.getElementById('busqActivos').value+"'";
    }
    if(document.getElementById('busqCarg').checked){
      filt+=" and trabajador.idcargo = '"+document.getElementById('busqCargo').value+"' ";
    }
    if(document.getElementById('busqSed').checked){
      filt+=" and trabajador.idsede = '"+document.getElementById('busqSede').value+"' ";
    }
    return filt;
  }
  const buscardato = ()=> {
    clearInterval(carcar);
    carcar=setTimeout(() =>{
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              document.getElementById("cuerpotabla").innerHTML=this.response;
              alerta.bien("Se cargaron los trabajadores");
              document.getElementById("contadorTrabaj").innerHTML=(document.getElementById("cuerpotabla").children.length);
          }
      };
    
      xmlhttp.open("POST", "./subirtra.php",true);
      data = new FormData();
      alerta.msg("Cargando");
  
      data.append("op","buscar")
      data.append("filtros", obtenerFiltros());
      xmlhttp.send(data);},
      100);
  }
  const actualizarPorId= (n)=>{
    op=window.open('', 'TheWindow','Editar','height=960px,width=940px');
    var form = $('<form target="TheWindow" action="./registro.php" method="post">' +
      '<input type="text" name="id_tra" value="' + n + '" />' +
    '</form>');
    $('body').append(form);
    form.submit();
    form.remove();
    var timer = setInterval(function() {   
      if(op.closed) {
          clearInterval(timer);
          buscardato();
          alerta.msg('Cargando nuevos trabajadores');
      }  
    }, 1000)
  }
  buscardato();
</script>
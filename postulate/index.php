<?php 
$mante="";
require_once("../coneccion.php");
$conexion=Db::conectar();
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Insersion Personal</title>
    <link rel="stylesheet" href="./css/normalize.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/trabajador.css" />
    <link rel="stylesheet" href="./css/grid.css" />
    <style>
      .botonModal{
        border-radius:5px;
        border:1px solid #00008B;
        cursor:pointer;
        background-color:rgb(18 255 255);
        padding: 0 5px;
        font-size: 20px;
      }
    </style>
  </head>
  <body>
      <?php include("../header.php") ?>
    <main class="main-trabajador">
      <h2 class="title">POSTULATE</h2>
      <button class="btn-grabar" onclick="Grabar()">Postular</button>
      <form action="#">
        <fieldset class="form__container grid__item-1">
          <div class="form__field">
            <label class="form__label" for="nombre">nombre:</label>
            <input class="form__input" type="text" name="nombre" id="nombre" >
          </div>
          <div class="form__columns-2">
            <div class="form__field">
              <label class="form__label" for="apellido">apellido:</label>
              <input
                class="form__input"
                type="text"
                name="apellido"
                id="apellido"
              />
            </div>
            <div class="form__field">
              <label class="form__label" style="margin-left:10px"for="cargo">cargo:</label>
              <select
                class="form__input form__input--bg"
                style="margin-left:-45px"
                name="cargo"
                id="cargo">

              <?php
                $x=mysqli_fetch_array(mysqli_query($conexion, "SELECT * from cargo where cargo='POSTULANTE'"));
                echo '<option value="'.$x["idcargo"].'">'.$x["cargo"].'</option>'; 
              ?>
              </select>
            </div>
          </div>
          <div class="form__columns-2">
            <div class="form__field">
              <label class="form__label">dni / doc / código:</label>
              <input class="form__input" type="text" name="dniDoc" id="dniDoc" requerid />
            </div>
            <div class="form__field">
              <label class="form__label" style="margin-left:10px" for="telefono">teléfono:</label>
              <input
                class="form__input"
                type="text"
                onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                name="telefono"
                id="telefono"
                requerid
                maxlength="10"
                style="width:80%"
              />
            </div>
          </div>
          <div class="form__columns-2">
            <div class="form__field">
              <label class="form__label" for="estadoCivil">estado civil:</label>
              <select
                class="form__input form__input--bg"
                name="estadoCivil"
                id="estadoCivil"
              >
                <option value="soltero/a">soltero/a</option>
                <option value="casado/a">casado/a</option>
                <option value="viudo/a">viudo/a</option>
              </select>
            </div>
            <div class="form__field">
              <label class="form__label" for="afpOnp">AFP / ONP:</label>
              <select
                class="form__input form__input--bg"
                name="afpOnp"
                id="afpOnp"
              >
                <option value="AFP">AFP</option>
                <option value="PRIMA">PRIMA</option>
                <option value="INTEGRA">INTEGRA</option>
                <option value="PROFUTURO">PROFUTURO</option>
                <option value="ONP">ONP</option>
              </select>
            </div>
          </div>
          <div class="form__field">
            <label class="form__label" for="email">email:</label>
            <input class="form__input" type="email" name="email" id="email">
          </div>
          <div class="form__columns-2">
            <div class="form__field">
              <label class="form__label" for="sede">sede:</label>
              <select class="form__input form__input--bg" name="sede" id="sede">
                <?php
                $x=mysqli_fetch_array(mysqli_query($conexion, "SELECT * from sede where sede='CHIMU'"));
                echo '<option value="'.$x["idsede"].'">'.$x["sede"].'</option>';
                 ?>
              </select>
            </div>
            <div class="form__field">
              <label class="form__label" for="area">área:</label>
              <select class="form__input form__input--bg" name="area" id="area">
                <?php
                $ante="";
                $con=mysqli_query($conexion, "SELECT * from area ORDER BY area Asc");
                while($x=mysqli_fetch_array($con)){
                  $s="";
                  if($ante!=strtoupper(substr($x["area"],0,1))){
                    $ante=strtoupper(substr($x["area"],0,1));
                    echo '<option disabled>'.$ante.'</option>';
                  }
                  if($x["area"]==$area){$s="selected";}
                  echo '<option '.$s.' value="'.$x["idarea"].'">'.$x["area"].'</option>';
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form__field">
            <label class="form__label" for="direccion">dirección:</label>
            <input
              class="form__input"
              type="text"
              name="direccion"
              id="direccion"
            />
          </div>
          <div class="form__columns-2">
            <div class="form__field">
              <label class="form__label" for="banco">Banco:</label>
              <select class="form__input form__input--bg" name="banco" id="banco">
             
              <?php
                $ante="";
                $con=mysqli_query($conexion, "SELECT * from banco ORDER BY banco Asc");
                while($x=mysqli_fetch_array($con)){
                  $s="";
                  if($ante!=strtoupper(substr($x["banco"],0,1))){
                    $ante=strtoupper(substr($x["banco"],0,1));
                    echo '<option disabled>'.$ante.'</option>';
                  }
                  if($x["banco"]==$banco){$s="selected";}
                  echo '<option '.$s.' value="'.$x["id"].'">'.$x["banco"].'</option>';
                }
                 ?>
              </select>
            </div>
            <div class="form__field">
              <label class="form__label" for="fechaNacimiento" style="margin-left:18px;"
                >fecha de nacimiento:</label
              >
              <input
                class="form__input"
                type="date"
                name="fechaNacimiento"
                id="fechaNacimiento"
              />
            </div>
          </div>
          <div class="form__field">
            <label class="form__label" for="nroCuenta">nro. cuenta:</label>
            <input
              class="form__input"
              type="text"
              name="nroCuenta"
              id="nroCuenta"
            />
          </div>
          <div class="form__field">
            <label class="form__label" for="nroCCI">nro. CCI:</label>
            <input class="form__input" type="text" name="nroCCI" id="nroCCI">
          </div>
          <div class="form__field">
            <label class="form__label" for="reclutadora">reclutadora:</label>
            <select name="reclutadora" id="reclutadora" class="form__input form__input--bg">
              <?php
                $ante="";
                $con=mysqli_query($conexion, "SELECT concat(nombre, ' ' ,apellido) as nombre,id from trabajador where idcargo = (select idcargo from cargo where cargo='RECLUTADOR')");
                while($x=mysqli_fetch_array($con)){
                  $s="";
                  if($ante!=strtoupper(substr($x["nombre"],0,1))){
                    $ante=strtoupper(substr($x["nombre"],0,1));
                    echo '<option disabled>'.$ante.'</option>';
                  }
                  if($x["nombre"]==$reclutadora){$s="selected";}
                  echo '<option '.$s.' value="'.$x["nombre"].'">'.$x["nombre"].'</option>';
                }
                ?>
            </select>
          <table class="table" style="display:none">
            <tr class="table__row">
              <td class="table__data">DNI</td>
              <td class="table-button">
                <button class="table-button__item">subir</button>
                <button class="table-button__item">descargar</button>
              </td>
            </tr>
            <tr class="table__row">
              <td class="table__data">Curriculum (CV)</td>
              <td class="table-button">
                <button class="table-button__item">subir</button>
                <button class="table-button__item">descargar</button>
              </td>
            </tr>
            <tr class="table__row">
              <td class="table__data">Certificado de Trabajo</td>
              <td class="table-button">
                <button class="table-button__item">subir</button>
                <button class="table-button__item">descargar</button>
              </td>
            </tr>
            <tr class="table__row">
              <td class="table__data">Certificado de Estudio</td>
              <td class="table-button">
                <button class="table-button__item">subir</button>
                <button class="table-button__item">descargar</button>
              </td>
            </tr>
            <tr class="table__row">
              <td class="table__data">Antecedentes Policiales</td>
              <td class="table-button">
                <button class="table-button__item">subir</button>
                <button class="table-button__item">descargar</button>
              </td>
            </tr>
            <tr class="table__row">
              <td class="table__data">Brevete</td>
              <td class="table-button">
                <button class="table-button__item">subir</button>
                <button class="table-button__item">descargar</button>
              </td>
            </tr>
            <tr class="table__row">
              <td class="table__data">Recibo de Servicios</td>
              <td class="table-button">
                <button class="table-button__item">subir</button>
                <button class="table-button__item">descargar</button>
              </td>
            </tr>
            <tr class="table__row">
              <td class="table__data">SOAT</td>
              <td class="table-button">
                <button class="table-button__item">subir</button>
                <button class="table-button__item">descargar</button>
              </td>
            </tr>
          </table>
        </fieldset>

        <!-- SEGUNDO GRID -->
    <script src="RegistroTrabajador.js"></script>
  </body>
</html>
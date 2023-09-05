<?php
date_default_timezone_set('America/Lima');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Asistencia de Usuario</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" rel="stylesheet">
  <style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
  </style>
</head>
<link rel="stylesheet" href="asistencia.css">
<body>


<div class="conte-asis">
  <div style="position:fixed;top:0;left: 0;right:0;z-index:3;background: transparent;text-align: center;">
	  <video style="width:400px;" muted="muted" id="video"></video>
	  <canvas id="canvas" style="display: none;"></canvas>
  </div>
  <div class="asistencia">
    <h1 class="sub-titu">REGISTRO DE INGRESOS Y SALIDAS</h1>
      <div class="asi-info">

            <div class="conte-fecha">
              <label style="font-size:20px;font-weight:600;">FECHA: </label>
              <label  id="fecha" style="font-size: 32px;color: red;"></label>
              <label id="actuhora" style="float:right;margin-right: 15px;font-size: 32px;color: red;"></label>
            </div>
            <div class="conte-dni"><label style="font-size:20px;font-weight:600;">DNI: <label><input style="font-size:20px;height:40px;width:150px;"id="dni" type="text"></div>

      </div>
      <div class="conte-nombres">
        <div class="conte-nombre">
            <label style="font-size:20px;font-weight:600;">NOMBRES PERSONA </label>
            <input id="nombre" style="font-size:20px;height:40px;width:85%;background-color: rgb(223, 231, 231);" type=text disabled/></div>
        <div class="conte-apellido">
           <label style="font-size:20px;font-weight:600;">APELLIDO PERSONA </label>
            <input id="ape" style="font-size:20px;height:40px;width:85%; background-color: rgb(223, 231, 231);"  type=text disabled/></div>

      </div>
      <div class="conte-hora">

     <div class="conte-hora-res">
      <label id="estado" style="font-size:48px;"></label>
    </div>

      </div>
      <div class="conte-botton">
        <div class="conte-bottom-res">

      <input type="button" value="REGISTRAR"  id="registrar" style="background: gray;border: red solid 2px;color: red;" disabled>  
       </div>

      </div>
 </div>

</div> .
<script src="script.js"></script>   
<script>
  conteoBorrar=setInterval(() => {}, 1);
  datos="";
  document.getElementById("dni").addEventListener('keyup',function(e){
    if(e.keyCode==13){  
      texto=document.getElementById("dni").value;
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            if(this.response=="" || this.response==null){
              alertify.error("NO SE ENCONTRO EL DNI DE ESTE TRABAJADOR");
            }
            else{
              try{
                console.log(this.response);
                var data=$.parseJSON(this.response);
                console.log(data);
                estado=document.getElementById("estado");
                document.getElementById("nombre").value=data[0]["nombre"];
                document.getElementById("ape").value=data[0]["apellido"];
                document.getElementById("ape").value=data[0]["apellido"];
                  document.getElementById("registrar").style="";
                document.getElementById("registrar").disabled=false;
                if(data[1]=="00:00:00"){
                  hora=new Date().toLocaleTimeString('en-US');
                  switch(data[0]["turno"]){
                    case "MAÑANA":
                    case "COMPLETO":
                      if(hora.substr(0,2)<10 && hora.substr(3,2)<=15) {
                        estado.innerHTML=("A TIEMPO");
                        estado.style.color="green";
                      }
                      else{
                        estado.innerHTML=("TARDANZA");
                        estado.style.color="red";
                      }
                      break;
                    case "TARDE":
                      if(hora.substr(0,2)>11 && hora.substr(3,2)>=30) {
                        estado.innerHTML=("TARDANZA");
                        estado.style.color="red";
                      }
                      else{
                        estado.innerHTML=("A TIEMPO");
                        estado.style.color="green";
                      }
                      break;
                  }
                }
                else{
                  conte=-1;
                  clearInterval(conteoBorrar);
                  estado.innerHTML=("SALIENDO DEL SISTEMA");
                  estado.style.color="red";
                  conteoBorrar=setInterval(() => {
                    conte++;
                    estado.innerHTML=("SALIENDO DEL SISTEMA <div style='font-size:20px;'>(Cancelando automaticamente en "+(10-conte)+")</div>");
                    if(conte==10){
                      conte=-1;
                      document.getElementById("nombre").value = "";
                      document.getElementById("ape").value = "";
                      document.getElementById("dni").value = "";
                      document.getElementById("estado").innerHTML = "";
                      clearInterval(conteoBorrar);
                    }
                  }, 1000);
                }
              }
              catch(e){
                console.log(this.response);
              }
            }
          }
      };
      xmlhttp.open("POST","./busqueda.php",true);
      var data = new FormData();
      data.append("txt",texto);
      xmlhttp.send(data);
    }
  });
  document.getElementById("fecha").innerHTML=new Date().toLocaleDateString();
  document.getElementById("actuhora").innerHTML=new Date().toLocaleTimeString('en-US');
  setInterval(() => {
    document.getElementById("actuhora").innerHTML=new Date().toLocaleTimeString('en-US');
  }, 1000);
</script>
</body>
</html>
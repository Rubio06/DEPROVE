<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>prueba</title>
    <link rel="stylesheet" href="prueba.css">
</head>
<body>
    
<div class="conte-prueba">


 <!-- CONTENIDO DE IMAGENES -->
  <div class="conte-prueba_img">
       <div class="img-logo">
          <img src="./assets/loga.png" width="250px" height="100px" />
        </div>
         <div class="img-fondo">
            <img src="./assets/undraw_interview_re_e5jn.svg" width="600px">
            <!-- style:width:70% -->
          </div>
  </div>

  <!-- CONTENIDO DE FORMULARIO -->
  <div class="conte-prueba_logueo">
  
  <form class="logueo-form" style="top:-500px">
    <img src="./assets/loga.png" width="250px" height="100px"/><br>
      <input type="text" placeholder="USUARIO"  class="logueo-input" id="usuario" required/><br>
      <input type="password" placeholder="CONTRASEÑA" class="logueo-input" id="contraseña" required/><br>
      <input type ="button"  class="aceptar"id="aceptar" value ="Aceptar"><BR>
      <span class="logueo-span">¿No tienes una cuenta registrada?</span><a class="logueo-a" href="javascript:mover()">Registrate y  usa gratis  </a>
</form>
  
  <form class="logueo-form logueo-form-1" style="top:auto;">
    <h1>Registrar Empresa</h1>
    <input type="email" placeholder="EMAIL"  class="logueo-input" id="email" required/><br>
    <input type="password" placeholder="CONTRASEÑA" class="logueo-input" id="CONTRASEÑA" required/><br>
    <input type="number" placeholder="DNI" class="logueo-input" id="dni" required/><br>
    <input type="number" placeholder="TELEFONO" class="logueo-input" id="telf" required/><br>
    <input type="text" placeholder="NOMBRE DE EMPRESA" class="logueo-input" id="empresa" required/><br>
    <input type="number" placeholder="RUC DE EMPRESA*" class="logueo-input" id="ruc" required/><br>
    <input type="number" placeholder="COMFRIMAR RUC EMPRESA*" class="logueo-input" id="com-ruc" required/><br>
    <input type ="button"  class="aceptar"id="registrar" value ="Registrar"><BR>
    <span class="logueo-span">¿Ya estás registrado?</span><a class="logueo-a" href="javascript:mover()">Iniciar sesión </a>
</form>
</div>

</div>
</body>
</html>
<script>
 i=0;
  const carga = () => {
    log=document.getElementsByClassName("logueo-form")[0];
    log.style.top="";
  }
  window.onload=carga();
  document.getElementsByClassName("logueo-form")[1].style.top=(innerHeight+1500)+"px";

  const mover = () => {
   if(i==0){
    document.getElementsByClassName("logueo-form")[0].style.top="-500px";
    document.getElementsByClassName("logueo-form")[1].style.top="50%";
   }
   else{
    document.getElementsByClassName("logueo-form")[0].style.top="";
    document.getElementsByClassName("logueo-form")[1].style.top=(innerHeight+1500)+"px";
    i=-1;
   }
   i++;
  }
</script>
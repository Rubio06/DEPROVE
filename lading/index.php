<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deprove Global</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>

</head>
<body>
<?php include("./header.php") ?>
    
  <!-- BANNER DE SLIDER -->
  <div id="carouselExampleCaptions" style="position:relative"class="carousel slide" data-bs-ride="false">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="<?php echo $ruta ?>/lading/assets/team-1.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>First slide label</h5>
          <p>Some representative placeholder content for the first slide.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="<?php echo $ruta ?>/lading/assets/team-2.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Second slide label</h5>
          <p>Some representative placeholder content for the second slide.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="<?php echo $ruta ?>/lading/assets/team-3.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Third slide label</h5>
          <p>Some representative placeholder content for the third slide.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
    <a class="postulante" href="https://deproveglobal.com/postulate/"><input style="padding:5px 10px; background:red;color:black;border-radius:10px;border: 2px solid black;font-weight: 600;
    outline: none;"type="button" value="POSTULATE AQUI" /></a>
  </div>

  

<div class="conte-inicio">
    <!-- border: 1px solid black -->
    <div class="cont-servi_titulo">
        <h1 class="titulo-inicio" data-aos="fade-right">QUIÉNES SOMOS</h1>
        <div style="display:flex;flex-direction: row;">
            <div class="bar-1"></div>
            <div class="bar-2"></div>
        </div>
    </div>
   <div style="width: 85%;">
        <h3 style="color:var(--main-red-color);font-size: 20px;font-weight: 600;">Empresa distribuidora socia Comercial de CLARO</h3>
        <p style="font-size: 17px;">Como Distribuidora autorizada, somos responsables de la colocación exclusiva de los productos y servicios de Claro orientados al público consumidor y corporativo en Perú (productos de telefonía movil, fija, cable e Internet).</p>
        
        <div style="width: 100%;display:flex;justify-content:center;">
           
            <!-- <img  src="<?php echo $ruta ?>/lading/assets/team.jpg" width="550" height="280" style="border-radius: 10px;"/> -->
            <iframe data-aos="flip-left" style="border-radius: 10px;border: 2px solid red;"width="550" height="280" src="https://www.youtube.com/embed/cKvgfOGU0s0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
    <div class="cont-servi_titulo">
        <h1 class="titulo-inicio">MISIÓN Y VISIÓN</h1>
        <div style="display:flex;flex-direction: row;">
            <div class="bar-1"></div>
            <div class="bar-2"></div>
        </div>
    </div>
    <div  class="conte-inicio_MV">

        <div class="MV-popup" data-aos="flip-left">
            <p style="font-size: 17px;font-weight:500;">Generar y adaptar servicios de alta calidad mediante nuestra suma de valor, anticipándonos a las necesidades de nuestros clientes y satisfacer las necesidades que tengan haciéndolos más rentables.</p>

        </div>
        <div class="MV-popup" data-aos="flip-left">
            <p style="font-size: 17px;font-weight:500;">Consolidarnos en el mercado como una empresa líder de Call Center.</p>

        </div>
    </div>
</div>

  <!-- <contenido cartas> -->
<div class="cont-servi">
    <div class="cont-servi_titulo">
        <h1 class="titulo-inicio" data-aos="fade-right">NUESTROS VALORES</h1>
        <div style="display:flex;flex-direction: row;">
            <div class="bar-1"></div>
            <div class="bar-2"></div>
        </div>
    </div>
    <!-- CARTAR  -->

            <div class="conte-card" data-aos="fade-up">

                <div class="servi-card"  >
                    <div class="servi-card_pop">
                        <img src="https://cdn-icons-png.flaticon.com/512/3138/3138297.png " width="60px" height="60px" alt="servicio-deprove"/>
                    </div>
                    <div class="Card">
                        <h3 class="Card-titulo">EFECTIVIDAD</h3>
                        <p class="Card-p">Buscamos lograr los resultados propuestos y comprometidos</p>
                        
                    </div>
                </div>
                <div class="servi-card" >
                    <div class="servi-card_pop">
                        <img src=" https://cdn-icons-png.flaticon.com/512/921/921306.png " width="60px" height="60px" alt="servicio-deprove"/>
                    </div>
                    <div class="Card">
                        <h3 class="Card-titulo">PROFESIONALIDAD</h3>
                        <p class="Card-p">Aplicamos los conocimientos y habilidades profesionales del negocio en todas nuestras actuaciones.</p>
                        
                    </div> 
                </div>
                <div class="servi-card" >
                    <div class="servi-card_pop">
                        <img src=" https://cdn-icons-png.flaticon.com/512/5984/5984564.png " width="60px" height="60px" alt="servicio-deprove"/>
                    </div>
                    <div class="Card">
                        <h3 class="Card-titulo">INTEGRACIÓN</h3>
                        <p class="Card-p"> Integramos al personal para un trabajo en equipo orientado a las metas empresariales que se han trazado.</p>
                        
                    </div>   
                </div>

                <div class="servi-card" >
                    <div class="servi-card_pop">
                        <img src="https://cdn-icons-png.flaticon.com/512/3663/3663188.png " width="60px" height="60px" alt="servicio-deprove"/>
                    </div>
                    <div class="Card">
                        <h3 class="Card-titulo">INNOVACION</h3>
                        <p class="Card-p">Adaptamos la empresa a los cambios tecnológicos en búsqueda de la capacidad innovadora.</p>
                        
                    </div>   
                </div>
                
            </div>        
</div>

<!-- CONTENIDO DE CLIENTE -->

    <div class="conte-cli">
        <div class="conte-cli_1">
            <div class="cliente-card" data-aos="zoom-in">
                 
                <div style="overflow: hidden;display:flex;justify-content: center;border:5px solid white;z-index:5;border-radius: 50%;">
                <img src="https://planesclarohogar.com/wp-content/uploads/2022/06/images-2.png"  width="155px" height="150px"  style="overflow: hidden"/></div>
                <h3 style="color:white;font-weight: 600;margin-top: 5px;">CLARO</h3>
                <span style="color:white">Lorem ipsum, dolor sit amet</span>
            </div>
        </div>
        <div class="conte-cli_2">
            <h3 style="font-size:40px; color:white;font-weight: 600;">Lorem ipsum dolor sit amet consectetur.</h3>
            <span style="color:white;font-size: 19px;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nulla facilis tempore in rem quidem perspiciatis laborum saepe beatae neque recusandae deserunt placeat, iusto non perferendis! Ut iure neque quas consectetur ipsa voluptates atque aut perspiciatis quis nisi inventore obcaecati eum tenetur </span>

        </div>
    </div>

 <!--  TITULO AREAS-->
 <div class="cont-servi_titulo"style="margin-top:30px;margin-bottom:30px">
    <h1 class="titulo-inicio" data-aos="fade-right">AREAS</h1>
    <div style="display:flex;flex-direction: row;">
        <div  class="bar-1"></div>
        <div  class="bar-2"></div>
    </div>
    
</div>

     <!-- CONTE AREAS -->
    <div class="conte-area">
        <div class="area-blue" data-aos="fade-right">
            
         <div name="descripcionFicha" style="transition: all 0.3s ease 0s;opacity:1;">
            <h3 class="area-titulo_blue"> AREA DE BACK OFFICE:</h3>
            <div>
                <div style="display: flex;flex-direction: row;">
                    <img class="icono-area"src="https://cdn-icons-png.flaticon.com/512/1375/1375117.png " width="100px" height="100px"  alt="servicio-deprove"/>
                    <p class="area-p_blue"> Generar números de acuerdos en ventas realizadas (alta nueva, portabilidad, renovación y reposición). Revisión, Activación y anulación de pedidos. Revisión y Realización de contratos de SIGEX. Control, archivo de documento de identidad y fotografía del cliente al momento de la activación de las operaciones. Comprobación y supervisión de la post venta. Control de los activadores del área según las funciones de cada uno. Control y manejo de los formatos de contratos de ventas para su entrega en las diferentes áreas (validación y tiendas</p>
                </div>
             
            </div>
            </div>

            <div name="ImagenFicha" style="transition: all 0.3s ease 0s;position: absolute;opacity:0;margin-bottom:30px;">
                <div class="conte-ventas">
                    <img src="<?php echo $ruta ?>/lading/assets/venta.jpg" class="img">
                    <span class="venta">BACK OFFICE</span>
                </div> 
            </div>
                
                <div style="width: 100%;display:flex;justify-content: center;">
                    <input class="area-button_blue"onclick="mostrarVenta(0)"type="button" name="botton-venta"value="VER">
                </div>  
             
        </div>
        <div class="area-white" data-aos="fade-left">
            <div name="descripcionFicha" style="transition: all 0.3s ease 0s;opacity:1;">
                <h3 class="area-titulo_white"> DESPACHO</h3>
                <div>
                    <div style="display: flex;flex-direction: row;">
                        <img  class="icono-area" src=" https://cdn-icons-png.flaticon.com/512/2830/2830305.png " width="100px" height="100px"  alt="servicio-deprove"/>
                        <p class="area-p_white">El personal de despacho (motorizados) se encargan de contactar al cliente para coordinar la entrega de su pedido a ruta (chips, equipos, olos, hfc, entre otros).</p>
                    </div>
                
                </div>
            </div>
            <div name="ImagenFicha" style="transition: all 0.3s ease 0s;position: absolute;opacity:0;">
                <div class="conte-ventas">
                    <img src="<?php echo $ruta ?>/lading/assets/venta.jpg" class="img">
                    <span class="venta">DESPACHO</span>
                </div> 
            </div>
            <div style="width: 100%;display:flex;justify-content: center;">
                <input class="area-button_white" onclick="mostrarVenta(1)"type="button" name="botton-venta"value="VER">
            </div>  
        </div>
        <div class="area-blue" data-aos="fade-right">
            <div name="descripcionFicha" style="transition: all 0.3s ease 0s;opacity:1;">
               <h3 style="color:white;font-size:31;"> AREA ADMINISTRACION/CONTABLE:</h3>
               <div>
                   <div style="display: flex;flex-direction: row;">
                       <img class="icono-area" src="https://cdn-icons-png.flaticon.com/512/2234/2234659.png " width="100px" height="100px"  alt="servicio-deprove"/>
                       <p class="area-p_blue">Encargados de actualizar y mantener al día los procedimientos, así como las bases de datos, prestar apoyo especial al departamento de Recursos Humanos para la realización de las gestiones administrativas relacionadas con el personal y descritas anteriormente.
                        Desarrollar y supervisar registros y archivos de contabilidad, verificación de que todas las transacciones se registran según el marco legal, elaboración de balances de ingresos y gastos y declaración de impuestos.</p>
                   </div>
                
               </div>
           </div>
   
           <div name="ImagenFicha" style="transition: all 0.3s ease 0s;position: absolute;opacity:0;">
               <div class="conte-ventas">
                   <img src="<?php echo $ruta ?>/lading/assets/venta.jpg" class="img">
                   <span class="venta">ADMINISTRATIVA</span>
               </div> 
           </div>
               
                <div style="width: 100%;display:flex;justify-content: center;">
                   <input class="area-button_blue" onclick="mostrarVenta(2)"type="button" name="botton-venta"value="VER"/>
               </div>  
                
           </div>
           <div class="area-white" data-aos="fade-left">
            <div name="descripcionFicha" style="transition: all 0.3s ease 0s;opacity:1;">
                <h3 class="area-titulo_white">AREA DE OPERACIONES:</h3>
                <div>
                    <div style="display: flex;flex-direction: row;">
                        <img class="icono-area" src="https://cdn-icons-png.flaticon.com/512/4149/4149660.png " width="100px" height="100px"  alt="servicio-deprove"/>
                        <p class="area-p_white">En la estructura organizacional de un call center, y específicamente en esta área, los coordinadores o supervisores son los responsables de mantener todo en orden entre los teleoperadores.</p>
                    </div>
                
                </div>
            </div>
            <div name="ImagenFicha" style="transition: all 0.3s ease 0s;position: absolute;opacity:0;">
                <div class="conte-ventas">
                    <img src="<?php echo $ruta ?>/lading/assets/venta.jpg" class="img">
                    <span class="venta">OPERACIONES</span>
                </div> 
            </div>
            <div style="width: 100%;display:flex;justify-content: center;">
                <input class="area-button_white" onclick="mostrarVenta(3)"type="button" name="botton-venta"value="VER">
            </div>  
        </div>
        <div class="area-white" data-aos="fade-left">
         <div name="descripcionFicha" style="transition: all 0.3s ease 0s;opacity:1;">
            <h3 class="area-titulo_white"> AREA DE RRHH:</h3>
            <div>
                <div style="display: flex;flex-direction: row;">
                    <img class="icono-area" src="https://cdn-icons-png.flaticon.com/512/6839/6839456.png " width="100px" height="100px"  alt="servicio-deprove"/>
                    <p class="area-p_white">Está enfocado en el análisis de los puestos de trabajo, el reclutamiento/contratación y la selección de personal, la formación y el desarrollo, la compensación y los beneficios, la gestión del rendimiento, las relaciones con los directivos y las relaciones laborales para obtener el mejor desempeño humano.</p>
                </div>
             
            </div>
        </div>

        <div name="ImagenFicha" style="transition: all 0.3s ease 0s;position: absolute;opacity:0;">
            <div class="conte-ventas">
                <img src="<?php echo $ruta ?>/lading/assets/venta.jpg" class="img">
                <span class="venta">RRHH</span>
            </div> 
        </div>
            
             <div style="width: 100%;display:flex;justify-content: center;">
                <input class="area-button_white" onclick="mostrarVenta(4)"type="button" name="botton-venta"value="VER"/>
            </div>  
             
        </div>
       
    </div>
    <!-- CONTENIDO DE CONTATOS -->

    <div  class="conte-contac">

        <div class="conte-contac_des">
            <div class="conte-contac_des-sub">
                <h3  class="contac_des-titulo">HABLEMOS</h3>
                <p style="color: black;font-size:20px;font-weight: 600;">¿Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit?
                </p>
                <span style="color: black;font-size: 17px;text-align: justify;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Velit ex aliquid quod porro obcaecati quaerat commodi minima quidem. Quam ut doloribus earum unde. Temporibus minima fuga possimus mollitia, itaque dicta s!
            oribus earum unde. Temporibus minima fuga possimus mollitia, itaque dicta s!</span>
             </div>   

        </div>
        <div class="contac-formulario">
                <div class="contac-form_conte">
                    <label class="contac-label" for="nombre">Nombre</label>
                    <input class="form-input"type="text" name="nombre" id="nombre" placeholder="Nombre" required autocomplete="off">
                </div>
                <div class="contac-form_conte">
                    <label class="contac-label" for="correo">Correo Electronico</label>
                    <input class="form-input"type="email" name="Correo" id="correo" placeholder="Correo Electronico" required>
                </div>
                <div class="contac-form_conte">
                    <label class="contac-label" for="mensaje">Mensaje</label>
                    <textarea class="form-textarea"name="mensaje" style="resize: none;"id="mensaje" cols="20" rows="7" placeholder="MENSAJE" required ></textarea>
                    
                </div>
                <div style="width: 100%;position:relative;">
                    <input type="submit" class="button-form" value="Enviar">
                </div> 
        </div>      
    </div>



    <!-- FOOTER -->
    <div class="footer-sgv">
    </div>
    <div class="conte-footer">

        <div class="conte-footer_des" >
            <img src="https://deproveglobal.com/log.png" style="width: 150px;margin: 15px;"/>
            <p style="text-align: justify;font-weight: 600;color: white;">Empresa distribuidora socia Comercial de CLARO  autorizada, somos responsables de la colocación exclusiva de los productos y servicios de Claro orientados al público consumidor y corporativo en Perú .</p>
        </div>
        <div class="conte-footer_social">
            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=312513574327549" width="340" height="280" style="border:none;overflow:hidden;border-radius: 10px;" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
        </div>

        <div class="foote-social_iconos">
            <h3 style="font-weight: 800;font-size:30px;color:white">REDES SOCIALES</h3>
            <div class="conte-iconos"style="width: 100%;display: flex;justify-content: space-around;flex-wrap: wrap;">
                <img class="icono-footer"src="<?php echo $ruta ?>/lading/assets/bxl-facebook-circle.svg" alt="facebook"/>
                <img class="icono-footer"src="<?php echo $ruta ?>/lading/assets/bxl-instagram-alt.svg" alt="instagram"/>
                <img class="icono-footer"src="<?php echo $ruta ?>/lading/assets/bxl-youtube.svg " alt="youtube"/>
                <a href="https://www.tiktok.com/@deprove.teamchimu?_t=8XPHcXatpJt&_r=1" target="_blank"><img class="icono-footer"src="<?php echo $ruta ?>/lading/assets/bxl-tiktok.svg" alt="tiktok-deproveglobal"/></a>
            </div>
    </div>
    </div>


    <div style="background-color: #E3E3E3; width: 100%;height:40px; position:relative;">
        <div style="width:100%;height:5px;background-color:rgb(0, 0, 0);position: absolute;top:0">
        </div>
         <p style="position: absolute;left: 50%;top: 50%;transform: translate(-50%,-50%);font-weight: 600;font-size: small;width: max-content;">Copyright © 2022 DEPROVEGLOBAL</p>
    </div>
      <!-- --telefono-- -->
      <a href="https://wa.me/+51954293107/?text=Me%20interesa%20su%20servicio" class="btn-wsp" target="_blank" style="text-decoration: none;">
        <img src="<?php echo $ruta ?>/lading/assets/bxl-whatsapp.svg" width="50px" height="50px">
    </a>
    <script src="<?php echo $ruta ?>/lading/deprove.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init({
        duration: 1000,
        once:true
    });
    
    </script>
</body>
</html>
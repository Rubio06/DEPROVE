<?php 
    include ("../../../coneccion.php");
    $cn = Db::conectar();
    $rslistar = "select * from planes;";
    $listar = mysqli_query($cn,$rslistar);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRO DE LOCACION</title>
    <link rel="stylesheet" href="locacion.css">
</head>
<body>
    <?php include("../../../header.php") ?>
   <div class="contenedor">
<div class="contenedor-planes">
         <div class="planes">
         <div class="planes-clase"><label>DIRECCION</label> <input type="text"id=""></div>
         <div class="planes-clase"><label>NUMERO</label> <input type="text"id=""></div>
         <div class="planes-clase"><label>SERIE</label> <input type="text"id=""></div>
    <div  class="planes-clase" ><input type="button" id="planes" class="button-planes" value="INGRESAR LOCACION"/></div>
    </div>
  <div class="contenedor-planes_titulo"><h1>REGISTRO DE LOCACION KOMUNICATE</h1></div>
</div>
</div> 

<div class="conte-tabla">
 <div  style="overflow:scroll;width: 90%;margin: auto;max-height: 450px;">
<table >
    <thead>
    <tr>
        <th class="encabezado">SERIE</th>
        <th class="encabezado">RAZON SOCIAL</th>
        <th class="encabezado">RUC</th>
        <th class="encabezado">DIRECCION</th>
        <th class="encabezado">DISTRITO</th>
        <th class="encabezado">PAIS</th>
        <th class="encabezado">DEPARTEMENTO</th>
        <th class="encabezado">CIUDAD</th>
        <th class="encabezado">NOMB. LOCACION</th>
        <th class="encabezado">DIRECCION LOCACION</th>
        <th class="encabezado">NUMERO 1</th>
        <th class="encabezado">NUMERO 2</th>
        <th class="encabezado">NUMERO 3</th>
        <th class="encabezado">PERSONA</th>
       <th class="encabezado">N° DE AUTORIZACIÓN</th>
       <th class="encabezado">N° DE REGISTRO</th>
       <th class="encabezado">ANULACION</th>
       <th class="encabezado">COMPRAS</th>
       <th class="encabezado">CAJA</th>
       <th class="encabezado">DESCUENTOS</th>
       <th class="encabezado">HOST</th>
       <th class="encabezado">CORREO</th>
       <th class="encabezado">CONTRASEÑA</th>
       <th class="encabezado">U. Nro. BOLETA</th>
       <th class="encabezado">U. Nro. FACTURA</th>
       <th class="encabezado">U. Nro. TICKET</th>
       <th class="encabezado">U. Nro. CREDITO</th>
       <th class="encabezado">U. Nro. DEBITO</th>
       <th class="encabezado">T.U</th>
    </tr>
    </thead>
     <tbody id="tbTec" >
    <tbody>
</tbody>
</table>
</div>
</div>
<!-- -----------------------------Modal de Registro de Planes-------------------- -->
<div id="miModal" class="modal">
            <div class="flex" id="flex">
                <div class="contenido-modal">
                    <div class="modal-header flex">
                        <h2>LOCACION</h2>
                        <span class="close" id="close">&times;</span>
                    </div>
                    <div class="modal-body">
                            <input id="tipo" type="button" style="font-size: 2rem;border:none;background: none;color:red; font-weight: 500;margin:10px; " value="KOMUNICATE" />
                                
                                <div style="border:3px solid #55565a; border-radius:10px;position:relative;padding:10px;height: max-content;display:flex;justify-content: space-between;flex-wrap: wrap;align-items: center;">
                                <span style="position:absolute;top:-10px; left: 5px;background-color: white;font-size: 19px;">DATOS GENERALES :</span>
                                        <div style="display:flex;flex-direction:column;padding: 15px;">
                                            <div style="margin: 5px;display:flex;justify-content: space-between;align-items: center";><label >SERIE :</label><input class="input-style" id="serie" type="text" /></div>
                                            <div style="margin: 5px;display:flex;justify-content: space-between;align-items: center";><label >RAZON SOCIAL :</label><input  class="input-style" id="razon" type="text" /></div>
                                            <div style="margin: 5px;display:flex;justify-content: space-between;align-items: center";><label >RUC :</label><input class="input-style" id="rucdev" type="text" /></div>
                                            <div style="margin: 5px;display:flex;justify-content: space-between;align-items: center";><label >DIRECCION :</label><input  class="input-style" id="direccion" type="text" /></div>
                                            <div style="margin: 5px;display:flex;justify-content: space-between;align-items: center";><label> DISTRITO: </label><input class="input-style" id="distrito" type="text"/></div>
                                            <div style="margin: 5px;display:flex;justify-content: space-between;align-items: center";><label> PAIS :</label><input class="input-style" id="pais" type="text"/></div>
                                            <div style="margin: 5px;display:flex;justify-content: space-between;align-items: center";><label> DEPARTAMENTO :</label><input class="input-style" id="departamento" type="text"/></div>
                                            <div style="margin: 5px;display:flex;justify-content: space-between;align-items: center";><label> CIUDAD :</label><input class="input-style" id="ciudad" type="text"/></div>
                                        </div>
                                        <div style="display:flex;flex-direction:column;padding: 15px;">
                                            <div  style="margin: 5px;display:flex;justify-content: space-between;align-items: center;"><label>NOMB. LOCACION :</label><input class="input-style" type="text" id="nom_locacion"/></div>
                                            <div  style="margin: 5px;display:flex;justify-content: space-between;align-items: center;"><label >DIRECCION LOCACION:</label><input class="input-style"  id="direc_locacion" type="text" /></div>
                                            <div  style="margin: 5px;display:flex;justify-content: space-between;align-items: center;"><label >NUMERO 1: </label><input  class="input-style" id="numero" type="number" /></div>
                                            <div  style="margin: 5px;display:flex;justify-content: space-between;align-items: center;"><label >NUMERO 2: </label><input  class="input-style" id="numero2" type="number2" /></div>
                                            <div  style="margin: 5px;display:flex;justify-content: space-between;align-items: center;"><label >NUMERO 3: </label><input  class="input-style" id="numero3" type="number3" /></div>
                                            <div  style="margin: 5px;display:flex;justify-content: space-between;align-items: center;"><label>PERSONA DE </label><input class="input-style" id = "persona" type="text"></div>
                                            <div  style="margin: 5px;display:flex;justify-content: space-between;align-items: center;"><label >N° DE AUTORIZACIÓN: </label><input  class="input-style" id="num_auto" type="text"/></div>
                                            <div  style="margin: 5px;display:flex;justify-content: space-between;align-items: center;"><label >N° DE REGISTRO: </label><input  class="input-style" id="num_reg" type="text"/></div>
                                    
                                    </div>
                                </div>
                                <div style="border:3px solid #55565a; border-radius:10px;position:relative;padding:10px;height: max-content;display:flex;flex-wrap: wrap;align-items: center;margin-top:10px;">
                                <span style="position:absolute;top:-10px; left: 5px;background-color: white;font-size: 19px;">CLAVES :</span>
                                        <div style="display:flex;flex-direction:column;padding: 15px;">
                                            <div style="margin: 5px;display:flex;justify-content: space-between;align-items: center";><label >ANULACION: </label><input class="input-style" id="anulacion" type="number" /></div>
                                            <div style="margin: 5px;display:flex;justify-content: space-between;align-items: center";><label >COMPRAS:</label><input class="input-style" id="compras" type="number" /></div>
                                            <div style="margin: 5px;display:flex;justify-content: space-between;align-items: center";><label >CAJA :</label><input class="input-style" id="caja" type="number" /></div>
                                            <div style="margin: 5px;display:flex;justify-content: space-between;align-items: center";><label >DESCUENTOS :</label><input class="input-style" id="descuentos" type="number" /></div>
                                        </div>
                                      
                                </div> 
                                <div style="border:3px solid #55565a; border-radius:10px;position:relative;padding:10px;height: max-content;display:flex;flex-wrap: wrap;align-items: center;margin-top:10px;">
                                <span style="position:absolute;top:-10px; left: 5px;background-color: white;font-size: 19px;">CONFIGURACION DE CORREO :</span>
                                        <div style="display:flex;flex-direction:column;padding: 15px;">
                                            <div style="margin: 5px;display:flex;justify-content: space-between;align-items: center";><label >HOST :</label><input class="input-style" id="host" type="text"/></div>
                                            <div style="margin: 5px;display:flex;justify-content: space-between;align-items: center";><label >CORREO :</label><input class="input-style" id="correo" type="mail"/></div>
                                            <div style="margin: 5px;display:flex;justify-content: space-between;align-items: center";><label >CONTRASEÑA :</label><input class="input-style" id="contraseña" type="text"/></div>
                                        </div>
                                      
                                </div> 
                                <div style="border:3px solid #55565a; border-radius:10px;position:relative;padding:10px;height: max-content;display:flex;flex-wrap: wrap;align-items: center;margin-top:10px;">
                                <span style="position:absolute;top:-10px; left: 5px;background-color: white;font-size: 19px;">FACTURACIÓN :</span>
                                        <div style="display:flex;flex-direction:column;padding: 15px;">
                                            <div style="margin: 5px;display:flex;justify-content: space-between;align-items: center";><label> U. Nro. BOLETA :</label><input  class="input-style" id="boleta"tye="number"/></div>
                                            <div style="margin: 5px;display:flex;justify-content: space-between;align-items: center";> <label> U. Nro. FACTURA :</label><input class="input-style"  id="factura"tye="number"/></div>
                                            <div style="margin: 5px;display:flex;justify-content: space-between;align-items: center";><label> U. Nro. TICKET :</label><input  class="input-style" id="ticket"tye="number"/></div>
                                            <div style="margin: 5px;display:flex;justify-content: space-between;align-items: center";><label> U. Nro. CREDITO :</label><input  class="input-style" id="credito"tye="number"/></div>
                                            <div style="margin: 5px;display:flex;justify-content: space-between;align-items: center";><label> U. Nro. DEBITO :</label><input  class="input-style" id="debito"tye="number"/></div>
                                            <div style="margin: 5px;display:flex;;align-items: center";><input type="radio" id="tu" value="INFORMACION"><label>T.U</label></div>
                                        </div>
                                   
                                </div> 
                                <div style="width: 100%;display:flex; justify-content: center;margin: 5px;">
                                   <input type="button" style="cursor: pointer;padding: 10px 20px;font-size:20px;color: yellow;background-color: red;border: 5px solid yellow;border-radius: 10px;"onclick="GrabarLoca()"  class="button" value="GUARDAR LOCACION">
                                </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="Modal.js"></script>
        <script src="registro.js"></script>
</body>
</html>
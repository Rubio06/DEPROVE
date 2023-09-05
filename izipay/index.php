<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script src="./js/main.js"></script>
    <script src="./js/modal.js"></script>

</head>
<body>
<?php include("../header.php") ?>
    <br>
    <br>
    <h1 style="background: rgb(228, 243, 54); font-size: 33px; padding: 10px; text-align: center;">BOLETAS</h1>

    <br>
    <div class="formulario1" id="formulario1" style="min-width: 1300px; max-width: 1300px;diplay:flex;">
        <!-- FORMULARIO1 -->
    <div style="diplay:flex;flex:direction:column">
        <div style="padding: 20px; border-radius: 15px; background: rgb(238, 247, 225);border: 5px solid black; margin:20px;position:relative;">
       
            <div class="form1" style="min-width: 600px; max-width: 600px;">
                <div class="parte1" style="display:flex; justify-content:space-between;">
                    <label for="">SERIE</label>
                    <input type="text" class="numero-factura" name="serie" id="serie" style="width: 300px;" >
                </div>
                <br>
                <div class="parte1" style="display:flex; justify-content:space-between;">
                    <label for="">NUMERO</label>
                    <input type="text" class="numero-factura" name="numero" id="numero" style="width: 300px;" >
                </div>
                <br>
            
            </div>
        </div>


        <div style="padding: 20px; border-radius: 15px; background: rgb(238, 247, 225);border: 5px solid black; margin:20px;position:relative;">
        <div id="fondo" style="background:#7b849161;z-index:1;width:100%;height:100%;position:absolute;top:0;left:0;"></div>
        <input type="checkbox" name="formVali" style="position:absolute;top:-10px;width:20px;height:20px;z-index:2;" onclick="pActi()" id="check1"/>
            <div class="form1" style="min-width: 600px; max-width: 600px;">
              
                <div class="parte1" style="display:flex; justify-content:space-between;">
                    <label for="">EMPRESA</label>
                    <input type="text" class="empresa" name="empresa" id="empresa" style="width: 300px;" disabled="true">
                </div>
                <br>
                <div style="display:flex; justify-content:space-between;">
                    <label for="">FECHA EMISION</label>
                    <input type="date" class="fecha-emision" id="fechaemision" name="fechaemision" style="width: 300px;"
                        disabled="true" value="<?php 
                    date_default_timezone_set('America/Lima');
                    $fecha_actual = date("Y-m-d");
                    echo $fecha_actual?>">
                </div>
                <br>
                <div style="display:flex; justify-content:space-between;">
                    <label for="">BUSCADOR (NOMBRE / DNI)</label>
                    <input type="text" class="codigo-ficha" oninput="BucarProveedor()" id="nombredni" name="nombredni"
                        style="width: 300px; background: rgb(165, 243, 134);" >
                </div>
                <br>
                <div style="display:flex; justify-content:space-between;">
                    <label for="">BUSCADOR (CODIGO FICHA)</label>
                    <input type="text" class="codigo-ficha" id="buscador" oninput="BuscarCodigo()" name="buscador"
                        style="width: 300px; background: rgb(243, 134, 134);">
                </div>
                <br>
                <div style="display:flex; justify-content:space-between;">
                    <label for="">CODIGO FICHA</label>

                    <select onchange="sacarDataOption()" name="" class="codigoficha" id="codigoficha" name="codigoficha"
                        style="width: 300px;">

                    </select>
                </div>
                <br> 
                <div>
                    <input type="text" id="estado" name="estado" value="ANULADO" style="display: none;">
                </div>
            </div>
        </div>
        <div style="padding: 20px; border-radius: 15px; background: rgb(238, 247, 225);border: 5px solid black;margin:20px;position:relative;" >
        <div id="fondo2" style="background:#7b849161;z-index:1;width:100%;height:100%;position:absolute;top:0;left:0;"></div>

            <input type="checkbox" name="formVali" id="check2"style="position:absolute;top:-10px;width:20px;height:20px;z-index:2;" onclick="sActi()" >
        
            <div class="form1" style="min-width: 600px; max-width: 600px;">  
                <div style="border:2px solid black; padding: 35px; border-radius: 5px;">
                    <div style="display:flex; justify-content:space-between;position:relative;">
                    <label for="" style="position: absolute; top:-50px; background: rgb(19, 19, 20); color: white; border:2px solid black; border-radius: 5px;">INGRESO MANUAL</label>
                        <label for="">CODIGO UNICO</label>
                        <input type="text" class="direccion" id="codigounico" name="codigounico" style="width: 300px;" >
                    </div>
                </div>
                <br>
                <div class="parte1" style="display:flex; justify-content:space-between;">
                    <label for="">MONTO</label>
                    <input type="text" class="empresa" name="monto" id="monto" style="width: 300px;">
                </div>
            </div>
        </div>
     </div>
        <!-- FORMULARIO2 -->
        <div class="form2" >
            <label for="">PAGOS</label>
            <br>
            <br>
            <div style="border: 2px solid black; padding: 20px; border-radius: 10px;">
                <div class="contenido-radio1">
                    <div class="contenidoradio">
                        <input checked type="radio" name="contado" id="contadoefectivo">
                        <label for="">CONTADO</label>
                    </div>
                    <div class="contenidoradio">
                        <input type="radio" name="contado" id="rbdcontado2">
                        <label for="">CREDITO</label>
                    </div>
                </div>
                <br>
                <div class="contenido-radio2">
                    <div class="rbdias1">
                        <input checked type="radio" name="dias" id="rbdias1">
                        <label for="">30 DIAS</label>
                    </div>
                    <br>
                    <div class="rbdias2">
                        <input type="radio" name="dias" id="rbdias2">
                        <label for="">60 DIAS</label>
                    </div>
                    <br>
                    <label for="" class="vencimiento">VENCIMIENTO</label>
                </div>
            </div>
            <br>
            <div>
                <div style="border: 2px solid black; padding: 20px; border-radius: 10px;">
                    <div class="contenido-radio1">
                        <div class="contenidoradio">
                            <label for="">MEDIO DE PAGO</label>
                        </div>
                    </div>
                    <br>
                    <div class="pagos">
                        <div class="rbtarjeta">
                            <input checked type="radio" name="pagos" id="rbpagotarjeta">
                            <label for="">TARJETA</label>
                        </div>
                        <br>
                        <div class="rbefectivo">
                            <input type="radio" name="pagos" id="rbpagoefectivo">
                            <label for="">EFECTIVO</label>
                        </div>
                        <br>
                        <div class="rbizipay">
                            <input type="radio" name="pagos" id="rbpagoizipay">
                            <label for="">IZIPAY</label>
                            <button style="width: 15%;">+</button>
                        </div>
                        <br>
                    </div>  
                </div>


                <div style="padding: 20px; border-radius: 15px; background: rgb(238, 247, 225);border: 5px solid black;margin-top:20px; width:max-content;" >
            <div class="form1">
                
                <div style="display:flex; justify-content:space-between;">
                    <label for="">CLIENTE / RAZON SOCIAL</label>
                    <input type="text" class="cliente-rs" id="clienters" name="clienters" style="width: 300px;"
                        disabled="true">
                </div>
                <br>
                <div style="display:flex; justify-content:space-between;">
                    <label for="">RUC / DNI</label>
                    <input type="text" class="ruc-dni" id="rucdni" name="rucdni" style="width: 300px;" disabled="true">
                </div>
                <br>
                <div style="display:flex; justify-content:space-between;">
                    <label for="">DIRECCION</label>
                    <input type="text" class="direccion" id="direccion" name="direccion" style="width: 300px;"
                        disabled="true">
                </div>

                <div style="display:flex;justify-content:space-around;width:100%;margin:30px">

                       <div><label>BOLETA</label><input type="radio" name="tipo"></div>
                       <div><label>FACTURA</label><input type="radio" name="tipo"></div>

                      </div>
                        
                    </div>
                </div>
                  
            </div>
        </div>
    </div>
    <br>


    <!-- FORMULARIO DE DESCRIPCIÓN -->

    <div style="width:100%;display:flex;justify-content:space-around;flex-direction:column;align-items: center;margin:20px;">         
            
                <div><label style="font-weight: 600;" for="">DESCRIPCION DEL PRODUCTO</label></div>
                <textarea name="textproducto" id="textproducto" cols="45" rows="18"
                    style="resize: none; padding: 10px; width:85%;border:5px solid black;border-radius:10px" disabled> 
<?php
echo "Codigo de ficha:   -   vendedor    -tda
";
echo "Fecha de registro:
";
echo "Fecha de boleta/factura:
";
echo "--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
";
echo "Cliente/Razon social:"
;
echo "dni/ruc:
";
echo "telefono - correo:
";
echo "--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
";
echo "Marca, modelo ,color, codigo unico   s/.
";
echo "Delivery                                   s/.
";
echo "Renta adelantada                           s/.
";
echo "Total                                      s/.
";

?>
        
                </textarea>
              
    </div>

    <div style=" min-width: 1300px; max-width:1300px;">
        <div style="display: flex; margin: auto;">
            <button class="editar" id="editar" name="editar" onclick="Editar()">ANULACION</button>
            <button class="grabar" id="grabar" name="grabar" onclick="Guardar()">GRABAR</button>
            <button class="eliminar" id="eliminar" name="eliminar" onclick="Eliminar()">ELIMINAR</button>
            <button class="imprimir" id="imprimir" name="imprimir" onclick="modalImprimir()">IMPRIMIR</button>

        </div>

        <br>
        <br>
        <div style="overflow:scroll;width: 90%;margin: auto; max-height: 300px;">
            <table border="2" cellspacing="0" style="margin: auto; width: 100%;">
                <TR style="position: sticky;top: 0;">
                    <style>
                    th,
                    td {
                        min-width: 120px;
                        width: max-content;
                        padding: 10px;
                        text-align: center;
                    }

                    th {
                        background: rgb(199, 196, 196);
                    }
                    </style>
                    <th>ID</th>
                    <th>EMPRESA</th>
                    <th>SERIE</th>
                    <th>NUMERO</th>
                    <th>FECHA DE EMISION</th>
                    <th>CODIGO DE FICHA</th>
                    <th>CLIENTE/ RAZON SOCIAL</th>
                    <th>DNI/RUC</th>
                    <th>DIRECCION</th>
                    <th>DESCRIPCION DEL PRODUCTO</th>
                    <th>PAGOS</th>
                    <th>TIPO PAGO</th>
                    <th>DIAS</th>
                    <th>CODIGO UNICO</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO</th>
                    <th>VALOR NETO</th>
                    <th>IGV</th>
                    <th>TOTAL</th>
                    <th>ESTADO</th>
                </TR>
                <tbody id="contetabla">
                </tbody>
            </table>
        </div>
        <br>
        <br>
    </div>

    
    <!-- <script>
        function mostrar_impresoras(){
            connetor_plugin.obtenerImpresoras()
                        .then(impresoras => {                    
                         console.log(impresoras)
                        });
        }


        async function imprimir(){
            let nombreImpresora = "SAM4S ELLIX20II";
            let api_key = "12345"
            
           
            const conector = new connetor_plugin()
                        conector.fontsize("2")
                        conector.textaling("center")
                        conector.text("Ferreteria Angel")
                        conector.fontsize("1")
                        conector.text("Calle de las margaritas #45854")
                        conector.text("PEC7855452SCC")
                        conector.feed("3")
                        conector.textaling("left")
                        conector.text("Fecha: Miercoles 8 de ABRIL 2022 13:50")                        
                        conector.text("Cant.       Descripcion      Importe")
                        conector.text("------------------------------------------")
                        conector.text("1- Barrote 2x4x8                    $110")
                        conector.text("3- Esquinero Vinil                  $165")
                        conector.feed("1")
                        conector.fontsize("2")
                        conector.textaling("center")
                        conector.text("Total: $275")
                        conector.qr("https://abrazasoft.com")
                        conector.feed("5")
                        conector.cut("0") 

                    const resp = await conector.imprimir(nombreImpresora, api_key);
                    if (resp === true) {              
                    
                    } else {
                         console.log("Problema al imprimir: "+resp)                    
                    
                    }
        }
    </script>

 
    <script src="plugin_impresora_termica.js"></script> -->
    <!-- MODAL PARA IMPRIMIR -->

    <div id="miModal" class="modal">
            <div class="flex" id="flex">
                <div class="contenido-modal">
                    <div class="modal-header flex">
                        <h2>DESCARGAR VAUCHER</h2>
                        <span class="close" onclick="cerrarImprimir()" id="close">&times;</span>
                    </div>
                    <div class="modal-body">
                        

                    
                    </div>

                </div>
            </div>
        </div>

</body>
</html>
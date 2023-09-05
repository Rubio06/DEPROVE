
<?php 
    include ("../coneccion.php");
    $cn = Db::conectar();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilostabla.css">
</head>
<body>
    <?php include("../header.php") ?>
    <div class="registros">
        <H1 class="titulotabla">REGISTRO DE CAJA</H1>
    </div>


    <div class="botonestabla botones-general">
        <form action="./registro.php" method="POST">
            <input type="submit" name="tipo" class="botones" value="INGRESO">
        </form>
        <form action="./registro.php" method="POST">
            <input type="submit" name="tipo" class="botones" value="EGRESO">
        </form>
    </div>
    <br>

    <!-- OTRA MODIFICACION -->
    <div class="consultas">
        <div class="codigo-general">
            <div class="codigo">
                <label class="label" for="codigo">BUSCAR CODIGO</label>
                <input oninput="Buscar()" type="text" id="codigo" name="codigo">
            </div>

            <div class="codigo">
                <label for="nombre">BUSCAR DNI/NOMBRE</label>
                <input type="text" id="nombre">
            </div>

            <div class="codigo">
                <label for="" class="label">CONCEPTO</label>
                <SELECT name="concepto" id="concepto" onchange="Buscar()">
                    <option value="">--Todos--</option>
                    <?php
                $resultado = mysqli_query($cn,"SELECT codigo, concepto from formulario GROUP BY concepto");
                while($mostrar = mysqli_fetch_assoc($resultado)){
                ?>
                    <option value="<?php echo $mostrar['concepto']; ?>"><?php echo $mostrar['concepto']; ?></option>
                    <?php } ?>
                </SELECT>
            </div>
        </div>
        <br>

        <div class="seccion2">
            <div class="sec2">
                <select name="" id="" class="selectfecha" style="width: 250px;">
                    <option value="">FECHA DE CONCEPTO</option>
                    <option value="">FECHA DE REGISTRO</option>
                    <option value="">FECHA DE CONFIRMACION</option>
                    <option value="">FECHA DE FECHA DE VOUCHER</option>
                </select>
            </div>
            <div class="sec2">
                <label for="" class="lbldesde">DESDE</label>
                <input type="date" id="desde" placeholder="DESDE" class="desde">
            </div>
            <div class="sec2">
                <label for="" class="lblhasta">HASTA</label>
                <input type="date" id="hasta" placeholder="HASTA" class="hasta">
            </div>
        </div>
        <br>
        <div class="seccion3">
            <div class="sec3">
                <label class="label" for="">BANCO</label>
                <select name="banco" id="banco" onchange="Buscar()">
                    <?php 
                $resultado = mysqli_query($cn,"SELECT codigo, banco from formulario GROUP BY banco");
                while($mostrar = mysqli_fetch_assoc($resultado)){ ?>
                    <option value="<?php echo $mostrar['banco']; ?>"> <?php echo $mostrar['banco']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="sec3">
                <label class="label" for="">RUC</label>
                <input type="text" id="ruc">
            </div>
        </div>
        <br>
        <div class="seccion4">
            <div class="sec4">
                <label class="label" for="">INGRESO TOTAL</label>
                <input type="text" id="ruc">
            </div>
            <div  class="sec4">
                <label class="label" for="">EGRESO TOTAL</label>
                <input type="text" id="ruc">
            </div>
            <div  class="sec4">
                <label class="label" for="">EFECTIVO</label>
                <input type="text" id="ruc">
            </div>
        </div>
    </div>

    <BR>
    </BR>



    <div style="overflow:scroll;width: 90%;margin: auto;max-height: 450px;">
        <TABlE border="2" cellspacing="0" align="center">
            <tr style="position: sticky;top: 0;">
                <TH style="position: sticky;left: 0; top: 0;">CODIGO DE REGISTRO</TH>
                <TH>NOMBRE DEL USUARIO</TH>
                <TH>CONCEPTO</TH>
                <TH>FECHA REGISTRO</TH>
                <TH>FECHA VENTA</TH>
                <TH>MONTO</TH>
                <TH>EMPRESA</TH>
                <TH>CAJA DESTINO</TH>
                <TH>MOTORIZADO</TH>
                <TH>REFERENCIA</TH>
                <TH>NUMERO DE AUTORIZACION</TH>
                <TH>AUTORIZACION</TH>
                <TH>TIPO</TH>
                <TH>PERIODO</TH>
                <TH>TRABAJADOR</TH>
                <TH>DNI TRABAJADOR</TH>
                <TH>FECHA CONCEPTO</TH>
                <TH>DOCUMENTO</TH>
                <TH>SERIE</TH>
                <TH>NUMERO</TH>
                <TH>NUMERO DE OPERACION</TH>
                <TH>PROVEEDOR</TH>
                <TH>SLRC</TH>
                <TH>FECHA FACTURA</TH>
                <TH>DIRECCION</TH>
                <TH>OBSERVACIONCOMPRO</TH>
                <TH>IZIPAY</TH>
                <TH>BANCO</TH>
                <TH>FECHA VOUCHER</TH>
                <TH>HORA VOUCHER</TH>
                <TH>FECHA CONFIRMACION</TH>
                <TH>DEPOSITOS</TH>
                <TH>OBSERVACION</TH>
                <TH>DNI CLIENTE</TH>
                <TH>NOMBRE CLIENTE</TH>
                <TH>FECHA DE CONCEPTO</TH>
                <TH>NUMERO TELEFONICO</TH>
                <TH>VENDEDOR</TH>
            </TR>

            <tbody id=cuerpotabla>
            </tbody>
        </TABlE>
    </div>


    <form action="./registro.php" target="_blank" method="POST" style="display:none;">
        <input type="submit" name="id_editar" id="id_editar" value="0">
    </form>

</body>

</html>

<script>
const Eliminar = (key) => {
    if (confirm("¿Seguro que desea elimiar el registro '" + document.getElementById("Id_t" + key).children[0]
            .innerText + "'?")) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.response);
                if (this.response == 1) {
                    Buscar();
                }
            }
        };
        xmlhttp.open("POST", "./buscar.php", true);
        data = new FormData();
        data.append("op", "eliminar")
        data.append("id", key)
        xmlhttp.send(data);
    }
}

const Editar = (key) => {
    if (confirm("¿Seguro que desea elimiar el registro '" + document.getElementById("Id_t" + key).children[0]
            .innerText + "'?")) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.response);
                if (this.response == 1) {
                    Buscar();
                }
            }
        };
        xmlhttp.open("POST", "./buscar.php", true);
        data = new FormData();
        data.append("op", "editar")
        data.append("id", key)
        xmlhttp.send(data);
    }
}

const Buscar = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("cuerpotabla").innerHTML = this.response;
        }
    };

    xmlhttp.open("POST", "./buscar.php", true);
    data = new FormData();
    data.append("codigo", document.getElementById("codigo").value)
    data.append("concepto", document.getElementById("concepto").value)
    data.append("banco", document.getElementById("banco").value)
    data.append("op", "buscar")
    xmlhttp.send(data);
}
const abrir_deta = (n) => {
    document.getElementById("id_editar").value = n;
    document.getElementById("id_editar").click();
}

window.onload = Buscar();
</script>
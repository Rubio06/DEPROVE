<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Guias</title>
    <link rel="stylesheet" href="../../css/estilos_form.css">
    <style>
        th{
            border-left: 1px #337afb dashed;
            padding: 5px;
        }
        .red{
            background-color: red;
        }
        table{
            width: 1250px;
            margin-bottom: 0;
        }
        td{
            padding: 5px 15px;
        }
        th{
            padding: 5px 14.5px;
        }

        th:nth-child(1),
        th:nth-child(6),
        td:nth-child(8),
        td:nth-child(1) {
            width: 45px;
        }
        th:nth-child(2),
        td:nth-child(2) {
            width: 125px;
        }
        th:nth-child(3),
        td:nth-child(3) {
            width: 155px;
        }
        th:nth-child(4){
            width: 255px;
        }
        td:nth-child(4),
        td:nth-child(5),
        td:nth-child(6) {
            width: 100px;
        }
        th:nth-child(7),
        th:nth-child(5),
        td:nth-child(9),
        td:nth-child(7) {
            width: 155px;
        }
        div:nth-child(1)::-webkit-scrollbar,
        div:nth-child(2)::-webkit-scrollbar{
            background: white;
            height: 5px;
            width: 5px;
        }
        div:nth-child(1)::-webkit-scrollbar-thumb,
        div:nth-child(2)::-webkit-scrollbar-thumb{
            background: green;
            border-radius: 5px;
        }

        #tGuias>tr{
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
        }
        #tGuias>tr>tr{
            width: 98%;
        }
        #tGuias>tr>tr>tbody{
            width: fit-content;
            margin-left: 15px;
            display: block;
            height: fit-content;
            max-height: 150px;
            background-color: #337afb;
        }

    </style>
</head>
<body>
    <?php include("../../header.php") ?>
    <div id="headGuia" style="overflow: hidden;width: 90%;">
        <table>
            <thead>
                <tr class="primera">
                    <th rowspan="2">#</th>
                    <th rowspan="2">Guia</th>
                    <th rowspan="2">Empresa</th>
                    <th colspan="3">Fechas</th>
                    <th rowspan="2">Proovedor</th>
                    <th rowspan="2">N° items</th>
                    <th rowspan="2">ACCIONES</th>
                </tr>
                <tr>
                    <th style="width: 100px;"> Registro</th>
                    <th style="width: 100px;">Ingreso</th>
                    <th style="width: 100px;">Factura</th>
                </tr>
            </thead>
        </table>
    </div>
    <div onscroll="mover(this.scrollLeft)" style="overflow: scroll;width: 90%;padding-right: 5px;">
        <table>
            <tbody id="tGuias">
            </tbody>
        </table>
    </div>
</body>
</html>
<script>
    tGuias=document.getElementById("tGuias");
    window.onload=listarGuias();
    function listarGuias(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.response)
                tGuias.innerHTML+=this.response;
            }
        }
        xmlhttp.open("GET","../subir.php?q=listarGuias",true);
        xmlhttp.send();
    }
    function editarGuia(n,nombre){
        var form = $('<form action="<?php echo $ruta; ?>/almacen/detalle/" method="post" target="_BLANCK">' +
        '<input type="text" name="id" value="' + n + '" />' +
        '<input type="text" name="nombre" value="' + nombre + '" />' +
        '</form>');
        $('body').append(form);
        form.submit();
        form.remove();


        // var xmlhttp = new XMLHttpRequest();
        // var data = new FormData();
        // data.append("id",n);
        // xmlhttp.onreadystatechange = function() {
        //     if (this.readyState == 4 && this.status == 200) {
        //         window.open("../detalle/");
        //     }
        // }
        // xmlhttp.open("POST","../detalle/index.php",true);
        // xmlhttp.send(data);
    }
    function detalleGuias(n){
        try {
            $("#Detalle_"+n).slideUp();
            document.getElementById("Detalle_"+n).outerHTML="";
        } catch (error) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    tr=document.createElement("tr");
                    tbody=document.createElement("tbody");
                    tbody.innerHTML=(this.response);
                    tr.id="Detalle_"+n;
                    tr.style.display="none";
                    tr.append(tbody);
                    document.getElementById("List_"+n).append(tr);
                    $("#Detalle_"+n).slideDown();
                    // document.getElementById("List_"+n).innerHTML+=(this.response);
                }
            }
            xmlhttp.open("GET","../subir.php?q=detalleGuias&i="+n,true);
            xmlhttp.send();
        }
    }
    function mover(n){
        document.getElementById("headGuia").scrollLeft=n;
    };
</script>

<?php 
$mante="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos_form.css">
    <title>REGISTRO ASISTENCIA</title>
    <link rel="stylesheet" href="../css/login.css">
    <style>
        #encabezado{
            display: flex;
            width: 90%;
            margin: auto;
        }
        #encabezado>div{
            margin:15px;
        }
        #encabezado>div:nth-child(1)>div{
            justify-content: space-between;
        }
        #encabezado>div:nth-child(1)>div>label{
            width: 50%;
        }
        #encabezado>div:nth-child(2)>div{    
            width: max-content;
            justify-content: flex-start;
        }
        #contadorStock{
            align-items: center;
            width: 350px;
            border: 1px #337afb solid;
            margin: 0 5px;
        }
        #contadorVendidos{
            align-items: center;
            width: 350px;
            border: 1px #337afb solid;
            margin: 0 5px;
        }
        table{
            width: 100%;
            margin-bottom: 0;
        }
        select{
            min-width: 190px;
        }
        td{
            padding: 5px 15px;
        }
        th{
            border-left: 1px #337afb dashed;
            padding: 5px 14.5px;
        }
        #invent,#cinvent{
            width: 95%;
            margin: auto;
            overflow-x: scroll;
            max-height: 450px;
        }
        #invent::-webkit-scrollbar{
            background: white;
            height: 5px;
            width: 5px;
        }
        #invent::-webkit-scrollbar-thumb{
            background: green;
            border-radius: 5px;
        }
        
        #invent>div:nth-child(1)::-webkit-scrollbar{
            background: white;
            height: 5px;
        }
        #invent>div:nth-child(1)::-webkit-scrollbar-thumb{
            background: green;
            border-radius: 5px;
        }
        #cinvent th,
        #invent td{
            width: 250px;
        }
        #cinvent th:nth-child(2),
        #invent td:nth-child(2){
            width: 300px;
        }
        #cinvent th:nth-child(1),
        #cinvent th:nth-child(3),
        #invent td:nth-child(1),
        #invent td:nth-child(3){
            width: 150px;
        }
    </style>
</head>
<body>
    <?php include("../header.php") ?>
    <div id='blur2' onclick='Agrandar()'></div>
    <div id="encabezado">
        <div style="width: max-content;">
            <div class="packform">
                <label>Desde:</label>
                <input type="date" id="fechai" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date("Y-m-d"); ?>" oninput="buscar()">
                <label>Hasta:</label>
                <input type="date" id="fechaf" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" oninput="buscar()">
            </div>
            <div class="packform">
                <label>Buscar por DNI/NOMBRE:</label>
                <input type="text" name="buscar" id="buscar" oninput="buscar()" />
            </div>
        </div>
    </div>    
    <h1 id="titulo_asis" style="text-align: center;">ASISTENCIA DEL <?php echo date("d/m/Y"); ?></h1>
    <div id="cinvent" style="overflow: hidden;">
        <table>
            <thead>
                <tr>
                    <th>DNI/DOC/CODIGO</th>
                    <th>NOMBRE</th>
                    <th>Hora</th>
                    <th>Foto</th>
                </tr>
            </thead>
        </table>
    </div>
    <div id="invent">
        <table id="listado">
        </table>
    </div>
</body>
<script>
    var busqueda = new XMLHttpRequest();
    element_select="";
    carcar=setTimeout(() => {
        
    }, 100);
    function buscar(){
        busqueda.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("invent").scrollTop=0;
                document.getElementById("listado").innerHTML=this.response;
                if(document.getElementById("fechai").value==document.getElementById("fechaf").value){
                    document.getElementById("titulo_asis").innerHTML="Asistencia del "+document.getElementById("fechai").value;
                }
                else{
                    document.getElementById("titulo_asis").innerHTML=document.getElementById("fechai").value+ " - "+document.getElementById("fechaf").value;
                }
                if(document.getElementById("buscar").value!=""){
                    document.getElementById("titulo_asis").innerHTML+=" de "+document.getElementById("buscar").value;
                }
                document.getElementById("fechai").max=document.getElementById("fechaf").value;
                document.getElementById("fechaf").min=document.getElementById("fechai").value;
            }
        }
        busqueda.open("POST","./busqueda.php",true);
        var data = new FormData();
        data.append("fechai",document.getElementById("fechai").value);
        data.append("fechaf",document.getElementById("fechaf").value);
        data.append("nombre",document.getElementById("buscar").value)
        busqueda.send(data);
    }
    const Agrandar = (hijo) => {
        clearInterval(carcar);
        carcar=setTimeout(() => {
            if(element_select!=""){
                hijo=element_select;
                hijo.width="0px";
                $("#blur2").removeClass("filter");
                setTimeout(() => {
                    hijo.width="";
                    hijo.zIndex="";
                    hijo.transform="";
                    hijo.top="";
                    hijo.left="";
                    hijo.transition="";
                    hijo.position="";
                }, 200);
                setTimeout(() => {
                }, 500);
                element_select="";
            }
            else{
                hijo.parentElement.style.height=hijo.offsetHeight+"px";
                hijo=hijo.style;
                hijo.zIndex="5";
                hijo.transition=".5s";
                hijo.width="0";
                $("#blur2").addClass("filter");
                setTimeout(() => {
                    hijo.position="fixed";
                    hijo.width="50%";
                    hijo.top="50%";
                    hijo.left="50%";
                    hijo.transform="translate(-50%, -50%)";
                element_select=hijo;
                }, 200);
            }
        }, 100);
    }
    buscar();
</script>
</html>
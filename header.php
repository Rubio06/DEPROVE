<?php
    // $ruta = "//localhost";
    $ruta = "";
    session_start();
    // $_SESSION["dni"] = "72196143";
    if(isset($_POST["cerrarSession"])&& isset($_SESSION["id"])){
        session_destroy();
        header("Location:./");
    }
    if (isset($_SESSION["id"])) {
        switch ($_SESSION["cargo"]) {
            case 'ASESOR DE VENTAS':
            case 'CAPACITACION':
            case 'SELECCION':
            case 'POSTULANTE':
            case 'OJT':
                header("Location: https://asesor.deproveglobal.com/");
                break;
            }
        // echo json_encode($_SESSION);
    } else if(!isset($mante)){
        $id = "vacio";
        if(isset($sig)){
            header("Location:" . $ruta . "/login/?sig=".$sig);
        }
        else{
            header("Location:" . $ruta . "/login/");
        }
        die();
    }
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
<script src="https://code.jquery.com/jquery-latest.js"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
<style>
    * {
        margin: 0;
        padding: 0;
        transition: .3s;
        user-select: none;
    }

    header {
        width: 100%;
        line-height: normal;
        margin: auto;
        background-color: #d4254c;
        /* background-color: #bfbfbf; */
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: fixed;
        top: 0;
        left: 0;
        height: 80px;
        z-index: 3;
    }

    body {
        padding-top: 80px !important;
    }

    header img {
        padding:10px;
        max-height: 60px;
        max-width: 80%;
    }
    header p{
        font-family: 'Lobster', cursive;
        font-weight: 100;
        color:white;
        font-size: 25px;
    }

    ul,
    ol {
        list-style-type: none;
    }

    #nav {
        /* width: 70%; */
        justify-content: flex-end;
        display: flex;
        margin-bottom: 0rem;
        margin-right: 10px;
    }
    #nav ul{
        padding-left: 0rem;
    }

    #nav li a {
        min-height: 40px;
        font-size: 22px;
        text-align: center;
        background-color: #bfbfbf;
        display: block;
        padding: 8px 20px;
        font-size: 15px;
        color: red;
        font-family: 'Lobster', cursive;
        font-weight: 100;
    }

    #nav>li {
        width: min-content;
        float: left;
        height:50px;
    }

    #nav>li>a {
        font-size: 25px;
        color: white;
    }
    #nav li a:hover {
        background-color: red;
        color: yellow;
    }

    #nav>li>form>input {
        background: red;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 20px;
        font-family: 'Lobster', cursive;
        font-weight: 100;
        padding: 12px 20px;
    }
    
    #nav>li>form>input:hover {
        transform: scale(1.08);
        transition: .5s;
        box-shadow: aliceblue -1px 5px 5px;
    }


    #nav li>ul {
        height:0;
        position: revert;
        border-radius: 15px;
        border: 1px solid transparent;
        /* overflow: hidden; */
        transition: .5s;
        max-height: 500px;
        overflow: auto;
    }
    
    #nav li>ul>li>a {
        background: #bfbfbf;
        color: black;
        font-size: 20px;
        padding: 15px 20px;
    }
    #nav li>ul>li>ul {
        max-height: 200px;
    }
    
    a {
        text-decoration: none;
        padding: 5px 10px;
        font-family: sans-serif;
    }
    #bt-menu{
        position: relative;
        background: transparent;
        color: white;
        display: none;
        font-size: 22px;
        width: 44px;
        height: 44px;
        border: 2px solid white;
        border-radius: 5px;
        flex-direction: column;
        justify-content: space-evenly;
        align-items: center;
    }
    #bt-menu>div{
        background: white;
        width: 60%;
        height: 3px;
        border-radius: 5px;
    }

    #msg_alerta {
        position: fixed;
        width: 50%;
        top: 0;
        text-align: center;
        font-size: 28px;
        left: 50%;
        transform: translate(-50%, 0);
        display: none;
        transition: .15s;
        padding: 10px 20px;
        border-bottom-left-radius: 35px;
        border-bottom-right-radius: 35px;
        z-index:3;
    }
    
    
    @media only screen and (max-width: 1070px) {
        #msg_alerta {
            width: 80%;
            font-size: 16px;
            border-bottom-left-radius: 35px;
            border-bottom-right-radius: 35px;
        }

        #bt-menu{
            display: flex;  
        }
        #nav {
            position: fixed;
            top: -200%;
            left: -200%;
            transform: translate(-50%, -50%);
            z-index: 3;
            width: 80%;
            background: #bfbfbf;
            padding: 10px;
            border-radius: 15px;
            flex-direction: column;
        }

        #nav>li {
            width: auto;
            float: none;
            background: #bfbfbf;
            height:max-content;
        }

        #nav>li>a {
            text-decoration: underline;
        }

        #nav li>ul>li>a {
            background: #bfbfbf;
            color: yellow;
        }

        #nav li a:hover {
            background-color: black;
            color: red;
        }

        #nav li>ul {
            max-height: 250px;
            padding: revert;
        }
        #nav li>ul>li>ul {
            max-height: 100px;
        }

        .filter {
            /* box-shadow: inset 1px -3px 20px 4px #ffffff; */
            backdrop-filter: blur(5px);
            background-color: rgb(0 0 0 / 29%);
            position: fixed;
            width: 100%;
            height: 100%;
            transition: 0.5s;
            z-index: 2;
        }
    }
</style>
<header>
    <div style="display:flex;align-items: center;">
        <img src="<?php echo $ruta ?>/log.png">
        <p> DEPROVE <BR>GLOBAL </p>
    </div>
    <div id="bt-menu">
        <div></div>
        <div></div>
        <div></div>
    </div>
        <ul id="nav">
            <?php if(isset($_SESSION["id"])){ 
            switch ($_SESSION["cargo"]) {
                case 'COORDINADOR':
                    ?>
                    <li>
                        <a>PERSONAL</a>
                        <ul>
                            <li><a href="<?php echo $ruta ?>/pedidos/reporte/">Reporte de llamadas</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>PEDIDOS</a>
                        <ul>
                            <li><a href="<?php echo $ruta ?>/pedidos/">Registrar Pedidos</a></li>
                        </ul>
                    </li>
                    <?php
                    break;
                case 'RECLUTADOR':
                case 'CAPACITADOR':
                    ?>
                    <li>
                        <a>PERSONAL</a>
                        <ul>
                            <li><a href="<?php echo $ruta ?>/personal/">Registro de trabajadores</a></li>
                            <li><a href="<?php echo $ruta ?>/verasistencia/">Registro de asistencia</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>PEDIDOS</a>
                        <ul>
                            <li><a href="<?php echo $ruta ?>/pedidos/">Registrar Pedidos</a></li>
                            <li><a href="<?php echo $ruta ?>/pedidos/reporte/">Reporte de llamadas</a></li>
                        </ul>
                    </li>
                    <?php
                    break;
                case 'SELECCION COORDINADOR': ?>
                        <li>
                            <a>PEDIDOS</a>
                            <ul>
                                <li><a href="<?php echo $ruta ?>/pedidos/reporte/">Reporte de llamadas</a></li>
                            </ul>
                        </li>
                    <?php
                    break;
                case ($_SESSION["cargo"] !== 'SUPERVISOR ALMACEN') && str_contains($_SESSION["cargo"],'SUPERVISOR'): 
                ?>
                    <li>
                        <a>PEDIDOS</a>
                        <ul>
                            <li><a href="<?php echo $ruta ?>/pedidos/">Registro de pedidos</a></li>
                        </ul>
                    </li>
                <?php
                break;
                    
                default:
                    ?>
                    <li>
                        <a>PERSONAL</a>
                        <ul>
                            <li><a href="<?php echo $ruta ?>/personal/">Registro de trabajadores</a></li>
                            <li><a href="<?php echo $ruta ?>/verasistencia/">Registro de asistencia</a></li>
                            <li><a href="<?php echo $ruta ?>/pedidos/reporte/">Reporte de llamadas</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>ALMACEN</a>
                        <ul>
                            <li><a href="<?php echo $ruta ?>/almacen/ingreso/">INGRESO DE EQUIPOS</a></li>
                            <li><a href="<?php echo $ruta ?>/almacen/guias/">GUIAS</a></li>
                            <li><a href="<?php echo $ruta ?>/almacen/almacen/">ALMACEN</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>CAJA</a>
                        <ul>
                            <li><a href="<?php echo $ruta ?>/caja/">Registro de caja</a></li>
                            <li><a href="<?php echo $ruta ?>/izipay/">BOLETAS-FACTURAS-NOTAS</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>PEDIDOS</a>
                        <ul>
                            <li><a href="<?php echo $ruta ?>/pedidos/">Registrar Pedidos</a></li>
                            <li><a href="<?php echo $ruta ?>/pedidos/registropedido/">Registros de pedidos</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>AJUSTES</a>
                        <ul>
                            <li><a href="<?php echo $ruta ?>/ajustes/base/">BASES</a></li>
                            <li>
                                <a>PLANES</a>
                                <ul>
                                    <li><a href="<?php echo $ruta ?>/ajustes/planes/">PLANES</a></li>
                                    <li><a href="<?php echo $ruta ?>/ajustes/planes/promocion/">PROMOCION</a></li>
                                    <li><a href="<?php echo $ruta ?>/ajustes/planes/pesoventa/">PESO VENTA</a></li>
                                    <li><a href="<?php echo $ruta ?>/ajustes/planes/tecnica/">TECNICA</a></li>
                                    <li><a href="<?php echo $ruta ?>/ajustes/RMC/">CUOTAS GENERALES</a></li>
                                </ul>
                            </li>
                            <li>
                                <a>CARGA</a>
                                <ul>
                                    <li><a href="<?php echo $ruta ?>/ajustes/carga/comisiones/">COMISIONES</a></li>
                                    <li><a href="<?php echo $ruta ?>/ajustes/carga/penalidadesExcel/">PENALIDADES</a></li>
                                    <li><a href="<?php echo $ruta ?>/ajustes/carga/documentosPagados/">DOCUMENTOS PAGADOS</a></li>
                                    <li><a href="<?php echo $ruta ?>/ajustes/carga/ajusteExcel/">AJUSTES</a></li>
                                </ul>
                            </li>
                            <li>
                                <a>REPORTE</a>
                                <ul>
                                    
                                    <li><a href="<?php echo $ruta ?>">CIERRE DE CAJAS</a></li>
                                    <li><a href="<?php echo $ruta ?>/ajustes/reporte/cuadrorecepcion/">CUADRO RECEPCCION</a></li>
                                    <li><a href="<?php echo $ruta ?>">CIERRE DE CALL</a></li>
                                    <li><a href="<?php echo $ruta ?>">REPORTE DE ENTREGAS</a></li>
                                    <li><a href="<?php echo $ruta ?>">REPORTE DE PROGRAMACION</a></li>
                                    <li><a href="<?php echo $ruta ?>">PRODUCTIVIDAD</a></li>
                                </ul>
                            </li>
                            <li>
                                <a>LOCACION</a>
                                <ul>
                                    <li><a href="<?php echo $ruta ?>/ajustes/locacion/deprove/">DEPROVE</a></li>
                                    <li><a href="<?php echo $ruta ?>/ajustes/locacion/komunicate/">KOMUNICATE</a></li>
                                  
                                </ul>
                            </li>
                            <li>
                                <a>CLIENTES</a>
                                <ul>
                                    <li><a href="<?php echo $ruta ?>">BUSCADOR</a></li>
                                    <li><a href="<?php echo $ruta ?>">CLIENTES</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php
                    break;
            }
            ?>
    
                <li>
                    <form action="" method="post" style="text-align: center;">
                        <input type="submit" name="cerrarSession" value="Cerrar sesion">
                    </form>
                </li>
            <?php
    
              }else{ ?>
            <li style="width:max-content;">
                <a href="">Ver Productos</a>
            </li>
            <li style="width:max-content;">
                <a href="<?php echo $ruta ?>/postulate/">Postulate</a>
            </li>
            <li style="width:max-content;">
                <a href="<?php echo $ruta ?>/login/">Iniciar session</a>
            </li>
            <?php }?>
        </ul>
    <script>
        ocultarmsg = setTimeout(() => {$("#msg_alerta").slideUp();}, 3000);
        menu = document.getElementById("nav");
        bt_menu = document.getElementById("bt-menu");
        bt_menu.addEventListener("click", () =>{
            if (bt_menu.children[0].style.width!= "") {
                //cerrar
                document.getElementById("blur").style.opacity = "0";
                setTimeout(() => {
                    document.getElementById("blur").style.display = "none";
                }, 300);
                // document.getElementById("blur").style.height = "0";
                // document.getElementById("blur").style.width  = "0";
                menu.style.top = "-200%";
                menu.style.left = "-200%";
                bt_menu.style="";
                bt_menu.children[0].style= "";
                bt_menu.children[1].style= "";
                bt_menu.children[2].style= "";
            } else {
                //abrir
                document.getElementById("blur").style.display = "";
                setTimeout(() => {
                    document.getElementById("blur").style.opacity = "1";
                }, 1);
                // document.getElementById("blur").style.height = "100%";
                // document.getElementById("blur").style.width = "100%";
                menu.style.top = "50%";
                menu.style.left = "50%";
                bt_menu.style="background:red;";
                bt_menu.children[0].style= "width:80%;height:5px;transform: rotate(135deg) translate(6.5px, -6.5px);";
                bt_menu.children[1].style= "opacity: 0";
                bt_menu.children[2].style= "width:80%;height:5px;transform: rotate(45deg) translate(-10px, -10px);";
            }
        });
        class alertas_ruben {
            bien(txt) {
                this.generar(txt, "#0bff0b", "black");
            }
            mal(txt) {
                this.generar(txt, "red", "white");
            }
            msg(txt) {
                this.generar(txt, "#ffe2a1", "black");
            }
            generar(txt, color, color_texto) {
                clearInterval(ocultarmsg);
                document.getElementById("msg_alerta").style.display = "none";
                document.getElementById("msg_alerta").innerText = txt;
                document.getElementById("msg_alerta").style.background = color;
                document.getElementById("msg_alerta").style.color = color_texto;
                document.getElementById("msg_alerta").style.border = "1px solid " + color_texto;
                ocultarmsg = setTimeout(() => {
                    $("#msg_alerta").slideUp();
                    document.getElementById("msg_alerta").innerText = "";
                    document.getElementById("msg_alerta").style.background = "";
                    document.getElementById("msg_alerta").style.color = "";
                    document.getElementById("msg_alerta").style.border = "";
                }, 3000);
                $("#msg_alerta").slideDown();
            }
        }
        alerta = new alertas_ruben();
        const asignar =(nav) =>{
            for(i=0;i<nav.length;i++){
                //nav[0][i] para el primer <a> de la lista
                nav[i].children[0].addEventListener("click",(e)=>{
                    cerrar=0;
                    for(x=0;x<nav.length;x++){
                        if(nav[x].children[1]!=undefined && nav[x].children[1].style.height!=""){
                            cerrar=x;
                            nav[x].children[1].style.height=nav[x].children[1].offsetHeight+"px";
                            setTimeout((y=cerrar) => {
                                try{if(y!=undefined){
                                    nav[y].children[1].style.borderColor="transparent";
                                    nav[y].children[1].style.height="";
                                }}catch(ex){console.log(ex);}
                            }, 1);
                            siguiente=nav[x].children[1].children;
                            for(f=0;f<siguiente.length;f++){
                                if(siguiente[f].children[1]!=undefined && siguiente[f].children[1].style.height!=""){
                                    cerrar2=f;
                                    siguiente[f].children[1].style.height=siguiente[f].children[1].offsetHeight+"px";
                                    console.log(siguiente[f].children[1].style.height);
                                    setTimeout((y=cerrar2) => {
                                        try{if(y!=undefined){
                                            siguiente[y].children[1].style.height="";
                                        }}catch(ex){console.log(ex);}
                                    }, 1);
                                }
                            }
                        }
                    }
                    try{
                        if(e.path[1].children[1]!=undefined){
                            if(e.path[1].children[1].style.height==""){
                                e.path[1].children[1].style.height=(e.path[1].children[1].children.length*70)+"px";
                                e.path[1].children[1].style.borderColor="white";
                                setTimeout(() => {
                                    if(e.path[1].children[1].style.height!=""){
                                        e.path[1].children[1].style.height="max-content";
                                    }
                                }, 300);
                            }
                            else{
                                e.path[1].children[1].style.height=e.path[1].children[1].offsetHeight+"px";
                                setTimeout(() => {
                                    e.path[1].children[1].style.height="";
                                    e.path[1].children[1].style.borderColor="transparent";
                                }, 1);
                            }
                        }
                    }
                    catch(ex){
                        console.log(ex);
                    }
                });
                if(nav[i].children[1]!=undefined){
                    try{
                        el=nav[i].children;
                        el[0].style.backgroundColor ="#ad1f3e";
                        el[0].style.color ="white";
                        setTimeout((e=el) => {
                            asignar(e[1].children);
                        }, 1);
                    }
                    catch(ex){
                        console.log(ex+" - "+ i);
                        console.log(nav[i]);
                    }
                }
            }
        }
        window.load=asignar(document.getElementById("nav").children);
    </script>
</header>
    <div id="msg_alerta"></div>
    <div id="blur" class="filter" style="opacity:0;display:none;"></div>
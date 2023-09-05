<?php
// $ruta = "//localhost/deprove";
$ruta = "https://deproveglobal.com";
session_start();
if(isset($_SESSION["id"])){
    if(isset($_GET["sig"])){
        if($_GET["sig"]=="asesor"){
            header("Location:" . $ruta . "/pedidos/");
        }
        else{
            header("Location:" . $ruta . "/".$_GET["sig"]."/");
        }
    }
    else{
        echo "<script>window.history.back()</script>";
        die();
    }
}
require_once("../coneccion.php");
$cn=Db::conectar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGUEO</title>
    <link rel="stylesheet" href="./logueo.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
    <script src="https://code.jquery.com/jquery-latest.js"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <style>
        .alertify-notifier.ajs-right .ajs-message.ajs-visible{
            border-radius:15px;
        }
    </style>
</head>
<body>
    <div class="fondo">
        <img src="./assets/fondo.jpg" alt="">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTuEfoP4V0jNwG2a815ffscCq5FLe_RsY7Lng&usqp=CAU" alt="">
        <img src="https://us.123rf.com/450wm/simpson33/simpson331904/simpson33190400088/121940655-consultor-de-call-center-en-auriculares-sobre-fondo-gris-operador-de-la-l%C3%ADnea-de-ayuda-con-auricular.jpg?ver=6" alt="">
        <img src="https://www.paradavisual.com/wp-content/uploads/2022/06/conctact-center-1.jpg">
    </div>
    <div class="conte-log">
        <div class="deprove-img" style="background:#56555b; opacity:.87;">
            <img src="/log.png" style="height: 150px">
            <p style="font-family: 'Lobster';font-size: 48px;margin-left:20px;"> DEPROVE <br>GLOBAL </p>
        </div>
        <div class="conte-form">
            <form id="loguarse">
                <input type="hidden" name="login">
                <h1>Login</h1>
                <div>
                    <label class="tex-log">SEDE:</label>
                    <select class="logueo-input" name="sede">
                        <option value="c">CALL CENTER</option>
                        <?php
                            $sede=mysqli_query($cn,"SELECT * FROM sede order by sede;");
                            while ($x=mysqli_fetch_assoc($sede)) {
                                echo "<option value='$x[idsede]'>$x[sede]</option>";
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label class="tex-log">USUARIO COORDINADOR:</label>
                    <input  class="logueo-input"name="coordinador"type="text" autocomplete="off"/>
                </div>
                
                <div>
                    <label class="tex-log">DNI ASESOR:</label>
                    <input  class="logueo-input"name="dni"type="text" autocomplete="off"/>
                </div>                
                <div>
                    <label class="tex-log">CONTRASEÑA ASESOR:</label>
                    <input class="logueo-input"name="contraseña"type="password" id="password" autocomplete="off"/>
                    <img  id="ojoLogin" width="40" value="1" style="cursor:pointer;position: absolute;right: 5px;top: -10px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iNzUycHQiIGhlaWdodD0iNzUycHQiIHZlcnNpb249IjEuMSIgdmlld0JveD0iMCAwIDc1MiA3NTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiA8cGF0aCBkPSJtNTcyLjMyIDM2OS43NmMtMTUuMzQtMzkuMzk4LTQyLjM3OS03My4xNTYtNzcuNDczLTk2LjczNC0zNS4wOTQtMjMuNTc0LTc2LjU2Ni0zNS44NDQtMTE4Ljg0LTM1LjE0OC00Mi4yNzMtMC42OTUzMS04My43NDYgMTEuNTc0LTExOC44NCAzNS4xNDgtMzUuMDk4IDIzLjU3OC02Mi4xMzMgNTcuMzM2LTc3LjQ3MyA5Ni43MzQtMS4zNDc3IDQuMDU0Ny0xLjM0NzcgOC40MzM2IDAgMTIuNDg4IDE1LjM0IDM5LjM5OCA0Mi4zNzUgNzMuMTU2IDc3LjQ3MyA5Ni43MyAzNS4wOTQgMjMuNTc4IDc2LjU2NiAzNS44NDggMTE4Ljg0IDM1LjE1MiA0Mi4yNzcgMC42OTUzMSA4My43NS0xMS41NzQgMTE4Ljg0LTM1LjE1MiAzNS4wOTQtMjMuNTc0IDYyLjEzMy01Ny4zMzIgNzcuNDczLTk2LjczIDEuMzQ3Ny00LjA1NDcgMS4zNDc3LTguNDMzNiAwLTEyLjQ4OHptLTE5Ni4zMiAxMDQuOTFjLTMyLjk0NSAxLjA5NzctNjUuNDY1LTcuNzE4OC05My4zNDgtMjUuMzA5LTI3Ljg3OS0xNy41OS00OS44NC00My4xNDUtNjMuMDM1LTczLjM1NSAxMy4xOTUtMzAuMjA3IDM1LjE1Ni01NS43NjIgNjMuMDM1LTczLjM1MiAyNy44ODMtMTcuNTkgNjAuNDAyLTI2LjQwNiA5My4zNDgtMjUuMzA5IDMyLjk0OS0xLjA5NzcgNjUuNDY5IDcuNzE4OCA5My4zNDggMjUuMzA5IDI3Ljg4MyAxNy41ODYgNDkuODQ4IDQzLjEzNyA2My4wNTEgNzMuMzQ0LTEzLjE5OSAzMC4yMTEtMzUuMTYgNTUuNzY2LTYzLjA0MyA3My4zNTUtMjcuODgzIDE3LjU5NC02MC40MDIgMjYuNDEtOTMuMzU1IDI1LjMxNnptMC0xNTcuODZjLTE1LjY5OSAwLTMwLjc1OCA2LjIzNDQtNDEuODU5IDE3LjMzNnMtMTcuMzM2IDI2LjE2LTE3LjMzNiA0MS44NTljMCAxNS43MDMgNi4yMzQ0IDMwLjc1OCAxNy4zMzYgNDEuODU5czI2LjE2IDE3LjM0IDQxLjg1OSAxNy4zNGMxNS43MDMgMCAzMC43NTgtNi4yMzgzIDQxLjg1OS0xNy4zNHMxNy4zNC0yNi4xNTYgMTcuMzQtNDEuODU5Yy0wLjAxNTYyNS0xNS42OTUtNi4yNTc4LTMwLjc0Mi0xNy4zNTktNDEuODQtMTEuMDk4LTExLjA5OC0yNi4xNDUtMTcuMzQtNDEuODQtMTcuMzU1em0wIDc4LjkzYy01LjIzMDUgMC0xMC4yNS0yLjA3ODEtMTMuOTUzLTUuNzgxMi0zLjY5OTItMy42OTkyLTUuNzc3My04LjcxODgtNS43NzczLTEzLjk1MyAwLTUuMjMwNSAyLjA3ODEtMTAuMjUgNS43NzczLTEzLjk1MyAzLjcwMzEtMy42OTkyIDguNzIyNy01Ljc3NzMgMTMuOTUzLTUuNzc3MyA1LjIzNDQgMCAxMC4yNTQgMi4wNzgxIDEzLjk1MyA1Ljc3NzMgMy43MDMxIDMuNzAzMSA1Ljc4MTIgOC43MjI3IDUuNzgxMiAxMy45NTMtMC4wMDc4MTMgNS4yMzQ0LTIuMDg5OCAxMC4yNDYtNS43ODkxIDEzLjk0NS0zLjY5OTIgMy42OTkyLTguNzEwOSA1Ljc4MTItMTMuOTQ1IDUuNzg5MXoiLz4KPC9zdmc+Cg==">
                </div>
               
                <div class="conte-button">
                    <input class="button" type="submit" value="INGRESAR"/>
                    <p>Si aun no tiene una cuenta <a href="javascript:mover()" style="font-size: 20px;">registrese aquí</a></p>
                </div>
            </form>
            <form id="registro" style="left:100%;">
                <h1>REGISTRO</h1>
                <input type="hidden" name="regis" value="INGRESAR">
                <div>
                    <label class="tex-log">DNI TRABAJADOR:</label>
                    <input type="text"  class="logueo-input" name="regis_dni" required/>
                    <button style="background: url(https://img.icons8.com/color/96/search--v1.png) no-repeat;width: 30px;height: 30px;border: none;cursor: pointer;background-size: 30px;position: absolute;right: 5px;top: 0;" id="buscarPerson"></button>
                </div>
                <div>
                    <label id="estado" style="margin-top:10px;"></label>
                </div>
                
                <div>
                    <label class="tex-log">USUARIO:</label>
                    <input type="text" class="logueo-input" name="regis_usuario" autocomplete="off" disabled required/>
                </div>
                
                <div>
                    <label class="tex-log">CONTRASEÑA:</label>
                    <input type="password" id="password_2"class="logueo-input" name="regis_contra" autocomplete="off" disabled required/><img  id="ojoLogin_2" width="40" value="1" style="cursor:pointer;position: absolute;right: 5px;top: -10px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iNzUycHQiIGhlaWdodD0iNzUycHQiIHZlcnNpb249IjEuMSIgdmlld0JveD0iMCAwIDc1MiA3NTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiA8cGF0aCBkPSJtNTcyLjMyIDM2OS43NmMtMTUuMzQtMzkuMzk4LTQyLjM3OS03My4xNTYtNzcuNDczLTk2LjczNC0zNS4wOTQtMjMuNTc0LTc2LjU2Ni0zNS44NDQtMTE4Ljg0LTM1LjE0OC00Mi4yNzMtMC42OTUzMS04My43NDYgMTEuNTc0LTExOC44NCAzNS4xNDgtMzUuMDk4IDIzLjU3OC02Mi4xMzMgNTcuMzM2LTc3LjQ3MyA5Ni43MzQtMS4zNDc3IDQuMDU0Ny0xLjM0NzcgOC40MzM2IDAgMTIuNDg4IDE1LjM0IDM5LjM5OCA0Mi4zNzUgNzMuMTU2IDc3LjQ3MyA5Ni43MyAzNS4wOTQgMjMuNTc4IDc2LjU2NiAzNS44NDggMTE4Ljg0IDM1LjE1MiA0Mi4yNzcgMC42OTUzMSA4My43NS0xMS41NzQgMTE4Ljg0LTM1LjE1MiAzNS4wOTQtMjMuNTc0IDYyLjEzMy01Ny4zMzIgNzcuNDczLTk2LjczIDEuMzQ3Ny00LjA1NDcgMS4zNDc3LTguNDMzNiAwLTEyLjQ4OHptLTE5Ni4zMiAxMDQuOTFjLTMyLjk0NSAxLjA5NzctNjUuNDY1LTcuNzE4OC05My4zNDgtMjUuMzA5LTI3Ljg3OS0xNy41OS00OS44NC00My4xNDUtNjMuMDM1LTczLjM1NSAxMy4xOTUtMzAuMjA3IDM1LjE1Ni01NS43NjIgNjMuMDM1LTczLjM1MiAyNy44ODMtMTcuNTkgNjAuNDAyLTI2LjQwNiA5My4zNDgtMjUuMzA5IDMyLjk0OS0xLjA5NzcgNjUuNDY5IDcuNzE4OCA5My4zNDggMjUuMzA5IDI3Ljg4MyAxNy41ODYgNDkuODQ4IDQzLjEzNyA2My4wNTEgNzMuMzQ0LTEzLjE5OSAzMC4yMTEtMzUuMTYgNTUuNzY2LTYzLjA0MyA3My4zNTUtMjcuODgzIDE3LjU5NC02MC40MDIgMjYuNDEtOTMuMzU1IDI1LjMxNnptMC0xNTcuODZjLTE1LjY5OSAwLTMwLjc1OCA2LjIzNDQtNDEuODU5IDE3LjMzNnMtMTcuMzM2IDI2LjE2LTE3LjMzNiA0MS44NTljMCAxNS43MDMgNi4yMzQ0IDMwLjc1OCAxNy4zMzYgNDEuODU5czI2LjE2IDE3LjM0IDQxLjg1OSAxNy4zNGMxNS43MDMgMCAzMC43NTgtNi4yMzgzIDQxLjg1OS0xNy4zNHMxNy4zNC0yNi4xNTYgMTcuMzQtNDEuODU5Yy0wLjAxNTYyNS0xNS42OTUtNi4yNTc4LTMwLjc0Mi0xNy4zNTktNDEuODQtMTEuMDk4LTExLjA5OC0yNi4xNDUtMTcuMzQtNDEuODQtMTcuMzU1em0wIDc4LjkzYy01LjIzMDUgMC0xMC4yNS0yLjA3ODEtMTMuOTUzLTUuNzgxMi0zLjY5OTItMy42OTkyLTUuNzc3My04LjcxODgtNS43NzczLTEzLjk1MyAwLTUuMjMwNSAyLjA3ODEtMTAuMjUgNS43NzczLTEzLjk1MyAzLjcwMzEtMy42OTkyIDguNzIyNy01Ljc3NzMgMTMuOTUzLTUuNzc3MyA1LjIzNDQgMCAxMC4yNTQgMi4wNzgxIDEzLjk1MyA1Ljc3NzMgMy43MDMxIDMuNzAzMSA1Ljc4MTIgOC43MjI3IDUuNzgxMiAxMy45NTMtMC4wMDc4MTMgNS4yMzQ0LTIuMDg5OCAxMC4yNDYtNS43ODkxIDEzLjk0NS0zLjY5OTIgMy42OTkyLTguNzEwOSA1Ljc4MTItMTMuOTQ1IDUuNzg5MXoiLz4KPC9zdmc+Cg=="/>
                </div>
                <div class="conte-button" style="display:flex;jutify-content:center;">
                    <input class="button" type="button" id="registrar" value="REGISTRAR" disabled>
                    <p>Si ya tiene una cuenta <a href="javascript:mover()" style="font-size: 20px;">logueese aquí</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
    <script>
        i=0;
        imagenes=document.getElementsByClassName('fondo')[0];
        max=imagenes.children.length;
        setInterval(() => {
            i++;
            if(i==max){
                i=0;
                imagenes.style.transition="3s";
                setTimeout(() => {
                    imagenes.style.transition="1s";
                }, 3000);
            }
            imagenes.style.left="-"+i+"00%";
        }, 7000);
    </script>
</body>
</html>
$(document).ready(function() {
    $('#loguarse').submit(function(e) {
        alertify.warning("cargando...");
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: './subir.php',
            data: $(this).serialize(),
            success: function(respuesta) {
                if (respuesta == "0") {
                    alertify.error('No hay conexion con la base');
                    return false;
                } else if (respuesta == "1") {
                    alertify.error('Ocurrio un Error');
                } else if (respuesta == "entra") {
                    alertify.success("Bienvenido");
                    setTimeout(() => { window.location.reload(); }, 1000);
                } else if (respuesta == "asesor") {
                    alertify.success("Bienvenido");
                    iframe=document.createElement("iframe");
                    iframe.src="./abrirAsesor.php";
                    document.body.appendChild(iframe);
                    setTimeout(() => {iframe.remove();}, 1000);
                } else if (respuesta == "vacio") {
                    alertify.error("Llene todos los campos");
                } else if (respuesta == "moto") {
                    window.location=("/motorizado/");
                } else if (respuesta == "noEntra") {
                    alertify.error("Datos incorrectos");
                } else if (respuesta == "sedeIncorrecta") {
                    alertify.error("Los asesores solo inician con call center");
                } else if (respuesta == "sedeIncorrecta2") {
                    alertify.error("Sede incorrecta");
                } else if (respuesta == "noCoord") {
                    alertify.error("Usuario coordinador no encontrado");
                } else if (respuesta == "FaltaAsistencia") {
                    alertify.error("Falta marcar la asistencia");
                } else if (respuesta == "Salio") {
                    alertify.error("Usted ya salio de la empresa");
                } else {
                    console.log("'"+respuesta+"'");
                    alertify.error('Error desconocido');
                }
            }
        });
        return false;
    });
    $('#registro').submit(function(e) {
        alertify.warning("cargando...");
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: './subir.php',
            data: $(this).serialize(),
            success: function(respuesta) {
                if (respuesta == "0") {
                    alertify.error('No hay conexion con la base');
                    return false;
                } else if (respuesta == "1") {
                    alertify.error('Ocurrio un Error');
                } else if (respuesta == "entra") {
                    alertify.success("Bienvenido");
                    setTimeout(() => { window.location.reload(); }, 1000);
                } else if (respuesta == "vacio") {
                    alertify.error("Llene todos los campos");
                } else if (respuesta == "") {
                } else {
                    console.log("'"+respuesta+"'");
                }
            }
        });
        return false;
    });
});

const mover = () => {
    login = document.getElementById('loguarse').style;
    regis = document.getElementById('registro').style;
    if (login.left == "") {
        login.left = "-200%";
        regis.left = "";
    } else {
        login.left = "";
        regis.left = "200%";
    }
}

document.getElementById("buscarPerson").addEventListener('click', function() {
    texto = document.getElementsByName("regis_dni")[0].value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.response == "" || this.response == null) {
                document.getElementById("estado").innerHTML = ("<p style='color:red;text-align:center;'>NO SE ENCONTRO EL DNI DE ESTE TRABAJADOR</p>");
                setTimeout(() => { document.getElementById("estado").innerHTML = ""; }, 1000);
            } else {
                console.log(this.response);
                document.getElementById("estado").innerHTML = this.response;
                if (this.response != "<p style='color:red;text-align:center;'>YA EXISTE UN USUARIO CON ESTE DNI</p>") {
                    document.getElementById("registrar").disabled = false;
                    document.getElementsByName("regis_usuario")[0].disabled = false;
                    document.getElementsByName("regis_contra")[0].disabled = false;
                }
            }
        }
    };
    xmlhttp.open("POST", "./subir.php", true);
    var data = new FormData();
    data.append("txt", texto);
    xmlhttp.send(data);
    return false;
});


document.getElementById("registrar").addEventListener('click', function() {
    document.getElementById("registrar").disabled = true;
    document.getElementsByName("regis_usuario")[0].disabled = true;
    document.getElementsByName("regis_contra")[0].disabled = true;
    texto = document.getElementsByName("regis_dni")[0].value;
    usu = document.getElementsByName("regis_usuario")[0].value;
    contra = document.getElementsByName("regis_contra")[0].value;
    if (texto != "" && usu != "" && contra != "") {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("estado").innerHTML = "";
                document.getElementsByName("regis_dni")[0].value = "";
                document.getElementsByName("regis_usuario")[0].value = "";
                document.getElementsByName("regis_contra")[0].value = "";
            }
        };
        xmlhttp.open("POST", "./subir.php", true);
        var data = new FormData();
        data.append("regis_dni", texto);
        data.append("regis_usuario", usu);
        data.append("regis_contra", contra);
        data.append("regis", "");
        xmlhttp.send(data);
    } else {
        alert("No deje campos vacios");
    }
});

document.getElementById("ojoLogin").addEventListener("click",()=>{  
if(document.getElementById('ojoLogin').width=="40"){
    document.getElementById('password').type="text";
    document.getElementById('ojoLogin').width="39";
    document.getElementById('ojoLogin').src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iNzUycHQiIGhlaWdodD0iNzUycHQiIHZlcnNpb249IjEuMSIgdmlld0JveD0iMCAwIDc1MiA3NTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiA8cGF0aCBkPSJtNTcyLjgzIDM0NC45MmMtMTcuNzU4LTI2LjY0MS00MS40MzgtNDguODQtNjguMDc4LTY1Ljg1NWw2NC4zNzktNjQuMzc5YzguODc4OS05LjYyMTEgOC4xNDA2LTIzLjY4LTAuNzM4MjgtMzEuODE2LTguODc4OS04LjE0MDYtMjIuMTk5LTguMTQwNi0zMS4wNzggMGwtNzQuNzM4IDc0LjczNGMtMjcuMzc5LTkuNjE3Mi01Ni45NzctMTQuNzk3LTg2LjU3OC0xNC43OTctMTExLjczIDAtMTcxLjY3IDY0LjM3NS0xOTcuNTcgMTAyLjExLTEzLjMyIDE5Ljk4LTEzLjMyIDQ2LjYxNyAwLjczODI4IDY1Ljg1NSAxNy43NTggMjUuMTYgNDAuNjk5IDQ2LjYxNyA2Ny4zMzYgNjIuODk4bC02My42MzcgNjMuNjM3Yy04Ljg3ODkgOC44Nzg5LTguODc4OSAyMi45MzgtMC43MzgyOCAzMS4wNzhzMjIuOTM4IDguODc4OSAzMS4wNzggMC43MzgyOGwwLjczODI4LTAuNzM4MjggNzQuNzM4LTczLjk5MmMyOC4xMjEgMTAuMzU5IDU3LjcxOSAxNC43OTcgODcuMzE2IDE0Ljc5NyAxMTAuMjUgMCAxNzAuMTktNjEuNDE4IDE5Ni4wOS05Ny42NzYgMTQuMDU5LTE5Ljk4IDE0LjgwMS00Ni42MTcgMC43MzgyOC02Ni41OTh6bS0zNTcuNCA0MC42OTljLTMuNjk5Mi00LjQ0MTQtMy42OTkyLTExLjA5OCAwLTE1LjUzOSAyMC43MTktMzEuMDc4IDY4LjgxNi04Mi44NzkgMTYwLjU3LTgyLjg3OSAxNy4wMiAwIDM0Ljc3NyAyLjIxODggNTEuMDU5IDUuOTE4bC0zNC4wMzkgMzQuMDM5Yy0yNi42NDEtOS42MjExLTU2LjIzOCA0LjQ0MTQtNjUuODU1IDMxLjA3OC0zLjY5OTIgMTEuMDk4LTMuNjk5MiAyMy42OCAwIDM0Ljc3N2wtNDguMDk4IDQ4LjA5OGMtMjUuMTYtMTMuMzEyLTQ2LjYyMS0zMi41NTUtNjMuNjM3LTU1LjQ5MnptMzIwLjQxIDBjLTIwLjcxOSAyOS41OTgtNjkuNTU5IDc5LjE3Ni0xNTkuODQgNzkuMTc2LTE3LjAyIDAtMzQuNzc3LTIuMjE4OC01MS4wNTktNS45MThsMzQuMDM5LTM0LjAzOWMyNi42NDEgOS42MjExIDU2LjIzOC00LjQ0MTQgNjUuODU1LTMxLjA3OCAzLjY5OTItMTEuMDk4IDMuNjk5Mi0yMy42OCAwLTM0Ljc3N2w0Ny4zNTktNDcuMzU5YzI1Ljg5OCAxNC44MDEgNDcuMzU5IDM0Ljc3NyA2NC4zNzkgNTguNDU3IDIuOTYwOSA0LjQzNzUgMi45NjA5IDExLjA5OC0wLjczODI4IDE1LjUzOXoiLz4KPC9zdmc+Cg==";
}
else {
    document.getElementById('password').type="password";
    document.getElementById('ojoLogin').width="40";
    document.getElementById('ojoLogin').src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iNzUycHQiIGhlaWdodD0iNzUycHQiIHZlcnNpb249IjEuMSIgdmlld0JveD0iMCAwIDc1MiA3NTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiA8cGF0aCBkPSJtNTcyLjMyIDM2OS43NmMtMTUuMzQtMzkuMzk4LTQyLjM3OS03My4xNTYtNzcuNDczLTk2LjczNC0zNS4wOTQtMjMuNTc0LTc2LjU2Ni0zNS44NDQtMTE4Ljg0LTM1LjE0OC00Mi4yNzMtMC42OTUzMS04My43NDYgMTEuNTc0LTExOC44NCAzNS4xNDgtMzUuMDk4IDIzLjU3OC02Mi4xMzMgNTcuMzM2LTc3LjQ3MyA5Ni43MzQtMS4zNDc3IDQuMDU0Ny0xLjM0NzcgOC40MzM2IDAgMTIuNDg4IDE1LjM0IDM5LjM5OCA0Mi4zNzUgNzMuMTU2IDc3LjQ3MyA5Ni43MyAzNS4wOTQgMjMuNTc4IDc2LjU2NiAzNS44NDggMTE4Ljg0IDM1LjE1MiA0Mi4yNzcgMC42OTUzMSA4My43NS0xMS41NzQgMTE4Ljg0LTM1LjE1MiAzNS4wOTQtMjMuNTc0IDYyLjEzMy01Ny4zMzIgNzcuNDczLTk2LjczIDEuMzQ3Ny00LjA1NDcgMS4zNDc3LTguNDMzNiAwLTEyLjQ4OHptLTE5Ni4zMiAxMDQuOTFjLTMyLjk0NSAxLjA5NzctNjUuNDY1LTcuNzE4OC05My4zNDgtMjUuMzA5LTI3Ljg3OS0xNy41OS00OS44NC00My4xNDUtNjMuMDM1LTczLjM1NSAxMy4xOTUtMzAuMjA3IDM1LjE1Ni01NS43NjIgNjMuMDM1LTczLjM1MiAyNy44ODMtMTcuNTkgNjAuNDAyLTI2LjQwNiA5My4zNDgtMjUuMzA5IDMyLjk0OS0xLjA5NzcgNjUuNDY5IDcuNzE4OCA5My4zNDggMjUuMzA5IDI3Ljg4MyAxNy41ODYgNDkuODQ4IDQzLjEzNyA2My4wNTEgNzMuMzQ0LTEzLjE5OSAzMC4yMTEtMzUuMTYgNTUuNzY2LTYzLjA0MyA3My4zNTUtMjcuODgzIDE3LjU5NC02MC40MDIgMjYuNDEtOTMuMzU1IDI1LjMxNnptMC0xNTcuODZjLTE1LjY5OSAwLTMwLjc1OCA2LjIzNDQtNDEuODU5IDE3LjMzNnMtMTcuMzM2IDI2LjE2LTE3LjMzNiA0MS44NTljMCAxNS43MDMgNi4yMzQ0IDMwLjc1OCAxNy4zMzYgNDEuODU5czI2LjE2IDE3LjM0IDQxLjg1OSAxNy4zNGMxNS43MDMgMCAzMC43NTgtNi4yMzgzIDQxLjg1OS0xNy4zNHMxNy4zNC0yNi4xNTYgMTcuMzQtNDEuODU5Yy0wLjAxNTYyNS0xNS42OTUtNi4yNTc4LTMwLjc0Mi0xNy4zNTktNDEuODQtMTEuMDk4LTExLjA5OC0yNi4xNDUtMTcuMzQtNDEuODQtMTcuMzU1em0wIDc4LjkzYy01LjIzMDUgMC0xMC4yNS0yLjA3ODEtMTMuOTUzLTUuNzgxMi0zLjY5OTItMy42OTkyLTUuNzc3My04LjcxODgtNS43NzczLTEzLjk1MyAwLTUuMjMwNSAyLjA3ODEtMTAuMjUgNS43NzczLTEzLjk1MyAzLjcwMzEtMy42OTkyIDguNzIyNy01Ljc3NzMgMTMuOTUzLTUuNzc3MyA1LjIzNDQgMCAxMC4yNTQgMi4wNzgxIDEzLjk1MyA1Ljc3NzMgMy43MDMxIDMuNzAzMSA1Ljc4MTIgOC43MjI3IDUuNzgxMiAxMy45NTMtMC4wMDc4MTMgNS4yMzQ0LTIuMDg5OCAxMC4yNDYtNS43ODkxIDEzLjk0NS0zLjY5OTIgMy42OTkyLTguNzEwOSA1Ljc4MTItMTMuOTQ1IDUuNzg5MXoiLz4KPC9zdmc+Cg==";
}
})

document.getElementById("ojoLogin_2").addEventListener("click",()=>{  
    if(document.getElementById('ojoLogin_2').width=="40"){
        document.getElementById('password_2').type="text";
        document.getElementById('ojoLogin_2').width="39";
        document.getElementById('ojoLogin_2').src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iNzUycHQiIGhlaWdodD0iNzUycHQiIHZlcnNpb249IjEuMSIgdmlld0JveD0iMCAwIDc1MiA3NTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiA8cGF0aCBkPSJtNTcyLjgzIDM0NC45MmMtMTcuNzU4LTI2LjY0MS00MS40MzgtNDguODQtNjguMDc4LTY1Ljg1NWw2NC4zNzktNjQuMzc5YzguODc4OS05LjYyMTEgOC4xNDA2LTIzLjY4LTAuNzM4MjgtMzEuODE2LTguODc4OS04LjE0MDYtMjIuMTk5LTguMTQwNi0zMS4wNzggMGwtNzQuNzM4IDc0LjczNGMtMjcuMzc5LTkuNjE3Mi01Ni45NzctMTQuNzk3LTg2LjU3OC0xNC43OTctMTExLjczIDAtMTcxLjY3IDY0LjM3NS0xOTcuNTcgMTAyLjExLTEzLjMyIDE5Ljk4LTEzLjMyIDQ2LjYxNyAwLjczODI4IDY1Ljg1NSAxNy43NTggMjUuMTYgNDAuNjk5IDQ2LjYxNyA2Ny4zMzYgNjIuODk4bC02My42MzcgNjMuNjM3Yy04Ljg3ODkgOC44Nzg5LTguODc4OSAyMi45MzgtMC43MzgyOCAzMS4wNzhzMjIuOTM4IDguODc4OSAzMS4wNzggMC43MzgyOGwwLjczODI4LTAuNzM4MjggNzQuNzM4LTczLjk5MmMyOC4xMjEgMTAuMzU5IDU3LjcxOSAxNC43OTcgODcuMzE2IDE0Ljc5NyAxMTAuMjUgMCAxNzAuMTktNjEuNDE4IDE5Ni4wOS05Ny42NzYgMTQuMDU5LTE5Ljk4IDE0LjgwMS00Ni42MTcgMC43MzgyOC02Ni41OTh6bS0zNTcuNCA0MC42OTljLTMuNjk5Mi00LjQ0MTQtMy42OTkyLTExLjA5OCAwLTE1LjUzOSAyMC43MTktMzEuMDc4IDY4LjgxNi04Mi44NzkgMTYwLjU3LTgyLjg3OSAxNy4wMiAwIDM0Ljc3NyAyLjIxODggNTEuMDU5IDUuOTE4bC0zNC4wMzkgMzQuMDM5Yy0yNi42NDEtOS42MjExLTU2LjIzOCA0LjQ0MTQtNjUuODU1IDMxLjA3OC0zLjY5OTIgMTEuMDk4LTMuNjk5MiAyMy42OCAwIDM0Ljc3N2wtNDguMDk4IDQ4LjA5OGMtMjUuMTYtMTMuMzEyLTQ2LjYyMS0zMi41NTUtNjMuNjM3LTU1LjQ5MnptMzIwLjQxIDBjLTIwLjcxOSAyOS41OTgtNjkuNTU5IDc5LjE3Ni0xNTkuODQgNzkuMTc2LTE3LjAyIDAtMzQuNzc3LTIuMjE4OC01MS4wNTktNS45MThsMzQuMDM5LTM0LjAzOWMyNi42NDEgOS42MjExIDU2LjIzOC00LjQ0MTQgNjUuODU1LTMxLjA3OCAzLjY5OTItMTEuMDk4IDMuNjk5Mi0yMy42OCAwLTM0Ljc3N2w0Ny4zNTktNDcuMzU5YzI1Ljg5OCAxNC44MDEgNDcuMzU5IDM0Ljc3NyA2NC4zNzkgNTguNDU3IDIuOTYwOSA0LjQzNzUgMi45NjA5IDExLjA5OC0wLjczODI4IDE1LjUzOXoiLz4KPC9zdmc+Cg==";
    }
    else {
        document.getElementById('password_2').type="password";
        document.getElementById('ojoLogin_2').width="40";
        document.getElementById('ojoLogin_2').src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iNzUycHQiIGhlaWdodD0iNzUycHQiIHZlcnNpb249IjEuMSIgdmlld0JveD0iMCAwIDc1MiA3NTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiA8cGF0aCBkPSJtNTcyLjMyIDM2OS43NmMtMTUuMzQtMzkuMzk4LTQyLjM3OS03My4xNTYtNzcuNDczLTk2LjczNC0zNS4wOTQtMjMuNTc0LTc2LjU2Ni0zNS44NDQtMTE4Ljg0LTM1LjE0OC00Mi4yNzMtMC42OTUzMS04My43NDYgMTEuNTc0LTExOC44NCAzNS4xNDgtMzUuMDk4IDIzLjU3OC02Mi4xMzMgNTcuMzM2LTc3LjQ3MyA5Ni43MzQtMS4zNDc3IDQuMDU0Ny0xLjM0NzcgOC40MzM2IDAgMTIuNDg4IDE1LjM0IDM5LjM5OCA0Mi4zNzUgNzMuMTU2IDc3LjQ3MyA5Ni43MyAzNS4wOTQgMjMuNTc4IDc2LjU2NiAzNS44NDggMTE4Ljg0IDM1LjE1MiA0Mi4yNzcgMC42OTUzMSA4My43NS0xMS41NzQgMTE4Ljg0LTM1LjE1MiAzNS4wOTQtMjMuNTc0IDYyLjEzMy01Ny4zMzIgNzcuNDczLTk2LjczIDEuMzQ3Ny00LjA1NDcgMS4zNDc3LTguNDMzNiAwLTEyLjQ4OHptLTE5Ni4zMiAxMDQuOTFjLTMyLjk0NSAxLjA5NzctNjUuNDY1LTcuNzE4OC05My4zNDgtMjUuMzA5LTI3Ljg3OS0xNy41OS00OS44NC00My4xNDUtNjMuMDM1LTczLjM1NSAxMy4xOTUtMzAuMjA3IDM1LjE1Ni01NS43NjIgNjMuMDM1LTczLjM1MiAyNy44ODMtMTcuNTkgNjAuNDAyLTI2LjQwNiA5My4zNDgtMjUuMzA5IDMyLjk0OS0xLjA5NzcgNjUuNDY5IDcuNzE4OCA5My4zNDggMjUuMzA5IDI3Ljg4MyAxNy41ODYgNDkuODQ4IDQzLjEzNyA2My4wNTEgNzMuMzQ0LTEzLjE5OSAzMC4yMTEtMzUuMTYgNTUuNzY2LTYzLjA0MyA3My4zNTUtMjcuODgzIDE3LjU5NC02MC40MDIgMjYuNDEtOTMuMzU1IDI1LjMxNnptMC0xNTcuODZjLTE1LjY5OSAwLTMwLjc1OCA2LjIzNDQtNDEuODU5IDE3LjMzNnMtMTcuMzM2IDI2LjE2LTE3LjMzNiA0MS44NTljMCAxNS43MDMgNi4yMzQ0IDMwLjc1OCAxNy4zMzYgNDEuODU5czI2LjE2IDE3LjM0IDQxLjg1OSAxNy4zNGMxNS43MDMgMCAzMC43NTgtNi4yMzgzIDQxLjg1OS0xNy4zNHMxNy4zNC0yNi4xNTYgMTcuMzQtNDEuODU5Yy0wLjAxNTYyNS0xNS42OTUtNi4yNTc4LTMwLjc0Mi0xNy4zNTktNDEuODQtMTEuMDk4LTExLjA5OC0yNi4xNDUtMTcuMzQtNDEuODQtMTcuMzU1em0wIDc4LjkzYy01LjIzMDUgMC0xMC4yNS0yLjA3ODEtMTMuOTUzLTUuNzgxMi0zLjY5OTItMy42OTkyLTUuNzc3My04LjcxODgtNS43NzczLTEzLjk1MyAwLTUuMjMwNSAyLjA3ODEtMTAuMjUgNS43NzczLTEzLjk1MyAzLjcwMzEtMy42OTkyIDguNzIyNy01Ljc3NzMgMTMuOTUzLTUuNzc3MyA1LjIzNDQgMCAxMC4yNTQgMi4wNzgxIDEzLjk1MyA1Ljc3NzMgMy43MDMxIDMuNzAzMSA1Ljc4MTIgOC43MjI3IDUuNzgxMiAxMy45NTMtMC4wMDc4MTMgNS4yMzQ0LTIuMDg5OCAxMC4yNDYtNS43ODkxIDEzLjk0NS0zLjY5OTIgMy42OTkyLTguNzEwOSA1Ljc4MTItMTMuOTQ1IDUuNzg5MXoiLz4KPC9zdmc+Cg==";
    }
    })

    
document.getElementsByName('sede')[0].addEventListener('change', ()=>{
    el=document.getElementsByName('sede')[0];
    if(el.value=="c"){
        document.getElementById('loguarse').children[3].style="height:0;";
        setTimeout(() => {
            document.getElementById('loguarse').children[3].style="";
        }, 1);
        
    }
    else{
        if(document.getElementById('loguarse').children[3].style.display!="none"){
            document.getElementById('loguarse').children[3].style="height:0;";
            setTimeout(() => {
                document.getElementById('loguarse').children[3].style="display:none";
            }, 500);
        }
    }
    console.log(el.value);
});
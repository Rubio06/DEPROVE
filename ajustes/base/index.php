<?php 
$mante="";
?>
<html>
<head>
	<meta charset="utf-8" />
	<title>Convert Excel to HTML Table using JavaScript</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        #tbl_exporttable_to_xls{
            width: 100%;
            text-align: center;
        }
        td,th{
            min-width: 150px;
        }
        #paginas{
            display: flex;
            width: 40%;
            overflow: hidden;
            margin: 10px auto;
            height: 50px;
            align-items: center;
        }
        #paginas>div{
            display: flex;
            width: 70px;
        }
        #paginas>div>button{
            width: 48%;
            height: 40px;
        }
        #paginas2{
            width: 100% !important;
            overflow: hidden;
            position: relative;
            margin: 5px;
            height: 200px;
            align-items: center;
        }
        #paginas2>div>a{
            padding: 10px 15px;
            margin: 10px;
            background: blue;
            display: inline-block;
            color: white;
            text-align:center;
        }
        #paginas2>div>a>p{
            font-size:12px;
        }
    </style>
    
 
<!-- links para exportar a excel -->
<script src="https://unpkg.com/xlsx@0.16.9/dist/xlsx.full.min.js"></script>
    <script src="https://unpkg.com/file-saverjs@latest/FileSaver.min.js"></script>
    <script src="https://unpkg.com/tableexport@latest/dist/js/tableexport.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="base.css">
</head>
<body>
    <header>
        <?php include("../../header.php") ?>
    </header>

<div class="conte-titulo">
<h1>BASES</h1>
</div>

    <div class="container">
   	
               <div class="conte-file" id="conte-file"> <input type="file" id="excel_file" /></div>
                <div><button onclick="ExportToExcel('xlsx')" class="bajar"> DESCARGAR DOCUMENTO</button></div>
                <div><button onclick="VaciarTabla()" class="bajar" style="background:red;color: white;">ELIMINAR BASE DE DATOS</button></div>
    		</div>
            <!-- -------tabla------------------
         -->
         <div id="contador"></div>
            <div class="contenedor">
        <div class="conte-table" >
            <table id="tbl_exporttable_to_xls">
                <tbody id="excel_data">
                    <tr>
                        <th class="enca">id</th>
                        <th class="enca">CLIENTE</th>
                        <th class="enca">DNI</th>
                        <th class="enca">NUMERO REF</th>
                        <th class="enca">TIPIF1</th>
                        <th class="enca">TIPIF2</th>
                        <th class="enca">FECHA</th>
                        <th class="enca">H. Inicio llamada</th>
                        <th class="enca">H. fin llamada</th>
                        <th class="enca">asesor</th>
                        <th class="enca">sede</th>
                    </tr>
                </tbody>

            </table>
        </div>
       </div>
        <div id="paginas">
            <div>
                <button onclick='actuPag("--");'><<</button>
                <button onclick='actuPag("-");'><</button>
            </div>
            <div id="paginas2">
                <div style="position: absolute;width: max-content; left:0;">
                </div>
            </div>
            <div>
                <button onclick='actuPag("+");'>></button>
                <button onclick='actuPag("++");'>>></button>
            </div>
        </div>
   
   

 <script src="Export.js"> 
</script> 
<script src="Import.js"> 
</script> 
<script>
    cabeza=document.getElementById("excel_data").innerHTML;
    id=0;
    i=0;
    indice=1;
    const actuPag=(op)=>{
        if(op=="+"&&(i*175<(document.getElementById("paginas2").children[0].offsetWidth-document.getElementById("paginas2").offsetWidth))){
            i++;
        }
        else if(op=="++"&&((i+1)*175<(document.getElementById("paginas2").children[0].offsetWidth-(document.getElementById("paginas2").offsetWidth)))){
            i++;i++;
        }
        else if(op=="-"&&i>0){
            i--;
        }
        else if(op=="--"&&i>1){
            i--;i--;
        }
        document.getElementById("paginas2").children[0].style.left="-"+(i*175);
        // document.getElementById("paginas2").children[0].scroll(0,(i*175));
    }
    const cargarTabla=(n)=>{
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                indice=n;
                try {
                    data=JSON.parse(this.response);
                    console.log(data);
                    document.getElementById("paginas2").children[0].innerHTML=data[0];
                    document.getElementById("excel_data").innerHTML=cabeza+data[1];
                    total=data[2];
                    id=data[2];
                    document.getElementById('contador').innerHTML = "Hay un total de: "+total+" registros.<br>Numeros disponibles: "+data[3];
                    if(total>1500){
                        document.getElementById("paginas").children[0].children[0].style="";
                        document.getElementById("paginas").children[0].children[1].style="";
                        document.getElementById("paginas").children[2].children[0].style="";
                        document.getElementById("paginas").children[2].children[1].style="";
                    }
                    else{
                        document.getElementById("paginas").children[0].children[0].style="display:none;";
                        document.getElementById("paginas").children[0].children[1].style="width:100%;";
                        document.getElementById("paginas").children[2].children[0].style="width:100%;";
                        document.getElementById("paginas").children[2].children[1].style="display:none;";
                    }
                } catch (error) {
                    console.log(this.response);
                    document.getElementById("excel_data").innerHTML=cabeza+this.response;
                }
            }
        };
        xmlhttp.open("POST", "./bajar_numeros.php", true);
        data = new FormData();
        data.append("indice", n)
        data.append("cantidad", 100)
        xmlhttp.send(data);
    }
    window.onload=cargarTabla(1);
</script>
</body>
</html>

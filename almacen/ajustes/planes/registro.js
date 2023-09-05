// i=0;
const botonPlane = () =>{
    // i++;
    let Pventa = document.getElementById('Pventa').value;
    let Ptipo = document.getElementById('Ptipo').value;
    let Pcategoria = document.getElementById('Pcategoria').value;
    let plan = document.getElementById('plan').value;
    let center = document.getElementById('peso-center').value;
    let call = document.getElementById('call').value;
    let ptienda = document.getElementById('peso-tienda').value;
    let tienda = document.getElementById('tienda').value;
    let pesoCoord = document.getElementById('peso-coord').value;
    let coord = document.getElementById('coord').value;
    let operaciones = document.getElementById('operaciones').value;
    let cf = document.getElementById('cf-jo').value;
    let habi = document.getElementById('habi-desa').value;


//      cadena='<td id=cliente"'+i+'">'+Pventa+
//      '</td><td id=Ptipo"'+i+'">'+Ptipo+
//      '</td><td id=Pcategoria"'+i+'">'+Pcategoria+
//      '</td><td id=plan"'+i+'">'+plan+
//      '</td><td id=center"'+i+'">'+center+
//      '</td><td id=call"'+i+'">'+call+
//      '</td><td id=ptienda"'+i+'">'+ptienda+
//      '</td><td id=tienda"'+i+'">'+tienda+
//      '</td><td id=pesoCoord"'+i+'">'+pesoCoord+
//      '</td><td id=coord"'+i+'">'+coord+
//      '</td><td id=operaciones"'+i+'">'+operaciones+
//      '</td><td id=cf"'+i+'">'+cf+
//      '</td><td id=habi"'+i+'">'+habi+'</td>';

//     tr= document.createElement("tr");
//     tr.innerHTML=cadena;
// document.getElementById("tbPlan").append(tr);

// base de datos
 ///aqui

 var xmlhttp = new XMLHttpRequest();
 xmlhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
         console.log(this.response);
     }
 };
 console.log()
 xmlhttp.open("POST", "../subir.php",true);
 data = new FormData();
 sql="INSERT INTO planes VALUES (null,'"+Pventa
 +"', '"+Ptipo
 +"', '"+Pcategoria
 +"', '"+plan
 +"', '"+center
 +"', '"+call
 +"', '"+ptienda
 +"', '"+tienda
 +"', '"+pesoCoord
 +"', '"+coord
 +"', '"+operaciones
 +"', '"+cf
 +"', '"+habi+"');";

 data.append("query",sql)
xmlhttp.send(data);
// cartg=window.open("index.php","_BLANCK");
//     cartg.location.reload();


// contenido reset
document.getElementById('Pventa').value="";
document.getElementById('Ptipo').value="";
document.getElementById('Pcategoria').value="";
document.getElementById('plan').value="";
document.getElementById('peso-center').value="";
document.getElementById('call').value="";
document.getElementById('peso-tienda').value="";
document.getElementById('tienda').value="";
document.getElementById('peso-coord').value="";
document.getElementById('coord').value="";
document.getElementById('operaciones').value="";
document.getElementById('cf-jo').value="";
document.getElementById('habi-desa').value="";
modal.style.display = 'none';
}


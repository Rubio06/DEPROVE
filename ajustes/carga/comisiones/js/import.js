//exportar

//MODAL MOSTRAR RESULTADO

let modal = document.getElementById('miModal');
let flex = document.getElementById('flex');
let abrir = document.getElementById('abrirmodal');
let cerrar = document.getElementById('close');

abrir.addEventListener('click', function() {
    modal.style.display = 'block';
     
});

cerrar.addEventListener('click', function() {
    modal.style.display = 'none';
     
});

window.addEventListener('click', function(e) { 
    if (e.target == flex) {
        modal.style.display = 'none';
    }
     
});


excel_file="";
try {
    excel_file = document.getElementById('excel_file');
    Array_todo = [];
    
    excel_file.addEventListener('change', (event) => {
    
        if (!['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'].includes(event.target.files[0].type)) {
            document.getElementById('excel_data').innerHTML = '<div class="alert alert-danger">Solo se acepta archivos excel</div>';
            excel_file.value = '';
            return false;
        }
    
        var reader = new FileReader();
        reader.readAsArrayBuffer(event.target.files[0]);
        reader.onload = function(event) {
            var data = new Uint8Array(reader.result);
            var work_book = XLSX.read(data, { type: 'array' });
            var sheet_name = work_book.SheetNames;
            var sheet_data = XLSX.utils.sheet_to_json(work_book.Sheets[sheet_name[0]], { header: 1 });
            if (sheet_data.length > 0) {
                id++;
                max = 299;
                    sql = "INSERT INTO comision (distribuidor,cliente,telefonomsisdn, plantarifa, tipoplanmodalidad, transacciontpooper,comisiontotal,montocomision,octipocomision,mespago,ocpolisa,sec,dniclienteoruc) VALUES ";
                for (var row = 0; row < sheet_data.length; row++) {
                    arraycelda = [];
                    if (max < row || id == sheet_data.length) {
                        tr = document.createElement("tr");
                        tr.innerHTML = ("<td>" + id + "</td>");
                    }
                    if (max == row) {
                        tr = document.createElement("tr");
                        tr.innerHTML = ("<td>---</td><td>---</td><td>---</td><td>---</td><td>---</td><td>---</td><td>---</td><td>---</td><td>---</td><td>---</td><td>---</td>");
                    }
                    for (var cell = 0; cell < 13; cell++) {
                        if (max < row || id == sheet_data.length) {
                            td = document.createElement("td");
                            td.innerHTML = sheet_data[row][cell];
                            tr.innerHTML += (td.outerHTML);
                        }
                        arraycelda.push('"' + sheet_data[row][cell] + '"');
                    }
                    console.log(arraycelda);
                    if (arraycelda.length > 0) {
                        if ((Array_todo.length) > 0) { sql += ","; }
                        sql += "(" + arraycelda.toString() + ")";
                        Array_todo.push(arraycelda);
                        if (max < row || id == sheet_data.length) {
                            tr.innerHTML += "<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>";
                            document.getElementById('excel_data').append(tr);
                        }
                        id++;
                    }
                    
                }
                if (sql != "INSERT INTO comision (distribuidor,cliente,telefonomsisdn, plantarifa, tipoplanmodalidad, transacciontpooper,comisiontotal,montocomision,octipocomision,mespago,ocpolisa,sec,dniclienteoruc) VALUES ") {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            console.log(this.response);
                        }
                    };
                    console.log(sql)
                    xmlhttp.open("POST", "./subir.php", true);
                    data = new FormData();
                    // data.append()
                    // data.append("codigo", document.getElementById("codigo").value)
                    data.append("query", sql)
    
                    xmlhttp.send(data);
                    sql = "";
                }
                id = id - 1;
                console.log("Hay un total de: " + id + " registros.");
                // document.getElementById('excel_data').append(table);
            }
            excel_file.value = '';
        }
    
    });
} catch (error) {
    
}

// try {
//     excel_file = document.getElementById('excel_file2');
//     Array_todo = [];
//     excel_file.addEventListener('change', (event) => {
    
//         if (!['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'].includes(event.target.files[0].type)) {
//             document.getElementById('excel_data2').innerHTML = '<div class="alert alert-danger">Solo se acepta archivos excel</div>';
//             excel_file.value = '';
//             return false;
//         }
    
//         var reader = new FileReader();
//         reader.readAsArrayBuffer(event.target.files[0]);
//         reader.onload = function(event) {
//             var data = new Uint8Array(reader.result);
//             var work_book = XLSX.read(data, { type: 'array' });
//             var sheet_name = work_book.SheetNames;
//             var sheet_data = XLSX.utils.sheet_to_json(work_book.Sheets[sheet_name[0]], { header: 1 });
//             if (sheet_data.length > 0) {
//                 id++;
//                 max = 299;
//                     sql = "INSERT INTO comision (distribuidor,cliente, telefono, cf, tipoplan,transaccion,comisiontotal,montocomision,octipocomision,ocpolisa,sec,dniclienteoruc) VALUES ";
//                 for (var row = 0; row < sheet_data.length; row++) {
//                     arraycelda = [];
//                     if (max < row || id == sheet_data.length) {
//                         tr = document.createElement("tr");
//                         tr.innerHTML = ("<td>" + id + "</td>");
//                     }
//                     if (max == row) {
//                         tr = document.createElement("tr");
//                         tr.innerHTML = ("<td>---</td><td>---</td><td>---</td><td>---</td><td>---</td><td>---</td><td>---</td><td>---</td><td>---</td><td>---</td><td>---</td>");
//                     }
//                     for (var cell = 1; cell < 12; cell++) {
//                         if (max < row || id == sheet_data.length) {
//                             td = document.createElement("td");
//                             td.innerHTML = sheet_data[row][cell];
//                             tr.innerHTML += (td.outerHTML);
//                         }
//                         arraycelda.push('"' + sheet_data[row][cell] + '"');
//                     }
//                     console.log(arraycelda);
//                     if (arraycelda.length > 1) {
//                         if ((Array_todo.length) > 0) { sql += ","; }
//                         sql += "(" + arraycelda.toString() + ")";
//                         Array_todo.push(arraycelda);
//                         if (max < row || id == sheet_data.length) {
//                             tr.innerHTML += "<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>";
//                             document.getElementById('excel_data').append(tr);
//                         }
//                         id++;
//                     }
                    
//                 }
//                 if (sql != "INSERT INTO comision (distribuidor,cliente, telefono, cf, tipoplan,transaccion,comisiontotal,montocomision,octipocomision,ocpolisa,sec,dniclienteoruc) VALUES ") {
//                     var xmlhttp = new XMLHttpRequest();
//                     xmlhttp.onreadystatechange = function() {
//                         if (this.readyState == 4 && this.status == 200) {
//                             console.log(this.response);
//                         }
//                     };
//                     console.log(sql)
//                     xmlhttp.open("POST", "./subir.php", true);
//                     data = new FormData();
//                     // data.append()
//                     // data.append("codigo", document.getElementById("codigo").value)
//                     data.append("query", sql)
    
//                     xmlhttp.send(data);
//                     sql = "";

//                 }
//                 id = id - 1;
//                 console.log("Hay un total de: " + id + " registros.");
//                 // document.getElementById('excel_data').append(table);
//             }
//             excel_file.value = '';
//         }
    
//     });
// } catch (error) {
//     console.log(error);
// }    


//exportar
const excel_file = document.getElementById('excel_file');
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
            sql = "INSERT INTO numerosllamadas (cliente, dni, referencia) VALUES ";
            console.log(sheet_data.length);
            for (var row = 1; row < sheet_data.length; row++) {
                arraycelda = [];
                if (max < row || id == sheet_data.length) {
                    tr = document.createElement("tr");
                    tr.innerHTML = ("<td>" + id + "</td>");
                }
                if (max == row) {
                    tr = document.createElement("tr");
                    tr.innerHTML = ("<td>---</td><td>---</td><td>---</td><td>---</td><td>---</td><td>---</td><td>---</td><td>---</td><td>---</td><td>---</td><td>---</td>");
                }
                for (var cell = 0; cell < sheet_data[row].length; cell++) {
                    if (sheet_data[row][cell] != "" && sheet_data[row][cell] != " ") {
                        if (max < row || id == sheet_data.length) {
                            td = document.createElement("td");
                            td.innerHTML = sheet_data[row][cell];
                            tr.innerHTML += (td.outerHTML);
                        }
                        arraycelda.push("'" + sheet_data[row][cell] + "'");
                    }
                }
                if (arraycelda.length == 3) {
                    if ((Array_todo.length) > 0) { sql += ","; }
                    sql += "(" + arraycelda.toString() + ")";
                    Array_todo.push(arraycelda);
                    if (max < row || id == sheet_data.length) {
                        tr.innerHTML = tr.innerHTML + "<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>";
                        document.getElementById('excel_data').append(tr);
                    }
                    id++;
                }
            }
            if (sql != "INSERT INTO numerosllamadas (cliente, dni, referencia) VALUES ") {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.response);
                    }
                };
                console.log()
                xmlhttp.open("POST", "../subir.php", true);
                data = new FormData();
                data.append("query", sql)
                xmlhttp.send(data);
                sql = "";
            }
            id = id - 1;
            document.getElementById('contador').innerHTML = "Hay un total de: " + id + " registros.";
            // document.getElementById('excel_data').append(table);
        }
        excel_file.value = '';
    }

});
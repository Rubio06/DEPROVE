function ExportToExcel(type, fn, dl) {
    var elt = document.getElementById('tbl_exporttable_to_xls');
    var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
    return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
        XLSX.writeFile(wb, fn || ('REPORTE.' + (type || 'xlsx')));
}
function VaciarTabla(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {}
    };
    if(confirm("¿De verdad desea borrar los números?")){
        xmlhttp.open("POST", "../subir.php", true);
        data = new FormData();
        data.append("query", "TRUNCATE numerosllamadas")
        xmlhttp.send(data);
    }
}

document.addEventListener("contextmenu",(e)=>{
    e.preventDefault();
})

document.addEventListener ("keydown",function (e){
    var tecla=e.keyCode;
    console.log(tecla);
    if (tecla==116) {
        if(confirm('Si recarga la página perdera todos los datos ingresados,<br> ¿Deseas recargar la página?"')){
            location.reload();
        } 
        else {
            e.keyCode=0;
            e.returnValue=false;
        }
    }
    if (e.ctrlKey && e.shiftKey) {
        if(tecla == 67|| tecla==73){
            alert("No se puede usar esto :c");
            e.preventDefault(); 
        }
    }
    if (tecla==123) {
        alertify.error("No se puede uar el \"F12\" ");
        event.keyCode=0;
        event.returnValue=false;
    }
})
// ALMACEN

let modal = document.getElementById('miModal');
let flex = document.getElementById('flex');
let abrir = document.getElementById('planes');
let cerrar = document.getElementById('close');

abrir.addEventListener('click', function() {
    modal.style.display = 'block';
    try{document.getElementById('mostActiv').style="display:none";}
    catch(ex){console.log(ex);}
});

cerrar.addEventListener('click', function() {
    modal.style.display = 'none';
});

window.addEventListener('click', function(e) {
    // console.log(e.target);
    if (e.target == flex) {
        modal.style.display = 'none';
    }
});

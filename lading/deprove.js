const mostrarVenta = (n) => {
    if(document.getElementsByName('botton-venta')[n].value==="VER"){
        document.getElementsByName('descripcionFicha')[n].style.opacity=0;
        document.getElementsByName('ImagenFicha')[n].style.opacity=1;
        document.getElementsByName('botton-venta')[n].value = "DESCRIPCIÓN";
     } else{
        document.getElementsByName('descripcionFicha')[n].style.opacity=1;
        document.getElementsByName('ImagenFicha')[n].style.opacity=0;
        document.getElementsByName('botton-venta')[n].value = "VER";
        }  
}




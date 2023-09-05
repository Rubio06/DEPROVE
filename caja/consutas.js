function buscar_datos(consulta){
    $.ajax({
        url: 'consultas.php',
        type: 'POST',
        dataType: 'html',
        data: {consulta: consulta},
    })
    
    .done(function(respuesta){
        $("#codigo").html(respuesta);
    })

    .fail(function() {
        console.log("error");
    })
}
buscar_datos();
<?php session_start(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-latest.js"></script>
<body>
  <form id="forma" target="ventana" action="https://asesor.deproveglobal.com/" method="post">
  <!-- <form id="forma" target="ventana" action="//localhost/pedidos/" method="post"> -->
    <input type="text" name="usuarioLogin" value="<?php echo $_SESSION["usuario"]; ?>" />
    <input type="text" name="contrasLogin" value="<?php echo $_SESSION["contraseña"]; ?>" />
    <input type="text" name="cordLogin" value="<?php echo $_SESSION["coordinador"]; ?>" />
  </form>
  <script>
      params  = 'width='+screen.width;
      params += ', height='+screen.height;
      params += ', top=0, left=0'
      params += ', fullscreen=yes';
      params += ', directories=no';
      params += ', location=no';
      params += ', menubar=no';
      params += ', resizable=no';
      params += ', titlebar=no';
      params += ', status=no';
      params += ', toolbar=no';
      popup=window.open('', 'ventana','Subir',params);
      var form=$("#forma");
      // var form = $('<form target="TheWindow" action="https://asesor.deproveglobal.com/" method="post">' +
      //   '<input type="text" name="usuarioLogin" value="<?php echo $_SESSION["usuario"]; ?>" />' +
      //   '<input type="text" name="contrasLogin" value="<?php echo $_SESSION["contraseña"]; ?>" />' +
      // '</form>');
      // $('body').append(form);
      form.submit();
      form.remove();
  </script>
</body>
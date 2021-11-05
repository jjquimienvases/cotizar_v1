
<DOCTYPE html>
  <html>
  <head>
    <link rel="stylesheet" href="css/homestyle.css">
    <?php
    if($_SESSION['userid']) { ?>
      <div class="csesion">
    <a class="logout" href="action.php?action=logout"><strong>|cerrar sesion|</strong></a> </div>
    <?php } ?>
  </head>
</html>

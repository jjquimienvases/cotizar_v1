<?php
$sessionTime = 365 * 24 * 60 * 60; // 1 a�0�9o de duraci��n
session_set_cookie_params($sessionTime);
session_start();
// include('header.php');
$loginError = '';
if (!empty($_POST['email']) && !empty($_POST['pwd'])) {
    include 'Invoice.php';
    $invoice = new Invoice();
    $user = $invoice->loginUsers($_POST['email'], $_POST['pwd']);
    if (!empty($user)) {
        $sessionTime = 365 * 24 * 60 * 60; // 1 a�0�9o de duraci��n

        session_start();
        $_SESSION['user'] = $user[0]['first_name'] . "&nbsp;" . $user[0]['last_name'];
        $_SESSION['userid'] = $user[0]['id'];
        $_SESSION['email'] = $user[0]['email'];
        $_SESSION['address'] = $user[0]['address'];
        $_SESSION['mobile'] = $user[0]['mobile'];
        $_SESSION['id_rol'] = $user[0]['id_rol'];
        if ($_SESSION['id_rol'] == 1) {
            header("Location:factuenvases/home.php");
        } else if ($_SESSION['id_rol'] == 2) {
            header("Location:panel_mostrador.php");
        } else if ($_SESSION['id_rol'] == 3) {
            header("Location:panel_d1.php");
        } elseif ($_SESSION['id_rol'] == 4) {
            header("Location:Panel_Comerciales.php");
        } elseif ($_SESSION['id_rol'] == 5) {
            header("Location:asistente.php");
        } elseif ($_SESSION['id_rol'] == 6) {
            header("Location:panel_bodega.php");
        } elseif ($_SESSION['id_rol'] == 7) {
            header("Location:panel_ibague.php");
        } else if ($_SESSION['id_rol'] == 8) {
            header("Location:administrador/index.php");
        } elseif ($_SESSION['id_rol'] == 0) {
            $loginError = "Este usuario no tiene acceso al sistema!";
        } elseif ($_SESSION['id_rol'] == 9) {
            header("Location:panel_bodega_perfumeria.php");
        }
    }else {
        $loginError = "Verifica tu correo y contrase�0�9a!";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COTIZAR JJQUIMIENVASES</title>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href='css/estilos_log.css' rel="stylesheet">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form class="box" action="" method="post">
                <img src="JJ CIRCULO LOGO (fondo blanco).png" alt="Logo JJQUIMIENVASES">
                    <h1>Iniciar Sesion</h1>
                    
                    <p class="text-muted"> Porfavor Escribir tu correo y contrasena!</p> 
                    <div class="form-group">
                <?php if ($loginError) { ?>
                    <div class="alert alert-warning"><?php echo $loginError; ?></div>
                <?php } ?>
            </div>
                    <input type="text" name="email" placeholder="Correo electronico"> <input type="password" name="pwd" placeholder="Contrasena"> <a class="forgot text-muted" hhref="https://api.whatsapp.com/send?phone=573045393941" >Olvidaste tu contrasena?</a> <input type="submit" name="" value="Ingresar">
                  
                    <div class="col-md-12">
                        <ul class="social-network social-circle">
                            <li><a href="https://www.facebook.com/jj.quimienvases" class="icoFacebook" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="https://www.instagram.com/jj_quimienvases/?hl=es-la" class="icoInstagram" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="https://jjquimienvases.com/" class="icoGoogle" title="Google +"><i class="fas fa-store"></i></a></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
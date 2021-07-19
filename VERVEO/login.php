<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
  exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor ingrese su usuario.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingrese su contraseña.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM usuarios WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "La contraseña que has ingresado no es válida.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No existe cuenta registrada con ese nombre de usuario.";
                }
            } else{
                echo "Algo salió mal, por favor vuelve a intentarlo.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>





<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="shortcut icon" type="image/x-icon" href="LOGO.ico">
<link rel="stylesheet" href="login_files/normalize.css" type="text/css">
<link rel="stylesheet" href="login_files/alegra.min.css" type="text/css">

<link href="login_files/app.2360dbae.css" rel="preload" as="style">

<link href="login_files/app.2360dbae.css" rel="stylesheet">
<title>Ingreso a VERVEO</title>






</head>
<body>
<style type="text/css">html.hs-messages-widget-open.hs-messages-mobile,html.hs-messages-widget-open.hs-messages-mobile body{overflow:hidden!important;position:relative!important}html.hs-messages-widget-open.hs-messages-mobile body{height:100%!important;margin:0!important}#hubspot-messages-iframe-container{display:initial!important;z-index:2147483647;position:fixed!important;bottom:0!important}#hubspot-messages-iframe-container.widget-align-left{left:0!important}#hubspot-messages-iframe-container.widget-align-right{right:0!important}#hubspot-messages-iframe-container.internal{z-index:1016}#hubspot-messages-iframe-container.internal iframe{min-width:108px}#hubspot-messages-iframe-container .shadow-container{display:initial!important;z-index:-1;position:absolute;width:0;height:0;bottom:0;content:""}#hubspot-messages-iframe-container .shadow-container.internal{display:none!important}#hubspot-messages-iframe-container .shadow-container.active{width:400px;height:400px}#hubspot-messages-iframe-container iframe{display:initial!important;width:100%!important;height:100%!important;border:none!important;position:absolute!important;bottom:0!important;right:0!important;background:transparent!important}</style>


<noscript>

<iframe width=0 height=0 style=display:none;visibility:hidden src="https://www.googletagmanager.com/ns.html?id=GTM-KQG46G"></iframe>

</noscript>
<noscript><strong>Esta aplicación no funciona correctamente sin JavaScript. Por favor habilite JavaScript para continuar.</strong>
</noscript>

<div class="layout-01">
<aside data-v-6357c280="" class="sidebar-large">
<div data-v-6357c280="" class="user-access">
<div data-v-6357c280="" class="user-access-header">

<img data-v-6357c280="" src="logo.jpg"  ></a>
<p data-v-6357c280="" class="is-large is-text-grey6">Ingresa a tu cuenta</p>
<p data-v-6357c280="" style="color: #01a1ff" class="is-text-brand1">DISFRUTA DEL CONTROL CON VERVEO</p></div>




<div class="user-access-form">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

	<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
	<input  placeholder="Correo/Usuario" type="text" name="username" class="is-full-width is-large is-text-grey7" value="<?php echo $username; ?>">
	</div>

<div >
<div  class="input-wrapper is-relative">
<input  placeholder="Contraseña" type="password" name="password" id="password" class="is-full-width is-large is-text-grey7">
<span class="help-block"><?php echo $password_err; ?></span>
<svg  id="svg-password" class="icon is-small is-absolute dark-light"><use data-v-1ff62b05="" xlink:href="/welcome/img/smile-icons.2fa0ae32.svg#view-eye"></use></svg></div><!----></div>
<input  type="submit" class="enviar button is-primary is-full-width is-large" value="INGRESAR">

</form>

</div>
<div   class="user-access-footer">
<p  class="is-small">
<a  href="reset-password.php" class="is-text-brand1">¿Olvidaste tu contraseña?</a></p>
<p  class="is-text-grey6 is-regular">
    ¿Aún no tienes una cuenta?
    <a  href="register.php" class="is-text-brand1">CREAR CUENTA</a></p>
</div></div></aside>

<!-- en esta seccion va la imagen de eslogan hacemos del mundo un mejor lugar -->
	<section  class="content is-text-white">
	<div >
	<div class="grid slide" style="background: url(mundo.jpg); center center / cover no-repeat;">
	<div data-v-64e09036="" class="help-call">
	</div>
	</div></div>
<!-- finaliza  -->

<div style="width:0px; height:0px; display:none; visibility:hidden;" id="batBeacon0.5302197357354055"><img style="width:0px; height:0px; display:none; visibility:hidden;" id="batBeacon0.02849057923977716" width="0" height="0" alt="" src="./login_files/0"></div><iframe owner="archetype" style="display: none; visibility: hidden;" src="./login_files/saved_resource.html"></iframe>
</body>
</html>

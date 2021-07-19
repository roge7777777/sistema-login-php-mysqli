<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor ingrese un usuario.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM usuarios WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Este usuario ya fue tomado.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Al parecer algo salió mal.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingresa una contraseña.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "La contraseña al menos debe tener 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Confirma tu contraseña.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "No coincide la contraseña.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Algo salió mal, por favor inténtalo de nuevo.";
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
<link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
<link rel="stylesheet" href="./login_files/normalize.css" type="text/css">
<link rel="stylesheet" href="./login_files/alegra.min.css" type="text/css">

<link href="./login_files/app.2360dbae.css" rel="preload" as="style">

<link href="./login_files/app.2360dbae.css" rel="stylesheet">
<title>REGISTRO software contable</title>






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

<img data-v-6357c280="" src="logo.jpg" alt="ALEGRA"></a>
<p data-v-6357c280="" class="is-large is-text-grey6">Crea tu cuenta</p>
<p data-v-6357c280="" class="is-text-brand1">Sigue ganando tiempo y tranquilidad</p></div>

<div class="user-access-form">





<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

	<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
		<input  placeholder="Correo/Usuario" type="text" name="username" class="is-full-width is-large is-text-grey7" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
	</div>

	<div >
		<div  class="input-wrapper is-relative" <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
			<input  placeholder="Contraseña" type="password" name="password" id="password" class="is-full-width is-large is-text-grey7" value="<?php echo $password; ?>">
				<span class="help-block"><?php echo $password_err; ?></span>
		
                
		</div>
	</div>
	<div >
		<div  class="input-wrapper is-relative" <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
			<input  placeholder="confirmar Contraseña" type="password" name="confirm_password" id="password" class="is-full-width is-large is-text-grey7" value="<?php echo $confirm_password; ?>">
			
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
                
		</div>
	</div>
	<input  type="submit" class="enviar button is-primary is-full-width is-large" value="REGISTRAR">

</form>
</div>
	<div   class="user-access-footer">

		<p  class="is-text-grey6 is-regular">
			¿Ya tienes una cuenta?
			<a  href="login.php" class="is-text-brand1">INGRESAR A MI CUENTA</a>
		</p>
	</div>
</div>
</aside>
	<!-- en esta seccion va la imagen de eslogan hacemos del mundo un mejor lugar -->
	<section  class="content is-text-white">
	<div >
	<div class="grid slide" style="background: url(mundo2.jpg); center center / cover no-repeat;">
	<div data-v-64e09036="" class="help-call">
	</div>
	</div></div>
<!-- finaliza  -->

<div style="width:0px; height:0px; display:none; visibility:hidden;" id="batBeacon0.5302197357354055"><img style="width:0px; height:0px; display:none; visibility:hidden;" id="batBeacon0.02849057923977716" width="0" height="0" alt="" src="./login_files/0"></div><iframe owner="archetype" style="display: none; visibility: hidden;" src="./login_files/saved_resource.html"></iframe>
</body>
</html>

 
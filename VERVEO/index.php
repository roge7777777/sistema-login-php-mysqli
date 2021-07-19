<?php
require("permisos.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> EMPRESA DE TRANSPORTE </title>
 <link rel="shortcut icon" href="LOGO.ico" />
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css">
<script src="js/jquery-3.2.1.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/productos.js"></script>









<script type="text/javascript">
$(document).ready(function() {
    $('#div-btn1').on('click', function() {
        $('.navbar-nav li').removeClass('active');
        $("#central").load('inventario.php');
        return false;
    });

    $('#div-btn2').on('click', function() {
        $('.navbar-nav li').removeClass('active');
        $("#central").load('registrar.php');
        return false;
    });

    $('#div-btn3').on('click', function() {
        $('.navbar-nav li').removeClass('active');
        $("#central").load('reset-password.php');
        return false;
    });

    $('#div-btn4').on('click', function() {
        $('.navbar-nav li').removeClass('active');
        $("#central").load('logout.php');
        return false;
    });
	
	 $('#div-btn5').on('click', function() {
        $('.navbar-nav li').removeClass('active');
        $("#central").load('cliente.php');
        return false;
    });
	
	$('#div-btn6').on('click', function() {
        $('.navbar-nav li').removeClass('active');
        $("#central").load('perfil.php');
        return false;
    });
});
</script>
</head>

<body>

    
    <div class="row">
        <div id="content" class="col-lg-12">
            <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #000000;" >
			<a class="navbar-brand" href="index.php"><img src="logo.jpg" style="background-size: cover;"></a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-row w-100">
                        
                        <li class="nav-item px-2 mr-auto active" >
                            <a class="nav-link text-white" id="div-btn1" href="#">INVENTARIO</a>
                        </li>
                        <li class="nav-item px-2 mr-auto active">
                            <a class="nav-link text-white" id="div-btn2" href="registrar.php">INGRESOS</a>
                        </li>
                        <li class="nav-item px-2 mr-auto active">
                            <a class="nav-link text-white" id="div-btn3" href="conductor.php">GASTOS</a>
                        </li>
                        <li class="nav-item px-2 mr-auto active">
                            <a class="nav-link text-white" id="div-btn4" href="cliente.php">BANCO</a>
                        </li>
						 <li class="nav-item px-2 mr-auto active">
                            <a class="nav-link text-white" id="div-btn5" href="cliente.php">CLIENTES</a>
                        </li>
						<li class="nav-item px-2">
						
                            <a class="nav-link" id="div-btn6" href="perfil.php"><div class="avatar" style="background-image: url(user.png)"></div></a>
							
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="central">
                <div id="central-content">
                    <div class="jumbotron">
                    <div class="container">
					<?php include 'inventario.php';?>
					
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    
    
<br>
<br>

<footer class="footer bg-dark">
    <div class="container">
        <span class="text-muted"> todos los derechos reservador por VERVEO</span>
    </div>
</footer>
</body>
</html>

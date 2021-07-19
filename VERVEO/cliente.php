<?php
require("permisos.php");
?>


<!DOCTYPE html>
<html lang="en">
 


<body>
 


    <!-- Header -->
    <header>
        <div align="center">
         <br><br><br>
						 <h1>REGISTRAR CLIENTE</h1> 
					 
	<form class="form-signin" action="registra_conductor.php" method="POST" enctype="multipart/form-data">
			   
		<div style="text-align:center;color:red;font-weight:900"> 
					<?php
                        if(isset($_GET["error"]))
                        {
                    ?>
                            <div class="alert alert-danger">
                             <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo "Debe ingresar todos los datos"; ?> !
                         </div>
                         <?php
                     }
                     ?>
                    
                     </div>     
     <input type="text" class="form-control"  maxlength="30" name="cliente" placeholder="cliente" required=""/>
    
      <button class="btn btn-lg btn-primary btn-block" type="submit">Aceptar</button>  

      <button class="btn btn-lg btn-primary btn-block" style="background-color: red" onclick="location.href = 'index.php';" type="button">Cancelar</button>    
    </form>
 
        </div>
    </header>

 

  
  
<script type="text/javascript">
      <!--
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      //-->
</script>
</body>
 
</html>

<?php include 'includes/header.php';?>
	
	<!--><div id="content"></-->
	
		
		<?php 
		if(isset($_GET['usoylavado'])){
			include 'includes/usoylavado.php';
		} else if(isset($_GET['comprar'])){
			include 'includes/comprar.php';
		} else if(isset($_GET['contacto'])){
			include 'includes/contacto.php';
		} else {
			include 'includes/inicio.php';
		}
		?>
	<!--></div></-->
<?php include 'includes/footer.php';?>	
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		</div>
		<footer class="container-fluid navbar-fixed-bottom footer fsc">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
						<em>Derechos Reservados Osmel Calderón Bernal  &copy; <?php echo date('Y'); ?></em>
					</div>
					<div class="col-md-12 text-center">
						<em>Desarrollado por <a href="mailto:osmel_calderon@yahoo.com.ar" class="link">Osmel Calderón bernal</a></em>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<!-- SCRIPTS -->
	<?php  echo link_tag('css/fontello.css');  ?>

	<?php  echo link_tag('css/normalize.css');  ?>
	<?php  echo link_tag('css/screen.css');  ?>



	<!-- ****quitar -->
	<!--
	   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" media="screen">
	-->   

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	 

	<!-- componente fecha simple -->
	<?php echo link_tag('css/bootstrap-datepicker.css'); ?>
	
	<!-- componente rango fecha -->
	<?php echo link_tag('css/daterangepicker-bs3.css'); ?>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.form.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/spin.min.js"></script>

	<!-- componente fecha simple -->
	<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>

	<!-- componente rango fecha -->
	<script type="text/javascript" src="<?php echo base_url(); ?>js/moment.js"></script>		
	<script type="text/javascript" src="<?php echo base_url(); ?>js/daterangepicker.js"></script>		
	
	<!-- nuestro js principal -->
	<script type="text/javascript" src="<?php echo base_url(); ?>js/sistema.js"></script>

	<!--para conversion a base64.encode y base64.decode -->
	<script src="<?php echo base_url(); ?>js/base64/jquery.base64.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/base64/jquery.base64.min.js" type="text/javascript"></script>
	

	<!--datatables para el caso de salidas -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/media/css/jquery.dataTables.css">
	<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/media/js/jquery.dataTables.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/extensions/TableTools/css/dataTables.tableTools.css">
	<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/extensions/TableTools/js/dataTables.tableTools.js"></script>


</body>
</html>
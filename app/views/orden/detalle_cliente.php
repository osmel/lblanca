<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php 
	$id_perfil=$this->session->userdata('id_perfil');

?>
<?php $this->load->view( 'header' ); ?>

	<div class="container">
		<div class="col-md-9"></div>	
		<div class="col-md-3">
			<a href="<?php echo base_url(); ?>clientes" class="btn btn-danger btn-block"><i class="glyphicon glyphicon-backward"></i> Regresar</a>
		</div>		
	</div>

	<div class="container">
		<br>

			<!-- Cliente -->

			<div class="panel panel-primary">
				
				<div class="panel-heading col-md-12">
					<div class="col-md-9"><h4>Datos del cliente</h4></div>
					<div class="col-md-3">
						<a href="<?php echo base_url(); ?>cliente/<?php echo base64_encode($cliente->id); ?>" class="btn btn-info btn-block">Agregar/Editar</a>
					</div>
				</div>



				<div class="panel-body">
					<div class="col-md-6">
						<ul class="list-group">
							<li class="list-group-item">							
								<span>Orden de Servicio: <?php echo  $cliente->orden;?></span>
							</li>
							<li class="list-group-item">							
								<span>Nombre: <?php echo  $cliente->nombre;?></span>
							</li>
							<li class="list-group-item">							
								<span>Fecha: <?php echo  $cliente->fecha_entrada;?></span>
							</li>
							<li class="list-group-item">							
								<span>Domicilio: <?php echo  $cliente->domicilio;?></span>
							</li>
							<li class="list-group-item">							
								<span>Referencia: <?php echo  $cliente->referencia;?></span>
							</li>

							<li class="list-group-item">							
								<span>Equipo: <?php echo  $cliente->equipo;?></span>
							</li>

							<li class="list-group-item">							
								<span>marca: <?php echo  $cliente->marca;?></span>
							</li>

						</ul>
					</div>

									

					<div class="col-md-6">
						<ul class="list-group">
							<li class="list-group-item">							
								<span>Falla: <?php echo  $cliente->falla;?></span>
							</li>
							<li class="list-group-item">							
								<span>Reporte: <?php echo  $cliente->reporte;?></span>
							</li>
							<li class="list-group-item">							
								<span>SubTotal: <?php echo  number_format($cliente->subtotal, 3, '.', ',');?></span>
							</li>
							<li class="list-group-item">							
								<span>Total: <?php echo  number_format($cliente->total, 3, '.', ',');?></span>
							</li>
							<li class="list-group-item">							
								<span>estatus: <?php echo  $cliente->estatus;?></span>
							</li>

						</ul>
					</div>
				</div>

			</div>

		<!-- -->




		<!-- Cliente -->

			<div class="panel panel-primary">
				
				<div class="panel-heading col-md-12">
					<div class="col-md-9"><h4>Datos de Orden</h4></div>
					<div class="col-md-3">
						<a href="<?php echo base_url(); ?>orden/<?php echo base64_encode($cliente->id); ?>" class="btn btn-info btn-block">Agregar/Editar</a>
					</div>
				</div>

				<div class="panel-body">

					<?php if ( $orden != FALSE ) { ?>
						<div class="col-md-6">
							<ul class="list-group">
								<li class="list-group-item">							
									<span>Técnico: <?php echo  $orden->tecnico;?></span>
								</li>
								<li class="list-group-item">							
									<span>Fecha: <?php echo  $orden->fecha_entrega;?></span>
								</li>

								<li class="list-group-item">							
									<span>Falla: <?php echo  $orden->falla;?></span>
								</li>
								<li class="list-group-item">							
									<span>Reporte: <?php echo  $orden->reporte;?></span>
								</li>

							</ul>
						</div>

										

						<div class="col-md-6">
							<ul class="list-group">

								<li class="list-group-item">							
									<span>SubTotal: <?php echo  number_format($orden->subtotal, 3, '.', ',');?></span>
								</li>
								<li class="list-group-item">							
									<span>Total: <?php echo  number_format($orden->total, 3, '.', ',');?></span>
								</li>
								<li class="list-group-item">							
									<span>estatus: <?php echo  $orden->estatus;?></span>
								</li>
							</ul>
						</div>


					<?php } ?>	

				</div>

			</div>



		<!-- -->
		


		</div>

<div class="modal fade bs-example-modal-lg" id="modalMessage35" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>	

<?php $this->load->view( 'footer' ); ?>

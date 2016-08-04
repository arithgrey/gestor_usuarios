<!--Modal para administrar las posiciones -->
<div class="modal fade" id="posiciones_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">	
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				   <span aria-hidden="true">
				    &times;
				   </span>
			  </button>
			  <h4 class="modal-title" id="myModalLabel">
			    Actualizar datos 
			  </h4>
			</div>
			 <div class="modal-body">         
				<form id='form-update-ip' class='form-update-ip' method='post' action='controller/mod.php' >					
						<div class='col-lg-3 col-md-3 col-sm-12'>
							<div class="form-group">
								<label for="ip">
									ip
								</label>
								<input type="text" class="form-control" id="ip" name='ip'>
							</div>
						</div>						
						<input type="hidden" class="form-control" id="modelo" name='modelo'>
						<div class='col-lg-3 col-md-3 col-sm-12'>
							<div class="form-group">
								<label for="modelo">
									Modelo del teléfono
								</label>
								<select name='modelo_telefono' class="form-control modelo_telefono" id="modelo_telefono"  >
									<option value='-'>
										-
									</option>

									<option value='9608'>
										9608
									</option>
									<option value='1616-l'>
										1616-l
									</option>								
								</select>								
								<!--<input type="text" class="form-control" id="modelo_telefono" name='modelo_telefono'>-->
							</div>
						</div>
						<div class='col-lg-3 col-md-3 col-sm-12'>
							<div class="form-group">
								<label for="ext">
									Extensión
								</label>
								<input type="number" class="form-control" name='ext' id="ext">
							</div>
						</div>
						<div class='col-lg-3 col-md-3 col-sm-12'>
							<div class="form-group">
								<label for="ext">
									servidor aes
								</label>
								<select  name='srv_aes'  id="srv_aes"  class="srv_aes form-control"  >
									<option value='-'>
										-
									</option>

									<option value='172.64.13.50'>
										172.64.13.50
									</option>

									<option value='172.86.8.10'>
										172.86.8.10
									</option>
									<option value='172.86.8.11'>
										172.86.8.11
									</option>
									<option value='172.86.8.12'>
										172.86.8.12
									</option>
									<option value='172.86.8.13'>
										172.86.8.13
									</option>
									<option value='172.86.8.6'>
										172.86.8.6
									</option>
									<option value='172.86.8.8'>
										172.86.8.8
									</option>
									<option value='172.86.8.9'>
										172.86.8.9
									</option>
								</select>
								<!--<input type="text" class="form-control" >-->
							</div>
						</div>						
					<input type='hidden' name='posicion' id='dinamic_pos'>
					<label class='load_pos' id='load_pos' style='display:none;'>
						Cargando datos de la posición ... 
					</label>					

					<button type="button" class="update-ip-ext btn btn-primary pull-right">
						Guardar cambios
					</button>
				</form>
			 </div>
			 <div class="modal-footer">
			   <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
			   	Cerrar
			   </button>       
			 </div>
		</div>
	</div>
</div>	 
<!--Formalario de exportación-->



























<!--Modal eliminar los datos de la posicion inicia -->
<div class="modal fade" id="posiciones_del_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">	
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				   <span aria-hidden="true">
				    &times;
				   </span>
			  </button>
			  <h4 class="modal-title" id="myModalLabel">
			    Eliminar datos de la posición
			  </h4>
			</div>
			 <div class="modal-body">         

			 	<div  class='row'>
			 		<label>
			 			Realmente quiere eliminar los datos de la posición
			 		</label>				 	
					<button type="button" class="btn btn-danger" id='eliminar-pos'>
						Eliminar 
					</button>				
				</div>
			 </div>
			 <div class="modal-footer">
			   <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
			   	Cancelar
			   </button>       
			 </div>
		</div>
	</div>
</div>	

<!--Modal eliminar los datos de la posicion termina-->
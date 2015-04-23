<div class="contenedor users">
	<section id="modificar-genero">
		<h2>Modificar Genero</h2>
		
		<div class="modgn">
			<?php

			$attributes = array('class' => 'validar form-horizontal','id' => 'validar_modificar_genero');
			echo form_open('validar_modificar_genero', $attributes);

			$nombre = array(
			'name'        => 'nombre',
			'id'          => 'ingresar-genero-nombre',
			'value'		=> $genero[0]->nombre
			);

			$attrlabel = array(
        		'class'	=>	'col-lg-6 col-md-6 col-sm-6 col-xs-12'
			);

	        ?>

	        <input type="hidden" name="idgenero" value="<?= $genero[0]->id ?>" />

	        <div class="nombre-input form-group">
	        <?php
	        echo form_label('Nombre', 'nombre', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_input($nombre);
			echo "</div>";
			echo form_error('nombre');
			?>
			</div>

			<div class="msjinsertar"></div>
	 		
	 		<?php
	 		echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
			echo form_submit('modificargenero', 'Modificar Genero','class="submit-input btn btn-success"');
			echo "</div>";
			echo form_close();
			?>
		</div>

		
				
	</section>
</div>
<div class="contenedor users">
	<section id="modificar-lugar">
		<h2>Modificar Lugar</h2>
		<div class="modlg">
			<?php

			$attributes = array('class' => 'validar form-horizontal','id' => 'validar_modificar_lugar');
			echo form_open('validar_modificar_lugar', $attributes);

			$nombre = array(
			'name'        => 'nombre',
			'id'          => 'ingresar-lugar-nombre',
			'value'		=> $lugar[0]->nombre
			);

			$direccion = array(
				'name'        => 'direccion',
				'id'          => 'ingresar-lugar-direccion',
				'value'		=> $lugar[0]->direccion
			);

			$telefono = array(
				'name'        => 'telefono',
				'id'          => 'ingresar-lugar-telefono',
				'value'		=> $lugar[0]->telefono
			);

			$email = array(
				'name'        => 'email',
				'id'          => 'ingresar-lugar-email',
				'value'		=> $lugar[0]->email
			);

			$nombre_contacto = array(
				'name'        => 'nombre_contacto',
				'id'          => 'ingresar-lugar-nombre-contacto',
				'value'		=> $lugar[0]->nombre_contacto
			);

			$attrlabel = array(
        		'class'	=>	'col-lg-6 col-md-6 col-sm-6 col-xs-12'
			);

	        ?>

	        <input type="hidden" name="idlugar" value="<?= $lugar[0]->id ?>" />

	        <div class="nombre-input form-group">
	        <?php
	        echo form_label('Nombre', 'nombre', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_input($nombre);
			echo "</div>";
			echo form_error('nombre');
			?>
			</div>

			<div class="direccion-input form-group">
	        <?php
	        echo form_label('Direccion', 'direccion', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_input($direccion);
			echo "</div>";
			echo form_error('direccion');
			?>
			</div>

			<div class="telefono-input form-group">
	        <?php
	        echo form_label('Telefono', 'telefono', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_input($telefono);
			echo "</div>";
			echo form_error('telefono');
			?>
			</div>

			<div class="email-input form-group">
	        <?php
	        echo form_label('Email', 'email', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_input($email);
			echo "</div>";
			echo form_error('email');
			?>
			</div>

			<div class="nombre-contacto-input form-group">
	        <?php
	        echo form_label('Contacto', 'nombre_contacto', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_input($nombre_contacto);
			echo "</div>";
			echo form_error('nombre_contacto');
			?>
			</div>

			<div class="msjinsertar"></div>
	 		
	 		<?php
	 		echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
			echo form_submit('modificarlugar', 'Modificar Lugar','class="submit-input btn btn-success"');
			echo "</div>";
			echo form_close();
			?>
		</div>

		
				
	</section>
</div>
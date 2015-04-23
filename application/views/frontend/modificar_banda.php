<div class="contenedor users">
	<section id="modificar-banda">
		<h2>Modificar Banda</h2>
		
		<div class="modbn">
			<?php

			$attributes = array('class' => 'validar form-horizontal', 'id' => 'validar_modificar_banda');
			echo form_open('validar_modificar_banda', $attributes);

			$nombre = array(
				'name'        => 'nombre',
				'id'          => 'modificar-banda-nombre',
				'value'		=> $banda[0]->nombre
			);

			$gen=array('' => 'Seleccione genero');
			foreach ($genero as $g) {
				$gen[$g->id] = $g->nombre;
			}

			$nombre_contacto = array(
				'name'        => 'nombre_contacto',
				'id'          => 'modificar-banda-nombre-contacto',
				'value'		=> $banda[0]->nombre_contacto
			);

			$tel_contacto = array(
				'name'        => 'tel_contacto',
				'id'          => 'modificar-banda-tel-contacto',
				'value'		=> $banda[0]->telefono_contacto
			);

			$email_contacto = array(
				'name'        => 'email_contacto',
				'id'          => 'modificar-banda-email-contacto',
				'value'		=> $banda[0]->email_contacto
			);

			$attrlabel = array(
        		'class'	=>	'col-lg-6 col-md-6 col-sm-6 col-xs-12'
			);

	        ?>

	        <input type="hidden" name="idbanda" value="<?= $banda[0]->id ?>" />

	        <div class="nombre-input form-group">
	        <?php
	        echo form_label('Nombre', 'nombre', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_input($nombre);
			echo "</div>";
			echo form_error('nombre');
			?>
			</div>
	        
	        <div class="genero-input form-group">
	        <?php
	        echo form_label('Genero', 'genero', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_dropdown('genero', $gen, $banda[0]->id_genero);
			echo "</div>";
			echo form_error('genero');
			?>
			</div>

			<div class="nombre-contacto-input form-group">
	        <?php
	        echo form_label('Nombre de contacto', 'nombre-contacto', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_input($nombre_contacto);
			echo "</div>";
			echo form_error('nombre_contacto');
			?>
			</div>

			<div class="tel-contacto-input form-group">
	        <?php
	        echo form_label('Telefono de contacto', 'telefono-contacto', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_input($tel_contacto);
			echo "</div>";
			echo form_error('tel_contacto');
			?>
			</div>

			<div class="email-contacto-input form-group">
	        <?php
	        echo form_label('Email de contacto', 'email-contacto', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_input($email_contacto);
			echo "</div>";
			echo form_error('email_contacto');
			?>
			</div>

			<div class="msjinsertar"></div>
	 		
	 		<?php
	 		echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
			echo form_submit('modificarbanda', 'Modificar Banda','class="submit-input btn btn-success"');
			echo "</div>";
			echo form_close();
			?>
		</div>

		
				
	</section>
</div>
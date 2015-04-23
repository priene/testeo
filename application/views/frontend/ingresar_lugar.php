<div class="dashboard col-lg-9 col-md-9 col-sm-10 col-xs-10 users">
	<section id="ingresar-lugar">
	<h2>Lugar</h2>
	<a href="javascript:void(0);" class="showing">Ingresar Lugar</a>
	<a href="javascript:void(0);" class="showbusc">Buscar Lugar</a>
	<div class="ing">
		<?php
		
		$attributes = array('class' => 'validar form-horizontal','id' => 'validar_ingresar_lugar');
		echo form_open('validar_ingresar_lugar', $attributes);

		$nombre = array(
			'name'        => 'nombre',
			'id'          => 'ingresar-lugar-nombre',
			'value'		=> set_value('nombre')
		);

		$direccion = array(
			'name'        => 'direccion',
			'id'          => 'ingresar-lugar-direccion',
			'value'		=> set_value('direccion')
		);

		$telefono = array(
			'name'        => 'telefono',
			'id'          => 'ingresar-lugar-telefono',
			'value'		=> set_value('telefono')
		);

		$email = array(
			'name'        => 'email',
			'id'          => 'ingresar-lugar-email',
			'value'		=> set_value('email')
		);

		$nombre_contacto = array(
			'name'        => 'nombre_contacto',
			'id'          => 'ingresar-lugar-nombre-contacto',
			'value'		=> set_value('nombre_contacto')
		);

		$attrlabel = array(
        	'class'	=>	'col-lg-6 col-md-6 col-sm-6 col-xs-12'
    	);

        ?>

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

		<div class="msjinsertar col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
 		
 		<?php
 		echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
		echo form_submit('ingresar', 'Ingresar lugar','class="submit-input"');
		echo "</div>";
		echo form_close();
		?>

	</div>

	<div class="busc">
		<?php
			$attributes = array('class' => 'validar_buscar form-horizontal','id' => 'validar_buscar_lugar');
			echo form_open('validar_buscar_lugar', $attributes);

			$crit = array(
				''	=> 'Seleccione criterio',	
				'nombre'  => 'nombre',
				'direccion'    => 'direccion',
				'telefono'   => 'telefono',
				'email'	=> 'email',
				'contacto'	=> 'contacto'
            );


			$buscar = array(
				'name'        => 'buscar',
				'id'          => 'ingresar-banda-buscar',
				'value'		=> set_value('buscar')
			);

	        ?>

	        <div class="criterio-input form-group">
		        <?php
		        echo form_label('Criterio', 'criterio', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
				echo form_dropdown('criterio', $crit, set_value('criterio'));
				echo "</div>";
				echo form_error('criterio');
				?>
			</div>

	        <div class="buscar-input form-group">
		        <?php
		        echo form_label('Buscar', 'buscar', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
				echo form_input($buscar);
				echo "</div>";
				echo form_error('buscar');
				?>
			</div>
	 		
	 		<?php
	 		echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
			echo form_submit('buscarlugar', 'Buscar Lugar','class="submit-input"');
			echo "</div>";
			echo form_close();
			?>

			<div class="resul" id="resullugar">
				<table>
					<thead>
					<tr>
						<th>Nombre</th>
						<th>Direccion</th>
						<th>Telefono</th>
						<th>Email</th>
						<th>Contacto</th>
						<th></th>
						<th></th>
					</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>

			<div id="dialog-confirm" title="Eliminar lugar">
				<p class="pregunta"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>¿Esta seguro que desea eliminar el registro?</p>
				<p class="respuesta"></p>
			</div>

	</div>

	<div class="mod">
		<?php

			$attributes = array('class' => 'validar form-horizontal','id' => 'validar_modificar_lugar');
			echo form_open('validar_modificar_lugar', $attributes);

			$nombre = array(
			'name'        => 'nombre',
			'id'          => 'modificar-lugar-nombre'
			);

			$direccion = array(
				'name'        => 'direccion',
				'id'          => 'modificar-lugar-direccion'
			);

			$telefono = array(
				'name'        => 'telefono',
				'id'          => 'modificar-lugar-telefono'
				
			);

			$email = array(
				'name'        => 'email',
				'id'          => 'modificar-lugar-email'
				
			);

			$nombre_contacto = array(
				'name'        => 'nombre_contacto',
				'id'          => 'modificar-lugar-nombre-contacto'	
			);

			$attrlabel = array(
        		'class'	=>	'col-lg-6 col-md-6 col-sm-6 col-xs-12'
			);

	        ?>

	        <input type="hidden" name="idlugar" id="idlugar" />

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

			<div class="msjinsertar col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
	 		
	 		<?php
	 		echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
			echo form_submit('modificarlugar', 'Modificar Lugar','class="submit-input"');
			echo "</div>";
			echo form_close();
			?>
	</div>
			
	</section>
</div>
<div class="dashboard col-lg-9 col-md-9 col-sm-10 col-xs-10">
	<section id="ingresar-genero">
	<h2>Genero</h2>
	<a href="javascript:void(0);" class="showing">Ingresar Genero</a>
	<a href="javascript:void(0);" class="showbusc">Lista de Generos</a>
	<div class="ing">
		<?php
		$attributes = array('class' => 'validar form-horizontal','id' => 'validar_ingresar_genero');
		echo form_open('validar_ingresar_genero', $attributes);

		$nombre = array(
			'name'        => 'nombre',
			'id'          => 'ingresar-genero-nombre',
			'value'		=> set_value('nombre')
		);

		$attrlabel = array(
    		'class'	=>	'col-lg-6 col-md-6 col-sm-6 col-xs-12'
		);

        ?>

        <div class="nombre-input">
        <?php
        echo form_label('Nombre', 'nombre', $attrlabel);
        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
		echo form_input($nombre);
		echo "</div>";
		echo form_error('nombre');
		?>
		</div>

		<div class="msjinsertar col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
 		
 		<?php
 		echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
		echo form_submit('ingresar', 'Ingresar Genero','class="submit-input"');
		echo "</div>";
		echo form_close();
		?>
	</div>

	<div class="busc">
		<div class="listgeneros">
		<table>
			<thead>
				<th>Genero</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</thead>
			<tbody></tbody>
		</table>
		</div>
		<div id="dialog-confirm" title="Eliminar genero">
			<p class="pregunta"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>¿Esta seguro que desea eliminar el registro?</p>
			<p class="respuesta"></p>
		</div>

	</div>

	<div class="mod">
		<?php

			$attributes = array('class' => 'validar form-horizontal','id' => 'validar_modificar_genero');
			echo form_open('validar_modificar_genero', $attributes);

			$nombre = array(
			'name'        => 'nombre',
			'id'          => 'modificar-genero-nombre'
			);

			$attrlabel = array(
        		'class'	=>	'col-lg-6 col-md-6 col-sm-6 col-xs-12'
			);

	        ?>

	        <input type="hidden" name="idgenero" id="idgenero" />

	        <div class="nombre-input form-group">
	        <?php
	        echo form_label('Nombre', 'nombre', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_input($nombre);
			echo "</div>";
			echo form_error('nombre');
			?>
			</div>

			<div class="msjinsertar col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
	 		
	 		<?php
	 		echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
			echo form_submit('modificargenero', 'Modificar Genero','class="submit-input"');
			echo "</div>";
			echo form_close();
			?>
	</div>

	</section>
</div>
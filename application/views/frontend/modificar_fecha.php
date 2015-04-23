<div class="contenedor users">
	<section id="modificar-fecha">
	<h2>Modificar Fecha</h2>
	
	<div class="modfc">
	
		<?php
		
		$attributes = array('class' => 'validar_modificar_fecha form-horizontal');
		echo form_open_multipart('validar_modificar_fecha', $attributes);

		$nombre = array(
			'name'        => 'nombre',
			'id'          => 'modificar-fecha-nombre',
			'value'		=> $fech[0]->nombre
		);

		$fecha = array(
              'name'        => 'fecha',
              'id'          => 'modificar-fecha-fecha',
              'value'		=>  date('d-m-Y', strtotime($fech[0]->dia))
        );

        $hora = array(
              'name'        => 'hora',
              'id'          => 'modificar-fecha-hora',
              'value'		=> $fech[0]->hora
              /*'data-default' => $fecha[0]->hora,
              'data-placement' => 'bottom',
              'data-align'	=>	'center'*/
        );

		$banda = array(
              'name'        => 'banda',
              'id'          => 'modificar-fecha-banda',
              'value'		=> set_value('banda')
        );

        $pos = array(
			''		=> 'Seleccione posicion',	
			'1'   	=> 'Slide 1',
			'2'  	=> 'Slide 2',
			'3'		=> 'Slide 3'
        );
		

		$lug=array('' => 'Seleccione lugar');
		foreach ($lugar as $l) {
			$lug[$l->id] = $l->nombre;
		}

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

        <div class="banda-input form-group">
        <?php
        echo form_label('Buscar Banda', 'banda', $attrlabel);
        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
		echo form_input($banda);
		echo '<a href="javascript:void(0);" class="addbanda">Agregar</a>';
		echo "</div>";
		echo form_error('banda');
		?>
		
		

		<table class="listabandas">
			<thead>
				<tr>
					<th>Bandas</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($bandas as $b) {
						echo "<tr class='bn".$b->bid."'><td>".$b->nombre."</td><td><a href='javascript:void(0);'>Eliminar</a></td></tr>";
					}
				?>
			</tbody>
		</table>

		<input type="hidden" name="idsbandas" class="idsbandas" value="">

		</div>
        
        <div class="lugar-input form-group">
        <?php
        echo form_label('Lugar', 'lugar', $attrlabel);
        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
		echo form_dropdown('lugar', $lug, $fech[0]->id_lugar);
		echo "</div>";
		echo form_error('lugar');
		?>
		</div>

		<div class="fecha-input form-group">
        <?php
        echo form_error('check_database');
        echo form_label('Fecha', 'fecha', $attrlabel);
        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
		echo form_input($fecha);
		echo "</div>";
		echo form_error('fecha');
		?>
		</div>

		<div class="hora-input clockpicker form-group">
        <?php
        echo form_label('Hora', 'hora', $attrlabel);
        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
		echo form_input($hora);
		echo "</div>";
		echo form_error('hora');
		?>
		</div>

		<?php 
		echo form_label('Imagen fecha', 'userfile', $attrlabel);
		echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
		$calimg = $fech[0]->imagen; 
		?>
		<div class="imgfile-input">
			<img src="<?= base_url("assets/img/calimgs/$calimg") ?>">
			<input type="file" name="userfile" id="userfile" size="20" />
		</div>
		</div>

		<?php echo form_label('Imagen slider', 'imgslider', $attrlabel); ?>
		<div class="imgslider-input">
			<input type="file" name="imgslider" id="imgslider" size="20" />
		</div>

		<div class="posicion-slide-input form-group">
	        <?php
	        echo form_label('Posicion slide', 'posicion', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_dropdown('posicion', $pos, set_value('posicion'));
			echo "</div>";
			echo form_error('posicion');
			?>
		</div>
 		
		<div class="msjinsertarfecha"></div>

 		<?php
 		echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
		echo form_submit('modificarfecha', 'Modificar Fecha','class="submit-input btn btn-success"');
		echo "</div>";
		echo form_close();
		?>
	</div>
	
	

	</section>
</div>
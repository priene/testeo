<div class="dashboard col-lg-9 col-md-9 col-sm-10 col-xs-10 users">
	<section id="ingresar-fecha">
	<h2>Fechas</h2>
	<a href="javascript:void(0);" class="showing">Ingresar Fecha</a>
	<a href="javascript:void(0);" class="showbusc">Buscar Fecha</a>
	<div class="ing">
	
		<?php
		$attributes = array('id' => 'validar_ingresar_fecha', 'class' => 'form-horizontal');
		echo form_open_multipart('validar_ingresar_fecha', $attributes);

		$nombre = array(
			'name'        => 'nombre',
			'id'          => 'ingresar-fecha-nombre',
			'value'		=> set_value('nombre')
		);

		$fecha = array(
              'name'        => 'fecha',
              'id'          => 'ingresar-fecha-fecha',
              'value'		=> set_value('fecha')
        );

        $hora = array(
              'name'        => 'hora',
              'id'          => 'ingresar-fecha-hora',
              'value'		=> set_value('hora'),
              'data-default' => '24:00',
              'data-placement' => 'bottom',
              'data-align'	=>	'center'
        );

		$banda = array(
              'name'        => 'banda',
              'id'          => 'ingresar-fecha-banda',
              'value'		=> set_value('banda')
        );

        $pos = array(
			''		=> 'Seleccione posicion',	
			'1'   	=> 'Slide 1',
			'2'  	=> 'Slide 2',
			'3'		=> 'Slide 3'
        );

        $attrlabel = array(
        	'class'	=>	'col-lg-6 col-md-6 col-sm-6 col-xs-12'
    	);


		$lug=array('' => 'Seleccione lugar');
		foreach ($lugar as $l) {
			$lug[$l->id] = $l->nombre;
		}

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
		
		echo form_error('banda');
		?>
		
		<div class="tablabandas" id="tablabandasing">
		<table class="listabandas">
			<thead>
				<tr>
					<th>Bandas</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
		</div>

		</div>


		<input type="hidden" name="idsbandas" class="idsbandas" value="">

		</div>
        
        <div class="lugar-input form-group">
        <?php
        echo form_label('Lugar', 'lugar', $attrlabel);
        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
		echo form_dropdown('lugar', $lug, set_value('lugar'));
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

		<div class="input-group hora-input clockpicker form-group">
        <?php
        echo form_label('Hora', 'hora', $attrlabel);
        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
		echo form_input($hora);
		echo "</div>";
		echo form_error('hora');
		?>
		
		</div>

		<?php echo form_label('Imagen fecha', 'userfileing', $attrlabel); ?>
		<div class="imgfile-input form-group inputs col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<input type="file" name="userfile" id="userfile" size="20" />
		</div>

		<?php 
		
		$datacheckslide = array(
		    'name'        => 'tieneslider',
		    'class'          => 'tieneslider',
		    'value'       => '1',
		    'checked'     => FALSE
	    );
	    echo '<div class="sliderop col-lg-6 col-md-6 col-sm-6 col-xs-12">';
	    echo form_checkbox($datacheckslide);
		echo form_label('Imagen slider', 'imgslidering'); 
		echo '</div>';
		?>
		<div class="imgslider-input form-group inputs col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<input type="file" name="imgslider" id="imgslider" size="20" />
		</div>

		<div class="posicion-slide-input">
	        <?php
	        echo form_label('Posicion slide', 'posicion', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_dropdown('posicion', $pos, set_value('posicion'));
			echo "</div>";
			echo form_error('posicion');
			?>
		</div>
 		
		<div class="msjinsertarfecha col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>

 		<?php
 		echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
		echo form_submit('ingresar', 'Ingresar Fecha','class="submit-input"');
		echo "</div>";

		echo form_close();
		?>
	</div>
	
	<div class="busc">
		<?php
			$attributes = array('class' => 'validar_buscar form-horizontal','id' => 'validar_buscar_fecha');
			echo form_open('validar_buscar_fecha', $attributes);

			$crit = array(
				''	=> 'Seleccione criterio',	
				'fecha'   => 'fecha',
				'nombre'  => 'nombre',
				'lugar'		=> 'lugar'
            );


			$buscar = array(
				'name'        => 'buscar',
				'id'          => 'ingresar-banda-fecha',
				'value'		=> set_value('buscar')
			);

	        ?>

	        <div class="criterio-input form-group">
	        <?php
	        echo form_label('Criterio', 'criterio', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_dropdown('criterio', $crit, set_value('criterio'));
			echo '</div>';
			echo form_error('criterio');
			?>
			</div>

	        <div class="buscar-input form-group">
	        <?php
	        echo form_label('Buscar', 'buscar', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_input($buscar);
			echo '</div>';
			echo form_error('buscar');
			?>
			</div>
	 		
	 		<?php
	 		echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
			echo form_submit('buscarfecha', 'Buscar Fecha','class="submit-input"');
			echo '</div>';
			echo form_close();
			?>

			<div class="resul" id="resulfecha">
				<table>
					<thead>
					<tr>
						<th>Nombre</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Lugar</th>
						<th>Bandas</th>
						<th>Modificar</th>
						<th>Eliminar</th>
					</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>

			<div id="dialog" title="Bandas"><ul></ul></div>

			<div id="dialog-confirm" title="Eliminar lugar">
				<p class="pregunta"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>¿Esta seguro que desea eliminar el registro?</p>
				<p class="respuesta"></p>
			</div>

	</div>

	<div class="mod">
		<?php
		
		$attributes = array('class' => 'validar_modificar_fecha form-horizontal');
		echo form_open_multipart('validar_modificar_fecha', $attributes);

		$nombre = array(
			'name'        => 'nombre',
			'id'          => 'modificar-fecha-nombre'
		);

		$fecha = array(
              'name'        => 'fecha',
              'id'          => 'modificar-fecha-fecha'
        );

        $hora = array(
              'name'        => 'hora',
              'id'          => 'modificar-fecha-hora'
              /*'data-default' => $fecha[0]->hora,
              'data-placement' => 'bottom',
              'data-align'	=>	'center'*/
        );

		$banda = array(
              'name'        => 'banda',
              'id'          => 'modificar-fecha-banda'
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

        <input type="hidden" id="idfecha" name="idfecha">

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
		echo form_error('banda');
		?>
		
		
		<div class="tablabandas" id="tablabandasmod">
			<table class="listabandas">
				<thead>
					<tr>
						<th>Bandas</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		</div>

		<input type="hidden" name="idsbandas" class="idsbandas" value="">

		</div>
        
        <div class="lugar-input form-group">
        <?php
        echo form_label('Lugar', 'lugar', $attrlabel);
        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
		echo form_dropdown('lugar', $lug, "", "id='modificar_fecha_lugar'");
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
		echo form_label('Imagen fecha', 'userfilemod', $attrlabel);
		echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs form-group'>";
		
		?>
		<div class="imgfile-input">
			<img src="" id="userfileimg">
			<a class="eliminarimagen" id="eliminarimagenevento" href="javascript:void(0);">Eliminar Imagen</a>
			<input type='hidden' name='estacargado' id='estacargado' value='0'>
			<input type='hidden' name='cargado' id='cargado'>
			<input type="file" name="userfile" id="userfile" size="20" />
		</div>

		</div>

		<?php 

		$datacheckslide = array(
		    'name'        => 'tieneslider',
		    'class'          => 'tieneslider',
		    'value'       => '1',
		    'checked'     => FALSE
	    );
	    echo '<div class="sliderop col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group">';
		echo form_checkbox($datacheckslide);
		echo form_label('Imagen slider', 'imgslidermod');
		echo "</div>";
		?>
		
		<div class="modifslider">
		
		<?php
		echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs form-group'>"; 
		?>
		
		<div class="imgslider-input">
			<img src="" id="userfileimgslider">
			<a class="eliminarimagen" id="eliminarimagenslider" href="javascript:void(0);">Eliminar Imagen</a>
			<input type='hidden' name='estacargadoslider' id='estacargadoslider' value='0'>
			<input type='hidden' name='cargadoslider' id='cargadoslider'>
			<input type="file" name="imgslider" id="imgslider" size="20" />
		</div>

		</div>

		

		<div class="posicion-slide-input form-group">
	        <?php
	        echo form_label('Posicion slide', 'posicion', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>"; 
			echo form_dropdown('posicion', $pos, "", "id='modificar_fecha_posicion'")   ;
			echo "</div>";
			echo form_error('posicion');
			?>
		</div>

		</div>
 		
		<div class="msjinsertarfecha col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>

 		<?php
 		echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
		echo form_submit('modificarfecha', 'Modificar Fecha','class="submit-input"');
		echo "</div>";
		echo form_close();
		?>
	</div>

	</section>
</div>


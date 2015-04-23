<div class="dashboard col-lg-9 col-md-9 col-sm-10 col-xs-10 users">
	<section id="ingresar-banda">
		<h2>Bandas</h2>
		<a href="javascript:void(0);" class="showing">Ingresar Banda</a>
		<a href="javascript:void(0);" class="showbusc">Buscar Banda</a>
		<div class="ing">
			<?php
			$attributes = array('class' => 'validar form-horizontal','id' => 'validar_ingresar_banda');
			echo form_open('validar_ingresar_banda', $attributes);

			$nombre = array(
				'name'        => 'nombre',
				'id'          => 'ingresar-banda-nombre',
				'value'		=> set_value('nombre')
			);

			$gen=array('' => 'Seleccione genero');
			foreach ($genero as $g) {
				$gen[$g->id] = $g->nombre;
			}

			$ps=array();
			foreach ($paises as $p) {
				$ps[$p->id] = $p->nombre;
			}

			$prov=array('' => 'Seleccione provincia');
			foreach ($provincia as $pr) {
				$prov[$pr->id] = $pr->nombre;
			}

			$nombre_contacto = array(
				'name'        => 'nombre_contacto',
				'id'          => 'ingresar-banda-nombre-contacto',
				'value'		=> set_value('nombre_contacto')
			);

			$tel_contacto = array(
				'name'        => 'tel_contacto',
				'id'          => 'ingresar-banda-tel-contacto',
				'value'		=> set_value('tel_contacto')
			);

			$contacto = array(
				'name'        => 'contacto',
				'id'          => 'ingresar-banda-contacto',
				'value'		=> set_value('contacto')
			);


			$nombre_contacto2 = array(
				'name'        => 'nombre_contacto2',
				'id'          => 'ingresar-banda-nombre-contacto2',
				'class'		=> 'con2',
				'value'		=> set_value('nombre_contacto2')
			);

			$tel_contacto2 = array(
				'name'        => 'tel_contacto2',
				'id'          => 'ingresar-banda-tel-contacto2',
				'class'		=> 'con2',
				'value'		=> set_value('tel_contacto2')
			);

			$contacto2 = array(
				'name'        => 'contacto2',
				'id'          => 'ingresar-banda-contacto2',
				'class'		=> 'con2',
				'value'		=> set_value('contacto2')
			);


			$sitioweb = array(
				'name'        => 'sitioweb',
				'id'          => 'ingresar-banda-sitioweb',
				'class'		  => 'urlmedia',
				'disabled'	  => 'disabled',
				'value'		=> set_value('sitioweb')
			);

			$soundcloud = array(
				'name'        => 'soundcloud',
				'id'          => 'ingresar-banda-soundcloud',
				'class'		  => 'urlmedia',
				'disabled'	  => 'disabled',	
				'value'		=> set_value('soundcloud')
			);

			$bandcamp = array(
				'name'        => 'bandcamp',
				'id'          => 'ingresar-banda-bandcamp',
				'class'		  => 'urlmedia',
				'disabled'	  => 'disabled',
				'value'		=> set_value('bandcamp')
			);

			$youtube = array(
				'name'        => 'youtube',
				'id'          => 'ingresar-banda-youtube',
				'class'		  => 'urlmedia',
				'disabled'	  => 'disabled',
				'value'		=> set_value('youtube')
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
	        
	        <div class="genero-input form-group">
	        <?php
	        echo form_label('Genero', 'genero', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_dropdown('genero', $gen, set_value('genero'));
			echo "</div>";
			echo form_error('genero');
			?>
			</div>

	        <div class="pais-input form-group">
	        <?php
	        echo form_label('Pais', 'pais', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_dropdown('pais', $ps, '12');
			echo "</div>";
			echo form_error('pais');
			?>
			</div>

	        <div class="provincia-input form-group">
	        <?php
	        echo form_label('Provincia', 'provincia', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_dropdown('provincia', $prov, set_value('provincia'));
			echo "</div>";
			echo form_error('provincia');
			?>
			</div>

	        <div class="localidad-input form-group">
	        <?php
	        echo form_label('Localidad', 'localidad', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs lcl'>";
			echo "</div>";
			echo form_error('localidad');
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

			<div class="contacto-input form-group">
	        <?php
	        echo form_label('Email o Facebook de Contacto', 'contacto', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_input($contacto);
			echo "</div>";
			echo form_error('contacto');
			?>
			</div>

			<div>
				<label>¿Desea ingresar otro contacto de la banda?</label>
				<input type="radio" name="otrocontacto" class="otrocontacto" value="no" checked="checked"><label for="otrocontacto">NO</label>
				<input type="radio" name="otrocontacto" class="otrocontacto" value="si"><label for="otrocontacto">SI</label>
			</div>

			<div class="contac2">
				<div class="nombre-contacto-input form-group">
		        <?php
		        echo form_label('Nombre de contacto 2', 'nombre-contacto2', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
				echo form_input($nombre_contacto2);
				echo "</div>";
				echo form_error('nombre_contacto2');
				?>
				</div>

				<div class="tel-contacto-input form-group">
		        <?php
		        echo form_label('Telefono de contacto 2', 'telefono-contacto2', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
				echo form_input($tel_contacto2);
				echo "</div>";
				echo form_error('tel_contacto2');
				?>
				</div>

				<div class="contacto-input form-group">
		        <?php
		        echo form_label('Email o Facebook de Contacto 2', 'contacto2', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
				echo form_input($contacto2);
				echo "</div>";
				echo form_error('contacto2');
				?>
				</div>
			</div>

			

			<div class="sitioweb media">
				<?php
		        echo form_label('Sitio Web', 'sitioweb', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
		        
				echo '<input type="radio" name="swradio" class="radiomedia" value="no" checked="checked"><label for="swradio">NO</label>';
				echo '<input type="radio" name="swradio" class="radiomedia" value="si"><label for="swradio">SI</label>';
				echo form_input($sitioweb);
				echo "</div>";
				echo form_error('sitioweb');
				?>
			</div>

			<div class="soundcloud media">
				<?php
		        echo form_label('Soundcloud', 'soundcloud', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
		        
				echo '<input type="radio" name="scradio" class="radiomedia" value="no" checked="checked"><label for="scradio">NO</label>';
				echo '<input type="radio" name="scradio" class="radiomedia" value="si"><label for="scradio">SI</label>';
				echo form_input($soundcloud);
				echo "</div>";
				echo form_error('soundcloud');
				?>
			</div>

			<div class="bandcamp media">
				<?php
		        echo form_label('Bandcamp', 'bandcamp', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
		        
				echo '<input type="radio" name="bcradio" class="radiomedia" value="no" checked="checked"><label for="bcradio">NO</label>';
				echo '<input type="radio" name="bcradio" class="radiomedia" value="si"><label for="bcradio">SI</label>';
				echo form_input($bandcamp);
				echo "</div>";
				echo form_error('bandcamp');
				?>
			</div>

			<div class="youtube media">
				<?php
		        echo form_label('Youtube', 'youtube', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
		        
				echo '<input type="radio" name="ytradio" class="radiomedia" value="no" checked="checked"><label for="ytradio">NO</label>';
				echo '<input type="radio" name="ytradio" class="radiomedia" value="si"><label for="ytradio">SI</label>';
				echo form_input($youtube);
				echo "</div>";
				echo form_error('youtube');
				?>
			</div>

			<div class="convocatoria media">
				<?php
		        echo form_label('Convocatoria', 'convocatoria', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";

		        foreach ($convocatoria as $c) {
		        	echo '<input type="radio" name="convocatoria" value="'.$c->id.'"><label for="convocatoria">'.$c->tipo.'</label>';
		        }

				echo "</div>";
				echo form_error('convocatoria');
				?>
			</div>

			<div class="turno media">
				<?php
		        echo form_label('Turno', 'turno', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";

		        foreach ($turnos as $t) {
		        	echo '<input type="radio" name="turno" value="'.$t->id.'"><label for="turno">'.$t->nombre.'</label>';
		        }

				echo "</div>";
				echo form_error('turno');
				?>
			</div>

			<div class="estado media">
				<?php
		        echo form_label('Estado', 'estado', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";

		        foreach ($estados as $e) {
		        	echo '<input type="radio" name="estado" value="'.$e->id.'"><label for="estado">'.$e->nombre.'</label>';
		        }

				echo "</div>";
				echo form_error('estado');
				?>
			</div>

			<input type="hidden" name="confirmada" value="1">

			<input type="hidden" name="esadmin" value="1">

			<div class="msjinsertar col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
	 		
	 		<?php
	 		echo "<div class='col-lg-12'>";
			echo form_submit('ingresarbanda', 'Ingresar Banda','class="submit-input"');
			echo "</div>";
			echo form_close();
			?>
		</div>

		<div class="busc">

			<?php
			$attributes = array('class' => 'validar_buscar form-horizontal','id' => 'validar_buscar_banda');
			echo form_open('validar_buscar_banda', $attributes);

			$crit = array(
				''	=> 'Seleccione criterio',	
				'nombre'  => 'nombre',
				'genero'    => 'genero',
				'turno'		=> 'turno',
				'convocatoria' => 'convocatoria',
				'estado' => 'estado',
				'confirmada' => 'confirmada'
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
	        echo "<div class='col-lg-6 inputs'>";
			echo form_dropdown('criterio', $crit, set_value('criterio'));
			echo "</div>";
			echo form_error('criterio');
			?>
			</div>

	        <div class="buscar-input form-group">
	        <?php
	        echo form_label('Buscar', 'buscar', $attrlabel);
	        echo "<div class='col-lg-6 inputs bbc'>";
			echo form_input($buscar);
			echo "</div>";
			echo form_error('buscar');
			?>
			</div>
	 		
	 		<?php
	 		echo "<div class='col-lg-12'>";
			echo form_submit('buscarbanda', 'Buscar Banda','class="submit-input"');
			echo "</div>";
			echo form_close();
			?>

			<div class="resul" id="resulbanda">
				<table>
					<thead>
					<tr>
						<th>Nombre</th>
						<th>Genero</th>
						<th>Informacion</th>
						<th>Editar</th>
						<th>Borrar</th>
					</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>

			<div id="dialog-confirm" title="Informacion banda">
				<p class="pregunta"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>¿Esta seguro que desea eliminar el registro?</p>
				<p class="respuesta"></p>
			</div>

			<div id="dialog-confirm2">
				<div class="respuesta">
					<div class="dialognombre"><label>Nombre: </label><p></p></div>
					<div class="dialoggenero"><label>Genero: </label><p></p></div>
					<div class="dialogpais"><label>Pais: </label><p></p></div>
					<div class="dialogprovincia"><label>Provincia: </label><p></p></div>
					<div class="dialoglocalidad"><label>Localidad: </label><p></p></div>
					<table class="table dialogcontacto">
						<thead>
						<tr>
							<th>Nombre</th>
							<th>Telefono</th>
							<th>Contacto</th>
						</tr>
						</thead>
						<tbody></tbody>
					</table>
					<table class="dialogmedia">

					</table>
					<div class="dialogturno"><label>Turno: </label><p></p></div>
					<div class="dialogconvocatoria"><label>Convocatoria: </label><p></p></div>
					<div class="dialogestado"><label>Estado: </label><p></p></div>
					<div class="dialogconfirmada"><label>Confirmada: </label><p></p></div>
				</div>
			</div>
			
		</div>

		<div class="mod">
			<?php

			$attributes = array('class' => 'validar form-horizontal', 'id' => 'validar_modificar_banda');
			echo form_open('validar_modificar_banda', $attributes);

			$nombre = array(
				'name'        => 'nombre',
				'id'          => 'modificar-banda-nombre'
			);

			$gen=array('' => 'Seleccione genero');
			foreach ($genero as $g) {
				$gen[$g->id] = $g->nombre;
			}

			$nombre_contacto = array(
				'name'        => 'nombre_contacto',
				'id'          => 'modificar-banda-nombre-contacto'
			);

			$tel_contacto = array(
				'name'        => 'tel_contacto',
				'id'          => 'modificar-banda-tel-contacto'
				
			);

			$contacto = array(
				'name'        => 'contacto',
				'id'          => 'modificar-banda-contacto'
				
			);

			$nombre_contacto2 = array(
				'name'        => 'nombre_contacto2',
				'id'          => 'modificar-banda-nombre-contacto2',
				'class'		=> 'con2'
			);

			$tel_contacto2 = array(
				'name'        => 'tel_contacto2',
				'id'          => 'modificar-banda-tel-contacto2',
				'class'		=> 'con2'
			);

			$contacto2 = array(
				'name'        => 'contacto2',
				'id'          => 'modificar-banda-contacto2',
				'class'		=> 'con2'
			);


			$sitioweb = array(
				'name'        => 'sitioweb',
				'id'          => 'modificar-banda-sitioweb',
				'class'		  => 'urlmedia',
				'disabled'	  => 'disabled'
			);

			$soundcloud = array(
				'name'        => 'soundcloud',
				'id'          => 'modificar-banda-soundcloud',
				'class'		  => 'urlmedia',
				'disabled'	  => 'disabled'
			);

			$bandcamp = array(
				'name'        => 'bandcamp',
				'id'          => 'modificar-banda-bandcamp',
				'class'		  => 'urlmedia',
				'disabled'	  => 'disabled'
			);

			$youtube = array(
				'name'        => 'youtube',
				'id'          => 'modificar-banda-youtube',
				'class'		  => 'urlmedia',
				'disabled'	  => 'disabled'
			);

			$attrlabel = array(
        		'class'	=>	'col-lg-6 col-md-6 col-sm-6 col-xs-12'
			);

	        ?>

	        <input type="hidden" name="idbanda" id="idbanda" />

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
			echo form_dropdown('genero', $gen, "","id='modificar-banda-genero' class='form-control'");
			echo "</div>";
			echo form_error('genero');
			?>
			</div>

	        <div class="pais-input form-group">
	        <?php
	        echo form_label('Pais', 'pais', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_dropdown('pais', $ps, "","id='modificar-banda-pais'");
			echo "</div>";
			echo form_error('pais');
			?>
			</div>

	        <div class="provincia-input form-group">
	        <?php
	        echo form_label('Provincia', 'provincia', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_dropdown('provincia', $prov, "","id='modificar-banda-provincia'");
			echo "</div>";
			echo form_error('provincia');
			?>
			</div>

	        <div class="localidad-input form-group">
	        <?php
	        echo form_label('Localidad', 'localidad', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs lcl'>";
			echo "</div>";
			echo form_error('localidad');
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

			<div class="contacto-input form-group">
	        <?php
	        echo form_label('Email o Facebook de Contacto', 'contacto', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_input($contacto);
			echo "</div>";
			echo form_error('contacto');
			?>
			</div>

			<div>
				<label>¿Desea ingresar otro contacto de la banda?</label>
				<input type="radio" name="otrocontacto" class="otrocontacto" value="no" checked="checked"><label for="otrocontacto">NO</label>
				<input type="radio" name="otrocontacto" class="otrocontacto" value="si"><label for="otrocontacto">SI</label>
			</div>

			<div class="contac2">
				<div class="nombre-contacto-input form-group">
		        <?php
		        echo form_label('Nombre de contacto 2', 'nombre-contacto2', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
				echo form_input($nombre_contacto2);
				echo "</div>";
				echo form_error('nombre_contacto2');
				?>
				</div>

				<div class="tel-contacto-input form-group">
		        <?php
		        echo form_label('Telefono de contacto 2', 'telefono-contacto2', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
				echo form_input($tel_contacto2);
				echo "</div>";
				echo form_error('tel_contacto2');
				?>
				</div>

				<div class="contacto-input form-group">
		        <?php
		        echo form_label('Email o Facebook de Contacto 2', 'contacto2', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
				echo form_input($contacto2);
				echo "</div>";
				echo form_error('contacto2');
				?>
				</div>
			</div>

			

			<div class="sitioweb media">
				<?php
		        echo form_label('Sitio Web', 'sitioweb', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
		        
				echo '<input type="radio" name="swradio" class="radiomedia" value="no" checked="checked"><label for="swradio">NO</label>';
				echo '<input type="radio" name="swradio" class="radiomedia" value="si"><label for="swradio">SI</label>';
				echo form_input($sitioweb);
				echo "</div>";
				echo form_error('sitioweb');
				?>
			</div>

			<div class="soundcloud media">
				<?php
		        echo form_label('Soundcloud', 'soundcloud', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
		        
				echo '<input type="radio" name="scradio" class="radiomedia" value="no" checked="checked"><label for="scradio">NO</label>';
				echo '<input type="radio" name="scradio" class="radiomedia" value="si"><label for="scradio">SI</label>';
				echo form_input($soundcloud);
				echo "</div>";
				echo form_error('soundcloud');
				?>
			</div>

			<div class="bandcamp media">
				<?php
		        echo form_label('Bandcamp', 'bandcamp', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
		        
				echo '<input type="radio" name="bcradio" class="radiomedia" value="no" checked="checked"><label for="bcradio">NO</label>';
				echo '<input type="radio" name="bcradio" class="radiomedia" value="si"><label for="bcradio">SI</label>';
				echo form_input($bandcamp);
				echo "</div>";
				echo form_error('bandcamp');
				?>
			</div>

			<div class="youtube media">
				<?php
		        echo form_label('Youtube', 'youtube', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
		        
				echo '<input type="radio" name="ytradio" class="radiomedia" value="no" checked="checked"><label for="ytradio">NO</label>';
				echo '<input type="radio" name="ytradio" class="radiomedia" value="si"><label for="ytradio">SI</label>';
				echo form_input($youtube);
				echo "</div>";
				echo form_error('youtube');
				?>
			</div>

			<div class="convocatoria media">
				<?php
		        echo form_label('Convocatoria', 'convocatoria', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";

		        foreach ($convocatoria as $c) {
		        	echo '<input type="radio" class="modificar-banda-convocatoria" name="convocatoria" value="'.$c->id.'"><label for="convocatoria">'.$c->tipo.'</label>';
		        }

				echo "</div>";
				echo form_error('convocatoria');
				?>
			</div>

			<div class="turno media">
				<?php
		        echo form_label('Turno', 'turno', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";

		        foreach ($turnos as $t) {
		        	echo '<input type="radio" class="modificar-banda-turno" name="turno" value="'.$t->id.'"><label for="turno">'.$t->nombre.'</label>';
		        }

				echo "</div>";
				echo form_error('turno');
				?>
			</div>

			<div class="estado media">
				<?php
		        echo form_label('Estado', 'estado', $attrlabel);
		        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";

		        foreach ($estados as $e) {
		        	echo '<input type="radio" class="modificar-banda-estado" name="estado" value="'.$e->id.'"><label for="estado">'.$e->nombre.'</label>';
		        }

				echo "</div>";
				echo form_error('estado');
				?>
			</div>

			<input type="hidden" name="confirmada" value="1">

			<div class="msjinsertar col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
	 		
	 		<?php
	 		echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
			echo form_submit('modificarbanda', 'Modificar Banda','class="submit-input"');
			echo "</div>";
			echo form_close();
			?>
		</div>
				
	</section>
</div>
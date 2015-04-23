<div class="contenedor users">
	<section id="ingresar">
		<h2>Ingresar</h2>
			<?php
			
			$attributes = array('class' => 'form-horizontal');
			echo form_open('login', $attributes);
			$email = array(
				'name'        => 'email',
				'id'          => 'ingresar-email',
				'value'		=> set_value('email')
            );
			$password = array(
				'name'        => 'password',
				'id'          => 'ingresar-password'
            );
			$attrlabel = array(
        		'class'	=>	'col-lg-6 col-md-6 col-sm-6 col-xs-12'
    		);           
	        ?>
	        <div class="email-input form-group">
	        <?php
	        echo form_error('check_database');
	        echo form_label('Correo electrónico', 'email', $attrlabel);
	        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_input($email);
			echo "</div>";
			echo form_error('email');
			?>
			</div>
			<div class="password-input form-group">
			<?php
			echo form_label('Password', 'password', $attrlabel);
			echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 inputs'>";
			echo form_password($password);
			echo "</div>";
			echo form_error('password');

			?>
	 		</div>
	 		<hr>
	 		<?php
			echo form_submit('ingresar', 'Inicar sesión','class="submit-input"');
			echo form_close();
			echo anchor('/recuperar_password', '¿No puede acceder a su cuenta?', array('class' => 'recuperar-contrasena', 'title' => 'Recuperar contraseña'));
			?>
			
	</section>
</div>
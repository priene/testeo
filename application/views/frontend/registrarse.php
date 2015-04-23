<div class="contenedor">
<section id="registrarse">
	<h1>Registración</h1>
		<?php
		
		echo form_open('registrarse_validar');
		$nombre = array(
              'name'        => 'nombre',
              'id'          => 'registro-nombre',
              'placeholder' => 'Nombre',
              'value'		=> set_value('nombre')
        );
        $apellido = array(
              'name'        => 'apellido',
              'id'          => 'registro-apellido',
              'placeholder' => 'Apellido',
              'value'		=> set_value('apellido')
        );
        $email = array(
              'name'        => 'email',
              'id'          => 'registro-email',
              'placeholder' => 'Correo electrónico',
              'value'		=> set_value('email')  
        );
        $password = array(
              'name'        => 'password',
              'id'          => 'registro-password',
              'placeholder' => 'Contraseña'  
        );
		$password2 = array(
              'name'        => 'password2',
              'id'          => 'registro-password2',
              'placeholder' => 'Repetir contraseña'  
        );

        
		echo '<div class="nombre-input">';
		echo form_label('Nombre', 'nombre');
		echo form_input($nombre);
		echo form_error('nombre');
		echo br();
		echo '</div>';
		
		echo '<div class="apellido-input">';
		echo form_label('Apellido', 'apellido');
		echo form_input($apellido);
		echo form_error('apellido');
		echo br();
		echo '</div>';

		echo '<div class="email-input">';
		echo form_label('Email', 'email');
		echo form_input($email);
		echo form_error('email');
		echo br();
		echo '</div>';
		
		echo '<div class="password-input">';
		echo form_label('Password', 'password');
		echo form_password($password);
		echo form_error('password');
		echo br();
		echo '</div>';
		
		echo '<div class="password2-input">';
		echo form_label('Repetir password', 'password2');
		echo form_password($password2);
		echo form_error('password2');
		echo br();
		echo '</div>';
		
		?>
		<hr>
		<?php
		echo form_submit('registrarse', 'Enviar', 'class="submit-input"');
		echo form_close();

?>
		

</section>
</div>
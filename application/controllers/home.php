<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model("info_model");
	}

	function index()
	{
		$datos["titulo"]="Inicio";
		$datos["imagenes"] = $this->info_model->get_slider_imagen();
		$datos["infofechaslider"] = $this->info_model->get_info_slider();
		$datos["infofechaagenda"] = $this->info_model->get_info_agenda();
		$this->load->view("templates/frontend/header.php",$datos);
		$this->load->view("frontend/index.php");
		$this->load->view("templates/frontend/footer.html");
	}

	function nosotros()
	{
		$datos["titulo"]="Nosotros";
		$this->load->view("templates/frontend/header.php",$datos);
		$this->load->view("frontend/nosotros.php");
		$this->load->view("templates/frontend/footer.html");
	}

	function calendario()
	{
		$datos["fecha"] = $this->info_model->fecha('todos');	
		//$datos["bandasxfecha"] = $this->info_model->bandasxfecha('todos');
		$datos["titulo"]="Calendario";
		$this->load->view("templates/frontend/header.php",$datos);
		$this->load->view("frontend/calendario.php",$datos);
		$this->load->view("templates/frontend/footer.html");
		
	}


	function calendario_criterio(){
		$criterio=$this->uri->segment(3);
		$response["fecha"] = $this->info_model->fecha($criterio);
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($response);
		exit();
	}

	function buscar_banda(){
	    if (isset($_GET['term'])){
			$q = strtolower($_GET['term']);
			$valores = $this->info_model->get_bn($q);
			echo json_encode($valores);
	    }
	}

	function bandas()
	{
		$datos["titulo"]="Bandas";
		$this->load->view("templates/frontend/header.php",$datos);
		$this->load->view("frontend/bandas.php");
		$this->load->view("templates/frontend/footer.html");
	}

	function ingresar()
	{
		if($this->session->userdata('logueado')){
			redirect('menulogin', 'refresh');
		}
		else{
			$datos["titulo"]="Ingresar";
			$this->load->view("templates/frontend/header.php",$datos);
			$this->load->view("frontend/ingresar.php");
			$this->load->view("templates/frontend/footer.html");
		}
	}

	function login()
	{
		$this->load->library('encrypt');
		$this->form_validation->set_rules('email','E-mail','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('password','Password','trim|required|max_length[15]|min_length[6]|xss_clean|callback_check_database');
		if ($this->form_validation->run() == FALSE)
		{
			$this->ingresar();	
		}
		else
		{
			redirect('menulogin', 'refresh');
		}
	}

	function check_database($password){
		
		$email = $this->input->post('email');
		$resultado = $this->info_model->login($email, $password);

		if($resultado){
			$session_array = array();
			foreach($resultado as $item){
				$session_array = array(
				'id' => $item->id,
				'email' => $item->email
				);
				$this->session->set_userdata('logueado', $session_array);
			}
			return true;
		}
		else{
			$this->form_validation->set_message('check_database', 'Nombre de usuario o contraseña incorrecto');
			return false;
		}
	}

	function registrarse(){
		$datos["titulo"]="Registrarse";
		$this->load->view("templates/frontend/header.php",$datos);
		$this->load->view("frontend/registrarse.php",$datos);
		$this->load->view("templates/frontend/footer.html");
	}

	function verificacion(){
		$codigo_verificacion=$this->uri->segment(2);

		$resultado = $this->usuarios_model->verificarEmail($codigo_verificacion);		
		if ($resultado == true){
			$datos['mensaje'] = "Email Verificado Satisfactoriamente!";
		}else{
			$datos['mensaje'] = "No se ha podido verificar su E-mail!";
		}
		
		$this->load->view('frontend/verificacion/index.php', $datos);			
	}




	function registrarse_validar(){
		
		$this->form_validation->set_rules('nombre','Nombre','trim|required|xss_clean|max_length[80]');
		$this->form_validation->set_rules('apellido','Apellido','trim|required|xss_clean|max_length[80]');
		$this->form_validation->set_rules('email','E-mail','trim|required|valid_email|xss_clean|max_length[100]');
		$this->form_validation->set_rules('password','Password','trim|required|max_length[15]|min_length[6]|xss_clean|matches[password2]');
		$this->form_validation->set_rules('password2','Password','trim|required|max_length[15]|min_length[6]|xss_clean');

		$this->form_validation->set_message('matches', 'Las Passwords no coinciden');
		if ($this->form_validation->run() == FALSE)
		{
			$this->registrarse();	
		}
		else
		{
			$nombre = $this->input->post('nombre');
			$apellido = $this->input->post('apellido');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			
			$this->load->helper('string');
			$codigo_verificacion = random_string('alnum',20);
			$resultado = $this->info_model->registrar_usuario($nombre, $apellido, $email, $password, $codigo_verificacion);
			if ($resultado)
			{
				$this->info_model->enviarEmailVerificacion($email,$codigo_verificacion);
				$datos["mensaje"] = "Se ha enviado un mail a su casilla de correo para que usted habilite su cuenta.";
				$this->load->view('frontend/mensajemail.php', $datos);
			}
			else
			{			
				$datos["mensaje"] = "Hubo un problema al momento de la registración. Vuelva a intentarlo mas tarde.";
				$this->load->view('frontend/mensajemail.php', $datos);
			}	
		}	
	}



	function menulogin()
	{
		if($this->session->userdata('logueado')){
			$session_data = $this->session->userdata('logueado');
			$datos["noconfirmados"] = $this->info_model->noconfirmados();
			$datos["noturno"] = $this->info_model->noturno();
			$datos["noconvocatoria"] = $this->info_model->noconvocatoria();
			$datos["titulo"]="Menu";
			$datos['email'] = $session_data['email'];
			$this->load->view("templates/frontend/header2.php",$datos);
			$this->load->view('frontend/menulogin.php', $datos);
			$this->load->view("templates/frontend/footer2.html");
		}
		else{
			redirect('ingresar', 'refresh');
		}
	}

	function logout(){
		$this->session->unset_userdata('logueado');
		session_destroy();
		redirect('inicio', 'refresh');
	}

	function ingresar_fecha()
	{
		if($this->session->userdata('logueado')){
			$datos["lugar"] = $this->info_model->lugar();
			$datos["banda"] = $this->info_model->banda();
			$datos["titulo"]="Ingresar fecha";
			$this->load->view("templates/frontend/header2.php",$datos);
			$this->load->view("frontend/ingresar_fecha.php",$datos);
			$this->load->view("templates/frontend/footer2.html");
		}
		else{
			redirect('ingresar', 'refresh');
		}	
	}






	function validar_ingresar_fecha()
	{
		if($this->session->userdata('logueado')){
			$this->form_validation->set_error_delimiters('<div class="error"><p>','</p></div>');
			$this->form_validation->set_rules('nombre','Nombre','trim|required|xss_clean|max_length[80]');
			$this->form_validation->set_rules('fecha','Fecha','trim|required|xss_clean|max_length[80]');
			$this->form_validation->set_rules('hora','Hora','trim|required|xss_clean|max_length[80]');
			$this->form_validation->set_rules('lugar','Lugar','trim|required|xss_clean|max_length[80]');		

			$tieneslider = $this->input->post('tieneslider');

			// Fecha imagen
			$config['upload_path']   =   "./assets/img/eventos/";
			$config['allowed_types'] =   "gif|jpg|jpeg";
			$config['max_size']      =   "5000";
			$config['max_width']     =   "1300";
			$config['max_height']    =   "1300";

			// Slider imagen

			if ($tieneslider == 1){

			$this->form_validation->set_rules('posicion','Posicion','trim|required|xss_clean');		

			$config2['upload_path']   =   "./assets/img/slider/";
			$config2['allowed_types'] =   "gif|jpg|jpeg";
			$config2['max_size']      =   "5000";
			$config2['max_width']  		 =   "1920";
			$config2['max_height']    	 =   "550";
			$config2['min_width']  		 =   "1920";
			$config2['min_height']    	 =   "550";

			}

			$this->load->library("upload");

			$errors = "";
			$response = "";

			$response['st'] = true;

			if ($this->form_validation->run() == FALSE){

				$response['st'] = false;

				$errors = array();	        
		        foreach ($this->input->post() as $key => $value)
		        {
		            $errors[$key] = form_error($key);
		        }

		        $this->upload->initialize($config);
    			if (!$this->upload->do_upload("userfile"))
				{				
					$response['imgerror'] = array('error' => $this->upload->display_errors('<div class="error"><p>','</p></div>'));	
				}

				if ($tieneslider == 1){
					$this->upload->initialize($config2);
	    			if (!$this->upload->do_upload("imgslider"))
					{				
						$response['imgerror2'] = array('error' => $this->upload->display_errors('<div class="error"><p>','</p></div>'));	
					}
				}
		        
		        $response['errors'] = array_filter($errors);
		        
			}
			else
			{
				$this->upload->initialize($config);
				if (!$this->upload->do_upload("userfile")){	
					$response['st'] = false;
					$response['errors'] = "";
					$response['imgerror'] = array('error' => $this->upload->display_errors('<div class="error"><p>','</p></div>'));					
				}
			
				if ($tieneslider == 1){
					$this->upload->initialize($config2);
					if (!$this->upload->do_upload("imgslider")){	
						$response['st'] = false;
						$response['errors'] = "";
						$response['imgerror2'] = array('error' => $this->upload->display_errors('<div class="error"><p>','</p></div>'));	
					}
				}

				if ($response['st'] == true){

					$nombre = $this->input->post('nombre');
					$fecha = $this->input->post('fecha');
					$hora = $this->input->post('hora');
					$bandas = $this->input->post('idsbandas');
					$lugar = $this->input->post('lugar');

					$this->upload->initialize($config);
					$this->upload->do_upload("userfile");
					$data = $this->upload->data();
					$file_name = $data['file_name'];

					if ($tieneslider == 1){
						$posicion = $this->input->post('posicion');
						$this->upload->initialize($config2);
						$this->upload->do_upload("imgslider");
						$data = $this->upload->data();
						$file_name2 = $data['file_name'];
					}

					$resultado = $this->info_model->insertar_fecha($nombre, $bandas, $lugar, $fecha, $hora, $file_name);

					$this->load->library('image_lib');

					if ($tieneslider == 1){
						$cantidad = $this->info_model->get_cantidad_slides();
						$idfb = $this->info_model->get_last_id();
						if ($cantidad < 3 && $resultado){
							$resultadoslider = $this->info_model->insertar_slider($idfb,$file_name2);
						}else{
							$resultadoslider = $this->info_model->modificar_slider($posicion,$idfb,$file_name2);
						}

						$config2['image_library'] = 'gd2';
						$config2['source_image']	= './assets/img/slider/'.$file_name2.'';
						$config2['new_image']	= './assets/img/sliderthumbs/'.$file_name2.'';
						$config2['create_thumb'] = FALSE;
						$config2['maintain_ratio'] = FALSE;
						$config2['width']	= 288;
						$config2['height']	= 83;
						$this->image_lib->initialize($config2);
						$this->image_lib->resize();

					}

					$config['image_library'] = 'gd2';
					$config['source_image']	= './assets/img/eventos/'.$file_name.'';
					$config['new_image']	= './assets/img/calimgs/'.$file_name.'';
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = FALSE;
					$config['width']	= 140;
					$config['height']	= 140;
					$this->image_lib->initialize($config);
					$this->image_lib->resize();

					if ($resultado)
					{
						$response["mensaje"] = "El registro se ha agregado correctamente.";
					}
					else
					{			
						$response["mensaje"] = "Hubo un problema al momento de insertar el registro. Intentelo nuevamente mas tarde.";
					}
					
				}
			}

			header('Content-type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();

		}
		else{
			redirect('ingresar', 'refresh');
		}	
	}


	function validar_buscar_fecha()
	{
		if($this->session->userdata('logueado')){
			$this->form_validation->set_error_delimiters('<div class="error"><p>','</p></div>');
			$this->form_validation->set_rules('criterio','Criterio','trim|required|xss_clean|max_length[80]');
			$this->form_validation->set_rules('buscar','Buscar','trim|required|xss_clean|max_length[80]');
			
			$errors = "";

			if ($this->form_validation->run() == FALSE)
			{
				$errors = array();	        
		        foreach ($this->input->post() as $key => $value)
		        {
		            $errors[$key] = form_error($key);
		        }
		        $response['errors'] = array_filter($errors);
		        $response['st'] = false;
			}
			else
			{
				
					$b = strtolower($this->input->post('buscar'));
					$c = $this->input->post('criterio');
					$resul = $this->info_model->buscarxcriteriofecha($c,$b);
					$response["resul"] = $resul;
					$response['st'] = true;
					
	    		
			}
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		else{
			redirect('ingresar', 'refresh');
		}	
	}




	function validar_buscar_lugar()
	{
		if($this->session->userdata('logueado')){
			$this->form_validation->set_error_delimiters('<div class="error"><p>','</p></div>');
			$this->form_validation->set_rules('criterio','Criterio','trim|required|xss_clean|max_length[80]');
			$this->form_validation->set_rules('buscar','Buscar','trim|required|xss_clean|max_length[80]');
			
			$errors = "";

			if ($this->form_validation->run() == FALSE)
			{
				$errors = array();	        
		        foreach ($this->input->post() as $key => $value)
		        {
		            $errors[$key] = form_error($key);
		        }
		        $response['errors'] = array_filter($errors);
		        $response['st'] = false;
			}
			else
			{
				
					$b = strtolower($this->input->post('buscar'));
					$c = $this->input->post('criterio');
					$resul = $this->info_model->buscarxcriteriolugar($c,$b);
					$response["resul"] = $resul;
					$response['st'] = true;
					
	    		
			}
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		else{
			redirect('ingresar', 'refresh');
		}	
	}


	function registrobanda()
	{
		$datos["genero"] = $this->info_model->genero();
		$datos["paises"] = $this->info_model->paises();
		$datos["provincia"] = $this->info_model->provincia();
		$datos["titulo"]="Registrá tu banda";
		$this->load->view("templates/frontend/header.php",$datos);
		$this->load->view("frontend/registrobanda.php",$datos);
		$this->load->view("templates/frontend/footer.html");	
	}

	function localidades(){
		$provincia = $this->uri->segment(3);
		$response["localidades"]=$this->info_model->localidades($provincia);
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($response);
		exit();
	}


	function ingresar_banda()
	{
		if($this->session->userdata('logueado')){
			$datos["genero"] = $this->info_model->genero();
			$datos["paises"] = $this->info_model->paises();
			$datos["provincia"] = $this->info_model->provincia();
			$datos["convocatoria"] = $this->info_model->get_convocatoria();
			$datos["turnos"] = $this->info_model->get_turnos();
			$datos["estados"] = $this->info_model->get_bandaestado();
			$datos["titulo"]="Ingresar banda";
			$this->load->view("templates/frontend/header2.php",$datos);
			$this->load->view("frontend/ingresar_banda.php",$datos);
			$this->load->view("templates/frontend/footer2.html");
		}
		else{
			redirect('ingresar', 'refresh');
		}	
	}

	function validar_ingresar_banda()
	{
		if($this->session->userdata('logueado')){
			$this->form_validation->set_error_delimiters('<div class="error"><p>','</p></div>');
			$this->form_validation->set_rules('nombre','Nombre','required|xss_clean|max_length[80]');
			$this->form_validation->set_rules('genero','Genero','required|xss_clean|max_length[80]');

			$id_pais = $this->input->post('pais');
			if ($id_pais == '12'){
				$this->form_validation->set_rules('provincia','Provincia','required|xss_clean');
			}
			
			$this->form_validation->set_rules('nombre_contacto','Nombre','required|xss_clean|max_length[80]');
			$this->form_validation->set_rules('tel_contacto','Telefono','xss_clean|max_length[80]');			
			$this->form_validation->set_rules('contacto','Contacto','trim|xss_clean|max_length[80]');

			$otrocontacto = $this->input->post('otrocontacto');
			if ($otrocontacto == 'si'){
				$this->form_validation->set_rules('nombre_contacto2','Nombre','required|xss_clean|max_length[80]');
				$this->form_validation->set_rules('tel_contacto2','Telefono','xss_clean|max_length[80]');			
				$this->form_validation->set_rules('contacto2','Contacto','trim|xss_clean|max_length[80]');
			}

			$this->form_validation->set_rules('sitioweb','Sitio web','trim|xss_clean|max_length[80]');
			$this->form_validation->set_rules('soundcloud','Soundcloud','trim|xss_clean|max_length[80]');
			$this->form_validation->set_rules('bandcamp','Bandcamp','trim|xss_clean|max_length[80]');
			$this->form_validation->set_rules('youtube','Youtube','trim|xss_clean|max_length[80]');

			$errors = "";

			if ($this->form_validation->run() == FALSE)
			{
				$errors = array();	        
		        foreach ($this->input->post() as $key => $value)
		        {
		            $errors[$key] = form_error($key);
		        }
		        $response['errors'] = array_filter($errors);
		        $response['st'] = false;
			}
			else
			{
				$nombre = $this->input->post('nombre');
				$id_genero = $this->input->post('genero');
				$id_pais = $this->input->post('pais');
				if ($id_pais == '12'){
					$id_provincia = $this->input->post('provincia');
					$id_localidad = $this->input->post('localidad');
				}else{
					$id_provincia = '0';
					$id_localidad = '0';
				}

				$nombre_contacto = $this->input->post('nombre_contacto');
				$telefono_contacto = $this->input->post('tel_contacto');
				$contacto = $this->input->post('contacto');
				$c1 = array($nombre_contacto,$telefono_contacto,$contacto);

				$otrocontacto = $this->input->post('otrocontacto');
				$c2 = array();
				if ($otrocontacto == 'si'){
					$nombre_contacto2 = $this->input->post('nombre_contacto2');
					$telefono_contacto2 = $this->input->post('tel_contacto2');
					$contacto2 = $this->input->post('contacto2');
					array_push($c2,$nombre_contacto2);
					array_push($c2,$telefono_contacto2);
					array_push($c2,$contacto2);
				}

				$sitioweb = $this->input->post('sitioweb');
				$soundcloud = $this->input->post('soundcloud');
				$bandcamp = $this->input->post('bandcamp');
				$youtube = $this->input->post('youtube');

				$swradio = $this->input->post('swradio');
				$scradio = $this->input->post('scradio');
				$bcradio = $this->input->post('bcradio');
				$ytradio = $this->input->post('ytradio');

				$media = array();
				$urls = array();
				if ($swradio == 'si'){
					array_push($media, '1');
					array_push($urls, $sitioweb);
				}
				if ($scradio == 'si'){
					array_push($media, '2');
					array_push($urls, $soundcloud);
				}
				if ($bcradio == 'si'){
					array_push($media, '3');
					array_push($urls, $bandcamp);
				}
				if ($ytradio == 'si'){
					array_push($media, '4');
					array_push($urls, $youtube);
				}	

				$convocatoria = $this->input->post('convocatoria');
				$turno = $this->input->post('turno');
				$estado = $this->input->post('estado');
				$confirmada = $this->input->post('confirmada');

				$esadmin = $this->input->post('esadmin');

				$resultado = $this->info_model->insertar_banda($nombre, $id_genero, $id_pais, $id_provincia, $id_localidad, $c1, $c2, $media, $urls, $convocatoria, $turno, $estado, $confirmada);
				$response['st'] = true;
				if ($resultado)
				{
					if ($esadmin == '1')
						$response["mensaje"] = "El registro se ha agregado correctamente.";
					else
						$response["mensaje"] = "Muchas gracias por registrar tu banda. Pronto nos pondremos en contacto.";
				}
				else
				{			
					$response["mensaje"] = "Hubo un problema al momento de insertar el registro. Intentelo nuevamente mas tarde.";
				}	
			}

			header('Content-type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();

		}
		else{
			redirect('ingresar', 'refresh');
		}	
	}




	function ingresar_genero()
	{
		if($this->session->userdata('logueado')){
			$datos["titulo"]="Ingresar genero";
			$this->load->view("templates/frontend/header2.php",$datos);
			$this->load->view("frontend/ingresar_genero.php",$datos);
			$this->load->view("templates/frontend/footer2.html");
		}
		else{
			redirect('ingresar', 'refresh');
		}	
	}

	function validar_ingresar_genero()
	{
		if($this->session->userdata('logueado')){
			$this->form_validation->set_error_delimiters('<div class="error"><p>','</p></div>');
			$this->form_validation->set_rules('nombre','Nombre','trim|required|xss_clean|max_length[80]');

			$errors = "";

			if ($this->form_validation->run() == FALSE)
			{
				$errors = array();	        
		        foreach ($this->input->post() as $key => $value)
		        {
		            $errors[$key] = form_error($key);
		        }
		        $response['errors'] = array_filter($errors);
		        $response['st'] = false;
			}
			else
			{
				$nombre = $this->input->post('nombre');
				
				$resultado = $this->info_model->insertar_genero($nombre);
				$response['st'] = true;
				if ($resultado)
				{
					$response["mensaje"] = "El registro se ha agregado correctamente.";
				}
				else
				{			
					$response["mensaje"] = "Hubo un problema al momento de insertar el registro. Intentelo nuevamente mas tarde.";
				}	
			}

			header('Content-type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();

		}
		else{
			redirect('ingresar', 'refresh');
		}	
	}

	function buscar_genero(){
		$response["genero"]=$this->info_model->genero();
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($response);
		exit();
	}




	function modificar_genero(){
		if($this->session->userdata('logueado')){
			$idgenero = $this->uri->segment(2);
			$response["genero"]=$this->info_model->get_genero($idgenero);

			header('Content-type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		else{
			redirect('ingresar', 'refresh');
		}		
	}

	function validar_modificar_genero(){
		if($this->session->userdata('logueado')){
			$this->form_validation->set_error_delimiters('<div class="error"><p>','</p></div>');
			$this->form_validation->set_rules('nombre','Nombre','trim|required|xss_clean|max_length[80]');

			$errors = "";

			if ($this->form_validation->run() == FALSE)
			{
				$errors = array();	        
		        foreach ($this->input->post() as $key => $value)
		        {
		            $errors[$key] = form_error($key);
		        }
		        $response['errors'] = array_filter($errors);
		        $response['st'] = false;
			}
			else
			{
				$idgenero = $this->input->post('idgenero');
				$nombre = $this->input->post('nombre');
				
				$resultado = $this->info_model->modificar_genero($idgenero, $nombre);
				$response['st'] = true;
				if ($resultado)
				{
					$response["mensaje"] = "El registro se ha modificado correctamente.";
				}
				else
				{			
					$response["mensaje"] = "Hubo un problema al momento de modificar el registro. Intentelo nuevamente mas tarde.";
				}	
			}

			header('Content-type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();

		}
		else{
			redirect('ingresar', 'refresh');
		}	
	}


	function eliminar(){
		if($this->session->userdata('logueado')){
			$tipo = $this->uri->segment(3);
			$tipofinal = "eliminar_".$tipo;
			$id = $this->uri->segment(4);
			$resultado = $this->info_model->$tipofinal($id);

			if ($tipofinal == 'eliminar_fecha'){
				if ($this->info_model->get_tieneslider($id)){
					$resultado2 = $this->info_model->eliminar_slider($id);
					if ($resultado && $resultado2)
						$response["mensaje"] = "El registro se ha eliminado correctamente.";
					else	
						$response["mensaje"] = "Hubo un problema al momento de eliminar el registro. Intentelo nuevamente mas tarde.";
				}
				else{
					if ($resultado)
						$response["mensaje"] = "El registro se ha eliminado correctamente.";
					else
						$response["mensaje"] = "Hubo un problema al momento de eliminar el registro. Intentelo nuevamente mas tarde.";
				}					
			}else{
				if ($resultado)
					$response["mensaje"] = "El registro se ha eliminado correctamente.";
				else
					$response["mensaje"] = "Hubo un problema al momento de eliminar el registro. Intentelo nuevamente mas tarde.";
			}
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();	
		}
		else{
			redirect('ingresar', 'refresh');
		}
	}






	function ver_bandas(){
		$idfecha = $this->uri->segment(3);
		$response["fecbandas"]=$this->info_model->get_fecha_bandas($idfecha);
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($response);
		exit();	
	}


	function validar_buscar_banda()
	{
		if($this->session->userdata('logueado')){
			$this->form_validation->set_error_delimiters('<div class="error"><p>','</p></div>');
			$this->form_validation->set_rules('criterio','Criterio','trim|required|xss_clean|max_length[80]');
			$this->form_validation->set_rules('buscar','Buscar','trim|required|xss_clean|max_length[80]');
			
			$errors = "";

			if ($this->form_validation->run() == FALSE)
			{
				$errors = array();	        
		        foreach ($this->input->post() as $key => $value)
		        {
		            $errors[$key] = form_error($key);
		        }
		        $response['errors'] = array_filter($errors);
		        $response['st'] = false;
			}
			else
			{
				
					$b = strtolower($this->input->post('buscar'));
					$c = $this->input->post('criterio');
					$resul = $this->info_model->buscarxcriteriobanda($c,$b);
					$response["resul"] = $resul;
					$response['st'] = true;
					//print_r($response);
	    		
			}
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		else{
			redirect('ingresar', 'refresh');
		}	
	}


	function verinfo_banda(){
		if($this->session->userdata('logueado')){
			$idbanda = $this->uri->segment(2);
			$response["banda"]=$this->info_model->get_banda($idbanda);
			$response["contacto"]=$this->info_model->get_banda_contacto($idbanda);
			$response["media"]=$this->info_model->get_banda_media($idbanda);
			$response["id"]=$idbanda;
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		else{
			redirect('ingresar', 'refresh');
		}		
	}



	function modificar_banda(){
		if($this->session->userdata('logueado')){
			$idbanda = $this->uri->segment(2);
			$response["genero"]=$this->info_model->genero();
			$response["banda"]=$this->info_model->get_banda($idbanda);
			$response["localidades"]=$this->info_model->localidades($response["banda"][0]->id_provincia);
			$response["contacto"]=$this->info_model->get_banda_contacto($idbanda);
			$response["media"]=$this->info_model->get_banda_media($idbanda);
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		else{
			redirect('ingresar', 'refresh');
		}		
	}

	function validar_modificar_banda(){
		if($this->session->userdata('logueado')){
			$this->form_validation->set_error_delimiters('<div class="error"><p>','</p></div>');
			$this->form_validation->set_rules('nombre','Nombre','required|xss_clean|max_length[80]');
			$this->form_validation->set_rules('genero','Genero','required|xss_clean|max_length[80]');
			
			$id_pais = $this->input->post('pais');
			if ($id_pais == '12'){
				$this->form_validation->set_rules('provincia','Provincia','required|xss_clean');
			}

			$this->form_validation->set_rules('nombre_contacto','Nombre','required|xss_clean|max_length[80]');
			$this->form_validation->set_rules('tel_contacto','Telefono','xss_clean|max_length[80]');			
			$this->form_validation->set_rules('contacto','Contacto','trim|xss_clean|max_length[80]');

			$otrocontacto = $this->input->post('otrocontacto');
			if ($otrocontacto == 'si'){
				$this->form_validation->set_rules('nombre_contacto2','Nombre','required|xss_clean|max_length[80]');
				$this->form_validation->set_rules('tel_contacto2','Telefono','xss_clean|max_length[80]');			
				$this->form_validation->set_rules('contacto2','Contacto','trim|xss_clean|max_length[80]');
			}

			$this->form_validation->set_rules('sitioweb','Sitio web','trim|xss_clean|max_length[80]');
			$this->form_validation->set_rules('soundcloud','Soundcloud','trim|xss_clean|max_length[80]');
			$this->form_validation->set_rules('bandcamp','Bandcamp','trim|xss_clean|max_length[80]');
			$this->form_validation->set_rules('youtube','Youtube','trim|xss_clean|max_length[80]');

			$errors = "";

			if ($this->form_validation->run() == FALSE)
			{
				$errors = array();	        
		        foreach ($this->input->post() as $key => $value)
		        {
		            $errors[$key] = form_error($key);
		        }
		        $response['errors'] = array_filter($errors);
		        $response['st'] = false;
			}
			else
			{
				
				$idbanda = $this->input->post('idbanda'); 
				$nombre = $this->input->post('nombre');
				$id_genero = $this->input->post('genero');
				$id_pais = $this->input->post('pais');
				if ($id_pais == '12'){
					$id_provincia = $this->input->post('provincia');
					$id_localidad = $this->input->post('localidad');
				}else{
					$id_provincia = '0';
					$id_localidad = '0';
				}

				$nombre_contacto = $this->input->post('nombre_contacto');
				$telefono_contacto = $this->input->post('tel_contacto');
				$contacto = $this->input->post('contacto');
				$c1 = array($nombre_contacto,$telefono_contacto,$contacto);

				$otrocontacto = $this->input->post('otrocontacto');
				$c2 = array();
				if ($otrocontacto == 'si'){
					$nombre_contacto2 = $this->input->post('nombre_contacto2');
					$telefono_contacto2 = $this->input->post('tel_contacto2');
					$contacto2 = $this->input->post('contacto2');
					array_push($c2,$nombre_contacto2);
					array_push($c2,$telefono_contacto2);
					array_push($c2,$contacto2);
				}

				$sitioweb = $this->input->post('sitioweb');
				$soundcloud = $this->input->post('soundcloud');
				$bandcamp = $this->input->post('bandcamp');
				$youtube = $this->input->post('youtube');

				$swradio = $this->input->post('swradio');
				$scradio = $this->input->post('scradio');
				$bcradio = $this->input->post('bcradio');
				$ytradio = $this->input->post('ytradio');

				$media = array();
				$urls = array();
				if ($swradio == 'si'){
					array_push($media, '1');
					array_push($urls, $sitioweb);
				}
				if ($scradio == 'si'){
					array_push($media, '2');
					array_push($urls, $soundcloud);
				}
				if ($bcradio == 'si'){
					array_push($media, '3');
					array_push($urls, $bandcamp);
				}
				if ($ytradio == 'si'){
					array_push($media, '4');
					array_push($urls, $youtube);
				}	

				$convocatoria = $this->input->post('convocatoria');
				$turno = $this->input->post('turno');
				$estado = $this->input->post('estado');
				$confirmada = $this->input->post('confirmada');
				
				$resultado = $this->info_model->modificar_banda($idbanda, $nombre, $id_genero, $id_pais, $id_provincia, $id_localidad, $c1, $c2, $media, $urls, $convocatoria, $turno, $estado, $confirmada);
				$response['st'] = true;
				if ($resultado)
				{
					$response["mensaje"] = "El registro se ha modificado correctamente.";
				}
				else
				{			
					$response["mensaje"] = "Hubo un problema al momento de modificar el registro. Intentelo nuevamente mas tarde.";
				}	
			}

			header('Content-type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();

		}
		else{
			redirect('ingresar', 'refresh');
		}	
	}



	function ingresar_lugar()
	{
		if($this->session->userdata('logueado')){
			$datos["titulo"]="Ingresar lugar";
			$this->load->view("templates/frontend/header2.php",$datos);
			$this->load->view("frontend/ingresar_lugar.php",$datos);
			$this->load->view("templates/frontend/footer2.html");
		}
		else{
			redirect('ingresar', 'refresh');
		}	
	}

	function validar_ingresar_lugar()
	{
		if($this->session->userdata('logueado')){
			$this->form_validation->set_error_delimiters('<div class="error"><p>','</p></div>');
			$this->form_validation->set_rules('nombre','Nombre','trim|required|xss_clean|max_length[80]');
			$this->form_validation->set_rules('direccion','Direccion','trim|xss_clean|max_length[80]');
			$this->form_validation->set_rules('telefono','Telefono','trim|xss_clean|max_length[80]');
			$this->form_validation->set_rules('email','E-mail','trim|valid_email|xss_clean');
			$this->form_validation->set_rules('nombre_contacto','Nombre de Contacto','trim|xss_clean|max_length[80]');

			$errors = "";

			if ($this->form_validation->run() == FALSE)
			{
				$errors = array();	        
		        foreach ($this->input->post() as $key => $value)
		        {
		            $errors[$key] = form_error($key);
		        }
		        $response['errors'] = array_filter($errors);
		        $response['st'] = false;
			}
			else
			{
				$nombre = $this->input->post('nombre');
				$direccion = $this->input->post('direccion');
				$telefono = $this->input->post('telefono');
				$email = $this->input->post('email');
				$contacto = $this->input->post('nombre_contacto');
				
				$resultado = $this->info_model->insertar_lugar($nombre,$direccion,$telefono,$email,$contacto);
				$response['st'] = true;
				if ($resultado)
				{
					$response["mensaje"] = "El registro se ha agregado correctamente.";
				}
				else
				{			
					$response["mensaje"] = "Hubo un problema al momento de insertar el registro. Intentelo nuevamente mas tarde.";
				}	
			}

			header('Content-type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();

		}
		else{
			redirect('ingresar', 'refresh');
		}	
	}



	function modificar_lugar(){
		if($this->session->userdata('logueado')){
			$idlugar = $this->uri->segment(2);
			$response["lugar"]=$this->info_model->get_lugar($idlugar);
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		else{
			redirect('ingresar', 'refresh');
		}		
	}

	function validar_modificar_lugar(){
		if($this->session->userdata('logueado')){
			$this->form_validation->set_error_delimiters('<div class="error"><p>','</p></div>');
			$this->form_validation->set_rules('nombre','Nombre','trim|required|xss_clean|max_length[80]');
			$this->form_validation->set_rules('direccion','Direccion','trim|xss_clean|max_length[80]');
			$this->form_validation->set_rules('telefono','Telefono','trim|xss_clean|max_length[80]');
			$this->form_validation->set_rules('email','E-mail','trim|valid_email|xss_clean');
			$this->form_validation->set_rules('nombre_contacto','Nombre de Contacto','trim|xss_clean|max_length[80]');

			$errors = "";

			if ($this->form_validation->run() == FALSE)
			{
				$errors = array();	        
		        foreach ($this->input->post() as $key => $value)
		        {
		            $errors[$key] = form_error($key);
		        }
		        $response['errors'] = array_filter($errors);
		        $response['st'] = false;
			}
			else
			{
				$idlugar = $this->input->post('idlugar');
				$nombre = $this->input->post('nombre');
				$direccion = $this->input->post('direccion');
				$telefono = $this->input->post('telefono');
				$email = $this->input->post('email');
				$contacto = $this->input->post('nombre_contacto');
				
				$resultado = $this->info_model->modificar_lugar($idlugar, $nombre, $direccion, $telefono, $email, $contacto);
				$response['st'] = true;
				if ($resultado)
				{
					$response["mensaje"] = "El registro se ha modificado correctamente.";
				}
				else
				{			
					$response["mensaje"] = "Hubo un problema al momento de modificar el registro. Intentelo nuevamente mas tarde.";
				}	
			}

			header('Content-type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();

		}
		else{
			redirect('ingresar', 'refresh');
		}	
	}

	
	function modificar_fecha(){
		if($this->session->userdata('logueado')){
			
			$idfecha = $this->uri->segment(2);
			$response["lugar"]=$this->info_model->lugar();
			$response["bandas"]=$this->info_model->get_fecha_bandas($idfecha);

			$ts = $this->info_model->get_tieneslider($idfecha);
			if ($ts)
				$response["fech"]=$this->info_model->get_fecha_slider($idfecha);	
			else
				$response["fech"]=$this->info_model->get_fecha($idfecha);	

			
			
			$response["env"] = ENVIRONMENT;
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();

		}
		else{
			redirect('ingresar', 'refresh');
		}		
	}




	function validar_modificar_fecha()
	{
		if($this->session->userdata('logueado')){
			$this->form_validation->set_error_delimiters('<div class="error"><p>','</p></div>');
			$this->form_validation->set_rules('nombre','Nombre','trim|required|xss_clean|max_length[80]');
			$this->form_validation->set_rules('fecha','Fecha','trim|required|xss_clean|max_length[80]');
			$this->form_validation->set_rules('hora','Hora','trim|required|xss_clean|max_length[80]');
			$this->form_validation->set_rules('lugar','Lugar','trim|required|xss_clean|max_length[80]');		

			$tieneslider = $this->input->post('tieneslider');
			$estacargado = $this->input->post('estacargado');
			$estacargadoslider = $this->input->post('estacargadoslider');

			// Fecha imagen
			$config['upload_path']   =   "./assets/img/eventos/";
			$config['allowed_types'] =   "gif|jpg|jpeg";
			$config['max_size']      =   "5000";
			$config['max_width']     =   "1300";
			$config['max_height']    =   "1300";

			// Slider imagen

			if ($tieneslider == 1){

			$this->form_validation->set_rules('posicion','Posicion','trim|required|xss_clean');		

			$config2['upload_path']   =   "./assets/img/slider/";
			$config2['allowed_types'] =   "gif|jpg|jpeg";
			$config2['max_size']      =   "5000";
			$config2['max_width']  		 =   "1920";
			$config2['max_height']    	 =   "550";
			$config2['min_width']  		 =   "1920";
			$config2['min_height']    	 =   "550";

			}

			$this->load->library("upload");

			$errors = "";
			$response = "";

			$response['st'] = true;

			if ($this->form_validation->run() == FALSE){

				$response['st'] = false;

				$errors = array();	        
		        foreach ($this->input->post() as $key => $value)
		        {
		            $errors[$key] = form_error($key);
		        }

		        if($estacargado == "1"){
		        	$this->upload->initialize($config);
    				if (!$this->upload->do_upload("userfile"))
					{				
						$response['imgerror'] = array('error' => $this->upload->display_errors('<div class="error"><p>','</p></div>'));	
					}
				}


				if ($tieneslider == 1){
					if($estacargadoslider == "1"){
						$this->upload->initialize($config2);
		    			if (!$this->upload->do_upload("imgslider"))
						{				
							$response['imgerror2'] = array('error' => $this->upload->display_errors('<div class="error"><p>','</p></div>'));	
						}
					}
				}
		        
		        $response['errors'] = array_filter($errors);
		        
			}
			else
			{
				if($estacargado == "1"){
					$this->upload->initialize($config);
					if (!$this->upload->do_upload("userfile")){	
						$response['st'] = false;
						$response['errors'] = "";
						$response['imgerror'] = array('error' => $this->upload->display_errors('<div class="error"><p>','</p></div>'));					
					}
				}
			
				if ($tieneslider == 1){
					if($estacargadoslider == "1"){
						$this->upload->initialize($config2);
						if (!$this->upload->do_upload("imgslider")){	
							$response['st'] = false;
							$response['errors'] = "";
							$response['imgerror2'] = array('error' => $this->upload->display_errors('<div class="error"><p>','</p></div>'));	
						}
					}
				}

				if ($response['st'] == true){

					$idfecha = $this->input->post('idfecha');

					$nombre = $this->input->post('nombre');
					$fecha = $this->input->post('fecha');
					$hora = $this->input->post('hora');
					$bandas = $this->input->post('idsbandas');
					$lugar = $this->input->post('lugar');

					if($estacargado == "1"){
						$this->upload->initialize($config);
						$this->upload->do_upload("userfile");
						$data = $this->upload->data();
						$file_name = $data['file_name'];
					}else{
						$file_name = $this->input->post('cargado');
					}

					if ($tieneslider == 1){
						$posicion = $this->input->post('posicion');
						if($estacargadoslider == "1"){
							$this->upload->initialize($config2);
							$this->upload->do_upload("imgslider");
							$data = $this->upload->data();
							$file_name2 = $data['file_name'];
						}
						else{
							$file_name2 = $this->input->post('cargadoslider');
						}
					}

					$resultado = $this->info_model->modificar_fecha($idfecha,$nombre, $bandas, $lugar, $fecha, $hora, $file_name);

					$this->load->library('image_lib');

					if ($tieneslider == 1){
						$cantidad = $this->info_model->get_cantidad_slides();
						$idfb = $this->info_model->get_last_id();
						if ($cantidad < 3 && $resultado){
							$resultadoslider = $this->info_model->insertar_slider($idfb,$file_name2);
						}else{
							$resultadoslider = $this->info_model->modificar_slider($posicion,$idfb,$file_name2);
						}

						if($estacargadoslider == "1"){
							$config2['image_library'] = 'gd2';
							$config2['source_image']	= './assets/img/slider/'.$file_name2.'';
							$config2['new_image']	= './assets/img/sliderthumbs/'.$file_name2.'';
							$config2['create_thumb'] = FALSE;
							$config2['maintain_ratio'] = FALSE;
							$config2['width']	= 288;
							$config2['height']	= 83;
							$this->image_lib->initialize($config2);
							$this->image_lib->resize();
						}
					}

					if($estacargado == "1"){
						$config['image_library'] = 'gd2';
						$config['source_image']	= './assets/img/eventos/'.$file_name.'';
						$config['new_image']	= './assets/img/calimgs/'.$file_name.'';
						$config['create_thumb'] = FALSE;
						$config['maintain_ratio'] = FALSE;
						$config['width']	= 140;
						$config['height']	= 140;
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
					}

					if ($resultado)
					{
						$response["mensaje"] = "El registro se ha modificado correctamente.";
					}
					else
					{			
						$response["mensaje"] = "Hubo un problema al momento de insertar el registro. Intentelo nuevamente mas tarde.";
					}
					
				}
			}

			header('Content-type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();

		}
		else{
			redirect('ingresar', 'refresh');
		}	
	}



	function get_select_criterio($criterio){
		$criterio=$this->uri->segment(3);
		$response["valores"] = $this->info_model->get_select_criterio($criterio);
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($response);
		exit();
	}

	function confirmarbandas(){
		if($this->session->userdata('logueado')){
			$datos["titulo"]="Confirmar bandas";
			$datos["valores"] = $this->info_model->get_bandassinconfirmar();
			$this->load->view("templates/frontend/header2.php",$datos);
			$this->load->view("frontend/confirmarbandas.php",$datos);
			$this->load->view("templates/frontend/footer2.html");
		}
		else{
			redirect('ingresar', 'refresh');
		}	
	}


	function definirturnos(){
		if($this->session->userdata('logueado')){
			$datos["titulo"]="Bandas sin turno";
			$datos["valores"] = $this->info_model->get_bandassinturno();
			$this->load->view("templates/frontend/header2.php",$datos);
			$this->load->view("frontend/bandassinturno.php",$datos);
			$this->load->view("templates/frontend/footer2.html");
		}
		else{
			redirect('ingresar', 'refresh');
		}	
	}

	function definirconvocatorias(){			$datos["valores"] = $this->info_model->get_bandassinconvocatoria();
		if($this->session->userdata('logueado')){
			$datos["titulo"]="Bandas sin turno";
			$datos["valores"] = $this->info_model->get_bandassinturno();
			$this->load->view("templates/frontend/header2.php",$datos);
			$this->load->view("frontend/bandassinconvocatoria.php",$datos);
			$this->load->view("templates/frontend/footer2.html");
		}
		else{
			redirect('ingresar', 'refresh');
		}	
	}



	/*function get_noconfirmados(){
		$response["noconfirmados"] = $this->info_model->noconfirmados();
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($response);
		exit();
	}*/



}	
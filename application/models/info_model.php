<?php

class info_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	function banda(){
		$this->db->select('id,nombre');
		$this->db->from('banda');
		$bc = $this->db->get();
		return $bc->result();
	}

	function genero(){
		$this->db->select('id,nombre');
		$this->db->from('genero');
		$gen = $this->db->get();
		return $gen->result();
	}

	function paises(){
		$this->db->select('id,nombre');
		$this->db->from('paises');
		$ps = $this->db->get();
		return $ps->result();
	}

	function provincia(){
		$this->db->select('id,nombre');
		$this->db->from('provincia');
		$this->db->where('id !=', 0);
		$prov = $this->db->get();
		return $prov->result();
	}

	function localidades($provincia){
		$this->db->select('id,nombre,id_provincia');
		$this->db->from('localidad');
		$this->db->where('id_provincia', $provincia);
		$this->db->where('id !=', 0);
		$loc = $this->db->get();
		return $loc->result();
	}

	function lugar(){
		$this->db->select('id,nombre');
		$this->db->from('lugar');
		$lug = $this->db->get();
		return $lug->result();
	}

	function noconfirmados(){
		$this->db->where('confirmada',0);
		$this->db->from('banda');
    	return $this->db->count_all_results();
	}

	function noturno(){
		$this->db->where('id_turno',1);
		$this->db->from('banda');
    	return $this->db->count_all_results();
	}

	function noconvocatoria(){
		$this->db->where('id_convocatoria',1);
		$this->db->from('banda');
    	return $this->db->count_all_results();
	}

	function fecha($criterio){
		$this->db->select('fecha.id AS `fid`,fecha.nombre,fecha.imagen,fecha.dia,fecha.hora,lugar.id,lugar.nombre AS `lugar`');
		$this->db->from('fecha');
		$this->db->join('lugar', 'lugar.id = fecha.id_lugar');
		
		switch ($criterio) {
			case 'hoy':
				$this->db->where('dia',date("Y-m-d"));
			break;

			case 'maniana':
				$this->db->where('dia',date('Y-m-d', strtotime('+1 day')));
			break;

			/*case 'semana':
				
			break;*/

			case 'mes':
				$mesactual = date('m');
				$anioactual = date('y');
				$inicio = $anioactual."/".$mesactual."/01";
				$cantdias = cal_days_in_month(CAL_GREGORIAN, $mesactual, $anioactual);
				$fin = $anioactual."/".$mesactual."/".$cantdias;
				$this->db->where('dia >=',$inicio);
				$this->db->where('dia <=',$fin);
			break;

			case 'todas':
				$this->db->where('dia >=',date("Y-m-d"));
			break;
			
			
		}

		$this->db->order_by('fecha.dia','asc');
		$fec = $this->db->get();
		return $fec->result();
	}

	function bandasxfecha($criterio){
		$this->db->select('fecha.id AS `fid`,fecha.nombre,fecha.imagen,fecha.dia,fecha.hora,lugar.id,lugar.nombre AS `lugar`');
		$this->db->from('fecha');
		$this->db->join('fecha_banda', 'fecha_banda.id_fecha = fecha.id');
		$this->db->join('banda', 'banda.id = fecha_banda.id_banda');
		
		switch ($criterio) {
			case 'hoy':
				$this->db->where('dia',date("Y-m-d"));
			break;

			case 'maniana':
				$this->db->where('dia',date('Y-m-d', strtotime('+1 day')));
			break;

			/*case 'semana':
				
			break;*/

			case 'mes':
				$mesactual = date('m');
				$anioactual = date('y');
				$inicio = $anioactual."/".$mesactual."/01";
				$cantdias = cal_days_in_month(CAL_GREGORIAN, $mesactual, $anioactual);
				$fin = $anioactual."/".$mesactual."/".$cantdias;
				$this->db->where('dia >=',$inicio);
				$this->db->where('dia <=',$fin);
			break;

			case 'todas':
				$this->db->where('dia >=',date("Y-m-d"));
			break;
			
			
		}

		$this->db->order_by('fecha.dia','asc');
		$fec = $this->db->get();
		return $fec->result();
	}

	function get_bn($q){
		$this->db->select('banda.id AS `idban`, banda.nombre AS `bannom`, banda.id_genero, genero.id, genero.nombre AS `gennom`');
	    $this->db->from('banda');
	    $this->db->join('genero', 'genero.id = banda.id_genero');
	    $this->db->like('banda.nombre', $q);
	    $query = $this->db->get();
		if($query->num_rows > 0){
			foreach ($query->result_array() as $row){
				$new_row['idbanda']=htmlentities(stripslashes($row['idban']));
        		$new_row['nombre']=htmlentities(stripslashes($row['bannom']));
        		$new_row['genero']=htmlentities(stripslashes($row['gennom']));
        		$row_set[] = $new_row; 
			}
			return $row_set;			
		}
	}  

	function login($email, $password)
	{
		$this->load->library('encrypt');
		
		$this->db->select('id, email, password');
		$this->db->from('usuario');
		$this->db->where('email', $email);
		$this->db->limit(1);
	   $query = $this->db->get();

	   if($query->num_rows()== 1)
	   {
			$userpass = $query->row();
			$userpass = $this->encrypt->decode($userpass->password);
			if ($userpass == $password){
				return $query->result();
		   	}
		   	else{
		   		return false;
		   	}
		}
	   else
	   {
	     return false;
	   }
	 }

 	function registrar_usuario($nombre, $apellido, $email, $password, $codigo_verificacion)
	{
		$this->load->library('encrypt');
		$password = $this->encrypt->encode($password);

		$this->db->trans_start();

		$datos = array(
		   'nombre' => $nombre,
		   'apellido' => $apellido,
		   'email' => $email,
		   'password' => $password,
		   'verificacion' => $codigo_verificacion
		);

		$this->db->insert('usuario', $datos);

		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}
		else{
			return true;
		}


	}

	function insertar_banda($nombre,$id_genero,$id_pais,$id_provincia,$id_localidad,$c1,$c2,$media,$urls,$convocatoria,$turno,$estado,$confirmada){

		$this->db->trans_start();

		$datos = array(
		   'nombre' => $nombre,
		   'id_genero' => $id_genero,
		   'id_pais' => $id_pais,
		   'id_provincia' => $id_provincia,
		   'id_localidad' => $id_localidad,
		   'id_convocatoria' => $convocatoria,
		   'id_turno' => $turno,
		   'id_estado' => $estado,
		   'confirmada' => $confirmada
		);

		$this->db->insert('banda', $datos);

		$insert_id = $this->db->insert_id();

		$datos = array(
		   'nombre' => $c1[0],
		   'telefono' => $c1[1],
		   'contacto' => $c1[2],
		   'id_banda' => $insert_id
		);

		$this->db->insert('banda_contacto', $datos);


		if(sizeof($c2) > 0){

			$datos = array(
			   'nombre' => $c2[0],
			   'telefono' => $c2[1],
			   'contacto' => $c2[2],
			   'id_banda' => $insert_id
			);

			$this->db->insert('banda_contacto', $datos);
		}

		if(sizeof($media) > 0){
			for ($i=0; $i < sizeof($media); $i++) { 
				$datos = array(
					'media' => $media[$i],
					'url' => $urls[$i],
					'id_banda' => $insert_id
				);
				$this->db->insert('banda_media', $datos);	
			}
		}

		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}
		else{
			return true;
		}

	}

	function insertar_genero($nombre){

		$this->db->trans_start();

		$datos = array(
		   'nombre' => $nombre
		);

		$this->db->insert('genero', $datos);

		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}
		else{
			return true;
		}

	}

	function insertar_lugar($nombre,$direccion,$telefono,$email,$contacto){

		$this->db->trans_start();

		$datos = array(
		   'nombre' => $nombre,
		   'direccion' => $direccion,
		   'telefono' => $telefono,
		   'email' => $email,
		   'nombre_contacto' => $contacto
		);

		$this->db->insert('lugar', $datos);

		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}
		else{
			return true;
		}

	}


	function insertar_fecha($nombre,$bandas,$lugar,$fecha,$hora,$file_name){

		$this->db->trans_start();

		$datos = array(
		   'nombre' => $nombre,
		   'dia' => date('Y-m-d', strtotime($fecha)),
		   'hora' => $hora.":00",
		   'imagen' => $file_name,
		   'id_lugar' => $lugar
		);

		$this->db->insert('fecha', $datos);

		$insert_id = $this->db->insert_id();

		$arraybandas = explode(',', $bandas);

		foreach ($arraybandas as $item) {
			$datos = array(
				'id_banda' => $item,
				'id_fecha' => $insert_id
			);
			$this->db->insert('fecha_banda', $datos);			
		}

		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}
		else{
			return true;
		}

	}




	function modificar_fecha($idfecha,$nombre,$bandas,$lugar,$fecha,$hora,$file_name){

		$this->db->trans_start();

		$datos = array(
		   'nombre' => $nombre,
		   'dia' => date('Y-m-d', strtotime($fecha)),
		   'hora' => $hora.":00",
		   'imagen' => $file_name,
		   'id_lugar' => $lugar
		);

		$this->db->where('id',$idfecha);
		$this->db->limit(1);
		$this->db->update('fecha', $datos); 

		$this->db->where('id_fecha',$idfecha);
		$this->db->delete('fecha_banda');

		$arraybandas = explode(',', $bandas);

		foreach ($arraybandas as $item) {
			$datos = array(
				'id_banda' => $item,
				'id_fecha' => $idfecha
			);

			$this->db->insert('fecha_banda', $datos);
		}

		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}
		else{
			return true;
		}

	}


	function get_select_criterio($criterio){
		$this->db->select('*');
		switch ($criterio) {
		    case "genero":
		        $this->db->from('genero');
		        break;
		    case "turno":
		        $this->db->from('turno');
		        break;
		    case "convocatoria":
		        $this->db->from('convocatoria');
		        break;
		    case "estado":
		        $this->db->from('estado');
		        break;    
		}

		$query = $this->db->get();
		if($query->num_rows > 0){
			foreach ($query->result_array() as $row){
				$new_row['id']=htmlentities(stripslashes($row['id']));
				if($criterio == "convocatoria")
        			$new_row['nombre']=htmlentities(stripslashes($row['tipo']));
        		else
        			$new_row['nombre']=htmlentities(stripslashes($row['nombre']));
        		$row_set[] = $new_row; 
			}
			return $row_set;					
		}
	}



	function buscarxcriteriobanda($criterio,$q){

		$this->db->select('banda.id AS `banid`, banda.nombre AS `bannom`, banda.id_genero, banda.id_turno, banda.id_convocatoria, banda.id_estado, genero.id, genero.nombre AS `gennom`, turno.id, turno.nombre AS `turnom`, convocatoria.id, convocatoria.tipo, estado.id, estado.nombre AS `estnom`');
	    $this->db->from('banda');
		$this->db->join('genero', 'genero.id = banda.id_genero');
		$this->db->join('turno', 'turno.id = banda.id_turno');
		$this->db->join('convocatoria', 'convocatoria.id = banda.id_convocatoria');
		$this->db->join('estado', 'estado.id = banda.id_estado');
		

		switch ($criterio) {
		    case "nombre":
		        $this->db->like('banda.nombre', $q);
		        break;
		    case "genero":
		        $this->db->where('genero.id', $q);
		        break;
		    case "turno":
		        $this->db->where('turno.id', $q);
		        break;
	        case "convocatoria":
		        $this->db->where('convocatoria.id', $q);
		        break;
	        case "estado":
		        $this->db->where('estado.id', $q);
		        break;
   	        case "confirmada":
		        $this->db->where('banda.confirmada', $q);
		        break;
		}

		$query = $this->db->get();
		if($query->num_rows > 0){
			foreach ($query->result_array() as $row){
				$new_row['idbanda']=htmlentities(stripslashes($row['banid']));
        		$new_row['nombre']=htmlentities(stripslashes($row['bannom']));
	    		$new_row['genero']=htmlentities(stripslashes($row['gennom']));
	    		$new_row['turno']=htmlentities(stripslashes($row['turnom']));
	    		$new_row['convocatoria']=htmlentities(stripslashes($row['tipo']));
	    		$new_row['estado']=htmlentities(stripslashes($row['estnom']));
        		$row_set[] = $new_row; 
			}
			return $row_set;					
		}
	}


	function buscarxcriteriofecha($criterio,$q){

		$this->db->select('fecha.id AS `fecid`,fecha.nombre AS `fecnom`,fecha.dia,fecha.hora,fecha.id_lugar,lugar.id,lugar.nombre AS `lugnom`');
	    $this->db->from('fecha');
	    $this->db->join('lugar', 'lugar.id = fecha.id_lugar');

		switch ($criterio) {
		    case "fecha":
		        $this->db->like('fecha.dia', $q);
		        break;
		    case "nombre":
		        $this->db->like('fecha.nombre', $q);
		        break;
			case "lugar":
		        $this->db->like('lugar.nombre', $q);
		        break;
		}

		$query = $this->db->get();
		if($query->num_rows > 0){
			foreach ($query->result_array() as $row){
				$new_row['idfecha']=htmlentities(stripslashes($row['fecid']));
        		$new_row['nombre']=htmlentities(stripslashes($row['fecnom']));
	    		$new_row['fecha']=htmlentities(stripslashes($row['dia']));
        		$new_row['hora']=htmlentities(stripslashes($row['hora']));
        		$new_row['lugar']=htmlentities(stripslashes($row['lugnom']));
        		$row_set[] = $new_row; 
			}
			return $row_set;					
		}
	}


	function buscarxcriteriolugar($criterio,$q){

		$this->db->select('lugar.id, lugar.nombre, lugar.direccion, lugar.telefono, lugar.email, lugar.nombre_contacto');
	    $this->db->from('lugar');

		switch ($criterio) {
		    case "nombre":
		        $this->db->like('nombre', $q);
		        break;
		    case "direccion":
		        $this->db->like('direccion', $q);
		        break;
			case "telefono":
		        $this->db->like('telefono', $q);
		        break;
			case "email":
		        $this->db->like('email', $q);
		        break;
	    	case "contacto":
		        $this->db->like('nombre_contacto', $q);
		        break;
		}

		$query = $this->db->get();
		if($query->num_rows > 0){
			foreach ($query->result_array() as $row){
				$new_row['idlugar']=htmlentities(stripslashes($row['id']));
        		$new_row['nombre']=htmlentities(stripslashes($row['nombre']));
	    		$new_row['direccion']=htmlentities(stripslashes($row['direccion']));
        		$new_row['telefono']=htmlentities(stripslashes($row['telefono']));
        		$new_row['email']=htmlentities(stripslashes($row['email']));
        		$new_row['contacto']=htmlentities(stripslashes($row['nombre_contacto']));
        		$row_set[] = $new_row; 
			}
			return $row_set;					
		}
	}

	function get_cantidad_slides(){
		return $this->db->count_all('slider');
	}

	function get_last_id(){
		$this->db->select('id');
		$this->db->from('fecha_banda');
		$this->db->order_by('id','desc');
		$this->db->limit(1);
		$query = $this->db->get();
		
		if($query->num_rows > 0){
			foreach ($query->result_array() as $row){
        		$result = $row['id']; 
			}
			return $result;			
		}

	}	

	function insertar_slider($id_fecha_banda,$imagen){
		
		$this->db->trans_start();

		$datos = array(
		   'id_fecha_banda' => $id_fecha_banda,
		   'imagen' => $imagen
		);

		$this->db->insert('slider', $datos);

		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}
		else{
			return true;
		}
	}

	function modificar_slider($posicion,$id_fecha_banda,$imagen){

		$this->db->trans_start();

		$data = array(
           'id_fecha_banda' => $id_fecha_banda,
           'imagen' => $imagen
        );

		$this->db->where('id',$posicion);
		$this->db->limit(1);
		$this->db->update('slider', $data); 

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}
		else{
			return true;
		}
		
	}

	function get_slider_imagen(){
		$this->db->select('imagen');
		$this->db->from('slider');
		$slider = $this->db->get();
		return $slider->result_array();
	}


	function get_info_slider(){
		$this->db->select('slider.id AS `sid`, slider.id_fecha_banda, fecha_banda.id AS `fbid`, fecha_banda.id_banda, fecha_banda.id_fecha, fecha.id AS `fid`, fecha.nombre AS `fecnom` ,fecha.dia, fecha.hora, fecha.id_lugar, lugar.id AS `lid`, lugar.nombre AS `lugnom`');
		$this->db->from('slider');
		$this->db->join('fecha_banda', 'fecha_banda.id = slider.id_fecha_banda');
		/*$this->db->join('banda', 'banda.id = fecha_banda.id_banda');*/
		$this->db->join('fecha', 'fecha.id = fecha_banda.id_fecha');
		$this->db->join('lugar', 'lugar.id = fecha.id_lugar');
		$this->db->order_by('sid', 'asc');
		$slider = $this->db->get();
		return $slider->result_array();
	}


	function get_info_agenda(){
		$this->db->select('fecha.id AS `fid`, fecha.nombre AS `fecnom` ,fecha.dia, fecha.hora, fecha.imagen, fecha.id_lugar, lugar.id AS `lid`, lugar.nombre AS `lugnom`');
		$this->db->from('fecha');
		$this->db->join('lugar', 'lugar.id = fecha.id_lugar');
		$this->db->where('dia >=',date("Y-m-d"));
		$this->db->order_by('fecha.dia','asc');
		$this->db->limit(16);
		$slider = $this->db->get();
		return $slider->result_array();
	}


	function get_banda($idbanda){
		$this->db->select('banda.id AS `bid`, banda.nombre AS `bannom`, banda.id_genero, banda.id_estado, banda.id_turno, banda.id_convocatoria, banda.id_pais, banda.id_provincia, banda.id_localidad, genero.id AS `gid`, genero.nombre AS `gennom`, estado.id AS `eid`, estado.nombre AS `estnom`, turno.id AS `tid`, turno.nombre AS `turnom`, convocatoria.id AS `cid`, convocatoria.tipo, paises.id AS `paisid`, paises.nombre AS `paisnombre`, provincia.id AS `provinciaid`, provincia.nombre AS `provincianombre`, localidad.id AS `localidadid`, localidad.nombre AS `localidadnombre`');
		$this->db->from('banda');
		$this->db->join('genero', 'genero.id = banda.id_genero');	
		$this->db->join('estado', 'estado.id = banda.id_estado');
		$this->db->join('turno', 'turno.id = banda.id_turno');
		$this->db->join('convocatoria', 'convocatoria.id = banda.id_convocatoria');
		$this->db->join('paises', 'paises.id = banda.id_pais');
		$this->db->join('provincia', 'provincia.id = banda.id_provincia');
		$this->db->join('localidad', 'localidad.id = banda.id_localidad');

		$this->db->where('banda.id',$idbanda);
		$banda = $this->db->get();
		return $banda->result();
	}

	function get_banda_contacto($idbanda){
		$this->db->select('banda_contacto.id, banda_contacto.nombre, banda_contacto.telefono, banda_contacto.contacto, banda_contacto.id_banda');
		$this->db->from('banda_contacto');	
		$this->db->where('id_banda',$idbanda);
		$banda_contacto = $this->db->get();
		return $banda_contacto->result();
	}

	function get_banda_media($idbanda){
		$this->db->select('banda_media.id AS `bcid`, banda_media.media, banda_media.url, banda_media.id_banda, media.id AS `mid`, media.nombre');
		$this->db->from('banda_media');
		$this->db->join('media', 'media.id = banda_media.media');
		
		$this->db->where('id_banda',$idbanda);
		
		$banda_media = $this->db->get();
		return $banda_media->result();
	}



	function modificar_banda($idbanda,$nombre,$id_genero,$id_pais,$id_provincia,$id_localidad,$c1,$c2,$media,$urls,$convocatoria,$turno,$estado,$confirmada){

		$this->db->trans_start();

		$datos = array(
		   'nombre' => $nombre,
		   'id_genero' => $id_genero,
		   'id_pais' => $id_pais,
		   'id_provincia' => $id_provincia,
		   'id_localidad' => $id_localidad,
		   'id_convocatoria' => $convocatoria,
		   'id_turno' => $turno,
		   'id_estado' => $estado,
		   'confirmada' => $confirmada
		);

		$this->db->where('id',$idbanda);
		$this->db->limit(1);
		$this->db->update('banda', $datos);


		$datos = array(
		   'nombre' => $c1[0],
		   'telefono' => $c1[1],
		   'contacto' => $c1[2],
		   'id_banda' => $idbanda
		);

		$this->db->where('id_banda',$idbanda);
		$this->db->delete('banda_contacto');

		$this->db->insert('banda_contacto',$datos);

		if(sizeof($c2) > 0){

			$datos = array(
			   'nombre' => $c2[0],
			   'telefono' => $c2[1],
			   'contacto' => $c2[2],
			   'id_banda' => $idbanda
			);

			$this->db->insert('banda_contacto', $datos);
		}

		if(sizeof($media) > 0){

			$this->db->where('id_banda',$idbanda);
			$this->db->delete('banda_media');

			for ($i=0; $i < sizeof($media); $i++) { 
				$datos = array(
					'media' => $media[$i],
					'url' => $urls[$i],
					'id_banda' => $idbanda
				);
				$this->db->insert('banda_media', $datos);	
			}
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}
		else{
			return true;
		}
	}


	function get_lugar($idlugar){
		$this->db->select('*');
		$this->db->from('lugar');
		$this->db->where('id',$idlugar);
		$this->db->limit(1);
		$banda = $this->db->get();
		return $banda->result();
	}


	function modificar_lugar($idlugar,$nombre,$direccion,$telefono,$email,$contacto){

		$this->db->trans_start();

		$data = array(
           'nombre' => $nombre,
           'direccion' => $direccion,
           'telefono' => $telefono,
           'email' => $email,
           'nombre_contacto' => $contacto
        );

		$this->db->where('id',$idlugar);
		$this->db->limit(1);
		$this->db->update('lugar', $data); 

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}
		else{
			return true;
		}
	}



	function get_genero($idgenero){
		$this->db->select('*');
		$this->db->from('genero');
		$this->db->where('id',$idgenero);
		$this->db->limit(1);
		$genero = $this->db->get();
		return $genero->result();
	}


	function modificar_genero($idgenero,$nombre){

		$this->db->trans_start();

		$data = array(
           'nombre' => $nombre,
        );

		$this->db->where('id',$idgenero);
		$this->db->update('genero', $data); 

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}
		else{
			return true;
		}
	}


	function eliminar_genero($idgenero){

		$this->db->trans_start();

		$this->db->where('id',$idgenero);
		$this->db->delete('genero'); 

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}
		else{
			return true;
		}
	}

	function eliminar_lugar($idlugar){

		$this->db->trans_start();

		$this->db->where('id',$idlugar);
		$this->db->delete('lugar'); 

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}
		else{
			return true;
		}
	}

	function eliminar_banda($idbanda){

		$this->db->trans_start();

		$this->db->where('id',$idbanda);
		$this->db->delete('banda'); 

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}
		else{
			return true;
		}
	}


	 function eliminar_fecha($idfecha){

	 	$this->db->trans_start();

		$this->db->where('id',$idfecha);
		$this->db->delete('fecha');

		$this->db->where('id_fecha',$idfecha);
		$this->db->delete('fecha_banda');

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}
		else{
			return true;
		}

	 }

	 function get_tieneslider($idfecha){
	 	$this->db->select('fecha.id AS `fid`, fecha_banda.id AS `fbid`, fecha_banda.id_fecha, slider.id AS `sid`');
		$this->db->from('fecha');
		$this->db->join('fecha_banda','fecha_banda.id_fecha = fecha.id');
		$this->db->join('slider','slider.id_fecha_banda = fecha_banda.id');
		$this->db->where('fecha.id',$idfecha);
		//$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() == 1)
			return true;
		else
			return false;
		
	 }

	 function eliminar_slider($idfecha){

	 	$this->db->trans_start();

		$this->db->where('id',$idfecha);
		$this->db->delete('fecha');

		$this->db->where('id_fecha',$idfecha);
		$this->db->delete('fecha_banda');

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}
		else{
			return true;
		}

	 }





	function get_fecha($idfecha){
		$this->db->select('fecha.id AS `fid`,fecha.nombre,fecha.dia,fecha.hora,fecha.imagen AS `fimagen`,fecha.id_lugar');
		$this->db->from('fecha');
		$this->db->where('id',$idfecha);
		$this->db->limit(1);
		$banda = $this->db->get();
		return $banda->result();
	}

	function get_fecha_bandas($idfecha){
		$this->db->select('fecha_banda.id AS `fbid`, fecha_banda.id_fecha, fecha_banda.id_banda, banda.id AS `bid`, banda.nombre');
		$this->db->from('fecha_banda');
		$this->db->join('banda', 'banda.id = fecha_banda.id_banda');
		$this->db->where('id_fecha',$idfecha);
		$banda = $this->db->get();
		return $banda->result();
	}

	function get_fecha_slider($idfecha){
		$this->db->select('fecha.id AS `fid`,fecha.nombre,fecha.dia,fecha.hora,fecha.imagen AS `fimagen`,fecha.id_lugar,fecha_banda.id AS `fbid`, fecha_banda.id_fecha, slider.id AS `sid`, slider.id_fecha_banda, slider.imagen AS `simagen`');
		$this->db->from('fecha');
		$this->db->join('fecha_banda', 'fecha_banda.id_fecha = fecha.id');
		$this->db->join('slider', 'slider.id_fecha_banda = fecha_banda.id');
		$this->db->where('fecha.id',$idfecha);
		//$this->db->limit(1);
		$banda = $this->db->get();
		return $banda->result();
	}



	function get_convocatoria(){
		$this->db->select('*');
		$this->db->from('convocatoria');
		$convocatoria = $this->db->get();
		return $convocatoria->result();
	}

	function get_turnos(){
		$this->db->select('*');
		$this->db->from('turno');
		$turno = $this->db->get();
		return $turno->result();
	}

	function get_bandaestado(){
		$this->db->select('*');
		$this->db->from('estado');
		$estado = $this->db->get();
		return $estado->result();
	}

	function get_bandassinconfirmar(){
		$this->db->select('*');
		$this->db->from('banda');
		$this->db->where('confirmada','0');
		$estado = $this->db->get();
		return $estado->result();
	}

	function get_bandassinturno(){
		$this->db->select('*');
		$this->db->from('banda');
		$this->db->where('id_turno','1');
		$estado = $this->db->get();
		return $estado->result();
	}

	function get_bandassinconvocatoria(){
		$this->db->select('*');
		$this->db->from('banda');
		$this->db->where('id_convocatoria','1');
		$estado = $this->db->get();
		return $estado->result();
	}


	/*function enviarEmailVerificacion($email,$codigo_verificacion){
		$this->load->library('email');

		$config = Array(
			  'protocol' => 'smtp',
			  'smtp_host' => 'smtp.javierpacharotti.com.ar',
			  'smtp_port' => 465,
			  'smtp_user' => 'contacto@javierpacharotti.com.ar', // change it to yours
			  'smtp_pass' => '124578369', // change it to yours
			  'mailtype' => 'html',
			  'charset' => 'iso-8859-1',
			  'wordwrap' => TRUE
		);
		
		
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('contacto@javierpacharotti.com.ar', "Podopraxis");
		$this->email->to($email);		
		$this->email->subject("E-mail de Verificación de cuenta");
		$this->email->message("Estimado usuario,\nHaga click en el enlace de abajo o peguelo en su navegador para verificar su cuenta de correo\n\n http://www.javierpacharotti.com.ar/podopraxis/verificacion/".$codigo_verificacion."\n"."\n\Gracias\nPodopraxis");
		$this->email->send();    
		
	}

	function verificarEmail($codigo_verificacion){
		
		$this->db->select('verificacion');
		$this->db->from('usuario');
		$this->db->where('verificacion',$codigo_verificacion);
		$this->db->limit(1);
	   	$query = $this->db->get();



	   	if($query->num_rows() == 1){
	   		$datos = array(
               'estado' => 1
            );
			$this->db->where('verificacion',$codigo_verificacion);
			$this->db->update('usuario', $datos); 
			return true;	
	   	}else{
	   		return false;
	   	}


	}*/
	

}	
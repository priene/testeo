<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";

$route['inicio'] = "home/index";
$route['nosotros'] = "home/nosotros";
$route['calendario'] = "home/calendario";
$route['bandas'] = "home/bandas";
$route['registrobanda'] = "home/registrobanda";
$route['contacto'] = "home/contacto";

$route['calendario_criterio/(:any)'] = "home/calendario_criterio/$1";

$route['registrarse'] = "home/registrarse";
$route['registrarse_validar'] = "home/registrarse_validar";
$route['mensajemail'] = "home/mensajemail";
$route['login'] = "home/login";

$route['menulogin'] = "home/menulogin";
$route['logout'] = "home/logout";
$route['ingresar'] = "home/ingresar";
$route['menulogin'] = "home/menulogin";

$route['confirmarbandas'] = "home/confirmarbandas";
$route['definirturnos'] = "home/definirturnos";
$route['definirconvocatorias'] = "home/definirconvocatorias";

$route['ingresar_fecha'] = "home/ingresar_fecha";
$route['validar_ingresar_fecha'] = "home/validar_ingresar_fecha";
$route['validar_buscar_fecha'] = "home/validar_buscar_fecha";
$route['modificar_fecha/(:any)'] = "home/modificar_fecha/$1";
$route['validar_modificar_fecha'] = "home/validar_modificar_fecha";
$route['ver_bandas/(:any)'] = "home/ver_bandas/$1";

$route['ingresar_banda'] = "home/ingresar_banda";
$route['validar_ingresar_banda'] = "home/validar_ingresar_banda";
$route['validar_buscar_banda'] = "home/validar_buscar_banda";
$route['modificar_banda/(:any)'] = "home/modificar_banda/$1";
$route['verinfo_banda/(:any)'] = "home/verinfo_banda/$1";
$route['validar_modificar_banda'] = "home/validar_modificar_banda";

$route['ingresar_lugar'] = "home/ingresar_lugar";
$route['validar_ingresar_lugar'] = "home/validar_ingresar_lugar";
$route['validar_buscar_lugar'] = "home/validar_buscar_lugar";
$route['modificar_lugar/(:any)'] = "home/modificar_lugar/$1";
$route['validar_modificar_lugar'] = "home/validar_modificar_lugar";

$route['ingresar_genero'] = "home/ingresar_genero";
$route['validar_ingresar_genero'] = "home/validar_ingresar_genero";
$route['modificar_genero/(:any)'] = "home/modificar_genero/$1";
$route['validar_modificar_genero'] = "home/validar_modificar_genero";

$route['eliminar/(:any)/(:num)'] = "home/eliminar/$1/$2";

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
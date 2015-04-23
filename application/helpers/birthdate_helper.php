<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('buildDayDropdown'))
{
    function buildDayDropdown($name='',$value='')
    {
        $days = range(1, 31);
		$day_list[''] = 'Día';
        foreach($days as $day)
        {
            $day_list[$day] = $day;
        } 		
        return form_dropdown($name, $day_list, $value);
    }
}	

if ( !function_exists('buildYearDropdown'))
{
	function buildYearDropdown($name='',$value='')
    {        
        $years = range(1922, date("Y"));
		$year_list[''] = 'Año';
        foreach($years as $year)
        {
            $year_list[$year] = $year;
        }    
        
        return form_dropdown($name, $year_list, $value);
    }
}

if (!function_exists('buildMonthDropdown'))
{
    function buildMonthDropdown($name='',$value='')
    {
        $month=array(
			''	=>'Mes',
            '01'=>'Enero',
            '02'=>'Febrero',
            '03'=>'Marzo',
            '04'=>'Abril',
            '05'=>'Mayo',
            '06'=>'Junio',
            '07'=>'Julio',
            '08'=>'Agosto',
            '09'=>'Septiembre',
            '10'=>'Octubre',
            '11'=>'Noviembre',
            '12'=>'Diciembre');
        return form_dropdown($name, $month, $value);
    }
}
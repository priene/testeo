<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

function dia($numero_dia){
    switch ($numero_dia) {
    case 1:
        return "Domingo";
        break;
    case 2:
        return "Lunes";
        break;
    case 3:
        return "Martes";
        break;
    case 4:
        return "Miercoles";
        break;
    case 5:
        return "Jueves";
        break;
    case 6:
        return "Viernes";
        break;
    case 7:
        return "Sabado";
        break;
    }
}
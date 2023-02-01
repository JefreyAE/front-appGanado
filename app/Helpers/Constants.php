<?php

namespace App\Helpers;

/**
 * Description of Constants
 *
 * @author Jefrey
 */
class Constants {
   
    var $urlAPI;
    public function __construct() {
         //Modidificar esta variable para especificar la ruta de la API
         //$this->urlAPI = 'http://apirestlaravel.erpsolutionscr.com';
         $this->urlAPI ='http://localhost/back-appGanado/public';
    }
    
    public function url(){
        return $this->urlAPI;
    }
}

<?php
//ini_set('error_reporting', 'E_ALL & ~E_NOTICE & ~E_STRICT');
ini_set('default_charset', 'windows-1250');


  // if (($_SERVER[PHP_AUTH_PW]!='')&&($_GET['nahled']!='ano')) 
if ((($overeni==true) || ($superadmin==true))&&($_GET['nahled']!='ano'))   
   {
  require 'stara_hlavicka_do admina.php';;	
    } 
    else {
require 'hlavicka_nova_do_front.php';    
    
     }
 ?>


<?php
ini_set('default_charset', 'windows-1250');
if (isset($_GET["style"])) 
{ 
  setcookie("style",$_GET["style"],time()+60*60*24*10,"/"); 
} 
if (file_exists ('fce.php')) $funkce='fce.php';
        elseif(file_exists ('../fce.php')) $funkce='../fce.php';
        else $funkce='../../fce.php';
require"$funkce";
//$aktualnistyl=loadStyle();
//echo "$aktualnistyl " ;


require 'adresawebu.php';
$adresacssstary=$adresawebu.'stilhl.css';


echo"
<!DOCTYPE html>\n

<html lang=\"cs\">\n
 <head>\n 

 <meta charset=\"windows-1250\" />\n
 <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" /> 
<meta  name=\"description\" content=\"Gymnázium Dr.J.Pekaøe  Mladá Boleslav\" >\n 
<meta  name=\"keywords\" content=\"škola,výuka,žák,uèitel\" >\n  
<link rel=\"shortcut icon\" href=\"http://www.pekargmb.cz/favicon.ico\" type=\"image/x-icon\" >\n 
  
  
  ";
 echo"<link href=\"$adresacssstary\" type=\"text/css\" rel=\"stylesheet\" >";

$b=obsah_adresare();
                         
echo"  
  <title>Gymnázium Dr.J.Pekaøe</title> \n
 
  </head>\n 
 
  ";
 
echo"  
 <body  class=\"celek\" > 
 
  <div   id=\"stred\">
  ";
 
  
  echo"
  <div id=\"obrazeklogo\">";
  
  $polozkaaj=$adresawebu.'ang_gympl/';$adresavlajky=$adresawebu.'obr/en.gif';
  $polozkanj=$adresawebu.'de_gympl/';$adresavlajkyne=$adresawebu.'obr/de.gif';
echo"<div class=\"jazyky\"><!-- <a href=\"$polozkanj\" class=\"tlacitkomenu_vl\"><img src=\"$adresavlajkyne\" alt=\"de.gif, 1 kB\" title=\"Deutsch\" widtht=\"26\" height=\"15\" class=\"bezramecku\"/></a> --><a href=\"$polozkaaj\" class=\"tlacitkomenu_vl\"> <img src=\"$adresavlajky\" alt=\"uk.gif, 1 kB\" title=\"English\" widtht=\"26\" height=\"15\" class=\"bezramecku\"/></a> </div><!-- jazyky --> ";
  
  echo"  

 </div><!--  obrázek logo --> 
 ";
 ?>


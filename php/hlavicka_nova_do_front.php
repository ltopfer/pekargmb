<?php
ini_set('default_charset', 'windows-1250');
require 'adresawebu.php';
$adresacss=$adresawebu.'theme/novy2018/stilhl-implic2.css';
$adresacssstary=$adresawebu.'stilhl.css';
if (file_exists ('fce.php')) $funkce='fce.php';
        elseif(file_exists ('../fce.php')) $funkce='../fce.php';
        else $funkce='../../fce.php';
require"$funkce";
echo"
<!doctype html>
<html>

    <head>


        <!--<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\" >-->
        <meta charset=\"windows-1250\">

        <meta lang=\"cs\" name=\"Description\" content=\"Gymn�zium Dr.J.Peka�e  Mlad� Boleslav\" >

         <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\">

        <meta lang=\"cs\" name=\"Keywords\" content=\"�kola,v�uka,��k,u�itel\" >

        <link rel=\"shortcut icon\" href=\"http://www.pekargmb.cz/favicon.ico\" type=\"image/x-icon\" >
       ";
  echo"<link href=\"$adresacss\" type=\"text/css\" rel=\"stylesheet\" >"; 
       
       echo"
        <link href=\"https://fonts.googleapis.com/css?family=Open+Sans:300,700\" rel=\"stylesheet\">
       
        
        <title>Gymn�zium Dr.J.Peka�e</title>
        
        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js\"></script>
        <script>
            // obecn�
            $(document).ready(function() {
                if(window.location.hash) {
                $(\".podmenu\").addClass(\"otevrenopod\");
                }
                
                $(\"#menuButton\").click(function() {
                    $(\"#menu\").toggleClass(\"otevreno\");
                });
                
                $(\".podmenu h2\").click(function() {
                    $(\".podmenu\").toggleClass(\"otevrenopod\");
                });
                
                $(\".textmenul_akt\").click(function() {
                    $(\"#menu\").removeClass(\"otevreno\");
                });
            });
        
        </script>

    </head>
    
    <body class=\"celek\" >
 
        <div id=\"header\">
            <div id=\"top-header\">
                <a href=\"$adresawebu\"><img src=\"{$adresawebu}obr/logomenu.png\" id=\"logomenu\"><h1>GYMN�ZIUM <strong>DR. JOSEFA PEKA�E</strong></h1></a>
               
            </div>";
 ?>


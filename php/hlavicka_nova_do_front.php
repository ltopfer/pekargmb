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

        <meta lang=\"cs\" name=\"Description\" content=\"Gymnázium Dr.J.Pekaře  Mladá Boleslav\" >

         <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\">

        <meta lang=\"cs\" name=\"Keywords\" content=\"škola,výuka,žák,učitel\" >

        <link rel=\"shortcut icon\" href=\"http://www.pekargmb.cz/favicon.ico\" type=\"image/x-icon\" >
       ";
  echo"<link href=\"$adresacss\" type=\"text/css\" rel=\"stylesheet\" >"; 
       
       echo"
        <link href=\"https://fonts.googleapis.com/css?family=Open+Sans:300,700\" rel=\"stylesheet\">
       
        
        <title>Gymnázium Dr.J.Pekaře</title>
        
        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js\"></script>
        <script>
            // obecné
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
        
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src=\"https://www.googletagmanager.com/gtag/js?id=UA-115476559-1\"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-115476559-1');
</script>

<script>
/**
* Function that tracks a click on an outbound link in Analytics.
* This function takes a valid URL string as an argument, and uses that URL string
* as the event label. Setting the transport method to 'beacon' lets the hit be sent
* using 'navigator.sendBeacon' in browser that support it.
*/
var trackOutboundLink = function(a) {
  var url = $(a).attr('href');
  
  gtag('event', 'click', {
    'event_category': 'outbound',
    'event_label': url,
    'transport_type': 'beacon'
  });
  window.open(url);
}
</script>


    </head>
    
    <body class=\"celek\" >
 
        <div id=\"header\">
            <div id=\"top-header\">
                <a href=\"$adresawebu\"><img src=\"{$adresawebu}obr/logomenu.png\" id=\"logomenu\"><h1>GYMNÁZIUM <strong>DR. JOSEFA PEKAŘE</strong></h1></a>
               
            </div>";
 ?>


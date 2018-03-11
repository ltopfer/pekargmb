<?php
ini_set('default_charset', 'windows-1250');
require 'adresawebu.php';
$adresacss=$adresawebu.'theme/novy2018/stilhl-implic2.css';
$adresacssstary=$adresawebu.'stilhl.css';
echo"
<!doctype html>
<html>

    <head>


        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\" >
        <meta charset=\"windows-1250\">

        <meta lang=\"cs\" name=\"Description\" content=\"Gymnázium Dr.J.Pekaře  Mladá Boleslav\" >

         <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\">

        <meta lang=\"cs\" name=\"Keywords\" content=\"škola,výuka,žák,učitel\" >

        <link rel=\"shortcut icon\" href=\"http://www.pekargmb.cz/favicon.ico\" type=\"image/x-icon\" >
       ";
  echo"<link href=\"$adresacss\" type=\"text/css\" rel=\"stylesheet\" >"; 
       
       echo"

       
        
        <title>Gymnázium Dr.J.Pekaře</title>
        
        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js\"></script>
        <script>
            var moveTime = 8;
            var timer = 0;
            var countTimer = true;
            var novinky_index;
            var pocet = 0;
            var prvni = 0;

            $(document).ready(function() {
                setInterval(function() {
                    if(countTimer) {
                        timer++;
                        //$(\"#top-header\").html(timer);
                    }

                    if(timer >= moveTime) {
                        moveSlider(1);
                    }
                }, 1000);    

                $(\".novinka_index\").mouseenter(function() {
                    countTimer = false;
                });
                $(\".novinka_index\").mouseleave(function() {
                    countTimer = true;
                });
                
                $(\"#sipkal\").click(function() {
                    moveSlider(-1);
                });
                $(\"#sipkap\").click(function() {
                    moveSlider(1);
                });
                
                start();
                //timer = moveTime - 3;                
            });
                
                function start() {
                    novinky_index = $(\"#novinky_index\").find(\".novinka_index\");
                    pocet = novinky_index.length;
                    moveSlider(0);
                }
                    
                
                function moveSlider(posun) {
                    prvni = prvni + posun;

                    timer = 0;
                    
                    $(novinky_index[cyklindex(prvni+0)]).removeClass().addClass(\"novinka_index n1\");
                    $(novinky_index[cyklindex(prvni+1)]).removeClass().addClass(\"novinka_index n2\");
                    $(novinky_index[cyklindex(prvni+2)]).removeClass().addClass(\"novinka_index n3\");
                    
                    for (i = 3; i < pocet - 1; i++)
                    {
                        $(novinky_index[cyklindex(prvni+i)]).removeClass().addClass(\"novinka_index n4\");
                    }
                    $(novinky_index[cyklindex(prvni+pocet-1)]).removeClass().addClass(\"novinka_index n0\");
                }
            
            function cyklindex(index)
            {
                index = index % pocet;
                if(index < 0)
                    index += pocet;
                return index;
            }
        
        </script>

    </head>
    
    <body class=\"celek\" >
 
        <div id=\"header\">
            <div id=\"top-header\">
                <a href=\"$adresawebu\"><img src=\"{$adresawebu}obr/logomenu.png\" id=\"logomenu\"></a><h1>GYMNÁZIUM <strong>DR. JOSEFA PEKAŘE</strong></h1><div id=\"odkazy\"><a href=\"ang_gympl/index.php\"><img  id=\"gb\" src=\"{$adresawebu}obr/gb.png\"></a><a href=\"https://www.facebook.com/pekargmb\"><img class=\"odkaz\" src=\"{$adresawebu}obr/fb-art.png\"></a><a href=\"{$adresawebu}rss/rss_nanoivinky.php\"><img class=\"odkaz\" src=\"{$adresawebu}obr/Feed-icon.svg\"></a><a href=\"{$adresawebu}pro_vyhledavani/pro_vyhledavani.php\"><img class=\"odkaz\" src=\"{$adresawebu}obr/50744-200.png\"></a>
                </div>
            </div>";
 ?>


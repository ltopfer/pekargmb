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

        <meta lang=\"cs\" name=\"Description\" content=\"Gymn�zium Dr.J.Peka�e  Mlad� Boleslav\" >

         <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\">

        <meta lang=\"cs\" name=\"Keywords\" content=\"�kola,v�uka,��k,u�itel\" >
         <meta name=\"theme-color\" content=\"#fcbb23\">

        <link rel=\"shortcut icon\" href=\"http://www.pekargmb.cz/favicon.ico\" type=\"image/x-icon\" >
       ";
  echo"<link href=\"$adresacss\" type=\"text/css\" rel=\"stylesheet\" >"; 
       
       echo"

       
        
        <title>Gymn�zium Dr.J.Peka�e</title>
        
        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js\"></script>
        <script>
              // obecn�
            $(document).ready(function() {
                $(\"#menuButton\").click(function() {
                    $(\"#menu\").toggleClass(\"otevreno\");
                });
                
                // jen na hlavn� stran�
                hlstrana();
            });
            
            // hlstrana
            var moveTime = 8;
            var timer = 0;
            var countTimer = true;
            var novinky_index;
            var pocet = 0;
            var prvni = 0;

            function hlstrana() {
                if(window.innerWidth > 768)
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
                
                $(window).scroll(function() {
                    var scrolledY = $(window).scrollTop();
                    if(window.innerWidth <= 768)
                        $(\"#obrazek-pozadi\").css(\"margin-top\", 40 - scrolledY*0.3);
                    else
                        $(\"#obrazek-pozadi\").css(\"margin-top\", 75 - scrolledY*0.3);
                });
                
                start();
                //timer = moveTime - 3;                
            }
                
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
    
    <body>
 
        <div id=\"header\">
            <div id=\"top-header\">
                <a href=\"$adresawebu\"><img src=\"{$adresawebu}obr/logomenu.png\" id=\"logomenu\"><h1>GYMN�ZIUM <strong>DR. JOSEFA PEKA�E</strong></h1></a>
           
                
            </div>";
//require 'hlavicka.php';


require 'menu_do_indexu_bez_obsahove_casti.php';

require("cnovinky_pro_index/cnovinky.php");
$pro_seznam_novinek=new CRubrika_Foto('gympl_novinky');
$pocitadlo= $pro_seznam_novinek->PrictiJedna($ip_skoly);
$seznam_novinek= $pro_seznam_novinek->VyberSeznamNovinekAktualnich_S_Textem();
for ($i=0;$i<6 ;$i++ ) { 
$polozka[$i]=$adresawebu.'gympl_novinky/gympl_novinky.php?zobr='.$seznam_novinek[id][$i];
$odkaz[$i]="<a href=\"".$polozka[$i]."\">v�ce informac�</a>";

$adresafoto1[$i]='gympl_novinky/foto/'.$seznam_novinek[id][$i].'.jpg';

//$adresafoto2[$i]=$adresawebu.'gympl_novinky/foto/2_'.$seznam_novinek[id][$i].'.jpg';  

$nazev[$i]=$seznam_novinek[nadpis][$i];
$text_novinky[$i]=$seznam_novinek[text][$i];
$cast_text_novinky_s_odkazem[$i]=substr(strip_tags($text_novinky[$i]), 0, 65).'.....'.$odkaz[$i];
                                     }


  ?>         
       
        <span id="obrazek-pozadi">
        </span>
        <div id="novinky_index">
            <ul>
<?php             
for ($i=0;$i<6 ;$i++ ) {
echo"

 <li  class=\"novinka_index n1\"><span><h2><a href=\"{$polozka[$i]}\">{$nazev[$i]} </a></h2>
 <p>
{$cast_text_novinky_s_odkazem[$i]}
 </p></span>";
if (file_exists ($adresafoto1[$i]) ){
echo"<a href=\"{$polozka[$i]}\"><img src=\"".$adresafoto1[$i]."\"> </a>";
}
else {
echo"<a href=\"{$polozka[$i]}\"><img src=\"obr/1200px-Budova_Gymn%C3%A1zia_Dr._Josefa_Peka%C5%99e.jpg\"> </a>";
}

echo" </li> "; 

                                     }            
            
            
?>            
            </ul>
            <img src="obr/sipkal.png" id="sipkal">
            <img src="obr/sipkap.png" id="sipkap">
            <div id="novinky_index_vic">
<?php           
        echo"<a href=\"gympl_novinky/gympl_novinky.php\">v�ce novinek</a>";    
?>              
            </div>
        </div>
 <div id="outer_page">
            <div id="page">
                <h2 id="tradice">Usp�n� v tradici<br> kvalitn�ho vzd�l�v�n�</h2>
                <p id="typy_studia_p">�kola s t�istaletou tradic� pojmenovan� po&nbsp;v�znamn�m historikovi poskytuje st�edo�kolsk� vzd�l�n� zakon�en� maturitn� zkou�kou v&nbsp;t�chto studijn�ch oborech: </p>
                <ul id="typy_studia">
                    <li><b>osmilet� studium</b> pro ��ky, kte�� ukon�ili 5. t��du Z� 
                    </li>
                    <li><b>�ty�let� studium</b> pro ��ky, kte�� ukon�ili 9. t��du Z� </li>
                </ul>
                <div id="busta"><img src="obr/busta.jpg" width=100%><i>Prof. Dr. J. Peka�<br>1870-1937</i></div>
                <h2 id="conabizime">Co nab�z�me</h2>
                <div id="nabidky">                    
                    <div class="nabidka prvni">
                        <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/diploma.svg" width="50px">
                                
                            </div>

                            <div class="zadni">
                                <p class="karta-text-dlouhy">V�estrann� st�edo�kolsk� vzd�l�n� ukon�en� maturitou</p>
                                <p class="karta-text-kratky">Maturita</p>
                                <a href="">v�ce informac�</a>
                            </div>
                        </div>
                    </div>
                    <div class="nabidka druha">
                         <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/books.svg" width="50px">
                                
                            </div>

                            <div class="zadni">
                                <p class="karta-text-dlouhy">knihovnu s ��t�rnou a studovnou</p>
                                <p class="karta-text-kratky">Knihovna</p>
                                <a href="">v�ce informac�</a>
                            </div>
                        </div>
                    </div>
                     <div class="nabidka prvni">
                          <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/cutlery%20(1).svg" width="50px">
                                
                            </div>

                            <div class="zadni">
                                <p class="karta-text-dlouhy">ob�dy ve vlastn� �koln� j�deln� a ob�erstven� ve �koln�m kiosku</p>
                                <p class="karta-text-kratky">�koln� j�delnu</p>
                                <a href="">v�ce informac�</a>
                            </div>
                        </div>
                    </div>
                    <div class="nabidka druha">
                          <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/basketball%20(1).svg" width="50px">
                                
                            </div>

                            <div class="zadni">
                                <p class="karta-text-dlouhy">v�born�podm�nky pro t�lesnou v�chovu a sportovn� �innist</p>
                                <p class="karta-text-kratky">Sport</p>
                                <a href="">v�ce informac�</a>
                            </div>
                        </div>
                    </div>
                    <div class="nabidka treti">
                          <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/school.svg" width="50px">
                                
                            </div>

                            <div class="zadni">
                                <p class="karta-text-dlouhy">spolupr�ce se �kolami ve Francii, N�mecku a Slovensku</p>
                                <p class="karta-text-kratky">Zahrani�n� spolupr�ce</p>
                                <a href="">v�ce informac�</a>
                            </div>
                        </div>
                    </div>
                    <div class="nabidka ctvrta">
                          <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/blackboard.svg" width="50px">
                                
                            </div>

                            <div class="zadni">
                                <p class="karta-text-dlouhy">v�uku ciz�ch jazyk� ve skupin�ch rozd�len�ch podle �rovn� znalost�</p>
                                <p class="karta-text-kratky">V�uka ciz�ch jazyk�</p>
                                <a href="">v�ce informac�</a>
                            </div>
                        </div>
                    </div>
                    <div class="nabidka treti">
                         <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/panels.svg" width="50px">
                               
                            </div>

                            <div class="zadni">
                                <p class="karta-text-dlouhy">profilaci studia prost�ednictv�m voliteln�ch p�edm�t�</p>
                                <p class="karta-text-kratky">Profilace studia</p>
                                <a href="">v�ce informac�</a>
                            </div>
                        </div>
                    </div>
                    <div class="nabidka ctvrta">
                        <div class="karta">
                                <div class="predni">
                                    <img class="nabidka_ikona" src="obr/ikony/mortarboard.svg" width="50px">
                                    
                                </div>

                                <div class="zadni">
                                    <p class="karta-text-dlouhy">p��pravu pro studium na v�ech typek vy���ch odborn�ch �kol a vysok�ch �kol</p>
                                    <p class="karta-text-kratky">P��prava na V�</p>
                                    <a href="">v�ce informac�</a>
                                </div>
                        </div>
                    </div>
                    <div class="nabidka prvni">
                          <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/two-test-tubes.svg" width="50px">
                                
                            </div>

                            <div class="zadni">
                                <p class="karta-text-dlouhy">modern� specializovan� u�ebny, laborato�e a po��ta�ov� u�ebny</p>
                                <p class="karta-text-kratky">Modern� vybaven� u�ebny</p>
                                <a href="">v�ce informac�</a>
                            </div>
                        </div>
                    </div>
                    <div class="nabidka druha">
                         <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/solution.svg" width="50px">
                                
                            </div>

                            <div class="zadni">
                                <p class="karta-text-dlouhy">mo�nost bezplatn�ho psychologick�ho poradenstv� u �koln�ho psychologa</p>
                                <p class="karta-text-kratky">�koln� psycholog</p>
                                <a href="">v�ce informac�</a>
                            </div>
                        </div>
                    </div>
                    <div class="nabidka prvni">
                          <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/533356-entertainment.png" width="50px">
                               
                            </div>

                            <div class="zadni">
                                <p class="karta-text-dlouhy">mimo�koln� aktivity a kulturn�, sportovn� a po��ta�ov� krou�ky</p>
                                <p class="karta-text-kratky">Krou�ky</p>
                                <a href="">v�ce informac�</a>
                            </div>
                        </div>
                    </div>
                    <div class="nabidka druha">
                         <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/parlament.png" width="50px">
                                
                            </div>

                            <div class="zadni">
                                <p class="karta-text-dlouhy">mo�nost aktivn� se zapojit do fungov�n� �koly prost�ednictv�m studentsk�ho parlamentu</p>
                                <p class="karta-text-kratky">�koln� parlament</p>
                                <a href="">v�ce informac�</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="prohlidky">
                    <a href="historie_skoly.pdf"><img src="obr/h_odkaz.png" id="historie"></a>
                    <a href="http://pekar.uvadi.cz/index.swf"><img src="obr/v_prohlidka.png" id="prohlidka"></a>
                </div>
                <div id="spolupracujeme">
                    <a><img src="obr/kraj-znak.png" class="spoluprace_kraj"></a>
                    <a href="https://www.kr-stredocesky.cz/"><img src="obr/kraj.png" class="spoluprace_kraj"></a>
                    <h2>Bl�e spolupracujeme</h2>
                    <a href="http://talentovani.cz/stredocesky/"><img src="obr/str_cer.png" class="spoluprace_obrazek"></a>
                    <a href="http://deti.mensa.cz/index.php?pg=spolupracujici-skoly&cid=227"><img src="obr/mensa.png" class="spoluprace_obrazek"></a>
                    <a href="https://www.muni.cz/"><img src="obr/logopartner.gif" class="spoluprace_obrazek"></a>
                    <a href="http://www.remasystem.cz/zelena-skola/"><img src="obr/images.jpg" class="spoluprace_obrazek"></a>
                </div>
            </div>
        </div>
        <div id="outer_footer" class="footer_index">
            <div id="footer">
            <h4>Kontakty</h4>
                <img id="footer_logo" src="obr/logoskola-kruh.png">
                <p>Palack�ho 211<br>
                    29380 Mlad� Boleslav<br>
                    tel:&nbsp;326375951<br>
                    I�O:&nbsp;48683868<br>
                    pekargmb@pekargmb.cz<br>
                    �. ��tu �koly pro platby: <br class="neodebrat">
                    19&#8209;5779840267/0100
                </p>
                <div id="carka"></div>
                <iframe id="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2542.342389539517!2d14.904282115516343!3d50.4160920977214!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470955b9a6e1dcf1%3A0x9c598a8a9dfd43d2!2sGymn%C3%A1zium+Dr.+Josefa+Peka%C5%99e!5e0!3m2!1scs!2scz!4v1514132764272"frameborder="0" style="border:0" allowfullscreen></iframe></div>
        </div>
    </body>
</html>







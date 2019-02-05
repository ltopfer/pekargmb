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
         <meta name=\"theme-color\" content=\"#fcbb23\">

        <link rel=\"shortcut icon\" href=\"http://www.pekargmb.cz/favicon.ico\" type=\"image/x-icon\" >
       ";
  echo"<link href=\"$adresacss\" type=\"text/css\" rel=\"stylesheet\" >"; 
       
       echo"
        <link href=\"https://fonts.googleapis.com/css?family=Open+Sans:300,700\" rel=\"stylesheet\">
       
        
        <title>Gymnázium Dr.J.Pekaře</title>
        
        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js\"></script>
        <script>
            // obecné
            var open = false;

            $(document).ready(function() {
                $(\"#menuButton\").click(function() {
                    $(\"#menu\").toggleClass(\"otevreno\");
                });
                
                $(\"#rychlOdkazy\").mouseenter(function() {
                           if(!open)
                           {
                               $(this).addClass(\"rychlOdkazyOtevreno\");
                           }  
                });

                $(\"#rychlOdkazy\").mouseleave(function() {
                    if(!open)
                    {
                        $(this).removeClass(\"rychlOdkazyOtevreno\");
                    }
                });

                $(\"#rychlOdkazy\").click(function() {
                    if(!open)
                    {
                        open = true;
                        $(this).addClass(\"rychlOdkazyOtevreno\");
                    }
                    else
                    {
                        open = false;
                        $(this).removeClass(\"rychlOdkazyOtevreno\");    
                    }
                });

                $(\"#rychlOdkazy a\").click(function() {
                    var url = $(this).attr('href');

                    gtag('event', 'click', {
                        'event_category': 'rychlOdkazy',
                        'event_label': url,
                        'transport_type': 'beacon'
                    });
                });

                // jen na hlavní straně
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
                    msieversion();
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

            function msieversion() {
                var ua = window.navigator.userAgent;
                var msie = ua.indexOf(\"MSIE \");
                var safari = ua.indexOf(\"Safari\");
                var chrome = ua.indexOf(\"Chrome\");

                if (msie > -1 || !!navigator.userAgent.match(/Trident.*rv\:11\./) || (safari > -1 && chrome == -1))  // If Internet Explorer or Safari
                {
                    $('.nabidka').addClass('nabidkaIE').removeClass('nabidka');
                }
                else  // another browser
                {

                }

                return false;
            }                                           


        </script>
        <noscript><div id=\"warning\">Máte vypnutý JavaScript. Stránka se nemusí zobrazovat správne.</div></noscript>
        
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
    
    <body>
 
        <div id=\"header\">
            <div id=\"top-header\">
                <a href=\"$adresawebu\"><img src=\"{$adresawebu}obr/logomenu.png\" id=\"logomenu\"><h1>GYMNÁZIUM <strong>DR. JOSEFA PEKAŘE</strong></h1></a>
           
                
            </div>";
//require 'hlavicka.php';


require 'menu_do_indexu_bez_obsahove_casti.php';

require("cnovinky_pro_index/cnovinky.php");
$pro_seznam_novinek=new CRubrika_Foto('gympl_novinky');
$pocitadlo= $pro_seznam_novinek->PrictiJedna($ip_skoly);
$seznam_novinek= $pro_seznam_novinek->VyberSeznamNovinekAktualnich_S_Textem();

for ($i=0;$i<6 ;$i++ ) { 
$polozka[$i]=$adresawebu.'gympl_novinky/gympl_novinky.php?zobr='.$seznam_novinek[id][$i];
$odkaz[$i]="<a href=\"".$polozka[$i]."\">více informací";

$adresafoto1[$i]='gympl_novinky/foto/'.$seznam_novinek[id][$i].'.jpg';

//$adresafoto2[$i]=$adresawebu.'gympl_novinky/foto/2_'.$seznam_novinek[id][$i].'.jpg';  

$nazev[$i]=$seznam_novinek[nadpis][$i];
$text_novinky[$i]=$seznam_novinek[text][$i];
    
// detekce mobilu
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
    $cast_text_novinky_s_odkazem[$i]=substr(strip_tags($text_novinky[$i]), 0, 170).'&hellip;'.$odkaz[$i]; //mobil
else    
    $cast_text_novinky_s_odkazem[$i]=substr(strip_tags($text_novinky[$i]), 0, 90).'&hellip;'.$odkaz[$i]; // desktop
    
    
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
    echo"<a href=\"{$polozka[$i]}\"></a>";
}

echo" </li> "; 

                                     }            
            
            
?>            
            </ul>
            <img src="obr/sipkal.png" id="sipkal">
            <img src="obr/sipkap.png" id="sipkap">
            <div id="novinky_index_vic">
<?php           
        echo"<a href=\"gympl_novinky/gympl_novinky.php\">více novinek</a>";    
?>              
            </div>
        </div>
 <div id="outer_page">
            <div id="page">
                <h2 id="tradice">Uspěšní v tradici<br> kvalitního vzdělávání</h2>
                <p id="typy_studia_p">Škola s třistaletou tradicí pojmenovaná po&nbsp;významném historikovi poskytuje středoškolské vzdělání zakončené maturitní zkouškou v&nbsp;těchto studijních oborech: </p>
                <ul id="typy_studia">
                    <li><b>osmileté studium</b> pro žáky, kteří ukončili 5. třídu ZŠ 
                    </li>
                    <li><b>čtyřleté studium</b> pro žáky, kteří ukončili 9. třídu ZŠ </li>
                </ul>
                <div id="busta"><img src="obr/busta.jpg" width=100%><i>Prof. Dr. J. Pekař<br>1870-1937</i></div>
                <h2 id="conabizime">Co nabízíme</h2>
                <div id="nabidky">
                    <div class="nabidka prvni">
                        <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/diploma.svg" width="50px">
                            </div>

                            <div class="zadni">
                                <a href="organizace_studia/maturita_2017_18.php?ppmenu=maturita">
                                    <p class="karta-text-dlouhy">všestranné středoškolské vzdělání ukončené maturitou</p>
                                    <p class="karta-text-kratky">Maturita</p>
                                    <span class="vicinfo">více informací</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="nabidka druha">
                        <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/books.svg" width="50px">
                            </div>

                            <div class="zadni">
                                <a href="verejnost/prostory.php?ppmenu=prost&zobr=knihovna">
                                    <p class="karta-text-dlouhy">knihovnu s čítárnou a studovnou</p>
                                    <p class="karta-text-kratky">Knihovna</p>
                                    <span class="vicinfo">více informací</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="nabidka prvni">
                        <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/cutlery%20(1).svg" width="50px">
                            </div>

                            <div class="zadni">
                                <a href="organizace_studia/jidelna.php?ppmenu=jidelna">
                                    <p class="karta-text-dlouhy">obědy ve vlastní školní jídelně a občerstvení ve školním kiosku</p>
                                    <p class="karta-text-kratky">Školní jídelnu</p>
                                    <span class="vicinfo">více informací</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="nabidka druha">
                        <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/basketball%20(1).svg" width="50px">
                            </div>

                            <div class="zadni">
                                <a href="verejnost/prostory.php?ppmenu=prost&zobr=sport">
                                    <p class="karta-text-dlouhy">výborné podmínky pro tělesnou výchovu a sport</p>
                                    <p class="karta-text-kratky">Sport</p>
                                    <span class="vicinfo">více informací</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="nabidka treti">
                        <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/school.svg" width="50px">
                            </div>

                            <div class="zadni">
                                <a href="/projekty/partnerske_skoly.pdf" onclick="trackOutboundLink(this); return false;">
                                    <p class="karta-text-dlouhy">spolupráce se školami v Nemecku, Polsku, Francii a na Slovensku</p>
                                    <p class="karta-text-kratky">Zahraniční spolupráce</p>
                                    <span class="vicinfo">více informací</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="nabidka ctvrta">
                        <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/blackboard.svg" width="50px">
                            </div>

                            <div class="zadni">
                                <a href="">
                                    <p class="karta-text-dlouhy">výuku cizích jazyků ve skupinách rozdělených podle úrovně znalostí</p>
                                    <p class="karta-text-kratky">Výuka cizích jazyků</p>
                                    <span class="vicinfo">více informací</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="nabidka treti">
                        <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/panels.svg" width="50px">
                            </div>

                            <div class="zadni">
                                <a href="organizace_studia/osnovy_nab_vol_pr__2018_19.php?ppmenu=vol_pr">
                                    <p class="karta-text-dlouhy">profilaci studia prostřednictvím volitelných předmětů</p>
                                    <p class="karta-text-kratky">Profilace studia</p>
                                    <span class="vicinfo">více informací</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="nabidka ctvrta">
                        <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/mortarboard.svg" width="50px">
                            </div>

                            <div class="zadni">
                                <a href="organizace_studia/vs.php">
                                    <p class="karta-text-dlouhy">přípravu pro studium na všech typek vyšších odborných škol a vysokých škol</p>
                                    <p class="karta-text-kratky">Příprava na VŠ</p>
                                    <span class="vicinfo">více informací</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="nabidka prvni">
                        <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/two-test-tubes.svg" width="50px">
                            </div>

                            <div class="zadni">
                                <a href="verejnost/prostory.php?ppmenu=prost&zobr=ucebny">
                                    <p class="karta-text-dlouhy">specializované učebny, laboratoře a počítačové učebny</p>
                                    <p class="karta-text-kratky">Moderně vybavené učebny</p>
                                    <span class="vicinfo">více informací</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="nabidka druha">
                        <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/solution.svg" width="50px">

                            </div>

                            <div class="zadni">
                                <a href="gympl_psycholog/gympl_psycholog.php">
                                    <p class="karta-text-dlouhy">možnost bezplatného psychologického poradenství u školního psychologa</p>
                                    <p class="karta-text-kratky">Školní psycholog</p>
                                    <span class="vicinfo">více informací</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="nabidka prvni">
                        <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/533356-entertainment.png" width="50px">
                            </div>

                            <div class="zadni">
                                <a href="">
                                    <p class="karta-text-dlouhy">mimoškolní aktivity, kulturní, sportovní a počítačové kroužky</p>
                                    <p class="karta-text-kratky">Kroužky</p>
                                    <span class="vicinfo">více informací</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="nabidka druha">
                        <div class="karta">
                            <div class="predni">
                                <img class="nabidka_ikona" src="obr/ikony/parlament.png" width="50px">

                            </div>

                            <div class="zadni">
                                <a href="http://parlament.pekcloud.cz/" onclick="trackOutboundLink(this); return false;">
                                    <p class="karta-text-dlouhy">možnost aktivně se zapojit do fungování školy prostřednictvím studentského parlamentu</p>
                                    <p class="karta-text-kratky">Školní parlament</p>
                                    <span class="vicinfo">více informací</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="prohlidky">
                    <a href="historie_skoly.pdf" onclick="trackOutboundLink(this); return false;"><img src="obr/h_odkaz.png" id="historie"></a>
                    <a href="http://pekar.uvadi.cz/index.swf" onclick="trackOutboundLink(this); return false;"><img src="obr/v_prohlidka.png" id="prohlidka"></a>
                </div>
                <div id="spolupracujeme">
                    <a><img src="obr/kraj-znak.png" class="spoluprace_kraj"></a>
                    <a href="https://www.kr-stredocesky.cz/" onclick="trackOutboundLink(this); return false;"><img src="obr/kraj.png" class="spoluprace_kraj"></a>
                    <h2>Blíže spolupracujeme</h2>
                    <a href="http://talentovani.cz/stredocesky/" onclick="trackOutboundLink(this); return false;"><img src="obr/str_cer.png" class="spoluprace_obrazek"></a>
                    <a href="http://deti.mensa.cz/index.php?pg=spolupracujici-skoly&cid=227" onclick="trackOutboundLink(this); return false;"><img src="obr/mensa.png" class="spoluprace_obrazek"></a>
                    <a href="https://www.muni.cz/" onclick="trackOutboundLink(this); return false;"><img src="obr/logopartner.gif" class="spoluprace_obrazek"></a>
                    <a href="http://www.remasystem.cz/zelena-skola/" onclick="trackOutboundLink(this); return false;"><img src="obr/images.jpg" class="spoluprace_obrazek"></a>
                </div>
            </div>
        </div>
        <div id="outer_footer" class="footer_index">
            <div id="footer">
            <h4>Kontakty</h4>
                <img id="footer_logo" src="obr/logoskola-kruh.png">
                <p>Palackého 211<br>
                    29380 Mladá Boleslav<br>
                    tel:&nbsp;326375951<br>
                    IČO:&nbsp;48683868<br>
                    pekargmb@pekargmb.cz<br>
                    datová schránka: arsjhws<br>
                    č. účtu školy pro platby: <br class="neodebrat">
                    19&#8209;5779840267/0100
                </p>
                <div id="carka"></div>
                <iframe id="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2542.342389539517!2d14.904282115516343!3d50.4160920977214!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470955b9a6e1dcf1%3A0x9c598a8a9dfd43d2!2sGymn%C3%A1zium+Dr.+Josefa+Peka%C5%99e!5e0!3m2!1scs!2scz!4v1514132764272"frameborder="0" style="border:0" allowfullscreen></iframe>
                <span id="footer_autor">Design by <a href="https://github.com/mnauky94/" target="_blank">Töpfer</a>&amp;<a href="https://github.com/Mnaukal" target="_blank">Töpfer</a>, 2018</span> 
            </div>
        </div>
    </body>
</html>







<?php
header ("Pragma: no - cache");
header ("Cache-Control: no - cache, must - revalidate");
header("Expires: ".gmdate("D, d M Y H:i:s")." GMT");
if(!isset($_SERVER["PHP_AUTH_USER"])) {
    Header("WWW-Authenticate: Basic realm=\"Vypl�te jm�no a heslo\"");
    Header("HTTP/1.0 401 Unauthorized");
    echo "Vstup na str�nky p�eru�en";
    exit;
  } else {
 include 'cnovinky.php';
$pro_overeni=new CRubrika_Foto('gympl_fotogalerie',true);
$overeni=$pro_overeni->Overeni_uzivatele('gympl_uzivatele',$_SERVER[PHP_AUTH_USER],$_SERVER[PHP_AUTH_PW],'prava_novinky');
$superadmin=($_SERVER[PHP_AUTH_USER]==$superuser) && ($_SERVER[PHP_AUTH_PW]==$superpass) ; 
 if (!$overeni && !$superadmin){echo "Chybn� p�ihla�ovac� �daje, nebo nem�te pr�va upravovat tuto rubriku."; exit;}
          }
         

?><?php 
if($_SERVER[PHP_AUTH_PW]==$superpass && $_SERVER[PHP_AUTH_USER]==$superuser) 
{$prihlaseny=''; include 'hlavicka_admina.php'; }
   else {
   $prihlaseny=$_SERVER[PHP_AUTH_USER];
    include 'hlavicka_uzivatele.php';  
   
   }
 
echo"<h4>$kategorie_nazav $nazev_vyfiltrovane_polozky </h4>";

$akce=$_POST[akce];
$editakce=$_POST[editakce];
$oznvse=$_POST[oznvse];
$editakce=$_POST[editakce];
$editzaznam=$_POST[editzaznam];
$kohoeditovat=$_POST[kohoeditovat];
$codelat=$_POST[codelat];



$pro_admina=new CRubrika_Foto('gympl_novinky',true); 
$pro_admina->NastavAdresarFotek('foto/');
for($i=0;$i<=$pro_admina->get_pocet_zaznamu();$i++) $smaz[$i]=$_POST[smaz][$i];


switch ($akce)
{// ke switch
  case 'editace_stranky':
          //echo"V�sledek akce : $akce <BR>";
             if($editakce=='smazat') {
                                     
                                      foreach($smaz as $k => $v){//k foreach
                                      if($v!='') { //k ifu                                      
                                       $pro_admina->Smaz_z_Rubriky($v); 
                                        $pro_admina->Smaz_z_Rss($v);
                                      echo"<div class=\"chyba\">��slo smazan�ho z�znamu :$v <br /> </div>";
                                                   }//k ifu
                                                              }//k foreach
                                      $pro_admina->feedrss($mujweb);
                                                               
 echo"
Pokra�ujte kliknut�m zde:
<a href=\"refresh.php\"> pokra�ovat.</a> <br /> ";                                     
                                     }
                                     
if($editakce=='archivovat') {
                                     
                                      foreach($smaz as $k => $v){//k foreach
                                      if($v!='') { //k ifu                                      
                                       $pro_admina->DoArchivu($v); 
                                        $pro_admina->Smaz_z_Rss($v);
                                      echo"<div class=\"chyba\">��slo archivovan�ho z�znamu :$v <br /> </div>";
                                                   }//k ifu
                                                              }//k foreach
                                      $pro_admina->feedrss($mujweb);
                                                               
 echo"
Pokra�ujte kliknut�m zde:
<a href=\"refresh.php\"> pokra�ovat.</a> <br /> ";                                     
                                     }                                     
 if($editakce=='dearchivovat') {
                                     
                                      foreach($smaz as $k => $v){//k foreach
                                      if($v!='') { //k ifu 
                                      $polozka_asociovana=$pro_admina->poleProNavratDoRSS($v);
 //echo "tri udaje:,$polozka_asociovana[text],    $polozka_asociovana[nadpis] , $polozka_asociovana[autor],archiv:$polozka_asociovana[archiv]";
 if ($polozka_asociovana[archiv]=='ano') {
 //echo"$v bylo v archivu";
 $zacil=$adresawebu.'gympl_novinky/gympl_novinky.php';                    
$pro_admina->Pridej_do_Rss($v,$polozka_asociovana[text],$polozka_asociovana[nadpis],$polozka_asociovana[autor],$zacil);  
                   
                                         }          
                                   
                                       $pro_admina->ZArchivu($v); 
                   
                                      echo"<div class=\"chyba\">��slo dearchivovan�ho z�znamu :$v <br /> </div>";
                                                   }//k ifu
                                                              }//k foreach
                                      $pro_admina->feedrss($mujweb);
                                                               
 echo"
Pokra�ujte kliknut�m zde:
<a href=\"refresh.php\"> pokra�ovat.</a> <br /> ";                                     
                                     }                                          
if($editakce=='vynulovat preference') {
                                     
                                      foreach($smaz as $k => $v){//k foreach
                                      if($v!='') { //k ifu                                      
                                       $pro_admina->VynulovatPreference($v); 
                                       
                                      echo"<div class=\"chyba\">preference vynulov�na u z�znamu :$v <br /> </div>";
                                                   }//k ifu
                                                              }//k foreach
                                      $pro_admina->feedrss($mujweb);
                                                               
 echo"
Pokra�ujte kliknut�m zde:
<a href=\"refresh.php\"> pokra�ovat.</a> <br /> ";                                     
                                     }                                      
 if($kohoeditovat!='') {// k editovat vybranou radku
                           switch( $codelat)
                            { // k switch
                               case 'ulo�it':
                               $poleupdate=$pro_admina->Preber_promene();
                               $rozmery=$pro_admina->Preber_rozmery();
                             if($pro_admina->Formular_kontrola($poleupdate))
                                                  {
                $pro_admina->Update_v_Rubrice($kohoeditovat,$poleupdate,$rozmery[sirka],$rozmery[vyska]);                
                $pro_admina->Update_v_Rss($kohoeditovat,$poleupdate[2],$poleupdate[5],$poleupdate[3]);
                $pro_admina->feedrss($mujweb);
                echo"zaznam :$kohoeditovat ulo�en <br /> ";
                
   
echo"
Pokra�ujte kliknut�m zde:
<a href=\"refresh.php\"> pokra�ovat.</a> <br /> "; 
    
                 
                                                  } 
                                          else{
                                          echo" <div class=\"chyba\">
                 Nepro�lo kontrolou.<br />
                 Pokou��te se odeslat ne�pln� formul�� nebo chybn� form�t n�kter� hodnoty.V d�sledku toho nedo�lo ke zm�n� ��dn�ho �daje a v datab�zi z�st�vaj� p�vodn� hodnoty. <br />
                  Prove�te znovu po�adovan� zm�ny a soust�e�te se na �daje ozna�en� chybou.
                 
               </div>";
      
        $pro_admina->Adminzaznamudotaz($kohoeditovat); 
                                          
                                              }        
 
                                      break;


                               case 'smazat_z�znam':
                                      $pro_admina->Smaz_z_Rubriky($kohoeditovat); 
                                       $pro_admina->Smaz_z_Rss($kohoeditovat);
                                     $pro_admina->feedrss($mujweb);
                                    echo"<div class=\"chyba\">zaznam :$kohoeditovat smaz�n </div> <br />";

                                  $pro_admina->Admineditacetab($zobr,'administrace.php',$filtrovanysloupec,$mahodnotu,'id DESC',$prihlaseny);
  
                                      break;

                              default :$pro_admina-> Adminzaznamudotaz($kohoeditovat);
                              break;
                             } // k switch
                                               }// k editovat vybranou radku

                     else if ($oznvse=='ano'||$oznvse=='odzna�it') {
                        $pro_admina->Admineditacetab($zobr,'administrace.php',$filtrovanysloupec,$mahodnotu,'id DESC',$prihlaseny); 
                               	
                               }                                  
                                     
                                     

            

         break;

case 'nahled_stranky':
          echo"V�sledek akce : $akce <br />";
          $pro_nahled=new CRubrika_Foto('gympl_fotogalerie',true); 
          $pro_nahled->NastavAdresarFotek('foto/','nahled/');                                   
          $pro_nahled->FormatujObashRubriky(); 
         break;
         
case 'novinku':
          $pro_formular=new CRubrika_Foto('gympl_novinky',true);

 $pro_formular->NastavAdresarFotek('foto/');
 $odeslano=$_POST[odeslano];


$pole=$pro_formular->Preber_promene();
$rozmery=$pro_formular->Preber_rozmery();
//echo"roymerz_sirka:".$rozmery[sirka]. "<br />";
//echo"roymerz_vyska:".$rozmery[vyska]. "<br />";
/*for ($i=0;$i<$pro_formular->pocetsloupcu ;$i++ ) {
	echo"pole $i:".$pole[$i]. "<br />";
} */ 



if($odeslano
 && 
$pro_formular->Formular_kontrola($pole)

) {
 if($pole[9]=='ano')  {
 
   $email='barta@pekargmb.cz';    
  $from=$pole[4];
  $textobednavky="Gymnazium Dr.J.Pekare. Zadost o zverejneni novinky v tisku.\n".
 $pole[2]. "\n".  $pole[5]. "\n";
  $celytext=$textobednavky ."\n D�kuji ".$pole[4];
  //echo $celytext;
$pro_formular->PosliEmailBartovi( $email, $celytext, $from, 'pekargmb_novinky_do_tisku');  
   
        // @$dopis=mail($email, 'pekargmb_novinky_do_tisku',$celytext , $from); 
         // echo"<br /> Na adresu $email byla odesl�na ��dost o zve�ejn�n� v tisku. <br />";
                      }  

$id_novinky=$pro_formular->Pridej_do_Rubriky($pole,$rozmery[sirka],$rozmery[vyska]);                                                                                                 
   if($id_novinky<>-1){
      $zacil=$adresawebu.'gympl_novinky/gympl_novinky.php';
      $pro_formular->Pridej_do_Rss($id_novinky,$pole[5],$pole[2],$pole[3],$zacil);      
      $pro_formular->feedrss($mujweb);
      $navrat=$pro_formular->Nazev.'.php';      
      echo"D�kujeme za vlo�en� novinky. <br />";
 
       
echo"
Pokra�ujte kliknut�m zde:
<a href=\"refresh.php\"> pokra�ovat</a> <br /> "; 


     
                                                     }
        else echo"<div class=\"chyba\">Chyba p�i ukl�d�n� z�znamu.</div>" ;             
                                                        }
    elseif($odeslano) {
         echo" <div class=\"chyba\">
                 Nepro�lo kontrolou, opravte chybn� �daje.
                 
               </div>";
      
        $pro_formular->Formular_obec($pole);
        }
      else $pro_formular->Formular_obec($pole); 
         break;

  
         break;




     default :

      $pro_admina->Admineditacetab($zobr,'administrace.php',$filtrovanysloupec,$mahodnotu,'poradi DESC,id DESC',$prihlaseny); 




}//ke switch






                  












                         
                    
                                     
                            


require "paticka.php";
?>



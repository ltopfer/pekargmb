<?php
header ("Pragma: no - cache");
header ("Cache-Control : no - cache, must - revalidate");
header("Expires: ".gmdate("D, d M Y H:i:s")." GMT");
if(!isset($_SERVER["PHP_AUTH_USER"])) {
    Header("WWW-Authenticate: Basic realm=\"Vyplòte uživatelské jméno a heslo\"");
    Header("HTTP/1.0 401 Unauthorized");
    echo "Vstup na stránky pøerušen";
    exit;
  } else {
 

 include 'hlavicka.php';

 $pro_admina=new CRubrika_Bez_Foto($tabulka); 
//echo $tabulka; 



$prezdivka= addslashes($_SERVER[PHP_AUTH_USER]);
$heslo= addslashes($_SERVER[PHP_AUTH_PW]);
$podminka='heslo'.'='.'\''.$heslo.'\'' .' AND '. 'prezdivka'.'='.'\''.$prezdivka.'\'' ;
//echo"podm9nka : $podminka";
$seznam_uzivatelu= $pro_admina->VyberSeznam($podminka);
$kohoeditovat=$seznam_uzivatelu[id][0];



//echo"id je: $kohoeditovat <br />";
$uzivatelnalezen=($kohoeditovat!='') ? true : false; 
 if (!$uzivatelnalezen){
 echo"<h4>$kategorie_nazav </h4>";
 echo "<div class=\"chyba\">Chybné pøihlaèovací údaje. Pro opìtovné pøihlášení je tøeba zavøít okno prohlížeèe.</div>
 
     "; 
     exit;}
          }
         

?><?php 
$polozz=$pro_admina->VyberPolozku($kohoeditovat);
$pocetpredmetu=$pro_admina->Urci_pocet_vol_predmetu(); 
 for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){ 
                             $jmenoakceptsloupce='akcept'.$pocet_zobr; 
                                  $volitelnapole[]=$jmenoakceptsloupce;
                                                                 }
$volitelnapole[]='poznamka';

$pro_admina->Vyber_volitelna_pole($volitelnapole);  
 echo"<div class=\"chyba\">
 Pro odhášení z editace je tøeba zavøít okno prohlížeèe. 
</div>"; 

 
echo"<h4>$kategorie_nazav, $stav</h4>";
$codelat=$_POST[codelat];
$sheslem=$_GET[sheslem];

 if($kohoeditovat!='') {// k editovat vybranou radku
                           switch( $codelat)
                            { // k switch
                               case 'uložit':
                               $poleupdate=$pro_admina->Preber_promene();
                              
                             if($pro_admina->Formular_kontrola_student($poleupdate,false))
                                                  {
                $pro_admina->Update_v_Rubrice($kohoeditovat,$poleupdate);                
                
                echo" Váš záznam byl uložen.  <br /> Pokud chcete bezpeènì ukonèit zápis pøedmìtù, <span class=\"chyba\">zavøete okno prohlížeèe</span>. <br /> Jestliže chcete provádìt opravy, mùžete znovu <a href=\"editace.php \" > editovat záznam </a> .";
                
   

    
                 
                                                  } 
                                          else{
                                          echo" <div class=\"chyba\">
                 Neprošlo kontrolou.<br />
                 Pokoušíte se odeslat neúplný formuláø nebo chybný formát nìkteré hodnoty.V dùsledku toho nedošlo ke zmìnì žádného údaje a v databázi zùstávají pùvodní hodnoty. <br />
                  Proveïte znovu požadované zmìny a soustøeïte se na údaje oznaèené chybou.
                 
               </div>";
      
    
 	 $pro_admina->Adminzaznamuuzivatel($kohoeditovat,'editace.php',$sheslem); 
    
                                          
                                              }        
 
                                      break;


                               

                              default :
                              if (($stav=='probíhá zpracování') || ($je_cas_pro_editaci=='ne' )) {
                               echo $komentar_obecny."<br />";
                                echo $komentar_zpracovani."<br />";
      $pro_admina->Zobrvysledekprozaka($kohoeditovat,'editace.php',$sheslem);
if ($je_cas_pro_editaci=='ne') {
echo" <div class=\"chyba\">Volba bude zahájena  $den.$mesic.$rok v $hodina:$minuta  po této dobì aktualizujte stránku.
            </div>  
  " ; 		
}       	
      }
      else {
      echo $komentar_obecny."<br />";
     
 	 $pro_admina->Adminzaznamuuzivatel($kohoeditovat,'editace.php',$sheslem); 
      } 
                              break;
                             } // k switch
                                               }// k editovat vybranou radku

  
	




                  












                         
                    
                                     
                            


require "paticka.php";
?>



<?php
header ("Pragma: no - cache");
header ("Cache-Control : no - cache, must - revalidate");
header("Expires: ".gmdate("D, d M Y H:i:s")." GMT");
if(!isset($_SERVER["PHP_AUTH_USER"])) {
    Header("WWW-Authenticate: Basic realm=\"Vypl�te u�ivatelsk� jm�no a heslo\"");
    Header("HTTP/1.0 401 Unauthorized");
    echo "Vstup na str�nky p�eru�en";
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
 echo "<div class=\"chyba\">Chybn� p�ihla�ovac� �daje. Pro op�tovn� p�ihl�en� je t�eba zav��t okno prohl�e�e.</div>
 
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
 Pro odh�en� z editace je t�eba zav��t okno prohl�e�e. 
</div>"; 

 
echo"<h4>$kategorie_nazav, $stav</h4>";
$codelat=$_POST[codelat];
$sheslem=$_GET[sheslem];

 if($kohoeditovat!='') {// k editovat vybranou radku
                           switch( $codelat)
                            { // k switch
                               case 'ulo�it':
                               $poleupdate=$pro_admina->Preber_promene();
                              
                             if($pro_admina->Formular_kontrola_student($poleupdate,false))
                                                  {
                $pro_admina->Update_v_Rubrice($kohoeditovat,$poleupdate);                
                
                echo" V� z�znam byl ulo�en.  <br /> Pokud chcete bezpe�n� ukon�it z�pis p�edm�t�, <span class=\"chyba\">zav�ete okno prohl�e�e</span>. <br /> Jestli�e chcete prov�d�t opravy, m��ete znovu <a href=\"editace.php \" > editovat z�znam </a> .";
                
   

    
                 
                                                  } 
                                          else{
                                          echo" <div class=\"chyba\">
                 Nepro�lo kontrolou.<br />
                 Pokou��te se odeslat ne�pln� formul�� nebo chybn� form�t n�kter� hodnoty.V d�sledku toho nedo�lo ke zm�n� ��dn�ho �daje a v datab�zi z�st�vaj� p�vodn� hodnoty. <br />
                  Prove�te znovu po�adovan� zm�ny a soust�e�te se na �daje ozna�en� chybou.
                 
               </div>";
      
    
 	 $pro_admina->Adminzaznamuuzivatel($kohoeditovat,'editace.php',$sheslem); 
    
                                          
                                              }        
 
                                      break;


                               

                              default :
                              if (($stav=='prob�h� zpracov�n�') || ($je_cas_pro_editaci=='ne' )) {
                               echo $komentar_obecny."<br />";
                                echo $komentar_zpracovani."<br />";
      $pro_admina->Zobrvysledekprozaka($kohoeditovat,'editace.php',$sheslem);
if ($je_cas_pro_editaci=='ne') {
echo" <div class=\"chyba\">Volba bude zah�jena  $den.$mesic.$rok v $hodina:$minuta  po t�to dob� aktualizujte str�nku.
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



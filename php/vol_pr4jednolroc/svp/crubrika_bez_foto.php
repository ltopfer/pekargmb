<?php
require("../inst.php");
require("../../spojenie.php");
require("../../crubrika.php");
/*---------------------------Popis t��dy Crubrika_Foto--------------------------
T��dy Crubrika_Foto je potomkem t��dy Crubrika

 Popis t��dy CRubrika :Slou�� k manipulaci s daty v tabulce MySQL datab�ze
Konfigurace tabulky v datab�zi: prvn� sloupec tabulky je id 
                                ostatn� sloupce jsou libovoln�.

Popis atribut� t��dy CRubrika:
Nazev....N�zev  zpracov�van� tabulky v datab�zi
pocetsloupcu...po�et sloupc� v tabulce
sloupec...pole s n�zvy sloupc� tabulky
typsloupce...pole s identifik�tory typ� jednotliv�ch sloupc� tabulky
chyba...pole chybov�ch hl�en� p��slu�en�c� ke sloupc�m tabulky, pou��v� se 
p�i vyhodnocov�n� odeslan�ho formul��e

Roz���en� atribut�:
Tabulka V datab�zi MySQL: id, datum,kategorie,text
chybafotky...chybov� hl�en� fotky
Upravafoto... boolean identifikuje zda bude odesilan� foto opraveno(rozmm�ry)
adresarfotek...specifikuje adres�� pro ukl�d�n� fotek
adresarnahledu...specifikuje adres�� pro ukl�d�n� n�hled� fotek
------------------------------------------------------------------------------*/
class CRubrika_Bez_Foto extends CRubrika
{
	// variables
	


	// constructor
	function CRubrika_Bez_Foto($Nazev)
	{ // BEGIN constructor
			$this->chybasouboru='*';
    
    $this->CRubrika($Nazev);
	} // END constructor
	
	
/*---------------------------Popis metody Vyber_volitelna_pole($fsloupec)-------

Metoda Vyber_volitelna_pole($fsloupec) umo��uje ozna�it n�kter� �daje ve
 formul��i jako nepovinn� tak, �e prom�nnou chyba[p��slu�n�ho sloupce] p�estav�
 z hodnoty '*' na hodnotu ''. T�m ovlivn� zobrazen� formul��e , u t�chto udaj�
 ce nezobraz� '*' .                                                  
------------------------------------------------------------------------------*/
function Vyber_volitelna_pole($fsloupec)
{ 
$kontrolatextu=CRubrika::Vyber_volitelna_pole();
foreach ( $fsloupec as $key=>$value) {
	

  for ($i=0;$i<$this->pocetsloupcu ;$i++ ) {
  //$chyba[$i]='*';  
  if ($this->sloupec[$i]==$value) {	$this->chyba[$i]='';  }



                                           }  
                                      }                      

 }
function Urci_pocet_vol_predmetu()
{ 

$pocitadlopredmetu=0;
  for ($i=0;$i<$this->pocetsloupcu ;$i++ ) {
    
  if ( strstr($this->sloupec[$i], "predmet")&&!strstr($this->sloupec[$i], "nahradni")) {	$pocitadlopredmetu++ ;  }



                                           }  
                                                        
return ($pocitadlopredmetu);
 }
 
 function Pocet_nahradnich_predmetu()
{ 
global $pref;
$tablename=$pref.'zaci';
//echo $tablename; 
$query = "SHOW FULL COLUMNS FROM $tablename"; 
$result = mysql_query($query) or die("N�kde je chyba");
$pocitadlopredmetu=0;
while ($row = MySQL_Fetch_Array($result)) 
{ 
if ( strstr($row[0], "nahradni")) {	$pocitadlopredmetu++ ;  }
}
                                                        
return ($pocitadlopredmetu);
 } 	
 
 /*---------------------------vyber tridy-----------------

Metoda  VyberObsahSloupce
------------------------------------------------------------------------------*/
 function VyberObsahSloupce($f_sloupec)
 {        
$f_sloupec=$this->inject_addslashes($f_sloupec);        
         @$vsechnyzazanamy=MySQL_Query("Select DISTINCT $f_sloupec FROM $this->Nazev  ORDER BY id  ; ")OR DIE(MySQL_Error()) ; 
            
         while ($zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC)) {
         $ven[]=$zaznam[$f_sloupec];  
               
         
                                                                     }

            
                                                                    
return ($ven);
 }  
 
 
 
/*---------------------------Popis metody Vynuluj($f_id)-

Metoda m�n� obsah polo�ky z rubriky a vrac� ��slo t�to polo�ky
------------------------------------------------------------------------------*/
function Vynuluj($f_id)
{ 
$pocetpredmetu=$this->Urci_pocet_vol_predmetu();

$f_id=$this->inject_addslashes($f_id);
$f_id=intval($f_id);  
$pomval='';
for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
  $jmenopredmetsloupce='predmet'.$pocet_zobr;
  $jmenoakceptsloupce='akcept'.$pocet_zobr;
  $pomval=$pomval."$jmenopredmetsloupce='Vyberte si p�edm�t', $jmenoakceptsloupce='ne',";
   }

    $pomval=$pomval."poznamka=' ' " ;
 
                                    
//echo"---<br /> pomval je: $pomval ---<br /> ";

@$uprava=MySQL_Query("UPDATE $this->Nazev SET $pomval  WHERE id=$f_id ;")OR DIE(MySQL_Error()) ; 

return ($f_id);
}
/*---------------------------*/
function SmazPoznamku($f_id)
{ 


$f_id=$this->inject_addslashes($f_id);
$f_id=intval($f_id);  


    $pomval="`poznamka`=' '" ;
 
                                    
//echo"---<br /> pomval je: $pomval ---<br /> ";

@$uprava=MySQL_Query("UPDATE $this->Nazev SET $pomval  WHERE id=$f_id ;")OR DIE(MySQL_Error()) ; 

return ($f_id);
}
/*---------------------------*/
function Vynuluj_nahradni_Predmet($f_id)
{ 


$f_id=$this->inject_addslashes($f_id);
$f_id=intval($f_id);  


    $pomval="`predmetnahradni`='Vyberte si p�edm�t'" ;
 
                                    
//echo"---<br /> pomval je: $pomval ---<br /> ";
 if ($this->Pocet_nahradnich_predmetu()>0) {
 @$uprava=MySQL_Query("UPDATE $this->Nazev SET $pomval  WHERE id=$f_id ;")OR DIE(MySQL_Error()) ;
 }
else {
	echo"N�hradn� p�edm�t u polo�ky $f_id neexistuje. <br />";
} 

return ($f_id);
}


/*---------------------------------------------------------------------------*/ 

/*---------------------------Popis metody ZrusitAkcept($f_id)-

Metoda m�n� obsah polo�ky z rubriky a vrac� ��slo t�to polo�ky
------------------------------------------------------------------------------*/
function ZrusitAkcept($f_id)
{ 
$pocetpredmetu=$this->Urci_pocet_vol_predmetu();
$f_id=$this->inject_addslashes($f_id);
$f_id=intval($f_id); 
$pomval='';
for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
  $jmenoakceptsloupce='akcept'.$pocet_zobr;
$pomval=($pocet_zobr==$pocetpredmetu)? $pomval."$jmenoakceptsloupce='ne'":$pomval."$jmenoakceptsloupce='ne',"; 
   }


    
 
                                    
//echo"---<br /> pomval je: $pomval ---<br /> ";

@$uprava=MySQL_Query("UPDATE $this->Nazev SET $pomval  WHERE id=$f_id ;")OR DIE(MySQL_Error()) ; 

return ($f_id);
}
/*---------------------------------------------------------------------------*/ 

/*---------------------------Popis metody AkceptovatPredmet($f_predmet)-


------------------------------------------------------------------------------*/
function AkceptovatPredmet($f_predmet)
{  
$pocetpredmetu=$this->Urci_pocet_vol_predmetu();
$f_predmet=$this->inject_addslashes($f_predmet);
 for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
$jmenopredmetsloupce='predmet'.$pocet_zobr;
  $jmenoakceptsloupce='akcept'.$pocet_zobr;
 $podminka="`".$jmenopredmetsloupce."`='".$f_predmet."'";
 $zaset="`".$jmenoakceptsloupce."`='ano'";
@$uprava1=MySQL_Query("UPDATE $this->Nazev SET $zaset  WHERE $podminka ;")OR DIE(MySQL_Error()) ; 
  }
 

}

function NeAkceptovatPredmet($f_predmet)
{  
$pocetpredmetu=$this->Urci_pocet_vol_predmetu();
$f_predmet=$this->inject_addslashes($f_predmet);
for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
$jmenopredmetsloupce='predmet'.$pocet_zobr;
  $jmenoakceptsloupce='akcept'.$pocet_zobr;
 $podminka="`".$jmenopredmetsloupce."`='".$f_predmet."'";
 $zaset="`".$jmenoakceptsloupce."`='ne'";
@$uprava1=MySQL_Query("UPDATE $this->Nazev SET $zaset  WHERE $podminka ;")OR DIE(MySQL_Error()) ; 
  }


}

/*---------------------------------------------------------------------------*/ 

/*---------------------------Popis metody Formular_kontrola($kontrpole)---------

Metoda Formular_kontrola($kontrpole) kontroluje, zda $kontrpole , kter� jsou
ozna�eny jako povinn� tj. '*'neobsahuje pr�zn� polo�ky a zda zadan� polo�ky 
odpov�daj� p�edem stanoven�m po�adavk�m, nap�. polo�ka mail.
prezdivka.....pouze aglick� abeceda a ��sla
heslo.....pouze aglick� abeceda a ��sla 
a zda prezdivka nen� ji� registrovan� v datab�zi
------------------------------------------------------------------------------*/
function Formular_kontrola($kontrpole,$jedinecnost_prezdivky=true)
{ 
global $superuser;
$pocetpredmetu=$this->Urci_pocet_vol_predmetu();
for ($i=0;$i<$this->pocetsloupcu ;$i++ ) {if($this->sloupec[$i]=='predmet1'){
//tady jsem si jen vzfiltroval pole odeslanych predmetu-------start-----------                      
 for ($poc=0;$poc < 2*$pocetpredmetu ;$poc=$poc+2 )  $polepredmetu[]= $kontrpole[$i+$poc];
//tady jsem si jen vzfiltroval pole odeslanych predmetu-------end-----------
                                                                            }
                                    }
                                       
                                    
for ($i=0;$i<$this->pocetsloupcu ;$i++ )  $proslo[$i]=1;

for ($i=2;$i<$this->pocetsloupcu ;$i++ ) {

if( !($this->chyba[$i]=='')){ 

if($kontrpole[$i]=='') {$this->chyba[$i]="chyb� ". $this->sloupec[$i];$proslo[$i]=0;}
elseif($this->sloupec[$i]=='prezdivka'){
                                                    
  if(!(ereg("(^[a-zA-Z0-9]+$)|(\-)|(\/)",$kontrpole[$i]))){$this->chyba[$i]="v p�ezd�vce zak�zan� znaky";$proslo[$i]=0; }
            else {
            if ($jedinecnost_prezdivky) {
            $kontrpole[$i]=$this->inject_addslashes($kontrpole[$i]);
            @$uzjetam=MySQL_Query("SELECT *  FROM  $this->Nazev WHERE prezdivka='$kontrpole[$i]' ;")OR DIE(MySQL_Error()) ; 
$pocet_zaznamu=MYSQL_NUm_Rows($uzjetam);                                
 if((($uzjetam)&&($pocet_zaznamu>0))||($kontrpole[$i]==$superuser)){$this->chyba[$i]="zvolte jin� u�ivatelsk� jm�no";$proslo[$i]=0; }
            	
                                    }      
 
             } 
  
                                    }
                

                elseif($this->sloupec[$i]=='email'){
                                                    
  if(!(ereg("^[^@]+@[^.]+\..+$",$kontrpole[$i]))){$this->chyba[$i]="chybn� form�t emailu";$proslo[$i]=0; }
                                                     }
                 
                      elseif(( strstr($this->sloupec[$i], "predmet")) ){
                                          
 $pocitadlo=0;
  foreach ( $polepredmetu as $key=>$value) {
  if ($value==$kontrpole[$i])$pocitadlo++;  	
                                           }
                                       
 if (($pocitadlo >1 )&&($kontrpole[$i]!='Vyberte si p�edm�t') ){
 	$this->chyba[$i]="duplicita v�b�ru p�edm�t� ( $kontrpole[$i] ) "; $proslo[$i]=0;
   
  
    }  

   
  
   
 
                                                     }
                                                     
                                                                                                                   
                      else {$this->chyba[$i]="*";$proslo[$i]=1; }                           
                                               

                  }
                  
                                           }
$soucin=1;
for ($i=2;$i<$this->pocetsloupcu ;$i++ )  $soucin=$soucin*$proslo[$i] ;
$zaver = $soucin==0 ? false : true;
return $zaver ;
}

function Lonistudoval($f_kohoeditovat)
 { 
 $f_predmet_tabulka='gympl_4rocjednol_loni_zaci'; 
 @$vsechnyzazanamy=MySQL_Query(" SELECT * FROM  $f_predmet_tabulka
WHERE  `id`=$f_kohoeditovat; ")OR DIE(MySQL_Error()) ;            
$zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC) ;
 
          foreach($zaznam as $k => $v) {
         
                 $ven[$k][]=$v;
         	
                         
                                       }   
            
                                                                   
return ($ven);
 }  

 

/*---------------------------Popis metody Formular_kontrola_student($kontrpole)---------

Metoda Formular_kontrola($kontrpole) kontroluje, zda $kontrpole , kter� jsou
ozna�eny jako povinn� tj. '*'neobsahuje pr�zn� polo�ky a zda zadan� polo�ky 
odpov�daj� p�edem stanoven�m po�adavk�m, nap�. polo�ka mail.
prezdivka.....pouze aglick� abeceda a ��sla
heslo.....pouze aglick� abeceda a ��sla 
a zda prezdivka nen� ji� registrovan� v datab�zi
------------------------------------------------------------------------------*/
function Formular_kontrola_student($kontrpole,$jedinecnost_prezdivky=true)
{ 
global $superuser,$prefneslucitelnost,$pref,$preftabulky_neslucitelnosti,$kohoeditovat;
$lonskypedmety=$this->Lonistudoval($kohoeditovat);
//tadz to budu poyn8mkovat
//for ($i=0;$i<count($lonskypedmety[id]) ;$i++ ){ echo" Jednolet� p�edm�t v studovan� v lo�sk�m  �koln�m roce :  {$lonskypedmety[predmet1][$i]}"; }
//tadz to budu poyn8mkovat
$pocetpredmetu=$this->Urci_pocet_vol_predmetu();
for ($i=0;$i<$this->pocetsloupcu ;$i++ ) {if($this->sloupec[$i]=='predmet1'){
//tady jsem si jen vzfiltroval pole odeslanych predmetuBEZ SKUPIN--start--------                      
 for ($poc=0;$poc < 2*$pocetpredmetu ;$poc=$poc+2 )  $polepredmetu[]=strtok($kontrpole[$i+$poc],'_' ) ;
//tady jsem si jen vzfiltroval pole odeslanych predmetu-------end-----------
                                                                            }
                                    }
                                       
                                    
for ($i=0;$i<$this->pocetsloupcu ;$i++ )  $proslo[$i]=1;

for ($i=2;$i<$this->pocetsloupcu ;$i++ ) {

if( !($this->chyba[$i]=='')){ 

if($kontrpole[$i]=='') {$this->chyba[$i]="chyb� ". $this->sloupec[$i];$proslo[$i]=0;}
elseif($this->sloupec[$i]=='prezdivka'){
                                                    
  if(!(ereg("(^[a-zA-Z0-9]+$)|(\-)|(\/)",$kontrpole[$i]))){$this->chyba[$i]="v p�ezd�vce zak�zan� znaky";$proslo[$i]=0; }
            else {
            if ($jedinecnost_prezdivky) {
             $kontrpole[$i]=$this->inject_addslashes($kontrpole[$i]);
            @$uzjetam=MySQL_Query("SELECT *  FROM  $this->Nazev WHERE prezdivka='$kontrpole[$i]' ;")OR DIE(MySQL_Error()) ; 
$pocet_zaznamu=MYSQL_NUm_Rows($uzjetam);                                
 if((($uzjetam)&&($pocet_zaznamu>0))||($kontrpole[$i]==$superuser)){$this->chyba[$i]="zvolte jin� u�ivatelsk� jm�no";$proslo[$i]=0; }
            	
                                    }      
 
             } 
  
                                    }
                

                elseif($this->sloupec[$i]=='email'){
                                                    
  if(!(ereg("^[^@]+@[^.]+\..+$",$kontrpole[$i]))){$this->chyba[$i]="chybn� form�t emailu";$proslo[$i]=0; }
                                                     }
                      elseif(( strstr($this->sloupec[$i], "predmet")) ){

  if ($kontrpole[$i]=='Vyberte si p�edm�t') {
  $this->chyba[$i]="nebyl vybr�n p�edm�t"; $proslo[$i]=0;	
  }

  else { 
for ($k=0;$k<count($lonskypedmety[id]) ;$k++ ){ 

if (strtok($kontrpole[$i],'_')==strtok($lonskypedmety[predmet1][$k],'_')){$this->chyba[$i]="{$lonskypedmety[predmet1][$k]} : v lo�sk�m �k.roce"; $proslo[$i]=0;}
 }  
  
  
if ($prefneslucitelnost!='') {
  $prezdivka= addslashes($_SERVER[PHP_AUTH_USER]);
$heslo= addslashes($_SERVER[PHP_AUTH_PW]);
$podminka='heslo'.'='.'\''.$heslo.'\'' .' AND '. 'prezdivka'.'='.'\''.$prezdivka.'\'' ;
$tabulka=$prefneslucitelnost.'zaci';
  @$uzivatel=MySQL_Query("SELECT *  FROM  $tabulka WHERE $podminka ;")OR DIE(MySQL_Error()) ; 
$zazuzivatel=MYSQL_Fetch_Array($uzivatel, MYSQL_ASSOC);
foreach($zazuzivatel as $k => $v)if (strstr($k, "predmet")) {$vybrano[]=$v;}
$tabulkanesluc=$preftabulky_neslucitelnosti.'nesluc';
//echo"Vybran�  p�edm�ty <br />" ;
foreach($vybrano as $k => $v) {
//echo"index:$k p�edm�t:$v <br />";                      
                      $podminka1='jizstuduje'.'='.'\''.$v.'\'' .' AND '. ' neslucujese'.'='.'\''.$kontrpole[$i].'\'' ; 
                     $podminka2='neslucujese'.'='.'\''.$v.'\'' .' AND '. ' jizstuduje'.'='.'\''.$kontrpole[$i].'\'' ; 
$podminka='('.$podminka1.')  OR  ('.$podminka2.')' ;
//echo $podminka;                       
                      @$vsechnynesluczaz=MySQL_Query("Select * FROM $tabulkanesluc WHERE $podminka ; ")OR DIE(MySQL_Error()) ; 
 while ($polezaznamnesluc=mysql_fetch_array ($vsechnynesluczaz, MYSQL_ASSOC)) {
 $this->chyba[$i]="neslu�itelnost( $kontrpole[$i],$v  ) "; $proslo[$i]=0;
 }
                   
                           
                                                                      
                               }
  }  
  
                                        
  $pocitadlo=0;
  foreach ( $polepredmetu as $key=>$value) {
  //echo $value ;echo"<br />" ;
  if (strtok($value,'_')==strtok($kontrpole[$i],'_' ))$pocitadlo++;  	
                                           }
                                       
 if (($pocitadlo >1 )&&($kontrpole[$i]!='Vyberte si p�edm�t') ){
 	$this->chyba[$i]="duplicita v�b�ru p�edm�t� ( $kontrpole[$i] ) "; $proslo[$i]=0;
   

    }  
if (!in_array ("��dn�", $polepredmetu)) {
	$this->chyba[$i]="v jednom p��pad� vyberte ��dn�"; $proslo[$i]=0;	
}
   
  
   }
  
   
 
 
        } 
                                                     }
                     
                                                     
                                                                                                                       
                      else {$this->chyba[$i]="*";$proslo[$i]=1; }                           
                                               

                  }
                  
                                          
$soucin=1;
for ($i=2;$i<$this->pocetsloupcu ;$i++ )  $soucin=$soucin*$proslo[$i] ;
$zaver = $soucin==0 ? false : true;
return $zaver ;
}



/*---------------------------Popis metody Preber_promene()----------------------

Metoda Preber_promene() se star� o p�ed�n� pole prom�nn�ch
 odeslan�ch  formul��em metodou POST.
N�zvy prom�nn�ch ve formul��i mus� odpov�dat n�zv�m sloupc� v dan� tabulce.
Form�tov�c� znaky p�ev�d� pomoc� htmlspecialchars na entity
------------------------------------------------------------------------------*/
function Preber_promene()
{ 
foreach ($this->sloupec as $key=>$value) {
//echo"klic:$key a hodnota $value <br />";	
//$lpole[]=$_POST[$value];
//$lpole[]=htmlspecialchars($_POST[$value]);
 $lpole[]=$_POST[$value];
//$$value=$_POST[$value];
//$pole[]=$$value;
}
return $lpole ;
}

 
/*--------------------------Popis metody Pridej_do_Rubriky($fpole)--------------

Metoda  Pridej_do_Rubriky($fpole) p�id� polo�ku ur�enou parametrem $fpole do 
p��slu�n� tabulky a vrac� id p�idan� polo�ky

Roz���en�:v p��pad� , �e je p�ilo�ena fotka, ulo�� ji 
do p�edem ur�en�ho adres��e $this->adresarfotek 
(pop��pad� zm�n� rozm�ry)$this->image_resize 
------------------------------------------------------------------------------*/
function Pridej_do_Rubriky($fpole)
{ 
$mm=MySQL_Query("SELECT Max( id ) FROM $this->Nazev "); 
$maxcislo=mysql_result($mm,0);
$osp=$maxcislo+1; 
$datump=Date(d.'.'.m.'.'.Y); 
$fpole[0]=$osp;$fpole[1]=$datump;
$pomval=$osp.',\''.$datump;
for ($i=2;$i<$this->pocetsloupcu ;$i++ ) $fpole[$i]=$this->inject_addslashes( $fpole[$i]);
for ($i=2;$i<$this->pocetsloupcu ;$i++ ) $pomval= (($this->sloupec[$i]=='jmeno')||($this->sloupec[$i]=='prijmeni'))  ?$pomval.'\',\''.ucfirst($fpole[$i])  : $pomval.'\',\''.$fpole[$i];
 $pomval=$pomval.'\'';  
//echo"---<br /> pomval je: $pomval ---<br /> ";
@$vlozeni=MySQL_Query("INSERT INTO $this->Nazev VALUES ($pomval);" ) OR DIE(MySQL_Error()) ;
if(!$vlozeni) $osp=-1;
return ($osp);
}
 
/*---------------------------Popis metody Update_v_Rubrice($f_id,$f_updatepole)-

Metoda m�n� obsah polo�ky z rubriky a vrac� ��slo t�to polo�ky
------------------------------------------------------------------------------*/
function Update_v_Rubrice($f_id,$f_updatepole)
{  
$f_id=$this->inject_addslashes($f_id);
$f_id=intval($f_id);
$pomval='';$polozka='';
for ($i=2;$i<$this->pocetsloupcu ;$i++ )$f_updatepole[$i]=$this->inject_addslashes($f_updatepole[$i]);
for ($i=2;$i<$this->pocetsloupcu ;$i++ ){
$polozka= (($this->sloupec[$i]=='jmeno')||($this->sloupec[$i]=='prijmeni'))  ?$this->sloupec[$i].'=\''.ucfirst($f_updatepole[$i]).'\'' : $this->sloupec[$i].'=\''.$f_updatepole[$i].'\'';

  if($i!=$this->pocetsloupcu-1)$pomval=$pomval.$polozka.','; else $pomval=$pomval.$polozka;
                                       }
//echo"---<br /> pomval je: $pomval ---<br /> ";

@$uprava=MySQL_Query("UPDATE $this->Nazev SET $pomval  WHERE id=$f_id ;")OR DIE(MySQL_Error()) ; 

return ($f_id);
}
/*---------------------------------------------------------------------------*/ 






/*---------------------------Popis metody VyberSeznam()-----------------

Metoda VyberSeznamNovinek() vrac� pole id, datum, nadpis novinek
------------------------------------------------------------------------------*/
 function VyberSeznam($f_podminka='',$f_tridit_podle='trida, prijmeni, id DESC')
 {  
  if ($f_podminka!='') {  
          @$vsechnyzazanamy=MySQL_Query("Select * FROM $this->Nazev WHERE $f_podminka ORDER BY $f_tridit_podle ; ")OR DIE(MySQL_Error()) ;    
                         }   
                else   { 
         @$vsechnyzazanamy=MySQL_Query("Select * FROM $this->Nazev  ORDER BY id DESC ; ")OR DIE(MySQL_Error()) ; 
                        }
         while ($zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC)) {
          foreach($zaznam as $k => $v) {
         
               $ven[$k][]=$v;
         	
                         
                                       }
         
         
         
            
         
                                                                     }

            
                                                                     
return ($ven);
 }       
 function VyberSeznamPredmetu($ztabulky='',$f_podminka='')
 {  
 if ($ztabulky=='') {
 require("../inst.php");
 	$ztabulky=$pref.'predmety';
                    }

  if ($f_podminka!='') {  
          @$vsechnyzazanamy=MySQL_Query("Select * FROM $ztabulky WHERE $f_podminka ORDER BY poradi ; ")OR DIE(MySQL_Error()) ;    
                         }   
                else   { 
         @$vsechnyzazanamy=MySQL_Query("Select * FROM $ztabulky  ORDER BY poradi  ; ")OR DIE(MySQL_Error()) ; 
                        }
         while ($zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC)) {
          foreach($zaznam as $k => $v) {
         
               $ven[$k][]=$v;
         	
                         
                                       }
         
         
         
            
         
                                                                     }

            
                                                                     
return ($ven);
 }       



function PocetPrihlasenychPredmet($f_napredmet)
 {
$pocetpredmetu=$this->Urci_pocet_vol_predmetu(); 
 
$f_napredmet=$this->inject_addslashes($f_napredmet);
if ($f_napredmet=='') {
$podminka="`id` > -1 '";$podminkaakcept='';$podminkaneakcept='';
for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
//$jmenopredmetsloupce='predmet'.$pocet_zobr;
$jmenoakceptsloupce='akcept'.$pocet_zobr;
$podminkaakcept=($pocet_zobr==$pocetpredmetu)?$podminkaakcept."(`{$jmenoakceptsloupce}` = 'ano')" :$podminkaakcept."(`{$jmenoakceptsloupce}` = 'ano')   AND  " ;
$podminkaneakcept=($pocet_zobr==$pocetpredmetu)?$podminkaneakcept."(`{$jmenoakceptsloupce}` != 'ano')" :$podminkaakcept."(`{$jmenoakceptsloupce}` != 'ano')   OR  " ;
//$podminkaakcept="(`akcept1` = 'ano' )   AND  (`akcept2` = 'ano')";
//$podminkaneakcept="( `akcept1` != 'ano' )   OR  (`akcept2` != 'ano')";
                                                                 }	
}
else {
$podminka='';$podminkaakcept='';$podminkaneakcept='';
 for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
$jmenopredmetsloupce='predmet'.$pocet_zobr;
$jmenoakceptsloupce='akcept'.$pocet_zobr;
$podminka=($pocet_zobr==$pocetpredmetu)?$podminka."(`{$jmenopredmetsloupce}`='".$f_napredmet."')":$podminka."(`{$jmenopredmetsloupce}`='".$f_napredmet."')   OR  ";
//$podminka="`predmet1` = '".$f_napredmet."'   OR  `predmet2`= '".$f_napredmet."'";
$podminkaakcept=($pocet_zobr==$pocetpredmetu)?$podminkaakcept."(`{$jmenopredmetsloupce}`= '".$f_napredmet."' AND `{$jmenoakceptsloupce}` = 'ano')":$podminkaakcept."(`{$jmenopredmetsloupce}`= '".$f_napredmet."' AND `{$jmenoakceptsloupce}` = 'ano')   OR  ";
//$podminkaakcept="(`predmet1` = '".$f_napredmet."' AND `akcept1` = 'ano' )   OR  (`predmet2`= '".$f_napredmet."' AND `akcept2` = 'ano')";
$podminkaneakcept=($pocet_zobr==$pocetpredmetu)?$podminkaneakcept."(`{$jmenopredmetsloupce}`= '".$f_napredmet."' AND `{$jmenoakceptsloupce}` != 'ano')":$podminkaneakcept."(`{$jmenopredmetsloupce}`= '".$f_napredmet."' AND `{$jmenoakceptsloupce}` != 'ano')   OR  ";

//$podminkaneakcept="(`predmet1` = '".$f_napredmet."' AND `akcept1` != 'ano' )   OR  (`predmet2`= '".$f_napredmet."' AND `akcept2` != 'ano')";	
                                                                  }

                                                                 
}


@$vsechnyzazanamy=MySQL_Query(" SELECT COUNT( * ) AS celkemprihlaseno
FROM $this->Nazev
WHERE $podminka  
; ")OR DIE(MySQL_Error()) ; 
$zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC) ;

          foreach($zaznam as $k => $v) {
         
               $ven[$k]=$v;
         	
                         
                                       }
         
       
         
@$vsechnyzazanamy=MySQL_Query(" SELECT COUNT( * ) AS akceptovano
FROM $this->Nazev
WHERE $podminkaakcept 
; ")OR DIE(MySQL_Error()) ;            
$zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC) ;
 
          foreach($zaznam as $k => $v) {
         
               $ven[$k]=$v;
         	
                         
                                       }   
                                          
                                                                     
     
@$vsechnyzazanamy=MySQL_Query(" SELECT COUNT( * ) AS neakceptovano
FROM $this->Nazev
WHERE $podminkaneakcept 
; ")OR DIE(MySQL_Error()) ;            
$zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC) ;
 
          foreach($zaznam as $k => $v) {
         
               $ven[$k]=$v;
         	
                         
                                       }          	
                         
                                                                                                         
return ($ven);
 }       

function PocetPrihlasenychTrida($f_trida='')
 { 
$pocetpredmetu=$this->Urci_pocet_vol_predmetu();
$f_trida=$this->inject_addslashes($f_trida);
if ($f_trida=='') {
$podminka="`id` > -1 ";$podminkaakcept='';$podminkaneakcept='';
for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
//$jmenopredmetsloupce='predmet'.$pocet_zobr;
$jmenoakceptsloupce='akcept'.$pocet_zobr;
$podminkaakcept=($pocet_zobr==$pocetpredmetu)?$podminkaakcept."(`{$jmenoakceptsloupce}` = 'ano')" :$podminkaakcept."(`{$jmenoakceptsloupce}` = 'ano')   AND  " ;
$podminkaneakcept=($pocet_zobr==$pocetpredmetu)?$podminkaneakcept."(`{$jmenoakceptsloupce}` != 'ano')" :$podminkaneakcept."(`{$jmenoakceptsloupce}` != 'ano')   OR  " ;

                                                                 }
//$podminkaakcept="(`akcept1` = 'ano' )   AND  (`akcept2` = 'ano')";
//$podminkaneakcept="( `akcept1` != 'ano' )   OR  (`akcept2` != 'ano')";	
}
else {
$podminka="`trida` = '".$f_trida."'";
$podminkaakcept="(`trida` = '".$f_trida."')   AND  ";
$podminkaneakcept='';
for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
//$jmenopredmetsloupce='predmet'.$pocet_zobr;
$jmenoakceptsloupce='akcept'.$pocet_zobr;
$podminkaakcept=($pocet_zobr==$pocetpredmetu)?$podminkaakcept."(`{$jmenoakceptsloupce}` = 'ano')" :$podminkaakcept."(`{$jmenoakceptsloupce}` = 'ano')   AND  " ;
$podminkaneakcept=($pocet_zobr==$pocetpredmetu)?$podminkaneakcept."(`trida` = '{$f_trida}' AND `{$jmenoakceptsloupce}` != 'ano')" :$podminkaneakcept."(`trida` = '{$f_trida}' AND `{$jmenoakceptsloupce}` != 'ano')   OR  " ;

                                                                 }

//$podminkaakcept="(`trida` = '".$f_trida."' AND `akcept1` = 'ano' AND `akcept2` = 'ano')";
//$podminkaneakcept="(`trida` = '".$f_trida."' AND `akcept1` != 'ano' )   OR  (`trida`= '".$f_trida."' AND `akcept2` != 'ano')";	
}


@$vsechnyzazanamy=MySQL_Query(" SELECT COUNT( * ) AS celkemprihlaseno
FROM $this->Nazev
WHERE $podminka
; ")OR DIE(MySQL_Error()) ; 
$zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC) ;

          foreach($zaznam as $k => $v) {
         
               $ven[$k]=$v;
         	
                         
                                       }
         
         
      
@$vsechnyzazanamy=MySQL_Query(" SELECT COUNT( * ) AS akceptovano
FROM $this->Nazev
WHERE $podminkaakcept 
; ")OR DIE(MySQL_Error()) ;            
$zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC) ;
 
          foreach($zaznam as $k => $v) {
         
               $ven[$k]=$v;
         	
                         
                                       }         
                                                                    
        
@$vsechnyzazanamy=MySQL_Query(" SELECT COUNT( * ) AS neakceptovano
FROM $this->Nazev
WHERE $podminkaneakcept 
; ")OR DIE(MySQL_Error()) ;            
$zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC) ;
 
          foreach($zaznam as $k => $v) {
         
               $ven[$k]=$v;
         	
                         
                                       }          	
                         
                                                                                                        
return ($ven);
 }       


function PocetVybranychNahradnichPredmet($f_napredmet)
 {
 $f_napredmet=$this->inject_addslashes($f_napredmet);
 




$jmenopredmetsloupce='predmetnahradni';
$podminka="(`{$jmenopredmetsloupce}`='".$f_napredmet."')";                                                  
@$vsechnyzazanamy=MySQL_Query(" SELECT COUNT( * ) AS nahradni
FROM $this->Nazev
WHERE $podminka  
; ")OR DIE(MySQL_Error()) ; 
$zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC) ;

$ven=$zaznam;          

                                                                                                       
return ($ven);
 }       


/*---------------------------Popis metody Admineditacetab()---------------------

Metoda  Admineditacetab($kamodelsat='administrace.php',$f_kategorie='')
vypisuje obsah tabulky a nab�z� z�kladn� form�tov�n� pro Admina:
id...neform�tov�no
datum,autor: v�stup ve form� <span class=\"datum, autor\"> hodnota</span>
email      :v�stup ve form� <a href=\"mailto:$v\" class=\"email\" > hodnota </a>
ostan� :v�stup ve form� <div class=\"jmeno_sloupce\"> hodnota</div>


Roz���en�:
Parametr $kamodelsat ur�uje zpacovatelsk� skript.
Ke kazd�mu z�znamu p�id�v� za�krt�vac� pol��ko input type="checkbox" pro 
ozna�en� a n�sledn� vymaz�n� z�znamu
a tla��tko s id pro editaci z�znamu

------------------------------------------------------------------------------*/
 function Admineditacetab($f_id,$kamodelsat='administrace.php',$f_sloupec='',$f_kriterium='', $f_tridit_podle='id DESC',$f_vlastnik='')
 {
global $smaz,$akce,$oznvse;
$pocetpredmetu=$this->Urci_pocet_vol_predmetu();
$zaskrt = $oznvse=='ano' ? 'checked=\"checked\"' : ' ';
 echo" 
Hlavn� str�nka editace. Umo��uje vkl�d�n�, maz�n� a editaci obsahu rubriky. 
 <form action=\"$kamodelsat\"  method=\"post\"  enctype=\"multipart/form-data\" >
     ";
     
echo" <div class=\"skrolovatko\"> ";

if($f_id!=""){  //zobraz novinku nahore
$VybranaPolozka=CRubrika::VyberPolozku($f_id);    

 echo"<div class=\"centrovano\">    
    <table  class=\"polozka\" width=\"80%\">
 <tr class=\"nadpisvpolozce \" ><td colspan=\"2\">
<span class=\"obrvlevo\"> ozna�it :<input type=\"checkbox\" $zaskrt name=\"smaz[]\" value=\"".$VybranaPolozka[id]."\" /></span>
<span class=\"obrvpravo\">  editovat z�znam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$VybranaPolozka[id]."\" class=\"tlacitko\" /></span> 
 </td></tr>";
echo"<tr><td  colspan=\"2\"> <a name=\"".$VybranaPolozka[id]."\"> </a>";
  echo"</td></tr>";
  echo"<tr><td> Jm�no:</td><td>".$VybranaPolozka[jmeno]."</td></tr>";  
  echo"<tr><td> P��jmen�:</td><td>".$VybranaPolozka[prijmeni]."</td></tr>";
  echo"<tr><td> T��da:</td><td>".$VybranaPolozka[trida]."</td></tr>";
  for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
  $jmenopredmetsloupce='predmet'.$pocet_zobr; 
$jmenoakceptsloupce='akcept'.$pocet_zobr;
  $zvyraznit=($VybranaPolozka[$jmenoakceptsloupce]=='ano')? "class=\"zvyraznitano\"" : "class=\"zvyraznitne\"";
    echo"<tr><td>  P�edm�t �. $pocet_zobr :</td><td $zvyraznit>".$VybranaPolozka[$jmenopredmetsloupce]."</td></tr>";
                                                                 }
if ($this->Pocet_nahradnich_predmetu()>0) {
echo"<tr><td> N�hradn� p�edm�t:</td><td>".$VybranaPolozka[predmetnahradni]."</td></tr>";	
}	

     
  
echo"<tr><td> Pozn�mka:</td><td>".NL2BR($VybranaPolozka[poznamka])."</td></tr>";  
echo"<tr><td  >  <a href=\"tisk_hesla.php?id=".$VybranaPolozka[id]."\"   class=\" tiskzpravyvlevo\" 
 onclick=\"return !window.open(this.href)\">Tisk v�etn� hesla </a>  
  </td>
 <td align=\"right\">  <a href=\"tisk.php?id=".$VybranaPolozka[id]."\"   class=\" tiskzpravy\" 
 onclick=\"return !window.open(this.href)\">Tisk  </a>  
  </td> 
  </tr></table>
  
  </div>";
  
echo"<br />";
                                             
                      


               } //zobraz novinku nahore

else { //k zobraz v�e

switch ($f_sloupec) {
case 'predmet':
$f_kriterium=$this->inject_addslashes($f_kriterium);
$podminka='';
for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
$jmenopredmetsloupce='predmet'.$pocet_zobr;
$podminka=($pocet_zobr==$pocetpredmetu)?$podminka."(`{$jmenopredmetsloupce}`='".$f_kriterium."')":$podminka."(`{$jmenopredmetsloupce}`='".$f_kriterium."')   OR  ";	
                                                                  }
//$podminka="`predmet1` = '".$f_kriterium."'   OR  `predmet2`= '".$f_kriterium."'";
//echo" podminka: $podminka";
$PolePolozek= $this->VyberSeznam($podminka);
$pocetstudentu=count($PolePolozek[id]);
echo" 
                
           <div class=\"centrovano\">
               Studenti kte�� volili: $f_kriterium ($pocetstudentu)
           </div>  ";



	break;
case 'predmetakcept':
$f_kriterium=$this->inject_addslashes($f_kriterium);
$podminka='';
for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
$jmenopredmetsloupce='predmet'.$pocet_zobr;
$jmenoakceptsloupce='akcept'.$pocet_zobr;
$podminka=($pocet_zobr==$pocetpredmetu)?$podminka."(`{$jmenopredmetsloupce}`= '".$f_kriterium."' AND `{$jmenoakceptsloupce}` = 'ano')":$podminka."(`{$jmenopredmetsloupce}`= '".$f_kriterium."' AND `{$jmenoakceptsloupce}` = 'ano')   OR  ";


                                                                  }
//$podminka="(`predmet1` = '".$f_kriterium."' AND `akcept1` = 'ano'   ) OR (  `predmet2`= '".$f_kriterium."' AND `akcept2` = 'ano')";
//echo" podminka: $podminka";
$PolePolozek= $this->VyberSeznam($podminka);
$pocetstudentu=count($PolePolozek[id]);
echo" 
                
           <div class=\"centrovano\">
             <span class=\"zvyraznitano\">  Studenti kte�� maj� akceptov�n : $f_kriterium ($pocetstudentu)</span>
           </div>  ";


	break;
  case 'predmetneakcept':
  $f_kriterium=$this->inject_addslashes($f_kriterium);
  $podminka='';
  for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
$jmenopredmetsloupce='predmet'.$pocet_zobr;
$jmenoakceptsloupce='akcept'.$pocet_zobr;

$podminka=($pocet_zobr==$pocetpredmetu)?$podminka."(`{$jmenopredmetsloupce}`= '".$f_kriterium."' AND `{$jmenoakceptsloupce}` != 'ano')":$podminka."(`{$jmenopredmetsloupce}`= '".$f_kriterium."' AND `{$jmenoakceptsloupce}` != 'ano')   OR  ";	
                                                                  }
//$podminka="(`predmet1` = '".$f_kriterium."' AND `akcept1` != 'ano'   ) OR (  `predmet2`= '".$f_kriterium."' AND `akcept2` != 'ano')";
//echo" podminka: $podminka";
$PolePolozek= $this->VyberSeznam($podminka);
$pocetstudentu=count($PolePolozek[id]);
echo" 
                
            <div class=\"centrovano\">
             <span class=\"zvyraznitne\">  Studenti kte�� nemaj� akceptov�n : $f_kriterium ($pocetstudentu)</span>
           </div> ";
	break;
case 'tridaakcept':
$f_kriterium=$this->inject_addslashes($f_kriterium);
$podminka="(`trida` = '".$f_kriterium."')   AND  ";
for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
$jmenoakceptsloupce='akcept'.$pocet_zobr;
$podminka=($pocet_zobr==$pocetpredmetu)?$podminka."(`{$jmenoakceptsloupce}` = 'ano')" :$podminka."(`{$jmenoakceptsloupce}` = 'ano')   AND  " ;


                                                                 }
//$podminka="(`trida` = '".$f_kriterium."' AND `akcept1` = 'ano'   AND `akcept2` = 'ano')";
//echo" podminka: $podminka";
$PolePolozek= $this->VyberSeznam($podminka);
$pocetstudentu=count($PolePolozek[id]);
echo" 
                
           <div class=\"centrovano\">
             <span class=\"zvyraznitano\">  Studenti t��dy $f_kriterium ($pocetstudentu) kte�� maj� v�echny p�edm�ty akceptov�ny  </span>
           </div>  ";


	break;  
case 'tridaneakcept':
$f_kriterium=$this->inject_addslashes($f_kriterium);
$podminkaneakcept='';
for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
$jmenoakceptsloupce='akcept'.$pocet_zobr;
$podminka=($pocet_zobr==$pocetpredmetu)?$podminka."(`trida` = '{$f_kriterium}' AND `{$jmenoakceptsloupce}` != 'ano')" :$podminka."(`trida` = '{$f_kriterium}' AND `{$jmenoakceptsloupce}` != 'ano')   OR  " ;

                                                                 }

//$podminka="(`trida` = '".$f_kriterium."' AND `akcept1` != 'ano'   ) OR (  `trida`= '".$f_kriterium."' AND `akcept2` != 'ano')";
//echo" podminka: $podminka";
$PolePolozek= $this->VyberSeznam($podminka);
$pocetstudentu=count($PolePolozek[id]);
echo" 
                
            <div class=\"centrovano\">
             <span class=\"zvyraznitne\">  Studenti tr�dy $f_kriterium ($pocetstudentu) kte�� nemaj� akceptov�ny v�echny p�edm�ty <br />
              tj. alespo� jeden p�edm�t je neakceptov�n </span>
           </div> ";
	break;  
 case 'vseakcept': 
$podminka='';
for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
$jmenoakceptsloupce='akcept'.$pocet_zobr;
$podminka=($pocet_zobr==$pocetpredmetu)?$podminka."(`{$jmenoakceptsloupce}` = 'ano')" :$podminka."(`{$jmenoakceptsloupce}` = 'ano')   AND  " ;
                                                                 }

//$podminka="(`akcept1` = 'ano'   AND `akcept2` = 'ano')";
//echo" podminka: $podminka";
$PolePolozek= $this->VyberSeznam($podminka);
$pocetstudentu=count($PolePolozek[id]);
echo" 
                
           <div class=\"centrovano\">
             <span class=\"zvyraznitano\">  Studenti ro�n�ku ($pocetstudentu) kte�� maj� v�echny p�edm�ty akceptov�ny  </span>
           </div>  ";


	break;
 case 'vseneakcept':
 $podminka='';
for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
$jmenoakceptsloupce='akcept'.$pocet_zobr;
$podminka=($pocet_zobr==$pocetpredmetu)?$podminka."(`{$jmenoakceptsloupce}` != 'ano')" :$podminka."(`{$jmenoakceptsloupce}` != 'ano')   OR  " ;
                                                                 }
//$podminka="(`akcept1` != 'ano'   ) OR ( `akcept2` != 'ano')";
//echo" podminka: $podminka";
$PolePolozek= $this->VyberSeznam($podminka);
$pocetstudentu=count($PolePolozek[id]);
echo" 
                
            <div class=\"centrovano\">
             <span class=\"zvyraznitne\">  Studenti ro�n�ku ($pocetstudentu) kte�� nemaj� akceptov�ny v�echny p�edm�ty <br />tj. alespo� jeden p�edm�t je neakceptov�n </span>
           </div> ";
	break;  
     	
default:
$PolePolozek=CRubrika::FormatujObashRubriky($f_sloupec,$f_kriterium, $f_tridit_podle);	
	break;
}



//echo" po�et z�znam�:".$this->get_pocet_zaznamu()." <br />"; 

         

     
for ($i=0;$i<count($PolePolozek[id]) ;$i++) {

 echo"<div class=\"centrovano\">    
    <table  class=\"polozka\" width=\"80%\">
 <tr class=\"nadpisvpolozce \" ><td colspan=\"2\">
<span class=\"obrvlevo\"> ozna�it :<input type=\"checkbox\" $zaskrt name=\"smaz[]\" value=\"".$PolePolozek[id][$i]."\" /></span>
<span class=\"obrvpravo\">  editovat z�znam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$PolePolozek[id][$i]."\" class=\"tlacitko\" /></span> 
 </td></tr>";
echo"<tr><td class=\"textvpolozce \" colspan=\"2\"> <a name=\"".$PolePolozek[id][$i]."\"> </a></td></tr>";
echo"<tr><td> Jm�no:</td><td>".$PolePolozek[jmeno][$i]."</td></tr>";  
  echo"<tr><td> P��jmen�:</td><td>".$PolePolozek[prijmeni][$i]."</td></tr>";
  echo"<tr><td> T��da:</td><td>".$PolePolozek[trida][$i]."</td></tr>";  
  for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
  $jmenopredmetsloupce='predmet'.$pocet_zobr; 
$jmenoakceptsloupce='akcept'.$pocet_zobr;
 $zvyraznit=($PolePolozek[$jmenoakceptsloupce][$i]=='ano') ? "class=\"zvyraznitano\"" : "class=\"zvyraznitne\"";  
  echo"<tr><td> P�edm�t �.$pocet_zobr :</td><td $zvyraznit>".$PolePolozek[$jmenopredmetsloupce][$i]."</td></tr>";
                                                                    }
 if ($this->Pocet_nahradnich_predmetu()>0) {
echo"<tr><td> N�hradn� p�edm�t:</td><td>".$PolePolozek[predmetnahradni][$i]."</td></tr>" ;   }  
echo"<tr><td> Pozn�mka:</td><td>".NL2BR($PolePolozek[poznamka][$i])."</td></tr>";

echo"
<tr><td>
  <a href=\"tisk_hesla.php?id=".$PolePolozek[id][$i]."\"   class=\" tiskzpravyvlevo\" 
 onclick=\"return !window.open(this.href)\">Tisk v�etn� hesla </a> 
  </td>
<td>
  <a href=\"tisk.php?id=".$PolePolozek[id][$i]."\"   class=\" tiskzpravy\" 
 onclick=\"return !window.open(this.href)\">Tisk </a> 
  </td></tr></table>
  
  </div>";
  
echo"<br />";
                              }                
                      
                  
        }//k zobraz v�e
 echo" </div>" ; // skrolovatko                                                
 echo"
 <a name=\"mazani\"></a>
 <hr />";                                        
echo" <table width=\"80%\" border=\"0\">  
   <tr><td>
     <div  >Ozna�it V�ECHNY  z�znamy    <input type=\"submit\"  value=\"ano\" name=\"oznvse\" class=\"tlacitko\" />  <input type=\"submit\"  value=\"odzna�it\" name=\"oznvse\" class=\"tlacitko\" />  </div>
";

echo"<input type=\"hidden\" name=\"akce\" value=\"editace_stranky\" />";
echo"
<hr />
<a href=\"#mazani\"  onclick=\"document.getElementById('smazpoznaky').style.visibility='visible'\" ><span class=\"tlacodkaz\">Vymazat pozn�mky u ozna�en�ch polo�ek ( student� )? </span></a>
<span class=\"chyba\" id=\"smazpoznaky\" style=\"visibility: hidden;\"> Potv�te :  <input type=\"submit\"  value=\"smazat_poznamky\" name=\"editakce\" class=\"tlacitko\" />  u ozna�en�ch polo�ek ( student� )?</span>
";
if ($this->Pocet_nahradnich_predmetu()>0) {
echo"
<hr />
<a href=\"#mazani\"  onclick=\"document.getElementById('vynulovaninahradnich').style.visibility='visible'\" ><span class=\"tlacodkaz\">Vynulovat  n�hradn� p�edm�ty u ozna�en�ch polo�ek ( student� )? </span></a>
<span class=\"chyba\" id=\"vynulovaninahradnich\" style=\"visibility: hidden;\"> Potv�te :  <input type=\"submit\"  value=\"vynulovat_nahradni\" name=\"editakce\" class=\"tlacitko\" />  p�edm�ty  u ozna�en�ch polo�ek ( student� )?</span>
";
                                             }
echo"
<hr />
<a href=\"#mazani\"  onclick=\"document.getElementById('vynulovani').style.visibility='visible'\" ><span class=\"tlacodkaz\">Vynulovat p�edm�ty a pozn�mky u ozna�en�ch polo�ek ( student� )? </span></a>
<span class=\"chyba\" id=\"vynulovani\" style=\"visibility: hidden;\"> Potv�te :  <input type=\"submit\"  value=\"vynulovat\" name=\"editakce\" class=\"tlacitko\" />  p�edm�ty a pozn�mky u ozna�en�ch polo�ek ( student� )?</span>

<hr />
<a href=\"#mazani\"  onclick=\"document.getElementById('odakceptovat').style.visibility='visible'\" ><span class=\"tlacodkaz\">Odvolat akceptov�n� v�ech p�edm�t� u ozna�en�ch polo�ek ( student� )? </span></a>
<span class=\"chyba\" id=\"odakceptovat\" style=\"visibility: hidden;\"> Potv�te :  <input type=\"submit\"  value=\"odvolat\" name=\"editakce\" class=\"tlacitko\" /> akceptov�n� v�ech p�edm�t� u ozna�en�ch polo�ek ( student� ) </span>
<hr />

<a href=\"#mazani\"  onclick=\"document.getElementById('odstranittlacitko').style.visibility='visible'\" ><span class=\"tlacodkaz\">Odstranit ozna�en� polo�ky ( studenty )? </span></a>
 <span class=\"chyba\" id=\"odstranittlacitko\" style=\"visibility: hidden;\">
 Potv�te : Trvale   <input type=\"submit\"  value=\"smazat\" name=\"editakce\" class=\"tlacitko\" /> ozna�en� polo�ky ( studenty )</span>
    </td></tr> </table>
</form>  
                                              
     ";

}
/*----------------------------------------------------------------------------*/


/*---------------------------Popis metody Adminzaznamudotaz()-------------------

Metoda Adminzaznamudotaz($f_id,$fzpracovani='administrace.php')
generuje formul�� pro update �daj� ve vybran�m z�znamu. 
Form�tov�n� do tabulky.
Prvn� sloupec : n�zvy sloupc� z tabulky MySQL datab�ze.
Typy jednotliv�ch vstupn�ch pol�:
nadpis, autor,email: input type="text" 
text:               textarea
neur�en� : negeneruje nic, je nutno doplnit    case 'dal�� �daj': vstupni pole  
                                                     break;
P�i odesl�n� formul��e je odes�l�n parametr odeslano=true 
parametr $fzpracovani ur�uje zpracovatelsk� skript.
 
Roz���en�:
umo�n� update foto  .
Pozn. fotka ji� nen� povinn�.                                               
------------------------------------------------------------------------------*/
 
function Adminzaznamudotaz($f_id,$fzpracovani='administrace.php')
{ 
global $akce,$codelat,$editzaznam,$superadmin;
$pocetpredmetu=$this->Urci_pocet_vol_predmetu();
$seznampredmetu= $this->VyberSeznamPredmetu();
$seznamtrid =$this->VyberObsahSloupce('trida');
$PoleZaznamu=CRubrika::VyberPolozku($f_id); 
//echo" Z�zanm �.:$PoleZaznamu[id] Datum z�znamu: $PoleZaznamu[datum]<br />";

echo"
 <div class=\"centrovano\">
<form enctype=\"multipart/form-data\" action=\"$fzpracovani\" method=\"post\">";
           

echo"
<table border=\"1\"  class=\"centrovano\" >
    "; 
    
  for ($i=0;$i<$this->pocetsloupcu ;$i++ ) {
  //$chyba[$i]='*';  
  //$nazevsloupce=$this->sloupec[$i];
   // $hodnotavtabulce=$PoleZaznamu[ $nazevsloupce];
  
  switch ($this->sloupec[$i]) {
   case 'jmeno':
  echo"<tr><td>"; echo" Jm�no:</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
  case 'prijmeni':
  echo"<tr><td>"; echo"P��jmen�:</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
    
 case 'prezdivka':
  echo"<tr class=\"nadpisv-n-c\"><td>"; echo"U�ivatelsk� jm�no:</td>";
        echo"<td>".      
        $PoleZaznamu[$this->sloupec[$i]]."
        <input type=\"hidden\"  name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" /></td></tr>
            ";
         	break;       	
         	
         	
         	
   case 'heslo': 
   echo"<tr><td>";echo $this->sloupec[$i]; echo":</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break; 
  
 case 'trida':
  
     /* echo"<tr><td>T��da :</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" />".$this->chyba[$i]."</td></tr>
            ";*/
  
      echo"<tr><td>T��da :</td>";
        echo"<td class=\"chyba\"><select name=\"".$this->sloupec[$i]."\" 
     size=\"1\" >"; 
     
     for ($p=0;$p<count($seznamtrid) ;$p++ ) {
     if ($seznamtrid[$p]==$PoleZaznamu[$this->sloupec[$i]]) {
     	echo"<option value=\"".$seznamtrid[$p]."\" selected=\"selected\" >".$seznamtrid[$p]."</option>";
     } 
     else echo"<option value=\"".$seznamtrid[$p]."\">".$seznamtrid[$p]."</option>";
     	
     }
        echo"</select>".$this->chyba[$i]."</td></tr>
            ";  
  
  
            
            
         	break; 
 
     	
case 'predmet1':
  for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
  $jmenopredmetsloupce='predmet'.$pocet_zobr;
      echo"<tr><td>P�edm�t �.$pocet_zobr :</td>";
        echo"<td class=\"chyba\"><select name=\"".$jmenopredmetsloupce."\" 
     size=\"1\" >"; 
     echo"<option value=\"Vyberte si p�edm�t\"  >Vyberte si p�edm�t</option>"; 
     for ($p=0;$p<count($seznampredmetu[id]) ;$p++ ) {
     if ($seznampredmetu[predmet][$p]==$PoleZaznamu[$jmenopredmetsloupce]) {
     	echo"<option value=\"".$seznampredmetu[predmet][$p]."\" selected=\"selected\" >".$seznampredmetu[predmet][$p]."</option>";
     } 
     else {
    
     $zanazvem='_(sk.'.$pocet_zobr.')';
      if ( strstr($seznampredmetu[predmet][$p], $zanazvem)) {
       echo"<option value=\"".$seznampredmetu[predmet][$p]."\">".$seznampredmetu[predmet][$p]."</option>";	
                                                              }   
          } 
     	
     }
        echo"</select>".$this->chyba[$i+2*($pocet_zobr-1)]."</td></tr>
            ";        
      
$jmenoakceptsloupce='akcept'.$pocet_zobr;
 echo"<tr><td colspan=\"2\">";
echo " <span class=\"obrvlevo\">Akceptovat $pocet_zobr. p�edm�t : "; 
   if ($PoleZaznamu[$jmenoakceptsloupce]=='ano') {
 echo"
  <input type=\"radio\" name=\"".$jmenoakceptsloupce."\" value=\"ano\" checked=\"checked\" /> ANO</span>
  <span class=\"obrvpravo\"><input type=\"radio\" name=\"".$jmenoakceptsloupce."\" value=\"ne\"  />NE</span>
    ";	
} 
else {
 echo"
  <input type=\"radio\" name=\"".$jmenoakceptsloupce."\" value=\"ano\" />ANO</span>
  <span class=\"obrvpravo\"><input type=\"radio\" name=\"".$jmenoakceptsloupce."\" value=\"ne\" checked=\"checked\"  />NE</span>
    ";	
} 
  echo"</td></tr>  "; 
  }
	break;        
   case 'predmetnahradni':
       $jmenopredmetsloupce='predmetnahradni';
         echo"<tr><td>N�hradn� p�edm�t:</td>";
        echo"<td class=\"chyba\"><select name=\"".$jmenopredmetsloupce."\" 
     size=\"1\" >"; 
     echo"<option value=\"Vyberte si p�edm�t\"  >Vyberte si p�edm�t</option>"; 
     for ($p=0;$p<count($seznampredmetu[id]) ;$p++ ) {
     if ($seznampredmetu[predmet][$p]==$PoleZaznamu[$jmenopredmetsloupce]) {
     	echo"<option value=\"".$seznampredmetu[predmet][$p]."\" selected=\"selected\" >".$seznampredmetu[predmet][$p]."</option>";
     } 
     else echo"<option value=\"".$seznampredmetu[predmet][$p]."\">".$seznampredmetu[predmet][$p]."</option>";
     	
     }
        echo"</select>".$this->chyba[$i]."</td></tr>
            ";   
         	break;        
           
                                  	
           
   case 'poznamka':
   
         echo"<tr><td>Pozn�mka:</td>";
        echo"
       <td class=\"chyba\">
        <textarea   rows=\"7\" name=\"".$this->sloupec[$i]."\" cols=\"50\">".$PoleZaznamu[$this->sloupec[$i]]."</textarea>".$this->chyba[$i]."</td></tr>
            ";
         	break;  
                 
              
  default:
  	/* neprov�d� se nic*/
  	break;
  }

}  




echo"</td></tr> ";

 
if ($fzpracovani=='editace.php') echo" 
 <tr><td colspan=\"2\"  class=\"centrovano\" >                
<input type=\"hidden\" name=\"odeslano\" value=\"true\" />
<br />
<input type=\"submit\"  value=\"ulo�it\" name=\"codelat\" class=\"tlacitko\" />
<hr />

 <input type=\"reset\" value=\"smazat neodeslan� �daje\" class=\"tlacitko\" />
 <hr />
<input type=\"submit\" name=\"codelat\" value=\"odstranit z�znam\" class=\"tlacitko\"/>
<input type=\"hidden\" name=\"akce\" value=\"editace_stranky\" />
<input type=\"hidden\" name=\"editzaznam\" value=\"editovat_z�znam\" />
<input type=\"hidden\" name=\"kohoeditovat\" value=\"$f_id\" />


  </td></tr>
</table>
</form>
 </div> <!--     centrov�no    -->
                                     ";


                            else echo"  
 <tr><td colspan=\"2\"  class=\"centrovano\" >                
<input type=\"hidden\" name=\"odeslano\" value=\"true\" />
<br />
<input type=\"submit\"  value=\"odeslat\" name=\"dotaznik\" class=\"tlacitko\" />
<input type=\"hidden\" name=\"codelat\" value=\"ulo�it\" />
<input type=\"hidden\" name=\"akce\" value=\"editace_stranky\" />
<input type=\"hidden\" name=\"editzaznam\" value=\"editovat_z�znam\" />
<input type=\"hidden\" name=\"kohoeditovat\" value=\"$f_id\" />

<hr />
 <input type=\"reset\" value=\"smazat neodeslan� �daje\" class=\"tlacitko\" />
  </td></tr>
</table>
</form>
 </div> <!--     centrov�no    -->
   ";
 }




/*----------------------------------------------------------------------------*/
/*---------------------------Popis metody Formular_obec()-----------------------

Metoda Formular_obec($fsloupec,$fzpracovani='formular.php')
generuje formul�� pro odesl�n� z�znamu. Form�tov�n� do tabulky.
Prvn� sloupec : n�zvy sloupc� z tabulky MySQL datab�ze.
Typy jednotliv�ch vstupn�ch pol�:
nadpis, autor,email: input type="text" 
text:               textarea
neur�en� : negeneruje nic, je nutno doplnit    case 'dal�� �daj': vstupni pole  
                                                     break;
P�i odesl�n� formul��e je odes�l�n parametr odeslano=true 
parametr $fzpracovani ur�uje zpracovatelsk� skript.
 
Roz���en�:
V p��pad� , �e po�et fotek v adres��i je men�� ne� 50, p�id� pole pro odesl�n� 
fotky ve form�tu jpg input name=\"soubor\" type=\"file\"                                                
------------------------------------------------------------------------------*/

function Formular_obec($fsloupec,$fcopridat,$fzpracovani='administrace.php')
{ 
$seznampredmetu= $this->VyberSeznamPredmetu();
$seznamtrid =$this->VyberObsahSloupce('trida');
$pocetpredmetu=$this->Urci_pocet_vol_predmetu();
echo"
  <div class=\"centrovano\">
<form enctype=\"multipart/form-data\" action=\"$fzpracovani\" method=\"post\" id=\"formular\"  name=\"formular\">
<table border=\"1\"  class=\"centrovano\" >
    "; 
  for ($i=0;$i<$this->pocetsloupcu ;$i++ ) {
  //$chyba[$i]='*';  
  
  switch ($this->sloupec[$i]) {
  
 
 case 'trida':
  
    /*echo"<tr><td>T��da :</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$fsloupec[$i]."\" />".$this->chyba[$i]."</td></tr>
            ";*/
echo"<tr><td>T��da :</td>";
        echo"<td class=\"chyba\"><select  onchange=\"document.formular.".$this->sloupec[$i].".value = pomocny.options[pomocny.selectedIndex].value\" name=\"pomocny\" id=\"pomocny\" 
     size=\"1\" >"; 
      echo"<option value=''>Vyberte t��du</option>";
     for ($p=0;$p<count($seznamtrid) ;$p++ ) 
     echo"<option value=\"".$seznamtrid[$p]."\">".$seznamtrid[$p]."</option>";
     	
    
        echo"</select>
        <input type=\"text\"  id=\"".$this->sloupec[$i]."\" name=\"".$this->sloupec[$i]."\"  value=\"".$fsloupec[$i]."\" size=\"10\">
        
        
        ".$this->chyba[$i]."</td></tr>
            ";            
            
         	break; 
 case 'prezdivka':
  
      echo"<tr><td>P�ezd�vka :</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$fsloupec[$i]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;   
 case 'heslo':
  
      echo"<tr><td>heslo :</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$fsloupec[$i]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break; 
 case 'jmeno':
  
      echo"<tr><td>Jm�no :</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$fsloupec[$i]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
case 'prijmeni':
  
      echo"<tr><td>P��jmen� :</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$fsloupec[$i]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;         	
         	
case 'predmet1':
for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ) {
$jmenopredmetsloupce='predmet'.$pocet_zobr;	
 
      echo"<tr><td>P�edm�t �.$pocet_zobr :</td>";
        echo"<td class=\"chyba\"><select name=\"".$jmenopredmetsloupce."\" 
     size=\"1\" >";
     echo"<option value=\"Vyberte si p�edm�t\"  >Vyberte si p�edm�t</option>";  
     for ($p=0;$p<count($seznampredmetu[id]) ;$p++ ) {
     if ($seznampredmetu[predmet][$p]==$PoleZaznamu[$jmenopredmetsloupce]) {
     	echo"<option value=\"".$seznampredmetu[predmet][$p]."\" selected=\"selected\" >".$seznampredmetu[predmet][$p]."</option>";
     } 
     else {
    
     $zanazvem='_(sk.'.$pocet_zobr.')';
      if ( strstr($seznampredmetu[predmet][$p], $zanazvem)) {
       echo"<option value=\"".$seznampredmetu[predmet][$p]."\">".$seznampredmetu[predmet][$p]."</option>";	
                                                              }   
          } 
     
      
     	
     }
                                                                   
        echo"</select>".$this->chyba[$i]."</td></tr>
            ";          
                                                              }
         	break;
         	
case 'predmetnahradni':

$jmenopredmetsloupce='predmetnahradni';	
 
      echo"<tr><td>N�hradn� p�edm�t :</td>";
        echo"<td class=\"chyba\"><select name=\"".$jmenopredmetsloupce."\" 
     size=\"1\" >";
     echo"<option value=\"Vyberte si p�edm�t\"  >Vyberte si p�edm�t</option>";  
     for ($p=0;$p<count($seznampredmetu[id]) ;$p++ ) {
     if ($seznampredmetu[predmet][$p]==$PoleZaznamu[$jmenopredmetsloupce]) {
     	echo"<option value=\"".$seznampredmetu[predmet][$p]."\" selected=\"selected\" >".$seznampredmetu[predmet][$p]."</option>";
     } 
     else echo"<option value=\"".$seznampredmetu[predmet][$p]."\">".$seznampredmetu[predmet][$p]."</option>";
     	
     }
                                                                   
        echo"</select>".$this->chyba[$i]."</td></tr>
            ";          
                                                             
         	break;
         	
  
      	
 
   case 'poznamka':
   
         echo"<tr><td>Pozn�mka :</td>";
        echo"
       <td class=\"chyba\">
        <textarea   rows=\"7\" name=\"".$this->sloupec[$i]."\" cols=\"50\">".$fsloupec[$i]."</textarea>".$this->chyba[$i]."</td></tr>
            ";
         	break; 
                
              
  default:
  	/*echo $this->sloupec[$i];
        echo":::<INPUT TYPE=\"TEXT\" SIZE=\"45\" NAME=\"".$this->sloupec[$i]."\" VALUE=\"".$fsloupec[$i]."\" ><br />
            ";*/
  	break;
  }

}  



	          


 echo"  
 
 
 <tr><td colspan=\"2\"  class=\"centrovano\" >                
<input type=\"hidden\" name=\"odeslano\" value=\"true\" />
<input type=\"hidden\" name=\"akce\" value=\"$fcopridat\" />
<br />
<input type=\"submit\"  value=\"odeslat\" name=\"dotaznik\" class=\"tlacitko\" />
<hr />
 <input type=\"reset\" value=\"smazat neodeslan� �daje\" class=\"tlacitko\" />
  </td></tr>
</table>
</form>
 </div> <!--     centrov�no    -->
   ";
 }
/*----------------------------------------------------------------------------*/

/*---------------------------Popis metody Adminzaznamuzivatel()-------------------

Metoda Adminzaznamudotaz($f_id,$fzpracovani='administrace.php')
generuje formul�� pro update �daj� ve vybran�m z�znamu. 
Form�tov�n� do tabulky.
Prvn� sloupec : n�zvy sloupc� z tabulky MySQL datab�ze.
Typy jednotliv�ch vstupn�ch pol�:
nadpis, autor,email: input type="text" 
text:               textarea
neur�en� : negeneruje nic, je nutno doplnit    case 'dal�� �daj': vstupni pole  
                                                     break;
P�i odesl�n� formul��e je odes�l�n parametr odeslano=true 
parametr $fzpracovani ur�uje zpracovatelsk� skript.
 
Roz���en�:
umo�n� update foto  .
Pozn. fotka ji� nen� povinn�.                                               
------------------------------------------------------------------------------*/
 
function Adminzaznamuuzivatel($f_id,$fzpracovani='administrace.php',$fsheslem=0)
{ 
global $akce,$codelat,$editzaznam,$superadmin;
$pocetpredmetu=$this->Urci_pocet_vol_predmetu();
$seznampredmetu= $this->VyberSeznamPredmetu();
$PoleZaznamu=CRubrika::VyberPolozku($f_id); 
 
//echo" Z�zanm �.:$PoleZaznamu[id] Datum z�znamu: $PoleZaznamu[datum]<br />";

echo"
 <div class=\"centrovano\">
<form enctype=\"multipart/form-data\" action=\"$fzpracovani\" method=\"post\">";
           

echo"
<table border=\"1\"  class=\"centrovano tabeditace\" >
    "; 
    
  for ($i=0;$i<$this->pocetsloupcu ;$i++ ) {
  //$chyba[$i]='*';  
  //$nazevsloupce=$this->sloupec[$i];
   // $hodnotavtabulce=$PoleZaznamu[ $nazevsloupce];
  
  switch ($this->sloupec[$i]) {
   case 'jmeno':
  echo"<tr class=\"nadpisv-n-c\"><td>"; echo" Jm�no:</td>";
        echo"<td class=\"textv-n-c\">".      
        $PoleZaznamu[$this->sloupec[$i]]."
        <input type=\"hidden\"  name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" /></td></tr>
            ";
         	break;
  case 'prijmeni':
  echo"<tr class=\"nadpisv-n-c\"><td>"; echo"P��jmen�:</td>";
        echo"<td class=\"textv-n-c\">".      
        $PoleZaznamu[$this->sloupec[$i]]."
        <input type=\"hidden\"  name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" /></td></tr>
            ";
         	break;
    
 case 'prezdivka':
  echo"<tr class=\"nadpisv-n-c\"><td>"; echo"U�ivatelsk� jm�no:</td>";
        echo"<td class=\"textv-n-c\">".      
        $PoleZaznamu[$this->sloupec[$i]]."
        <input type=\"hidden\"  name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" /></td></tr>
            ";
         	break;       	
         	
         	
         	
   case 'heslo':
  
   $zobrheslo= ($fsheslem==1) ? $PoleZaznamu[$this->sloupec[$i]]."<a href=\"editace.php?sheslem=0\"> ( ukr�t heslo )</a>" : '***'."<a href=\"editace.php?sheslem=1\"> ( zobrazit heslo )</a>" ;
   echo"<tr class=\"nadpisv-n-c\"><td>";echo $this->sloupec[$i]; echo":</td>";
        echo"<td class=\"textv-n-c\">".$zobrheslo." <input type=\"hidden\"  name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" /></td></tr>
            ";
         	break; 
  
 case 'trida':
  
      echo"<tr class=\"nadpisv-n-c\"><td>T��da :</td>";
    echo"  <td class=\"textv-n-c\">".      
        $PoleZaznamu[$this->sloupec[$i]]."
        <input type=\"hidden\"  name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" /></td></tr>
            ";
         	break; 
 
     	
case 'predmet1':
for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
  $jmenopredmetsloupce='predmet'.$pocet_zobr;
  $jmenoakceptsloupce='akcept'.$pocet_zobr; 
if (($PoleZaznamu[$jmenoakceptsloupce]=='ano')) {

 echo"<tr><td>P�edm�t �. $pocet_zobr :</td>";
       echo"<td class=\"textv-n-c\">".      
        $PoleZaznamu[$jmenopredmetsloupce]."  - <span class=\"zvyraznitano\"> po�adavek akceptov�n</span>
        <input type=\"hidden\" name=\"".$jmenopredmetsloupce."\" value=\"".$PoleZaznamu[$jmenopredmetsloupce]."\" />
   <input type=\"hidden\" name=\"".$jmenoakceptsloupce."\" value=\"".$PoleZaznamu[$jmenoakceptsloupce]."\" />     
        </td></tr>
            ";	
}
  
else {
 echo"<tr><td>P�edm�t �. $pocet_zobr :</td>";
        echo"<td class=\"chyba\"><select name=\"".$jmenopredmetsloupce."\" 
     size=\"1\" >"; 
     echo"<option value=\"Vyberte si p�edm�t\"  >Vyberte si p�edm�t</option>";
    
     for ($p=0;$p<count($seznampredmetu[id]) ;$p++ ) {
     if ($seznampredmetu[predmet][$p]==$PoleZaznamu[$jmenopredmetsloupce]) {
     	echo"<option value=\"".$seznampredmetu[predmet][$p]."\" selected=\"selected\" >".$seznampredmetu[predmet][$p]."</option>";
     } 
     else {
     $pocetprihlstud=$this->PocetPrihlasenychPredmet($seznampredmetu[predmet][$p]);
     $zanazvem='_(sk.'.$pocet_zobr.')';
 /* echo"<option value=\"".$seznampredmetu[predmet][$p]."\">".$seznampredmetu[predmet][$p]." {$pocetprihlstud[celkemprihlaseno]}-{$seznampredmetu[maxpocet][$p]}</option>"; */
     if (($pocetprihlstud[celkemprihlaseno] < $seznampredmetu[maxpocet][$p])&&
          ( strstr($seznampredmetu[predmet][$p], $zanazvem))
     
         ) {
     	 echo"<option value=\"".$seznampredmetu[predmet][$p]."\">".$seznampredmetu[predmet][$p]."</option>"; 
                                                        }
     
           }
     
     	
     }
        echo"</select>".$this->chyba[$i+2*($pocet_zobr-1)]."</td></tr>
            ";   
	
}         
     } 
         	break;  
  
                                	
 case 'predmetnahradni':
       $jmenopredmetsloupce='predmetnahradni';
         echo"<tr><td>N�hradn� p�edm�t:</td>";
        echo"<td class=\"chyba\"><select name=\"".$jmenopredmetsloupce."\" 
     size=\"1\" >"; 
     echo"<option value=\"Vyberte si p�edm�t\"  >Vyberte si p�edm�t</option>"; 
     for ($p=0;$p<count($seznampredmetu[id]) ;$p++ ) {
     if ($seznampredmetu[predmet][$p]==$PoleZaznamu[$jmenopredmetsloupce]) {
     	echo"<option value=\"".$seznampredmetu[predmet][$p]."\" selected=\"selected\" >".$seznampredmetu[predmet][$p]."</option>";
     } 
     else {
     $pocetprihlstud=$this->PocetPrihlasenychPredmet($seznampredmetu[predmet][$p]);
 
     if ($pocetprihlstud[celkemprihlaseno] < $seznampredmetu[maxpocet][$p]) {
     	 echo"<option value=\"".$seznampredmetu[predmet][$p]."\">".$seznampredmetu[predmet][$p]."</option>"; 
                                                        }  
     
     }
     	
     }
        echo"</select>".$this->chyba[$i]."</td></tr>
            ";   
         	break;               
   case 'poznamka':
   
         echo"<tr><td>Pozn�mka:</td>";
        echo"
       <td class=\"chyba\">
        <textarea  readonly=\"readonly\"  rows=\"7\" name=\"".$this->sloupec[$i]."\" cols=\"50\">".$PoleZaznamu[$this->sloupec[$i]]."</textarea>".$this->chyba[$i]."</td></tr>
            ";
         	break;  
                 
              
  default:
  	/* neprov�d� se nic*/
  	break;
  }

}  




echo"</td></tr> ";

 
if ($fzpracovani=='editace.php') echo" 
 <tr><td colspan=\"2\"  class=\"centrovano\" >                
<input type=\"hidden\" name=\"odeslano\" value=\"true\" />
<br />
<input type=\"submit\"  value=\"ulo�it\" name=\"codelat\" class=\"tlacitko\" />
<hr />

 <input type=\"reset\" value=\"smazat neodeslan� �daje\" class=\"tlacitko\" />
 <hr />

<input type=\"hidden\" name=\"akce\" value=\"editace_stranky\" />
<input type=\"hidden\" name=\"editzaznam\" value=\"editovat_z�znam\" />
<input type=\"hidden\" name=\"kohoeditovat\" value=\"$f_id\" />


  </td></tr>
<tr>
<td colspan=\"2\">
  <a href=\"tisk_hesla.php?id=".$PoleZaznamu[id]."\"   class=\" tiskzpravyvlevo\" 
 onclick=\"return !window.open(this.href)\">Tisk v�etn� hesla </a> 
  
 
  <a href=\"tisk.php?id=".$PoleZaznamu[id]."\"   class=\" tiskzpravy\" 
 onclick=\"return !window.open(this.href)\">Tisk </a> 
  </td></tr>  
  
  
</table>
</form>
 </div> <!--     centrov�no    -->
                                     ";


                            else echo"  
 <tr><td colspan=\"2\"  class=\"centrovano\" >                
<input type=\"hidden\" name=\"odeslano\" value=\"true\" />
<br />
<input type=\"submit\"  value=\"odeslat\" name=\"dotaznik\" class=\"tlacitko\" />
<input type=\"hidden\" name=\"codelat\" value=\"ulo�it\" />
<input type=\"hidden\" name=\"akce\" value=\"editace_stranky\" />
<input type=\"hidden\" name=\"editzaznam\" value=\"editovat_z�znam\" />
<input type=\"hidden\" name=\"kohoeditovat\" value=\"$f_id\" />

<hr />
 <input type=\"reset\" value=\"smazat neodeslan� �daje\" class=\"tlacitko\" />
  </td></tr>
</table>
</form>
 </div> <!--     centrov�no    -->
   ";
 }




/*----------------------------------------------------------------------------*/

/*---------------------------Popis metody Zobrvysledekprozaka()-------------------

Metoda Adminzaznamudotaz($f_id,$fzpracovani='administrace.php')
generuje formul�� pro update �daj� ve vybran�m z�znamu. 
Form�tov�n� do tabulky.
Prvn� sloupec : n�zvy sloupc� z tabulky MySQL datab�ze.
Typy jednotliv�ch vstupn�ch pol�:
nadpis, autor,email: input type="text" 
text:               textarea
neur�en� : negeneruje nic, je nutno doplnit    case 'dal�� �daj': vstupni pole  
                                                     break;
P�i odesl�n� formul��e je odes�l�n parametr odeslano=true 
parametr $fzpracovani ur�uje zpracovatelsk� skript.
 
Roz���en�:
umo�n� update foto  .
Pozn. fotka ji� nen� povinn�.                                               
------------------------------------------------------------------------------*/
 
function Zobrvysledekprozaka($f_id,$fzpracovani='administrace.php',$fsheslem=0)
{ 
$pocetpredmetu=$this->Urci_pocet_vol_predmetu();

$PoleZaznamu=CRubrika::VyberPolozku($f_id);
echo"
 <div class=\"centrovano\">         


<table border=\"1\"  class=\"centrovano\" >
    "; 
    
  for ($i=0;$i<$this->pocetsloupcu ;$i++ ) {
  
  
  switch ($this->sloupec[$i]) {
   case 'jmeno':
  echo"<tr class=\"nadpisv-n-c\"><td>"; echo" Jm�no:</td>";
        echo"<td class=\"textv-n-c\">".      
        $PoleZaznamu[$this->sloupec[$i]]."</td></tr> ";
         	break;
  case 'prijmeni':
  echo"<tr class=\"nadpisv-n-c\"><td>"; echo"P��jmen�:</td>";
        echo"<td class=\"textv-n-c\">".      
        $PoleZaznamu[$this->sloupec[$i]]."
        </td></tr>
            ";
         	break;
    
 case 'prezdivka':
  echo"<tr class=\"nadpisv-n-c\"><td>"; echo"U�ivatelsk� jm�no:</td>";
        echo"<td class=\"textv-n-c\">".      
        $PoleZaznamu[$this->sloupec[$i]]."
        </td></tr>
            ";
         	break;       	
         	
         	
         	
   case 'heslo':
  
   $zobrheslo= ($fsheslem==1) ? $PoleZaznamu[$this->sloupec[$i]]."<a href=\"editace.php?sheslem=0\"> ( ukr�t heslo )</a>" : '***'."<a href=\"editace.php?sheslem=1\"> ( zobrazit heslo )</a>" ;
   echo"<tr class=\"nadpisv-n-c\"><td>";echo $this->sloupec[$i]; echo":</td>";
        echo"<td class=\"textv-n-c\">".$zobrheslo." </td></tr>
            ";
         	break; 
  
 case 'trida':
  
      echo"<tr class=\"nadpisv-n-c\"><td>T��da :</td>";
        echo"<td class=\"textv-n-c\">".      
        $PoleZaznamu[$this->sloupec[$i]]."
        </td></tr>
            ";
         	break; 
 
     	
case 'predmet1':
  for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
  $jmenopredmetsloupce='predmet'.$pocet_zobr;
      echo"<tr><td>P�edm�t �. $pocet_zobr :</td>";
       echo"<td class=\"textv-n-c\">".      
        $PoleZaznamu[$jmenopredmetsloupce]."
        </td></tr>
            ";
                                                                 }
         	break;  
  case 'predmetnahradni':  
         echo"<tr><td >N�hradn� p�edm�t : <td class=\"textv-n-c\">".$PoleZaznamu[$this->sloupec[$i]]."</td></tr>";
     
         
         	break;  
                                	
           
   case 'poznamka':
   
         echo"<tr><td>Pozn�mka:</td>";
        echo"
       <td class=\"chyba\">
        <textarea   rows=\"7\" name=\"".$this->sloupec[$i]."\" cols=\"50\" readonly=\"readonly\">".$PoleZaznamu[$this->sloupec[$i]]."</textarea>"."</td></tr>
            ";
         	break;  
                 
              
  default:
  	/* neprov�d� se nic*/
  	break;
  }

}  




echo"</td></tr> 
 <tr>
<td  colspan=\"2\">
  <a href=\"tisk_hesla.php?id=".$PoleZaznamu[id]."\"   class=\" tiskzpravyvlevo\" 
 onclick=\"return !window.open(this.href)\">Tisk v�etn� hesla </a> 
  
  <a href=\"tisk.php?id=".$PoleZaznamu[id]."\"   class=\" tiskzpravy\" 
 onclick=\"return !window.open(this.href)\">Tisk </a> 
  </td></tr>

</table>

 </div> <!--     centrov�no    -->
   ";
 }




/*----------------------------------------------------------------------------*/
/*---------Form�tov�n� pro tisk----------------------*/
 
function Vyber_na_Tisk($f_id,$f_sheslem=false)
{ 
$pocetpredmetu=$this->Urci_pocet_vol_predmetu();
$PoleZaznamu=$this->VyberPolozku($f_id); 

//echo" Z�zanm �.:$PoleZaznamu[id] <br />";
if ($f_sheslem) {
echo"<table   border=\"0\" width=\"50%\"> <caption> P��stupov� �daje </caption>";
echo"<tr><td>T��da </td><td>".$PoleZaznamu[trida]."</td> </tr>"; 
echo"<tr><td>Jm�no </td><td>".$PoleZaznamu[jmeno]."</td> </tr>";  
echo"<tr><td>P�ijmen�</td><td>".$PoleZaznamu[prijmeni]."</td> </tr>";      
echo"<tr><td>U�ivatelsk� jm�no</td><td>".$PoleZaznamu[prezdivka]."</td> </tr>";
echo"<tr><td>Heslo</td><td>".$PoleZaznamu[heslo]."</td> </tr>";   
echo"</table>";
echo"<br /><br /><br />
<hr />
<br /><br /><br />";
	
}
echo"
  <div class=\"centrovano\">   
<table border=\"0\" width=\"50%\"  >
<caption> Vybran� p�edm�ty</caption>
    "; 
  for ($i=0;$i<$this->pocetsloupcu ;$i++ ) {  
    
  switch ($this->sloupec[$i]) {
    case 'trida': 
  
      echo"<tr><td>T��da : </td>";
        echo"<td>".$PoleZaznamu[$this->sloupec[$i]]." </td></tr> ";
         	break;
         	
   case 'jmeno': 
  
      echo"<tr><td>Jm�no : </td>";
        echo"<td>".$PoleZaznamu[$this->sloupec[$i]]." </td></tr> ";
         	break;
  case 'prijmeni': 
      echo"<tr><td>P��jmen� : </td>";
        echo"<td>".$PoleZaznamu[$this->sloupec[$i]]." </td></tr> ";
         	break;
 
  
         	case 'prezdivka':        
   
         echo"<tr><td>U�ivatelsk� jm�no : </td>";
        echo"<td>".$PoleZaznamu[$this->sloupec[$i]]." </td></tr> ";
         	break;
	        
	case 'predmet1':        
   for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
  $jmenopredmetsloupce='predmet'.$pocet_zobr;
  $jmenoakceptsloupce='akcept'.$pocet_zobr; 
         echo"<tr><td>P�edm�t �. $pocet_zobr : </td>";
        echo"<td>".$PoleZaznamu[$jmenopredmetsloupce]." ( Stav: ";
        if ($PoleZaznamu[$jmenoakceptsloupce]=='ano') {
        echo"po�adavek byl akceptov�n";	
        }
        else {
         echo"po�adavek nen� akceptov�n";		
        }
        ;
        
        echo")</td></tr> ";
                                                                }
         	break; 
 case 'predmetnahradni':  
         echo"<tr><td>N�hradn� p�edm�t : <td>".$PoleZaznamu[$this->sloupec[$i]]."</td></tr>";
     
         
         	break;  	
      
              case 'poznamka':  
         echo"<tr><td colspan=\"2\" class=\"textvpolozce\">Pozn�mka : ".         nl2br($PoleZaznamu[$this->sloupec[$i]])."</td></tr>";
     
         
         	break;          
              
  default:
  	/* neprov�d� se nic*/
  	break;
  }

}  

 echo"  
 </table>

 </div> <!-- centrov�no    -->
   ";               

 }



/*----------------------------------------------------------------------------*/
/********************************************************************************************

pro cvs excel CSV
**************************************************************/

function proexcel($f_podle='',$f_co='',$f_sheslem=false)

{
$pocetpredmetu=$this->Urci_pocet_vol_predmetu(); 
$f_podle=$this->inject_addslashes($f_podle);
$f_co=$this->inject_addslashes($f_co);
$fp=FOpen("export.csv","w");
switch ($f_podle) {
case 'export p�edm�tu':
$podminka='';
for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
$jmenopredmetsloupce='predmet'.$pocet_zobr;
$jmenoakceptsloupce='akcept'.$pocet_zobr;
$podminka=($pocet_zobr==$pocetpredmetu)?$podminka."(`{$jmenopredmetsloupce}`='".$f_co."')":$podminka."(`{$jmenopredmetsloupce}`='".$f_co."')   OR  ";
                                                                 }


//$podminka="`predmet1` = '".$f_co."'   OR  `predmet2`= '".$f_co."'";
//echo" podminka: $podminka";
$PolePolozekexp= $this->VyberSeznam($podminka,'prijmeni ASC');
$pocetstudentu=count($PolePolozekexp[id]);
echo" 
                
           <div class=\"centrovano\">
               Studenti kte�� volili: $f_co ($pocetstudentu)
           </div>  ";
$hlavicka_tab=" Jm�no, P��jmen�, T��da, ";
for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
$hlavicka_tab=$hlavicka_tab."P�edm�t �.$pocet_zobr, akceptov�no, ";
                                                               }
if ($this->Pocet_nahradnich_predmetu()>0)  {
$hlavicka_tab=$hlavicka_tab."N�hradn� p�., Pozn�mka, \n";    	
}                                                                  
else {
$hlavicka_tab=$hlavicka_tab."Pozn�mka, \n";	
}                                                                    
Fputs($fp,$hlavicka_tab);
for($i=0;$i< count($PolePolozekexp[id]);$i++) {
$jmenoven=ereg_replace(",{1,}", ' ',$PolePolozekexp[jmeno][$i]);
$prijmeniven=ereg_replace(",{1,}", ' ',$PolePolozekexp[prijmeni][$i]);
$tridaven=ereg_replace(",{1,}", ' ',$PolePolozekexp[trida][$i]);
Fputs($fp," $jmenoven,$prijmeniven,$tridaven,");
 for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
$jmenopredmetsloupce='predmet'.$pocet_zobr;
$jmenoakceptsloupce='akcept'.$pocet_zobr;
$predmetven=ereg_replace(",{1,}", ' ',$PolePolozekexp[$jmenopredmetsloupce][$i]);
$akceptven=ereg_replace(",{1,}", ' ',$PolePolozekexp[$jmenoakceptsloupce][$i]);
Fputs($fp," $predmetven,$akceptven,");
                                                                 }
if ($this->Pocet_nahradnich_predmetu()>0)  {
 $nahradniven=ereg_replace(",{1,}", ' ',$PolePolozekexp[predmetnahradni][$i]);
Fputs($fp,"$nahradniven,");                 }                                                               

$pozn=ereg_replace("[[:space:]]", ' ',$PolePolozekexp[poznamka][$i]);     
$poznamkaven=ereg_replace(",{1,}", ' ',$pozn); 

Fputs($fp,"$poznamkaven \n");
                                              }
	break;
case 'export t��d':
$podminka="`trida` = '".$f_co."'";
//echo" podminka: $podminka";
$PolePolozekexp= $this->VyberSeznam($podminka,'prijmeni ASC');
$pocetstudentu=count($PolePolozekexp[id]);
echo" 
                
           <div class=\"centrovano\">
               Studenti t��dy : $f_co ($pocetstudentu)
           </div>  ";
$hlavicka_tab=" Jm�no, P��jmen�, T��da, ";
for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
$hlavicka_tab=$hlavicka_tab."P�edm�t �.$pocet_zobr, akceptov�no, ";
                                                               } 
if ($this->Pocet_nahradnich_predmetu()>0)  {
$hlavicka_tab=$hlavicka_tab."N�hradn� p�., Pozn�mka, \n";    	
}                                                                  
else {
$hlavicka_tab=$hlavicka_tab."Pozn�mka, \n";	
}                                                                   
                                                               
                                                                
                                                                        
Fputs($fp,$hlavicka_tab);
for($i=0;$i< count($PolePolozekexp[id]);$i++) {
$jmenoven=ereg_replace(",{1,}", ' ',$PolePolozekexp[jmeno][$i]);
$prijmeniven=ereg_replace(",{1,}", ' ',$PolePolozekexp[prijmeni][$i]);
$tridaven=ereg_replace(",{1,}", ' ',$PolePolozekexp[trida][$i]);
Fputs($fp," $jmenoven,$prijmeniven,$tridaven,");
 for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
$jmenopredmetsloupce='predmet'.$pocet_zobr;
$jmenoakceptsloupce='akcept'.$pocet_zobr;
$predmetven=ereg_replace(",{1,}", ' ',$PolePolozekexp[$jmenopredmetsloupce][$i]);
$akceptven=ereg_replace(",{1,}", ' ',$PolePolozekexp[$jmenoakceptsloupce][$i]);
Fputs($fp," $predmetven,$akceptven,");
                                                                 }
                                                                 
 if ($this->Pocet_nahradnich_predmetu()>0)  {
 $nahradniven=ereg_replace(",{1,}", ' ',$PolePolozekexp[predmetnahradni][$i]);
Fputs($fp,"$nahradniven,");    	
                                            }                                                                 

$pozn=ereg_replace("[[:space:]]", ' ',$PolePolozekexp[poznamka][$i]);     
$poznamkaven=ereg_replace(",{1,}", ' ',$pozn); 

Fputs($fp,"$poznamkaven \n");
                                              }

	break;
	case 'export hesel':
$podminka="`trida` = '".$f_co."'";
//echo" podminka: $podminka";
$PolePolozekexp= $this->VyberSeznam($podminka,'prijmeni ASC');
$pocetstudentu=count($PolePolozekexp[id]);
echo" 
                
           <div class=\"centrovano\">
               P��stupov� �daje student� t��dy : $f_co ($pocetstudentu)
           </div>  ";

for($i=0;$i< count($PolePolozekexp[id]);$i++) {
Fputs($fp," Jm�no, P��jmen�, T��da, U�ivatelsk� jm�no, Heslo, Pozn�mka, \n");
$jmenoven=ereg_replace(",{1,}", ' ',$PolePolozekexp[jmeno][$i]);
$prijmeniven=ereg_replace(",{1,}", ' ',$PolePolozekexp[prijmeni][$i]);
$tridaven=ereg_replace(",{1,}", ' ',$PolePolozekexp[trida][$i]);
$prezdivkaven=ereg_replace(",{1,}", ' ',$PolePolozekexp[prezdivka][$i]);
$hesloven=ereg_replace(",{1,}", ' ',$PolePolozekexp[heslo][$i]);
$pozn=ereg_replace("[[:space:]]", ' ',$PolePolozekexp[poznamka][$i]);     
$poznamkaven=ereg_replace(",{1,}", ' ',$pozn); 

Fputs($fp," $jmenoven,$prijmeniven,$tridaven,$prezdivkaven,$hesloven,$poznamkaven \n");
                                              }

	break;
	case 'export po�tu':
$PolePolozekexp=$this->VyberSeznamPredmetu();
echo" 
                
           <div class=\"centrovano\">
               Seznam p�edm�t� s po�ty p�ihl�en�ch student� : 
           </div>  ";
if($this->Pocet_nahradnich_predmetu()>0) {
  	Fputs($fp," P�edm�t, Zkratka, Po�et p�ihl�en�ch,N�hradn�  \n");
}
else {
	Fputs($fp," P�edm�t, Zkratka, Po�et p�ihl�en�ch \n");
}           

for($i=0;$i< count($PolePolozekexp[id]);$i++) {

$predmetven=ereg_replace(",{1,}", ' ',$PolePolozekexp[predmet][$i]);
$zkratkaven=ereg_replace(",{1,}", ' ',$PolePolozekexp[zkratka][$i]);

$pocetprihl=$this->PocetPrihlasenychPredmet($PolePolozekexp[predmet][$i]);
$pocetprihlven=ereg_replace(",{1,}", ' ',$pocetprihl[celkemprihlaseno]);
 if ($this->Pocet_nahradnich_predmetu()>0) {
$pocetnahradn=$this->PocetVybranychNahradnichPredmet($PolePolozekexp[predmet][$i]);
$pocetnahradniven=$pocetnahradn[nahradni];
 Fputs($fp," $predmetven,$zkratkaven,$pocetprihlven,$pocetnahradniven \n");	
 }
 else {
 Fputs($fp," $predmetven,$zkratkaven,$pocetprihlven \n");	
 }

                                              }

	break;	
	
	
	
default:
echo"<span class=\"chyba\"> nebyla vybr�na ��dn� t��da ani p�edm�t</span>";

 
	break;
	FClose($fp); mysql_free_result($vsechnyzazanamy);	
}



 



}


/*---------------------------Popis metody Formular_hledej()-----------------------

                                            
------------------------------------------------------------------------------*/

function Formular_hledej($fzpracovani='administrace.php',$fsloupec)
{ 
switch ($fsloupec) {
case 'cisloop': $ceskyfloupec='��slo op';
	break;
case 'prijmeni': $ceskyfloupec='p��jmen�';
	break;	
default:
	$ceskyfloupec='-';
	
	break;
}
echo"
  <div class=\"centrovano\">
<form enctype=\"multipart/form-data\" action=\"$fzpracovani\" method=\"post\">
<table border=\"1\"  class=\"centrovano\" >
    "; 
 echo"<tr><td>"; echo"$ceskyfloupec</td>";
 if ($fsloupec=='cisloop') {
 	echo"<td ><input type=\"text\" size=\"10\" maxlength=\"10\" name=\"".$fsloupec."\"  /></td></tr>
            ";    
                          }
           else echo"<td ><input onkeypress=testznak(this) 
      onkeyup=testznak(this) type=\"text\" size=\"10\" name=\"".$fsloupec."\"  /></td></tr>
            ";                    
        


 echo"  
 
 
 <tr><td colspan=\"2\"  class=\"centrovano\" >                

  <input type=\"hidden\" name=\"sloup\" value=\"$fsloupec\" />
  <!--
<input type=\"hidden\" name=\"akcehledat\" value=\"filtrovat\" />
-->
<br />
<input type=\"submit\"  value=\"vyhledat\" name=\"hledani\" class=\"tlacitko\" />

  </td></tr>
</table>
</form>
 </div> <!--     centrov�no    -->
   ";
 }
/*----------------------------------------------------------------------------*/


function Formular_import($fzpracovani='administrace.php')
{ 
echo" 
<form enctype=\"multipart/form-data\" action=\"$fzpracovani\" method=\"post\">
<table border=\"1\"  class=\"centrovano\" >
 <tr><td colspan=\"2\"  class=\"centrovano\" > 
soubor *.txt,  max. 500kB  <br />
   <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"50000000\" /> 
  Vyberte soubor v po��ta�i:<input name=\"souborimport\"  type=\"file\" 
   accept=\"text/plain\" />
  <span class=\"chyba\">    $this->chybasouboru  </span>  </td></tr> 
                     ";

 echo"  
 
 <tr><td colspan=\"2\"  class=\"centrovano\" > 
<input type=\"hidden\"  value=\"importovat\" name=\"akce\"  />                
<input type=\"hidden\" name=\"odeslanokimportu\" value=\"true\" />

<br />
<input type=\"submit\"  value=\"odeslat\" name=\"dotaznik\" class=\"tlacitko\" />

  </td></tr>
</table>
</form>

   ";
 }

function Formular_kontrola_importu($limit=50000000)
{

/*application/pdf*/
if($_FILES['souborimport']['name']!="") { 
$nahrani=true;
 if ($_FILES['souborimport']['size']>$limit) {$nahrani=false;$this->chybasouboru="nespln�ny vstupn� podm�nky velikosti souboru";}
if ( $_FILES['souborimport']['type']!="text/plain" ) {$nahrani=false;$this->chybasouboru="nespln�ny vstupn� podm�nky typu souboru";}
	                $verdikt= $nahrani;
                                    }
    else {$verdikt=false; $this->chybasouboru="nebyl vlo�en soubor";} 

 return $verdikt;
 }
 
function Pridej_import()
{ 

if($_FILES['souborimport']['name']!=""){
$uploadFile ='import.txt';  
	if (move_uploaded_file($_FILES['souborimport']['tmp_name'], $uploadFile))$vysledek =$uploadFile;
   else $vysledek =false;

 
           }
return $vysledek ;
}


function Vyrob_Heslo($f_string, $f_pom)
{ // BEGIN function Vyrob_Heslo
$pom=$f_pom.$f_string;
$heslo=substr(md5($pom),1 , 6 );
return $heslo ;	
} // END function Vyrob_Heslo


function Importuj($f_soubor='import.txt')
{

$pocetpredmetu=$this->Urci_pocet_vol_predmetu();
$vymazattabulku=MySQL_Query("TRUNCATE TABLE $this->Nazev "); 
$fd = fopen ($f_soubor, "r");
;
$i=1;
while (!feof ($fd)) {
    $radek = fgets($fd, 4096);
    //echo"$radek-- <br />"; 
    if ($radek!='') {
    
    list($pars_jmeno, $pars_prijmeni, $pars_trida) = explode(";",$radek);
    $pars_jmeno=ucfirst($pars_jmeno);$pars_prijmeni= ucfirst($pars_prijmeni) ;
    $datump=Date(d.'.'.m.'.'.Y);
        //$pars_tridabezmezer= strtr(trim($pars_trida),' ','x');
   $pars_tridabezmezer= ereg_replace("[[:space:]]",'x',$pars_trida);  
    $pomprezdivka=strtr($pars_tridabezmezer, '.', 'p').strval($i).strval(strlen($pars_prijmeni));
    $prezdivkapridat=strtolower ( $pomprezdivka);
    $proheslo=strval($i);
   $heslopridat=$this->Vyrob_Heslo($proheslo, 'kolo23');
    //$prezdivkapridat=strval($i).$pars_jmeno; 
    //$heslopridat='heslo';
  //$pomval=$i.',\''.$datump.'\',\''.$pars_jmeno.'\',\''.$pars_prijmeni.'\',\''.$prezdivkapridat.'\',\''.$heslopridat.'\',\''.$pars_trida.'\',\''.'Vyberte si p�edm�t'.'\',\''.'ne'.'\',\''.'Vyberte si p�edm�t'.'\',\''.'ne'.'\',\''.' ' .'\'';
  
  
$pomval=$i.',\''.$datump.'\',\''.$pars_jmeno.'\',\''.$pars_prijmeni.'\',\''.$prezdivkapridat.'\',\''.$heslopridat.'\',\''.$pars_trida.'\',';
  
for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){

$pomval=$pomval.'\''.'Vyberte si p�edm�t'.'\',\''.'ne'.'\',';
                                                          } 
                                                            
$pomval=$pomval.'\''.' '.'\'';   
  
if (@$vlozeni=MySQL_Query("INSERT INTO $this->Nazev VALUES ($pomval);" ) OR DIE(MySQL_Error())) {
echo "$i: �daje studenta $pars_jmeno  $pars_prijmeni ($pars_trida) ulo�eny  <br /> ";		
}  
else {
echo " <span class=\"chyba\">$i:  Chyba p�i ukl�d�n� �daj�: $pars_jmeno  $pars_prijmeni ($pars_trida)  <br /> </span>";	
}
  


    }
    
  
     
  
  $i++;
}
fclose ($fd);

return $impotrovani;

 }


/********************************************************************************************

pro tiskov� sestavy
**************************************************************/

function protTiskovouSestavu($f_podle='',$f_co='',$f_sheslem=false)

{
global $poznamka_k_heslu;

 $z_predmet='P�edm�t';$z_predmety='p�edm�ty';
$pocetpredmetu=$this->Urci_pocet_vol_predmetu(); 
$f_podle=$this->inject_addslashes($f_podle);
$f_co=$this->inject_addslashes($f_co);

switch ($f_podle) {
case 'tisk p�edm�tu':
$podminka='';
for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
$jmenopredmetsloupce='predmet'.$pocet_zobr;
$jmenoakceptsloupce='akcept'.$pocet_zobr;
$podminka=($pocet_zobr==$pocetpredmetu)?$podminka."(`{$jmenopredmetsloupce}`='".$f_co."')":$podminka."(`{$jmenopredmetsloupce}`='".$f_co."')   OR  ";
                                                                 }


//$podminka="`predmet1` = '".$f_co."'   OR  `predmet2`= '".$f_co."'";
//echo" podminka: $podminka";
$PolePolozekexp= $this->VyberSeznam($podminka,'prijmeni ASC');
$pocetstudentu=count($PolePolozekexp[id]);
echo" 
                
           <div class=\"centrovano\">
               Studenti kte�� volili: $f_co ($pocetstudentu)
           </div>  ";
echo"
<table width=\"50%\" align=\"center\" border=\"1\">

";   
echo"
<tr><td>Jm�no</td><td>P��jmen�</td><td>T��da</td>";
if ($this->Pocet_nahradnich_predmetu()==1) {echo"<td>N�hradn� p�.</td>";}

echo"<td>Pozn�mka</td></tr>";         

for($i=0;$i< count($PolePolozekexp[id]);$i++) {
$jmenoven=ereg_replace(",{1,}", ' ',$PolePolozekexp[jmeno][$i]);
$prijmeniven=ereg_replace(",{1,}", ' ',$PolePolozekexp[prijmeni][$i]);
$tridaven=ereg_replace(",{1,}", ' ',$PolePolozekexp[trida][$i]);
if ($this->Pocet_nahradnich_predmetu()==1){
$nahradniven=ereg_replace(",{1,}", ' ',$PolePolozekexp[predmetnahradni][$i]);
                                           }
$pozn=ereg_replace("[[:space:]]", ' ',$PolePolozekexp[poznamka][$i]);
$poznamkaven=ereg_replace(",{1,}", ' ',$pozn); 
 
echo"<tr><td> $jmenoven</td><td>$prijmeniven</td><td>$tridaven</tr><td>$nahradniven</td><td>$poznamkaven</td></tr>"; 

                                              }
echo "</table>";                                              
	break;
case 'tisk t��d':
$podminka="`trida` = '".$f_co."'";
//echo" podminka: $podminka";
$PolePolozekexp= $this->VyberSeznam($podminka,'prijmeni ASC');
$pocetstudentu=count($PolePolozekexp[id]);
echo" 
                
           <div class=\"centrovano\">
               Studenti t��dy : $f_co ($pocetstudentu)
           </div>  ";
 echo"
<table width=\"90%\" align=\"center\" border=\"1\">

";   
    
           
           
           
$hlavicka_tab=" <tr><td>Jm�no</td><td>P��jmen�</td><td>T��da</td> ";
for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
$hlavicka_tab=$hlavicka_tab."<td>$z_predmet �.$pocet_zobr</td><td> akceptov�no</td>";
                                                               } 
 if ($this->Pocet_nahradnich_predmetu()>0) {                                                                
$hlavicka_tab=$hlavicka_tab."<td>N�hradn� p�.</td><td>Pozn�mka</td></tr>";
}   
else {
$hlavicka_tab=$hlavicka_tab."<td>Pozn�mka</td></tr>";	
}                                                                     
echo"$hlavicka_tab";
for($i=0;$i< count($PolePolozekexp[id]);$i++) {
$jmenoven=ereg_replace(",{1,}", ' ',$PolePolozekexp[jmeno][$i]);
$prijmeniven=ereg_replace(",{1,}", ' ',$PolePolozekexp[prijmeni][$i]);
$tridaven=ereg_replace(",{1,}", ' ',$PolePolozekexp[trida][$i]);
echo "<tr><td> $jmenoven</td><td>$prijmeniven</td><td>$tridaven</td>";
 for ($pocet_zobr=1;$pocet_zobr<=$pocetpredmetu ;$pocet_zobr++ ){
$jmenopredmetsloupce='predmet'.$pocet_zobr;
$jmenoakceptsloupce='akcept'.$pocet_zobr;
$predmetven=ereg_replace(",{1,}", ' ',$PolePolozekexp[$jmenopredmetsloupce][$i]);

$akceptven=ereg_replace(",{1,}", ' ',$PolePolozekexp[$jmenoakceptsloupce][$i]);
echo"<td>$predmetven</td><td>$akceptven</td>";
                                                                 }
 if ($this->Pocet_nahradnich_predmetu()>0) {                                                                
$nahradniven=ereg_replace(",{1,}", ' ',$PolePolozekexp[predmetnahradni][$i]);
echo"<td>$nahradniven</td>";                  }
$pozn=ereg_replace("[[:space:]]", ' ',$PolePolozekexp[poznamka][$i]);     
$poznamkaven=ereg_replace(",{1,}", ' ',$pozn); 

echo"<td>$poznamkaven</td></tr>";
                                              }
echo "</table>"; 
	break;
	case 'tisk hesel':

$podminka="`trida` = '".$f_co."'";
//echo" podminka: $podminka";
$PolePolozekexp= $this->VyberSeznam($podminka,'prijmeni ASC');
$pocetstudentu=count($PolePolozekexp[id]);
echo" 
                
           <div class=\"centrovano\">
               P��stupov� �daje student� t��dy : $f_co ($pocetstudentu)
           </div>  ";
echo"
<table width=\"80%\" align=\"center\" border=\"1\">

";   
 
for($i=0;$i< count($PolePolozekexp[id]);$i++) {
echo"<tr><td> Jm�no</td><td>P��jmen�</td><td>T��da</td><td>U�ivatelsk� jm�no</td><td>Heslo</td><td>Pozn�mka</td>
</tr>";
$jmenoven=ereg_replace(",{1,}", ' ',$PolePolozekexp[jmeno][$i]);
$prijmeniven=ereg_replace(",{1,}", ' ',$PolePolozekexp[prijmeni][$i]);
$tridaven=ereg_replace(",{1,}", ' ',$PolePolozekexp[trida][$i]);
$prezdivkaven=ereg_replace(",{1,}", ' ',$PolePolozekexp[prezdivka][$i]);
$hesloven=ereg_replace(",{1,}", ' ',$PolePolozekexp[heslo][$i]);
$pozn=ereg_replace("[[:space:]]", ' ',$PolePolozekexp[poznamka][$i]);     
$pozn=ereg_replace(",{1,}", ' ',$pozn);
$poznamkaven=($poznamka_k_heslu!='')?  $poznamka_k_heslu : $pozn ;

echo"<tr><td>$jmenoven</td><td>$prijmeniven</td><td>$tridaven</td><td>$prezdivkaven</td><td>$hesloven</td><td>$poznamkaven</td>
</tr>";
                                              }
echo "</table>"; 
	break;
	case 'tisk po�tu':
$PolePolozekexp=$this->VyberSeznamPredmetu();
echo" 
                
           <div class=\"centrovano\">
               Seznam : $z_predmety s po�ty p�ihl�en�ch student� : 
           </div>  ";
            echo"
<table width=\"50%\" align=\"center\" border=\"1\">

";  

echo"<tr><td>$z_predmet</td><td>Zkratka</td><td>Po�et p�ihl�en�ch</td>";
if ($this->Pocet_nahradnich_predmetu()>0) {
echo"<td>N�hradn�n p�edm�t</td>";	
}

echo"</tr>";
for($i=0;$i< count($PolePolozekexp[id]);$i++) {

$predmetven=ereg_replace(",{1,}", ' ',$PolePolozekexp[predmet][$i]);
$zkratkaven=ereg_replace(",{1,}", ' ',$PolePolozekexp[zkratka][$i]);

$pocetprihl=$this->PocetPrihlasenychPredmet($PolePolozekexp[predmet][$i]);
$pocetprihlven=ereg_replace(",{1,}", ' ',$pocetprihl[celkemprihlaseno]);

echo"<tr><td>$predmetven</td><td>$zkratkaven</td><td>$pocetprihlven</td>";
  if ($this->Pocet_nahradnich_predmetu()>0) {
$pocetnahradn=$this->PocetVybranychNahradnichPredmet($PolePolozekexp[predmet][$i]);
$pocetnahradniven=$pocetnahradn[nahradni];
 echo"<td>$pocetnahradniven</td>";
 }

 
                                              }
echo "</tr></table>"; 
	break;	
	
	
	
default:
echo"<span class=\"chyba\"> nebyla vybr�na ��dn� stud.skupina ani p�edm�t</span>";

 
	break;

}
}


/*----------------------------------------------------------------------------*/	
	
} // END class CNovinkyRubrika


  


?>

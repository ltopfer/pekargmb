<?php
require("../spojenie.php");
require("../crubrika.php");
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
class CRubrika_Foto extends CRubrika
{
	// variables
	var $chybafotky='',$Upravafoto,$adresarfotek='pdfsoubory/';


	// constructor
	function CRubrika_Foto($Nazev,$Upravafoto=false)
	{ // BEGIN constructor
		$this->chybafotky=$chybafotky;
    $this->Upravafoto=$Upravafoto;
    $this->CRubrika($Nazev);
	} // END constructor
	
	
/*---------------------------	Popis metody  NastavAdresarFotek()----------------

Metoda NastavAdresarFotek($cilfoto='foto/')
nastav� c�lov� adres��e pro ukl�d�n� fotek
implicitn� nastaveno na: $cilfoto='foto/'
------------------------------------------------------------------------------*/	
function 	NastavAdresarFotek($cil='pdfsoubory/')
{	
$this->adresarfotek=$cil;	
}	

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

function Formular_obec($fsloupec,$fcopridat='polo�ku',$fzpracovani='administrace.php')
{ 
echo"
  <div class=\"centrovano\">
<form enctype=\"multipart/form-data\" action=\"$fzpracovani\" method=\"post\">
<table border=\"1\"  class=\"centrovano\" >
    "; 
  for ($i=0;$i<$this->pocetsloupcu ;$i++ ) {
  //$chyba[$i]='*';  
  
  switch ($this->sloupec[$i]) {
  case 'nadpis':
  
      echo"<tr><td>";echo $this->sloupec[$i]; echo":</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"65\" name=\"".$this->sloupec[$i]."\" value=\"".$fsloupec[$i]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
           
   case 'text':
   
         echo"<tr><td>";echo $this->sloupec[$i]; echo":</td>";
        echo"
       <td class=\"chyba\">
        <textarea  rows=\"20\" name=\"".$this->sloupec[$i]."\" cols=\"50\">".$fsloupec[$i]."</textarea>".$this->chyba[$i]."</td></tr>
            ";
         	break; 
                      
              
  default:
  	/*echo $this->sloupec[$i];
        echo":::<INPUT TYPE=\"TEXT\" SIZE=\"45\" NAME=\"".$this->sloupec[$i]."\" VALUE=\"".$fsloupec[$i]."\" ><br />
            ";*/
  	break;
  }

}  


if($this->pocetobr()<50) {echo"<tr><td colspan=\"2\"  class=\"centrovano\" > 
Vlo�te text ve form�tu pdf,  max. 50kB  <br />
   <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"50000000\" /> 
  Vybertesoubor v po��ta�i:<input name=\"soubor\" type=\"file\"  accept=\"image/* ,application/pdf \" />
  <span class=\"chyba\">     $this->chybafotky  </span>  </td></tr> 
                     ";
                      
                     
                        }
         else echo"<tr><td colspan=\"2\"  class=\"centrovano\" > Po�et soubor� v adres��i je v�t�� ne� 50 . Kapacita vy�erp�na.Sma�te star�� z�zanmy .</td></tr> ";


	          


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





/*---------------------------Popis metody Formular_kontrola($kontrpole)---------

Metoda Formular_kontrola($kontrpole) kontroluje, zda $kontrpole , kter� jsou
ozna�eny jako povinn� tj. '*'neobsahuje pr�zn� polo�ky a zda zadan� polo�ky 
odpov�daj� p�edem stanoven�m po�adavk�m, nap�. polo�ka mail.

Roz���en�:kontroluje, zda odes�lan� soubor m� form�t  $_FILES['soubor']['type'],
$_FILES['soubor']['size']  jpg a zda nep�ekro�il velikost limit=50 kB
------------------------------------------------------------------------------*/
function Formular_kontrola($kontrpole,$limit=50000000)
{
$kontrolatextu=CRubrika::Formular_kontrola($kontrpole);
/*application/pdf*/
if($_FILES['soubor']['name']!="") { 
$nahrani=true;
 if ($_FILES['soubor']['size']>$limit) {$nahrani=false;$this->chybafotky="nespln�ny vstupn� podm�nky";}
if (  $_FILES['soubor']['type']!="image/pjpeg" && $_FILES['soubor']['type']!="image/jpeg" && $_FILES['soubor']['type']!="image/jpg" && $_FILES['soubor']['type']!="application/pdf") {$nahrani=false;$this->chybafotky="nespln�ny vstupn� podm�nky";}
	                $verdikt= ($kontrolatextu && $nahrani);
                                    }
    else $verdikt=$kontrolatextu;

 return $verdikt;
 }
/*----------------------------------------------------------------------------*/


/*---------------------------Popis metody  Preber_rozmery()---------------------

 V p��pad� �e je spln�na podm�nka Upravafoto p�ebere po�adovan� rozm�ry obr�zku
------------------------------------------------------------------------------*/
function Preber_rozmery()
{ 
if($this->Upravafoto)
{
$rpole[sirka]=$_POST[sirka];
$rpole[vyska]=$_POST[vyska];
return $rpole ;
}
else return false ;
}

/*-------------------------------------------------------------------------------------*/





 
/*--------------------------Popis metody Pridej_do_Rubriky($fpole)--------------

Metoda  Pridej_do_Rubriky($fpole) p�id� polo�ku ur�enou parametrem $fpole do 
p��slu�n� tabulky a vrac� id p�idan� polo�ky

Roz���en�:v p��pad� , �e je p�ilo�ena fotka, ulo�� ji 
do p�edem ur�en�ho adres��e $this->adresarfotek 
(pop��pad� zm�n� rozm�ry)$this->image_resize 
------------------------------------------------------------------------------*/
function Pridej_do_Rubriky($fpole,$fvyska=0,$fsirka=0)
{ 
$poradovecislo=CRubrika::Pridej_do_Rubriky($fpole);
if($_FILES['soubor']['name']!=""){
$cislofotky=$poradovecislo;
$nazev = $_FILES['soubor']['type']=="application/pdf" ? $cislofotky.'.pdf' : $cislofotky.'.jpg' ;
$uploadDir = $this->adresarfotek;$uploadFile = $uploadDir.$nazev;  
	if (move_uploaded_file($_FILES['soubor']['tmp_name'], $uploadFile))$vysledek =$uploadFile;
   else $vysledek =false;
if($vysledek==$uploadFile && $this->Upravafoto && ($fvyska!=0||$fsirka!=0)&& $_FILES['soubor']['type']!="application/pdf" ) $this->image_resize($uploadFile,$uploadFile,$fvyska,$fsirka); 
 
           }
return $vysledek ;
}



/*---------------------------Popis metody Update_v_Rubrice($f_id,$f_updatepole)-

Metoda m�n� obsah polo�ky z rubriky a vrac� ��slo t�to polo�ky

Roz���en�:
Umo��uje zm�nu fotky 
------------------------------------------------------------------------------*/
function Update_v_Rubrice($f_id,$f_updatepole,$fvyska=0,$fsirka=0)
{  
$poradovecislo=CRubrika::Update_v_Rubrice($f_id,$f_updatepole);
if($_FILES['soubor']['name']!=""){
$cislofotky=$poradovecislo;
$nazev = $_FILES['soubor']['type']=="application/pdf" ? $cislofotky.'.pdf' : $cislofotky.'.jpg' ;
$uploadDir = $this->adresarfotek;$uploadFile = $uploadDir.$nazev;

if( file_exists ($uploadFile)){
                                   unlink ($uploadFile);$vysledek_mazani =true;
                                   }
       else $vysledek_mazani =false;   
 
	if (move_uploaded_file($_FILES['soubor']['tmp_name'], $uploadFile))$vysledek =$uploadFile;
   else $vysledek =false;
if($vysledek==$uploadFile && $this->Upravafoto && ($fvyska!=0||$fsirka!=0)&& $_FILES['soubor']['type']!="application/pdf" ) $this->image_resize($uploadFile,$uploadFile,$fvyska,$fsirka); 
 
           }

return ($f_id);
}




/*---------------------------------------------------------------------------*/ 




/*--------------------------Popis metody Smaz_z_Rubriky($f_id)--------------

Metoda ma�e polo�ku z rubriky a vrac� Po�adovan� ��slo smaz�n�

Roz���en�:
je li p�ilo�ena fotka, sma�e ji z p�edem ur�en�ho
 adres��e parametrem $this->adresarfotek
 a sma�e i nahled z adres��e $this->adresarnahledu
------------------------------------------------------------------------------*/
function  Smaz_z_Rubriky($f_id) 
{ 
$poradovecislo=CRubrika::Smaz_z_Rubriky($f_id);

$cislofotky=$f_id;$nazev=$cislofotky.'.jpg';$nazevpdf=$cislofotky.'.pdf';
$uploadDir = $this->adresarfotek;
$cestakfotce = $uploadDir.$nazev; 
$cestakpdefku = $uploadDir.$nazevpdf;  
	 if( file_exists ($cestakfotce)){
                                   unlink ($cestakfotce);$vysledek =$cestakfotce;
                                   }
 if( file_exists ($cestakpdefku)){
                                   unlink ($cestakpdefku);$vysledek =$cestakpdefku;
                                   }                                  
                                   
       else $vysledek =false;                              
return $vysledek ;
}
/*----------------------------------------------------------------------------*/



/*---------------------------Popis metody FormatujObashRubriky($f_id='')-

Metoda vypisuje obsah tabulky a nab�z� z�kladn� form�tov�n�:
id...neform�tov�no
datum,autor: v�stup ve form� <span class=\"datum, autor\"> hodnota</span>
email      :v�stup ve form� <a href=\"mailto:$v\" class=\"email\" > hodnota </a>
ostan� :v�stup ve form� <div class=\"jmeno_sloupce\"> hodnota</div>

Roz���en�:
$f_id...ur�uje id vybran� novinky
------------------------------------------------------------------------------*/		
function 	FormatujObashRubriky($f_id)
{
$nahled=$f_id;
$PoleRubrik=CRubrika::FormatujObashRubriky($f_sloupec,$f_kriterium, 'nadpis ASC',$f_vlastnik);
    
if ($nahled == '')
{
    echo"<table border=\"0\" width=\"100%\">";
    for ($i=0;$i<$this->get_pocet_zaznamu();$i++) {
        $adresapdefka=$this->adresarfotek.$PoleRubrik[id][$i].'.pdf';
        $odkaznapdf=( file_exists($adresapdefka))? "<a href=\"$adresapdefka\" title=\"Podrobn� text v pdf\"  onclick=\"return !window.open(this.href)\">
            <img src=\"../obr/pdefko.gif\" alt=\"pdefko.gif, 767B\" title=\"text v pdf\" border=\"0\" height=\"39\" width=\"37\" class=\"obrvlevobezokraje\"> 
            </a>"   :    " __ ";
        echo"<tr>
            <td><a href=\"skolni_rad.php?zobr={$PoleRubrik[id][$i]}#cil\" >{$PoleRubrik[nadpis][$i]}</a></td>
            <td align=\"center\"><br />$odkaznapdf</td>
        </tr> ";
    } 
    echo" </table>";
}
else
{
    for ($i=0;$i<$this->get_pocet_zaznamu();$i++) {
        $adresapdefka=$this->adresarfotek.$PoleRubrik[id][$i].'.pdf';
        $odkaznapdf=( file_exists($adresapdefka))? "<a href=\"$adresapdefka\" title=\"Podrobn� text v pdf\"  onclick=\"return !window.open(this.href)\">
 <img src=\"../obr/pdefko.gif\" alt=\"pdefko.gif, 767B\" title=\"text v pdf\" border=\"0\" height=\"39\" width=\"37\" class=\"obrvlevobezokraje\"> 
     </a>"   :    " __ ";
        if ($nahled==$PoleRubrik[id][$i]) { 
            echo "<div class=\"rad_nahled\"><a href=\"?zobr= \" > <img src=\"../obr/zavri.gif\" alt=\"zavri.gif, 767B\" title=\"zav��t\" border=\"0\" height=\"20\" width=\"20\" class=\"obrvpravobezokraje\"> </a> 
            <a name=\"cil\"></a> <h5>{$PoleRubrik[nadpis][$i] }</h5>
            $odkaznapdf<div class=\"skrolovatkorady\">";
            echo NL2BR($PoleRubrik[text][$i]); 
            echo" </div></div>";
        }
    }
}                             
}
/*----------------------------------------------------------------------------*/

/*---------------------------Popis metody pocetobr()----------------------------

Metoda pocetobr() vrac� Po�et fotek � v adres��i $this->adresarfotek
------------------------------------------------------------------------------*/
function pocetobr()
{
$fadresar=$this->adresarfotek;
//echo " adres��:$fadresar";
	$obrazky_adresar = opendir($fadresar);
	while ($obrazek = readdir($obrazky_adresar)) 
	{
		if (($obrazek != '.') and ($obrazek != '..'))
		{
			$obrazky[] = $obrazek;	
		}
	}
	closedir($obrazky_adresar);
	
	 return Count($obrazky);
}
/*----------------------------------------------------------------------------*/


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
 echo" 

 <form action=\"$kamodelsat\"  method=\"post\"  enctype=\"multipart/form-data\" >
     ";
     
echo" <div class=\"skrolovatko\"> ";

if($f_id!=""){  //zobraz novinku nahore
$VybranaNovinka=CRubrika::VyberPolozku($f_id);
if($oznvse=='ano') {// k ifu     

 echo"<div class=\"centrovano\">    
    <table  class=\"novinka\" width=\"80%\">
 <tr class=\"nadpisv-n-c \" ><td>".$VybranaNovinka[nadpis]."
  <hr />
<span class=\"obrvlevo\"> ozna�it pro n�sledn� vymaz�n�:<input type=\"checkbox\" checked=\"checked\" name=\"smaz[]\" value=\"".$VybranaNovinka[id]."\" /></span>
<span class=\"obrvpravo\">  editovat z�znam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$VybranaNovinka[id]."\" class=\"tlacitko\" /></span> 
 </td></tr>";
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$VybranaNovinka[id]."\"> </a>";
$adresafotky=$this->adresarfotek.$VybranaNovinka[id].'.jpg';
$adresapdefka=$this->adresarfotek.$VybranaNovinka[id].'.pdf';
if (file_exists ($adresafotky))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";  
 echo NL2BR(  substr($VybranaNovinka[text], 0, 20)    ); echo'......'; 
 if (file_exists ($adresapdefka))echo"
                                 <hr />
<a href=\"$adresapdefka\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 P��loha *.pdf
 </a>                                ";   
  echo"</td></tr> </table>
  
  </div>";
  
echo"<br />";
                                             
                         }// kifu   
                         
else  {
echo"<div class=\"centrovano\">    
    <table  class=\"novinka\" width=\"80%\">
 <tr class=\"nadpisv-n-c \" ><td>".$VybranaNovinka[nadpis]."
  <hr />
<span class=\"obrvlevo\"> ozna�it pro n�sledn� vymaz�n�:<input type=\"checkbox\" name=\"smaz[]\" value=\"".$VybranaNovinka[id]."\" /></span>
<span class=\"obrvpravo\">  editovat z�znam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$VybranaNovinka[id]."\" class=\"tlacitko\" /></span> 
 </td></tr>";
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$VybranaNovinka[id]."\"> </a>";
$adresafotky=$this->adresarfotek.$VybranaNovinka[id].'.jpg';
$adresapdefka=$this->adresarfotek.$VybranaNovinka[id].'.pdf';
if (file_exists ($adresafotky))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";  
 echo NL2BR(  substr($VybranaNovinka[text], 0, 20)    ); echo'......'; 
 if (file_exists ($adresapdefka))echo"
                                 <hr />
<a href=\"$adresapdefka\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 P��loha *.pdf
 </a>                                ";   
  echo"</td></tr> </table>
  
  </div>";
  
echo"<br />";


        }                          




               } //zobraz novinku nahore

else { //k zobraz v�e
$PoleRubrik=CRubrika::FormatujObashRubriky($f_sloupec,$f_kriterium, $f_tridit_podle,$f_vlastnik);
//echo" po�et z�znam�:".$this->get_pocet_zaznamu()." <br />"; 

         

if($oznvse=='ano') {// k ifu     
for ($i=0;$i<count($PoleRubrik[id]) ;$i++) {
 echo"<div class=\"centrovano\">    
    <table  class=\"novinka\" width=\"80%\">
 <tr class=\"nadpisv-n-c \" ><td>".$PoleRubrik[nadpis][$i]."
  <br />
<span class=\"obrvlevo\"> ozna�it pro n�sledn� vymaz�n�:<input type=\"checkbox\" checked=\"checked\" name=\"smaz[]\" value=\"".$PoleRubrik[id][$i]."\" /></span>
<span class=\"obrvpravo\">  editovat z�znam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$PoleRubrik[id][$i]."\" class=\"tlacitko\" /></span> 
 </td></tr>";
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$PoleRubrik[id][$i]."\"> </a>";
$adresafotky=$this->adresarfotek.$PoleRubrik[id][$i].'.jpg';
$adresapdefka=$this->adresarfotek.$PoleRubrik[id][$i].'.pdf';
if( (file_exists ($adresafotky))&&($i%2==0))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
if( (file_exists ($adresafotky))&&($i%2!=0))echo"<img src=\"$adresafotky\" class=\"obrvpravo\" alt=\"foto\" />";
  
echo NL2BR(  substr($PoleRubrik[text][$i], 0, 20)    ); echo'......';   
 if (file_exists ($adresapdefka))echo" <hr />
<a href=\"$adresapdefka\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 P��loha *.pdf
 </a>             "; 
  echo"</td></tr> </table>
  
  </div>";
  
echo"<br />";
                                              }
                         }// kifu    
                         
           else  {//k else            
 for ($i=0;$i<count($PoleRubrik[id]);$i++) {
 echo"<div class=\"centrovano\">    
    <table  class=\"novinka\" width=\"80%\">
 <tr class=\"nadpisv-n-c \" ><td>".$PoleRubrik[nadpis][$i]."
 <br />
<span class=\"obrvlevo\"> ozna�it pro n�sledn� vymaz�n�:<input type=\"checkbox\"  name=\"smaz[]\" value=\"".$PoleRubrik[id][$i]."\" /></span>
<span class=\"obrvpravo\">  editovat z�znam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$PoleRubrik[id][$i]."\" class=\"tlacitko\" /></span>
 </td></tr>";
 
 
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$PoleRubrik[id][$i]."\"> </a>";
$adresafotky=$this->adresarfotek.$PoleRubrik[id][$i].'.jpg';
$adresapdefka=$this->adresarfotek.$PoleRubrik[id][$i].'.pdf';
if( (file_exists ($adresafotky))&&($i%2==0))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
if( (file_exists ($adresafotky))&&($i%2!=0))echo"<img src=\"$adresafotky\" class=\"obrvpravo\" alt=\"foto\" />";
  echo NL2BR(  substr($PoleRubrik[text][$i], 0, 20)    ); echo'......';  
 
 if (file_exists ($adresapdefka))echo" <hr />
<a href=\"$adresapdefka\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 P��loha *.pdf
 </a>             ";  
  echo"</td></tr> </table>
 
  </div>";
 echo"<br />"; 

                                              }                                           
                  } // k else   
                  
        }//k zobraz v�e
 echo" </div>" ; // skrolovatko                                                
 echo"<hr />";                                        
echo" <table width=\"100%\" border=\"0\">  
   <tr><td>
     <div class=\"chyba\" >Ozna�it V�ECHNY VA�E z�znamy  pro vymaz�n�?  <input type=\"submit\"  value=\"ano\" name=\"oznvse\" class=\"tlacitko\" />  <input type=\"submit\"  value=\"odzna�it\" name=\"oznvse\" class=\"tlacitko\" />  </div>
";

echo"<input type=\"hidden\" name=\"akce\" value=\"editace_stranky\" />";
echo" <span >Trvale odstranit ozna�en� z�znamy <input type=\"submit\"  value=\"smazat\" name=\"editakce\" class=\"tlacitko\" /></span>
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
global $akce,$codelat,$editzaznam,$superadmin  ;

$PoleZaznamu=CRubrika::VyberPolozku($f_id); 
echo" Z�zanm �.:$PoleZaznamu[id] Datum z�zanmu: $PoleZaznamu[datum]<br />";
$adresafotky=$this->adresarfotek.$PoleZaznamu[id].'.jpg';
$adresapdefka=$this->adresarfotek.$PoleZaznamu[id].'.pdf';
echo"
 <div class=\"centrovano\">
<form enctype=\"multipart/form-data\" action=\"$fzpracovani\" method=\"post\">";

               
if (file_exists ($adresapdefka))echo" <div  class=\"centrovano\">
<a href=\"$adresapdefka\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 P��loha *.pdf
 </a>   </div> ";
  else echo"<div  class=\"centrovano\"> P��loha *.pdf nebyla p�ilo�ena.
               </div>";  
echo"
<table border=\"1\"  class=\"centrovano\" >
    "; 
  for ($i=0;$i<$this->pocetsloupcu ;$i++ ) {
  //$chyba[$i]='*';  
  //$nazevsloupce=$this->sloupec[$i];
   // $hodnotavtabulce=$PoleZaznamu[ $nazevsloupce];
    
  switch ($this->sloupec[$i]) {
  case 'nadpis':
 
      echo"<tr><td>";echo $this->sloupec[$i]; echo":</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"65\" name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
           
   case 'text':
   
         echo"<tr><td>";echo $this->sloupec[$i]; echo":</td>";
        echo"
       <td class=\"chyba\">
        <textarea  rows=\"20\" name=\"".$this->sloupec[$i]."\" cols=\"50\">".$PoleZaznamu[$this->sloupec[$i]]."</textarea>".$this->chyba[$i]."</td></tr>
            ";
         	break;  
                     
              
  default:
  	/* neprov�d� se nic*/
  	break;
  }

}  




if($this->pocetobr()<50) {echo"<tr><td colspan=\"2\"  class=\"centrovano\" > Text ve form�tu pdf,  max. 50kB  <br />
   <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"50000000\" /> 
  Vyberte soubor v po��ta�i:<input name=\"soubor\" type=\"file\"  accept=\"image/* ,application/pdf \" />
  <span class=\"chyba\">     $this->chybafotky  </span>  </td></tr> 
                     ";
                     
	          
                       }
         else echo"<tr><td colspan=\"2\"  class=\"centrovano\" > Po�et soubor� v adres��i je v�t�� ne� 50 .Kapacita vy�erp�na.Sma�te star�� z�zanmy .</td></tr> ";

 


 echo"  
 
 
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


/*---------------------------Popis metody VyberSeznamNovinek()-----------------

Metoda VyberSeznamNovinek() vrac� pole id, datum, nadpis novinek
------------------------------------------------------------------------------*/
 function VyberSeznamNovinek($f_vlastnik='')
 {  

  if ($f_vlastnik!='') {
    
          @$vsechnyzazanamy=MySQL_Query("Select id,datum,nadpis FROM $this->Nazev WHERE vlastnik='$f_vlastnik' ORDER BY id DESC ; ")OR DIE(MySQL_Error()) ;    
                         }   
                else   { 
         @$vsechnyzazanamy=MySQL_Query("Select id,datum,nadpis FROM $this->Nazev  ORDER BY nadpis ASC ; ")OR DIE(MySQL_Error()) ; 
                        }
         while ($zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC)) {
          foreach($zaznam as $k => $v) {
         
               $ven[$k][]=$v;
         	
                         
                                       }
         
         
         
            
         
                                                                     }

            
                                                                     
return ($ven);
 }       






/*----------------------------------------------------------------------------*/	
	
} // END class CNovinkyRubrika


  


?>

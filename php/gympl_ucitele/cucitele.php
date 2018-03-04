<?php
require("../spojenie.php");
require("../crubrika.php");
/*---------------------------Popis tøídy Crubrika_Foto--------------------------
Tøídy Crubrika_Foto je potomkem tøídy Crubrika

 Popis tøídy CRubrika :Slouží k manipulaci s daty v tabulce MySQL databáze
Konfigurace tabulky v databázi: první sloupec tabulky je id 
                                ostatní sloupce jsou libovolné.

Popis atributù tøídy CRubrika:
Nazev....Název  zpracovávané tabulky v databázi
pocetsloupcu...poèet sloupcù v tabulce
sloupec...pole s názvy sloupcù tabulky
typsloupce...pole s identifikátory typù jednotlivých sloupcù tabulky
chyba...pole chybových hlášení pøíslušenící ke sloupcùm tabulky, používá se 
pøi vyhodnocování odeslaného formuláøe

Rozšíøení atributù:
Tabulka V databázi MySQL: id, datum,jmeno,prijmeni,prezdivka,heslo, email,
prava_fotogal,prava_novinky
chybafotky...chybové hlášení fotky
Upravafoto... boolean identifikuje zda bude odesilané foto opraveno(rozmmìry)
adresarfotek...specifikuje adresáø pro ukládání fotek
------------------------------------------------------------------------------*/
class CRubrika_Foto extends CRubrika
{
	// variables
	var $chybafotky='',$Upravafoto,$adresarfotek='foto/';


	// constructor
	function CRubrika_Foto($Nazev,$Upravafoto=false)
	{ // BEGIN constructor
		$this->chybafotky=$chybafotky;
    $this->Upravafoto=$Upravafoto;
    $this->CRubrika($Nazev);
	} // END constructor
	
	
/*---------------------------	Popis metody  NastavAdresarFotek()----------------

Metoda NastavAdresarFotek($cilfoto='foto/')
nastaví cílové adresáøe pro ukládání fotek
implicitnì nastaveno na: $cilfoto='foto/'
------------------------------------------------------------------------------*/	
function 	NastavAdresarFotek($cil='foto/')
{	
$this->adresarfotek=$cil;	
}	

/*---------------------------Popis metody Formular_obec()-----------------------

Metoda Formular_obec($fsloupec,$fzpracovani='formular.php')
generuje formuláø pro odeslání záznamu. Formátování do tabulky.
První sloupec : názvy sloupcù z tabulky MySQL databáze.
Typy jednotlivých vstupních polí:
nadpis, autor,email: input type="text" 
text:               textarea
neurèená : negeneruje nic, je nutno doplnit    case 'další údaj': vstupni pole  
                                                     break;
Pøi odeslání formuláøe je odesílán parametr odeslano=true 
parametr $fzpracovani urèuje zpracovatelský skript.
 
Rozšíøení:
V pøípadì , že poèet fotek v adresáøi je menší než 50, pøidá pole pro odeslání 
fotky ve formátu jpg input name=\"soubor\" type=\"file\"                                                
------------------------------------------------------------------------------*/

function Formular_obec($fsloupec,$fcopridat='uèitele',$fzpracovani='administrace.php')
{ 
echo"
  <div class=\"centrovano\">
<form enctype=\"multipart/form-data\" action=\"$fzpracovani\" method=\"post\">
<table border=\"1\"  class=\"centrovano\" >
    "; 
  for ($i=0;$i<$this->pocetsloupcu ;$i++ ) {
  //$chyba[$i]='*';  
  
  switch ($this->sloupec[$i]) {
  case 'jmeno':
  echo"<tr><td>"; echo" jméno:</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$fsloupec[$i]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
  case 'prijmeni':
  echo"<tr><td>"; echo"pøíjmení:</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$fsloupec[$i]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
  	 case 'titul': 
      echo"<tr><td>";echo $this->sloupec[$i]; echo":</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$fsloupec[$i]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
         	case 'kategorie': 
         	     
         	 echo"<tr><td>";
           echo $this->sloupec[$i];echo":</td>";
           echo"<td class=\"chyba\"> <select name=\"".$this->sloupec[$i]."\" size=\"1\">";
if ($fsloupec[$i]=='uèitelé') {echo"<option value=\"uèitel\" selected=\"selected\">uèitelé</option>";} 
                       else {echo"<option value=\"uèitelé\">uèitelé</option>";}
	
if ($fsloupec[$i]=='thp pracovníci') {echo"<option value=\"thp pracovníci\" selected=\"selected\">thp pracovníci</option>";} 
                       else {echo"<option value=\"thp pracovníci\">thp pracovníci</option>";} 
if ($fsloupec[$i]=='správní zamìstnanci') {echo"<option value=\"správní zamìstnanci\" selected=\"selected\">správní zamìstnanci</option>";} 
                      else {echo"<option value=\"správní zamìstnanci\">správní zamìstnanci</option>";}                             
if ($fsloupec[$i]=='hala') {echo"<option value=\"hala\" selected=\"selected\">hala</option>";} 
                       else{echo"<option value=\"hala\">hala</option>";}                        
if ($fsloupec[$i]=='jídelna') {echo"<option value=\"jídelna\" selected=\"selected\">jídelna</option>";} 
                       else {echo"<option value=\"jídelna\">jídelna</option>";}  

echo"
 </select>".$this->chyba[$i]."</td></tr>
               ";
         	
      
         	break;
         	
         	 case 'aprobace': 
      echo"<tr><td>";echo $this->sloupec[$i]; echo"<br />(pracovní zaøazení):</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$fsloupec[$i]."\" />".$this->chyba[$i]."
       <a href=\"help_aprobace.htm\" onclick=\" window.open('help_aprobace.htm','_blank', 'width=200,height=450,menubar=no,scrollbars=yes,resizable=yes,left=0,top=0');return false\"> 
       <img src=\"../obr/help.gif\" alt=\"Dokumentace\" title=\"Dokumentace\" width=\"14\" height=\"14\"  /></a>
        
        </td></tr>
            ";
         	break;
    case 'email': 
      echo"<tr><td>";echo $this->sloupec[$i]; echo":</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$fsloupec[$i]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
         	 case 'telefon': 
      echo"<tr><td>";echo $this->sloupec[$i]; echo":</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$fsloupec[$i]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
         	  	 case 'funkce': 
         	  	  echo"<tr><td>"; echo"funkce zamìstnance:</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$fsloupec[$i]."\" />".$this->chyba[$i]."
  <a href=\"help_funkce.htm\" onclick=\" window.open('help_funkce.htm','_blank', 'width=200,height=450,menubar=no,scrollbars=yes,resizable=yes,left=0,top=0');return false\"> 
       <img src=\"../obr/help.gif\" alt=\"Dokumentace\" title=\"Dokumentace\" width=\"14\" height=\"14\"  /></a>       
        </td></tr>
            ";
         	  		break; 
         	  	 /* case 'funkceaj': 
      echo"<tr><td>"; echo"název funkce v AJ:</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$fsloupec[$i]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;*/
         	 case 'poznamka':
   
         echo"<tr><td>"; echo" poznámka:</td>";
        echo"
       <td class=\"chyba\">
        <textarea  rows=\"7\" name=\"".$this->sloupec[$i]."\" cols=\"40\">".$fsloupec[$i]."</textarea>".$this->chyba[$i]."</td></tr>
            ";
         	break;    
           

    
 
              
  default:
  	/*echo $this->sloupec[$i];
        echo":::<INPUT TYPE=\"TEXT\" SIZE=\"45\" NAME=\"".$this->sloupec[$i]."\" VALUE=\"".$fsloupec[$i]."\" ><br />
            ";*/
  	break;
  }

}  


if($this->pocetobr()<150) {echo"<tr><td colspan=\"2\"  class=\"centrovano\" > Mùžete pøidat foto uživatele, 
max. 50kB,formát *.jpg,doporuèené  rozmìry 120x150px <br />
   <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"50000\" /> 
  Vyberte obrázek v poèítaèi:<input name=\"soubor\" type=\"file\"  accept=\"image/*\" />
  <span class=\"chyba\">     $this->chybafotky  </span>  </td></tr> 
                     ";
                      if ($this->Upravafoto) {
              echo"<tr><td colspan=\"2\"  class=\"centrovano\" >
              upravit rozmìry, 
šíøka: <select name=\"sirka\" size=\"1\">   
<option value=\"120\">120</option>
<option value=\"150\">150</option>
<option value=\"100\">100</option> 
 </select> px ,  
 výška: <select name=\"vyska\" size=\"1\">
<option value=\"150\">150</option>
<option value=\"120\">120</option>
<option value=\"100\">100</option> 
</select>  px 
              </td></tr> ";
 	
                     }  
                          }
         else echo"<tr><td colspan=\"2\"  class=\"centrovano\" > Poèet obrázkù v adresáøi je vìtší než 150 . Kapacita vyèerpána.Smažte starší zázanmy s obrázky.</td></tr> ";


	          


 echo"  
 
 
 <tr><td colspan=\"2\"  class=\"centrovano\" >                
<input type=\"hidden\" name=\"odeslano\" value=\"true\" />
<input type=\"hidden\" name=\"akce\" value=\"$fcopridat\" />
<br />
<input type=\"submit\"  value=\"odeslat\" name=\"dotaznik\" class=\"tlacitko\" />
<hr />
 <input type=\"reset\" value=\"smazat neodeslané údaje\" class=\"tlacitko\" />
  </td></tr>
</table>
</form>
 </div> <!--     centrováno    -->
   ";
 }
/*----------------------------------------------------------------------------*/

/*---------------------------Popis metody Vyber_volitelna_pole($fsloupec)-------

Metoda Vyber_volitelna_pole($fsloupec) umožòuje oznaèit nìkteré údaje ve
 formuláøi jako nepovinná tak, že promìnnou chyba[pøíslušného sloupce] pøestaví
 z hodnoty '*' na hodnotu ''. Tím ovlivní zobrazení formuláøe , u tìchto udajù
 ce nezobrazí '*' .                                                  
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




/*---------------------------Popis metody Formular_kontrola($kontrpole)---------

Metoda Formular_kontrola($kontrpole) kontroluje, zda $kontrpole , které jsou
oznaèeny jako povinné tj. '*'neobsahuje prázné položky a zda zadané položky 
odpovídají pøedem stanoveným požadavkùm, napø. položka mail.,prezdivku a heslo

Rozšíøení:kontroluje, zda odesílaný soubor má formát  $_FILES['soubor']['type'],
$_FILES['soubor']['size']  jpg a zda nepøekroèil velikost limit=50 kB
------------------------------------------------------------------------------*/
function Formular_kontrola($kontrpole,$limit=50000,$jedinecnost_hesla_prezdivky=true)
{
$kontrolatextu=CRubrika::Formular_kontrola($kontrpole,$jedinecnost_hesla_prezdivky);

if($_FILES['soubor']['name']!="") { 
$nahrani=true;
 if ($_FILES['soubor']['size']>$limit) {$nahrani=false;$this->chybafotky="nesplnìny vstupní podmínky";}
if (  $_FILES['soubor']['type']!="image/pjpeg" && $_FILES['soubor']['type']!="image/jpeg" && $_FILES['soubor']['type']!="image/jpg") {$nahrani=false;$this->chybafotky="nesplnìny vstupní podmínky";}
	                $verdikt= ($kontrolatextu && $nahrani);
                                    }
    else $verdikt=$kontrolatextu;

 return $verdikt;
 }
/*----------------------------------------------------------------------------*/


/*---------------------------Popis metody  Preber_rozmery()---------------------

 V pøípadì že je splnìna podmínka Upravafoto pøebere požadované rozmìry obrázku
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

Metoda  Pridej_do_Rubriky($fpole) pøidá položku urèenou parametrem $fpole do 
pøíslušné tabulky a vrací id pøidané položky

Rozšíøení:v pøípadì , že je pøiložena fotka, uloží ji 
do pøedem urèeného adresáøe $this->adresarfotek 
(popøípadì zmìní rozmìry)$this->image_resize 
------------------------------------------------------------------------------*/
function Pridej_do_Rubriky($fpole,$fvyska=0,$fsirka=0)
{ 
$poradovecislo=CRubrika::Pridej_do_Rubriky($fpole);
if($_FILES['soubor']['name']!=""){
$cislofotky=$poradovecislo;$nazev=$cislofotky.'.jpg';
$uploadDir = $this->adresarfotek;$uploadFile = $uploadDir.$nazev;  
	if (move_uploaded_file($_FILES['soubor']['tmp_name'], $uploadFile))$vysledek =$uploadFile;
   else $vysledek =false;
if($vysledek==$uploadFile && $this->Upravafoto && ($fvyska!=0||$fsirka!=0) ) $this->image_resize($uploadFile,$uploadFile,$fvyska,$fsirka); 
 
           }
return $vysledek ;
}



/*---------------------------Popis metody Update_v_Rubrice($f_id,$f_updatepole)-

Metoda mìní obsah položky z rubriky a vrací èíslo této položky

Rozšíøení:
Umožòuje zmìnu fotky 
------------------------------------------------------------------------------*/
function Update_v_Rubrice($f_id,$f_updatepole,$fvyska=0,$fsirka=0)
{  
$poradovecislo=CRubrika::Update_v_Rubrice($f_id,$f_updatepole);
if($_FILES['soubor']['name']!=""){
$cislofotky=$poradovecislo;$nazev=$cislofotky.'.jpg';
$uploadDir = $this->adresarfotek;$uploadFile = $uploadDir.$nazev;

if( file_exists ($uploadFile)){
                                   unlink ($uploadFile);$vysledek_mazani =true;
                                   }
       else $vysledek_mazani =false;   
 
	if (move_uploaded_file($_FILES['soubor']['tmp_name'], $uploadFile))$vysledek =$uploadFile;
   else $vysledek =false;
if($vysledek==$uploadFile && $this->Upravafoto && ($fvyska!=0||$fsirka!=0) ) $this->image_resize($uploadFile,$uploadFile,$fvyska,$fsirka); 
 
           }

return ($f_id);
}




/*---------------------------------------------------------------------------*/ 




/*--------------------------Popis metody Smaz_z_Rubriky($f_id)--------------

Metoda maže položku z rubriky a vrací Požadované èíslo smazání

Rozšíøení:
je li pøiložena fotka, smaže ji z pøedem urèeného
 adresáøe parametrem $this->adresarfotek
 a smaže i nahled z adresáøe $this->adresarnahledu
------------------------------------------------------------------------------*/
function  Smaz_z_Rubriky($f_id) 
{ 
$poradovecislo=CRubrika::Smaz_z_Rubriky($f_id);

$cislofotky=$f_id;$nazev=$cislofotky.'.jpg';
$uploadDir = $this->adresarfotek;$cestakfotce = $uploadDir.$nazev;  
	 if( file_exists ($cestakfotce)){
                                   unlink ($cestakfotce);$vysledek =$cestakfotce;
                                   }
       else $vysledek =false;                              
return $vysledek ;
}
/*----------------------------------------------------------------------------*/

/*--------------------------Popis metody image_resize()--------------

Metoda image_resize($file_in, $file_out, $max_x, $max_y=0) zmìní velikost 
fotky , která se nachází v adresáøi $file_in , a pøesune do adresáøe $file_out
maximální rozmìry jsou urèeny $max_x, $max_y  volba 0 neprovádí zmìnu rozmìru.
Je zachován pomìr stran.
------------------------------------------------------------------------------*/
function image_resize($file_in, $file_out, $max_x, $max_y=0) {
    $imagesize = getimagesize($file_in);
    if ((!$max_x && !$max_y) || !$imagesize[0] || !$imagesize[1]) {
        return false;
    }
    switch ($imagesize[2]) {
        case 1: $img = imagecreatefromgif($file_in); break;
        case 2: $img = imagecreatefromjpeg($file_in); break;
        case 3: $img = imagecreatefrompng($file_in); break;
        default: return false;
    }
    if (!$img) {
        return false;
    }
    if ($max_x) {
        $width = $max_x;
        $height = round($imagesize[1] * $width / $imagesize[0]);
    }
    if ($max_y && (!$max_x || $height > $max_y)) {
        $height = $max_y;
        $width = round($imagesize[0] * $height / $imagesize[1]);
    }
    $img2 = imagecreatetruecolor($width, $height);
    imagecopyresampled($img2, $img, 0, 0, 0, 0, $width, $height, $imagesize[0], $imagesize[1]);
    if ($imagesize[2] == 2) {
        return imagejpeg($img2, $file_out);
    } elseif ($imagesize[2] == 1 && function_exists("imagegif")) {
        imagetruecolortopalette($img2, false, 256);
        return imagegif($img2, $file_out);
    } else {
        return imagepng($img2, $file_out);
    }
}
/*----------------------------------------------------------------------------*/

/*---------------------------Popis metody FormatujObashRubriky($f_id='')-

Metoda vypisuje obsah tabulky a nabízí základní formátování:
id...neformátováno
datum,autor: výstup ve formì <span class=\"datum, autor\"> hodnota</span>
email      :výstup ve formì <a href=\"mailto:$v\" class=\"email\" > hodnota </a>
ostaní :výstup ve formì <div class=\"jmeno_sloupce\"> hodnota</div>

Rozšíøení:
$f_id...urèuje id vybrané novinky
------------------------------------------------------------------------------*/		
function 	FormatujObashRubriky($f_id,$f_sloupec='',$f_kriterium='',$f_tridit_podle='prijmeni')
{


if($f_id!=""){  //zobraz zamìstnance  nahore
$VybranyUzivatel=CRubrika::VyberPolozku($f_id);

echo"<div class=\"centrovano\">    
    <table  class=\"novinka\" width=\"100%\">
 <tr class=\"nadpisv-n-c \" ><td><a href=\"?zobr=".''.'&amp;sloupec='.$_GET[sloupec].'&amp;hodnotasloupce='.$_GET[hodnotasloupce]." \" > <img src=\"../obr/zavri.gif\" alt=\"zavri.gif, 767B\" title=\"zavøít\" border=\"0\" height=\"20\" width=\"20\" class=\"obrvpravobezokraje\"> </a> 
  Profil zamìstnance
 </td></tr>";
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$VybranyUzivatel[id]."\"> </a>";
$adresafotky=$this->adresarfotek.$VybranyUzivatel[id].'.jpg';
if( (file_exists ($adresafotky)))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
  

  echo"<table>"; 
  echo" <tr><td>jméno: </td> <td>".$VybranyUzivatel[jmeno]."  </td></tr>";
  echo" <tr><td>pøíjmení: </td> <td> ".$VybranyUzivatel[prijmeni]. "   </td></tr>";
     if ($VybranyUzivatel[titul]!='') {
   echo"<tr><td>titul: </td> <td>".$VybranyUzivatel[titul]."</td></tr>"; 
                                        } 
 echo"<tr><td>email: </td> <td> <a href=\"mailto:$VybranyUzivatel[email]\" > ".$VybranyUzivatel[email]." </a>  </td></tr>";
  echo"<tr><td> telefon:</td> <td> ".$VybranyUzivatel[telefon]. " </td></tr>";
   echo"<tr><td>kategorie: </td> <td>".$VybranyUzivatel[kategorie]."  </td></tr>";
  echo"<tr><td>aprobace <br />(pracovní zaøazení): </td> <td>".$VybranyUzivatel[aprobace]."  </td></tr>";
  if ($VybranyUzivatel[funkce]!='') {
   echo"<tr><td> funkce zamìstnance:</td> <td> ".$VybranyUzivatel[funkce]. " </td></tr>";	
  }
  

   /*echo" <tr><td>poznámka: </td><td>".$VybranyUzivatel[poznamka][$i]."</td></tr>"; */
 echo"</table>"; 

echo"</td></tr></table>  
  </div><br />"; 

                    } //zobraz zamìstnance nahore
             {  //zobraz vse
$PoleRubrik=CRubrika::FormatujObashRubriky($f_sloupec,$f_kriterium,$f_tridit_podle);
 
  echo"<div class=\"centrovano\"> ";
  
     echo"                                           
    <table class=\"tabklasik\"  width=\"100%\" cellspacing=0 >
        <col class=\"prvni-sloupec-kontakty\">
        <col class=\"druhy-sloupec-kontakty\">
        <col class=\"treti-sloupec-kontakty\">
        <col class=\"ctvrty-sloupec-kontakty\">
 <tr><th>Jméno </th><th>Aprobace  </th> <th>Email </td><th>Telefon </th></tr>";           
for ($i=0;$i<count($PoleRubrik[id]) ;$i++) { 
 $odkaz=$this->Nazev.'.php?zobr='.$PoleRubrik[id][$i].'&amp;sloupec='.$f_sloupec.'&amp;hodnotasloupce='.$f_kriterium  ; 

echo"<tr><td> <a name=\"".$PoleRubrik[id][$i]."\"> </a>
<a href=\" $odkaz \" >".$PoleRubrik[prijmeni][$i]. ' '.$PoleRubrik[jmeno][$i].' '.$PoleRubrik[titul][$i]."</a></td>
<td>".$PoleRubrik[aprobace][$i]." </td> <td>".$PoleRubrik[email][$i]." </td><td>".$PoleRubrik[telefon][$i]."</td> 
  </tr>";
 
                                             }
   echo"</table></div>";                                      
                    } //zobraz vse                         
                                             
                                             
                                              
}
/*----------------------------------------------------------------------------*/

/*---------------------------Popis metody pocetobr()----------------------------

Metoda pocetobr() vrací Poèet fotek ù v adresáøi $this->adresarfotek
------------------------------------------------------------------------------*/
function pocetobr()
{
$fadresar=$this->adresarfotek;
//echo " adresáø:$fadresar";
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
vypisuje obsah tabulky a nabízí základní formátování pro Admina:
id...neformátováno
datum,autor: výstup ve formì <span class=\"datum, autor\"> hodnota</span>
email      :výstup ve formì <a href=\"mailto:$v\" class=\"email\" > hodnota </a>
ostaní :výstup ve formì <div class=\"jmeno_sloupce\"> hodnota</div>


Rozšíøení:
Parametr $kamodelsat urèuje zpacovatelská skript.
Ke kazdému záznamu pøidává zaškrtávací políèko input type="checkbox" pro 
oznaèení a následné vymazání záznamu
a tlaèítko s id pro editaci záznamu

------------------------------------------------------------------------------*/
 function Admineditacetab($f_id,$kamodelsat='administrace.php',$f_sloupec='',$f_kriterium='',$f_tridit_podle='prijmeni')
 {
global $smaz,$akce,$oznvse;
 echo" 

 <form action=\"$kamodelsat\"  method=\"post\"  enctype=\"multipart/form-data\" >
     ";
     
echo" <div class=\"skrolovatko\"> ";

if($f_id!=""){  //zobraz novinku nahore
$VybranyUzivatel=CRubrika::VyberPolozku($f_id);
if($oznvse=='ano') {// k ifu     

 echo"<div class=\"centrovano\">    
    <table  class=\"novinka\" width=\"80%\">
 <tr class=\"nadpisv-n-c \" ><td>  
  
<span class=\"obrvlevo\"> oznaèit pro následné vymazání:<input type=\"checkbox\" checked=\"checked\" name=\"smaz[]\" value=\"".$VybranyUzivatel[id]."\" /></span>
<span class=\"obrvpravo\">  editovat záznam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$VybranyUzivatel[id]."\" class=\"tlacitko\" /></span> 
<br />
 </td></tr>";
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$VybranyUzivatel[id]."\"> </a>";
$adresafotky=$this->adresarfotek.$VybranyUzivatel[id].'.jpg';
if( (file_exists ($adresafotky)))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
  

  echo"<table>"; 
  echo" <tr><td>jméno: </td> <td>".$VybranyUzivatel[jmeno]."  </td></tr>";
  echo" <tr><td>pøíjmení: </td> <td> ".$VybranyUzivatel[prijmeni]."  </td></tr>";
   echo"<tr><td>titul: </td> <td>".$VybranyUzivatel[titul]."</td></tr>";  
 echo"<tr><td>email: </td> <td> <a href=\"mailto:$VybranyUzivatel[email]\" > ".$VybranyUzivatel[email]." </a>  </td></tr>";
  echo"<tr><td> telefon:</td> <td> ".$VybranyUzivatel[telefon]. " </td></tr>";
  echo"<tr><td>kategorie: </td> <td>".$VybranyUzivatel[kategorie]."  </td></tr>";
  echo"<tr><td>aprobace <br />(pracovní zaøazení): </td> <td>".$VybranyUzivatel[aprobace]."  </td></tr>";
   echo"<tr><td> funkce zamìstnance:</td> <td> ".$VybranyUzivatel[funkce]. " </td></tr>";  
   echo" <tr><td>poznámka: </td><td>".$VybranyUzivatel[poznamka]."</td></tr>"; 
 echo"</table>"; 

echo"</td></tr></table>  
  </div><br />";
                                             
                         }// kifu   
                         
else  {
echo"<div class=\"centrovano\">    
    <table  class=\"novinka\" width=\"80%\">
 <tr class=\"nadpisv-n-c \" ><td> 

<span class=\"obrvlevo\"> oznaèit pro následné vymazání:<input type=\"checkbox\" name=\"smaz[]\" value=\"".$VybranyUzivatel[id]."\" /></span>
<span class=\"obrvpravo\">  editovat záznam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$VybranyUzivatel[id]."\" class=\"tlacitko\" /></span> 
  <br /> </td></tr>";
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$VybranyUzivatel[id]."\"> </a>";
$adresafotky=$this->adresarfotek.$VybranyUzivatel[id].'.jpg';
if( (file_exists ($adresafotky)))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
  
 echo"<table>"; 
  echo" <tr><td>jméno: </td> <td>".$VybranyUzivatel[jmeno]."  </td></tr>";
  echo" <tr><td>pøíjmení: </td> <td> ".$VybranyUzivatel[prijmeni]."  </td></tr>";
   echo"<tr><td>titul: </td> <td>".$VybranyUzivatel[titul]."</td></tr>";  
 echo"<tr><td>email: </td> <td> <a href=\"mailto:$VybranyUzivatel[email]\" > ".$VybranyUzivatel[email]." </a>  </td></tr>";
  echo"<tr><td> telefon:</td> <td> ".$VybranyUzivatel[telefon]. " </td></tr>";
  echo"<tr><td>kategorie: </td> <td>".$VybranyUzivatel[kategorie]."  </td></tr>";
  echo"<tr><td>aprobace <br />(pracovní zaøazení) : </td> <td>".$VybranyUzivatel[aprobace]."  </td></tr>";
   echo"<tr><td> funkce zamìstnance:</td> <td> ".$VybranyUzivatel[funkce]. " </td></tr>";
   echo" <tr><td>poznámka: </td><td>".$VybranyUzivatel[poznamka]."</td></tr>"; 
 echo"</table>"; 
  
echo"</td></tr></table>
  
  </div><br />";


        }                          




               } //zobraz novinku nahore

else { //k zobraz vše
$PoleRubrik=CRubrika::FormatujObashRubriky($f_sloupec,$f_kriterium,$f_tridit_podle);

//echo" poèet záznamù:".$this->get_pocet_zaznamu()." <br />"; 
//echo" count:".count($PoleRubrik[id])." <br />"; 
     

if($oznvse=='ano') {// k ifu     
for ($i=0;$i<count($PoleRubrik[id]);$i++) {
 echo"<div class=\"centrovano\">    
    <table  class=\"novinka\" width=\"80%\">
 <tr class=\"nadpisv-n-c \" ><td> 
 
<span class=\"obrvlevo\"> oznaèit pro následné vymazání:<input type=\"checkbox\" checked=\"checked\" name=\"smaz[]\" value=\"".$PoleRubrik[id][$i]."\" /></span>
<span class=\"obrvpravo\">  editovat záznam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$PoleRubrik[id][$i]."\" class=\"tlacitko\" /></span> 
  <br /></td></tr>";
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$PoleRubrik[id][$i]."\"> </a>";
$adresafotky=$this->adresarfotek.$PoleRubrik[id][$i].'.jpg';
if( (file_exists ($adresafotky)))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
echo"<table>"; 
 echo"<tr><td> jméno : </td><td>".$PoleRubrik[jmeno][$i]." </td></tr>  ";
 echo"<tr><td> pøíjmení: </td><td>".$PoleRubrik[prijmeni][$i]. " </td></tr>  ";
 echo"<tr><td>titul: </td><td>" .$PoleRubrik[titul][$i]."</td></tr>";
 echo"<tr><td>email:</td><td>  ".$PoleRubrik[email][$i]."  </td></tr>";
  echo"<tr><td>telefon:</td><td> ".$PoleRubrik[telefon][$i]."  </td></tr>";
   echo"<tr><td> kategorie: </td><td>".$PoleRubrik[kategorie][$i]."</td></tr>";
   echo"<tr><td> aprobace <br />(pracovní zaøazení) : </td><td>".$PoleRubrik[aprobace][$i]."</td></tr>";
  echo" <tr><td>funkce zamìstnance: </td><td>".$PoleRubrik[funkce][$i]."</td></tr>";
  echo" <tr><td>poznámka: </td><td>".$PoleRubrik[poznamka][$i]."</td></tr>";     
 echo"  </table>";
  

  echo"</td></tr> <tr><td> 
 
  </td></tr></table>
  
  </div>";
  
echo"<br />";
                                              }
                         }// kifu    
                         
           else  {//k else            
 for ($i=0;$i<count($PoleRubrik[id]);$i++) {
 echo"<div class=\"centrovano\">    
    <table  class=\"novinka\" width=\"80%\">
 <tr class=\"nadpisv-n-c \" ><td>
 <br />
<span class=\"obrvlevo\"> oznaèit pro následné vymazání:<input type=\"checkbox\"  name=\"smaz[]\" value=\"".$PoleRubrik[id][$i]."\" /></span>
<span class=\"obrvpravo\">  editovat záznam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$PoleRubrik[id][$i]."\" class=\"tlacitko\" /></span>
 </td></tr>";
 
 
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$PoleRubrik[id][$i]."\"> </a>";
$adresafotky=$this->adresarfotek.$PoleRubrik[id][$i].'.jpg';
if( (file_exists ($adresafotky)))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
echo"<table>"; 
 echo"<tr><td> jméno : </td><td>".$PoleRubrik[jmeno][$i]." </td></tr>  ";
 echo"<tr><td> pøíjmení: </td><td>".$PoleRubrik[prijmeni][$i]. " </td></tr>  ";
 echo"<tr><td>titul: </td><td>" .$PoleRubrik[titul][$i]."</td></tr>";
 echo"<tr><td>email:</td><td>  ".$PoleRubrik[email][$i]."  </td></tr>";
  echo"<tr><td>telefon:</td><td> ".$PoleRubrik[telefon][$i]."  </td></tr>";
   echo"<tr><td>kategorie: </td><td>".$PoleRubrik[kategorie][$i]."</td></tr>";
   echo"<tr><td> aprobace<br />(pracovní zaøazení): </td><td>".$PoleRubrik[aprobace][$i]."</td></tr>";
  echo" <tr><td>funkce zamìstnance: </td><td>".$PoleRubrik[funkce][$i]."</td></tr>"; 
  echo" <tr><td>poznámka: </td><td>".$PoleRubrik[poznamka][$i]."</td></tr>";     
 echo"  </table>";

  echo"</td></tr> <tr><td> 
  
  </td></tr></table>
 
  </div>";
 echo"<br />"; 

                                              }                                           
                  } // k else   
                  
        }//k zobraz vše
 echo" </div>" ; // skrolovatko                                                
 echo"<hr />";                                        
echo" <table width=\"100%\" border=\"0\">  
   <tr><td>
     <div class=\"chyba\">Oznaèit všechny záznamy v celé rubrice pro vymazání?  <input type=\"submit\"  value=\"ano\" name=\"oznvse\" class=\"tlacitko\" />  <input type=\"submit\"  value=\"odznaèit\" name=\"oznvse\" class=\"tlacitko\" /></div>
";

echo"<input type=\"hidden\" name=\"akce\" value=\"editace_stranky\" />";
echo" <span >Trvale odstranit oznaèené záznamy <input type=\"submit\"  value=\"smazat\" name=\"editakce\" class=\"tlacitko\" /></span>
    </td></tr> </table>
</form>  
                                              
     ";

}
/*----------------------------------------------------------------------------*/

/*---------------------------Popis metody Adminzaznamudotaz()-------------------

Metoda Adminzaznamudotaz($f_id,$fzpracovani='administrace.php')
generuje formuláø pro update údajù ve vybraném záznamu. 
Formátování do tabulky.
První sloupec : názvy sloupcù z tabulky MySQL databáze.
Typy jednotlivých vstupních polí:
nadpis, autor,email: input type="text" 
text:               textarea
neurèená : negeneruje nic, je nutno doplnit    case 'další údaj': vstupni pole  
                                                     break;
Pøi odeslání formuláøe je odesílán parametr odeslano=true 
parametr $fzpracovani urèuje zpracovatelský skript.
 
Rozšíøení:
umožní update foto  .
Pozn. fotka již není povinná.                                               
------------------------------------------------------------------------------*/
 
function Adminzaznamudotaz($f_id,$fzpracovani='administrace.php')
{ 
global $akce,$codelat,$editzaznam ;
$PoleZaznamu=CRubrika::VyberPolozku($f_id); 
echo" Zázanm è.:$PoleZaznamu[id] Datum provedení zázanmu: $PoleZaznamu[datum]
 <br />";
$adresafotky=$this->adresarfotek.$PoleZaznamu[id].'.jpg';
echo"
 <div class=\"centrovano\">
<form enctype=\"multipart/form-data\" action=\"$fzpracovani\" method=\"post\">";
if( file_exists ($adresafotky))
                echo "<div  class=\"centrovano\"><img src=\"$adresafotky\"   alt=\"náhled_foto\" ><br />
                  Pøiložené foto.
                  </div> ";
      else echo"<div  class=\"centrovano\"> Foto není pøiloženo.
               </div>";

echo"
<table border=\"1\"  class=\"centrovano\" >

    "; 
  for ($i=0;$i<$this->pocetsloupcu ;$i++ ) {
  //$chyba[$i]='*';  
  //$nazevsloupce=$this->sloupec[$i];
   // $hodnotavtabulce=$PoleZaznamu[ $nazevsloupce];
    
  switch ($this->sloupec[$i]) {
 
   case 'jmeno':
  echo"<tr><td>"; echo" jméno:</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
  case 'prijmeni':
  echo"<tr><td>"; echo"pøíjmení:</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
  
         	break;
   case 'titul': 
   echo"<tr><td>";echo $this->sloupec[$i]; echo":</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
            case 'kategorie': 
            echo"<tr><td>";
           echo $this->sloupec[$i];echo":</td>";
           echo"<td class=\"chyba\"> <select name=\"".$this->sloupec[$i]."\" size=\"1\">";
if ($PoleZaznamu[$this->sloupec[$i]]=='uèitelé') {echo"<option value=\"uèitelé\" selected=\"selected\">uèitelé</option>";} 
                       else {echo"<option value=\"uèitelé\">uèitelé</option>";}
	
if ($PoleZaznamu[$this->sloupec[$i]]=='thp pracovníci') {echo"<option value=\"thp pracovníci\" selected=\"selected\">thp pracovníci</option>";} 
                       else {echo"<option value=\"thp pracovníci\">thp pracovník</option>";} 
if ($PoleZaznamu[$this->sloupec[$i]]=='správní zamìstnanci') {echo"<option value=\"správní zamìstnanci\" selected=\"selected\">správní zamìstnanci</option>";} 
                      else {echo"<option value=\"správní zamìstnanci\">správní zamìstnanci</option>";}                             
if ($PoleZaznamu[$this->sloupec[$i]]=='hala') {echo"<option value=\"hala\" selected=\"selected\">hala</option>";} 
                       else{echo"<option value=\"hala\">hala</option>";}                        
if ($PoleZaznamu[$this->sloupec[$i]]=='jídelna') {echo"<option value=\"jídelna\" selected=\"selected\">jídelna</option>";} 
                       else {echo"<option value=\"jídelna\">jídelna</option>";}  

echo"
 </select>".$this->chyba[$i]."</td></tr>
               ";
            
            
            
     
         	break; 
         	
         	 case 'aprobace': 
      echo"<tr><td>";echo $this->sloupec[$i]; echo"<br />(pracovní zaøazení):</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" />".$this->chyba[$i]."
 <a href=\"help_aprobace.htm\" onclick=\" window.open('help_aprobace.htm','_blank', 'width=200,height=450,menubar=no,scrollbars=yes,resizable=yes,left=0,top=0');return false\"> 
       <img src=\"../obr/help.gif\" alt=\"Dokumentace\" title=\"Dokumentace\" width=\"14\" height=\"14\"  /></a>         
        
        </td></tr>
            ";
         	break;
    case 'email': 
      echo"<tr><td>";echo $this->sloupec[$i]; echo":</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
         	 case 'telefon': 
      echo"<tr><td>";echo $this->sloupec[$i]; echo":</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
         	  	 case 'funkce': 
         	  	  echo"<tr><td>"; echo"funkce zamìstnance:</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" />".$this->chyba[$i]."
   <a href=\"help_funkce.htm\" onclick=\" window.open('help_funkce.htm','_blank', 'width=200,height=450,menubar=no,scrollbars=yes,resizable=yes,left=0,top=0');return false\"> 
       <img src=\"../obr/help.gif\" alt=\"Dokumentace\" title=\"Dokumentace\" width=\"14\" height=\"14\"  /></a>       
        </td></tr>
            ";
         	  	 break;
         	  /*	  case 'funkceaj': 
      echo"<tr><td>"; echo"název funkce v AJ:</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;*/
         	 case 'poznamka':
   
         echo"<tr><td>"; echo"poznámka:</td>";
        echo"
       <td class=\"chyba\">
        <textarea  rows=\"5\" name=\"".$this->sloupec[$i]."\" cols=\"40\">".$PoleZaznamu[$this->sloupec[$i]]."</textarea>".$this->chyba[$i]."</td></tr>
            ";
         	break;   
  
  
  
 
    
              
  default:
  	/* neprovádí se nic*/
  	break;
  }

}  




if($this->pocetobr()<150) {echo"<tr><td colspan=\"2\"  class=\"centrovano\" > Mùžete pøidat foto uživatele, 
max. 50kB,formát *.jpg,doporuèené  rozmìry 120x150px <br />
   <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"50000\" /> 
  Vyberte obrázek v poèítaèi:<input name=\"soubor\" type=\"file\"  accept=\"image/*\" />
  <span class=\"chyba\">     $this->chybafotky  </span>  </td></tr> 
                     ";  
                      if ($this->Upravafoto) {
              echo"<tr><td colspan=\"2\"  class=\"centrovano\" >
              upravit rozmìry, 
šíøka: <select name=\"sirka\" size=\"1\">   
<option value=\"120\">120</option>
<option value=\"150\">150</option>
<option value=\"100\">100</option> 
 </select> px ,  
 výška: <select name=\"vyska\" size=\"1\">

<option value=\"150\">150</option>
<option value=\"120\">120</option>
<option value=\"100\">100</option>
</select>  px 
              </td></tr> ";
 	
                     }  
                     
                      }
         else echo"<tr><td colspan=\"2\"  class=\"centrovano\" > Poèet obrázkù v adresáøi je vìtší než 150 . Kapacita vyèerpána.Smažte starší zázanmy s obrázky.</td></tr> ";


	          


 echo"  
 
 
 <tr><td colspan=\"2\"  class=\"centrovano\" >                
<input type=\"hidden\" name=\"odeslano\" value=\"true\" />
<br />
<input type=\"submit\"  value=\"odeslat\" name=\"dotaznik\" class=\"tlacitko\" />
<input type=\"hidden\" name=\"codelat\" value=\"uložit\" />
<input type=\"hidden\" name=\"akce\" value=\"editace_stranky\" />
<input type=\"hidden\" name=\"editzaznam\" value=\"editovat_záznam\" />
<input type=\"hidden\" name=\"kohoeditovat\" value=\"$f_id\" />

<hr />
 <input type=\"reset\" value=\"smazat neodeslané údaje\" class=\"tlacitko\" />
  </td></tr>
</table>
</form>
 </div> <!--     centrováno    -->
   ";
 }




/*----------------------------------------------------------------------------*/


/*---------------------------Popis metody VyberSeznamNovinek()-----------------

Metoda VyberSeznamNovinek() vrací pole id, datum, nadpis novinek
------------------------------------------------------------------------------*/
 function VyberSeznamUzivatelu()
 {        
         
         @$vsechnyzazanamy=MySQL_Query("Select id,jmeno,prijmeni,titul FROM $this->Nazev  ORDER BY prijmeni ; ")OR DIE(MySQL_Error()) ; 
         while ($zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC)) {
          foreach($zaznam as $k => $v) {
         
               $ven[$k][]=$v;
         	
                         
                                       }
         
         
         
            
         
                                                                     }

            
                                                                     
return ($ven);
 } 
 
/*---------------------------Popis metody Formular_hledej()-----------------------

                                            
------------------------------------------------------------------------------*/
function Formular_hledej($fzpracovani='gympl_ucitele.php',$fsloupec)
{ 
switch ($fsloupec) {
case 'cisloop': $ceskyfloupec='èíslo op';
	break;
case 'prijmeni': $ceskyfloupec='pøíjmení';
	break;	
default:
	$ceskyfloupec='-';
	
	break;
}
echo"
  <div class=\"centrovano\">
<form enctype=\"multipart/form-data\" action=\"$fzpracovani\" method=\"post\" name=\"f\">
<table border=\"0\"  class=\"centrovano\" >
    "; 
 echo"<tr>";
 if ($fsloupec=='cisloop') {
 	echo"<td ><input type=\"text\" size=\"10\" maxlength=\"10\" name=\"".$fsloupec."\"  /></td>
            ";    
                          }
           else echo"<td >
<input onclick=\"document.f.".$fsloupec.".value = ''\" onkeypress=testznak(this) onkeyup=\"testznak(this); FiltrujKontakty(this)\" type=\"text\" size=\"10\" name=\"".$fsloupec."\" value=\"".$ceskyfloupec."\"  /></td>
            ";                    
        


 echo"  
 
 
 <td   class=\"centrovano\"  >                

  <input type=\"hidden\" name=\"sloup\" value=\"$fsloupec\" />
  <!--
<input type=\"hidden\" name=\"akcehledat\" value=\"filtrovat\" />
-->
<input     type=\"image\" src=\"../obr/1.gif\" align=\"middle\" value=\"vyhledat\" name=\"hledani\">
 <input type=\"hidden\" value=\"vyhledat\" name=\"hledani\"  />  

  </td></tr>
</table>
</form>
 </div> <!--     centrováno    -->
   ";
 }
/*----------------------------------------------------------------------------*/
 
 
       
 function Vypis_seznam_tel()
{  
 @$vsechnyzazanamy=MySQL_Query("SELECT gympl_telefony.mistnost AS fmistnost , gympl_telefony.telcislo AS fcislo , gympl_ucitele.jmeno AS fjmeno , gympl_ucitele.prijmeni AS fprijmeni , gympl_ucitele.titul AS ftitul FROM gympl_telefony LEFT OUTER JOIN gympl_ucitele ON gympl_telefony.telcislo = gympl_ucitele.telefon  ORDER BY gympl_telefony.poradi; ")OR DIE(MySQL_Error()) ;
       
         while ($zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC)) {
         foreach($zaznam as $k => $v) {

               $ven[$k][]=$v;
         	
                         
                                       }
            
                                                                       }
return ($ven);
 }      



function Formatuj_tel_seznam()
{ // BEGIN function Formatuj_tel_seznam
$vseradky= $this->Vypis_seznam_tel();
echo" <div class=\"centrovano\">
      <h4 > Telefonní linky</h4>
  
 <br />  

<table class=\"tabklasik\" cellspacing=0>
    <col class=\"prvni-sloupec\">
    <col class=\"druhy-sloupec\">
    <col class=\"treti-sloupec\">
<tr align=\"left\" ><td class=\"hlavicka\">Místnost</td><td class=\"hlavicka\">Èíslo</td><td class=\"hlavicka\"> Jméno";
 for ($i=0;$i<count($vseradky[fcislo]) ;$i++) {
/* echo"$i".$vseradky[fmistnost][$i].' '.$vseradky[fcislo][$i].' '.$vseradky[fprijmeni][$i].' '.$vseradky[fjmeno][$i].' '.$vseradky[ftitul][$i].'<br />';*/
if ($i==0||$vseradky[fcislo][$i]!=$vseradky[fcislo][$i-1]) {
echo'</td></tr><tr ><td>'.$vseradky[fmistnost][$i].'</td><td > '.$vseradky[fcislo][$i].'</td><td > '.$vseradky[ftitul][$i]." ".$vseradky[fjmeno][$i]." ".$vseradky[fprijmeni][$i];	
}
 else echo', '.$vseradky[ftitul][$i]." ".$vseradky[fjmeno][$i]." ".$vseradky[fprijmeni][$i];	
}
echo"</td></tr></table></div>";
} 

	
} // END class CNovinkyRubrika


  


?>

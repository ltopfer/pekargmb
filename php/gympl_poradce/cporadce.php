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
Tabulka V databázi MySQL: id, datum,kategorie,text
chybafotky...chybové hlášení fotky
Upravafoto... boolean identifikuje zda bude odesilané foto opraveno(rozmmìry)
adresarfotek...specifikuje adresáø pro ukládání fotek
adresarnahledu...specifikuje adresáø pro ukládání náhledù fotek
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

function Formular_obec($fsloupec,$fcopridat='novinku',$fzpracovani='administrace.php')
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
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$fsloupec[$i]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
  case 'autor':
  echo"<tr><td>";echo $this->sloupec[$i]; echo":</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".'Mgr. Dana Patoèková'."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
 
  case 'email': 
      echo"<tr><td>";echo $this->sloupec[$i]; echo":</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".'patockova@pekargmb.cz'."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
           
   case 'text':
   
         echo"<tr><td>";echo $this->sloupec[$i]; echo":</td>";
        echo"
       <td class=\"chyba\">
        <textarea  rows=\"20\" name=\"".$this->sloupec[$i]."\" cols=\"50\">".$fsloupec[$i]."</textarea>".$this->chyba[$i]."</td></tr>
            ";
         	break; 
case 'vlastnik':
  echo"<tr class=\"nadpisv-n-c\"><td>"; echo"Vlastník záznamu:</td>";
        echo"<td>".      
        $_SERVER["PHP_AUTH_USER"]."
        <input type=\"hidden\"  name=\"".'vlastnik'."\" value=\"".$_SERVER["PHP_AUTH_USER"]."\" />          
        
        </td></tr>
            ";
         	break;                         
              
  default:
  	/*echo $this->sloupec[$i];
        echo":::<INPUT TYPE=\"TEXT\" SIZE=\"45\" NAME=\"".$this->sloupec[$i]."\" VALUE=\"".$fsloupec[$i]."\" ><br />
            ";*/
  	break;
  }

}  


if($this->pocetobr()<50) {echo"<tr><td colspan=\"2\"  class=\"centrovano\" > Mùžete pøidat k textu obrázek, 
max. 50kB,formát *.jpg,doporuèené  rozmìry 300x200px <br />
nebo soubor *.pdf,  max. 50kB  <br />
   <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"50000000\" /> 
  Vyberte obrázek(soubor) v poèítaèi:<input name=\"soubor\" type=\"file\"  accept=\"image/* ,application/pdf \" />
  <span class=\"chyba\">     $this->chybafotky  </span>  </td></tr> 
                     ";
                      if ($this->Upravafoto) {
              echo"<tr><td colspan=\"2\"  class=\"centrovano\" >
              upravit rozmìry, 
šíøka: <select name=\"sirka\" size=\"1\">   
<option value=\"0\">neupravovat</option>
<option value=\"450\">450</option>
<option value=\"400\">400</option>
<option value=\"350\">350</option>
<option value=\"300\">300</option>
<option value=\"250\">250</option>
<option value=\"200\">200</option>
<option value=\"150\">150</option>
<option value=\"100\">100</option> 
 </select> px ,  
 výška: <select name=\"vyska\" size=\"1\">
<option value=\"0\">neupravovat</option>  
<option value=\"400\">400</option>
<option value=\"350\">350</option>
<option value=\"300\">300</option>
<option value=\"250\">250</option>
<option value=\"200\">200</option>
<option value=\"150\">150</option>
<option value=\"100\">100</option> 
</select>  px 
              </td></tr> ";
 	
                     }  
                     
                        }
         else echo"<tr><td colspan=\"2\"  class=\"centrovano\" > Poèet obrázkù v adresáøi je vìtší než 50 . Kapacita vyèerpána.Smažte starší zázanmy s obrázky.</td></tr> ";


	          


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





/*---------------------------Popis metody Formular_kontrola($kontrpole)---------

Metoda Formular_kontrola($kontrpole) kontroluje, zda $kontrpole , které jsou
oznaèeny jako povinné tj. '*'neobsahuje prázné položky a zda zadané položky 
odpovídají pøedem stanoveným požadavkùm, napø. položka mail.

Rozšíøení:kontroluje, zda odesílaný soubor má formát  $_FILES['soubor']['type'],
$_FILES['soubor']['size']  jpg a zda nepøekroèil velikost limit=50 kB
------------------------------------------------------------------------------*/
function Formular_kontrola($kontrpole,$limit=50000000)
{
$kontrolatextu=CRubrika::Formular_kontrola($kontrpole);
/*application/pdf*/
if($_FILES['soubor']['name']!="") { 
$nahrani=true;
 if ($_FILES['soubor']['size']>$limit) {$nahrani=false;$this->chybafotky="nesplnìny vstupní podmínky";}
if (  $_FILES['soubor']['type']!="image/pjpeg" && $_FILES['soubor']['type']!="image/jpeg" && $_FILES['soubor']['type']!="image/jpg" && $_FILES['soubor']['type']!="application/pdf") {$nahrani=false;$this->chybafotky="nesplnìny vstupní podmínky";}
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
function Pridej_do_Rubriky($fpole,$fsirka=0,$fvyska=0)
{ 
$poradovecislo=CRubrika::Pridej_do_Rubriky($fpole);
if($_FILES['soubor']['name']!=""){
$cislofotky=$poradovecislo;
$nazev = $_FILES['soubor']['type']=="application/pdf" ? $cislofotky.'.pdf' : $cislofotky.'.jpg' ;
$uploadDir = $this->adresarfotek;$uploadFile = $uploadDir.$nazev;  
	if (move_uploaded_file($_FILES['soubor']['tmp_name'], $uploadFile)){$vysledek =$uploadFile;
  $rozmery = getimagesize($uploadFile);
  
  if ($rozmery[0]>400) {
  
  $this->image_resize($uploadFile,$uploadFile,400,0);	
  } 
  }
   else $vysledek =false;
if($vysledek==$uploadFile && $this->Upravafoto && ($fvyska!=0||$fsirka!=0)&& $_FILES['soubor']['type']!="application/pdf" ) $this->image_resize($uploadFile,$uploadFile,$fsirka,$fvyska); 
 
           }
return $vysledek ;
}



/*---------------------------Popis metody Update_v_Rubrice($f_id,$f_updatepole)-

Metoda mìní obsah položky z rubriky a vrací èíslo této položky

Rozšíøení:
Umožòuje zmìnu fotky 
------------------------------------------------------------------------------*/
function Update_v_Rubrice($f_id,$f_updatepole,$fsirka=0,$fvyska=0)
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
 
	if (move_uploaded_file($_FILES['soubor']['tmp_name'], $uploadFile))
  {$vysledek =$uploadFile;
  $rozmery = getimagesize($uploadFile);
  if ($rozmery[0]>400) {
  $this->image_resize($uploadFile,$uploadFile,400,0);	
  }
  }
   else $vysledek =false;
if($vysledek==$uploadFile && $this->Upravafoto && ($fvyska!=0||$fsirka!=0)&& $_FILES['soubor']['type']!="application/pdf" ) $this->image_resize($uploadFile,$uploadFile,$fsirka,$fvyska); 
 
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
function 	FormatujObashRubriky($f_id)
{


if($f_id!=""){  //zobraz novinku nahore
$VybranaNovinka=CRubrika::VyberPolozku($f_id);

echo"<div class=\"centrovano\">    
    <table  class=\"novinka\" width=\"100%\">
 <tr class=\"nadpisv-n-c \" ><td><a href=\"?zobr= \" > <img src=\"../obr/zavri.gif\" alt=\"zavri.gif, 767B\" title=\"zavøít\" border=\"0\" height=\"20\" width=\"20\" class=\"obrvpravobezokraje\"> </a>".$VybranaNovinka[nadpis]."</td></tr>";
echo"<tr><td class=\"textv-n-c \"> <a name=\"".$VybranaNovinka[id]."\"> </a>";
$adresafotky=$this->adresarfotek.$VybranaNovinka[id].'.jpg';
$adresapdefka=$this->adresarfotek.$VybranaNovinka[id].'.pdf';
if (file_exists ($adresafotky))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";  
 echo NL2BR($VybranaNovinka[text]);
if (file_exists ($adresapdefka))echo"
                                 <hr />
<a href=\"$adresapdefka\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 Pøíloha *.pdf
 </a>                                ";  
    echo"</td></tr> <tr><td> <div  class=\"den-autor\" >Autor:&nbsp;".$VybranaNovinka[autor].", email:&nbsp;<a href=\"mailto:$VybranaNovinka[email]\"  >".$VybranaNovinka[email]." </a>Datum:".$VybranaNovinka[datum]."</div>
  <a href=\"tisk.php?id=".$VybranaNovinka[id]."\"   class=\" tiskzpravy\" 
 onclick=\"return !window.open(this.href)\">Tisk zprávy</a>  
  </td></tr></table>
  </div>";
  echo"<br />";  

                    } //zobraz novinku nahore
else               {  //zobraz vse
$PoleRubrik=CRubrika::FormatujObashRubriky();              
for ($i=0;$i<$this->get_pocet_zaznamu();$i++) {
 echo"<div class=\"centrovano\">    
    <table  class=\"novinka\" width=\"100%\">
 <tr class=\"nadpisv-n-c \" ><td>".$PoleRubrik[nadpis][$i]."</td></tr>";
echo"<tr><td class=\"textv-n-c \"> <a name=\"".$PoleRubrik[id][$i]."\"> </a>";
$adresafotky=$this->adresarfotek.$PoleRubrik[id][$i].'.jpg';
$adresapdefka=$this->adresarfotek.$PoleRubrik[id][$i].'.pdf';
if( (file_exists ($adresafotky))&&($i%2==0))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
if( (file_exists ($adresafotky))&&($i%2!=0))echo"<img src=\"$adresafotky\" class=\"obrvpravo\" alt=\"foto\" />";
  
 echo NL2BR($PoleRubrik[text][$i]); 
 if (file_exists ($adresapdefka))echo" <hr />
<a href=\"$adresapdefka\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 Pøíloha *.pdf
 </a>             "; 
    echo"</td></tr> <tr><td> <div  class=\"den-autor\" >Autor:&nbsp;".$PoleRubrik[autor][$i].", email:&nbsp;".$PoleRubrik[email][$i]." Datum:".$PoleRubrik[datum][$i]."</div>
  <a href=\"tisk.php?id=".$PoleRubrik[id][$i]."\"   class=\" tiskzpravy\" 
 onclick=\"return !window.open(this.href)\">Tisk zprávy</a>  
  </td></tr></table>
  </div>";
  echo"<br />"; 
                                             }
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
<span class=\"obrvlevo\"> oznaèit pro následné vymazání:<input type=\"checkbox\" checked=\"checked\" name=\"smaz[]\" value=\"".$VybranaNovinka[id]."\" /></span>
<span class=\"obrvpravo\">  editovat záznam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$VybranaNovinka[id]."\" class=\"tlacitko\" /></span> 
 </td></tr>";
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$VybranaNovinka[id]."\"> </a>";
$adresafotky=$this->adresarfotek.$VybranaNovinka[id].'.jpg';
$adresapdefka=$this->adresarfotek.$VybranaNovinka[id].'.pdf';
if (file_exists ($adresafotky))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";  
 echo NL2BR($VybranaNovinka[text]);
 if (file_exists ($adresapdefka))echo"
                                 <hr />
<a href=\"$adresapdefka\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 Pøíloha *.pdf
 </a>                                ";   
  echo"</td></tr> <tr><td>Vlastník :".$VybranaNovinka[vlastnik]."  <div  class=\"den_autor\" >Autor:".$VybranaNovinka[autor]."email:<a href=\"mailto:$VybranaNovinka[email]\" > ".$VybranaNovinka[email]." </a> Datum:".$VybranaNovinka[datum]."</div>
  <a href=\"tisk.php?id=".$VybranaNovinka[id]."\"   class=\" tiskzpravy\" 
 onclick=\"return !window.open(this.href)\">Tisk zprávy</a>  
  </td></tr></table>
  
  </div>";
  
echo"<br />";
                                             
                         }// kifu   
                         
else  {
echo"<div class=\"centrovano\">    
    <table  class=\"novinka\" width=\"80%\">
 <tr class=\"nadpisv-n-c \" ><td>".$VybranaNovinka[nadpis]."
  <hr />
<span class=\"obrvlevo\"> oznaèit pro následné vymazání:<input type=\"checkbox\" name=\"smaz[]\" value=\"".$VybranaNovinka[id]."\" /></span>
<span class=\"obrvpravo\">  editovat záznam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$VybranaNovinka[id]."\" class=\"tlacitko\" /></span> 
 </td></tr>";
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$VybranaNovinka[id]."\"> </a>";
$adresafotky=$this->adresarfotek.$VybranaNovinka[id].'.jpg';
$adresapdefka=$this->adresarfotek.$VybranaNovinka[id].'.pdf';
if (file_exists ($adresafotky))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";  
 echo NL2BR($VybranaNovinka[text]);
 if (file_exists ($adresapdefka))echo"
                                 <hr />
<a href=\"$adresapdefka\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 Pøíloha *.pdf
 </a>                                ";   
  echo"</td></tr> <tr><td>Vlastník :".$VybranaNovinka[vlastnik]." <div  class=\"den_autor\" >Autor:".$VybranaNovinka[autor]." email:<a href=\"mailto:$VybranaNovinka[email]\" > ".$VybranaNovinka[email]." </a> Datum:".$VybranaNovinka[datum]."</div>
  <a href=\"tisk.php?id=".$VybranaNovinka[id]."\"   class=\" tiskzpravy\" 
 onclick=\"return !window.open(this.href)\">Tisk zprávy</a>  
  </td></tr></table>
  
  </div>";
  
echo"<br />";


        }                          




               } //zobraz novinku nahore

else { //k zobraz vše
$PoleRubrik=CRubrika::FormatujObashRubriky($f_sloupec,$f_kriterium, $f_tridit_podle,$f_vlastnik);
//echo" poèet záznamù:".$this->get_pocet_zaznamu()." <br />"; 

         

if($oznvse=='ano') {// k ifu     
for ($i=0;$i<count($PoleRubrik[id]) ;$i++) {
 echo"<div class=\"centrovano\">    
    <table  class=\"novinka\" width=\"80%\">
 <tr class=\"nadpisv-n-c \" ><td>".$PoleRubrik[nadpis][$i]."
  <br />
<span class=\"obrvlevo\"> oznaèit pro následné vymazání:<input type=\"checkbox\" checked=\"checked\" name=\"smaz[]\" value=\"".$PoleRubrik[id][$i]."\" /></span>
<span class=\"obrvpravo\">  editovat záznam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$PoleRubrik[id][$i]."\" class=\"tlacitko\" /></span> 
 </td></tr>";
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$PoleRubrik[id][$i]."\"> </a>";
$adresafotky=$this->adresarfotek.$PoleRubrik[id][$i].'.jpg';
$adresapdefka=$this->adresarfotek.$PoleRubrik[id][$i].'.pdf';
if( (file_exists ($adresafotky))&&($i%2==0))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
if( (file_exists ($adresafotky))&&($i%2!=0))echo"<img src=\"$adresafotky\" class=\"obrvpravo\" alt=\"foto\" />";
  
 echo NL2BR($PoleRubrik[text][$i]); 
 if (file_exists ($adresapdefka))echo" <hr />
<a href=\"$adresapdefka\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 Pøíloha *.pdf
 </a>             "; 
  echo"</td></tr> <tr><td>Vlastník :".$PoleRubrik[vlastnik][$i]."  <div  class=\"den_autor\" >Autor:".$PoleRubrik[autor][$i]." email:".$PoleRubrik[email][$i]." Datum:".$PoleRubrik[datum][$i]."</div>
  <a href=\"tisk.php?id=".$PoleRubrik[id][$i]."\"   class=\" tiskzpravy\" 
 onclick=\"return !window.open(this.href)\">Tisk zprávy</a>  
  </td></tr></table>
  
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
<span class=\"obrvlevo\"> oznaèit pro následné vymazání:<input type=\"checkbox\"  name=\"smaz[]\" value=\"".$PoleRubrik[id][$i]."\" /></span>
<span class=\"obrvpravo\">  editovat záznam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$PoleRubrik[id][$i]."\" class=\"tlacitko\" /></span>
 </td></tr>";
 
 
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$PoleRubrik[id][$i]."\"> </a>";
$adresafotky=$this->adresarfotek.$PoleRubrik[id][$i].'.jpg';
$adresapdefka=$this->adresarfotek.$PoleRubrik[id][$i].'.pdf';
if( (file_exists ($adresafotky))&&($i%2==0))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
if( (file_exists ($adresafotky))&&($i%2!=0))echo"<img src=\"$adresafotky\" class=\"obrvpravo\" alt=\"foto\" />";
  
 echo NL2BR($PoleRubrik[text][$i]);
 if (file_exists ($adresapdefka))echo" <hr />
<a href=\"$adresapdefka\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 Pøíloha *.pdf
 </a>             ";  
  echo"</td></tr> <tr><td>Vlastník :".$PoleRubrik[vlastnik][$i]." <div  class=\"den_autor\" >Autor:".$PoleRubrik[autor][$i]." email:".$PoleRubrik[email][$i]." Datum:".$PoleRubrik[datum][$i]."</div>
  <a href=\"tisk.php?id=".$PoleRubrik[id][$i]."\"   class=\" tiskzpravy\" 
 onclick=\"return !window.open(this.href)\">Tisk zprávy</a>  
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
     <div class=\"chyba\" >Oznaèit VŠECHNY VAŠE záznamy  pro vymazání?  <input type=\"submit\"  value=\"ano\" name=\"oznvse\" class=\"tlacitko\" />  <input type=\"submit\"  value=\"odznaèit\" name=\"oznvse\" class=\"tlacitko\" />  </div>
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
global $akce,$codelat,$editzaznam,$superadmin  ;
$vlastnici= $this->VyberVlastniky();
$PoleZaznamu=CRubrika::VyberPolozku($f_id); 
echo" Zázanm è.:$PoleZaznamu[id] Datum zázanmu: $PoleZaznamu[datum]<br />";
$adresafotky=$this->adresarfotek.$PoleZaznamu[id].'.jpg';
$adresapdefka=$this->adresarfotek.$PoleZaznamu[id].'.pdf';
echo"
 <div class=\"centrovano\">
<form enctype=\"multipart/form-data\" action=\"$fzpracovani\" method=\"post\">";
if( file_exists ($adresafotky))
                echo "<div  class=\"centrovano\"><img src=\"$adresafotky\"   alt=\"náhled_foto\" ><br />
                  Pøiložené foto.
                  </div> ";
      else echo"<div  class=\"centrovano\"> Foto není pøiloženo.
               </div>";
               
if (file_exists ($adresapdefka))echo" <div  class=\"centrovano\">
<a href=\"$adresapdefka\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 Pøíloha *.pdf
 </a>   </div> ";
  else echo"<div  class=\"centrovano\"> Pøíloha *.pdf nebyla pøiložena.
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
  case 'autor':  
  case 'email': 
      echo"<tr><td>";echo $this->sloupec[$i]; echo":</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
           
   case 'text':
   
         echo"<tr><td>";echo $this->sloupec[$i]; echo":</td>";
        echo"
       <td class=\"chyba\">
        <textarea  rows=\"20\" name=\"".$this->sloupec[$i]."\" cols=\"50\">".$PoleZaznamu[$this->sloupec[$i]]."</textarea>".$this->chyba[$i]."</td></tr>
            ";
         	break;  
case 'vlastnik':
if($superadmin==true){
 echo"<tr><td>"; echo"mùžete zmìnit vlastníka</td>";
        echo"<td class=\"chyba\">";
         echo"<select name=\"".$this->sloupec[$i]."\" size\"2\">";
                 for ($j=0;$j<count($vlastnici) ;$j++ ) { 
$vypis = $PoleZaznamu[vlastnik]==$vlastnici[$j] ? "<option value=\"$vlastnici[$j]\" selected=\"selected\">$vlastnici[$j]</option>" :  "<option value=\"$vlastnici[$j]\">$vlastnici[$j]</option>";
                 
        echo $vypis ;
                                                             }
                                                     
        echo "</select> seznam vlastníkù" .$this->chyba[$i]."
<a href=\"help_vlastnik.htm\" onclick=\" window.open('help_vlastnik.htm','_blank', 'width=200,height=450,menubar=no,scrollbars=yes,resizable=yes,left=0,top=0');return false\"> 
       <img src=\"../obr/help.gif\" alt=\"Dokumentace\" title=\"Dokumentace\" width=\"14\" height=\"14\"  /></a>            
        
        
        </td></tr>
            ";
 
                }

 else {
  echo"<tr class=\"nadpisv-n-c\"><td>"; echo"Vlastník záznamu:</td>";
        echo"<td>".      
        $_SERVER["PHP_AUTH_USER"]."
        <input type=\"hidden\"  name=\"".'vlastnik'."\" value=\"".$_SERVER["PHP_AUTH_USER"]."\" />
            
        
        </td></tr>
            ";
        }       
         	break;                      
              
  default:
  	/* neprovádí se nic*/
  	break;
  }

}  




if($this->pocetobr()<50) {echo"<tr><td colspan=\"2\"  class=\"centrovano\" > Mùžete pøidat k textu obrázek, 
max. 50kB,formát *.jpg,doporuèené  rozmìry 300x200px <br />
nebo soubor *.pdf,  max. 50kB  <br />
   <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"50000000\" /> 
  Vyberte obrázek v poèítaèi:<input name=\"soubor\" type=\"file\"  accept=\"image/* ,application/pdf \" />
  <span class=\"chyba\">     $this->chybafotky  </span>  </td></tr> 
                     ";
                     if ($this->Upravafoto) {
              echo"<tr><td colspan=\"2\"  class=\"centrovano\" >
              upravit rozmìry, 
šíøka: <select name=\"sirka\" size=\"1\">   
<option value=\"0\">neupravovat</option>
<option value=\"450\">450</option>
<option value=\"400\">400</option>
<option value=\"350\">350</option>
<option value=\"300\">300</option>
<option value=\"250\">250</option>
<option value=\"200\">200</option>
<option value=\"150\">150</option>
<option value=\"100\">100</option> 
 </select> px ,  
 výška: <select name=\"vyska\" size=\"1\">
<option value=\"0\">neupravovat</option>  
<option value=\"400\">400</option>
<option value=\"350\">350</option>
<option value=\"300\">300</option>
<option value=\"250\">250</option>
<option value=\"200\">200</option>
<option value=\"150\">150</option>
<option value=\"100\">100</option> 
</select>  px 
              </td></tr> ";
 	
                     }  
	          
                       }
         else echo"<tr><td colspan=\"2\"  class=\"centrovano\" > Poèet obrázkù v adresáøi je vìtší než 50 .Jestliže chcete Kapacita vyèerpána.Smažte starší zázanmy s obrázky.</td></tr> ";

 


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
/*---------Formátování pro tisk----------------------*/
 
function Vyber_na_Tisk($f_id)
{ 
$adresafotky=$this->adresarfotek.$f_id.'.jpg';
if( file_exists ($adresafotky))
                echo "<div  class=\"centrovano\"><img src=\"$adresafotky\"   alt=\"náhled_foto\" /><br />
                  Pøiložené foto.
                  </div> ";
      /*else echo"<div  class=\"centrovano\"> Foto není pøiloženo.
               </div>";*/
$vypis_udaju=CRubrika::Vyber_na_Tisk($f_id);               

 }



/*----------------------------------------------------------------------------*/

/*---------------------------Popis metody VyberSeznamNovinek()-----------------

Metoda VyberSeznamNovinek() vrací pole id, datum, nadpis novinek
------------------------------------------------------------------------------*/
 function VyberSeznamNovinek($f_vlastnik='')
 {  
$f_vlastnik=$this->inject_addslashes($f_vlastnik);
  if ($f_vlastnik!='') {
    
          @$vsechnyzazanamy=MySQL_Query("Select id,datum,nadpis FROM $this->Nazev WHERE vlastnik='$f_vlastnik' ORDER BY id DESC ; ")OR DIE(MySQL_Error()) ;    
                         }   
                else   { 
         @$vsechnyzazanamy=MySQL_Query("Select id,datum,nadpis FROM $this->Nazev  ORDER BY id DESC ; ")OR DIE(MySQL_Error()) ; 
                        }
         while ($zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC)) {
          foreach($zaznam as $k => $v) {
         
               $ven[$k][]=$v;
         	
                         
                                       }
         
         
         
            
         
                                                                     }

            
                                                                     
return ($ven);
 }       
/*---------------------------Popis metody VyberVlastniky()-----------------

Metoda VyberVlastniky()vrací pole vlastniku
------------------------------------------------------------------------------*/
 function VyberVlastniky()
 {        
 
         @$vsechnyzazanamy=MySQL_Query("Select DISTINCT vlastnik FROM $this->Nazev  ORDER BY id DESC ; ")OR DIE(MySQL_Error()) ; 
                       
         while ($zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC)) {
         $ven[]=$zaznam[vlastnik];        
         
                                                                     }

            
                                                                     
return ($ven);
 }                
/*---------------------------------------------------------------------------*/ 

/*------Metody pro práci s RSS------------------------------------------------*/


/***********************************************************************
funkce pro vložení záznamu do tabuky gympl_rss a pøi neùspìchu vrací hodnotu -1.


***************************************************************************/
function Pridej_do_Rss($textp,$nadpisp,$autorp,$webadresa,$zdrojp='pekargmb')
{ 
$textp=$this->inject_addslashes($textp);
$nadpisp=$this->inject_addslashes($nadpisp);
$autorp=$this->inject_addslashes($autorp);
$webadresa=$this->inject_addslashes($webadresa);
                            
$mm=MySQL_Query("SELECT Max( ID ) FROM gympl_rss "); 
$maxcislo=mysql_result($mm,0);
//echo"maxcislo:$maxcislo<BR>"; 
$osp=$maxcislo+1; 
$datump=Date(Y.'-'.m.'-'.d);
$urlp=$webadresa.'#'.$osp;
$ukazka=SubStr($textp,0,60);
@$vlozeni=MySQL_Query("INSERT INTO gympl_rss VALUES ($osp,'$nadpisp','$ukazka','$urlp','$zdrojp','$autorp','$datump');" ) OR DIE(MySQL_Error()) ;


if(!$vlozeni) $osp=-1;


 return $osp;

}

/*--------------------------Popis metody Smaz_z_Rss($f_id)--------------

Metoda maže položku z gympl_rss a vrací Požadované èíslo smazání
------------------------------------------------------------------------------*/
function Smaz_z_Rss($f_id)
{  $f_id=$this->inject_addslashes($f_id); 
$f_id=intval($f_id); 

@$mazani=MySQL_Query("DELETE FROM gympl_rss WHERE id=$f_id ;")OR DIE(MySQL_Error()) ;

return ($f_id);
}


/*---------------------------Popis metody Update_v_Rss($f_id,$f_updatepole)-

Metoda mìní obsah položky v tabulce gympl_rssa vrací èíslo této položky
------------------------------------------------------------------------------*/
function Update_v_Rss($f_id,$nadpisap,$popisap,$autorap)
{  
$f_id=$this->inject_addslashes($f_id); 
$f_id=intval($f_id);
$popisap=$this->inject_addslashes($popisap);
$nadpisap=$this->inject_addslashes($nadpisap);
$autorap=$this->inject_addslashes($autorap);

@$upravarss=MySQL_Query("UPDATE  gympl_rss SET  
                                               TITULEK='$nadpisap',
                                               POPISEK='$popisap',                                               
                                              AUTOR='$autorap'
                                      WHERE ID=$f_id ;")OR DIE(MySQL_Error()) ;

return ($f_id);
}

/****************************************
feedrss($formalweb) zapise do xml souboru vèetnì pøipojení k 
MySQL  založena na tøídì feedcreator.class.php
**************************************/
function feedrss($formalweb)
{

include("../news1/feedcreator.class.php"); 
$rss = new UniversalFeedCreator(); 
$rss->useCached(); // pøi aktualizaci pod 1 hodinu se použije cache
$rss->title = "Novinky ze stránek $formalweb"; 
$rss->description = "Zpravodajství z $formalweb "; 

//volitelné
$rss->descriptionTruncSize = 500;
$rss->descriptionHtmlSyndicated = true;

$rss->link = "http://$formalweb/news1/news/feed.xml"; 
$rss->syndicationURL = "http://$formalweb/";
//.$_SERVER["PHP_SELF"]; 

$image = new FeedImage(); 
$image->title = "Logo našich stránek"; 
$image->url = "http://$formalweb/news1/obr/2.gif"; 
$image->link = "http://$formalweb/index.php"; 
$image->description = "Zprávy poskytnuty serverem $formalweb"; 

//volitelné
$image->descriptionTruncSize = 500;
$image->descriptionHtmlSyndicated = true;

$rss->image = $image; 

//naètení novinek z databáze

$res = mysql_query("SELECT * FROM gympl_rss ORDER BY datum DESC"); 
while ($data = mysql_fetch_object($res)) { 
    $item = new FeedItem(); 
    $item->title = $data->TITULEK; 
    $item->link = $data->URL; 
    $item->description = $data->POPISEK; 
    
    //volitelné
    $item->descriptionTruncSize = 500;
    $item->descriptionHtmlSyndicated = false;

    $item->date = $data->DATUM; 
    $item->source = $data->ZDROJ; 
    $item->author = $data->AUTOR; 
     
    $rss->addItem($item); 
} 

// možné formáty jsou: RSS0.91, RSS1.0, RSS2.0, PIE0.1 (zastaralé),
// MBOX, OPML, ATOM, ATOM0.3, HTML, JS
 $rss->saveFeed("RSS2.0", "../news1/news/feed.xml");



}
// konecfunkce pro zápis do xml feedrss()




/*----------------------------------------------------------------------------*/	
	
} // END class CNovinkyRubrika


  


?>

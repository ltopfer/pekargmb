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
	var $chybafotky='',$chybafotky2='',$Upravafoto,$adresarfotek='foto/',$strankovani=10;


	// constructor
	function CRubrika_Foto($Nazev,$Upravafoto=false,$strankovani=5)
	{ // BEGIN constructor
		$this->chybafotky=$chybafotky;
		$this->chybafotky2=$chybafotky2;
		 $this->strankovani=$strankovani;
    $this->Upravafoto=$Upravafoto;
    $this->CRubrika($Nazev);
	} // END constructor
	
	
/*---------------------------	Popis metody  NastavAdresarFotek()----------------

Metoda NastavAdresarFotek($cilfoto='foto/')
nastav� c�lov� adres��e pro ukl�d�n� fotek
implicitn� nastaveno na: $cilfoto='foto/'
------------------------------------------------------------------------------*/	
function 	NastavAdresarFotek($cil='foto/')
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

function Formular_obec($fsloupec,$fcopridat='novinku',$fzpracovani='administrace.php')
{ 
global $superadmin;
echo"
  <div class=\"centrovano\">
<form enctype=\"multipart/form-data\" action=\"$fzpracovani\" method=\"post\">
<table border=\"1\"  class=\"centrovano\" >
    "; 
  for ($i=0;$i<$this->pocetsloupcu ;$i++ ) {
  //$chyba[$i]='*';  
  
  switch ($this->sloupec[$i]) {
  case 'nadpis':
  case 'autor':
 
  case 'email': 
      echo"<tr><td>";echo $this->sloupec[$i]; echo":</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$fsloupec[$i]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
           
   case 'text':
   
         echo"<tr><td>";echo $this->sloupec[$i]; echo":</td>";
        echo"
       <td class=\"chyba\">
        <textarea   rows=\"20\" name=\"".$this->sloupec[$i]."\" cols=\"50\">".$fsloupec[$i]."</textarea>".$this->chyba[$i]."</td></tr>
            ";
         	break; 
case 'vlastnik':
  echo"<tr class=\"nadpisv-n-c\"><td>"; echo"Vlastn�k z�znamu:</td>";
        echo"<td>".      
        $_SERVER["PHP_AUTH_USER"]."
        <input type=\"hidden\"  name=\"".'vlastnik'."\" value=\"".$_SERVER["PHP_AUTH_USER"]."\" />
 <a href=\"help_vlastnik.htm\" onclick=\" window.open('help_vlastnik.htm','_blank', 'width=200,height=450,menubar=no,scrollbars=yes,resizable=yes,left=0,top=0');return false\"> 
       <img src=\"../obr/help.gif\" alt=\"Dokumentace\" title=\"Dokumentace\" width=\"14\" height=\"14\"  /></a>           
        
        </td></tr>
            ";
         	break;                         
  case 'archiv': 
 if($superadmin==true){
 echo"<tr><td>"; echo"m��ete rovnou p�esunout do archivu</td>";
        echo"<td class=\"chyba\">";
         echo"<select name=\"".$this->sloupec[$i]."\" size\"2\">";         
                
$vypis ="<option value=\"ne\" selected=\"selected\">ne</option><option value=\"ano\">ano</option>";
                 
        echo $vypis ;
                                                          
                                                     
        echo "</select> " .$this->chyba[$i]."
            
        
        
        </td></tr>
            ";
 
                }

 else { 
  
 echo"  <input type=\"hidden\"  name=\"".$this->sloupec[$i]."\" value=\"ne\" />";
  }  
         	break;
           
  case 'poradi': 
  $mp=MySQL_Query("SELECT Max( poradi) FROM $this->Nazev ");
$maxporadi=mysql_result($mp,0);
$poradip=$maxporadi+1;                                                               
 if($superadmin==true){
 echo"<tr><td>"; echo"m��ete rovnou nastavit preferenci</td>";
        echo"<td class=\"chyba\">";
         echo"<select name=\"".$this->sloupec[$i]."\" size\"1\">";         
for ($ip=$poradip;$ip>=0;$ip--) {
$vypis =($ip==$maxporadi)?("<option value=\"$ip\" selected=\"selected\">$ip</option>"):("<option value=\"$ip\">$ip</option>");
echo $vypis ;	
}                

                 
        
                                                          
                                                     
        echo "</select> " .$this->chyba[$i]."
 <a href=\"help_preference.htm\" onclick=\" window.open('help_preference.htm','_blank', 'width=200,height=450,menubar=no,scrollbars=yes,resizable=yes,left=0,top=0');return false\"> 
       <img src=\"../obr/help.gif\" alt=\"Dokumentace\" title=\"Dokumentace\" width=\"14\" height=\"14\"  /></a>             
        
        
        </td></tr>
            ";
 
                }

 else { 
  
 echo"  <input type=\"hidden\"  name=\"".$this->sloupec[$i]."\" value=\"$maxporadi\" />";
  }  
         	break;
case 'zverejnit': 

 echo"<tr><td>"; echo"zve�ejnit novinku v tisku</td>";
        echo"<td class=\"chyba\">";
         echo"<select name=\"".$this->sloupec[$i]."\" size\"1\">";         
                
$vypis ="<option value=\"ano\" selected=\"selected\">ano</option>";
                 
        echo $vypis ;
                                                          
                                                     
        echo "</select> " .$this->chyba[$i]."
            
        
        
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


if($this->pocetobr()<1500) {echo"<tr><td colspan=\"2\"  class=\"centrovano\" > M��ete p�idat k textu 2obr�zky, 
max. 50kB,form�t *.jpg,doporu�en�  rozm�ry: ���ka 250px (jeden obr.), 150px (dva obr.) <br />
nebo 2soubory *.pdf,  max. 50kB  <br />
   <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"50000000\" /> 
  Vyberte obr�zek1(soubor1) v po��ta�i:<input name=\"soubor\" type=\"file\"  accept=\"image/* ,application/pdf \" /> <span class=\"chyba\">     $this->chybafotky  </span>
<br />
   Vyberte obr�zek2(soubor2) v po��ta�i:<input name=\"soubor2\" type=\"file\"  accept=\"image/* ,application/pdf \" /> <span class=\"chyba\">     $this->chybafotky2  </span>  
    </td></tr> 
                     ";
                      if ($this->Upravafoto) {
              echo"<tr><td colspan=\"2\"  class=\"centrovano\" >
              <a name=\"cilupravarozmeru\"> </a>               
             <a href=\"#cilupravarozmeru\"  onclick=\"document.getElementById('upravarozmeru').style.visibility='visible'\" > upravit rozm�ry fotek,</a>
<div  id=\"upravarozmeru\" style=\"visibility: hidden;\">               
���ka: <select name=\"sirka\" size=\"1\">   
<!-- <option value=\"0\">neupravovat</option> -->



<option value=\"250\">250</option>
<option value=\"200\">200</option>
<option value=\"150\">150</option>
<option value=\"100\">100</option>
<option value=\"0\">neupravovat</option>  
 </select> px ,  
 v��ka: <select name=\"vyska\" size=\"1\">
<option value=\"0\">neupravovat</option>
<option value=\"350\">350</option>
<option value=\"300\">300</option>
<option value=\"250\">250</option>
<option value=\"200\">200</option>
<option value=\"150\">150</option>
<option value=\"100\">100</option> 
</select>  px 
</div>
              </td></tr> ";
 	
                     }  
                     
                        }
         else echo"<tr><td colspan=\"2\"  class=\"centrovano\" > Po�et obr�zk� v adres��i je v�t�� ne� 1500 . Kapacita vy�erp�na.Sma�te star�� z�zanmy s obr�zky.</td></tr> ";


	          


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
$kontrolaobrazku=true;
if($_FILES['soubor']['name']!="") { 
$nahrani=true;
 if ($_FILES['soubor']['size']>$limit) {$nahrani=false;$this->chybafotky="nespln�ny vstupn� podm�nky";}
if (  $_FILES['soubor']['type']!="image/pjpeg" && $_FILES['soubor']['type']!="image/jpeg" && $_FILES['soubor']['type']!="image/jpg" && $_FILES['soubor']['type']!="application/pdf") {$nahrani=false;$this->chybafotky="nespln�ny vstupn� podm�nky";}
	                $kontrolaobrazku= ($kontrolaobrazku && $nahrani);
                                    }
                                    
if($_FILES['soubor2']['name']!="") { 
$nahrani2=true;
 if ($_FILES['soubor2']['size']>$limit) {$nahrani2=false;$this->chybafotky2="nespln�ny vstupn� podm�nky";}
if (  $_FILES['soubor2']['type']!="image/pjpeg" && $_FILES['soubor2']['type']!="image/jpeg" && $_FILES['soubor2']['type']!="image/jpg" && $_FILES['soubor2']['type']!="application/pdf") {$nahrani2=false;$this->chybafotky2="nespln�ny vstupn� podm�nky";}
	                $kontrolaobrazku= ($kontrolaobrazku && $nahrani2);
                                    }                                    
                                    
$verdikt= ($kontrolatextu && $kontrolaobrazku);

 return $verdikt;
 }
/*----------------------------------------------------------------------------*/
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
//$lpole[]= $value=='text'? $_POST[$value]: htmlspecialchars($_POST[$value]);

$lpole[]= $_POST[$value];
}
return $lpole ;
}

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
if($_FILES['soubor2']['name']!=""){
$cislofotky2='2_'.$poradovecislo;
$nazev2 = $_FILES['soubor2']['type']=="application/pdf" ? $cislofotky2.'.pdf' : $cislofotky2.'.jpg' ;
$uploadDir = $this->adresarfotek;$uploadFile2 = $uploadDir.$nazev2;  
	if (move_uploaded_file($_FILES['soubor2']['tmp_name'], $uploadFile2))$vysledek2 =$uploadFile2;
   else $vysledek2 =false;
if($vysledek2==$uploadFile2 && $this->Upravafoto && ($fvyska!=0||$fsirka!=0)&& $_FILES['soubor2']['type']!="application/pdf" ) $this->image_resize($uploadFile2,$uploadFile2,$fvyska,$fsirka); 
 
           }           
//pokud jsou dva jpg, tak je zmen�it na 150px ���ky           
if (file_exists ($uploadFile ) && file_exists ($uploadFile2) && (substr ($uploadFile, -3)=='jpg')&& (substr ($uploadFile2, -3)=='jpg') ) {
 $this->image_resize($uploadFile,$uploadFile,150,0);
 $this->image_resize($uploadFile2,$uploadFile2,150,0);	
}           
return $poradovecislo ;
}



/*---------------------------Popis metody Update_v_Rubrice($f_id,$f_updatepole)-

Metoda m�n� obsah polo�ky z rubriky a vrac� ��slo t�to polo�ky

Roz���en�:
Umo��uje zm�nu fotky 
------------------------------------------------------------------------------*/
function Update_v_Rubrice($f_id,$f_updatepole,$fvyska=0,$fsirka=0)
{ 
for($i=0;$i<4;$i++)  $smazsoubor[$i]=$_POST[smazsoubor][$i];

 foreach($smazsoubor as $k => $v){//k foreach
                                      if($v!='') { //k ifu                                      
                                       
// echo"<div class=\"chyba\">adresa smasan�ho souboru:$v <br /> </div>";
 if( file_exists ($v)){
                                   unlink ($v);
                                   $vysledek =$v;  
                                   }  
                echo"<div class=\"chyba\">byl smaz�n soubor:$vysledek <br /> </div>";                    
                                                                    
                                                   }//k ifu
                                                              }//k foreach  
 
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
           
if($_FILES['soubor2']['name']!=""){
$cislofotky2='2_'.$poradovecislo;
$nazev2 = $_FILES['soubor2']['type']=="application/pdf" ? $cislofotky2.'.pdf' : $cislofotky2.'.jpg' ;
$uploadDir = $this->adresarfotek;$uploadFile2 = $uploadDir.$nazev2;

if( file_exists ($uploadFile2)){
                                   unlink ($uploadFile2);$vysledek_mazani2 =true;
                                   }
       else $vysledek_mazani2 =false;   
 
	if (move_uploaded_file($_FILES['soubor2']['tmp_name'], $uploadFile2))$vysledek2 =$uploadFile2;
   else $vysledek2 =false;
if($vysledek2==$uploadFile2 && $this->Upravafoto && ($fvyska!=0||$fsirka!=0)&& $_FILES['soubor2']['type']!="application/pdf" ) $this->image_resize($uploadFile2,$uploadFile2,$fvyska,$fsirka); 
 
           }
//pokud jsou dva jpg, tak je zmen�it na 150px ���ky           
if (file_exists ($uploadFile ) && file_exists ($uploadFile2) && (substr ($uploadFile, -3)=='jpg')&& (substr ($uploadFile2, -3)=='jpg') ) {
 $this->image_resize($uploadFile,$uploadFile,150,0);
 $this->image_resize($uploadFile2,$uploadFile2,150,0);	
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
       
$cislofotky2='2_'.$f_id;$nazev2=$cislofotky2.'.jpg';$nazevpdf2=$cislofotky2.'.pdf';
$uploadDir = $this->adresarfotek;
$cestakfotce2 = $uploadDir.$nazev2; 
$cestakpdefku2 = $uploadDir.$nazevpdf2;  
	 if( file_exists ($cestakfotce2)){
                                   unlink ($cestakfotce2);$vysledek2 =$cestakfotce2;
                                   }
 if( file_exists ($cestakpdefku2)){
                                   unlink ($cestakpdefku2);$vysledek2 =$cestakpdefku2;
                                   }                                  
                                   
       else $vysledek2 =false;        
       
       
                                     
return $vysledek ;
}
/*----------------------------------------------------------------------------*/

/*--------------------------Popis metody image_resize()--------------

Metoda image_resize($file_in, $file_out, $max_x, $max_y=0) zm�n� velikost 
fotky , kter� se nach�z� v adres��i $file_in , a p�esune do adres��e $file_out
maxim�ln� rozm�ry jsou ur�eny $max_x, $max_y  volba 0 neprov�d� zm�nu rozm�ru.
Je zachov�n pom�r stran.
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

Metoda vypisuje obsah tabulky a nab�z� z�kladn� form�tov�n�:
id...neform�tov�no
datum,autor: v�stup ve form� <span class=\"datum, autor\"> hodnota</span>
email      :v�stup ve form� <a href=\"mailto:$v\" class=\"email\" > hodnota </a>
ostan� :v�stup ve form� <div class=\"jmeno_sloupce\"> hodnota</div>

Roz���en�:
$f_id...ur�uje id vybran� novinky






------------------------------------------------------------------------------*/
function 	FormatujObashRubriky($f_id,$f_sloupec='',$f_kriterium='', $f_tridit_podle='id DESC')
{
global $co;

if($f_id!=""){  //zobraz novinku nahore
$VybranaNovinka=CRubrika::VyberPolozku($f_id);
$adresafotky=$this->adresarfotek.$VybranaNovinka[id].'.jpg';
$adresafotky2=$this->adresarfotek.'2_'.$VybranaNovinka[id].'.jpg';
$adresapdefka=$this->adresarfotek.$VybranaNovinka[id].'.pdf';
$adresapdefka2=$this->adresarfotek.'2_'.$VybranaNovinka[id].'.pdf';

echo"
<div class=\"centrovano\">    
         <div  class=\"novinka\" width=\"100%\">
             <div class=\"obrnovinka\">";
             
 if (file_exists ($adresafotky))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
if (file_exists ($adresafotky2))echo"<img src=\"$adresafotky2\"  class=\"obrvlevo\" alt=\"foto\" />";             
             
 echo"     
             </div>
             <div class=\"textv-n-c \">
             <h4 class=\"nadpisv-n-c \" >{$VybranaNovinka[nadpis]} <a href=\"?zobr=".''.'&amp;co='.$co."\" > <img src=\"../obr/zavri.gif\" alt=\"zavri.gif, 767B\" title=\"zav��t\" border=\"0\" height=\"20\" width=\"20\" class=\"obrvpravobezokraje\"> </a></h4>  <a name=\"{$VybranaNovinka[id]}\"> </a>";
echo NL2BR($VybranaNovinka['text']);
if (file_exists ($adresapdefka))echo"
                                 <br>
<a href=\"$adresapdefka\" class=\"pdefkonovinky\" onclick=\"return !window.open(this.href)\">
 P��loha *.pdf
 </a>                                "; 
 if (file_exists ($adresapdefka2))echo"                                
<a href=\"$adresapdefka2\" class=\"pdefkonovinky\" onclick=\"return !window.open(this.href)\">
 P��loha2 *.pdf
 </a> ";

    echo"<div  class=\"den-autor\" >Autor:<span class=\"autor\"> {$VybranaNovinka[autor]}</span>, email:&nbsp;<a href=\"mailto:$VybranaNovinka[email]\" class=\"email\" >{$VybranaNovinka[email]} </a><br /><span class=\"datum\"> {$VybranaNovinka[datum]}</span>
                     <span class=\"tiskzpravy\"><a href=\"tisk.php?id={$VybranaNovinka[id]}\"    
                      onclick=\"return !window.open(this.href)\">Tisk zpr�vy</a></span>
                 </div></div></div>
     </div>
 ";

                    } //zobraz novinku nahore
else               {  //zobraz vse

$PoleRubrik=CRubrika::FormatujObashRubriky($f_sloupec,$f_kriterium,$f_tridit_podle); 
 $strana=$_GET[strana];
$min=$strana*$this->strankovani; 
$max=($min+$this->strankovani)<count($PoleRubrik[id])?($min+$this->strankovani):count($PoleRubrik[id]) ;
$pocetstran=(round(count($PoleRubrik[id])/$this->strankovani))+1;
//echo $min.'***'.$max;   
for ($i=$min;$i< $max;$i++) {
$adresafotky=$this->adresarfotek.$PoleRubrik[id][$i].'.jpg';
$adresafotky2=$this->adresarfotek.'2_'.$PoleRubrik[id][$i].'.jpg';
$adresapdefka=$this->adresarfotek.$PoleRubrik[id][$i].'.pdf';
$adresapdefka2=$this->adresarfotek.'2_'.$PoleRubrik[id][$i].'.pdf';

echo"
<div class=\"centrovano\">    
         <div  class=\"novinka\" width=\"100%\">
             <div class=\"obrnovinka\">";
             
 if (file_exists ($adresafotky))echo"<img src=\"$adresafotky\"  class=\"obrnovinka\" alt=\"foto\" />";
if (file_exists ($adresafotky2))echo"<img src=\"$adresafotky2\"  class=\"obrnovinka\" alt=\"foto\" />";             
             
 echo"     
             </div>
             <div class=\"textv-n-c \">
             <h4 class=\"nadpisv-n-c \" >{$PoleRubrik[nadpis][$i]}</h4>  <a name=\"{$PoleRubrik[id][$i]}\"> </a>";
echo NL2BR($PoleRubrik[text][$i]);
if (file_exists ($adresapdefka))echo"
                                 <br>
<a href=\"$adresapdefka\" class=\"pdefkonovinky\" onclick=\"return !window.open(this.href)\">
 P��loha *.pdf
 </a>                                "; 
 if (file_exists ($adresapdefka2))echo"                                
<a href=\"$adresapdefka2\" class=\"pdefkonovinky\" onclick=\"return !window.open(this.href)\">
 P��loha2 *.pdf
 </a> ";

/* echo"<div  class=\"den-autor\" >Autor:<span class=\"autor\"> {$PoleRubrik[autor][$i]}</span>, email: <a href=\"mailto:$PoleRubrik[email][$i]\" class=\"email\" >{$PoleRubrik[email][$i]} </a><br /><span class=\"datum\"> {$PoleRubrik[datum][$i]}</span>
                     <span class=\"tiskzpravy\"><a href=\"tisk.php?id={$PoleRubrik[id][$i]}\"    
                      onclick=\"return !window.open(this.href)\">Tisk zpr�vy</a></span>
                 </div></div></div>
     </div>
 ";
 */
    echo "<div class=\"den-autor\" >Autor:&nbsp;{$PoleRubrik[autor][$i]}, email:&nbsp;{$PoleRubrik[email][$i]}<br /><span class=\"datum\"> {$PoleRubrik[datum][$i]}</span>
                     <span class=\"tiskzpravy\"><a href=\"tisk.php?id={$PoleRubrik[id][$i]}\"    
                      onclick=\"return !window.open(this.href)\">Tisk zpr�vy</a></span>
                 </div></div></div>
     </div>
 ";






  //echo"<br />"; 
                                             }
                                             
echo"<div class=\"centrovano\" id=\"cisla-stran-novinky\">";
    $strana=(int)$strana;
    $zobrcislo=$strana+1;
// echo"- $zobrcislo - ";
//    echo"<br />  ";
 for ($i=0;$i<$pocetstran ;$i++ ) {
 /*   if ($i==$strana) { 
        $zpom=$i+1;
        $zobicko='&gt;'.$zpom.'&lt;';
    } 
    else
    { $zobicko=$i+1; } 
      echo"<a href=\"".$this->Nazev.".php?strana=".$i.'&amp;co='.$co."\">|  $zobicko  |</a>"; 
      */
     if ($i==$strana)
         echo"<a href=\"".$this->Nazev.".php?strana=".$i.'&amp;co='.$co."\" class=\"aktualnistrana\" >" . ($i+1) . "</a>"; 
     else
         echo"<a href=\"".$this->Nazev.".php?strana=".$i.'&amp;co='.$co."\" >" . ($i+1) . "</a>"; 
     
 } 
echo" </div>";                                             
                    } //zobraz vse                        
                                             
                                             
                                              
}
/*----------------------------------------------------------------------------*/		
function 	FormatujObashRubriky_Stare($f_id,$f_sloupec='',$f_kriterium='', $f_tridit_podle='id DESC')
{
global $co;

if($f_id!=""){  //zobraz novinku nahore
$VybranaNovinka=CRubrika::VyberPolozku($f_id);
$adresafotky=$this->adresarfotek.$VybranaNovinka[id].'.jpg';
$adresafotky2=$this->adresarfotek.'2_'.$VybranaNovinka[id].'.jpg';
$adresapdefka=$this->adresarfotek.$VybranaNovinka[id].'.pdf';
$adresapdefka2=$this->adresarfotek.'2_'.$VybranaNovinka[id].'.pdf';

echo"
<div class=\"centrovano\">    
         <div  class=\"novinka\" width=\"100%\">
             <div class=\"obrvlevo\">";
             
 if (file_exists ($adresafotky))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
if (file_exists ($adresafotky2))echo"<img src=\"$adresafotky2\"  class=\"obrvlevo\" alt=\"foto\" />";             
             
 echo"     
             </div>
             <div class=\"textv-n-c \">
             <h4 class=\"nadpisv-n-c \" >{$VybranaNovinka[nadpis]} <a href=\"?zobr=".''.'&amp;co='.$co."\" > <img src=\"../obr/zavri.gif\" alt=\"zavri.gif, 767B\" title=\"zav��t\" border=\"0\" height=\"20\" width=\"20\" class=\"obrvpravobezokraje\"> </a></h4>  <a name=\"{$VybranaNovinka[id]}\"> </a>";
echo NL2BR($VybranaNovinka['text']);
if (file_exists ($adresapdefka))echo"
                                 <br>
<a href=\"$adresapdefka\" class=\"pdefkonovinky\" onclick=\"return !window.open(this.href)\">
 P��loha *.pdf
 </a>                                "; 
 if (file_exists ($adresapdefka2))echo"                                
<a href=\"$adresapdefka2\" class=\"pdefkonovinky\" onclick=\"return !window.open(this.href)\">
 P��loha2 *.pdf
 </a> ";

echo"<div  class=\"den-autor\" >Autor:<span class=\"autor\"> {$VybranaNovinka[autor]}</span> email: <a href=\"mailto:$VybranaNovinka[email]\" class=\"email\" > {$VybranaNovinka[email]} </a><br /><span class=\"datum\"> {$VybranaNovinka[datum]}</span>
                     <span class=\"tiskzpravy\"><a href=\"tisk.php?id={$VybranaNovinka[id]}\"    
                      onclick=\"return !window.open(this.href)\">Tisk zpr�vy</a></span>
                 </div></div></div>
     </div><br />
 ";

                    } //zobraz novinku nahore
else               {  //zobraz vse

$PoleRubrik=CRubrika::FormatujObashRubriky($f_sloupec,$f_kriterium,$f_tridit_podle); 
 $strana=$_GET[strana];
$min=$strana*$this->strankovani; 
$max=($min+$this->strankovani)<count($PoleRubrik[id])?($min+$this->strankovani):count($PoleRubrik[id]) ;
$pocetstran=(round(count($PoleRubrik[id])/$this->strankovani))+1;
//echo $min.'***'.$max;             
for ($i=$min;$i< $max;$i++) {
$adresafotky=$this->adresarfotek.$PoleRubrik[id][$i].'.jpg';
$adresafotky2=$this->adresarfotek.'2_'.$PoleRubrik[id][$i].'.jpg';
$adresapdefka=$this->adresarfotek.$PoleRubrik[id][$i].'.pdf';
$adresapdefka2=$this->adresarfotek.'2_'.$PoleRubrik[id][$i].'.pdf';

echo"
<div class=\"centrovano\">    
         <div  class=\"novinka\" width=\"100%\">
             <div class=\"obrvlevo\">";
             
 if (file_exists ($adresafotky))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
if (file_exists ($adresafotky2))echo"<img src=\"$adresafotky2\"  class=\"obrvlevo\" alt=\"foto\" />";             
             
 echo"     
             </div>
             <div class=\"textv-n-c \">
             <h4 class=\"nadpisv-n-c \" >{$PoleRubrik[nadpis][$i]}</h4>  <a name=\"{$PoleRubrik[id][$i]}\"> </a>";
echo NL2BR($PoleRubrik[text][$i]);
if (file_exists ($adresapdefka))echo"
                                 <br>
<a href=\"$adresapdefka\" class=\"pdefkonovinky\" onclick=\"return !window.open(this.href)\">
 P��loha *.pdf
 </a>                                "; 
 if (file_exists ($adresapdefka2))echo"                                
<a href=\"$adresapdefka2\" class=\"pdefkonovinky\" onclick=\"return !window.open(this.href)\">
 P��loha2 *.pdf
 </a> ";

echo"<div  class=\"den-autor\" >Autor:<span class=\"autor\"> {$PoleRubrik[autor][$i]}</span> email: <a href=\"mailto:$PoleRubrik[email][$i]\" class=\"email\" > {$PoleRubrik[email][$i]} </a><br /><span class=\"datum\"> {$PoleRubrik[datum][$i]}</span>
                     <span class=\"tiskzpravy\"><a href=\"tisk.php?id={$PoleRubrik[id][$i]}\"    
                      onclick=\"return !window.open(this.href)\">Tisk zpr�vy</a></span>
                 </div></div></div>
     </div><br />
 ";






  echo"<br />"; 
                                             }
                                             
echo"<div class=\"centrovano\" id=\"cisla-stran-novinky\">";
    $strana=(int)$strana;
    $zobrcislo=$strana+1;
  echo"- $zobrcislo - ";
    echo"<br />  ";
 for ($i=0;$i<$pocetstran ;$i++ ) {
 if ($i==$strana) {
     $zpom=$i+1;
 $zobicko='&gt;'.$zpom.'&lt;';
 } 
   else{$zobicko=$i+1;} 
  echo"<a href=\"".$this->Nazev.".php?strana=".$i.'&amp;co='.$co."\">|  $zobicko  |</a>"; 	
 } 
echo" </div>";                                             
                    } //zobraz vse                        
                                             
                                             
                                              
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
global $smaz,$akce,$oznvse,$superadmin,$co;
 echo" 

 <form action=\"$kamodelsat\"  method=\"post\"  enctype=\"multipart/form-data\" >
     ";
     
echo" <div class=\"skrolovatko\"> ";

if($f_id!=""){  //zobraz novinku nahore
$VybranaNovinka=CRubrika::VyberPolozku($f_id);
if($oznvse=='ano') {// k ifu     

 echo"<div class=\"centrovano\">    
    <table  class=\"novinka\" width=\"80%\">
 <tr class=\"nadpisv-n-c \" ><td>".$VybranaNovinka[nadpis]."<br /> (Preference z�znamu : {$VybranaNovinka[poradi]})
  <hr />
<span class=\"obrvlevo\"> ozna�it pro n�sledn� operace:<input type=\"checkbox\" checked=\"checked\" name=\"smaz[]\" value=\"".$VybranaNovinka[id]."\" /></span>
<span class=\"obrvpravo\">  editovat z�znam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$VybranaNovinka[id]."\" class=\"tlacitko\" /></span>

 </td></tr>";
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$VybranaNovinka[id]."\"> </a>";
$adresafotky=$this->adresarfotek.$VybranaNovinka[id].'.jpg';
$adresafotky2=$this->adresarfotek.'2_'.$VybranaNovinka[id].'.jpg';
$adresapdefka=$this->adresarfotek.$VybranaNovinka[id].'.pdf';
$adresapdefka2=$this->adresarfotek.'2_'.$VybranaNovinka[id].'.pdf';
if (file_exists ($adresafotky))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
if (file_exists ($adresafotky2))echo"<img src=\"$adresafotky2\"  class=\"obrvlevo\" alt=\"foto\" />";  
 echo NL2BR($VybranaNovinka[text]);
 if (file_exists ($adresapdefka))echo"
                                 <hr />
<a href=\"$adresapdefka\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 P��loha *.pdf
 </a>                                ";
  if (file_exists ($adresapdefka2))echo"                                 
<a href=\"$adresapdefka2\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 P��loha2 *.pdf
 </a>                                ";   
  echo"</td></tr> <tr><td>Vlastn�k :".$VybranaNovinka[vlastnik]."  <div  class=\"den_autor\" >Autor:".$VybranaNovinka[autor]."email:<a href=\"mailto:$VybranaNovinka[email]\" > ".$VybranaNovinka[email]." </a> Datum:".$VybranaNovinka[datum]." <br /> V archivu :".$VybranaNovinka[archiv]."do tisku".$VybranaNovinka['zverejnit']."</div>
  <a href=\"tisk.php?id=".$VybranaNovinka[id]."\"   class=\" tiskzpravy\" 
 onclick=\"return !window.open(this.href)\">Tisk zpr�vy</a>  
  </td></tr></table>
  
  </div>";
  
echo"<br />";
                                             
                         }// kifu   
                         
else  {
echo"<div class=\"centrovano\">    
    <table  class=\"novinka\" width=\"80%\">
 <tr class=\"nadpisv-n-c \" ><td>".$VybranaNovinka[nadpis]."<br /> (Preference z�znamu : {$VybranaNovinka[poradi]}) 
  <hr />
<span class=\"obrvlevo\"> ozna�it pro n�sledn� vymaz�n�:<input type=\"checkbox\" name=\"smaz[]\" value=\"".$VybranaNovinka[id]."\" /></span>
<span class=\"obrvpravo\"> editovat z�znam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$VybranaNovinka[id]."\" class=\"tlacitko\" /></span> 
 </td></tr>";
echo"<tr><td class=\"textv_n_c \">

 <a name=\"".$VybranaNovinka[id]."\"> </a>";
$adresafotky=$this->adresarfotek.$VybranaNovinka[id].'.jpg';
$adresafotky2=$this->adresarfotek.'2_'.$VybranaNovinka[id].'.jpg';
$adresapdefka=$this->adresarfotek.$VybranaNovinka[id].'.pdf';
$adresapdefka2=$this->adresarfotek.'2_'.$VybranaNovinka[id].'.pdf';
if (file_exists ($adresafotky))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
if (file_exists ($adresafotky2))echo"<img src=\"$adresafotky2\"  class=\"obrvlevo\" alt=\"foto\" />";  
 echo NL2BR($VybranaNovinka[text]);
 if (file_exists ($adresapdefka))echo"
                                 <hr />
<a href=\"$adresapdefka\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 P��loha *.pdf
 </a>                                ";
  if (file_exists ($adresapdefka2))echo"                                 
<a href=\"$adresapdefka2\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 P��loha2 *.pdf
 </a> ";  
  echo"</td></tr> <tr><td>Vlastn�k :".$VybranaNovinka[vlastnik]." <div  class=\"den_autor\" >Autor:".$VybranaNovinka[autor]." email:<a href=\"mailto:$VybranaNovinka[email]\" > ".$VybranaNovinka[email]." </a> Datum:".$VybranaNovinka[datum]."<br /> V archivu :".$VybranaNovinka[archiv]."do tisku".$VybranaNovinka['zverejnit']."</div>
  <a href=\"tisk.php?id=".$VybranaNovinka[id]."\"   class=\" tiskzpravy\" 
 onclick=\"return !window.open(this.href)\">Tisk zpr�vy</a>  
  </td></tr></table>
  
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
 (Preference z�znamu : {$PoleRubrik[poradi][$i]})<br />
<span class=\"obrvlevo\"> ozna�it pro n�sledn� operace:<input type=\"checkbox\" checked=\"checked\" name=\"smaz[]\" value=\"".$PoleRubrik[id][$i]."\" /></span>
<span class=\"obrvpravo\">  editovat z�znam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$PoleRubrik[id][$i]."\" class=\"tlacitko\" /></span> 
 </td></tr>";
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$PoleRubrik[id][$i]."\"> </a>";
$adresafotky=$this->adresarfotek.$PoleRubrik[id][$i].'.jpg';
$adresafotky2=$this->adresarfotek.'2_'.$PoleRubrik[id][$i].'.jpg';
$adresapdefka=$this->adresarfotek.$PoleRubrik[id][$i].'.pdf';
$adresapdefka2=$this->adresarfotek.'2_'.$PoleRubrik[id][$i].'.pdf';
if( (file_exists ($adresafotky))&&($i%2==0))
echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
if( (file_exists ($adresafotky2))&&($i%2==0))echo"<img src=\"$adresafotky2\"  class=\"obrvlevo\" alt=\"foto\" />";
                                            
if( (file_exists ($adresafotky))&&($i%2!=0))
echo"<img src=\"$adresafotky\" class=\"obrvpravo\" alt=\"foto\" />";
if( (file_exists ($adresafotky2))&&($i%2!=0))echo"<img src=\"$adresafotky2\"  class=\"obrvpravo\" alt=\"foto\" />";
                                            
 echo NL2BR($PoleRubrik[text][$i]); 
 if (file_exists ($adresapdefka))echo" <hr />
<a href=\"$adresapdefka\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 P��loha *.pdf
 </a>             "; 
  if (file_exists ($adresapdefka2))echo"
<a href=\"$adresapdefka2\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 P��loha2 *.pdf
 </a>             ";
  echo"</td></tr> <tr><td>Vlastn�k :".$PoleRubrik[vlastnik][$i]."  <div  class=\"den_autor\" >Autor:".$PoleRubrik[autor][$i]." email:".$PoleRubrik[email][$i]." Datum:".$PoleRubrik[datum][$i]."<br /> V archivu :".$PoleRubrik[archiv][$i]."  zve�ejnit v tisku : ".$PoleRubrik['zverejnit'][$i]."</div>
  <a href=\"tisk.php?id=".$PoleRubrik[id][$i]."\"   class=\" tiskzpravy\" 
 onclick=\"return !window.open(this.href)\">Tisk zpr�vy</a>  
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
 <br /> (Preference z�znamu : {$PoleRubrik[poradi][$i]})<br />
<span class=\"obrvlevo\"> ozna�it pro n�sledn� operace:<input type=\"checkbox\"  name=\"smaz[]\" value=\"".$PoleRubrik[id][$i]."\" /></span>
<span class=\"obrvpravo\">  editovat z�znam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$PoleRubrik[id][$i]."\" class=\"tlacitko\" /></span>
 </td></tr>";
 
 
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$PoleRubrik[id][$i]."\"> </a>";
$adresafotky=$this->adresarfotek.$PoleRubrik[id][$i].'.jpg';
$adresafotky2=$this->adresarfotek.'2_'.$PoleRubrik[id][$i].'.jpg';
$adresapdefka=$this->adresarfotek.$PoleRubrik[id][$i].'.pdf';
$adresapdefka2=$this->adresarfotek.'2_'.$PoleRubrik[id][$i].'.pdf';
if( (file_exists ($adresafotky))&&($i%2==0))
echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
if( (file_exists ($adresafotky2))&&($i%2==0))echo"<img src=\"$adresafotky2\"  class=\"obrvlevo\" alt=\"foto\" />";
                                            
if( (file_exists ($adresafotky))&&($i%2!=0))
echo"<img src=\"$adresafotky\" class=\"obrvpravo\" alt=\"foto\" />";
if( (file_exists ($adresafotky2))&&($i%2!=0))echo"<img src=\"$adresafotky2\"  class=\"obrvpravo\" alt=\"foto\" />";
                                            
 echo NL2BR($PoleRubrik[text][$i]); 
 if (file_exists ($adresapdefka))echo" <hr />
<a href=\"$adresapdefka\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 P��loha *.pdf
 </a>             "; 
  if (file_exists ($adresapdefka2))echo"
<a href=\"$adresapdefka2\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 P��loha2 *.pdf
 </a>             ";  
  echo"</td></tr> <tr><td>Vlastn�k :".$PoleRubrik[vlastnik][$i]." <div  class=\"den_autor\" >Autor:".$PoleRubrik[autor][$i]." email:".$PoleRubrik[email][$i]." Datum:".$PoleRubrik[datum][$i]."<br /> V archivu :".$PoleRubrik[archiv][$i]." zve�ejnit v tisku : ".$PoleRubrik['zverejnit'][$i]."</div>
  <a href=\"tisk.php?id=".$PoleRubrik[id][$i]."\"   class=\" tiskzpravy\" 
 onclick=\"return !window.open(this.href)\">Tisk zpr�vy</a>  
  </td></tr></table>
 
  </div>";
 echo"<br />"; 

                                              }                                           
                  } // k else   
                  
        }//k zobraz v�e
 echo" </div>" ; // skrolovatko                                                
 echo"<hr />";                                        
echo" <table width=\"100%\" border=\"0\">  
   <tr><td>
     <div class=\"chyba\" >Ozna�it V�ECHNY   z�znamy  pro n�sledn� operace? <br /> <input type=\"submit\"  value=\"ano\" name=\"oznvse\" class=\"tlacitko\" />  <input type=\"submit\"  value=\"odzna�it\" name=\"oznvse\" class=\"tlacitko\" />  </div>
";
echo"<input type=\"hidden\" name=\"co\" value=\"$co\" />";
echo"<input type=\"hidden\" name=\"akce\" value=\"editace_stranky\" />";

if ($co!='archiv') {
	echo" <br /><div>P�esunout ozna�en� z�znamy do archivu <input type=\"submit\"  value=\"archivovat\" name=\"editakce\" class=\"tlacitko\" /></div>";
}
if ($co!='novinky') {
echo" <br /><div>P�esunout ozna�en� z�znamy z archivu <input type=\"submit\"  value=\"dearchivovat\" name=\"editakce\" class=\"tlacitko\" /></div>";	
}
if($superadmin==true){
echo" <br /><div>Preference ozna�en�ch z�znam�: <input type=\"submit\"  value=\"vynulovat preference\" name=\"editakce\" class=\"tlacitko\" /></div>";	
                      }
echo" <br /><div>Trvale odstranit ozna�en� z�znamy <input type=\"submit\"  value=\"smazat\" name=\"editakce\" class=\"tlacitko\" /></div>
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
$vlastnici= $this->VyberVlastniky();
$PoleZaznamu=CRubrika::VyberPolozku($f_id); 
echo" Z�zanm �.:$PoleZaznamu[id] Datum z�zanmu: $PoleZaznamu[datum]<br />";
$adresafotky=$this->adresarfotek.$PoleZaznamu[id].'.jpg';
$adresafotky2=$this->adresarfotek.'2_'.$PoleZaznamu[id].'.jpg';
$adresapdefka=$this->adresarfotek.$PoleZaznamu[id].'.pdf';
$adresapdefka2=$this->adresarfotek.'2_'.$PoleZaznamu[id].'.pdf';
echo"
 <div class=\"centrovano\">
<form enctype=\"multipart/form-data\" action=\"$fzpracovani\" method=\"post\">";
if( file_exists ($adresafotky))
                echo "<div  class=\"centrovano\"><img src=\"$adresafotky\"   alt=\"n�hled_foto\" ><br />
                  P�ilo�en� foto1. Smazat : <input type=\"checkbox\"  name=\"smazsoubor[]\" value=\"$adresafotky\" /> 
                  </div> ";
      else echo"<div  class=\"centrovano\"> Foto1 nen� p�ilo�eno.
               </div>";
  if( file_exists ($adresafotky2))
                echo "<div  class=\"centrovano\"><img src=\"$adresafotky2\"   alt=\"n�hled_foto\" ><br />
                  P�ilo�en� foto2. Smazat : <input type=\"checkbox\"  name=\"smazsoubor[]\" value=\"$adresafotky2\" /> 
                  </div> ";
      else echo"<div  class=\"centrovano\"> Foto2 nen� p�ilo�eno.
               </div>";             
if (file_exists ($adresapdefka))echo" <div  class=\"centrovano\">
<a href=\"$adresapdefka\"  onclick=\"return !window.open(this.href)\">
 P��loha1 *.pdf.  
 </a>  Smazat : <input type=\"checkbox\"  name=\"smazsoubor[]\" value=\"$adresapdefka\" />   </div> ";
  else echo"<div  class=\"centrovano\"> P��loha1 *.pdf nebyla p�ilo�ena.
               </div>";
if (file_exists ($adresapdefka2))echo" <div  class=\"centrovano\">
<a href=\"$adresapdefka2\"  onclick=\"return !window.open(this.href)\">
 P��loha2 *.pdf. 
 </a> Smazat : <input type=\"checkbox\"  name=\"smazsoubor[]\" value=\"$adresapdefka2\" />   </div> ";
  else echo"<div  class=\"centrovano\"> P��loha2 *.pdf nebyla p�ilo�ena.
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
        <textarea id=\"elm2\" rows=\"20\" name=\"".$this->sloupec[$i]."\" cols=\"50\">".$PoleZaznamu[$this->sloupec[$i]]."</textarea>".$this->chyba[$i]."</td></tr>
            ";
         	break;  
case 'vlastnik':
if($superadmin==true){
 echo"<tr><td>"; echo"m��ete zm�nit vlastn�ka</td>";
        echo"<td class=\"chyba\">";
         echo"<select name=\"".$this->sloupec[$i]."\" size\"2\">";
                 for ($j=0;$j<count($vlastnici) ;$j++ ) { 
$vypis = $PoleZaznamu[vlastnik]==$vlastnici[$j] ? "<option value=\"$vlastnici[$j]\" selected=\"selected\">$vlastnici[$j]</option>" :  "<option value=\"$vlastnici[$j]\">$vlastnici[$j]</option>";
                 
        echo $vypis ;
                                                             }
                                                     
        echo "</select> seznam vlastn�k�" .$this->chyba[$i]."
<a href=\"help_vlastnik.htm\" onclick=\" window.open('help_vlastnik.htm','_blank', 'width=200,height=450,menubar=no,scrollbars=yes,resizable=yes,left=0,top=0');return false\"> 
       <img src=\"../obr/help.gif\" alt=\"Dokumentace\" title=\"Dokumentace\" width=\"14\" height=\"14\"  /></a>            
        
        
        </td></tr>
            ";
 
                }

 else {
  echo"<tr class=\"nadpisv-n-c\"><td>"; echo"Vlastn�k z�znamu:</td>";
        echo"<td>".      
        $_SERVER["PHP_AUTH_USER"]."
        <input type=\"hidden\"  name=\"".'vlastnik'."\" value=\"".$_SERVER["PHP_AUTH_USER"]."\" />
<a href=\"help_vlastnik.htm\" onclick=\" window.open('help_vlastnik.htm','_blank', 'width=200,height=450,menubar=no,scrollbars=yes,resizable=yes,left=0,top=0');return false\"> 
       <img src=\"../obr/help.gif\" alt=\"Dokumentace\" title=\"Dokumentace\" width=\"14\" height=\"14\"  /></a>            
        
        </td></tr>
            ";
        }       
         	break;  
                               
case 'archiv':

 echo"<tr><td>"; echo"m��ete p�esunout do archivu</td>";
        echo"<td class=\"chyba\">";
         echo"<select name=\"".$this->sloupec[$i]."\" size\"2\">";         
                
$vypis = $PoleZaznamu[archiv]=='ano' ? "<option value=\"ano\" selected=\"selected\">ano</option><option value=\"ne\">ne</option>" :  "<option value=\"ne\" selected=\"selected\">ne</option><option value=\"ano\">ano</option>";
                 
        echo $vypis ;
                                                          
                                                     
        echo "</select> " .$this->chyba[$i]."
            
        
        
        </td></tr>
            ";
 
              

  
         	break;
           
           
case 'poradi': 
  $mp=MySQL_Query("SELECT Max( poradi) FROM $this->Nazev ");
$maxporadi=mysql_result($mp,0);
$poradip=$maxporadi+1;                                                               
 if($superadmin==true){
 echo"<tr><td>"; echo"m��ete nastavit preferenci</td>";
        echo"<td class=\"chyba\">";
         echo"<select name=\"".$this->sloupec[$i]."\" size\"1\">";         
for ($ip=$poradip;$ip>=0;$ip--) {
$vypis =($ip==$PoleZaznamu[$this->sloupec[$i]])?("<option value=\"$ip\" selected=\"selected\">$ip</option>"):("<option value=\"$ip\">$ip</option>");
echo $vypis ;	
}                

                 
        
                                                          
                                                     
        echo "</select> " .$this->chyba[$i]."
            
 <a href=\"help_preference.htm\" onclick=\" window.open('help_preference.htm','_blank', 'width=200,height=450,menubar=no,scrollbars=yes,resizable=yes,left=0,top=0');return false\"> 
       <img src=\"../obr/help.gif\" alt=\"Dokumentace\" title=\"Dokumentace\" width=\"14\" height=\"14\"  /></a>         
        
        </td></tr>
            ";
 
                }

 else { 
  
 echo"<input type=\"hidden\"  name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" />";
  }  
         	break;
case 'zverejnit': 
 echo"<tr><td>"; echo"zve�ejnit vtisku</td>";
        echo"<td class=\"chyba\">".$PoleZaznamu['zverejnit'];
          echo"<input type=\"hidden\"  name=\"".'zverejnit'."\" value=\"".$PoleZaznamu['zverejnit']."\" />".$this->chyba[$i]."</td></tr>";
         	break;           
                         
  default:
  	/* neprov�d� se nic*/
  	break;
  }

}  




if($this->pocetobr()<1500) {echo"<tr><td colspan=\"2\"  class=\"centrovano\" > M��ete p�idat k textu 2obr�zky, 
max. 50kB,form�t *.jpg,doporu�en�  rozm�ry: ���ka 250px (jeden obr.), 150px(dva obr.) <br />
nebo 2soubory *.pdf,  max. 50kB  <br />
   <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"50000000\" /> 
  Vyberte obr�zek1(soubor1) v po��ta�i:<input name=\"soubor\" type=\"file\"  accept=\"image/* ,application/pdf \" /> <span class=\"chyba\">     $this->chybafotky  </span>
<br />
   Vyberte obr�zek2(soubor2) v po��ta�i:<input name=\"soubor2\" type=\"file\"  accept=\"image/* ,application/pdf \" /> <span class=\"chyba\">     $this->chybafotky2  </span>  </td></tr> 
                     ";
                     if ($this->Upravafoto) {
              echo"<tr><td colspan=\"2\"  class=\"centrovano\" >
                      <a name=\"cilupravarozmeru\"> </a>               
             <a href=\"#cilupravarozmeru\"  onclick=\"document.getElementById('upravarozmeru').style.visibility='visible'\" > upravit rozm�ry fotek,</a>
<div  id=\"upravarozmeru\" style=\"visibility: hidden;\">  
���ka: <select name=\"sirka\" size=\"1\">   
<!-- <option value=\"0\">neupravovat</option> -->
<option value=\"250\">250</option>
<option value=\"200\">200</option>
<option value=\"150\">150</option>
<option value=\"100\">100</option>
<option value=\"0\">neupravovat</option> 
 </select> px ,  
 v��ka: <select name=\"vyska\" size=\"1\">
<option value=\"0\">neupravovat</option> 
<option value=\"350\">350</option>
<option value=\"300\">300</option>
<option value=\"250\">250</option>
<option value=\"200\">200</option>
<option value=\"150\">150</option>
<option value=\"100\">100</option> 
</select>  px 
</div>
              </td></tr> ";
 	
                     }  
	          
                       }
         else echo"<tr><td colspan=\"2\"  class=\"centrovano\" > Po�et obr�zk� v adres��i je v�t�� ne� 50 .Jestli�e chcete Kapacita vy�erp�na.Sma�te star�� z�zanmy s obr�zky.</td></tr> ";

 


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
/*---------Form�tov�n� pro tisk----------------------*/
 
function Vyber_na_Tisk($f_id)
{ 
$adresafotky=$this->adresarfotek.$f_id.'.jpg';
$adresafotky2=$this->adresarfotek.'2_'.$f_id.'.jpg';
if( file_exists ($adresafotky))
                echo "<div  class=\"centrovano\"><img src=\"$adresafotky\"   alt=\"n�hled_foto\" /><br />
                  P�ilo�en� foto.
                  </div> ";
                  if( file_exists ($adresafotky2))
                echo "<div  class=\"centrovano\"><img src=\"$adresafotky2\"   alt=\"n�hled_foto\" /><br />
                  P�ilo�en� foto2.
                  </div> ";
      /*else echo"<div  class=\"centrovano\"> Foto nen� p�ilo�eno.
               </div>";*/
$vypis_udaju=CRubrika::Vyber_na_Tisk($f_id);               

 }



/*----------------------------------------------------------------------------*/

/*---------------------------Popis metody VyberSeznamNovinek()-----------------

Metoda VyberSeznamNovinek() vrac� pole id, datum, nadpis novinek
------------------------------------------------------------------------------*/
 function VyberSeznamNovinek($f_vlastnik='')
 {  
$f_vlastnik=$this->inject_addslashes($f_vlastnik);
  if ($f_vlastnik!='') {
    
          @$vsechnyzazanamy=MySQL_Query("Select id,datum,nadpis FROM $this->Nazev WHERE vlastnik='$f_vlastnik' ORDER BY poradi DESC,id DESC ; ")OR DIE(MySQL_Error()) ;    
                         }   
                else   { 
         @$vsechnyzazanamy=MySQL_Query("Select id,datum,nadpis FROM $this->Nazev  ORDER BY poradi DESC,id DESC ; ")OR DIE(MySQL_Error()) ; 
                        }
         while ($zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC)) {
          foreach($zaznam as $k => $v) {
         
               $ven[$k][]=$v;
         	
                         
                                       }
         
         
         
            
         
                                                                     }

            
                                                                     
return ($ven);
 } 
 
 
function VyberSeznamNovinekAktualnich($f_vlastnik='')
 {  
$f_vlastnik=$this->inject_addslashes($f_vlastnik);
  if ($f_vlastnik!='') {
    
          @$vsechnyzazanamy=MySQL_Query("Select id,datum,nadpis FROM $this->Nazev WHERE (vlastnik='$f_vlastnik')AND(archiv='ne') ORDER BY poradi DESC,id DESC ; ")OR DIE(MySQL_Error()) ;    
                         }   
                else   { 
         @$vsechnyzazanamy=MySQL_Query("Select id,datum,nadpis FROM $this->Nazev  WHERE archiv='ne'ORDER BY poradi DESC,id DESC ; ")OR DIE(MySQL_Error()) ; 
                        }
         while ($zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC)) {
          foreach($zaznam as $k => $v) {
         
               $ven[$k][]=$v;
         	
                         
                                       }
         
         
         
            
         
                                                                     }

            
                                                                     
return ($ven);
 }  
  
function VyberSeznamNovinekArchivovanych($f_vlastnik='')
 {  
$f_vlastnik=$this->inject_addslashes($f_vlastnik);
  if ($f_vlastnik!='') {
    
          @$vsechnyzazanamy=MySQL_Query("Select id,datum,nadpis FROM $this->Nazev WHERE (vlastnik='$f_vlastnik')AND(archiv='ano') ORDER BY poradi DESC,id DESC ; ")OR DIE(MySQL_Error()) ;    
                         }   
                else   { 
         @$vsechnyzazanamy=MySQL_Query("Select id,datum,nadpis FROM $this->Nazev  WHERE archiv='ano'ORDER BY poradi DESC ,id DESC ; ")OR DIE(MySQL_Error()) ; 
                        }
         while ($zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC)) {
          foreach($zaznam as $k => $v) {
         
               $ven[$k][]=$v;
         	
                         
                                       }
         
         
         
            
         
                                                                     }

            
                                                                     
return ($ven);
 }  
 
 
 
 
function DoArchivu($f_id)
{  
$f_id=$this->inject_addslashes($f_id);
$f_id=intval($f_id);
@$uprava=MySQL_Query("UPDATE $this->Nazev SET archiv='ano'  WHERE id=$f_id ;")OR DIE(MySQL_Error()) ; 

return ($f_id);
} 
function ZArchivu($f_id)
{  
$f_id=$this->inject_addslashes($f_id);
$f_id=intval($f_id);
@$uprava=MySQL_Query("UPDATE $this->Nazev SET archiv='ne'  WHERE id=$f_id ;")OR DIE(MySQL_Error()) ; 

return ($f_id);
} 
function poleProNavratDoRSS($f_id)
{  
$f_id=$this->inject_addslashes($f_id);
$f_id=intval($f_id);
$Polozka=CRubrika::VyberPolozku($f_id);
return ($Polozka);
}  
function VynulovatPreference($f_id)
{  
$f_id=$this->inject_addslashes($f_id);
$f_id=intval($f_id);
@$uprava=MySQL_Query("UPDATE $this->Nazev SET poradi=0  WHERE id=$f_id ;")OR DIE(MySQL_Error()) ; 

return ($f_id);
}

  
function VyberSeznamNovinekZverejnenych($f_vlastnik='')
 {  
$f_vlastnik=$this->inject_addslashes($f_vlastnik);
  if ($f_vlastnik!='') {
    
          @$vsechnyzazanamy=MySQL_Query("Select id,datum,nadpis FROM $this->Nazev WHERE (vlastnik='$f_vlastnik')AND(zverejnit='ano') ORDER BY poradi DESC,id DESC ; ")OR DIE(MySQL_Error()) ;    
                         }   
                else   { 
         @$vsechnyzazanamy=MySQL_Query("Select id,datum,nadpis FROM $this->Nazev  WHERE zverejnit='ano'ORDER BY poradi DESC ,id DESC ; ")OR DIE(MySQL_Error()) ; 
                        }
         while ($zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC)) {
          foreach($zaznam as $k => $v) {
         
               $ven[$k][]=$v;
         	
                         
                                       }
         
         
         
            
         
                                                                     }

            
                                                                     
return ($ven);
 }         
/*---------------------------Popis metody VyberVlastniky()-----------------

Metoda VyberVlastniky()vrac� pole vlastniku
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

/*------Metody pro pr�ci s RSS------------------------------------------------*/


/***********************************************************************
funkce pro vlo�en� z�znamu do tabuky gympl_rss a p�i ne�sp�chu vrac� hodnotu -1.


***************************************************************************/
function Pridej_do_Rss($f_idnovinky='',$textp,$nadpisp,$autorp,$webadresa,$zdrojp='pekargmb')
{ 
$textp=$this->inject_addslashes($textp);
$nadpisp=$this->inject_addslashes($nadpisp);
$autorp=$this->inject_addslashes($autorp);
$webadresa=$this->inject_addslashes($webadresa);
 if ($f_idnovinky!='') {
$osp=$f_idnovinky;	
} 
else
{                           
$mm=MySQL_Query("SELECT Max( ID ) FROM gympl_rss "); 
$maxcislo=mysql_result($mm,0);
//echo"maxcislo:$maxcislo<BR>"; 
$osp=$maxcislo+1; 
}
$datump=Date(Y.'-'.m.'-'.d);

$urlp=($f_idnovinky!='')?$webadresa.'?zobr='.$f_idnovinky :$webadresa.'#'.$osp;
$ukazka=SubStr($textp,0,60);
@$vlozeni=MySQL_Query("INSERT INTO gympl_rss VALUES ($osp,'$nadpisp','$ukazka','$urlp','$zdrojp','$autorp','$datump');" ) OR DIE(MySQL_Error()) ;


if(!$vlozeni) $osp=-1;


 return $osp;

}

/*--------------------------Popis metody Smaz_z_Rss($f_id)--------------

Metoda ma�e polo�ku z gympl_rss a vrac� Po�adovan� ��slo smaz�n�
------------------------------------------------------------------------------*/
function Smaz_z_Rss($f_id)
{  $f_id=$this->inject_addslashes($f_id); 
$f_id=intval($f_id); 

@$mazani=MySQL_Query("DELETE FROM gympl_rss WHERE id=$f_id ;")OR DIE(MySQL_Error()) ;

return ($f_id);
}


/*---------------------------Popis metody Update_v_Rss($f_id,$f_updatepole)-

Metoda m�n� obsah polo�ky v tabulce gympl_rssa vrac� ��slo t�to polo�ky
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
feedrss($formalweb) zapise do xml souboru v�etn� p�ipojen� k 
MySQL  zalo�ena na t��d� feedcreator.class.php
**************************************/
function feedrss($formalweb)
{

include("../news1/feedcreator.class.php"); 
$rss = new UniversalFeedCreator(); 
$rss->useCached(); // p�i aktualizaci pod 1 hodinu se pou�ije cache
$rss->title = "Novinky ze str�nek $formalweb"; 
$rss->description = "Zpravodajstv� z $formalweb "; 

//voliteln�
$rss->descriptionTruncSize = 500;
$rss->descriptionHtmlSyndicated = true;

$rss->link = "http://$formalweb/news1/news/feed.xml"; 
$rss->syndicationURL = "http://$formalweb/";
//.$_SERVER["PHP_SELF"]; 

$image = new FeedImage(); 
$image->title = "Logo na�ich str�nek"; 
$image->url = "http://$formalweb/news1/obr/2.gif"; 
$image->link = "http://$formalweb/index.php"; 
$image->description = "Zpr�vy poskytnuty serverem $formalweb"; 

//voliteln�
$image->descriptionTruncSize = 500;
$image->descriptionHtmlSyndicated = true;

$rss->image = $image; 

//na�ten� novinek z datab�ze

$res = mysql_query("SELECT * FROM gympl_rss ORDER BY datum DESC"); 
while ($data = mysql_fetch_object($res)) { 
    $item = new FeedItem(); 
    $item->title = $data->TITULEK; 
    $item->link = $data->URL; 
    $item->description = $data->POPISEK; 
    
    //voliteln�
    $item->descriptionTruncSize = 500;
    $item->descriptionHtmlSyndicated = false;

    $item->date = $data->DATUM; 
    $item->source = $data->ZDROJ; 
    $item->author = $data->AUTOR; 
     
    $rss->addItem($item); 
} 

// mo�n� form�ty jsou: RSS0.91, RSS1.0, RSS2.0, PIE0.1 (zastaral�),
// MBOX, OPML, ATOM, ATOM0.3, HTML, JS
 $rss->saveFeed("RSS2.0", "../news1/news/feed.xml");



}
// konecfunkce pro z�pis do xml feedrss()




/*----------------------------------------------------------------------------*/	
 function 	PosliEmailBartovi( $fto ='nekdo@nekde.cz', $ftext="V�en�.\r\n
 Zas�l�m V�m tento text a p��lohu p�ihlaste se na  http://nekde.neco.com\r\n 
D�kujeme za spolupr�ci\r\n ", $ffrom='from@from.cz',$fsubjekt='subjekt')

{	
////////////////////// ZADEJTE SV�J EMAIL ZDE /////////////////// 
 
 $to = $fto; 
$uploadFile= $_FILES['soubor']['tmp_name'];
// echo"to je : $to <br />" ;
//  echo"uploadFilejmenodocasne v tempu : $uploadFile  <br />" ;
if ($uploadFile!='') {
$message = "";
$charset = 'windows-1250'; 
$subject   = $fsubjekt; 
$from      = $ffrom; 
//echo"from je :".$ffrom."<br />";
$headers = "From: $from"; 
$message .= "\r\n";
$message .= $ftext;

       //$uploadFile='obr.jpg';      
       //$file_name=$uploadFile;
      $file_name= $_FILES['soubor']['name']; 
       //$file_type = 'image/jpeg';
      $file_type = $_FILES['soubor']['type'];  
         	$file = fopen ($uploadFile, "r"); /* otevren pro cteni */
		$data = fread ($file, filesize($uploadFile)); /* nacteme obsah do promenne */
		fclose ($file);
		

          $semi_rand = md5(time()); 
          $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
          $headers .= "\nMIME-Version: 1.0\n" . 
                      "Content-Type: multipart/mixed;\n" . 
                      " boundary=\"{$mime_boundary}\""; 
          $message = "This is a multi-part message in MIME format.\n\n" . 
                     "--{$mime_boundary}\n" . 
                     "Content-Type: text/plain; charset=$charset\n" . 
                     "Content-Transfer-Encoding: 7bit\n\n" . 
                     $message . "\n\n"; 
          $data = chunk_split(base64_encode($data)); 
          $message .= "--{$mime_boundary}\n" . 
                      "Content-Type: {$file_type};\n" . 
                      " name=\"{$file_name}\"\n" . 
                      "Content-Transfer-Encoding: base64\n\n" . 
                      $data . "\n\n";
$uploadFile2= $_FILES['soubor2']['tmp_name'];                       
if ($uploadFile2!='') {
 $file_name2= $_FILES['soubor2']['name']; 
      
      $file_type2 = $_FILES['soubor2']['type'];  
         	$file2 = fopen ($uploadFile2, "r"); /* otevren pro cteni */
		$data2 = fread ($file2, filesize($uploadFile2)); /* nacteme obsah do promenne */
		fclose ($file2);
    $data2 = chunk_split(base64_encode($data2));
     $message .= "--{$mime_boundary}\n" . 
                      "Content-Type: {$file_type2};\n" . 
                      " name=\"{$file_name2}\"\n" . 
                      "Content-Transfer-Encoding: base64\n\n" . 
                      $data2 . "\n\n";   
     	
} 
$message .= "--{$mime_boundary}--\n";                     
       
        $message = StripSlashes($message); 
     $sent = @mail($to, $subject, $message, $headers); 
     //  echo"po odesl�n� <br /><hr> to:$to <br />";
      //  echo"subject:$subject <br />";
     //   echo"mesage :$message<br />";
        
       // echo"hlavi�ky jsou headers jsou: $headers--<br />";
        if($sent)  echo"<br /> Na adresu $fto byla odesl�na ��dost o zve�ejn�n� v tisku. <br />"; 
        else      echo "<h1>Formul�� se nezda�ilo odeslat na email $fto.</h1>"; 	
}	

	

else {
//echo" bez p��lohy <br />";
 $message = "";
$charset = 'windows-1250'; 
$subject   = $fsubjekt; 
$from      = $ffrom; 
//echo"from je :".$ffrom."<br />";
$headers = "From: $from"; 
$message .= "\r\n";
$message .= $ftext;
 $text = Base64_Encode($ftext);
   $headers .= "MIME-Version: 1.0\n".
              "Content-Type: text/plain; charset=\"$charset\"\n".
              "Content-Transfer-Encoding: base64\n";
               // odesl�n� e-mailu              
  $sentbezpr=@mail($fto, $fsubjekt, $text, $headers); 
  if($sentbezpr)  echo"<br /> Na adresu $fto byla odesl�na ��dost o zve�ejn�n� v tisku. <br />"; 
        else      echo "<h1>Formul�� se nezda�ilo odeslat na email $fto.</h1>"; 	

	
 // @mail($fto, $subject, $message, $headers); 
// @mail ($fto, $fsubjekt, $ftext, "From: $ffrom") ;
//	
} 
}





/*----------------------------------------------------------------------------*/	
} // END class CNovinkyRubrika


  


?>

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
Tabulka V datab�zi MySQL: id, datum,jmeno,prijmeni,prezdivka,heslo, email,
prava_fotogal,prava_novinky
chybafotky...chybov� hl�en� fotky
Upravafoto... boolean identifikuje zda bude odesilan� foto opraveno(rozmm�ry)
adresarfotek...specifikuje adres�� pro ukl�d�n� fotek
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

function Formular_obec($fsloupec,$fcopridat='u�itele',$fzpracovani='administrace.php')
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
  echo"<tr><td>"; echo" jm�no:</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$fsloupec[$i]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
  case 'prijmeni':
  echo"<tr><td>"; echo"p��jmen�:</td>";
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
if ($fsloupec[$i]=='u�itel�') {echo"<option value=\"u�itel\" selected=\"selected\">u�itel�</option>";} 
                       else {echo"<option value=\"u�itel�\">u�itel�</option>";}
	
if ($fsloupec[$i]=='thp pracovn�ci') {echo"<option value=\"thp pracovn�ci\" selected=\"selected\">thp pracovn�ci</option>";} 
                       else {echo"<option value=\"thp pracovn�ci\">thp pracovn�ci</option>";} 
if ($fsloupec[$i]=='spr�vn� zam�stnanci') {echo"<option value=\"spr�vn� zam�stnanci\" selected=\"selected\">spr�vn� zam�stnanci</option>";} 
                      else {echo"<option value=\"spr�vn� zam�stnanci\">spr�vn� zam�stnanci</option>";}                             
if ($fsloupec[$i]=='hala') {echo"<option value=\"hala\" selected=\"selected\">hala</option>";} 
                       else{echo"<option value=\"hala\">hala</option>";}                        
if ($fsloupec[$i]=='j�delna') {echo"<option value=\"j�delna\" selected=\"selected\">j�delna</option>";} 
                       else {echo"<option value=\"j�delna\">j�delna</option>";}  

echo"
 </select>".$this->chyba[$i]."</td></tr>
               ";
         	
      
         	break;
         	
         	 case 'aprobace': 
      echo"<tr><td>";echo $this->sloupec[$i]; echo"<br />(pracovn� za�azen�):</td>";
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
         	  	  echo"<tr><td>"; echo"funkce zam�stnance:</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$fsloupec[$i]."\" />".$this->chyba[$i]."
  <a href=\"help_funkce.htm\" onclick=\" window.open('help_funkce.htm','_blank', 'width=200,height=450,menubar=no,scrollbars=yes,resizable=yes,left=0,top=0');return false\"> 
       <img src=\"../obr/help.gif\" alt=\"Dokumentace\" title=\"Dokumentace\" width=\"14\" height=\"14\"  /></a>       
        </td></tr>
            ";
         	  		break; 
         	  	 /* case 'funkceaj': 
      echo"<tr><td>"; echo"n�zev funkce v AJ:</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$fsloupec[$i]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;*/
         	 case 'poznamka':
   
         echo"<tr><td>"; echo" pozn�mka:</td>";
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


if($this->pocetobr()<150) {echo"<tr><td colspan=\"2\"  class=\"centrovano\" > M��ete p�idat foto u�ivatele, 
max. 50kB,form�t *.jpg,doporu�en�  rozm�ry 120x150px <br />
   <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"50000\" /> 
  Vyberte obr�zek v po��ta�i:<input name=\"soubor\" type=\"file\"  accept=\"image/*\" />
  <span class=\"chyba\">     $this->chybafotky  </span>  </td></tr> 
                     ";
                      if ($this->Upravafoto) {
              echo"<tr><td colspan=\"2\"  class=\"centrovano\" >
              upravit rozm�ry, 
���ka: <select name=\"sirka\" size=\"1\">   
<option value=\"120\">120</option>
<option value=\"150\">150</option>
<option value=\"100\">100</option> 
 </select> px ,  
 v��ka: <select name=\"vyska\" size=\"1\">
<option value=\"150\">150</option>
<option value=\"120\">120</option>
<option value=\"100\">100</option> 
</select>  px 
              </td></tr> ";
 	
                     }  
                          }
         else echo"<tr><td colspan=\"2\"  class=\"centrovano\" > Po�et obr�zk� v adres��i je v�t�� ne� 150 . Kapacita vy�erp�na.Sma�te star�� z�zanmy s obr�zky.</td></tr> ";


	          


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




/*---------------------------Popis metody Formular_kontrola($kontrpole)---------

Metoda Formular_kontrola($kontrpole) kontroluje, zda $kontrpole , kter� jsou
ozna�eny jako povinn� tj. '*'neobsahuje pr�zn� polo�ky a zda zadan� polo�ky 
odpov�daj� p�edem stanoven�m po�adavk�m, nap�. polo�ka mail.,prezdivku a heslo

Roz���en�:kontroluje, zda odes�lan� soubor m� form�t  $_FILES['soubor']['type'],
$_FILES['soubor']['size']  jpg a zda nep�ekro�il velikost limit=50 kB
------------------------------------------------------------------------------*/
function Formular_kontrola($kontrpole,$limit=50000,$jedinecnost_hesla_prezdivky=true)
{
$kontrolatextu=CRubrika::Formular_kontrola($kontrpole,$jedinecnost_hesla_prezdivky);

if($_FILES['soubor']['name']!="") { 
$nahrani=true;
 if ($_FILES['soubor']['size']>$limit) {$nahrani=false;$this->chybafotky="nespln�ny vstupn� podm�nky";}
if (  $_FILES['soubor']['type']!="image/pjpeg" && $_FILES['soubor']['type']!="image/jpeg" && $_FILES['soubor']['type']!="image/jpg") {$nahrani=false;$this->chybafotky="nespln�ny vstupn� podm�nky";}
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
$cislofotky=$poradovecislo;$nazev=$cislofotky.'.jpg';
$uploadDir = $this->adresarfotek;$uploadFile = $uploadDir.$nazev;  
	if (move_uploaded_file($_FILES['soubor']['tmp_name'], $uploadFile))$vysledek =$uploadFile;
   else $vysledek =false;
if($vysledek==$uploadFile && $this->Upravafoto && ($fvyska!=0||$fsirka!=0) ) $this->image_resize($uploadFile,$uploadFile,$fvyska,$fsirka); 
 
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

Metoda ma�e polo�ku z rubriky a vrac� Po�adovan� ��slo smaz�n�

Roz���en�:
je li p�ilo�ena fotka, sma�e ji z p�edem ur�en�ho
 adres��e parametrem $this->adresarfotek
 a sma�e i nahled z adres��e $this->adresarnahledu
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
function 	FormatujObashRubriky($f_id,$f_sloupec='',$f_kriterium='',$f_tridit_podle='prijmeni')
{


if($f_id!=""){  //zobraz zam�stnance  nahore
$VybranyUzivatel=CRubrika::VyberPolozku($f_id);

echo"<div class=\"centrovano\">    
    <table  class=\"novinka\" width=\"100%\">
 <tr class=\"nadpisv-n-c \" ><td><a href=\"?zobr=".''.'&amp;sloupec='.$_GET[sloupec].'&amp;hodnotasloupce='.$_GET[hodnotasloupce]." \" > <img src=\"../obr/zavri.gif\" alt=\"zavri.gif, 767B\" title=\"zav��t\" border=\"0\" height=\"20\" width=\"20\" class=\"obrvpravobezokraje\"> </a> 
  Profil zam�stnance
 </td></tr>";
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$VybranyUzivatel[id]."\"> </a>";
$adresafotky=$this->adresarfotek.$VybranyUzivatel[id].'.jpg';
if( (file_exists ($adresafotky)))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
  

  echo"<table>"; 
  echo" <tr><td>jm�no: </td> <td>".$VybranyUzivatel[jmeno]."  </td></tr>";
  echo" <tr><td>p��jmen�: </td> <td> ".$VybranyUzivatel[prijmeni]. "   </td></tr>";
     if ($VybranyUzivatel[titul]!='') {
   echo"<tr><td>titul: </td> <td>".$VybranyUzivatel[titul]."</td></tr>"; 
                                        } 
 echo"<tr><td>email: </td> <td> <a href=\"mailto:$VybranyUzivatel[email]\" > ".$VybranyUzivatel[email]." </a>  </td></tr>";
  echo"<tr><td> telefon:</td> <td> ".$VybranyUzivatel[telefon]. " </td></tr>";
   echo"<tr><td>kategorie: </td> <td>".$VybranyUzivatel[kategorie]."  </td></tr>";
  echo"<tr><td>aprobace <br />(pracovn� za�azen�): </td> <td>".$VybranyUzivatel[aprobace]."  </td></tr>";
  if ($VybranyUzivatel[funkce]!='') {
   echo"<tr><td> funkce zam�stnance:</td> <td> ".$VybranyUzivatel[funkce]. " </td></tr>";	
  }
  

   /*echo" <tr><td>pozn�mka: </td><td>".$VybranyUzivatel[poznamka][$i]."</td></tr>"; */
 echo"</table>"; 

echo"</td></tr></table>  
  </div><br />"; 

                    } //zobraz zam�stnance nahore
             {  //zobraz vse
$PoleRubrik=CRubrika::FormatujObashRubriky($f_sloupec,$f_kriterium,$f_tridit_podle);
 
  echo"<div class=\"centrovano\"> ";
  
     echo"                                           
    <table class=\"tabklasik\"  width=\"100%\" cellspacing=0 >
        <col class=\"prvni-sloupec-kontakty\">
        <col class=\"druhy-sloupec-kontakty\">
        <col class=\"treti-sloupec-kontakty\">
        <col class=\"ctvrty-sloupec-kontakty\">
 <tr><th>Jm�no </th><th>Aprobace  </th> <th>Email </td><th>Telefon </th></tr>";           
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
  
<span class=\"obrvlevo\"> ozna�it pro n�sledn� vymaz�n�:<input type=\"checkbox\" checked=\"checked\" name=\"smaz[]\" value=\"".$VybranyUzivatel[id]."\" /></span>
<span class=\"obrvpravo\">  editovat z�znam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$VybranyUzivatel[id]."\" class=\"tlacitko\" /></span> 
<br />
 </td></tr>";
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$VybranyUzivatel[id]."\"> </a>";
$adresafotky=$this->adresarfotek.$VybranyUzivatel[id].'.jpg';
if( (file_exists ($adresafotky)))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
  

  echo"<table>"; 
  echo" <tr><td>jm�no: </td> <td>".$VybranyUzivatel[jmeno]."  </td></tr>";
  echo" <tr><td>p��jmen�: </td> <td> ".$VybranyUzivatel[prijmeni]."  </td></tr>";
   echo"<tr><td>titul: </td> <td>".$VybranyUzivatel[titul]."</td></tr>";  
 echo"<tr><td>email: </td> <td> <a href=\"mailto:$VybranyUzivatel[email]\" > ".$VybranyUzivatel[email]." </a>  </td></tr>";
  echo"<tr><td> telefon:</td> <td> ".$VybranyUzivatel[telefon]. " </td></tr>";
  echo"<tr><td>kategorie: </td> <td>".$VybranyUzivatel[kategorie]."  </td></tr>";
  echo"<tr><td>aprobace <br />(pracovn� za�azen�): </td> <td>".$VybranyUzivatel[aprobace]."  </td></tr>";
   echo"<tr><td> funkce zam�stnance:</td> <td> ".$VybranyUzivatel[funkce]. " </td></tr>";  
   echo" <tr><td>pozn�mka: </td><td>".$VybranyUzivatel[poznamka]."</td></tr>"; 
 echo"</table>"; 

echo"</td></tr></table>  
  </div><br />";
                                             
                         }// kifu   
                         
else  {
echo"<div class=\"centrovano\">    
    <table  class=\"novinka\" width=\"80%\">
 <tr class=\"nadpisv-n-c \" ><td> 

<span class=\"obrvlevo\"> ozna�it pro n�sledn� vymaz�n�:<input type=\"checkbox\" name=\"smaz[]\" value=\"".$VybranyUzivatel[id]."\" /></span>
<span class=\"obrvpravo\">  editovat z�znam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$VybranyUzivatel[id]."\" class=\"tlacitko\" /></span> 
  <br /> </td></tr>";
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$VybranyUzivatel[id]."\"> </a>";
$adresafotky=$this->adresarfotek.$VybranyUzivatel[id].'.jpg';
if( (file_exists ($adresafotky)))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
  
 echo"<table>"; 
  echo" <tr><td>jm�no: </td> <td>".$VybranyUzivatel[jmeno]."  </td></tr>";
  echo" <tr><td>p��jmen�: </td> <td> ".$VybranyUzivatel[prijmeni]."  </td></tr>";
   echo"<tr><td>titul: </td> <td>".$VybranyUzivatel[titul]."</td></tr>";  
 echo"<tr><td>email: </td> <td> <a href=\"mailto:$VybranyUzivatel[email]\" > ".$VybranyUzivatel[email]." </a>  </td></tr>";
  echo"<tr><td> telefon:</td> <td> ".$VybranyUzivatel[telefon]. " </td></tr>";
  echo"<tr><td>kategorie: </td> <td>".$VybranyUzivatel[kategorie]."  </td></tr>";
  echo"<tr><td>aprobace <br />(pracovn� za�azen�) : </td> <td>".$VybranyUzivatel[aprobace]."  </td></tr>";
   echo"<tr><td> funkce zam�stnance:</td> <td> ".$VybranyUzivatel[funkce]. " </td></tr>";
   echo" <tr><td>pozn�mka: </td><td>".$VybranyUzivatel[poznamka]."</td></tr>"; 
 echo"</table>"; 
  
echo"</td></tr></table>
  
  </div><br />";


        }                          




               } //zobraz novinku nahore

else { //k zobraz v�e
$PoleRubrik=CRubrika::FormatujObashRubriky($f_sloupec,$f_kriterium,$f_tridit_podle);

//echo" po�et z�znam�:".$this->get_pocet_zaznamu()." <br />"; 
//echo" count:".count($PoleRubrik[id])." <br />"; 
     

if($oznvse=='ano') {// k ifu     
for ($i=0;$i<count($PoleRubrik[id]);$i++) {
 echo"<div class=\"centrovano\">    
    <table  class=\"novinka\" width=\"80%\">
 <tr class=\"nadpisv-n-c \" ><td> 
 
<span class=\"obrvlevo\"> ozna�it pro n�sledn� vymaz�n�:<input type=\"checkbox\" checked=\"checked\" name=\"smaz[]\" value=\"".$PoleRubrik[id][$i]."\" /></span>
<span class=\"obrvpravo\">  editovat z�znam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$PoleRubrik[id][$i]."\" class=\"tlacitko\" /></span> 
  <br /></td></tr>";
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$PoleRubrik[id][$i]."\"> </a>";
$adresafotky=$this->adresarfotek.$PoleRubrik[id][$i].'.jpg';
if( (file_exists ($adresafotky)))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
echo"<table>"; 
 echo"<tr><td> jm�no : </td><td>".$PoleRubrik[jmeno][$i]." </td></tr>  ";
 echo"<tr><td> p��jmen�: </td><td>".$PoleRubrik[prijmeni][$i]. " </td></tr>  ";
 echo"<tr><td>titul: </td><td>" .$PoleRubrik[titul][$i]."</td></tr>";
 echo"<tr><td>email:</td><td>  ".$PoleRubrik[email][$i]."  </td></tr>";
  echo"<tr><td>telefon:</td><td> ".$PoleRubrik[telefon][$i]."  </td></tr>";
   echo"<tr><td> kategorie: </td><td>".$PoleRubrik[kategorie][$i]."</td></tr>";
   echo"<tr><td> aprobace <br />(pracovn� za�azen�) : </td><td>".$PoleRubrik[aprobace][$i]."</td></tr>";
  echo" <tr><td>funkce zam�stnance: </td><td>".$PoleRubrik[funkce][$i]."</td></tr>";
  echo" <tr><td>pozn�mka: </td><td>".$PoleRubrik[poznamka][$i]."</td></tr>";     
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
<span class=\"obrvlevo\"> ozna�it pro n�sledn� vymaz�n�:<input type=\"checkbox\"  name=\"smaz[]\" value=\"".$PoleRubrik[id][$i]."\" /></span>
<span class=\"obrvpravo\">  editovat z�znam:<input type=\"submit\"  name=\"kohoeditovat\" value=\"".$PoleRubrik[id][$i]."\" class=\"tlacitko\" /></span>
 </td></tr>";
 
 
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$PoleRubrik[id][$i]."\"> </a>";
$adresafotky=$this->adresarfotek.$PoleRubrik[id][$i].'.jpg';
if( (file_exists ($adresafotky)))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" />";
echo"<table>"; 
 echo"<tr><td> jm�no : </td><td>".$PoleRubrik[jmeno][$i]." </td></tr>  ";
 echo"<tr><td> p��jmen�: </td><td>".$PoleRubrik[prijmeni][$i]. " </td></tr>  ";
 echo"<tr><td>titul: </td><td>" .$PoleRubrik[titul][$i]."</td></tr>";
 echo"<tr><td>email:</td><td>  ".$PoleRubrik[email][$i]."  </td></tr>";
  echo"<tr><td>telefon:</td><td> ".$PoleRubrik[telefon][$i]."  </td></tr>";
   echo"<tr><td>kategorie: </td><td>".$PoleRubrik[kategorie][$i]."</td></tr>";
   echo"<tr><td> aprobace<br />(pracovn� za�azen�): </td><td>".$PoleRubrik[aprobace][$i]."</td></tr>";
  echo" <tr><td>funkce zam�stnance: </td><td>".$PoleRubrik[funkce][$i]."</td></tr>"; 
  echo" <tr><td>pozn�mka: </td><td>".$PoleRubrik[poznamka][$i]."</td></tr>";     
 echo"  </table>";

  echo"</td></tr> <tr><td> 
  
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
     <div class=\"chyba\">Ozna�it v�echny z�znamy v cel� rubrice pro vymaz�n�?  <input type=\"submit\"  value=\"ano\" name=\"oznvse\" class=\"tlacitko\" />  <input type=\"submit\"  value=\"odzna�it\" name=\"oznvse\" class=\"tlacitko\" /></div>
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
global $akce,$codelat,$editzaznam ;
$PoleZaznamu=CRubrika::VyberPolozku($f_id); 
echo" Z�zanm �.:$PoleZaznamu[id] Datum proveden� z�zanmu: $PoleZaznamu[datum]
 <br />";
$adresafotky=$this->adresarfotek.$PoleZaznamu[id].'.jpg';
echo"
 <div class=\"centrovano\">
<form enctype=\"multipart/form-data\" action=\"$fzpracovani\" method=\"post\">";
if( file_exists ($adresafotky))
                echo "<div  class=\"centrovano\"><img src=\"$adresafotky\"   alt=\"n�hled_foto\" ><br />
                  P�ilo�en� foto.
                  </div> ";
      else echo"<div  class=\"centrovano\"> Foto nen� p�ilo�eno.
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
  echo"<tr><td>"; echo" jm�no:</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;
  case 'prijmeni':
  echo"<tr><td>"; echo"p��jmen�:</td>";
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
if ($PoleZaznamu[$this->sloupec[$i]]=='u�itel�') {echo"<option value=\"u�itel�\" selected=\"selected\">u�itel�</option>";} 
                       else {echo"<option value=\"u�itel�\">u�itel�</option>";}
	
if ($PoleZaznamu[$this->sloupec[$i]]=='thp pracovn�ci') {echo"<option value=\"thp pracovn�ci\" selected=\"selected\">thp pracovn�ci</option>";} 
                       else {echo"<option value=\"thp pracovn�ci\">thp pracovn�k</option>";} 
if ($PoleZaznamu[$this->sloupec[$i]]=='spr�vn� zam�stnanci') {echo"<option value=\"spr�vn� zam�stnanci\" selected=\"selected\">spr�vn� zam�stnanci</option>";} 
                      else {echo"<option value=\"spr�vn� zam�stnanci\">spr�vn� zam�stnanci</option>";}                             
if ($PoleZaznamu[$this->sloupec[$i]]=='hala') {echo"<option value=\"hala\" selected=\"selected\">hala</option>";} 
                       else{echo"<option value=\"hala\">hala</option>";}                        
if ($PoleZaznamu[$this->sloupec[$i]]=='j�delna') {echo"<option value=\"j�delna\" selected=\"selected\">j�delna</option>";} 
                       else {echo"<option value=\"j�delna\">j�delna</option>";}  

echo"
 </select>".$this->chyba[$i]."</td></tr>
               ";
            
            
            
     
         	break; 
         	
         	 case 'aprobace': 
      echo"<tr><td>";echo $this->sloupec[$i]; echo"<br />(pracovn� za�azen�):</td>";
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
         	  	  echo"<tr><td>"; echo"funkce zam�stnance:</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" />".$this->chyba[$i]."
   <a href=\"help_funkce.htm\" onclick=\" window.open('help_funkce.htm','_blank', 'width=200,height=450,menubar=no,scrollbars=yes,resizable=yes,left=0,top=0');return false\"> 
       <img src=\"../obr/help.gif\" alt=\"Dokumentace\" title=\"Dokumentace\" width=\"14\" height=\"14\"  /></a>       
        </td></tr>
            ";
         	  	 break;
         	  /*	  case 'funkceaj': 
      echo"<tr><td>"; echo"n�zev funkce v AJ:</td>";
        echo"<td class=\"chyba\"><input type=\"text\" size=\"25\" name=\"".$this->sloupec[$i]."\" value=\"".$PoleZaznamu[$this->sloupec[$i]]."\" />".$this->chyba[$i]."</td></tr>
            ";
         	break;*/
         	 case 'poznamka':
   
         echo"<tr><td>"; echo"pozn�mka:</td>";
        echo"
       <td class=\"chyba\">
        <textarea  rows=\"5\" name=\"".$this->sloupec[$i]."\" cols=\"40\">".$PoleZaznamu[$this->sloupec[$i]]."</textarea>".$this->chyba[$i]."</td></tr>
            ";
         	break;   
  
  
  
 
    
              
  default:
  	/* neprov�d� se nic*/
  	break;
  }

}  




if($this->pocetobr()<150) {echo"<tr><td colspan=\"2\"  class=\"centrovano\" > M��ete p�idat foto u�ivatele, 
max. 50kB,form�t *.jpg,doporu�en�  rozm�ry 120x150px <br />
   <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"50000\" /> 
  Vyberte obr�zek v po��ta�i:<input name=\"soubor\" type=\"file\"  accept=\"image/*\" />
  <span class=\"chyba\">     $this->chybafotky  </span>  </td></tr> 
                     ";  
                      if ($this->Upravafoto) {
              echo"<tr><td colspan=\"2\"  class=\"centrovano\" >
              upravit rozm�ry, 
���ka: <select name=\"sirka\" size=\"1\">   
<option value=\"120\">120</option>
<option value=\"150\">150</option>
<option value=\"100\">100</option> 
 </select> px ,  
 v��ka: <select name=\"vyska\" size=\"1\">

<option value=\"150\">150</option>
<option value=\"120\">120</option>
<option value=\"100\">100</option>
</select>  px 
              </td></tr> ";
 	
                     }  
                     
                      }
         else echo"<tr><td colspan=\"2\"  class=\"centrovano\" > Po�et obr�zk� v adres��i je v�t�� ne� 150 . Kapacita vy�erp�na.Sma�te star�� z�zanmy s obr�zky.</td></tr> ";


	          


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
 </div> <!--     centrov�no    -->
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
      <h4 > Telefonn� linky</h4>
  
 <br />  

<table class=\"tabklasik\" cellspacing=0>
    <col class=\"prvni-sloupec\">
    <col class=\"druhy-sloupec\">
    <col class=\"treti-sloupec\">
<tr align=\"left\" ><td class=\"hlavicka\">M�stnost</td><td class=\"hlavicka\">��slo</td><td class=\"hlavicka\"> Jm�no";
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

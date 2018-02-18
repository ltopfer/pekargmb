<?php
require("../spojenie.php");
require("../crubrika.php");

class CRubrika_Foto extends CRubrika
{
	// variables
	var $chybafotky='',$Upravafoto,$adresarfotek='../gympl_absol/foto/';


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
function 	NastavAdresarFotek($cil='../gympl_absol/foto/')
{	
$this->adresarfotek=$cil;	
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
function 	FormatujObashRubriky($f_id,$f_sloupec='',$f_kriterium='',$f_tridit_podle='id')
{


if($f_id!=""){  //zobraz zamìstnance  nahore
$VybranyUzivatel=CRubrika::VyberPolozku($f_id);

echo"<div class=\"centrovano\">    
    <table  class=\"novinka\" width=\"100%\">
 <tr class=\"nadpisv-n-c \" ><td><a href=\"?zobr= \" > <img src=\"../obr/zavri.gif\" alt=\"zavri.gif, 767B\" title=\"zavøít\" border=\"0\" height=\"20\" width=\"20\" class=\"obrvpravobezokraje\"> </a>
  Profil absolventa
 </td></tr>";
echo"<tr><td class=\"textv_n_c \"> <a name=\"".$VybranyUzivatel[id]."\"> </a>
<h4>{$VybranyUzivatel[titul]} {$VybranyUzivatel[jmeno]} {$VybranyUzivatel[prijmeni]} {$VybranyUzivatel[titulza]}  </h4>";
echo"<div class=\"textv_n_c \" >";
$adresafotky=$this->adresarfotek.$VybranyUzivatel[id].'.jpg';
$adresapdefka=$this->adresarfotek.$VybranyUzivatel[id].'.pdf';
if( (file_exists ($adresafotky)))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"{$VybranyUzivatel[titul]} {$VybranyUzivatel[jmeno]} {$VybranyUzivatel[prijmeni]} {$VybranyUzivatel[titulza]} \" /><br />";
 echo NL2BR($VybranyUzivatel[poznamka]);
 if (file_exists ($adresapdefka))echo"
                                 <hr />
<a href=\"$adresapdefka\" class=\"pdefko\" onclick=\"return !window.open(this.href)\">
 Pøíloha *.pdf
 </a>                                "; 
echo"</div>";
  

  

echo"</td></tr></table>  
  </div><br />"; 

                    } //zobraz zamìstnance nahore
             {  //zobraz vse
$PoleRubrik=CRubrika::FormatujObashRubriky($f_sloupec,$f_kriterium,$f_tridit_podle);
 
  echo"<div class=\"centrovano\"> ";
  
     echo"                                           
    <table class=\"tabklasik\"  width=\"100%\"  > <tr>";
          
for ($i=0;$i<count($PoleRubrik[id]) ;$i++) { 
 $odkaz=$this->Nazev.'.php?zobr='.$PoleRubrik[id][$i]; 

echo"<td valign=\"top\" class=\"centrovano\"> <table > <tr><td valign=\"top\" > <a name=\"".$PoleRubrik[id][$i]."\"> </a> ";$adresafotky=$this->adresarfotek.$PoleRubrik[id][$i].'.jpg';
if( (file_exists ($adresafotky)))echo"<a href=\" $odkaz \" ><img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"foto\" /></a>";
echo"<tr><td align=\"center\" valign=\"top\"><a href=\" $odkaz \" >".$PoleRubrik[titul][$i].' '.$PoleRubrik[jmeno][$i]. ' '.$PoleRubrik[prijmeni][$i].' '.$PoleRubrik[titulza][$i]."</a> </td> 
  </tr>";  
   echo"</table>"; 
   echo"</td>";
if (($i+1)%4==0)  echo"</tr><tr>";
                                             }

    echo" </table></div>";                                      
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





/*---------------------------Popis metody VyberSeznamNovinek()-----------------

Metoda VyberSeznamNovinek() vrací pole id, datum, nadpis novinek
------------------------------------------------------------------------------*/
 function VyberSeznamUzivatelu()
 {        
         
         @$vsechnyzazanamy=MySQL_Query("Select id,jmeno,prijmeni,trida FROM $this->Nazev  ORDER BY id ; ")OR DIE(MySQL_Error()) ; 
         while ($zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC)) {
          foreach($zaznam as $k => $v) {
         
               $ven[$k][]=$v;
         	
                         
                                       }
         
         
         
            
         
                                                                     }

            
                                                                     
return ($ven);
 } 
 


	
} // END class CNovinkyRubrika


  


?>

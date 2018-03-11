<?php
require("../spojenie.php");
require("../crubrika.php");

class CRubrika_Foto extends CRubrika
{
	// variables
	var $chybafotky='',$Upravafoto,$adresarfotek='../gympl_nasinej/foto/';


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
function 	NastavAdresarFotek($cil='../gympl_nasinej/foto/')
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
    <a name=\"".$VybranyUzivatel[id]."\"> </a>   
    
    <div class=\"novinka profil_studenta\">
    
    <a href=\"?zobr= \"><img src=\"../obr/zavri.gif\" alt=\"zavri.gif, 767B\" title=\"zavrít\" border=\"0\" height=\"20\" width=\"20\" class=\"obrvpravobezokraje\"></a> 
    
        <h5>Profil studenta: {$VybranyUzivatel[jmeno]} {$VybranyUzivatel[prijmeni]} {$VybranyUzivatel[trida]}</h5>";
    
    $adresafotky=$this->adresarfotek.$VybranyUzivatel[id].'.jpg';
    if( (file_exists ($adresafotky)))echo"<img src=\"$adresafotky\"  class=\"obrvlevo\" alt=\"{$VybranyUzivatel[jmeno]} {$VybranyUzivatel[prijmeni]}\" /> 
    <p>{$VybranyUzivatel[poznamka]}</p>";
    echo"</div>
    </div>
    <br>"; 
} //zobraz zamìstnance nahore
             {  //zobraz vse
$PoleRubrik=CRubrika::FormatujObashRubriky($f_sloupec,$f_kriterium,$f_tridit_podle);
echo"<div class=\"centrovano vypis_nasinej\">
";          
for ($i=0;$i<count($PoleRubrik[id]) ;$i++) { 
    $odkaz=$this->Nazev.'.php?zobr='.$PoleRubrik[id][$i].'#'.$PoleRubrik[id][$i]; 
    $adresafotky=$this->adresarfotek.$PoleRubrik[id][$i].'.jpg';
    
    echo "<div class=\"nejstudent\">
    ";
    if (file_exists ($adresafotky)) echo"<a href=\" $odkaz \" ><img src=\"$adresafotky\" alt=\"foto\" /></a>";
    echo"<a href=\" $odkaz \" ><p>".$PoleRubrik[jmeno][$i]. ' '.$PoleRubrik[prijmeni][$i].'<br /> '.$PoleRubrik[trida][$i]."</p></a>";

    echo "
    </div>";                                      
                    } //zobraz vse                         
                 echo "
                 </div>";
             }                                              
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

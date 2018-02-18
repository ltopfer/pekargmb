<?php

/*---------------------------Popis t��dy Crubrika-------------------------------

 Popis t��dy Crubrika :Slou�� k manipulaci s daty v tabulce MySQL datab�ze
Konfigurace tabulky v datab�zi: prvn� sloupec tabulky je id 
                                ostatn� sloupce jsou libovoln�.

Popis atribut� t��dy:
Nazev....N�zev  zpracov�van� tabulky v datab�zi
pocetsloupcu...po�et sloupc� v tabulce
sloupec...pole s n�zvy sloupc� tabulky
typsloupce...pole s identifik�tory typ� jednotliv�ch sloupc� tabulky
chyba...pole chybov�ch hl�en� p��slu�en�c� ke sloupc�m tabulky, pou��v� se 
p�i vyhodnocov�n� odeslan�ho formul��e
------------------------------------------------------------------------------*/

class CRubrika
{
var $Nazev,$pocetsloupcu,$sloupec,$typsloupce,$chyba,$Foto,$Upravafoto;

function CRubrika($Nazev='Bez n�zvu')
         {
         $this->Nazev=$Nazev;         
        $tablename=$this->Nazev; 
$query = "SHOW FULL COLUMNS FROM $tablename"; 
$result = mysql_query($query) or die("N�kde je chyba"); 

$i=0;
while ($row = MySQL_Fetch_Array($result)) 
{ 
//echo "$row[0]<br />"; 
$i++;
$sloupec[]=$row[0];
$typsloupce[]=$row[1];
$chyba[]="*";
}
$pocetsloupcu=$i;
  $this->pocetsloupcu=$pocetsloupcu;
  $this->sloupec=$sloupec;
  $this->typsloupce=$typsloupce;
  $this->chyba=$chyba;
         }    
/*---------------------------Popis metody inject_addslashes($str)-------------------

Metoda injection
------------------------------------------------------------------------------*/           
function inject_addslashes($str) {
    return (get_magic_quotes_gpc() ? $str : addslashes($str));
   // return (addslashes($str));
}
             
/*---------------------------Popis metody get_pocet_zaznamu()-------------------

Metoda get_pocet_zaznamu() vrac� po�et z�znam� v p��slo�n� tabulce
------------------------------------------------------------------------------*/        
 function get_pocet_zaznamu()
         {     
 @$vsechnyzazanamy=MySQL_Query("Select * FROM $this->Nazev  ORDER BY id;  ")OR DIE(MySQL_Error()) ;
 $pocetzaznamu=MYSQL_NUm_Rows($vsechnyzazanamy);            
         return( $pocetzaznamu);
          }


/*--------------------------Popis metody Pridej_do_Rubriky($fpole)--------------

Metoda  Pridej_do_Rubriky($fpole) p�id� polo�ku ur�enou parametrem $fpole do 
p��slu�n� tabulky a vrac� id p�idan� polo�ky
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
for ($i=2;$i<$this->pocetsloupcu ;$i++ )  $pomval=$pomval.'\',\''.$fpole[$i];
 $pomval=$pomval.'\'';  
//echo"---<br /> pomval je: $pomval ---<br /> ";
@$vlozeni=MySQL_Query("INSERT INTO $this->Nazev VALUES ($pomval);" ) OR DIE(MySQL_Error()) ;
if(!$vlozeni) $osp=-1;
return ($osp);
}


/*--------------------------Popis metody Smaz_z_Rubriky($f_id)--------------

Metoda ma�e polo�ku z rubriky a vrac� Po�adovan� ��slo smaz�n�
------------------------------------------------------------------------------*/
function Smaz_z_Rubriky($f_id)
{
$f_id=$this->inject_addslashes($f_id);
$f_id=intval($f_id);  
@$mazani=MySQL_Query("DELETE FROM $this->Nazev WHERE id=$f_id ;")OR DIE(MySQL_Error()) ;

return ($f_id);
}


/*---------------------------Popis metody Vyber_Polozku($f_id)------------------

Metoda Vyber_Polozku($f_id) vybere jednu polo�ku z tabulky, polo�ka je ur�ena
podm�nkou id=$f_id.V p��pad� , �e  $f_id nen� ur�eno, vybere se polo�ka 
je� m� hodnotu uvodni nastavenu na ano
------------------------------------------------------------------------------*/
 function VyberPolozku($f_id)
{
$f_id=$this->inject_addslashes($f_id);
$f_id=intval($f_id);
@$editradka=MySQL_Query("SELECT *  FROM  $this->Nazev WHERE id=$f_id ;")OR DIE(MySQL_Error()) ; 
$zazname=MYSQL_Fetch_Array($editradka, MYSQL_ASSOC);       
foreach($zazname as $k => $v) $ven[$k]=$v;                                    	
return ($ven);
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
    $polozka=$this->sloupec[$i].'=\''.$f_updatepole[$i].'\'';
  if($i!=$this->pocetsloupcu-1)$pomval=$pomval.$polozka.','; else $pomval=$pomval.$polozka;
                                       }
//echo"---<br /> pomval je: $pomval ---<br /> ";

@$uprava=MySQL_Query("UPDATE $this->Nazev SET $pomval  WHERE id=$f_id ;")OR DIE(MySQL_Error()) ; 

return ($f_id);
}
/*---------------------------------------------------------------------------*/ 
   

/*---------------------------Popis metody FormatujObashRubriky($f_kategorie='')-

Metoda vypisuje obsah tabulky a nab�z� z�kladn� form�tov�n�:
id...neform�tov�no
datum,autor: v�stup ve form� <span class=\"datum, autor\"> hodnota</span>
email      :v�stup ve form� <a href=\"mailto:$v\" class=\"email\" > hodnota </a>
ostan� :v�stup ve form� <div class=\"jmeno_sloupce\"> hodnota</div>
V p��pad�, �e tabulka v MySQL , tak uno��uje v�b�r 
z�znam� ze sloupce $f_sloupec spl�uj�c� $f_kriterium
------------------------------------------------------------------------------*/
 function FormatujObashRubriky($f_sloupec='',$f_kriterium='', $f_tridit_podle='id DESC',$f_vlastnik='')
{  
$f_sloupec=$this->inject_addslashes($f_sloupec);
$f_kriteriumc=$this->inject_addslashes($f_kriterium);
$f_tridit_podle=$this->inject_addslashes($f_tridit_podle);
$f_vlastnik=$this->inject_addslashes($f_vlastnik);

if ($f_vlastnik!='') {
if ($f_kriterium!=''&& $f_sloupec!='') {
@$vsechnyzazanamy=MySQL_Query("Select * FROM $this->Nazev WHERE vlastnik='$f_vlastnik' AND $f_sloupec='$f_kriterium' ORDER BY $f_tridit_podle ; ")OR DIE(MySQL_Error()) ;
	
}    else @$vsechnyzazanamy=MySQL_Query("Select * FROM $this->Nazev WHERE vlastnik='$f_vlastnik' ORDER BY  $f_tridit_podle ; ")OR DIE(MySQL_Error()) ;

	
                       }   
 else  {
if ($f_kriterium!=''&& $f_sloupec!='') {
@$vsechnyzazanamy=MySQL_Query("Select * FROM $this->Nazev WHERE $f_sloupec='$f_kriterium' ORDER BY $f_tridit_podle ; ")OR DIE(MySQL_Error()) ;
	
}    else @$vsechnyzazanamy=MySQL_Query("Select * FROM $this->Nazev  ORDER BY  $f_tridit_podle ; ")OR DIE(MySQL_Error()) ;
        }
         while ($zaznam=mysql_fetch_array ($vsechnyzazanamy, MYSQL_ASSOC)) {
         foreach($zaznam as $k => $v) {
         switch ($k) {
        
         	case 'datum':
         	case 'jmeno':
        	case 'prijmeni':
         	case 'titul':
         	case 'autor':
         	     $ven[$k][]="<span class=\"$k\">$v</span>"; 
         	break;
          case 'email':
                $ven[$k][]="<a href=\"mailto:$v\" class=\"$k\" >$v</a>";
          	break;
         default:
         	$ven[$k][]= $v;
         	break;
                     }
                         
                                       }
            
                                                                       }
return ($ven);
 }         
/*---------------------------------------------------------------------------*/ 


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
for ($i=0;$i<$this->pocetsloupcu ;$i++ )  $proslo[$i]=1;

for ($i=2;$i<$this->pocetsloupcu ;$i++ ) {

if( !($this->chyba[$i]=='')){ 

if($kontrpole[$i]=='') {$this->chyba[$i]="chyb� ". $this->sloupec[$i];$proslo[$i]=0;}
elseif($this->sloupec[$i]=='prezdivka'){
                                                    
  if(!(ereg("^[a-zA-Z0-9]+$",$kontrpole[$i]))){$this->chyba[$i]="v p�ezd�vce zak�zan� znaky";$proslo[$i]=0; }
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
                                                       
                      else {$this->chyba[$i]="*";$proslo[$i]=1; }                           
                                               

                  }
                  
                                           }
$soucin=1;
for ($i=2;$i<$this->pocetsloupcu ;$i++ )  $soucin=$soucin*$proslo[$i] ;
$zaver = $soucin==0 ? false : true;
return $zaver ;
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
------------------------------------------------------------------------------*/

function Formular_obec($fsloupec,$fzpracovani='formular.php')
{ 
echo"
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

 echo"  
 <tr><td colspan=\"2\"  class=\"centrovano\" >                
<input type=\"hidden\" name=\"odeslano\" value=\"true\" />
<br />
<input type=\"submit\"  value=\"odeslat\" name=\"dotaznik\" class=\"tlacitko\" />
<hr />
 <input type=\"reset\" value=\"smazat neodeslan� �daje\" class=\"tlacitko\" />
  </td></tr>
</table>
</form>
   ";
 }


/*---------------------------Popis metody Vyber_volitelna_pole($fsloupec)-------

Metoda Vyber_volitelna_pole($fsloupec) umo��uje ozna�it n�kter� �daje ve
 formul��i jako nepovinn� tak, �e prom�nnou chyba[p��slu�n�ho sloupce] p�estav�
 z hodnoty '*' na hodnotu ''. T�m ovlivn� zobrazen� formul��e , u t�chto udaj�
 ce nezobraz� '*' .                                                  
------------------------------------------------------------------------------*/
function Vyber_volitelna_pole()
{ 
  for ($i=0;$i<$this->pocetsloupcu ;$i++ ) {
  //$chyba[$i]='*';  

  switch ($this->sloupec[$i]) {
  
           
   case 'text':
    case 'poznamka':
   $this->chyba[$i]='';
        
         	break;          
              
  default:
  $this->chyba[$i]='*';
  	break;
                              }

                                           }  

 }


/*---------------------------Popis metody Vyber_na_Tisk($f_id)------------------

Metoda Vyber_na_Tisk($f_id) form�tuje z�znam  ur�en� parametrem $f_id pro tisk                                        
------------------------------------------------------------------------------*/ 
function Vyber_na_Tisk($f_id)
{ 
$PoleZaznamu=$this->VyberPolozku($f_id); 

echo"
  <div class=\"centrovano\">   
<table border=\"0\"  width=\"80%\" class=\"centrovano\" >
    "; 
  for ($i=0;$i<$this->pocetsloupcu ;$i++ ) {  
    
  switch ($this->sloupec[$i]) {
  case 'nadpis':
  case 'autor':
   case 'datum':
  case 'email': 
      echo"<tr><td align=\"right\">";echo $this->sloupec[$i]; echo":</td>";
        echo"<td align=\"left\"> ".$PoleZaznamu[$this->sloupec[$i]]." </td></tr> ";
         	break;
           
   case 'text':
   
         echo"<tr><td colspan=\"2\" class=\"textv_n_c\">".NL2BR($PoleZaznamu[$this->sloupec[$i]])."</td></tr>";
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
/*---------------------------Popis metody Overeni_uzivatele($fuser,$fpass)------

Metoda Overeni_uzivatele($fuser,$fpass) ov��� , zda u�ivatel s
 prezdivkou $fuser  a heslem  $fpass je v datab�zi, v kladn�m p��pad� vrac� true
 jinak false  
 
 !!!!!Pozor nepracuje se stabulkou this->Nazev ale s 
 tabulkou u�ivatel� $tabulka_uzivatelu                                    
------------------------------------------------------------------------------*/  
function Overeni_uzivatele($ftabulkauzivatelu,$fuser,$fpass,$fprava_na_rubriku='')
{ 

$fuser=addslashes($fuser);
$fpass=addslashes($fpass);
$zaver=false;  
if ($fprava_na_rubriku=='') {
@$uzjetam=MySQL_Query("SELECT *  FROM  $ftabulkauzivatelu  WHERE prezdivka='$fuser' AND heslo='$fpass' ;")OR DIE(MySQL_Error());	
} 
else @$uzjetam=MySQL_Query("SELECT *  FROM  $ftabulkauzivatelu  WHERE prezdivka='$fuser' AND heslo='$fpass'AND $fprava_na_rubriku='ano' ;")OR DIE(MySQL_Error()) ;
 
$pocet_zaznamu=MYSQL_NUm_Rows($uzjetam);                                
 if(($uzjetam)&&($pocet_zaznamu>0)){$zaver=true;  }
            	
                        
return $zaver ;
}


/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/

}
/*--Konec t��dy rubrika obecn�-----*/ 






<?php
$soubor=__FILE__;
require "hlavicka.php";
?>  <h4> Maturita 2017/2018 </h4>
<div class="obrvlevo">
<a href="maturita_nova_18/2018_harmonogram_maturitnich_zk.pdf" target="_blank">2018 Harmonogram maturitn�ch zkou�ek *.pdf</a>       <br>    <br>
<a href="maturita_nova_18/kanon.pdf" target="_blank">K�NON TITUL� Z �ESK� A SV�TOV� LITERATURY K&nbsp;�STN� ZKOU�CE 2017-2018 *.pdf</a>       <br>    <br>

<a href="maturita_nova_18/formalni_pozadavky_MP_2017_18.pdf" target="_blank">Formaln�_po�adavky_MP_2017_18 *.pdf</a>     <br>

<a href="maturita_nova_18/titulniStrankaKoty.pdf" target="_blank">Tituln� str�nka k�ty *.pdf</a>

  <br>
  <a href="maturita_nova_18/logo1cm.png" target="_blank">logo1cm.png</a><br>     
   <a href="maturita_nova_18/logo6cm.png" target="_blank">logo6cm.png</a><br> 
 <br> 


 <a href="maturita_nova_18/zadani_maturitni_prace.pdf" target="_blank">Zad�n� maturitn� pr�ce</a>          
  <br>          
            
  <br> 
        
  <a href="maturita_nova_18/seznam_certifikovanych_zkousek_2018.pdf" target="_blank">2018 Seznam certifikovan�ch zkou�ek ur�en�ch k nahrazov�n� zkou�ek z ciz�ho jazyka profilov� ��sti MZ</a>          
  <br>          
            
  <br>        
  <br>        
  <br>        
  <br>
       
  <br><h4> T�mata maturitn�ch prac�   </h4>    
<?php
$bb=obsah_adresare('maturita_nova_18/okruhy');
sort($bb);
echo"<ul>";
for ($i=0;$i<count($bb) ;$i++ ) {
echo"<li><a href=\"maturita_nova_18/okruhy/$bb[$i]\" target=\"_blank\"> $bb[$i] </a> </li> \n";
	
}
echo"</ul>";

        ?>  
       
        
           <h4> T�mata �koln�ch zku�ebn�ch �loh</h4>    
<?php

$zku=obsah_adresare('maturita_nova_18/temata_zk_uloh');
sort($zku);
echo"<ul>";
for ($i=0;$i<count($zku) ;$i++ ) {
echo"<li><a href=\"maturita_nova_18/temata_zk_uloh/$zku[$i]\" target=\"_blank\"> $zku[$i] </a> </li> \n";
	
}
echo"</ul>";

        ?>     
</div>    
<div class="obrvpravo">
<?php
$cislofotky=rand(1, 9);
$adresafotky='../budova_bbb/'.$cislofotky.'.jpg';
echo"
<img src=\"$adresafotky\" width=\"300\" class=\"obrvpravo\" />
";
        ?>    
</div>     
<?php
require "paticka.php";
?>
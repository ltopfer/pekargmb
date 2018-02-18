<?php 
$soubor=__FILE__;
require "hlavicka.php";

  ?> 
 


<?php
echo"<h4> Výchovný poradce  </h4> <br />";
  
$zobr=$_GET[zobr];
if ($zobr=='') {
echo"
<div class=\"centrovano\">
 

  <b>Mgr. Dana Patoèková</b> <br>
  <table width=\"90%\" align=\"center\" border=\"0\">
    <tr align=\"left\"> <td align=\"left\"><b>kabinet è. 117 </b>– tel. 326375957 <br></td></tr>
    <tr align=\"left\"> <td align=\"left\"><b>kabinet è. 302 </b>- tel. 326375974 – <b>konzultaèní hodiny:</b> støeda – 11.40 – 13.25 <br></td></tr>
    <tr align=\"left\"> <td align=\"left\"><b>Email:</b> <a href=\"mailto:patockova@pekargmb.cz \">patockova@pekargmb.cz </a><br></td></tr>
  </table>



<hr>

</div>
<b>Žákùm školy a jejich rodièùm je poskytována výchovnou poradkyní poradenská pomoc:  
</b>
 <ul>
   <li> pøi øešení rùzných výchovných, prospìchových a dalších problémù (problémy v osobních vztazích nebo ve vztazích se spolužáky, neprospìch ve škole, problémy se zvládáním uèiva, otázky volby pomaturitního studia); 
</li>
   <li>v problematice inkluzívního vzdìlávání na gymnáziu (tj. vzdìlávání žákù se speciálními vzdìlávacími potøebami a žákù nadaných), a to ve spolupráci s pedagogicko-psychologickou poradnou a speciálním pedagogickým centrem, s tøídním uèitelem a uèiteli jednotlivých pøedmìtù;  
 </li>
   <li>pøi øešení problémù spojených se sociálnì patologickými jevy (užívání návykových látek, šikana, záškoláctví, patologické hráèství, poruchy pøíjmu potravy, …). 
</li>
 </ul>

  <br>
<b>Žákùm školy a jejich rodièùm jsou poskytovány výchovnou poradkyní informace:  
</b> <br><br>
 <ul>
   <li> o pøijímacím øízení na gymnázium, formì studia a zamìøení; 
</li>
   <li> o možnostech dalšího studia na VŠ a VOŠ – informaèní materiály, pøihlášky na školy a termíny jejich podání, informace o úspìšnosti pøi pøijímacích zkouškách; 
</li>
   <li> o dalších organizacích, které žákùm a jejich rodièùm mohou poskytnout odbornou pomoc pøi øešení osobních nebo rodinných problémù. 
</li>
 </ul>


<hr>



";
	
}
 
 $pro_vypis=new CRubrika_Foto('gympl_poradce');
 $pro_vypis->NastavAdresarFotek('foto/');                                   
$pro_vypis->FormatujObashRubriky($zobr); 




require "paticka.php";
?>

    

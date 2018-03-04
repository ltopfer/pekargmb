<?php  
  header('Expires: ' . gmdate('D, d M Y H:i:s') . '  GMT');
  header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . '  GMT');
  header('Content-Type: text/xml; charset=utf-8');
?>
<?php echo"<?xml version=\"1.0\" encoding=\"utf-8\"?>"?>  
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">     
  <channel>         
    <title>Gymnázium Dr. J. Pekaře</title>         
    <link>http://www.pekargmb.cz/</link>         
    <webMaster>pekargmb@pekargmb.cz (Gymnázium Dr. J. Pekaře)</webMaster>         
    <category>škola, gymnázium, vzdělávání, výuka, školství</category>         
    <docs>http://backend.userland.com/rss</docs>         
    <lastBuildDate><?php echo gmdate("D, d M Y H:i:s")." GMT"; ?></lastBuildDate>
    <description>Novinky z Gymnázia Dr. Josefa Pekaře</description>
    <language>cs-CZ</language>
    <atom:link href="http://www.pekargmb.cz/rss/" rel="self" type="application/rss+xml" />         
    <image>  
        <?php
        require_once '../adresawebu.php';  
        echo "<url>{$adresawebu}obr/logoskola-kruh.png</url>"; 
        ?>
      <title>Gymnázium Dr. J. Pekaře</title>             
      <link>http://www.pekargmb.cz/</link>         
    </image>
<?php
require_once '../spojenie.php';
  mysql_query("SET NAMES'utf8'"); 
   $sql = "SELECT * FROM gympl_novinky  WHERE archiv='ne' ORDER BY id  DESC";
    $res = mysql_query($sql);
    while($rec = mysql_fetch_array($res)) {
            ?>         
    <item>  
      <title><?php echo $rec["nadpis"]; ?></title>             
      <link><?php
       echo $adresawebu.'gympl_novinky/gympl_novinky.php?zobr='.$rec["id"];
      ?></link>             
      <guid>        
        <?php
        echo $adresawebu.'gympl_novinky/gympl_novinky.php?zobr='.$rec["id"]; 
       // echo $rec["URL"];
         ?>      
      </guid>             
      <description>
<?php 
        if( file_exists ("../gympl_novinky/foto/".$rec["id"].".jpg"))
            echo "<![CDATA[<img src=\"{$adresawebu}gympl_novinky/foto/{$rec["id"]}.jpg\">]]>";           
            
$ukazka=htmlspecialchars(strip_tags($rec["text"])).'......( Autor příspěvku : '. $rec["autor"].')';
     //$ukazka=SubStr(htmlspecialchars(strip_tags($rec["text"])),0,60).'...'. $rec["autor"];
     echo $ukazka;
                        ?>      
      </description> 
<author><?php echo $rec["email"] . " (" . $rec["autor"] . ")" ?> </author>            
      <pubDate>        
        <?php
        $pieces = explode (".", $rec["datum"]);              
        $b_cas=mktime (1,1,0,$pieces[1],$pieces[0],$pieces[2]);              
        //$datump=Date('Y'.'-'.'m'.'-'.'d',$b_cas) ;  
        $datump=Date('D, d M Y H:i:s O',$b_cas);        
        echo $datump ;         
          ?>      
      </pubDate>         
    </item>
<?php
    }
mysql_query("SET NAMES'cp1250'"); 
            ?>
  </channel>
</rss>        

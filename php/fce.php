<?PHP
function loadStyle() 
{ 
  if (isset($_GET["style"])) 
  { 
    return $_GET["style"]; 
  } 
  else 
  { 
    return (isset($_COOKIE["style"]) ? $_COOKIE["style"] : ""); 
  } 
} 


function writeLink($name) 
{ 
global $adresawebu;
if(file_exists('theme/'.$name.'/stilhl.css')||
file_exists('../theme/'.$name.'/stilhl.css')//||
//file_exists('../../theme/'.$name.'/stilhl.css')
  ) 
    {
   $adresacss=$adresawebu.'theme/'.$name.'/stilhl.css';
    
    }
                            
 else {

$adresacss=$adresawebu.'stilhl.css';

 }
     echo("<link href=\"$adresacss\" type=\"text/css\" rel=\"stylesheet\" >\n"); 
} 


function writeLinkSmobil($name) 
{ 
global $adresawebu;
if(file_exists('theme/'.$name.'/relativni/stilhl.css')||
file_exists('../theme/'.$name.'/relativni/stilhl.css')//||
//file_exists('../../theme/'.$name.'/stilhl.css')
  ) 
    {
   $adresacssrel=$adresawebu.'theme/'.$name.'/relativni/stilhl.css';
    $adresacssmobil=$adresawebu.'theme/'.$name.'/mobilni/stilhl.css';
    $adresajs=$adresawebu.'theme/'.$name.'/skryjaodkryj.js';
    echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen and (min-width: 900px)\" href=\"$adresacssrel\" />\n
     <link rel=\"stylesheet\" type=\"text/css\" media=\"screen and (max-width: 899px)\" href=\" $adresacssmobil\" /> \n
      <script src=\"$adresajs\"></script>\n";

    }
                            
 else {

$adresacss=$adresawebu.'stilhl.css';
  echo("<link href=\"$adresacss\" type=\"text/css\" rel=\"stylesheet\" >\n");

 }
    
} 





/*****************************************************************
  pøeète obsah adresáøe
***********************************************************************/

 function obsah_adresare($fadresarp='theme')
 {
 if (file_exists ($fadresarp)) $fadresar=$fadresarp;
        elseif (file_exists ($fadresar='../'.$fadresarp)) $fadresar='../'.$fadresarp;
        else $fadresar='../../'.$fadresarp;
   	
  
 $handle=opendir($fadresar);
while (false!==($file = readdir($handle))) {
    if ($file != "." && $file != "..") {
        //echo "$file\n <br>";
        $a[]=$file;
    }
}
closedir($handle);
                                    
                               
return($a);	
}


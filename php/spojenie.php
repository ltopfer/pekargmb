<?PHP $host='mysql.hostinger.cz';$db='u882995137_gmb';$user='u882995137_gmb';$password='hostingpokus123';
$spojeni=MySQL_Connect($host,  $user, $password)OR DIE(MySQL_Error());
 MySQL_Select_DB($db);
 mysql_query("SET NAMES'cp1250'");

$superuser='admintopfer';$superpass='topfer';
 ?>

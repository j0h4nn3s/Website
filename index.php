<?php
    include('config.php');

    include('functions.php');

    include('init.php');

    
    $title='Home';
	//$dbh = mysql_connect(SQL_HOST, SQL_USER, SQL_PASS);
	//mysql_select_db(SQL_DB, $dbh);
	$result = mysql_query("SELECT * FROM `folder` ORDER BY 'id' DESC LIMIT 1");
	$folder = mysql_fetch_row($result);
    $visibility = "visible";
	printpictures($folder); 
?>

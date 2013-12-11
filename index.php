<?php
    include('config.php');

    include('functions.php');

    include('init.php');

    
    $title='Home';
	$dbh = mysql_connect($SQL_HOST, $SQL_USER, $SQL_PASS);
	mysql_select_db($SQL_DB, $dbh);
//	$result = mysql_query ("SQL Anweisung",$dbh);
	mysql_close($dbh)
	//get ordner
	//get array mit id der bilder
	//anzahl der bilder speichern
	//get ordner name + date + description
    //echo '<div id="wrapper">
    //        <div class="folder">
    //            <h2>Ordnername</h2>
    //            <h3>time and date</h3>
	//schleife für anzahl der bilder
//                <div class="col">
//                  <a href=#><img src="resized/01.jpg" /></a>
//                    <a href=#><img src="resized/02.jpg" /></a>
 //                   <a href=#><img src="resized/03.jpg" /></a>
//                </div>
//                <div class="col">
 //                   <a href=#><img src="resized/04.jpg" /></a>
//                    <a href=#><img src="resized/05.jpg" /></a>
//                    <a href=#><img src="resized/06.jpg" /></a>
//                </div>
//                <div class="col">
//                    <a href=#><img src="resized/07.jpg" /></a>
//                    <a href=#><img src="resized/08.jpg" /></a>
//                    <a href=#><img src="resized/09.jpg" /></a>
//                </div>
//            </div>
//            </div>
//        </div>';
?>

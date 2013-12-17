<?php
    function openDatabaseConnection() {
        if ($con = @mysql_connect(SQL_HOST, SQL_USER, SQL_PASS)) {
            if (@mysql_select_db(SQL_DB)) {
                mysql_query('SET NAMES utf8;');
                return $con;
            }
        }
        
        echo '<p>Unable to connect to database. Please try again later.</p>';

        exit();
    }

    function closeDatabaseConnection($con) {
        mysql_close($con);
    }

    function printContent() {
        $output = file_get_contents('template.html', FILE_USE_INCLUDE_PATH);
        //output buffer
		$output = str_replace('{content}', ob_get_contents(), $output);
        
        // title
        if (true) {
            $title = $GLOBALS['title'];

            if (strlen($title) > 0) {
                $output = str_replace('{title}', "Photo in the Box &rsaquo; $title", $output);
            }
            else {
                $output = str_replace('{title}', 'Photo in the Box', $output);
            }
        }
        //heading 
        if (true) {
            $title = $GLOBALS['title'];

            if (strlen($title) > 0) {
                $output = str_replace('{heading}', "Photo in the Box - $title", $output);
            }
            else {
                $output = str_replace('{heading}', 'Photo in the Box', $output);
            }
        }
        
        // menu
        if (true) {
            $menu = array(
              'Home' => 'index.php',
              'Fotos' => 'fotos.php', 
              'Archiv' => 'archiv.php',
              'Infos' => 'infos.php',
              'Über' => 'uber.php'
            );

            foreach ($menu as $text => $page) {
                if (substr($_SERVER['SCRIPT_NAME'], 1) == $page) {
                    $html_for_menu .= "<li class='active'><a href='$page'>$text</a></li>";
                }
                else {
                    $html_for_menu .= "<li><a href='$page'>$text</a></li>";
                }
            }

            $output = str_replace('{nav}', "<ul>$html_for_menu</ul>", $output);
        }
        
        // login
        global $user;
        if (true) {
            if (!(isset($user))) {
                $htmllogin = "<a href='/login.php'>Anmelden</a> | <a href='register.php'>Registrieren</a>";
            }
            else {
                $uname = $user['first_name'];
                $htmllogin = "Willkommen, <a href='user.php'>$uname</a> | <a href='logout.php'>Logout</a>";
                }
            $output = str_replace('{login}',$htmllogin, $output);
        }
        if (true) {
            $output = str_replace('{visibility}',$GLOBALS['visibility'], $output);
        }
        
        
        ob_end_clean();
        echo $output;
    }
function printpictures($resultfolder) {
	//get ordner
	//get array mit id der bilder
	//anzahl der bilder speichern
	//get ordner name + date + description
	echo '<div id="large"><div id="wrapper">
            <div class="folder">
				<h2>'.$resultfolder[1].'</h2>
                <h3>'.$resultfolder[3].'</h3>';
	$result02 = mysql_query("SELECT * FROM `pictures` WHERE fid=$resultfolder[0]");
	$allRows = array();
	while($row = mysql_fetch_row($result02)) {
		$allRows[] = $row;
	};
	$count01=count($allRows);
	if ($count01%3==0) {
		$count02=$count01/3;
	}
	else {
		$count02=floor($count01/3);
	}
	//schleife für anzahl der bilder
	for ($i=0; $i<($count02); $i++) {
		echo '<div class="col">';
		for ($x=0; $x<3; $x++) {  
			echo '<img src="'.$allRows[($i*3+$x)][2].'" id="'."img-".$allRows[($i*3+$x)][0].'" />';
		}
		echo '</div>';
	}
	echo '<div class="col">';
	for ($y=0; $y<($count01%3); $y++) {
		echo '<img src="'.$allRows[($count02*3+$y)][2].'" id="'."img-".$allRows[($count02*3+$y)][0].'"/>';
	} 
	echo '</div></div></div></div>';
}     
?>
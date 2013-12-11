<?php
    function openDatabaseConnection() {
        if ($con = @mysql_connect(SQL_HOST, SQL_USER, SQL_PASS)) {
            if (@mysql_select_db(SQL_DB)) {
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
        
        // menu
        if (true) {
            $menu = array(
              'Home' => 'index.php',
              'Fotos' => 'seite2.php', 
              'Archiv' => 'seite3.php',
              'Infos' => 'seite4.php',
              'Über' => 'seite5.php'
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
        
        ob_end_clean();
        echo $output;
    }
?>

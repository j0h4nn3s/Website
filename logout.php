<?php
    include('config.php');
    include('functions.php');
    include('init.php');

    if (isset($user)) {
        unset($user);

        setcookie('id', '', 0);
        setcookie('password', '', 0);
        
        $referer = strlen($_SERVER['HTTP_REFERER'])>0 ? $_SERVER['HTTP_REFERER'] : index.php;        
        header("Refresh: 0; url=$referer"); 
        echo "<div id='small'><div class='text'>Erfolgreich abgemeldet!<br/>Du wirst automatisch weitergeleitet</div></div>";
    }
    else {
        echo "<p>Du bist nicht angemeldet.</p>";
        echo "<p><a href='login.php'>Login</a></p>";
    }
?>

<?php
    include('config.php');
    include('functions.php');
    include('init.php');
    $title='Abmelden';
    $visibility="hidden";
    
    if (isset($user)) {
        unset($user);

        setcookie('id', '', 0);
        setcookie('password', '', 0);
        
        $referer = strlen($_SERVER['HTTP_REFERER'])>0 ? $_SERVER['HTTP_REFERER'] : index.php;        
        header("Refresh: 2; url=$referer"); 
        echo "<div id='small'><div class='text'>Erfolgreich abgemeldet!<br/>Du wirst automatisch weitergeleitet</div></div>";
    }
    else {
        echo "<div id='small'><div class='text'>Du bist nicht angemeldet.<br/>";
        echo "<a href='login.php'>Login</a></div></div>";
    }
?>

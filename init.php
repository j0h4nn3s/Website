<?php

    ob_start();
    header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
    header('Pragma: no-cache'); // HTTP 1.0.
    header('Expires: 0'); // Proxies.

    $con = openDatabaseConnection();
    
    if (isset($_COOKIE['id']) && isset($_COOKIE['password'])) {

        $id_ = intval($_COOKIE['id']);
        $password_ = mysql_real_escape_string($_COOKIE['password']);

        $sql = mysql_query("SELECT * FROM `users`
                            WHERE `id`=$id_ AND `password`='$password_' LIMIT 1");
        
        if ($row = mysql_fetch_assoc($sql)) {
            $user = array(
                'id' => intval($row['id']),
                'email' => $row['email'],
                'username' => $row['username'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name']
            );
        }
        else {
            setcookie('id', '', 0);
            setcookie('password', '', 0);    
        }
    }

    register_shutdown_function('printContent');

    register_shutdown_function('closeDatabaseConnection', $con);
?>

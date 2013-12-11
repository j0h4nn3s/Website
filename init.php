<?php

    ob_start();


    $con = openDatabaseConnection();


    register_shutdown_function('printContent');

    register_shutdown_function('closeDatabaseConnection', $con);
?>

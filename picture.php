<?php
    include('../config.php');

    include('../functions.php');
    
    $con = openDatabaseConnection();
    
    //#yoloswag
    $id_ = intval($_GET['id']);
    if ($id_>0) {
        $sql = mysql_query("SELECT `title`, `description`, unix_timestamp(`timestamp`) AS `timestamp` FROM `pictures` WHERE `id`=$id_");
        if ($row = mysql_fetch_assoc($sql)) {
            $picture=array(
                'title' => $row['title'],
                'description' => $row['description'],
                'timestamp' => date('j.m.Y H:m:s', intval($row['timestamp'])),
                'comments' => array()
            );
            $sql = mysql_query("SELECT comments.id, users.username, comments.text, unix_timestamp(comments.date) AS `date` FROM `comments`
                                INNER JOIN `users` ON users.id = comments.uid WHERE comments.pid = $id_ ORDER BY comments.date DESC");
           
            while ($comment = mysql_fetch_assoc($sql)) {
                $picture['comments'][]=array(
                    'id' => intval($comment['id']),
                    'username' => $comment['username'],
                    'text' => $comment['text'],
                    'date' => date('j.m.Y', intval($comment['date'])),
                    'time' => date('H:m:s', intval($comment['date']))
                );
            }
            echo json_encode($picture);
        }
    }
    closeDatabaseConnection($con);
?>
<?php
    include('config.php');
    include('functions.php');
    include('init.php');
    $title='Anmelden';
    $visibility="hidden";
    echo '<div id="small">';

    if (isset($user)) {
        echo "<div class='text'>Du bist schon angemeldet.<br/>";
        echo "<a href='logout.php'>Logout</a></div></div>";
    }
    else {
        $referer = isset($_POST['referer']) ? $_POST['referer'] : $_SERVER['HTTP_REFERER'];        
        if (strpos($referer, $_SERVER['SERVER_NAME'])!==false) {
            //referer sind wir selber
        }   
        else {
            $referer='index.php';
        }
        if (count($_POST) > 0) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $email_ = mysql_real_escape_string($email);
            $password_ = mysql_real_escape_string(md5($password));

            $sql = mysql_query("SELECT * FROM `users`
                                WHERE `email`='$email_'
                                AND `password`='$password_' LIMIT 1");

            if ($row = mysql_fetch_assoc($sql)) {

                $user = array(
                    'id' => intval($row['id']),
                    'email' => $row['email'],
                    'username' => $row['username'],
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name']
                );

                setcookie('id', $user['id'], time()+3600);
                setcookie('password', $row['password'], time()+3600);

                header("Refresh: 1; url=$referer");
                //first div from id=small second div from class=text
                echo "<div class='text'>Erfolgreich angemeldet!<br/>Du wirst automatisch weitergeleitet<br/></div></div>";
                exit();
            }
            else {
                echo '<div class=error>Ung&uuml;ltige Email und/oder Passwort.</div>';
                $email = htmlspecialchars($email, ENT_QUOTES);
            }
        }

        echo "<form action='login.php' method='post'>";
        echo "Email: <input type='email' name='email' value='$email' /><br />";
        echo "Passwort: <input type='password' name='password' /><br />";
        echo "<input type='hidden' name='referer' value='$referer'/>";
        echo "<input type='submit' value='Anmelden' />";
        echo "</form>";
    echo "<div class='text'>Noch kein Konto? <a href='register.php'>Hier registrieren</a><br/>(Wenn du dich registriert hast kannst du Kommentare schreiben, Bilder bewerten und kannst Zugriff zu nicht &ouml;ffentlichen Bildern erhalten.)</div> </div>";
    }
?>


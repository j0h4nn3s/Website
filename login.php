<?php
    include('config.php');
    include('functions.php');
    include('init.php');
    $title='Anmelden';
    $spage=$_GET["cpage"];
    $visibility="hidden";
    echo '<div id="small">';

    if (isset($user)) {
        echo "<p>Du bist schon angemeldet.</p>";
        echo "<p><a href='logout.php'>&rsaquo;Logout</a></p>";
    }
    else {
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
                    'email' => $row['email']
                );

                setcookie('id', $user['id'], time()+3600);
                setcookie('password', $row['password'], time()+3600);

                header("Location: $spage");             
                echo "<div class=text>Erfolgreich angemeldet$page</div>";
                echo "<p><a href='$spage'>Click</a></p></div>";
                //redirect to saved page
                exit();
            }
            else {
                echo '<div class=error>Ung&uuml;ltige Email und/oder Passwort.</div>';
                $email = htmlspecialchars($email, ENT_QUOTES);
            }
        }

        echo "<form action='login.php?cpage=$spage' method='post'>";
        echo "Email: <input type='email' name='email' value='$email' /><br />";
        echo "Passwort: <input type='password' name='password' /><br />";
        echo "<input type='submit' value='Anmelden' />";
        echo "</form>";
    }
    echo "<div class='text'>Noch kein Konto? <a href='register.php'>Hier registrieren</a><br/>(Wenn du dich registriert hast kannst du Kommentare schreiben, Bilder bewerten und kannst Zugriff zu nicht &ouml;ffentlichen Bildern erhalten.)</div> </div>";
?>


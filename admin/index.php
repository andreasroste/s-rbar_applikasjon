<?php

session_start();

if(isset($_SESSION['loggedin'])) header('Location: /admin/dash.php');


if(isset($_POST['brukernavn']) && isset($_POST['passord'])){
    $brukernavn = $_POST['brukernavn'];
    $passord = $_POST['passord'];
    $db = mysqli_connect('localhost','hello','hello','HastaLaVista');
    $result = mysqli_query($db, "SELECT id FROM users WHERE brukernavn = '$brukernavn' AND passord = '$passord'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if($count >= 1) {
       $_SESSION['loggedin'] = true;
       header("Location: /admin/dash.php");
    }else {
       $error = "Feil brukernavn/passord.";
    }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>HastaLaVista</title>
</head>
<body>
    <div class="container">
        <h1>HastaLaVista ruteplanlegging</h1>
        <form method="POST">
            <input type="text" name="brukernavn" placeholder="Brukernavn" /><br>
            <input type="password" name="passord" placeholder="Passord" /><br>
            <input type="submit" value="Logg inn" />
            <?php if(isset($error)) echo $error; ?>
        </form>
    </div>
</body>
</html>
<?php
session_start();
if(!isset($_SESSION['loggedin']))
    header('Location: /admin');

if(isset($_POST['fil'])){
    $target_dir = "filer/";
    $target_file = $target_dir . basename($_FILES["fil"]["name"]);
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}

$filer = scandir('filer', SCANDIR_SORT_DESCENDING);
$filer = array_pop($filer); // Fjerner "."
$filer = array_pop($filer); // Fjerner ".."

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
        <h2>Last opp flyveoversikter</h2>
        <form method="POST">
            <input type="file" name="fil" accept=".csv" placeholder="Passord" /><br>
            <input type="submit" value="Last opp" />
            <?php if(isset($error)) echo $error; ?>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Filnavn</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($filer as $fil): ?>
                <tr>
                    <td><a href="filer/<?php echo $fil; ?>"><?php echo $fil; ?></a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
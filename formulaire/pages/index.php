<?php
include_once('../methodes/connexion.php');

$rep='';
$query = 'SELECT * FROM donnees;';
$prep = $pdo->prepare($query);
$prep->bindValue( '', $rep);
$prep->execute();
$arrAll = $prep->fetchAll();

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/header.style.css.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../src/international.png" />
    <title>GéoForm</title>
</head>
<body>

    <header>
        <?php include('header.php'); ?>
    </header>

    <div class="corp">
        <h1>Voici les informations géographiques que nous cannaissons grace à la communauté : </h1>
        <?php
        include_once('../methodes/functions.php');
        ?>



        <?php
        for ($i = 0; $i < count($arrAll); $i++) {
           echo ' <article id="art">';
            echo '<h3>PAYS : ' . $arrAll[$i]['pays']  . ' </h3><br>';
            echo'<div>Capitale : '. $arrAll[$i]['capitale'] .'</div>';
            echo'<div>Nombre d\'habitants  : '. $arrAll[$i]['habitants'] .'</div>';
            echo'<div>Langue : '. $arrAll[$i]['langue'] .'</div>';
            echo'<div>Ecris par : '. $arrAll[$i]['author'] .'</div>';
            echo '</article>';
        }

        ?>

    </div>

   <div id="hour">
       <?php
       setlocale(LC_TIME, 'fr_FR');
       date_default_timezone_set('Europe/Paris');
    echo '<p>Nous somme le : '. utf8_encode(strftime('%d / %m / %y ')).'</p>';
    ?>
   </div>
    <footer id="piedPage">
        <?php include('footer.php'); ?>
    </footer>

</body>
</html>



<?php
include_once('../methodes/connexion.php');

//$id = 1;
//// Préparer la requête
//$query = 'SELECT * FROM donnees WHERE identifiant = ?;';
//$prep = $pdo->prepare($query);
//// Associer des valeurs aux "trous"
//$prep->bindValue(1, $id);
//// Exécuter la requête
//$prep->execute();
//// Récupérer les données retournées.
//$arr = $prep->fetch();


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


<!--        <article id="art">-->
<!--        --><?php
//        echo '<h3>PAYS : ' . $arr['pays']  . ' </h3><br>';
//        echo'<div>Capitale :'. $arr['capitale'] .'</div>';
//        echo'<div>Nombre d\'habitants  :'. $arr['habitants'] .'</div>';
//        echo'<div>Langue :'. $arr['langue'] .'</div>';
//        echo'<div>Ecris par :'. $arr['author'] .'</div>';
//        ?>
<!--        </article>-->
<!--        --><?php //foreach(getCountries($geo)as $pays) : ?>
<!--            <article id="art">-->
<!--                Pays : --><?php //echo ucfirst($pays['pays']); ?><!--</h3>-->
<!--                <div>Capitale : --><?php //echo ucfirst($pays['capitale']); ?><!--</div>-->
<!--                <div>Nombre d'habitants : --><?php //echo $pays['habitants']; ?><!-- habitants</div>-->
<!--                <div>Langue : --><?php //echo ucfirst($pays['langue']); ?><!--</div>-->
<!--                <div>Ecris par : --><?php //echo displayAuthor($pays['author'], $users); ?><!--</div>-->
<!--            </article>-->
<!--        --><?php //endforeach ?>

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



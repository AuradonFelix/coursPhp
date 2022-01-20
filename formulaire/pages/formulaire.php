<?php
require_once '../methodes/connexion.php';
if (isset($_POST['ok'])) {
    $psed = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);
    $country = filter_input(INPUT_POST, 'pays', FILTER_SANITIZE_STRING);
    $capit = filter_input(INPUT_POST, 'capitale', FILTER_SANITIZE_STRING);
    $hab = filter_input(INPUT_POST, 'habitant', FILTER_SANITIZE_STRING);
    $lang = filter_input(INPUT_POST, 'langue', FILTER_SANITIZE_STRING);
    $message = '';
    if (!$psed && strlen($psed)>30) {
        $message .= "Votre pseudo doit obligatoirement être renseigné !<br>";
    }
    if (strlen($psed)>30) {
        $message .= "Votre pseudo ne doit pas dépasser 30 charactères !<br>";
    }
    if (!$country) {
        $message .= "Entrez le pays! <br>";
    }
    if (!$capit) {
        $message .= "Entrez la capitale du pays! <br>";
    }
    if (!$hab) {
        $message .= "Entrez le nombre d'habitants de ce pays! <br>";
    }
    if (!$lang) {
        $message .= "Entrez la langue principale de ce pays ! <br>";
    }

    if (!$message) {
      //inserer requetes

        $pays = $country;
        $capitale = $capit;
        $habitants = $hab;
        $langue = $lang;
        $author = $psed;
        $query = 'INSERT INTO donnees(pays, capitale, habitants, langue, author) VALUES(:pays, :capitale, :habitants, :langue, :author);';
        $prep = $pdo->prepare($query);
        $prep->bindValue(':pays', $pays);
        $prep->bindValue(':capitale', $capitale);
        $prep->bindValue(':habitants', $habitants);
        $prep->bindValue(':langue', $langue);
        $prep->bindValue(':author', $author);
        $prep->execute();
        echo "Nombre de lignes insérées : " . $prep->rowCount() . '<br>';
                header('location: index.php');
                exit();
            } else {
                $message .= "Entrez tous les champs requis !<br>";
            }
}

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="icon" type="image/png" href="../src/international.png" />
    <title>GéoForm</title>
</head>
<body>

<header>
    <?php include('header.php'); ?>
</header>

<div class="corp">
    <h1>Rajoutez les informations géographiques : </h1>

    <div id="formu">

    <form action="#" method="POST">
        <div class="messCo">
            <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        </div>

            <label for="pseudo">Votre Pseudo</label><br>
            <input type="text"  maxlength="30" placeholder="ex : coco l'asticot" id="pseudo" class="inp" name="pseudo" autocomplete="off" <?php
            if (isset($_POST['pseudo'])) {
                echo ' value="' . $psed . '"';
            }
            ?>><br>

            <label for="pays" >indiquez le pays :</label><br>
            <input type="text"  placeholder="ex : France" class="inp" id="pays" name="pays"autocomplete="off"  <?php
            if (isset($_POST['pays'])) {
                echo ' value="' . $country . '"';
            }
            ?>><br>

            <label for="capitale" >indiquez la Capitale :</label><br>
            <input type="text"  placeholder="ex : Paris" class="inp" id="capitale" name="capitale"autocomplete="off"  <?php
            if (isset($_POST['capitale'])) {
                echo ' value="' . $capit . '"';
            }
            ?>><br>

            <label for="habitant" >indiquez le nombre d'habitants :</label><br>
            <input type="number"  placeholder="ex : 60 000 000" class="inp" id="habitant" name="habitant"autocomplete="off"  <?php
            if (isset($_POST['habitant'])) {
                echo ' value="' . $hab . '"';
            }
            ?>><br>

            <label for="langue" >indiquez la langue de ce pays :</label><br>
            <select  placeholder="ex : Français" class="inp" name="langue" id="langue"  <?php
            if (isset($_POST['langue'])) {
                echo ' value="' . $lang . '"';
            }
            ?>>
                <option value="Français">Français</option>
                <option value="Anglais">Anglais</option>
                <option value="Espagnol">Espagnol</option>
                <option value="Italien">Italien</option>
                <option value="Roumain">Roumain</option>
                <option value="Polonais">Polonais</option>
                <option value="Serbe">Serbe</option>
                <option value="Hongrois">Hongrois</option>
                <option value="Allemand">Allemand</option>
                <option value="Arabe">Arabe</option>
                <option value="Japonais">Japonais</option>
            </select><br>

        <button id ="btnF" name="ok" type="submit" >Envoyer</button>
    </form>
</div>
</div>

<footer id="piedPage">
    <?php include('footer.php'); ?>
</footer>

</body>
</html>


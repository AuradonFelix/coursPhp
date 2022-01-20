<?php
require_once '../methodes/connexion.php';
$message = '';
if (isset($_POST['ok'])) {
$demande= filter_input(INPUT_POST, 'demande', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST,"email");
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }

    if (!$email) {
        $message .= "Votre email doit être renseigné !<br>";
    }
if (!$demande) {
    $message .= "Entrez au moin 20 charactères!<br>";
}


 if(!$message){

     $mail = $_POST['email'];
     $dem = $demande;
     $query = 'INSERT INTO contact(email, message) VALUES(:email, :demande);';
     $prep = $pdo->prepare($query);
     $prep->bindValue(':email', $mail);
     $prep->bindValue(':demande', $dem);
     $prep->execute();

     header('location: index.php');
     exit();
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
    <title>GéoForm Contact</title>
</head>
<body>

<header>
    <?php include('header.php'); ?>
</header>

<div class="corp">
    <h1>Contactez nous : </h1>

    <div id="cont">

    <form action="#" method="POST">
        <div class="messCo">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
        </div>
        <div id="formulaire">
            <label for="email" >Votre email : </label><br>
            <input type="email" class="contForm" name="email" placeholder="test@coucou.fr" autocomplete="off" <?php
            if (isset($_POST['email'])) {
                echo ' value="' . $_POST['email'] . '"';
            }
            ?>><br>

            <label for="demande">Votre message</label><br>
            <textarea class="form-control" id="demande" placeholder="Exprimez vous" class="contForm" name="demande"  rows="5" cols="33"<?php
            if (isset($_POST['demande'])) {
                echo ' value="' . $demande . '"';
            }
            ?>></textarea><br>

            <button type="submit" name="ok" id="btnC">Envoyer</button>
        </div>

    </form>

    </div>

</div>

<footer id="piedPage">
    <?php include('footer.php'); ?>
</footer>

</body>
</html>


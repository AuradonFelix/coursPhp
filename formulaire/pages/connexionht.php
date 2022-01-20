<?php
require_once '../methodes/connexion.php';
if (isset($_POST['ok'])) {
    $pren = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
    $nm = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $psed = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);
    $message = '';
    if (!$pren) {
        $message .= "Le prenom doit obligatoirement être renseigné !<br>";
    }
    if (!$nm) {
        $message .= "Le nom doit obligatoirement être renseigné !<br>";
    }
    if (!$psed) {
        $message .= "Le pseudo doit obligatoirement être renseigné !<br>";
    }
    if (strlen($psed) > 30) {
        $message .= "Votre pseudo ne doit pas dépasser 30 charactères !<br>";
    }
    //filtre de vérification du mot de passe
    $filtreMDP = array(
        'filter' => FILTER_VALIDATE_REGEXP,
        'options' => array('regexp' => '#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$#')
    );

    $filtre = array(
        'age' => FILTER_VALIDATE_INT,
        'email' => FILTER_VALIDATE_EMAIL,
        'mdp' => $filtreMDP,
    );
    foreach (filter_var_array($_POST['saisie'], $filtre) as $champ => $valeur) {
        if (!$valeur) {
            $message .= "Le champ " . $champ . " ne respecte pas les règles imposées<br>";
        }
    }
    if (!$message) {
        //inserer requetes

        $nom = $nm;
        $prenom = $pren;
        $pseudo = $psed;
        $age = $_POST['saisie']['age'];
        $email = $_POST['saisie']['email'];
        $password = $_POST['saisie']['mdp'];
        $query = 'INSERT INTO users(nom, prenom, pseudo, age, email, password) VALUES(:nom, :prenom, :pseudo, :age, :email, :password);';
        $prep = $pdo->prepare($query);
        $prep->bindValue(':nom', $nom);
        $prep->bindValue(':prenom', $prenom);
        $prep->bindValue(':pseudo', $pseudo);
        $prep->bindValue(':age', $age);
        $prep->bindValue(':email', $email);
        $prep->bindValue(':password', $password);
        $prep->execute();

        header('location: confirmation.php');
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
    <link rel="stylesheet" href="../CSS/style.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../src/international.png" />
    <title>GéoForm Connexion</title>
</head>
<body>
<header>
    <?php include('header.php'); ?>
</header>

<div class="corp">
    <h1>Connectez vous ou créez un compte </h1>

    <div id="formCo">

    <form  action="#" method="POST" >
        <!--enctype="multipart/form-data" pour l'uplaod du fichier-->
       <div class="messCo">
        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
       </div>

        <label for="idNom">Nom : </label> <br><input class="inp" type="text" name="nom" id="idNom"<?php
        if (isset($_POST['nom'])) {
            echo ' value="' . $nm . '"';
        }
        ?>><br> <label for="idPrenom">Prenom : </label><br><input class="inp" type="text" name="prenom" id="idPrenom"<?php
        if (isset($_POST['prenom'])) {
            echo ' value="' . $pren . '"';
        }
        ?>><br> <label for="idPseudo">Pseudo : </label><br><input class="inp" type="text" name="pseudo" id="idPseudo"<?php
        if (isset($_POST['pseudo'])) {
            echo ' value="' . $psed . '"';
        }
        ?>><br>
        <label for="idAge">Âge : </label><br><input class="inp" type="number" name="saisie[age]" id="idAge"<?php
        if (isset($_POST['saisie'])) {
            echo ' value="' . $_POST['saisie']['age'] . '"';
        }
        ?>><br>
        <label for="idMail">E-Mail : </label><br><input class="inp" type="email" name="saisie[email]" id="idMail"<?php
        if (isset($_POST['saisie'])) {
            echo ' value="' . $_POST['saisie']['email'] . '"';
        }
        ?>><br>
        <label for="idMdp">Mot de passe : </label><br>
        <input class="inp" type="text" name="saisie[mdp]"
               title="8 caractères minimum avec au moins une majuscule, une minuscule et un chiffre"
               pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}" required id="idMdp"><br>

        <input id="btnOk" type="submit" name="ok" value="Envoyer">
    </form>
    </div>
</div>

<footer id="piedPage">
    <?php include('footer.php'); ?>
</footer>
</body>
</html>

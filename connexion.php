<?php
// index.php
// Page de connexion du site web de la SAE23
// Auteur : Yann Plougonven-Lastennet

session_start();
include_once("fonctions.php");
?>

<!DOCTYPE html>
<html lang="fr"> <!-- langue de ce document : français -->
<!-- Auteur : Yann Plougonven-Lastennet -->

<head>
    <meta charset="utf-8"> <!-- Encodage : utf-8 -->
    <link rel="icon" href="images/favicon.png"> <!-- favicon de la page -->
    <title>Connexion • Gestion des ventes clients</title> <!-- Titre de la page -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Faire fonctionner le responsive design sur les écrans tactiles -->
    <!-- CSS Bootstrap : -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- CSS personel : -->
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <!-- JavaScript : -->
    <script src="js/javascript.js"></script>
</head>

<body>


    <?php
        // Destruction de la session si l'utilisateur vient de cliquer sur le bouton de déconnexion
        if (!empty($_GET) && isset($_GET['action']) && $_GET['action'] == 'logout') {
            $_SESSION = array();
            session_destroy();
        }

        // Redirection index.php si l'utilisateur est déjà connecté et n'a pas cliqué sur le bouton de déconnexion
        elseif (!empty($_SESSION) && isset($_SESSION['login'])) {
            header("Location: index.php");
            die();
        }
    ?>

    <main class="container-fluid min-vh-100"> <!-- .container-fluid : retire barre de défilement en bas de page -->
        <div class="row">

            <!-- Colonne gauche vide pour centrer le formulaire sur les grands écrans -->
            <div class="col-1 col-md-4"></div>

            <!-- Colonne centrale-->
            <div class="col-10 col-md-4">

                <!-- Logo de l'entreprise -->
                <img src="images/logo.png" class="mx-auto d-block mt-4" alt="Logo de l'entreprise" width="150" height="150">

                <h1 class="text-center mb-4">Connexion</h1>
                
                <!-- Formulaire de connexion -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return verifSecuMdp()">

                    <div class="mb-3">
                        <label for="mail" class="form-label">Adresse mail</label>
                        <input type="email" name="login" id="mail" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" name="pass" id="password" class="form-control">
                    </div>

                    <!-- Emplacement du message d'erreur si le mot de passe n'est pas assez sécurisé -->
                    <div class="mb-3">
                        <p id="msg_erreur_mdp" class="msg_erreur"></p>
                    </div>

                    <div class="mb-3 form-check">
                        <label class="form-check-label" for="show_password">Afficher le mot de passe</label>
                        <input type="checkbox" class="form-check-input" id="show_password" onclick="showPassword()">
                    </div>

                    <button type="submit" name="connect" class="btn btn-primary">Se connecter</button>

                </form>

                <!--- Tentative de connexion et enregistrement dans access.log -->
                <?php
                    if (isset($_POST) && !empty($_POST) && isset($_POST['connect'])
                        && isset($_POST["login"]) && isset($_POST["pass"])) {

                            if (authentification($_POST["login"],$_POST["pass"])) {

                                // Intialisation de la session
                                $_SESSION['login']=$_POST["login"];

                                // Définition du statut de l'utilisateur
                                if (statut_utilisateur($_SESSION['login'])=='admin') $_SESSION["statut"]='admin';
                                elseif (statut_utilisateur($_SESSION['login'])=='vendeur') $_SESSION["statut"]='vendeur';
                                else $_SESSION["statut"]='client';

                                // Enregistrement de la connexion dans access.log
                                $monfichier = fopen('logs/access.log', 'a+');
                                fputs($monfichier, "CONNEXION de ".$_POST['login'].", statut : ".$_SESSION["statut"].", depuis ".$_SERVER['REMOTE_ADDR'].", à ".date('l jS \of F Y h:i:s A')."\n");
                                fclose($monfichier);

                                // redirection vers la page d'accueil
                                header("Location: index.php");
                                die();

                            } else {
                                echo "<br>";
                                echo "<p class='msg_erreur'>L'utilisateur n'existe pas ou le mot de passe est incorrect.</p>";

                                // Enregistrement de la tentative de connexion dans access.log
                                $monfichier = fopen('logs/access.log', 'a+');
                                fputs($monfichier, "ACCES REFUSÉ À ".$_POST['login'].", depuis ".$_SERVER['REMOTE_ADDR'].", à ".date('l jS \of F Y h:i:s A')."\n");
                                fclose($monfichier);
                            }
                    }
                ?>

            </div>

            <!-- Colonne droite vide pour centrer le formulaire sur les grands écrans -->
            <div class="col-1 col-md-4"></div>

        </div>
    </main>

    <!-- pied de page -->
    <?php
        afficher_footer()
        //include_once("footer.php");
    ?>


    <!--- Icones boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- JavaScript fourni Bootstrap pour utiliser quelques fonctionnalités dynamiques -->
    <!-- A placer à la fin du document juste avant </body> afin que les pages se chargent plus vite -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
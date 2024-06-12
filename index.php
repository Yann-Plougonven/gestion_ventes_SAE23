<?php
// index.php
// Page d'accueil du site web de la SAE23
// Auteurs : Yann Plougonven-Lastennet et Nathan Aubinais

session_start();
include_once("fonctions.php");
include_once("formulaires.php");
?>

<!DOCTYPE html>
<html lang="fr"> <!-- langue de ce document : français -->
<!-- Auteurs : Yann Plougonven-Lastennet et Nathan Aubinais -->

<head>
    <meta charset="utf-8"> <!-- Encodage : utf-8 -->
    <link rel="icon" href="images/favicon.png"> <!-- favicon de la page -->
    <title>Gestion des ventes clients</title> <!-- Titre de la page -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Faire fonctionner le responsive design sur les écrans tactiles -->
    <!-- CSS Bootstrap : -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- CSS personel : -->
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    
    <!-- Autoriser ou non l'accès à la page -->
    <?php
        verif_autorisation_d_acces(array("admin", "vendeur", "client"))
	?>

    <!-- en-tête de la page -->
    <?php
        afficher_header()
    ?>

    
    <div class="container-fluid">
        <div class="row">

            <!-- menu de navigation -->
            <nav class="col-12 col-xl-3">
                
                <?php
                    afficher_navbar()
                ?>
            
            </nav>


            <!-- partie principale de la page -->
            <main class="container-fluid col-12 col-xl-9">

                <h1>Accueil du site</h1>

                <!-- Liste des produits -->
                <div class="row mb-3">
                    <h2>Nos produits</h2>

                    <?php
                        listerProduitsAvecImages();
                    ?>
                </div>

                <!-- Liste des ventes et des clients, réservé aux vendeurs et admins -->
                <?php if (in_array($_SESSION['statut'], array("admin", "vendeur"))) { ?>
                    <div class="row">

                        <!-- Liste des ventes sous forme de tableau -->
                        <div class="col-12 col-lg-5 col-xl-5">
                            <h2>Historique des ventes</h2>

                            <?php
                            listerVentes()
                            ?>
                        </div>

                        <!-- Colonne de séparation entre les deux tableaux -->
                        <div class="col-0 col-md-2"></div>

                        <!-- Liste des clients sous forme de tableau -->
                        <div class="col-12 col-lg-5 col-xl-5">
                            <h2>Clientèle</h2>

                            <?php
                                listerClients()
                            ?>
                        </div>

                    </div>

                    <div class="row">

                        <!-- Filtre sur plusieurs tableaux :TODO Nathan -->


                    </div>


                <?php } ?>

            </main>
        </div>
    </div>

    <!-- pied de page -->
    
    <?php
        afficher_footer()
    ?>


    <!--- Icones boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- JavaScript fourni Bootstrap pour utiliser quelques fonctionnalités dynamiques -->
    <!-- A placer à la fin du document juste avant </body> afin que les pages se chargent plus vite -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
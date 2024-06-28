<?php
// modifications.php
// Page de modification de la bdd pour le site web de la SAE23
// Auteur : Yann Plougonven-Lastennet

session_start();
include_once("fonctions.php");
include_once("formulaires.php");
verif_autorisation_d_acces(array("admin", "vendeur")); // autoriser ou refuser l'accès à la page
?>

<!DOCTYPE html>
<html lang="fr"> <!-- langue de ce document : français -->
<!-- Auteur : Yann Plougonven-Lastennet -->

<head>
    <meta charset="utf-8"> <!-- Encodage : utf-8 -->
    <link rel="icon" href="images/favicon.png"> <!-- favicon de la page -->
    <title>Gestion des ventes clients</title> <!-- Titre de la page -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Faire fonctionner le responsive design sur les écrans tactiles -->
    <!-- CSS Bootstrap : -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- CSS personel : -->
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <!-- JavaScript : -->
    <script src="js/javascript.js"></script>
</head>

<body>

    <!-- en-tête de la page -->
    <?php
        afficher_header()
    ?>
    
    <div class="container-fluid min-vh-100 bg-color">
        <div class="row">

            <!-- menu de navigation -->
            <div class="col-12 col-xl-3">
                
                <?php
                    afficher_navbar()
                ?>
            
            </div>

            <!-- partie principale de la page -->
            <main class="col-12 col-xl-9">

                <h1>Modifier des données</h1>

                <!-- La modification des clients et des produits est réservée aux admins -->
                <?php if (in_array($_SESSION['statut'], array("admin"))) { ?>

                    <div class="row" id="div_modif_client">
                        <h2>Modifier un profil client</h2>
                        <?php
                            formulaireChoixClient("modifier");
                        ?>

                        <p><hr>
                    </div>

                    <div class="row" id="div_modif_produit">
                        <h2>Modifier un produit</h2>
                        <?php
                            formulaireChoixProduit("modifier");
                        ?>

                        <p><hr>
                    </div>

                <?php } ?>

                <!-- La modification des clients et des produits est réservée aux admins ET aux vendeurs -->

                <div class="row" id="div_modif_vente">
                    <h2>Modifier une vente</h2>
                    <?php
                        formulaireChoixVente("modifier");
                    ?>

                </div>
                
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
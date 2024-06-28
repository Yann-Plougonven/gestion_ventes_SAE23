// javascript.js
// Fonctions javascipt pour le site web de la SAE23
// Auteurs : Nathan Aubinais et Yann Plougonven--Lastennet


//////////////////////
// AUTHENTIFICATION //
//////////////////////

// VERIFIER LA SECURITE DU MOT DE PASSE
function verifSecuMdp() {
    // Retourne true si le mot de passe respecte les critères de sécurité.
    // Retourne false sinon.
    // Auteur : Yann Plougonven--Lastennet
    var retour = true;

    // Récupération des variables auprès du formulaire.
    var mdp = document.getElementById("password").value;
    var msg_erreur = document.getElementById("msg_erreur_mdp");

    // Vider le contenu du message d'erreur.
    msg_erreur.innerHTML="";

    // Tester si le mot de passe fait au moins 7 caractères.
    if (mdp.length < 7) {
        msg_erreur.innerHTML = "Le mot de passe doit contenir au moins 8 caractères."
        retour = false;
    }

    // Tester si le mot de passe contient au moins une majuscule, une minuscule, et un caractère spécial.
    var reg = /(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#\$%\^&\*\(\)\-\_\+=\[\]\{\}:,<.>\?])/;
    resultat_reg = reg.test(mdp); 
    if (resultat_reg == false) {
        msg_erreur.innerHTML = "Le mot de passe doit contenir au moins une majuscule, une minuscule, et un caractère spécial."
        retour = false;
    }

    return retour;
}


// AFFICHER LE MOT DE PASSE
function showPassword() {
    // Affiche ou masque le mot de passe quand la case dédiée est cochée ou décochée.
    // Auteur : Yann Plougonven--Lastennet
    var passwordInput = document.getElementById("password");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}


///////////////////////
// GESTION DE LA BDD //
///////////////////////

// AFFICHER LE PRENOM ET LA VILLE D'UN UTILISATEUR DANS LE FORM DE SELECTION
function chercherClientParSonID(jsontab) {
    // Récupère le prénom et la ville d'un client à partir de son ID.
    // Affiche ces informations dans le formulaire de sélection.
    // Auteur : Yann Plougonven--Lastennet

    // Récupération des variables auprès du formulaire.
    var id_client = document.getElementById("id_client").value;
    var prenom = document.getElementById("prenom");
    var ville = document.getElementById("ville");

    // Convertir jsontab en chaine de caractères puis en tableau JS
    var jsontab = JSON.stringify(jsontab);
    var tableau = JSON.parse(jsontab);

    // Afficher dans la console le tableau converti
    //console.log(jsontab);
    console.log("Tableau JS contenant la liste des clients :");
    console.log(tableau);

    // Parcourir le tableau pour trouver le client correspondant à l'ID.
    console.log("ID du client à chercher : " + id_client);
    var res = -1;
    for (i = 0; i < tableau.length; i++) {
        if (id_client == tableau[i]["idC"]) {
            res = i;
        }
    }

    // Afficher le prénom et la ville du client correspondant à l'ID.
    if (res != -1) {
        prenom.value = tableau[res]["NomP"];
        ville.value = tableau[res]["Ville"];

    // Afficher un message d'erreur si l'ID ne correspond à aucun client.
    } else {
        prenom.value = "Cet ID ne correspond à aucun client !";
        ville.value = "Cet ID ne correspond à aucun client !";
    }
}

// CHANGER LES PRODUITS DISPONIBLES DANS LE DROPDOWN DE SELECTION DU NOM DU PRODUIT DU FORMULAIRE DE SELECTION PRODUIT
function chercherProduitParSonEtat(jsontab) {
    // Récupère la liste des produits compatible avec l'état sélectionné.
    // Affiche ces informations dans un dopdown du formulaire de sélection.
    // Auteur : Yann Plougonven--Lastennet

    // Récupération des variables auprès du formulaire.
    var etat = document.getElementById('etat_produit').value;
    var nom_produit = document.getElementById('nom_produit');

    // Convertir jsontab en chaine de caractères puis en tableau JS
    var jsontab = JSON.stringify(jsontab);
    var tableau = JSON.parse(jsontab);

    // Afficher dans la console le tableau converti
    console.log("Tableau JS contenant la liste des produits :");
    console.log(tableau);

    // Parcourir le tableau pour trouver les produits correspondant à l'état.
    console.log("Etat du produit à chercher : " + etat);
    var res = [];
    for (i = 0; i < tableau.length; i++) {
        if (etat == tableau[i]["Etat"]) {
            res.push(tableau[i]["NomP"]);
        }
    }

    // Clear le dopdown nom_produit
    nom_produit.innerHTML = "";

    // Mettre à jour le dopdown nom_produit
    for (i = 0; i < res.length; i++) {
        var option = document.createElement("option");
        option.value = res[i];
        option.text = res[i];
        nom_produit.appendChild(option);
    }
}

// AFFICHER LES CARACTERISTIQUES D'UN PRODUIT DANS LE FORM DE SELECTION A PARTIR DE SON ID
function chercherProduitParSonID(jsontab) {
    // Récupère le nom, le prix et le lien de l'image d'un produit à partir de son ID.
    // Affiche ces informations dans le formulaire de sélection.
    // Auteur : Yann Plougonven--Lastennet

    // Récupération des variables auprès du formulaire.
    var id_produit = document.getElementById("id_produit").value;
    var nom_produit = document.getElementById("nom_produit");
    var prix_produit = document.getElementById("prix_produit");
    var img_produit = document.getElementById("img_produit");

    // Convertir jsontab en chaine de caractères puis en tableau JS
    var jsontab = JSON.stringify(jsontab);
    var tableau = JSON.parse(jsontab);

    // Afficher dans la console le tableau converti
    //console.log(jsontab);
    console.log("Tableau JS contenant la liste des produits :");
    console.log(tableau);

    // Parcourir le tableau pour trouver le produit correspondant à l'ID.
    console.log("ID du produit à chercher : " + id_produit);
    var res = -1;
    for (i = 0; i < tableau.length; i++) {
        if (id_produit == tableau[i]["idP"]) {
            res = i;
        }
    }

    // Afficher le prénom et la ville du client correspondant à l'ID.
    if (res != -1) {
        nom_produit.value = tableau[res]["NomP"];
        prix_produit.value = tableau[res]["Prix"];
        img_produit.value = tableau[res]["Illustration"];

    // Afficher un message d'erreur si l'ID ne correspond à aucun client.
    } else {
        nom_produit.value = "Cet ID ne correspond à aucun client !";
        prix_produit.value = "Cet ID ne correspond à aucun client !";
        img_produit.value = "Cet ID ne correspond à aucun client !";
    }
}

// AFFICHER LES CARACTERISTIQUES D'UN PRODUIT DANS LE FORM DE SELECTION A PARTIR DE SON ID
function chercherProduitParSonNom(jsontab) {
    // Récupère le nom, le prix et le lien de l'image d'un produit à partir de son ID.
    // Affiche ces informations dans le formulaire de sélection.
    // Auteur : Yann Plougonven--Lastennet

    // Récupération des variables auprès du formulaire.
    var id_produit = document.getElementById("id_produit");
    var nom_produit = document.getElementById("nom_produit").value;
    var prix_produit = document.getElementById("prix_produit");
    var img_produit = document.getElementById("img_produit");

    // Convertir jsontab en chaine de caractères puis en tableau JS
    var jsontab = JSON.stringify(jsontab);
    var tableau = JSON.parse(jsontab);

    // Afficher dans la console le tableau converti
    //console.log(jsontab);
    console.log("Tableau JS contenant la liste des produits :");
    console.log(tableau);

    // Parcourir le tableau pour trouver le produit correspondant à l'ID.
    console.log("Nom du produit à chercher : " + nom_produit);
    var res = -1;
    for (i = 0; i < tableau.length; i++) {
        if (nom_produit == tableau[i]["NomP"]) {
            res = i;
        }
    }

    // Afficher le prénom et la ville du client correspondant à l'ID.
    if (res != -1) {
        id_produit.value = tableau[res]["idP"];
        prix_produit.value = tableau[res]["Prix"];
        img_produit.value = tableau[res]["Illustration"];

    // Afficher un message d'erreur si l'ID ne correspond à aucun client.
    } else {
        id_produit.value = "Cet ID ne correspond à aucun produit !";
        prix_produit.value = "Cet ID ne correspond à aucun produit !";
        img_produit.value = "Cet ID ne correspond à aucun produit !";
    }
}

function chercherVenteParSonID(jsontab) {
    // Récupère les informations d'une vente à partir de son ID.
    // Affiche ces informations dans le formulaire de sélection.
    // Auteur : Yann Plougonven--Lastennet

    // Récupération des variables auprès du formulaire.
    var id_vente = document.getElementById("id_vente").value;
    var id_produit_vente = document.getElementById("id_produit_vente");
    var id_client_vente = document.getElementById("id_client_vente");
    var quantite_vente = document.getElementById("quantite_vente");
    var nom_produit_vente = document.getElementById("nom_produit_vente");
    var nom_client_vente = document.getElementById("nom_client_vente");

    // Convertir jsontab en chaine de caractères puis en tableau JS
    var jsontab = JSON.stringify(jsontab);
    var tableau = JSON.parse(jsontab);

    // Afficher dans la console le tableau converti
    //console.log(jsontab);
    console.log("Tableau JS contenant la liste des produits :");
    console.log(tableau);

    // Parcourir le tableau pour trouver le produit correspondant à l'ID.
    console.log("ID de la vente à chercher : " + id_vente);
    var res = -1;
    for (i = 0; i < tableau.length; i++) {
        if (id_vente == tableau[i]["idT"]) {
            res = i;
        }
    }

    // Afficher le prénom et la ville du client correspondant à l'ID.
    if (res != -1) {
        id_produit_vente.value = tableau[res]["idP"];
        id_client_vente.value = tableau[res]["idC"];
        quantite_vente.value = tableau[res]["Qte"];
        nom_produit_vente.value = tableau[res]["nomProduit"];
        nom_client_vente.value = tableau[res]["nomAcheteur"];

    // Afficher un message d'erreur si l'ID ne correspond à aucun client.
    } else {
        id_produit_vente.value = "Cet ID ne correspond à aucune vente !";
        id_client_vente.value = "Cet ID ne correspond à aucune vente !";
        quantite_vente.value = "Cet ID ne correspond à aucune vente !";
        nom_produit_vente.value = "Cet ID ne correspond à aucune vente !";
        nom_client_vente.value = "Cet ID ne correspond à aucune vente !";
    }
}



///////////////////
// REQUÊTES AJAX //
///////////////////

function requeteAJAX(type_demande, demande) {
    // Envoie une requête AJAX pour récupérer les données demandées,
    // selon ce qui est passé en paramètre (chaine de caractères).
    // Par exemple, passer "form_modif_client" en paramètre 
    // pour récupérer le formulaire de modification des clients.
    // Auteur : Yann Plougonven--Lastennet

    // Créer l'objet XMLHttpRequest
    var req_AJAX = null;
    if (window.XMLHttpRequest) { // mozilla, safari
        req_AJAX = new XMLHttpRequest();
    }
    else if (typeof ActiveXObject != "undefined") { // autres navigateurs
        req_AJAX = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // Configurer l'objet XML
    if (req_AJAX) { // si le navigateur supporte AJAX

        // Récupérer les variables du formulaire
        if (type_demande == "fonctions" && demande == "modif_client") {
            var new_id_client = document.getElementById('new_id_client').value;
            var new_prenom = document.getElementById('new_prenom').value;
            var new_ville = document.getElementById('new_ville').value;
        }

        else if (type_demande == "fonctions" && demande == "modif_produit") {
            var new_id_produit = document.getElementById('new_id_produit').value;
            var new_nom_produit = document.getElementById('new_nom_produit').value;
            var new_prix_produit = document.getElementById('new_prix_produit').value;
            var new_img_produit = document.getElementById('new_img_produit').value;
        }

        else if (type_demande == "fonctions" && demande == "modif_vente") {
            var new_id_vente = document.getElementById('new_id_vente').value;
            var new_id_produit_vente = document.getElementById('new_id_produit_vente').value;
            var new_id_client_vente = document.getElementById('new_id_client_vente').value;
            var new_quantite_vente = document.getElementById('new_quantite_vente').value;
        }

        // Définir la page AJAX à demander (contenue dans une fonction inclue dans formulaires.php)
        var page_AJAX_demandee = type_demande + ".php?action=get_" + demande;
        console.log("Page AJAX demandée : " + page_AJAX_demandee);

        req_AJAX.open("POST", page_AJAX_demandee, true);
        req_AJAX.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        req_AJAX.onreadystatechange = function () {
            if (req_AJAX.readyState == 4 && req_AJAX.status == 200) {

                // Définir la div dans laquelle afficher la réponse AJAX
                var nom_div = "div_" + demande;
                console.log("Nom de la div dans laquelle afficher la réponse AJAX : " + nom_div);
                var div = document.getElementById(nom_div);

                // Afficher la réponse AJAX dans la div correspondante
                div.innerHTML = req_AJAX.responseText;
            }
        };

        // Envoyer les données du formulaire rempli par l'utilisateur
        if (type_demande == "fonctions" && demande == "modif_client") {
            req_AJAX.send("&new_id_client=" + new_id_client + "&new_prenom=" + new_prenom + "&new_ville=" + new_ville);
        }

        else if (type_demande == "fonctions" && demande == "modif_produit") {
            req_AJAX.send("&new_id_produit=" + new_id_produit + "&new_nom_produit=" + new_nom_produit + "&new_prix_produit=" + new_prix_produit + "&new_img_produit=" + new_img_produit);
        }

        else if (type_demande == "fonctions" && demande == "modif_vente") {
            req_AJAX.send("&new_id_vente=" + new_id_vente + "&new_id_produit_vente=" + new_id_produit_vente + "&new_id_client_vente=" + new_id_client_vente + "&new_quantite_vente=" + new_quantite_vente);
        }
    }

    else { // si le navigateur ne supporte pas AJAX
        alert("Erreur : votre navigateur ne supporte pas AJAX.");
    }
}
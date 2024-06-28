<?php
// fonctions.php
// Fonctions PHP pour le site web de la SAE23
// Auteurs : Nathan Aubinais et Yann Plougonven-Lastennet


// Quand ce fichier (et non une fonction de ce fichier) est appellé, 
// vérifier s'il est appellé pour une fonction spécifique.
// Si c'est le cas, appeller la fonction correspondante.
if (isset($_GET['action']) && !empty($_GET['action'])) {

	// Si le formulaire de modification d'un client est appellé :
	if ($_GET['action'] == 'get_modif_client') {
		echo modifierClient();
	}

	// Si le formulaire de modification d'un produit est appellé :
	elseif ($_GET['action'] == 'get_modif_produit') {
		echo modifierProduit();
	}

	// Si le formulaire de modification d'une vente est appellé :
	elseif ($_GET['action'] == 'get_modif_vente') {
		echo modifierVente();
	}
}


//////////////////////////
// GESTION DES SESSIONS //
//////////////////////////

// AUTHENTIFICATION
function authentification($mail,$pass){
	$retour = false ;

	try { // Tentative de connexion à la BDD et d'authentification
		$madb = new PDO('sqlite:bdd/comptes.sqlite'); 
		$mail= $madb->quote($mail);
		$pass = $madb->quote($pass);
		$requete = "SELECT EMAIL,PASS FROM utilisateurs WHERE EMAIL = ".$mail." AND PASS = ".$pass ;
		$resultat = $madb->query($requete);
		$tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);
		if (sizeof($tableau_assoc)!=0) $retour = true;	
	}

	catch (Exception $e) { // Erreur
		echo "<p>Erreur lors de la connexion à la BDD : ".$e->getMessage()."</p>";
	}

	return $retour;
}


// DEFINITION DU STATUT UTILISATEUR
function statut_utilisateur($mail){

	try { // Tentative de connexion à la BDD et de vérification du statut
		$madb = new PDO('sqlite:bdd/comptes.sqlite'); 
		$mail= $madb->quote($mail);
		$rq = "SELECT STATUT FROM utilisateurs WHERE EMAIL = $mail";
		$resultat = $madb -> query($rq);

		// Traitement des résultats :
		$tableau_assoc = $resultat->fetch(PDO::FETCH_ASSOC);
		if ($tableau_assoc != null) {
			if ($tableau_assoc['STATUT']=='admin')  $retour = "admin";
			elseif ($tableau_assoc['STATUT']=='vendeur')  $retour = "vendeur";
			else $retour = "client";
		}
	}

	catch (Exception $e) { // Erreur
		echo "<p>Erreur lors de la connexion à la BDD : ".$e->getMessage()."</p>";
	}

	return $retour;	
}


// VERIFICATION DE L'AUTORISATION D'ACCES À LA PAGE
function verif_autorisation_d_acces($statut_requis){
	// $statut_requis (liste(str)) : contient 'admin', 'vendeur', et/ou 'client'

	if (empty($_SESSION)) { 
		header("Location: connexion.php");
		die();
	}

	if (!in_array($_SESSION['statut'], $statut_requis)) {
		header("Location: connexion.php");
		die();
	}
}


/////////////////////////////
// HEADER, NAVBAR & FOOTER //
/////////////////////////////

// AFFICHAGE DU HEADER
function afficher_header() { ?>
	<header class="navbar sticky-top navbar-light bg-light" id="header">
		<div class="container-fluid">

			<a class="navbar-brand" href="index.php">
				<img src="images/logo.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
				Ventes clients
			</a>

			<a class="navbar-brand">
				Bonjour <?php echo $_SESSION["login"]; ?> ! Vous êtes <?php echo $_SESSION["statut"]; ?>.
			</a>

			<a href="connexion.php?action=logout" class="btn btn-outline-danger me-2 align-right">
				Se déconnecter
				<i class="bi bi-box-arrow-right"></i>
			</a>

		</div>
	</header>
<?php	
}


// COLORISATION DU LIEN DE LA PAGE ACTIVE, DANS LA NAVBAR
function afficher_lien_navbar($page_courante) {
	// $page_courante (string) : nom_page_courante.php
	if (basename($_SERVER['PHP_SELF']) == $page_courante) {
		echo '<a href="#" class="nav-link active" aria-current="page">';
	} else {
		echo '<a href="'.$page_courante.'" class="nav-link link-dark">';
	}
}


// AFFICHAGE DE LA NAVBAR
function afficher_navbar() { ?>
	<div class="d-flex justify-content-center align-items-center" style="position: sticky; top: 0; height: 90vh;">
		<div class="d-flex flex-column flex-shrink-0 p-3 bg-light justify-content-center my-auto" style="width: 300px;">
			<ul class="nav nav-pills flex-column mb-auto">

				<li>
					<?php
						// Coloration dynamique du lien de la page active
						// (Je (Yann) aurait pu faire ça sans code, de manière plus optimisée,
						// mais ça permet de montrer qu'on peut intégrer du php dans la navbar
						// tout en réduisant la taille du code de chaque page qui l'inclut)
						afficher_lien_navbar("index.php");
					?>
					<i class="bi bi-house"></i>
					Accueil du site
					</a>
				</li>

				<?php
					// Si l'utilisateur est un administrateur ou un vendeur, on affiche les liens suivants
					if (in_array($_SESSION['statut'], array("admin", "vendeur"))) {
				?>
					
					<li>
						<?php
							afficher_lien_navbar("insertion.php");
						?>
						<i class="bi bi-clipboard2-plus"></i>
						Insérer des donnnées
						</a>
					</li>

					<li>
						<?php
							afficher_lien_navbar("modification.php");
						?>
						<i class="bi bi-pencil-square"></i>
						Modifier des données
						</a>
					</li>

					<li>
						<?php
							// Coloration dynamique du lien de la page active
							afficher_lien_navbar("suppression.php");
						?>
						<i class="bi bi-file-earmark-x"></i>
						Supprimer des données
						</a>

					</li>
				
				<?php
					}
				?>
				
			</ul>
		</div>
	</div>
<?php	
}


// AFFICHAGE DU PIED DE PAGE
function afficher_footer() { ?>
	<!-- Pied de page commun à toutes les pages du site -->
	<div class="container-fluid mt-auto">
		<footer class="d-flex py-4 border-top">

			<a class="col-md-6 text-muted text-decoration-none">
				<img src="images/logo.png" alt="" width="25" height="25" class="d-inline-block align-text-top">
				Gestion des ventes client • Projet Web SAE23 BUT Réseaux et Télécoms
			</a>
			
			<a class="col-md-6 text-muted text-decoration-none text-end">
				Site réalisé en 2024 par Nathan Aubinais et Yann Plougonven--Lastennet
			</a>

		</footer>
	</div>
<?php	
}


/////////////////////////////////////////////////
// AFFICHAGE ET GESTION DES DONNÉES DU MAGASIN //
/////////////////////////////////////////////////

// AFFICHER UN TABLEAU BOOTSTRAP
function afficheTableau($tab){
	// Prend en paramètre un tableau associatif et l'affiche dans un tableau bootstrap
	// Auteur : Yann Plougonven--Lastennet

	echo '<table class="table table-hover table-striped">';

		echo '<thead>';
			echo '<tr>';
				foreach($tab[0] as $colonne=>$valeur){ 
					echo "<th>$colonne</th>"; 
				}
			echo "</tr>";
		echo "</thead>\n";

		echo '<tbody>';
			foreach($tab as $ligne){
				echo '<tr>';
					foreach($ligne as $cellule) { 
						echo "<td>$cellule</td>"; 
					}
				echo "</tr>\n";
			}
		echo "</tbody>\n";

	echo '</table>';
}


// AFFICHER LES CLIENTS DANS UN TABLEAU
function listerClients() {
	// Se connecte à la BDD, liste les clients, et appelle la fonction d'affichage du tableau
	// Auteur : Yann Plougonven--Lastennet

	try { // Tentative de connexion à la BDD et de récupération des données clients
		$madb = new PDO('sqlite:bdd/ventesClient.sqlite');
		$rq = "SELECT IdC as ID, NomP as Prénom, Ville FROM Acheteurs";
		$resultat = $madb->query($rq);
		$tab = $resultat->fetchAll(PDO::FETCH_ASSOC);

		if ($tab != null) {
			afficheTableau($tab);
		}
	}
	catch (Exception $e) { // Erreur
		echo "<p>Erreur lors de la connexion à la BDD : ".$e->getMessage()."</p>";
	}
}

// AFFICHER LES VENTES DANS UN TABLEAU
function listerVentes() {
	// Se connecte à la BDD, liste les ventes, et appelle la fonction d'affichage du tableau
	// Auteur : Yann Plougonven--Lastennet

	try { // Tentative de connexion à la BDD et de récupération des données ventes
		$madb = new PDO('sqlite:bdd/ventesClient.sqlite');
		$rq = "SELECT Achat.IdT as ID, Acheteurs.NomP as Client, Produits.NomP as Produit, Achat.Qte as Quantité
		FROM Achat 
		INNER JOIN Produits ON  Produits.IdP = Achat.IdP
		INNER JOIN Acheteurs ON  Acheteurs.IdC = Achat.IdC;";
		$resultat = $madb->query($rq);
		$tab = $resultat->fetchAll(PDO::FETCH_ASSOC);

		if ($tab != null) {
			afficheTableau($tab);
		}
	}
	catch (Exception $e) { // Erreur
		echo "<p>Erreur lors de la connexion à la BDD : ".$e->getMessage()."</p>";
	}
}

// AFFICHER LES PRODUITS (NOM ET PRIX) DANS UN TABLEAU
function listerProduits()	{
	// Se connecte à la BDD, liste les produits sans leur image, 
	// et appelle la fonction d'affichage du tableau.
	// Auteur : Nathan Aubinais

	$retour = false ;	
	try {
		$madb = new PDO('sqlite:bdd/ventesClient.sqlite');
		$rq = "SELECT * FROM Produits"; # Jointure peut être necessaire
		$res = $madb->query($rq);
		$tab = $res->fetchAll(PDO::FETCH_ASSOC);
		if ($tab !=  null){
			afficheTableau($tab);
			$retour = true;
		}
	}
	catch(Exception $e){
		echo"<p>Erreur lors de la connexion à la BDD </p>";
	}

	return $retour;
}

function listerAcheteurs(){
	// Auteur : Nathan Aubinais
	// Liste les Noms et ville des acheteurs 
	// Affiche les informations en faissant appelle à la fonction affiche tableau

	$retour = false ;	
	try {
		$madb = new PDO('sqlite:bdd/ventesClient.sqlite');
		$rq = "SELECT NomP, Ville FROM Acheteurs"; 
		$res = $madb->query($rq);
		$tab = $res->fetchAll(PDO::FETCH_ASSOC);
		if ($tab !=  null){
			afficheTableau($tab);
			$retour = true;
			}
		}
	catch(Exception $e){
		echo"<p>Erreur lors de la connexion à la BDD </p>";
	}


	return $retour;
}

// AFFICHER LES PRODUITS (ID, NOM, PRIX, IMAGE) DANS DES CARTES BOOTSTRAP
function listerProduitsAvecImages() {
	// Se connecte à la BDD, liste les produits avec leur image, 
	// et appelle la fonction d'affichage du tableau.
	// Auteur : Yann Plougonven--Lastennet

	try { // Tentative de connexion à la BDD et de récupération des données ventes
		$madb = new PDO('sqlite:bdd/ventesClient.sqlite');
		$rq = "SELECT idP, NomP, Prix, Illustration, Etat FROM Produits";
		$resultat = $madb->query($rq);
		$tab = $resultat->fetchAll(PDO::FETCH_ASSOC);

		if ($tab != null) {
			afficherProduitsEnCartes($tab);
		}
	}
	catch (Exception $e) { // Erreur
		echo "<p>Erreur lors de la connexion à la BDD : ".$e->getMessage()."</p>";
	}
}


// AFFICHER DES CARTES BOOTSTRAP
function afficherProduitsEnCartes($tab) {
	// Prend en paramètre un tableau contenant des données sous la forme nom, prix, image
	// et affiche ces données dans des cartes bootstrap
	// Auteur : Yann Plougonven--Lastennet

	foreach($tab as $ligne) {
		echo '<article class="col mt-3 d-flex justify-content-center align-items-center">';
			echo '<div class="card h-100" style="width: 12rem;">';
				echo '<img src='.$ligne["Illustration"].' class="card-img-top" alt="Illustration du produit">';
				echo '<div class="card-body d-flex flex-column">';
					echo '<h5 class="card-title mt-auto">'.$ligne["NomP"].'</h5>';
					echo '<p class="card-text"><strong>'.$ligne["Prix"].'€</strong> <br>'.$ligne["Etat"].'<br> reférence n°'.$ligne["idP"].'</p>';
				echo '</div>';
			echo '</div>';
		echo '</article>';
	}
}

// AJOUTE UN PRODUIT DANS LA TABLE LE NOM ET LE PRIX
function ajouterProduit($NomP,$Prix){
	// On récupère directement le code de la ville qui a été transmis dans l'attribut value de la balise <option> du formulaire
	// Il n'est donc pas nécessaire de rechercher le code INSEE de la ville
	// Auteur : Nathan Aubinais
	$retour=0;
	try {
		// connexion à la BDD
		$madb = new PDO('sqlite:bdd/ventesClient.sqlite'); 
		// Ajout de quote àa la variable NomP qui est un str mais pas au prix qui est un Float 
		$NomP = $madb->quote($NomP);
		// INSERT INTO utilisateurs VALUES('', '', '', '', '');
		$requete = "INSERT INTO Produits (NomP, Prix) VALUES($NomP,$Prix)";
		// On utilise pas query, on utilise exec lorsque l'on fait un requête qui a vocation à modifier la base
		$resultat = $madb->exec($requete);

		echo "<div class='col-12 col-lg-7'>";

			// Afficher un message de succès
			echo "<div class='alert alert-success mt-3' role='alert'>";
				echo "<i class='bi bi-check-circle-fill'></i>";
				echo " Le produit ".$NomP." a bien été ajouté avec un prix de ".$Prix."€.";
			echo '</div>';

			// Afficher la liste des Produits
			listerProduits();

		echo "</div>";

		if ($resultat == true) {
			$retour = 1;
			}
	}
	catch (Exception $e) { // Erreur
		echo "<p>Erreur lors de la connexion à la BDD : ".$e->getMessage()."</p>";
	}
	
	return $retour;
}

	// AJOUTE UN ACHETEUR DANS LA TABLE AVEC SON NOM ET SA VILLE 
	function ajouterAcheteur($NomP,$Ville){
		// Auteur Nathan Aubinais
		$retour=0;
		try{
			$madb = new PDO('sqlite:bdd/ventesClient.sqlite'); 
			// Ajout de quote aux 2 variables qui sont toutes deux des chaine de caractères 
			$NomP = $madb->quote($NomP);
			$Ville = $madb->quote($Ville);
			// INSERT INTO utilisateurs VALUES('', '', '', '', '');
			$requete = "INSERT INTO Acheteurs (NomP, Ville) VALUES($NomP,$Ville)";
			// On utilise pas query, on utilise exec lorsque l'on fait un requête qui a vocation à modifier la base
			$resultat = $madb->exec($requete);

			echo "<div class='col-12 col-lg-7'>";

				// Afficher un message de succès
				echo "<div class='alert alert-success mt-3' role='alert'>";
					echo "<i class='bi bi-check-circle-fill'></i>";
					echo " L'acheteur ".$NomP." qui réside à ".$Ville." a bien été ajouté.";
				echo '</div>';

				// Afficher la liste des clients
				listerAcheteurs();

			echo "</div>";

			if ($resultat == true) {
				$retour = 1;
			}
		}
		catch (Exception $e) { // Erreur
			echo "<p>Erreur lors de la connexion à la BDD : ".$e->getMessage()."</p>";
		}
	   
		
		return $retour;
	}


	// AJOUTE UNE VENTE DANS LA TABLE A PARTIR DU NOM DE L'ACHETEUR, LE PRODUIT ACHETE ET LA QUANTITE
	function ajouterVente($NomA,$NomP,$Qte){
		// Auteur : Nathan AubinaisS
		$retour=0;
		try{
			$madb = new PDO('sqlite:bdd/ventesClient.sqlite'); 
			// Ajout de quote aux 2 variables qui sont toutes deux des chaine de caractères mais pas à la variable Qte qui est un entier
			$NomP = $madb->quote($NomP);
			$NomA = $madb->quote($NomA);
			// INSERT INTO utilisateurs VALUES('', '', '', '', '');
			$requete = "INSERT INTO Achat (idP, idC, Qte) 
			VALUES((SELECT Produits.idP FROM Produits INNER JOIN Achat ON Produits.idP = Achat.idP WHERE Produits.NomP = $NomP),(SELECT Acheteurs.idC FROM Acheteurs INNER JOIN Achat ON Acheteurs.idC = Achat.idC WHERE Acheteurs.NomP = $NomA), $Qte)";
			// On utilise pas query, on utilise exec lorsque l'on fait un requête qui a vocation à modifier la base
			$resultat = $madb->exec($requete);

			echo "<div class='col-12 col-lg-7'>";

				// Afficher un message de succès
				echo "<div class='alert alert-success mt-3' role='alert'>";
					echo "<i class='bi bi-check-circle-fill'></i>";
					echo " L'acheteur ".$NomA." a bien acheté ".$Qte." fois le produit ".$NomP." .";
				echo '</div>';

				// Afficher la liste des ventes
				listerVentes();

			echo "</div>";

			if ($resultat == true) {
				$retour = 1;
			}
		}
		catch (Exception $e) { // Erreur
			echo "<p>Erreur lors de la connexion à la BDD : ".$e->getMessage()."</p>";
		}
	   
		
		return $retour;
	}

function supprimerProduit($NomP){
	// Supprime un produit de la bdd
	// Auteur : Nathan Aubinais

	$retour=0;

	try {
		$madb = new PDO('sqlite:bdd/ventesClient.sqlite'); 
		$NomP = $madb->quote($NomP);
		$requete = "DELETE FROM Produits WHERE NomP = $NomP;";
		// On utilise pas query, on utilise exec lorsque l'on fait un requête qui a vocation à modifier la base
		$resultat = $madb->exec($requete);

		echo "<div class='col-12 col-lg-7' mb-3>";

			// Afficher un message de succès
			echo "<div class='alert alert-success mt-3' role='alert'>";
				echo "<i class='bi bi-check-circle-fill'></i>";
				echo " Le produit ".$NomP." a bien été supprimé.";
			echo '</div>';

			// Afficher la liste des Produits
			listerProduits();

		echo "</div>";

		if ($resultat == true) {
			$retour = 1;
			}
	}
	catch (Exception $e) { // Erreur
		echo "<p>Erreur lors de la connexion à la BDD : ".$e->getMessage()."</p>";
	}

	return $retour;
}


function supprimerAcheteurs($NomA){
	// Auteur Nathan Aubinais
	$retour=0;
	try {
		$madb = new PDO('sqlite:bdd/ventesClient.sqlite'); 
		// filtrer les paramètres 
		$NomA = $madb->quote($NomA);
		$requete = "DELETE FROM Acheteurs WHERE NomP = $NomA;";
		// On utilise pas query, on utilise exec lorsque l'on fait une requête qui a vocation à modifier la base
		$resultat = $madb->exec($requete);

		echo "<div class='col-12 col-lg-7' mb-3>";

			// Afficher un message de succès
			echo "<div class='alert alert-success mt-3' role='alert'>";
				echo "<i class='bi bi-check-circle-fill'></i>";
				echo " L'acheteur ".$NomA." a bien été supprimé.";
			echo '</div>';

			// Afficher la liste des clients
			listerAcheteurs();

		echo "</div>";

		if ($resultat == true) {
			$retour = 1;
		}
	}
	catch (Exception $e) { // Erreur
		echo "<p>Erreur lors de la connexion à la BDD : ".$e->getMessage()."</p>";
	}

	return $retour;
}

function selectionnerProduits($NomPr){
	// Auteur Nathan Aubinais
	$retour=0;
	try {
		$madb = new PDO('sqlite:bdd/ventesClient.sqlite'); 
		// filtrer les paramètres 
		$NomPr = $madb->quote($NomPr);
		$requete = "SELECT Acheteurs.NomP as Clients, Produits.NomP as Produits, Achat.Qte as Quantité
		FROM Achat 
		INNER JOIN Produits ON  Produits.IdP = Achat.IdP
		INNER JOIN Acheteurs ON  Acheteurs.IdC = Achat.IdC
		WHERE Produits.NomP = $NomPr;";
		// On utilise pas query, on utilise exec lorsque l'on fait une requête qui a vocation à modifier la base
		$resultat = $madb->query($requete);
		$tab = $resultat->fetchAll(PDO::FETCH_ASSOC);

		echo "<div class='col-12 col-lg-7' mb-3>";

			// Afficher un message de succès
			echo "<div class='alert alert-success mt-3' role='alert'>";
				echo "<i class='bi bi-check-circle-fill'></i>";
				echo " Voici la liste des ventes concernant le produit ".$NomPr.".";
			echo '</div>';

			// Afficher la liste des ventes
			if ($tab != null) {
				afficheTableau($tab);
			}

		echo "</div>";

		if ($resultat == true) {
			$retour = 1;
		}
	}
	catch (Exception $e) { // Erreur
		echo "<p>Erreur lors de la connexion à la BDD : ".$e->getMessage()."</p>";
	}

	return $retour;
}

function modifierClient(){
	// Modifie un client dans la bdd puis affiche la bdd
	// Auteur : Yann Plougonven--Lastennet

	// Récupérer les données du formulaire rempli par l'utilisateur
	$new_id_client = $_POST['new_id_client'];
	$new_prenom = $_POST['new_prenom'];
	$new_ville = $_POST['new_ville'];

	// Modifier l'utilisateur dans la BDD
	try {
		// Connexion à la BDD et modification de l'utilisateur
		$madb = new PDO('sqlite:bdd/ventesClient.sqlite'); 
		$rq = "UPDATE Acheteurs SET NomP = '$new_prenom', Ville = '$new_ville' WHERE IdC = $new_id_client";
		$resultat = $madb->query($rq);

		echo "<div class='col-12 col-lg-7' mb-3>";

			// Afficher un message de succès
			echo "<div class='alert alert-success mt-3' role='alert'>";
				echo "<i class='bi bi-check-circle-fill'></i>";
				echo " Le client n°".$new_id_client." (".$new_prenom.") a bien été modifié.";
			echo '</div>';

			// Afficher la liste des clients
			listerClients();

		echo "</div>";
	}
	catch (Exception $e) { // Erreur
		echo "<p>Erreur lors de la connexion à la BDD : ".$e->getMessage()."</p>";
	}
}

function modifierProduit(){
	// Modifie un produit dans la bdd puis affiche la bdd
	// Auteur : Yann Plougonven--Lastennet

	// Récupérer les données du formulaire rempli par l'utilisateur
	$new_id_produit = $_POST['new_id_produit'];
	$new_nom_produit = $_POST['new_nom_produit'];
	$new_prix_produit = $_POST['new_prix_produit'];
	$new_img_produit = $_POST['new_img_produit'];

	// Modifier le produit dans la BDD
	try {
		// Connexion à la BDD et modification du produit
		$madb = new PDO('sqlite:bdd/ventesClient.sqlite'); 
		$rq = "UPDATE Produits SET NomP = '$new_nom_produit', Prix = '$new_prix_produit', Illustration = '$new_img_produit' WHERE IdP = $new_id_produit";
		$resultat = $madb->query($rq);

		echo "<div class='col-12 col-lg-7' mb-3>";

			// Afficher un message de succès
			echo "<div class='alert alert-success mt-3' role='alert'>";
				echo "<i class='bi bi-check-circle-fill'></i>";
				echo " Le produit n°".$new_id_produit." (".$new_nom_produit.") a bien été modifié.";
			echo '</div>';

			// Afficher la liste des produits
			echo "<div class='container-fluid col-12'>";
				listerProduits();
			echo "</div>";

		echo "</div>";
	}
	catch (Exception $e) { // Erreur
		echo "<p>Erreur lors de la connexion à la BDD : ".$e->getMessage()."</p>";
	}
}

function modifierVente(){
	// Modifie une vente dans la bdd puis affiche la bdd
	// Auteur : Yann Plougonven--Lastennet

	// Récupérer les données du formulaire rempli par l'utilisateur
	$new_id_vente = $_POST['new_id_vente'];
	$new_id_produit_vente = $_POST['new_id_produit_vente'];
	$new_id_client_vente = $_POST['new_id_client_vente'];
	$new_quantite_vente = $_POST['new_quantite_vente'];

	// Modifier le produit dans la BDD
	try {
		// Connexion à la BDD et modification du produit
		$madb = new PDO('sqlite:bdd/ventesClient.sqlite'); 
		$rq = "UPDATE Achat SET idP = '$new_id_produit_vente', idC = '$new_id_client_vente', Qte = '$new_quantite_vente' WHERE IdT = $new_id_vente";
		$resultat = $madb->query($rq);

		echo "<div class='col-12 col-lg-7' mb-3>";

			// Afficher un message de succès
			echo "<div class='alert alert-success mt-3' role='alert'>";
				echo "<i class='bi bi-check-circle-fill'></i>";
				echo " La vente n°".$new_id_vente." a bien été modifiée.";
			echo '</div>';

			// Afficher la liste des produits
			echo "<div class='container-fluid col-12'>";
				listerVentes();
			echo "</div>";

		echo "</div>";
	}
	catch (Exception $e) { // Erreur
		echo "<p>Erreur lors de la connexion à la BDD : ".$e->getMessage()."</p>";
	}
}

?>

<?php
// formulaires.php
// Formulaires PHP pour le site web de la SAE23
// Auteurs : Nathan Aubinais et Yann Plougonven-Lastennet


// FORMULAIRE POUR AJOUTER UN PRODUIT QUI PROPOSE DONC DE RENSEIGNER LE NOM DU PRODUIT ET SON PRIX
function FormulaireAjoutProduit(){
	// Auteur : Nathan Aubinais
    // connexion BDD à la BDD
    $madb = new PDO('sqlite:bdd/ventesClient.sqlite');
	// requete qui récupère toutes les info de la table Produits
    $requete = "SELECT idP, NomP, Prix, Illustration FROM Produits";
    $resultat = $madb->query($requete); //var_dump($resultat);echo "<br/>";

    if ($resultat) {
    	$res = $resultat->fetchAll(PDO::FETCH_ASSOC);
    }
	
    ?>
	<!-- Formulaire Pour ajouter un produit-->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset> 
		<!-- Permet de demander de renseigner le Nom du produit -->
		<div class="input-group mb-3">
			<span class="input-group-text" id="inputGroup-sizing-default-produit">Nom Produit</span>
			<input type="text" name="NomP" id="id_NomP" required size="20" class="form-control" aria-label="Sizing example input">
		</div>
		<!-- Permet de demander de renseigner le Prix du produit -->
		<div class="input-group mb-3">
			<span class="input-group-text" id="inputGroup-sizing-default-prix">Prix</span>
			<input type="text" name="Prix" id="id_Prix" required size="20" class="form-control" aria-label="Sizing example input" >	
		</div>
		<!-- Bouton submit pour envoyer les données -->
		<div class="input-group mb-3">
			<button type="submit" class="btn btn-outline-primary">Ajouter le produit</button>
		</div>	
    </fieldset>
    </form>
    <?php
    echo "<br/>";
    }// fin FormulaireAjoutProduit

	function FormulaireAjoutAcheteur(){
		// Auteur : Nathan Aubinais
		// connexion BDD 
		$madb = new PDO('sqlite:bdd/ventesClient.sqlite');
		// Récupération de toutes les infos sur les acheteurs
		$requete = "SELECT idC, NomP, Ville FROM Acheteurs";
		$resultat = $madb->query($requete); //var_dump($resultat);echo "<br/>";

		if ($resultat) {
			$res = $resultat->fetchAll(PDO::FETCH_ASSOC);
		}
		
		?>
		<!-- Formulaire d'ajout d'un acheteur -->
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<fieldset> 
			<!-- Permet de demander de renseigner le Nom d'un Acheteur -->
			<div class="input-group mb-3">
				<span class="input-group-text" id="inputGroup-sizing-default-acheteur">Nom Acheteur </span>
				<input type="text" name="NomA" id="id_NomA" required size="20" class="form-control" aria-label="Sizing example input" >
			</div>
			<!-- Permet de demander de renseigner le Nom de la ville -->
			<div class="input-group mb-3">
				<span class="input-group-text" id="inputGroup-sizing-default-city">Ville </span>
				<input type="text" name="Ville" id="id_Ville" required size="20" class="form-control" aria-label="Sizing example input">
			</div>
			<!-- Bouton avec submit pour Ajouter l'acheteur dans la base -->
			<div class="input-group mb-3">
				<button type="submit" class="btn btn-outline-primary">Ajouter le client</button>
			</div>
		</fieldset>
		</form>
		<?php
		echo "<br/>";
		}// fin FormulaireAjoutAcheteur

		function FormulaireAjoutVente(){
			// Auteur : Nathan Aubinais
			// connexion BDD 
			$madb = new PDO('sqlite:bdd/ventesClient.sqlite');
			// Récupération de l'identifiant de l'acheteur et du produit renseigné grace aux noms avec également la quantité d'achat 
			$requete = "SELECT Acheteurs.idC, Produits.idP, Achat.Qte FROM Achat INNER JOIN Acheteurs ON Achat.idC = Acheteurs.idC INNER JOIN Produits ON Achat.idP = Produits.idP ;";
			$resultat = $madb->query($requete); //var_dump($resultat);echo "<br/>";
			
			if ($resultat) {
				$res = $resultat->fetchAll(PDO::FETCH_ASSOC);
			}
			
			?>
			<!-- Formulaire d'ajout d'une vente à partir des noms du produit et de l'acheteur -->
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<fieldset>
				<!-- Permet de demander de renseigner le Nom e l'acheteur -->
				<div class="input-group mb-3">
					<span class="input-group-text" id="inputGroup-sizing-default-acheteur-name">Nom Acheteur </span>
					<input type="text" name="NameA" id="id_NameA" required size="20" class="form-control" aria-label="Sizing example input" >
				</div>
				<!-- Permet de demander de renseigner le Nom du produit -->
				<div class="input-group mb-3">
					<span class="input-group-text" id="inputGroup-sizing-default-produit-name">Nom Produit </span>
					<input type="text" name="NameP" id="id_NameP" required size="20" class="form-control" aria-label="Sizing example input">
				</div>
				<!-- Permet de demander la quantité, le nombre d'achat -->
				<div class="input-group mb-3">
					<span class="input-group-text" id="inputGroup-sizing-default-quantite">Quantité </span>
					<input name="Qte" id="id_Qte" required size="20" class="form-control" aria-label="Sizing example input">
				</div>
				<!-- Bouton submit pour ajouter la vente  -->
				<div class="input-group mb-3">
					<button type="submit" class="btn btn-outline-primary">Ajouter la vente</button>
				</div>
			</fieldset>
			</form>
			<?php
			echo "<br/>";
			}// fin FormulaireAjoutVente

function FormulaireChoixProduit2($choix){
	// Auteur : Nathan Aubinais

	$madb = new PDO('sqlite:bdd/ventesClient.sqlite'); 
	// ajoute des quote à la variable choix qui est de type str
	$mail = $madb->quote($choix);
	// Récupération de toutes les infos de la table Produits
	$requete = "SELECT * FROM Produits;";
	$resultat = $madb->query($requete);
	if ($resultat) {
		$Produits = $resultat->fetchAll(PDO::FETCH_ASSOC);
	}

	?>		
		<!-- Captcha de sécurité -->
		<div class="col-md-6">
			<label for="captcha4" class="form-label">Captcha</label>
			<div class="input-group ">

				<!-- Image du captcha -->
				<div class="input-group-text">
					<img src="images/image_captcha.php" onclick="this.src='images/image_captcha.php?' + Math.random();" alt="captcha" style="cursor:pointer;">
				</div>
				<!-- Emplacement de réponse -->
				<input type="text" name="captcha4" class="form-control" placeholder="Captcha" id="captcha4" autocomplete="off">
			
			</div>
		</div>
		<!-- Formulaire de selcetion de suppression d'un produit -->
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<fieldset> 
				<select id="id_NomP" name="NomP" size="1" class="form-select" aria-label="Default select example">
				<?php
					// Récupère le nom de tous les produits pour les proposer dans une sorte de menu déroulant
					foreach ($Produits as $produit) {
						echo '<option value="'.$produit["NomP"]. '">' .$produit["NomP"]. '</option>';
					}
					
				echo '</select>';
					
					if ($choix == 'supprimer') {
						echo '<button type="submit" class="btn btn-outline-danger">Supprimer</button>';
					}						
				?>
			</fieldset>
		</form>
	<?php
		echo "<br/>";
	}

function FormulaireChoixAcheteur($choix){
	// Auteur : Nathan Aubinais
	$madb = new PDO('sqlite:bdd/ventesClient.sqlite'); 
	$mail = $madb->quote($choix);
	// Récupère toutes les infos sur la table Acheteurs
	$requete = "SELECT * FROM Acheteurs;";
	$resultat = $madb->query($requete);
	if ($resultat) {
		$Acheteurs = $resultat->fetchAll(PDO::FETCH_ASSOC);
	}
	
	?>

	<!-- Captcha de sécurité -->
	<div class="col-md-6">
		<label for="captcha5" class="form-label">Captcha</label>
		<div class="input-group ">

			<!-- Image du captcha -->
			<div class="input-group-text">
				<img src="images/image_captcha.php" onclick="this.src='images/image_captcha.php?' + Math.random();" alt="captcha" style="cursor:pointer;">
			</div>
			<!-- Emplacement de réponse -->
			<input type="text" name="captcha5" class="form-control" placeholder="Captcha" id="captcha5" autocomplete="off">
			
		</div>
	</div>

	<!-- Formulaire de suppression d'un acheteur avec possibilité de selection via un menu déroulant -->
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<fieldset>
			<select id="id_NomA" name="NomA" size="1" class="form-select" aria-label="Default select example">
				<?php
				// Récupère le nom des acheteurs pour les proposer dans un menu déroulant
				foreach ($Acheteurs as $acheteur) {
					echo '<option value="'.$acheteur["NomP"]. '">' .$acheteur["NomP"]. '</option>';
				}
				
			echo '</select>';

				if ($choix == 'supprimer') {
					echo '<button type="submit" class="btn btn-outline-danger">Supprimer</button>';
				}
	

						
			?>
		</fieldset>
	</form>
	<?php
		echo "<br/>";
	}

	function FormulaireSelection(){
		// Auteur : Nathan Aubinais
		$madb = new PDO('sqlite:bdd/ventesClient.sqlite'); 
		// Récupère toutes les infos sur la table Acheteurs
		$requete = "SELECT * FROM Produits;";
		$resultat = $madb->query($requete);
		if ($resultat) {
			$Produits = $resultat->fetchAll(PDO::FETCH_ASSOC);
		}
		
		?>
	
		<!-- Formulaire de suppression d'un acheteur avec possibilité de selection via un menu déroulant -->
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<fieldset>
				<select id="id_NomPr" name="NomPr" size="1" class="form-select" aria-label="Default select example">
					<?php
					// Récupère le nom des acheteurs pour les proposer dans un menu déroulant
					foreach ($Produits as $produit) {
						echo '<option value="'.$produit["NomP"]. '">' .$produit["NomP"]. '</option>';
					}
					
				echo '</select>';
	

				echo '<button type="submit" class="btn btn-outline-primary">Selectionner</button>';
					
				?>
			</fieldset>
		</form>
		<?php
			echo "<br/>";
		}


function formulaireChoixClient($type_modif) {
	// Formulaire permettant de choisir un client par son ID.
	// Appelle ensuite le formulaire de modification du client ou la fonction de suppression du client.
	// Prend en paramètre le type de modification à effectuer (str) : "modifier" ou "supprimer"
	// Auteur : Yann Plougonven--Lastennet

	// Connexion BDD et récupération des clients
	$madb = new PDO('sqlite:bdd/ventesClient.sqlite');
	$rq = "SELECT * FROM Acheteurs";
	$resultat = $madb->query($rq);
	$tab = $resultat->fetchAll(PDO::FETCH_ASSOC);

	// Convertir le tableau des clients en chaine JSON traitable par javascript
	$jsontab = json_encode($tab);

	?>

	<!-- Formulaire de choix du client -->
	<form class="row g-3" action="modification.php" method="post">

		<!-- Titre du formulaire dynamique selon l'action demandée -->
		<?php
			echo "<h5>1. Choisissez le profil client à ".$type_modif.".</h5>"
		?>

		<!-- ID du client recherché -->
		<div class="col-md-3">
			<!-- A chaque lettre tapée, chercherClientParSonID() est appellé et complète le formulaire -->
			<label for="id_client" class="form-label">ID Client</label>
			<input type="text" name="id_client" class="form-control" autocomplete="off" placeholder="ID client" 
				id="id_client" onkeyup='chercherClientParSonID(<?php echo $jsontab ?>)'>
		</div>

		<!-- Prénom du client recherché (champ non modifiable)-->
		<div class="col-md-4">
			<label for="prenom" class="form-label">Prénom</label>
			<input readonly type="text" name="prenom" class="form-control" placeholder="Prénom" id="prenom">
		</div>

		<!-- Ville du client recherché (champ non modifiable)-->
		<div class="col-md-4">
			<label for="ville" class="form-label">Ville</label>
			<input readonly type="text" name="ville" class="form-control" placeholder="Ville" id="ville">
		</div>

		<!-- Captcha de sécurité -->
		<div class="col-md-3">
			<label for="captcha_1" class="form-label">Captcha</label>
			<div class="input-group ">

				<!-- Image du captcha -->
				<div class="input-group-text">
					<img src="images/image_captcha.php" onclick="this.src='images/image_captcha.php?' + Math.random();" alt="captcha" style="cursor:pointer;">
				</div>
				<!-- Emplacement de réponse -->
				<input type="text" name="captcha_1" class="form-control" placeholder="Captcha" id="captcha_1" autocomplete="off">
			
			</div>
		</div>

		<!-- Bouton de validation -->
		<div class="col-12 mb-3">
			<button type="submit" class="btn btn-primary">Continuer</button>
		</div>

	</form>

	<?php
		// Quand le formulaire est envoyé...
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			// Vérifier si l'utilisateur a bien renseigné l'ID du client à modfier
			if(!empty($_POST['id_client'])) {

				// Si captcha OK : Affichage du formulaire de modification ou de suppression
				if($_POST['captcha_1']==$_SESSION['code']){

					// Enregistrement des données pré-renseignée, dans une variable de session
					$_SESSION['id_client'] = $_POST['id_client'];
					$_SESSION['prenom'] = $_POST['prenom'];
					$_SESSION['ville'] = $_POST['ville'];

					// appel de la fonction PHP affichage du formulaire de modification ou de suppression
					if ($type_modif == "modifier") {
						formulaireModificationClient();
					}
					elseif ($type_modif == "supprimer") {
						formulaireSuppressionClient();
					}
					else {
						echo "<p class='msg_erreur'>Erreur : type de modification non reconnu dans formulaires.php.</p>";
					}

				}

				// Si captcha faux : message d'erreur
				else {
					if (empty($_POST['id_vente']) && empty($_POST['id_produit'])) {
						echo "<p class='msg_erreur'>Le code du captcha est invalide !</p>";
					}
				}
			}

			else { // ID client non renseigné : message d'erreur
				echo "<p class='msg_erreur'>Veuillez renseigner l'ID du client à modifier.</p>";
			}
		}
} // fin formulaireChoixClient


function formulaireModificationClient() {
	// Formulaire de modification d'un client
	// Auteur : Yann Plougonven--Lastennet
	?>

	<!-- Formulaire de choix du client -->
	<form class="row g-3" onsubmit="event.preventDefault(); requeteAJAX('fonctions', 'modif_client');">

		<h5>2. Effectuez les modifications</h5>

		<!-- ID du client recherché -->
		<div class="col-md-3">
			<label for="new_id_client" class="form-label">ID Client</label>
			<input readonly type="text" name="new_id_client" value=<?php echo $_SESSION['id_client'];?> class="form-control" placeholder="ID client" id="new_id_client">
		</div>

		<!-- Prénom du client à modifier -->
		<div class="col-md-4">
			<label for="new_prenom" class="form-label">Prénom</label>
			<input type="text" name="new_prenom" value=<?php echo $_SESSION['prenom'];?> class="form-control" placeholder="Prénom" id="new_prenom">
		</div>

		<!-- Ville du client à modifier -->
		<div class="col-md-4">
			<label for="new_ville" class="form-label">Ville</label>
			<input type="text" name="new_ville" value=<?php echo $_SESSION['ville'];?> class="form-control" placeholder="Ville" id="new_ville">
		</div>

		<!-- Bouton de validation -->
		<div class="col-12 mb-3">
			<button type="submit" class="btn btn-primary" id="btn_demande_modif">Modifier</button>
		</div>

	</form>

	<?php
} // fin formulaireModificationClient

function formulaireChoixProduit($type_modif) {
	// Formulaire permettant de choisir un produit par son nom.
	// Appelle ensuite le formulaire de modification du produit, ou la fonction de suppression du produit.
	// Prend en paramètre le type de modification à effectuer (str) : "modifier" ou "supprimer"
	// Auteurs : Yann Plougonven--Lastennet et Nathan Aubinais

	// Connexion BDD et récupération des clients
	$madb = new PDO('sqlite:bdd/ventesClient.sqlite');
	$rq = "SELECT * FROM Produits";
	$resultat = $madb->query($rq);
	$tab = $resultat->fetchAll(PDO::FETCH_ASSOC);
	$etat_produits = array();

	// Convertir le tableau des produits en chaine JSON traitable par javascript
	$jsontab = json_encode($tab);

	?>

	<!-- Formulaire de choix du client -->
	<form class="row g-3" action="modification.php#effectuer_modif_produit" method="post">

		<!-- Titre du formulaire dynamique selon l'action demandée -->
		<?php
			echo "<h5>1. Choisissez le produit à ".$type_modif.".</h5>"
		?>

		<!-- Etat du produit recherché -->
		<div class="col-md-2">
			<label for="etat_produit" class="form-label">Etat du produit</label>
			<!-- A chaque état de produit sélectionné, chercherProduitParSonEtat() est appellé et complète le formulaire -->
			<select name="etat_produit" class="form-select" id="etat_produit" 
				onchange='chercherProduitParSonEtat(<?php echo $jsontab ?>)'>
				<?php
					foreach ($tab as $produit) {
						if (!in_array($produit["Etat"], $etat_produits)) {
							$etat_produits[] = $produit["Etat"];
							echo '<option value="'.$produit["Etat"]. '">' .$produit["Etat"]. '</option>';
						}
					}
				?>
			</select>
		</div>

		<!-- ID du produit recherché -->
		<div class="col-md-1">
			<!-- A chaque lettre tapée, chercherProduitParSonID() est appellé et complète le formulaire -->
			<label for="id_produit" class="form-label">ID Produit</label>
			<input type="text" name="id_produit" class="form-control" autocomplete="off" placeholder="ID produit" 
				id="id_produit" onkeyup='chercherProduitParSonID(<?php echo $jsontab ?>)'>
		</div>

		<!-- Nom du produit recherché -->
		<div class="col-md-2">
			<label for="nom_produit" class="form-label">Nom du produit</label>
			<!-- A chaque nom de produit sélectionné, chercherProduitParSonNom() est appellé et complète le formulaire -->
			<select name="nom_produit" class="form-select" id="nom_produit" 
				onchange='chercherProduitParSonNom(<?php echo $jsontab ?>)'>
				<?php
					foreach ($tab as $produit) {
						echo '<option value="'.$produit["NomP"]. '">' .$produit["NomP"]. '</option>';
					}
				?>
			</select>
		</div>

		<!-- Prix du produit recherché (champ non modifiable) -->
		<div class="col-md-1">
			<label for="prix_produit" class="form-label">Prix</label>
			<input readonly type="text" name="prix_produit" class="form-control" placeholder="prix" id="prix_produit">
		</div>

		<!-- Lien de l'image du produit recherché (champ non modifiable) -->
		<div class="col-md-5">
			<label for="img_produit" class="form-label">Lien de l'image</label>
			<input readonly type="text" name="img_produit" class="form-control" placeholder="Image d'illustration" id="img_produit">
		</div>

		<!-- Captcha de sécurité -->
		<div class="col-md-3">
			<label for="captcha2" class="form-label">Captcha</label>
			<div class="input-group ">

				<!-- Image du captcha -->
				<div class="input-group-text">
					<img src="images/image_captcha.php" onclick="this.src='images/image_captcha.php?' + Math.random();" alt="captcha" style="cursor:pointer;">
				</div>
				<!-- Emplacement de réponse -->
				<input type="text" name="captcha2" class="form-control" placeholder="Captcha" id="captcha2" autocomplete="off">
			
			</div>
		</div>

		<!-- Bouton de validation -->
		<div class="col-12 mb-3">
			<?php
				if ($type_modif == "modifier") {
					echo '<button type="submit" class="btn btn-primary">Continuer</button>';
				}
				elseif ($type_modif == "supprimer") {
					echo '<button type="submit" class="btn btn-primary">Supprimer</button>';
				}
			?>
		</div>

	</form>

	<?php
		// Quand le formulaire est envoyé...
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			// Vérifier si l'utilisateur a bien renseigné l'ID du client à modfier
			if(!empty($_POST['id_produit'])) {

				// Si captcha OK : Affichage du formulaire de modification ou de suppression
				if($_POST['captcha2']==$_SESSION['code']){

					// Enregistrement des données pré-renseignée, dans une variable de session
					$_SESSION['id_produit'] = $_POST['id_produit'];
					$_SESSION['nom_produit'] = $_POST['nom_produit'];
					$_SESSION['prix_produit'] = $_POST['prix_produit'];
					$_SESSION['img_produit'] = $_POST['img_produit'];

					// appel de la fonction PHP affichage du formulaire de modification ou de suppression
					if ($type_modif == "modifier") {
						formulaireModificationProduit();
					}
					elseif ($type_modif == "supprimer") {
						// Nathan, tu peux utiliser ça je pense
						supprimerProduit();
					}
					else {
						echo "<p class='msg_erreur'>Erreur : type de modification non reconnu dans formulaires.php.</p>";
					}

				}

				// Si captcha faux : message d'erreur
				else {
					echo "<p class='msg_erreur'>Le code du captcha est invalide !</p>";
				}
			}

			else { // ID client non renseigné : message d'erreur
				if (empty($_POST['id_vente']) && empty($_POST['id_client'])) {
					echo "<p class='msg_erreur'>Veuillez renseigner le produit à modifier.</p>";
				}
			}
		}
} // fin formulaireChoixClient


function formulaireModificationProduit() {
	// Formulaire de modification d'un produit
	// Auteur : Yann Plougonven--Lastennet
	?>

	<!-- Formulaire de choix du client -->
	<form class="row g-3" onsubmit="event.preventDefault(); requeteAJAX('fonctions', 'modif_produit');">

		<!-- Titre du formulaire (avec un ID pour pouvoir faire défiler automatique la page
		jusqu'à ce titre en ajoutant #effectuer_modif_produit dans l'URL) -->
		<h5 id="effectuer_modif_produit">2. Effectuez les modifications</h5>

		<!-- ID du produit recherché -->
		<div class="col-md-2">
			<label for="new_id_produit" class="form-label">ID Produit</label>
			<input readonly type="text" name="new_id_produit" value=<?php echo $_SESSION['id_produit'];?> class="form-control" placeholder="ID produit" id="new_id_produit">
		</div>

		<!-- Nom du produit à modifier -->
		<div class="col-md-3">
			<label for="new_nom_produit" class="form-label">Nom du produit</label>
			<input type="text" name="new_nom_produit" value=<?php echo $_SESSION['nom_produit'];?> class="form-control" placeholder="Nom du produit" id="new_nom_produit">
		</div>

		<!-- Prix du produit à modifier -->
		<div class="col-md-1">
			<label for="new_prix_produit" class="form-label">Prix</label>
			<input type="text" name="new_prix_produit" value=<?php echo $_SESSION['prix_produit'];?> class="form-control" placeholder="Prix" id="new_prix_produit">
		</div>

		<!-- Lien de l'image du produit à modifier -->
		<div class="col-md-5">
			<label for="new_img_produit" class="form-label">Lien de l'image</label>
			<input type="text" name="new_img_produit" value=<?php echo $_SESSION['img_produit'];?> class="form-control" placeholder="Image d'illustration" id="new_img_produit">
		</div>

		<!-- Bouton de validation -->
		<div class="col-12 mb-3">
			<button type="submit" class="btn btn-primary" id="btn_demande_modif">Modifier</button>
		</div>

	</form>

	<?php

}

function formulaireChoixVente($type_modif) {
	// Formulaire permettant de choisir une vente par son ID.
	// Appelle ensuite le formulaire de modification de la vente ou la fonction de suppression de la vente.
	// Prend en paramètre le type de modification à effectuer (str) : "modifier" ou "supprimer"
	// Auteur : Yann Plougonven--Lastennet

	// Connexion BDD et récupération des ventes et du nom des produits et des clients liés à ces ventes
	$madb = new PDO('sqlite:bdd/ventesClient.sqlite');
	$rq = "SELECT Achat.idT as idT, Achat.idP as idP, Achat.idC as idC, Achat.Qte as Qte, 
	Acheteurs.NomP as nomAcheteur, Produits.nomP as nomProduit FROM Achat 
	INNER JOIN Produits ON Achat.idP = Produits.idP 
	INNER JOIN Acheteurs ON Achat.idC = Acheteurs.idC";
	$resultat = $madb->query($rq);
	$tab = $resultat->fetchAll(PDO::FETCH_ASSOC);

	// Convertir le tableau des ventes en chaine JSON traitable par javascript
	$jsontab = json_encode($tab);

	?>

	<!-- Formulaire de choix de la vente -->
	<form class="row g-3" action="modification.php#effectuer_modif_vente" method="post">

		<!-- Titre du formulaire dynamique selon l'action demandée -->
		<?php
			echo "<h5>1. Choisissez la vente à ".$type_modif.".</h5>"
		?>

		<!-- ID de la vente recherchée -->
		<div class="col-md-3">
			<!-- A chaque lettre tapée, chercherVenteParSonID() est appellé et complète le formulaire -->
			<label for="id_vente" class="form-label">ID Vente</label>
			<input type="text" name="id_vente" class="form-control" autocomplete="off" placeholder="ID vente" 
				id="id_vente" onkeyup='chercherVenteParSonID(<?php echo $jsontab ?>)'>
		</div>

		<!-- ID du produit vendu lors de la vente recherchée -->
		<div class="col-md-3">
			<label for="id_produit_vente" class="form-label">ID du produit vendu</label>
			<input readonly type="text" name="id_produit_vente" class="form-control" placeholder="ID Produit vendu" id="id_produit_vente">
		</div>

		<!-- ID du client ayant acheté lors de la vente recherchée -->
		<div class="col-md-3">
			<label for="id_client_vente" class="form-label">ID Client</label>
			<input readonly type="text" name="id_client_vente" class="form-control" placeholder="ID Client" id="id_client_vente">
		</div>

		<!-- Quantité vendue lors de la vente recherchée -->
		<div class="col-md-2">
			<label for="quantite_vente" class="form-label">Quantité vendue</label>
			<input readonly type="text" name="quantite_vente" class="form-control" placeholder="Quantité vendue" id="quantite_vente">
		</div>

		<!-- Captcha de sécurité -->
		<div class="col-md-3">
			<label for="captcha3" class="form-label">Captcha</label>
			<div class="input-group ">

				<!-- Image du captcha -->
				<div class="input-group-text">
					<img src="images/image_captcha.php" onclick="this.src='images/image_captcha.php?' + Math.random();" alt="captcha" style="cursor:pointer;">
				</div>
				<!-- Emplacement de réponse -->
				<input type="text" name="captcha3" class="form-control" placeholder="Captcha" id="captcha3" autocomplete="off">
			
			</div>
		</div>

		<!-- Nom du produit vendu lors de la vente recherchée -->
		<div class="col-md-3">
			<label for="nom_produit_vente" class="form-label">Nom du produit vendu</label>
			<input readonly type="text" name="nom_produit_vente" class="form-control" placeholder="Nom du produit vendu" id="nom_produit_vente">
		</div>

		<!-- Nom du client ayant acheté lors de la vente recherchée -->
		<div class="col-md-3">
			<label for="nom_client_vente" class="form-label">Nom du client</label>
			<input readonly type="text" name="nom_client_vente" class="form-control" placeholder="Nom du client" id="nom_client_vente">
		</div>

		<!-- Bouton de validation -->
		<div class="col-12 mb-3">
			<button type="submit" class="btn btn-primary" id="btn_choix_vente">Continuer</button>
		</div>

	</form>

	<?php
		// Quand le formulaire est envoyé...
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			// Vérifier si l'utilisateur a bien renseigné l'ID de la vente à modifier
			if(!empty($_POST['id_vente'])) {

				// Si captcha OK : Affichage du formulaire de modification ou de suppression
				if($_POST['captcha3']==$_SESSION['code']){

					// Enregistrement des données pré-renseignée, dans une variable de session
					$_SESSION['id_vente'] = $_POST['id_vente'];
					$_SESSION['id_produit_vente'] = $_POST['id_produit_vente'];
					$_SESSION['id_client_vente'] = $_POST['id_client_vente'];
					$_SESSION['quantite_vente'] = $_POST['quantite_vente'];

					// appel de la fonction PHP affichage du formulaire de modification ou de suppression
					if ($type_modif == "modifier") {
						formulaireModificationVente();
					}
					elseif ($type_modif == "supprimer") {
						formulaireSuppressionVente();
					}
					else {
						echo "<p class='msg_erreur'>Erreur : type de modification non reconnu dans formulaires.php.</p>";
					}

				}

				// Si captcha faux : message d'erreur
				else {
					echo "<p class='msg_erreur'>Le code du captcha est invalide !</p>";
				}
			}

			else { // ID client non renseigné : message d'erreur
				if (empty($_POST['id_produit']) && empty($_POST['id_client'])) {
					echo "<p class='msg_erreur'>Veuillez renseigner l'ID de la vente à modifier.</p>";
				}
			}
		}
} // fin formulaireChoixClient


function formulaireModificationVente() {
	// Formulaire de modification d'une vente
	// Auteur : Yann Plougonven--Lastennet
	?>

	<!-- Formulaire de choix du client -->
	<form class="row g-3" onsubmit="event.preventDefault(); requeteAJAX('fonctions', 'modif_vente');">

		<!-- Titre du formulaire (avec un ID pour pouvoir faire défiler automatique la page
		jusqu'à ce titre en ajoutant #effectuer_modif_vente dans l'URL) -->
		<h5 id="effectuer_modif_vente">2. Effectuez les modifications</h5>

		<!-- ID de la vente recherchée -->
		<div class="col-md-3">
			<label for="new_id_vente" class="form-label">ID Vente</label>
			<input readonly type="text" name="new_id_vente" value=<?php echo $_SESSION['id_vente'];?> class="form-control" placeholder="ID vente" id="new_id_vente">
		</div>

		<!-- ID du produit vendu lors de la vente recherchée -->
		<div class="col-md-3">
			<label for="new_id_produit_vente" class="form-label">ID du produit vendu</label>
			<input type="text" name="new_id_produit_vente" value=<?php echo $_SESSION['id_produit_vente'];?> class="form-control" placeholder="ID Produit vendu" id="new_id_produit_vente">
		</div>

		<!-- ID du client ayant acheté lors de la vente recherchée -->
		<div class="col-md-3">
			<label for="new_id_client_vente" class="form-label">ID Client</label>
			<input type="text" name="new_id_client_vente" value=<?php echo $_SESSION['id_client_vente'];?> class="form-control" placeholder="ID Client" id="new_id_client_vente">
		</div>

		<!-- Quantité vendue lors de la vente recherchée -->
		<div class="col-md-2">
			<label for="new_quantite_vente" class="form-label">Quantité vendue</label>
			<input type="text" name="new_quantite_vente" value=<?php echo $_SESSION['quantite_vente'];?> class="form-control" placeholder="Quantité vendue" id="new_quantite_vente">
		</div>

		<!-- Bouton de validation -->
		<div class="col-12 mb-3">
			<button type="submit" class="btn btn-primary" id="btn_demande_modif">Modifier</button>
		</div>

	</form>

	<?php
} // fin formulaireModificationVente

?>
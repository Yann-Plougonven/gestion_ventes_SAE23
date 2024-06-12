<?php
// image_captca.php
// Image Captcha générée par PHP
// Auteur : Yann Plougonven-Lastennet

session_start();

// Indiquer que ce fichier doit être affiché comme une image
header('Content-Type: image/png');
$largeur = 80; //largeur de l'image
$hauteur = 25; //hauteur de l'image
$lignes = 15; //nombre de lignes multicolores affichées derrière le code

// Créer le fond de l'image (rectangle uni + lignes aléatoires colorée)
$image = imagecreatetruecolor($largeur, $hauteur); // créer le fond de l'image
imagefilledrectangle($image, 0, 0, $largeur, $hauteur, imagecolorallocate($image, 233, 236, 239)); // couleur du fond : gris clair

function hexargb($hex) {
    // retourne la valeur en RGB d'une couleur hexadécimale
    return array("r"=>hexdec(substr($hex,0,2)),"g"=>hexdec(substr($hex,2,2)),"b"=>hexdec(substr($hex,4,2)));//on retourne la valeur sous forme d'array
}

for($i=0;$i<=$lignes;$i++){ // ajouter les lignes multicolores
    $rgb=hexargb(substr(str_shuffle("ABCDEF0123456789"),0,6)); // générer une couleur aléatoire
    imageline($image,rand(1,$largeur-25),rand(1,$hauteur),rand(1,$largeur+25),rand(1,$hauteur),imagecolorallocate($image, $rgb['r'], $rgb['g'], $rgb['b']));
}

// Créer le code
$caracteres="ABCDEFGHIJ123456789";
$code1=substr(str_shuffle($caracteres),0,4);

// Enregistrer la réponse (le code) dans la session
$_SESSION['code'] = $code1;
$code = "";

// Ajouter des espaces entre chaque lettre ou chiffre pour aérer l'image
for($i=0;$i<=strlen($code1);$i++){
    $code .=substr($code1,$i,1)." ";
}

// Écrire le code sur l'image
imagestring($image, 5, 10, 5, $code, imagecolorallocate($image, 0, 0, 0));

// Afficher l'image puis la détruire pour libérer de l'espace
imagepng($image);
imagedestroy($image);

?>
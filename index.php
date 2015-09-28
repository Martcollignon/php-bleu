<body>
		
		<div class="container ">
<?php
error_reporting(E_WARNING | E_ERROR);


if(count($_POST)>0){

	// HONEY POT CHECK
	if($_POST['honeypot'] != ''){
		die("Dégage, raclure de spameur");
	}
	
	echo $naissance;
	
	// NETTOYAGE
	
	$nom = trim($_POST['nom']);
	$nom = strip_tags($nom);
	
	$email = trim($_POST['email']);
	$email = strip_tags($email);
	
	$naissance = $_POST['naissance'];
	
	$adresse = trim($_POST['adresse']);
	$adresse = strip_tags($adresse);
	
	$ville = trim($_POST['ville']);
	$ville = strip_tags($ville);
	
	$commune = trim($_POST['commune']);
	$commune = strip_tags($commune);
	
	$pourquoi = $_POST['pourquoi'];
	
	$message = "Message de " . $nom . " envoyé depuis l'adresse " . $email . "\r\n" . "Adresse : " . $adresse . ", " . $ville . ", " . $commune . "\r\n" . "Si je rejoins les bleus, c'est pour " . $pourquoi;
	
	function sujet( ){
		return "Message de " . $nom;
	}
	
	$sujet = sujet( $mail );
	
	
	// VALIDATION
	
	
	$erreur = false;
	
	if($nom==""){
		echo "<div class='alert alert-dismissible alert-danger'> Oh! Il semble que le nom est vide... Retournons au formulaire</div>";
		$erreur = true;
	}
	
	if(!preg_match("/^[a-zA-Z ]*$/",$nom)){
		echo "<div class='alert alert-dismissible alert-danger'> Apparement le champ nom n est pas correcte, réessayons... </div>";
		$erreur = true;
	}
	
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo "<div class='alert alert-dismissible alert-danger'> Oh! Il semble que le email n est pas valide... Retournons au formulaire </div>";
		$erreur = true;
	}
	
	if($email==""){
		echo "<div class='alert alert-dismissible alert-danger'> Oh! Il semble que votre email n'ait pas été complété... Retournons au formulaire! </div>";
		$erreur = true;
	}
	
	if(empty($naissance)){
		echo "<div class='alert alert-dismissible alert-danger'> Oh! Il semble que votre date de naissance n'ait pas été complété... Retournons au formulaire! </div>";
		$erreur = true;
	}
	
	
	if(empty($pourquoi)){
		echo "<div class='alert alert-dismissible alert-danger'> Oh! Il semblerait qu'aucune raison n'ait été coché... Retournons au formulaire! </div>";
		$erreur = true;
	}
	
	if($erreur == false){
		$result = mail( 'martincollignon@gmail.com', $sujet, $message);
		mail( '$email', 'Formulaire pour devenir un bleu', $message);
		
		if($result){
			echo "<div class='alert alert-dismissible alert-success'> Le formulaire à bien été envoyé! Merci de ta participation et à bien vite!</div>";
		}else{
			echo "<div class='alert alert-dismissible alert-success'> L envoi du mail s est mal passé</div>";
		}
		
	}
	
}

include('header.php');

?>




	
				
			
				
			<h1>Formulaire pour rejoindre les bleus!</h1>
			<p class="text-primary">Tu veux faire partie des bleus de l'HEAJ, alors rempli ce formulaire afin d'en faire partie !</p>
			<p class="text-danger">Les champs marqué * sont obligatoirement à remplir</p>
			
			
			<form method="post" class="form-horizontal">
				<div class="form-group">
					<label class="col-lg-2 control-label" for="nom">Nom & prénom <div class="text-danger">*</div></label>
					<div class="col-lg-10">
						<input type="text" name="nom" class="form-control" value="<?php if (isset($_POST['nom'])){echo $_POST['nom'];} ?>" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="email" class="col-lg-2 control-label">Email <div class="text-danger">*</div></label>
					<div class="col-lg-10">
						<input type="text" name="email" class="form-control" value="<?php if (isset($_POST['email'])){echo $_POST['email'];} ?>" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="naissance" class="col-lg-2 control-label">Date de naissance <div class="text-danger">*</div></label>
					<div class="col-lg-10">
						<input type="date" name="naissance" class="form-control" value="<?php if (isset($_POST['naissance'])){echo $_POST['naissance'];} ?>" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="honeypot" class="col-lg-2 control-label">Honeypot</label>
					<div class="col-lg-10">
						<input type="text" name="honeypot" class="form-control" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="adresse" class="col-lg-2 control-label">Adresse</label>
					<div class="col-lg-4">
						<textarea name="adresse" class="form-control" rows="1" value="<?php if (isset($_POST['adresse'])){echo $_POST['adresse'];} ?>" ></textarea>
					</div>
					
					<label for="ville" class="col-lg-2 control-label">Ville</label>
					<div class="col-lg-4">
						<input type="text" name="ville"  class="form-control" value="<?php if (isset($_POST['ville'])){echo $_POST['ville'];} ?>" />
					</div>
				</div>
				
				
				<div class="form-group">
					<label for="commune" class="col-lg-2 control-label">Commune</label>
					<div class="col-lg-10">
						<input type="text" name="commune" class="form-control" value="<?php if (isset($_POST['commune'])){echo $_POST['commune'];} ?>" />
					</div>
				</div>
				
				
				<div class="form-group">
			      <label class="col-lg-2 control-label">Pourquoi être un bleu ? <div class="text-danger">*</div></label>
			      <div class="col-lg-10">
			        <div class="radio">
			          <label>
			            <input type= "radio" name="pourquoi" value="boire">
			            Parce que j'adore boire
			          </label>
			        </div>
			        <div class="radio">
			          <label>
			            <input type= "radio" name="pourquoi" value="amis">
			            Parce que je veux me faire des amis
			          </label>
			        </div>
			      </div>
			    </div>
				
				<div class="form-group">
			    	<div class="col-lg-10 col-lg-offset-2">
						<input type="submit" name="submit" class="btn btn-default btn-primary" value="Envoyer" />
						<a href="https://github.com/Martcollignon/php-bleu/blob/master/index.php" target="_blank" class="btn btn-delfault">Lien github</a>
			    	</div>
				</div>
			</form>
		
				
		</div>
		
		
		
		

	</body>
</html>
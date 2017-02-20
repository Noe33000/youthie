<?php 
session_start();
require_once "../inc/connect.php";
include_once 'vendor/autoload.php';
//Si on est connecté, on est redirigé vers l'accueil
if(!empty($_SESSION)){
	header('Location: ../index.php');
}

$error = [];
$post = [];

$showForm = true;
// Traitement des formulaires
if(!empty($_POST)) {
// Nettoyage des données
	foreach($_POST as $key => $value) {
		$post[$key] = trim(strip_tags($value));
	}

    // Traitement du formulaire du mail
    if(isset($post['email'])) {

    	if(filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
    		$req = $conn->prepare('SELECT email FROM students WHERE email= :email');
    		$req->bindValue(':email', $post['email']);
    		$req->execute();

    		$emailExist = $req->fetchColumn();
    		if(!empty($emailExist)) {    // On search une corres avec le mail

    			$token = md5(uniqid()); // Création du token

    			$insert = $db->prepare('INSERT INTO tokens_password (email, token, date_create, date_exp) VALUES (:emailInsert, :tokenInsert, NOW(), NOW() + INTERVAL 2 DAY)');
    			$insert->bindValue(':emailInsert', $post['email']);
    			$insert->bindValue(':tokenInsert', $token);
                //insertion to the db
    			if($insert->execute()) {
                    // we compose a link to send
                    $magicLink = '<a href="'. $_SERVER['HTTP_HOST'].'/etudiant/lost_password.php?email='.$post['email'].'&token='.$token.'">Get new password</a>';

    		       	$mail = new PHPMailer;
    		        //$mail->SMTPDebug = 3;                               // Enable verbose debug output
    		        $mail->isSMTP();                                      // Set mailer to use SMTP
    	        	$mail->Host = 'smtp.mailgun.org';                     // Specify main and backup SMTP servers
    	        	$mail->SMTPAuth = true;                               // Enable SMTP authentication
    	        	$mail->Username = 'postmaster@wf3.axw.ovh';           // SMTP username
    	        	$mail->Password = 'WF3sessionPhilo2';                 // SMTP password
    	        	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    	        	$mail->Port = 587;                                    // TCP port to connect to

    	        	$mail->setFrom('contact@monsupersite.fr', 'contact du site'); //expéditeur
    	        	$mail->addAddress($post['email'], '');                // Add a recipient// Name is optional
    	        	$mail->addReplyTo('info@example.com', 'Information');// si on l'enlève ça renvoie auto à l'expéditeur

    	       	 	$mail->isHTML(true);                                  // Set email format to HTML

    	        	$mail->Subject = 'Here is the subject';
    	        	$mail->Body    = $magicLink;
    	        	$mail->AltBody = $magicLink;

                    if(!$mail->send()) {
                		echo 'Le message ne peut être envoyé.';
               			echo 'Mailer Error: ' . $mail->ErrorInfo;
            		} else {
                        $showForm = false;
               			echo '<p class="noresult-msg">Le message a bien été envoyé sur votre boite de mail et nous vous remercions';
        			}
    			}//fin if insert execute
    		}//if empty emailexist
            else {
                echo 'Votre email n\'est pas enregistré!';
            }
    	}//fin filter var
		else
		{
		$error[] = 'Votre adresse email est incorrecte';
		}
    }// fin if EMPTYpost
}

?>
	<?php require '../inc/header.php'; ?>


	<main>

		<section id="contact" class="module content" style="height:500px;">
			<div class="container">
				<section class="register-section">
					<div class="title-section">
						<div class="container">
							<div style="margin:0 auto;width: 300px;"><h3>Mot de passe perdu ?</h3></div>
						</div>
					</div>
					
					<form action="#" method="post">
						<div style="margin:0 auto;width:300px;">
							<label for="email">Email*</label>
							<input type="text" name="email" id="email" class="form-control" style="width:300px;" required />
							<br>
							<button style="width: 300px;" class="btn btn-default" type="submit">Réinitialiser le mot de passe</button>
						</div>
					</form>
				</section>
				<br><br><span style="font-size:10px;">Les champs requis sont indiqués *</span>
			</div>
		</section>

	</main>


</div>
<!-- GNU General Public License, version 3 (GPL-3.0) -->
</body>
<?php require '../inc/footer.php'; ?>
</html>

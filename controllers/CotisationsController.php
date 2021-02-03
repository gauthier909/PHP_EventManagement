<?php 
class CotisationsController{

		private $_db;

	

	public function __construct($db) {

		$this->_db = $db;

		
	}
		
	public function run(){	
		
		if ($_SESSION['authentifie'] != 'staff') {
			header("Location: index.php?action=entrainement");
			die(); 
		}

		$notification='';
		$notification2='';
		$tabMembresPasEnOrdre='';
		$tabMembresEnOrdre='';
		$list_mail='';
		$tabAnnee=$this->_db->select_annee_mf();
	
		if(!empty($_POST['annee'])){
			$annee=$_POST['annee'];
		}
		else {
			$annee=2018;
		}
		$tabMembresPasEnOrdrePourMail =$this->_db->select_pasEnOrdre($annee);
		
		if(!empty($_POST['envoieCotisation'])){
			if(empty($_POST['cout']) || empty($_POST['annee_mf']) || empty($_POST['adresse'])){
				$notification ='Veuillez remplir tout les champs pour débuter une cotisation';
			}
			
			$cout = $_POST['cout'];
			$checkAnnee = $_POST['annee_mf'];
			if(!is_numeric($cout) || !is_numeric($checkAnnee)){
				$notification='Veuillez remplir tout les champs et entrez uniquement des valeurs numériques pour le coût et l\'année';
			}
			
			elseif ($this->_db->exist_mf($_POST['annee_mf'])) {
				$notification='La cotisation pour l\'année choisie existe déjà';
			}


			else{
					
				$this->_db->create_cotisation($_POST['annee_mf'],$_POST['cout']);
				require_once(CHEMIN_CONTROLEURS.'PHPMailer/PHPMailer.php');
				require_once(CHEMIN_CONTROLEURS.'PHPMailer/SMTP.php');
					
				$mail = new PHPMailer(true);                       // true active les exceptions
				try {
					//Server settings
					$mail->SMTPDebug = 0;                          // Disable verbose debug output (=2 pour activer)
					$mail->isSMTP();                               // Set mailer to use SMTP
					$mail->Host = 'in-v3.mailjet.com';         	   // Specify main SMTP server
					$mail->SMTPAuth = true;                        // Enable SMTP authentication
					$mail->Username = '91f74887e79bea526c63100fb9d9f6fd';             // SMTP username
					$mail->Password = 'de1e5dc28c029a7bbc3a3c815d554bfb';           // SMTP password
					$mail->SMTPSecure = 'tls';                     // Enable TLS encryption, 'ssl' also accepted
					$mail->Port = 587;
					$mail->CharSet = 'utf-8';

					
					$mail->setFrom('gauthier.rogerfrance@student.vinci.be', 'Mailjet Mailer');   
				
					for($i=0; $i<count($tabMembresPasEnOrdrePourMail);$i++){
					$mail->addAddress($tabMembresPasEnOrdrePourMail[$i]->html_e_mail(), 'Gauthier');
					}				// Add a recipient
					$mail->addReplyTo(htmlspecialchars($_POST['adresse']), 'Mailer');
					//$mail->addCC('cc@example.com');
					//$mail->addBCC('bcc@example.com');

					//Attachments
					//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
					//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

					//Content
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = 'Cotisation IPL Sport';
					$mail->Body    = 'La cotisation de l\'année s\'élève à '.$_POST['cout']. ' et doit être viré sur le compte BE97 128 125 78';
					//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

					$mail->send();
					$notification='Vos informations ont été transmises avec succès.';
				} catch (Exception $e) {
					$notification='Vos informations n\'ont pas été transmises. '.'Mailer Error: '.$mail->ErrorInfo;
				}
			}
		}


		
		
			
	
	

	
		$cost =$this->_db-> select_cost_membership_fees($annee);

		 if (!empty($_POST['ajouter'])) {
			if (!empty($_POST['payed'])) {
				foreach ($_POST['payed'] as $i => $paiement) {
					if(empty($paiement) || !is_numeric($paiement)){
						$neRienFaire ='';
					}
					else{
						if($this->_db->exist_payement($_POST['no_user'][$i],$_POST['annee'])){
							if($paiement < $cost[0]->cost_mf()){
								$this->_db->update_payement($_POST['no_user'][$i],$_POST['annee'],$paiement,0);
							}
							else{
								$this->_db->update_payement($_POST['no_user'][$i],$_POST['annee'],$paiement,1);
							}
						}
						else {
							if($paiement < $cost[0]->cost_mf()){
								$this->_db->add_payement($_POST['no_user'][$i],$_POST['annee'],$paiement,0);
						}
					else {
						$this->_db->add_payement($_POST['no_user'][$i],$_POST['annee'],$paiement,1);
					}
				}
			}
		}
	
				$notification2 = 'Le paiement a bien été créée';
			} else {
				$notification2 = 'Aucun paiement n\'a été ajouté';
			}
		} 


		
		if(!empty($_POST['delete_payement'])){
			$this->_db->delete_payement($_POST['no_user_delete'],$annee);
		}



		if (!empty($_GET['see']) && $_GET['see']=='all') {
			$list_mail = $this->_db->list_mail($annee) ;
		}
		
		$tabMembresEnOrdre=$this->_db->select_enOrdre($annee);
		$tabMembresPasEnOrdre =$this->_db->select_pasEnOrdre($annee);


		if (!empty($list_mail)) {
			require_once(CHEMIN_VUES . 'cotisations_mail.php');
		} else {
			require_once(CHEMIN_VUES . 'cotisations.php');
		}
	
		
		
	}

}
?>
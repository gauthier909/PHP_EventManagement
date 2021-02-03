<?php

class InscriptionController{

	private $_db;

	public function __construct($db) {

		$this->_db = $db;

	}
			
	public function run(){	

		$notification ='';

		if (!empty($_POST['inscrire'])) {
			if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['telephone']) || empty($_POST['email']) || empty($_POST['codepostale']) || empty($_POST['numerocompte']) || empty($_POST['motdepasse']) || empty($_POST['motdepasse2'])) {
				$notification='Veuillez remplir tout les champs pour vous inscrire';

			}

			elseif (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['telephone']) && !empty($_POST['email']) && !empty($_POST['codepostale']) && !empty($_POST['numerocompte']) && !empty($_POST['motdepasse']) && !empty($_POST['motdepasse2']) && ($_POST['motdepasse'] != $_POST['motdepasse2'])) {
				$notification='Les mots de passe que vous avez entrés ne sont pas identiques';

			}

			else {

				if($this->_db->doublon_user($_POST['email'])){

				if ($this->_db->insert_user($_POST['nom'],$_POST['prenom'],$_POST['telephone'],$_POST['email'],$_POST['codepostale'],$_POST['numerocompte'],NULL,password_hash($_POST['motdepasse'], PASSWORD_BCRYPT),0,0,0))
				{
					$notification='Vous vous êtes inscrit, vous pourrez vous connecter une fois votre compte validé par un responsable';
				}
				} else {
					$notification='Une erreur s\'est produite lors de l\'inscription : l\'adresse email que vous avez entré existe déjà';
				}	
			}
		}

		

		require_once(CHEMIN_VUES . 'inscription.php');
	}
	
	

} 









?>
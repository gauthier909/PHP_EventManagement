<?php

class GestionMembresController {

	private $_db;
	private $_raw_html;

	public function __construct($db) {
		$this->_db = $db;
		$this->_raw_html = '';
	}
		
	public function run(){



		if ($_SESSION['authentifie'] != 'staff') {
			header("Location: index.php?action=entrainement");
			die(); 
		}		


		$tabMembres='';
		$html_motcle='';
		$notification ='';
		$vueupdate = false;
		$vueupdate2 = false;
		$vueupdate3 = false;
		$notification2= '';
		$notification3='';
		$tabevents=$this->_db->select_events();


		if (!empty($_POST['form_recherche']) 
		    && !empty($_POST['keyword'])) {
			$tabMembres=$this->_db->select_membres($_POST['keyword']);
			$html_motcle=htmlspecialchars($_POST['keyword']); # Protection anti XSS à l'affichage
		} else {

			$tabMembres=$this->_db->select_membres();
		}

		if (!empty($_POST['valide'])) {
			if (!empty($_POST['validite'])) {
				foreach ($_POST['validite'] as $i => $no_user) {
					# $no_user = clé primaire
					$this->_db->valide_user($no_user);
				}
				header("Location: index.php?action=gestionMembres");  #On raffraichit la page pour que l'on voit bien qu'ils ont été validé
				$notification = 'Le(s) utilisateur(s) a(ont) bien été validé(s)';
			} else {
				$notification = 'Aucun utilisateur n\'a été ajouté';
			}
		}

		


		if (!empty($_POST['form_enregistrer'])) {
			if (!empty($_POST['role'])) {
				if($this->_db->last_staff($_POST['no_user']) && $this->_db->count_staff()){
					$notification='Vous ne pouvez pas changer le rôle du dernier membre responsable';
				}
				else{
				$this->_db->update_user($_POST['no_user'],$_POST['role']);
				$notification = 'L\'utilisateur a bien été mis à jour';
			}
			} else {
				$notification = 'Veuillez choisir un role';
				$user=$this->_db->select_user($_POST['no_user']);
				$vueupdate = true;
			}
		}

	   if (!empty($_POST['modifierRole'])) {
			if (!empty($_POST['modifrole'])) {
				$user=$this->_db->select_user($_POST['modifrole']);
				$vueupdate = true; 
			} else {
				$notification = 'Aucun utilisateur n\'a été sélectionné';
			}
		}

		if (!empty($_POST['evenement'])) {
			if (empty($_POST['date_debut']) || empty($_POST['date_fin']) || empty($_POST['titre']) || empty($_POST['descriptif']) || empty($_POST['lieu']) ||empty(is_numeric($_POST['cout']))) {
				$notification2 = 'Tout les champs n\'ont pas été remplis afin de créer un évènement ou vous n\'avez pas entré une valeur numérique pour le coût';
			} else {
				$this->_db->create_event($_POST['date_debut'], $_POST['date_fin'] , $_POST['titre'], $_POST['descriptif'], $_POST['lieu'] ,$_POST['cout'], $_POST['url']);
				$notification2 = 'L\'évènement a bien été créée';
			}
		}

		 if (!empty($_POST['modifierEvent'])) {
			if (!empty($_POST['modifEvent'])) {
				$event=$this->_db->select_event_forUpdate($_POST['modifEvent']);
				$vueupdate2 = true; 
			} else {
				$notification3 = 'Aucun évènement n\'a été sélectionné';
			}
		}

		if (!empty($_POST['form_update'])) {
			if(empty(is_numeric($_POST['cout']))){

				$notification3 = 'Veuillez entrez une valeur numérique pour le coût';
				
			}
				else{
				$this->_db->update_event($_POST['num_event'],$_POST['date_debut'],$_POST['date_fin'],$_POST['titre'],$_POST['descriptif'],$_POST['lieu'],$_POST['cout'],$_POST['url']);
				header("Location: index.php?action=gestionMembres");
				$notification3 = 'L\'évènement a bien été mis à jour';
			}
		}

		if (!empty($_POST['listDesEvent'])) {
			if (!empty($_POST['listEvent'])) {
				$registered=$this->_db->list_registered($_POST['listEvent']);
				$interested=$this->_db->list_interested($_POST['listEvent']);
				$vueupdate3 = true; 
			} else {
				$notification3 = 'Aucun évènement n\'a été sélectionné';
			}
		}



	


	require_once(CHEMIN_VUES . 'gestionMembres.php');
	
	}

	private function mustProcessForm(){
		return isset($_POST['submit']);
	}

	private function processForm(){
		$this->_raw_html = $_POST['html_input'];
	}

	private function renderView(){
		include(CHEMIN_VUES . 'gestionMembres.php');
	}


	// view private methods
	private function getRawHtml(){
		return $this->_raw_html;
	}

	private function getEscapedHtml(){
		return htmlentities($this->_raw_html);
	}



}


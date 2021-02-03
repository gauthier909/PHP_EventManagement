<?php

class PayEventController {

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
		$vueupdate = false;
		$tabMembres=$this->_db->select_membres();
		$tabevents=$this->_db->select_events();
		$tabEventPayed='';

		if (!empty($_POST['payEvent'])) {
			if (!empty($_POST['paiement'])) {
				$user=$this->_db->select_user($_POST['paiement']);
				$vueupdate = true; 
			} else {
				$notification = 'Aucun utilisateur n\'a été sélectionné';
			}
		}

		if(!empty($_POST['form_enregistrer'])){
			if (!empty($_POST['event'])) {
				if($this->_db->exist_event_payed($_POST['no_user'],$_POST['event'])){
					$this->_db->update_pay_event($_POST['no_user'],$_POST['event'],1);
				}
				else{
					$this->_db->pay_event($_POST['no_user'],$_POST['event'],1);
				}
				
				$notification = 'Le paiement de l\'utilisateur a bien été enregistré';
			} else {
				$notification = 'Veuillez choisir un évènement';
				$user=$this->_db->select_user($_POST['no_user']);
				$vueupdate = true;
			}
		}

		for ($i=0;$i<count($tabMembres);$i++) {
			$tabEventPayed[$tabMembres[$i]->html_no_user()]= $this->_db->event_payed($tabMembres[$i]->html_no_user());
			


			
		}
		

	

	if($vueupdate){
		require_once(CHEMIN_VUES . 'payEventUpdate.php');
	}
	else{
		require_once(CHEMIN_VUES . 'payEvent.php');
	}
	
	
	}



}
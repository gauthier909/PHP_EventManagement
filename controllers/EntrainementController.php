<?php
class EntrainementController{

	private $_db;

	public function __construct($db) {
		$this->_db = $db;
	}

	public function run(){


		if (empty($_SESSION['authentifie'])) {
			header("Location: index.php?action=accueil");
			die();
		}
		#contains a notification string
		$length = 'Entrainement de la semaine';
		#contains the informations of the user
		$user_info = '';
		#contains an array of details of one plan
		$tabplandetails = '';

		if(!empty($_POST)){
			if(!empty($_POST['week'])){
				$length='Entrainement de la semaine';
			}
			elseif(!empty($_POST['day'])){
				$length='Entrainement du jour';
			}
			else{ #(!empty($_POST['all']))
				$length='Tous les programmes';
			}

		}
		#selection of the details of the user's plan
		$user_info=$this->_db->select_info_user($_SESSION['login']);
		if($this->_db->exist_followed_plan($user_info->html_no_user())){
			$followed_plan=$this->_db->select_followed_plan($user_info->html_no_user());
		}
		else{
			$followed_plan=$this->_db->select_followed_plan_base('Plan de base');
		}
		
		$tabplandetails= $this->_db->select_details_plan($followed_plan->html_num_plan());

		require_once(CHEMIN_VUES . 'entrainement.php');

	}


}
?>

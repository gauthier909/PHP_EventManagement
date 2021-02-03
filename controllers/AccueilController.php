<?php 
class AccueilController{

	private $_db;
	
	public function __construct($db) {

		$this->_db = $db;
	
	}
			
	public function run(){

	$notification='';	
	

	if (!empty($_POST['form_login'])) {
			$notification='';
		if ($this->_db->connexion_user($_POST['email'],$_POST['motDePasse'])) {
			if($this->_db->checkstaff($_POST['email'])){
				$_SESSION['authentifie'] ='staff';
				$_SESSION['login'] = $_POST['email'];
				header("Location: index.php?action=entrainement"); 
				die();
			}
			elseif ($this->_db->checkcoach($_POST['email'])){
				$_SESSION['authentifie'] ='coach';
				$_SESSION['login'] = $_POST['email'];
				header("Location: index.php?action=entrainement"); 
				die();
			}
			else{
			$_SESSION['authentifie'] = 'autorise'; 
			$_SESSION['login'] = $_POST['email'];
			header("Location: index.php?action=entrainement"); 
			die();
		}
			
		} else {
			$notification='Vos données d\'authentification ne sont pas correctes ou vous n\'avez pas encore été validé par un responsable.';
			
		}
	}


		require_once(CHEMIN_VUES . 'accueil.php');
	}
} 
?>
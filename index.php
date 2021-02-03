<?php
	

	session_start();

	define('CHEMIN_VUES','views/');
	define('CHEMIN_CONTROLEURS','controllers/');

	function chargerClasse($classe) {
		require_once 'models/' . $classe . '.class.php';
	}
	spl_autoload_register('chargerClasse'); 


	$db=Db::getInstance();
	$decorate='yes';
	if(!empty($_GET['decorate']) && $_GET['decorate']=='no'){
		$decorate = 'no';
	}
	$num_plan_calendar=' ';
	if(!empty($_GET['plan'])){
		$num_plan_calendar = $_GET['plan'];
	}
	if($decorate=='yes'){
		require_once(CHEMIN_VUES . 'header.php');
	}
	
	
	$action = (isset($_GET['action'])) ? htmlentities($_GET['action']) : 'default';
	
	switch($action) {	
		
		case 'accueil':
			require_once('controllers/AccueilController.php');	
			$controller = new AccueilController($db);
			break;
		case 'inscription':
			require_once('controllers/InscriptionController.php');	
			$controller = new InscriptionController($db);
			break;
        case 'entrainement':
			require_once('controllers/EntrainementController.php');	
			$controller = new EntrainementController($db);
			break;
		case'logout':
			require_once(CHEMIN_CONTROLEURS.'LogoutController.php');
			$controller = new LogoutController();
			break;
		case 'gestionMembres':
			require_once('controllers/GestionMembresController.php');	
			$controller = new GestionMembresController($db);
			break;
		case 'cotisations':
			require_once('controllers/CotisationsController.php');	
			$controller = new CotisationsController($db);
			break;
		case 'payEvent':
			require_once('controllers/PayEventController.php');	
			$controller = new PayEventController($db);
			break;
		case 'plan_management':
			require_once('controllers/PlanController.php');
			$controller = new PlanController($db);
			break;
		case 'my_account':
			require_once('controllers/AccountController.php');
			$controller = new AccountController($db);
			break;
		case 'evenement':
			require_once('controllers/EvenementController.php');
			$controller = new EvenementController($db);
			break;
		case 'calendrier':
			require_once('controllers/CalendarController.php');
			$controller = new CalendarController();
			break;

		default: 
			require_once('controllers/AccueilController.php');	
			$controller = new AccueilController($db);
			break;
	}
	
	$controller->run();
	
	
	if($decorate=='yes'){
	require_once(CHEMIN_VUES . 'footer.php');
}
?>
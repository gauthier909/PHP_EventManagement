<?php
class PlanController{

  private $_db;

  public function __construct($db){
    $this->_db = $db;
  }

  public function run(){

    $num_plan ='';
    $notification ='';

    if (empty($_SESSION['authentifie'])) {
			header("Location: index.php?action=entrainement.php"); # redirect to the main menu
			die();
		}
    if(!empty($_POST)){
      # applying update
      if(!empty($_POST['update_plan'])){
        if(!empty($_POST['day_program']) && !empty($_POST['date_training'])){
          $this->_db->update_detail($_POST['num_plan'], $_POST['date_training'], $_POST['day_program']);
        }
      }
      # management of the update
      if (!empty($_POST['update'])) {
        if(!empty($_POST['num_plan'])){
          #selecting the details for the correct plan
          $num_plan = $_POST['num_plan'];
          $tabplansdetails=$this->_db->select_details_plan($_POST['num_plan']);
          require_once(CHEMIN_VUES . 'plan_management.update.php');
        }
      }
      # management of deletion
      if (!empty($_POST['delete'])) {
        if(!empty($_POST['num_plan'])){
          # deleting the selected plan
          $this->_db->delete_plan($_POST['num_plan']);
        }
      }
      # management of the csv import
      if (!empty($_POST['add'])) {
  			if (!empty($_FILES['csvfile']['tmp_name']) && !empty($_POST['add_plan'])) {
  				if ($_FILES['csvfile']['type']=='application/vnd.ms-excel' ) {
  					$fcontents = file($_FILES['csvfile']['tmp_name']);
  					foreach ($fcontents as $i => $ligne) {
  						preg_match('/(.*);(.*)/', $ligne, $result);
  						$datefr = $result[0];
  						if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})$/',$datefr,$dateresult)) {
  							$datetime = "$dateresult[3]-$dateresult[2]-$dateresult[1] $dateresult[4]:$dateresult[5]:$dateresult[6]";
  						}
  						$this->_db->insert_details_plan($result[0],$datetime,$_POST['num_plan']);
  					}
            $this->_db->insert_plan($_POST['add_plan'], $_FILES['csvfile']['name']);
  					$notification = 'L\'importation du fichier .csv a réussi';
  				} else {
            $notification = 'Le fichier uploadé doit être un fichier .csv !';
  				}
  			} else {
          if(empty($_FILES['csvfile']['tmp_name'])){
            $notification = 'Veuillez choisir un fichier .csv';
          }
          elseif (empty($_POST['add_plan'])) {
            $notification = 'Veuillez entrez un nom pour le plan';
          }
          else{
            $notification = 'Veuillez choisir un fichier .csv et donner un nom de plan';
          }
  			}
  		}

    }
    #selecting all the plans
    $tabplans=$this->_db->select_plans();
    require_once(CHEMIN_VUES . 'plan_management.php');
  }
}
 ?>

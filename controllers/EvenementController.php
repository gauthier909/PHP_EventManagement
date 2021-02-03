<?php
class EvenementController{

	private $_db;

	public function __construct($db) {
		$this->_db = $db;
		$this->_raw_html = '';
	}

	public function run(){

		$notification_interest= "Ca m'intéresse!";
    $user_info = $this->_db->select_info_user($_SESSION['login']);
		$marker = $this->_db->select_marker();
		$lat = $marker->html_lat();
		$lng = $marker->html_lng();

		

			if(!empty($_POST['event_details'])){

				if(!empty($_POST['event_sign'])){

					require_once(CHEMIN_VUES . 'evenement.inscription.php');
				}
				elseif(!empty($_POST['num_event'])){

					$detailed_event = $this->_db->select_one_event($_POST['num_event']);
					if(!empty($_POST['event_sign'])){

						require_once(CHEMIN_VUES . 'evenement.inscription.php');
					}
					else{

					}
					$registered = $this->_db->select_registered($user_info->no_user(), $detailed_event->num_event());
					$interest=$this->_db->select_interest($user_info->no_user(), $detailed_event->num_event());
					
					if(is_null($interest) || $interest->html_is_interested()==0){
						$notification_interest="Ca m'intéresse!";
					} else{
						$notification_interest="Ca ne m'intéresse plus";
					}
					#if the user is interested in an event
					if(!empty($_POST['interest'])){
						if($_POST['interest']=="Ca m'intéresse!"){
							$this->_db->insert_interest($user_info->no_user(), $detailed_event->num_event());
							$notification_interest="Ca ne m'intéresse plus";
						} else{
							$this->_db->delete_interest($user_info->no_user(), $detailed_event->num_event());
							$notification_interest="Ca m'intéresse!";
						}
					}
					require_once(CHEMIN_VUES . 'evenement.details.php');

					}
			}
			#if the user wants to sign up for an event

			else{
				if(!empty($_POST['num_event'])){
					$detailed_event = $this->_db->select_one_event($_POST['num_event']);
					if(!empty($_POST['event_inscription'])){
						$this->_db->insert_registered($user_info->no_user(), $detailed_event->num_event());
					}
				}
				#selection of the events
				$tabevents=$this->_db->select_events();

		    require_once(CHEMIN_VUES . 'evenement.php');
	    }



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

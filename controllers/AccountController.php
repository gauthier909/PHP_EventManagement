<?php
class AccountController{

	private $_db;

	public function __construct($db) {
		$this->_db = $db;
	}

	public function run(){

		$notification='';

		if(!empty($_POST)){
			if(!empty($_POST['update'])){
				$this->_db->update_onevalue_user($_SESSION['login'], $_POST['last_name'], $_POST['first_name'], $_POST['num_phone'], $_POST['address'],
				$_POST['num_account']);
				if (!empty($_POST['e_mail'])) {
					$this->_db->update_e_mail_user($_SESSION['login'], $_POST['e_mail']);
					$_SESSION['login'] = $_POST['e_mail'];
				}
				if((!empty($_POST['password']))){
					$new_password = $_POST['password'];
					$hash = password_hash($new_password, PASSWORD_BCRYPT);
					$this->_db->update_password_user($_SESSION['login'], $hash);
				}
				if(!empty($_FILES['photo']['tmp_name'])) {
					$imageinfo = getimagesize($_FILES['photo']['tmp_name']);
					if (($_FILES['photo']['type']=='image/jpeg' && $imageinfo['mime']=='image/jpeg') || ($_FILES['photo']['type']=='image/png' && $imageinfo['mime']=='image/png')) {
						$horodatage=str_replace('.', '_',microtime(true));
						$origine = $_FILES['photo']['tmp_name'];
						$destination = CHEMIN_VUES . 'images/' . $horodatage . basename($_FILES['photo']['name']);
						move_uploaded_file($origine,$destination);
						$this->_db->update_photo_user($_SESSION['login'], $destination);
						$notification = '';
				} else {
						$notification = 'Le fichier uploadé doit être une image .jpg ou .png !';
				}

				}
			}

		}
		$user_info = $this->_db->select_info_user($_SESSION['login']);
		if($this->_db->exist_followed_plan($user_info->html_no_user())){
			$follow=$this->_db->select_followed_plan($user_info->html_no_user());
		}
		else{
			$follow=$this->_db->select_followed_plan_base('Plan de base');
		}
		$follow_details = $this->_db->select_details_plan($follow->html_num_plan());
		if(empty($user_info->html_photo())){
			
		}
		require_once(CHEMIN_VUES.'my_account.php');

	}

}
?>

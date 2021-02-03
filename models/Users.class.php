<?php
class Users
{
	private $_no_user;
	private $_first_name;
	private $_last_name;
	private $_num_phone;
	private $_e_mail;
	private $_address;
	private $_num_account;
	private $_photo;
	private $_password;
	private $_coach;
	private $_staff;
	private $_checked;
	
	public function __construct($no_user,$first_name, $last_name, $num_phone , $e_mail , $address , $num_account , $photo , $password , $coach , $staff , $checked ){
		$this->_no_user = $no_user;
		$this->_first_name = $first_name;
		$this->_last_name = $last_name;
		$this->_num_phone = $num_account;
		$this->_e_mail = $e_mail;
		$this->_address = $address;
		$this->_num_account = $num_account;
		$this->_photo = $photo;
		$this->_password =$password;
		$this->_coach =$coach;
		$this->_staff = $staff;
		$this->_checked = $checked;
	}
	
	public function no_user(){
		return $this->_no_user;		
	}	
		
	public function first_name(){
		return $this->_first_name;
	}
	
	public function last_name(){
		return $this->_last_name;
	}

	public function num_phone(){
		return $this->_num_phone;
	}

	public function e_mail(){
		return $this->_e_mail;
	}

	public function address(){
		return $this->_address;
	}

	public function num_account(){
		return $this->_num_account;
	}

	public function photo(){
		return $this->_photo;
	}

	public function password(){
		return $this->_password;
	}

	public function coach(){
		return $this->_coach;
	}

	public function staff(){
		return $this->_staff;
	}

	public function checked(){
		return $this->_checked;
	}

	
	public function html_no_user(){
		return htmlspecialchars($this->_no_user);
	}


	public function html_first_name(){
		return htmlspecialchars($this->_first_name);
	}


	public function html_last_name(){
		return htmlspecialchars($this->_last_name);
	}
	

	public function html_num_phone(){
		return htmlspecialchars($this->_num_phone);
	}

	public function html_e_mail(){
		return htmlspecialchars($this->_e_mail);
	}


	public function html_address(){
		return htmlspecialchars($this->_address);
	}

	public function html_num_account(){
		return htmlspecialchars($this->_num_account);
	}

	public function html_photo(){
		return htmlspecialchars($this->_photo);
	}

	public function html_password(){
		return htmlspecialchars($this->_password);
	}

	public function html_coach(){
		return htmlspecialchars($this->_coach);
	}

	public function html_staff(){
		return htmlspecialchars($this->_staff);
	}

	public function html_checked(){
		return htmlspecialchars($this->_checked);
	}

}
?>
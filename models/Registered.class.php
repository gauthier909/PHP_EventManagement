<?php
class Registered
{
	private $_num_registered;
	private $_num_event;
	private $_no_user;
	private $_has_payed;
	
	public function __construct($num_registered ,$num_event , $no_user, $has_payed){
		$this->_num_registered = $num_registered;
		$this->_num_event = $annee_mf;
		$this->_no_user = $no_user;
		$this->_has_payed = $has_payed;


	}
	
	
	public function num_registered(){
		return $this->_num_registered;
	}

	public function num_event(){
		return $this->_num_event;
	}

	public function no_user(){
		return $this->_no_user;
	}

	public function has_payed(){
		return $this->_has_payed;
	}


	


	public function html_num_registered(){
		return htmlspecialchars($this->_num_registered);
	}
	public function html_num_event(){
		return htmlspecialchars($this->_num_event);
	}
	public function html_no_user(){
		return htmlspecialchars($this->_no_user);
	}

	public function html_has_payed(){
		return htmlspecialchars($this->_has_payed);
	}


	
}
?>
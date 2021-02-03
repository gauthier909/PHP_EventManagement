<?php
class Payements
{
	private $_no_user;
	private $_annee_mf;
	private $_amount;
	private $_has_payed;
	
	public function __construct($no_user ,$annee_mf , $amount, $has_payed){
		$this->_no_user = $no_user;
		$this->_annee_mf = $annee_mf;
		$this->_amount = $amount;
		$this->_has_payed = $has_payed;


	}
	
	
	public function no_user(){
		return $this->_no_user;
	}

	public function annee_mf(){
		return $this->_annee_mf;
	}

	public function amount(){
		return $this->_amount;
	}

	public function has_payed(){
		return $this->_has_payed;
	}


	


	public function html_no_user(){
		return htmlspecialchars($this->_no_user);
	}

	public function html_annee_mf(){
		return htmlspecialchars($this->_annee_mf);
	}

	public function html_amount(){
		return htmlspecialchars($this->_amount);
	}

	public function html_has_payed(){
		return htmlspecialchars($this->_has_payed);
	}


	
}
?>
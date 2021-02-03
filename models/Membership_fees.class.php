<?php
class Membership_fees
{
	private $_annee_mf;
	private $_cost_mf;
	
	public function __construct($annee_mf , $cost_mf){
		$this->_annee_mf = $annee_mf;
		$this->_cost_mf = $cost_mf;
	}
	
	public function annee_mf(){
		return $this->_annee_mf;		
	}	
		
	public function cost_mf(){
		return $this->_cost_mf;
	}
	
	
	
	
	public function html_annee_mf(){
		return htmlspecialchars($this->_annee_mf);
	}


	public function html_cost_mf(){
		return htmlspecialchars($this->_cost_mf);
	}


	


	
}
?>
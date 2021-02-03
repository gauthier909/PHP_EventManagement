<?php
class Plan{
  private $_num_plan;
  private $_name;
  private $_file_plan;

  public function __construct($num_plan, $name, $file_plan){
    $this->_num_plan = $num_plan;
    $this->_name = $name;
    $this->_fileplan = $file_plan;
  }
  public function html_num_plan(){
    return htmlspecialchars($this->_num_plan);
  }

  public function html_name(){
    return htmlspecialchars($this->_name);
  }

  public function html_file_plan(){
    return htmlspecialchars($this->_file_plan);
  }
}
 ?>

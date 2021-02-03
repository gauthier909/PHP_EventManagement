<?php
class PlanDetails{
  private $_date_training;
  private $_day_program;
  private $_num_plan;

  public function __construct($date_training, $day_program, $num_plan){
    $this->_date_training = $date_training;
    $this->_day_program = $day_program;
    $this->_num_plan = $num_plan;
  }

  public function html_date_training(){
    return htmlspecialchars($this->_date_training);
  }

  public function html_day_program(){
    return htmlspecialchars($this->_day_program);
  }

  public function html_num_plan(){
    return htmlspecialchars($this->_num_plan);
  }
}
 ?>

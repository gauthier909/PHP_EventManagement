<?php
class Follow
{
  private $_num_follow;
  private $_num_plan;
  private $_num_user;

  public function __construct($num_follow, $num_plan, $num_user){
    $this->_num_follow = $num_follow;
    $this->_num_plan = $num_plan;
    $this->_num_user = $num_user;
  }

  public function html_num_follow(){
    return htmlspecialchars($this->_num_follow);
  }
  public function html_num_follow(){
    return htmlspecialchars($this->_num_plan);
  }
  public function html_num_user(){
    return htmlspecialchars($this->_num_plan);
  }
}

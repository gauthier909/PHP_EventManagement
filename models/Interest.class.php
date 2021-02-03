<?php
class Interest{
  private $_num_event;
  private $_no_user;
  private $_is_interested;

  public function __construct($num_event, $no_user, $is_interested){
    $this->_num_event=$num_event;
    $this->_no_user=$no_user;
    $this->_is_interested=$is_interested;
  }

  public function num_event(){
    return $this->_num_event;
  }
  public function no_user(){
    return $this->_no_user;
  }
  public function is_interested(){
    return $this->_is_interested;
  }

  public function html_is_interested(){
    return htmlspecialchars($this->_is_interested);
  }
  public function html_num_event(){
    return htmlspecialchars($this->_num_event);
  }
  public function html_no_user(){
    return htmlspecialchars($this->_no_user);
  }
}

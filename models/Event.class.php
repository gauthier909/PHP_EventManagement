<?php
class Event{
  private $_num_event;
  private $_date_start;
  private $_date_end;
  private $_title;
  private $_description;
  private $_location;
  private $_cost;
  private $_url;

  public function __construct($num_event ,$date_start, $date_end, $title, $description,
  $location, $cost, $url){
    $this->_num_event = $num_event;
    $this->_date_start = $date_start;
    $this->_date_end = $date_end;
    $this->_title = $title;
    $this->_description = $description;
    $this->_location = $location;
    $this->_cost = $cost;
    $this->_url = $url;
  }
public function num_event(){
    return $this->_num_event;   
  } 

  public function html_num_event(){
    return htmlspecialchars($this->_num_event);
  }

  public function html_date_start(){
    return htmlspecialchars($this->_date_start);
  }
  public function html_date_end(){
    return htmlspecialchars($this->_date_end);
  }
  public function html_title(){
    return htmlspecialchars($this->_title);
  }
  public function html_description(){
    return htmlspecialchars($this->_description);
  }
  public function html_location(){
    return htmlspecialchars($this->_location);
  }
  public function html_cost(){
    return htmlspecialchars($this->_cost);
  }
  public function html_url(){
    return htmlspecialchars($this->_url);
  }
}
 ?>

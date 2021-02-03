<?php
class Marker{
  private $_id;
  private $_name;
  private $_address;
  private $_lat;
  private $_lng;
  private $_type;

  public function __construct($id, $name, $address, $lat, $lng, $type){
    $this->_id = $id;
    $this->_name = $name;
    $this->_address = $address;
    $this->_lat = $lat;
    $this->_lng = $lng;
    $this->_type = $type;

  }

  public function html_id(){
    return htmlspecialchars($this->_id);
  }
  public function html_name(){
    return htmlspecialchars($this->_name);
  }
  public function html_address(){
    return htmlspecialchars($this->_address);
  }
  public function html_lat(){
    return htmlspecialchars($this->_lat);
  }
  public function html_lng(){
    return htmlspecialchars($this->_lng);
  }
  public function html_type(){
    return htmlspecialchars($this->_type);
  }
}
?>

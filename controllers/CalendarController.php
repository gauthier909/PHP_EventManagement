<?php
class CalendarController{

  private $_db;
  private $_num_plan_calendar;

	public function __construct($db, $num_plan_calendar) {

		$this->_db = $db;
    $this->_num_plan_calendar = $num_plan_calendar;

	}


  public function run(){
    require 'lib/iCalendar/CalendarEvent.class.php';
    require 'lib/iCalendar/Calendar.class.php';
    $plan_calendar= $this->_db->select_one_plan($this->_num_plan_calendar);
    $tabdetails_calendar = $this->_db->select_details_plan($this->_num_plan_calendar);

    $calendar_title = "Calendrier du ".$plan_calendar->name();

    $tabevents = array();
    foreach ($tabdetails_calendar as $i => $plan_detail) {
      $event = CalendarEvent::createCalendarEvent(new DateTime($plan_detail->date_training()), $plan_detail->day_program(), $plan_detail->num_plan());
      $tabevents[] = $event;
    }
    $calendar = Calendar::createCalendar($tabevents, $calendar_title, $author='IPL Sports');
    $calendar->generateDownload();
  }

}

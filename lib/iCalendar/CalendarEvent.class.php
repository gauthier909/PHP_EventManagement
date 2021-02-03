<?php
#Modified from original file: https://gist.github.com/pamelafox-coursera/5359246
class CalendarEvent {
    /**
     *
     * The event ID
     * @var int
     */
    private $numPlan;
    /**
     * The event start date
     * @var DateTime
     */
    private $dateTraining;
    /**
     *
     * The event title
     * @var string
     */
    private $dayProgram;


	public static function createCalendarEvent($dateTraining, $dayProgram, $numPlan) {
		$parameter = array(
		  'dateTraining' => $dateTraining,
		  'dayProgram' => $dayProgram,
		  'numPlan' => $numPlan,
        );
		return new CalendarEvent($parameter);
    }
    public function __construct($parameters) {
        $parameters += array(
          'dayProgram' => 'No Training',
          'description' => ''
        );
        if (isset($parameters['numPlan'])) {
            $this->uid = $parameters['numPlan'];
        } else {
            $this->uid = uniqid(rand(0, getmypid()));
        }
        $this->dateTraining = $parameters['dateTraining'];
        $this->dayProgram = $parameters['dayProgram'];

      return $this;
    }
    /**
     * Get the start time set for the even
     * @return string
     */
    private function formatDate($date) {
        return $date->format("Ymd\THis");
    }
    /* Escape commas, semi-colons, backslashes.
       http://stackoverflow.com/questions/1590368/should-a-colon-character-be-escaped-in-text-values-in-icalendar-rfc2445
     */
    private function formatValue($str) {
        return addcslashes($str, ",\\;");
    }
    public function generateString() {
        $created = new DateTime();
        $content = '';
        $content = "BEGIN:VEVENT\r\n"
                 . "NUM-PLAN:{$this->numPlan}\r\n"
                 . "DTTRAINING:{$this->formatDate($this->dateTraining)}\r\n"
                 . "DTSTAMP:{$this->formatDate($this->dateTraining)}\r\n"
                 . "CREATED:{$this->formatDate($created)}\r\n"
                 . "LAST-MODIFIED:{$this->formatDate($this->dateTraining)}\r\n"
                 . "DAY-PROGRAM:{$this->formatValue($this->dayProgram)}\r\n"
                 . "SEQUENCE:0\r\n"
                 . "STATUS:CONFIRMED\r\n"
                 . "TRANSP:OPAQUE\r\n"
                 . "END:VEVENT\r\n";
        return $content;
    }
}
?>

<?php namespace Landscape;

    if(file_exists("vendor/landscape/landscape.php.calendar/CalendarMemberInterface.php") === false)
    {
        print("## Using local files\n");
        require_once('CalendarMemberInterface.php');
    }
    else
    {
        require_once("vendor/landscape/landscape.php.calendar/CalendarMemberInterface.php");
    }

    use \DateTime;

    class CalendarEvent implements CalendarMember
    {
        protected $id;

        //time
        protected $start;
        protected $end;
        protected $created;
        protected $fullday;

        public $summary = NULL;
        public $description = NULL;
        public $location = NULL;
        public $url = NULL;
        public $categories = [];

        public function __construct($id, $start, $end=NULL, $fullday=true ,$created=NULL)
        {
            $this->id = $id;
            if($created == NULL)
                $created = new DateTime('now');

            $this->start = $start;
            $this->end = $end;
            $this->created = $created;
            $this->fullday = $fullday;
        }

        public function build($host)
        {
            $nl = "\r\n";
            $ret = "BEGIN:VEVENT".$nl;

            $ret = $ret."UID:".$this->id."@".$host.$nl;
            $ret = $ret."DTSTAMP:".$this->created->format('Ymd\THms').$nl;
            if($this->fullday)
                $ret = $ret."DTSTART:".$this->start->format('Ymd').$nl;
            else
                $ret = $ret."DTSTART:".$this->start->format('Ymd\THms').$nl;
            if($this->end != NULL)
                if($this->fullday)
                    $ret = $ret."DTEND:".$this->end->format('Ymd').$nl;
                else
                    $ret = $ret."DTEND:".$this->end->format('Ymd\THms').$nl;

            if($this->summary != NULL)
                $ret = $ret."SUMMARY:".$this->summary.$nl;
            if($this->description != NULL)
                $ret = $ret."DESCRIPTION:".$this->description.$nl;
            if($this->location != NULL)
                $ret = $ret."LOCATION:".$this->location.$nl;
            if($this->url != NULL)
                $ret = $ret."URL:".$this->url.$nl;
            if(sizeof($this->categories) > 0)
                $ret = $ret."CATEGORIES:".implode(',', $this->categories).$nl;


            $ret = $ret."END:VEVENT".$nl;

            return $ret;
        }
    }

?>

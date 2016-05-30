<?php namespace Landscape;

    if(file_exists("vendor/landscape/landscape.php.calendar/CalendarMemberInterface.php") === false)
    {
        print("## Using local files\n");
        require_once('CalendarMemberInterface.php');
        require_once('CalendarEvent.php');
        require_once('CalendarObject.php');
    }
    else
    {
        require_once("vendor/landscape/landscape.php.calendar/CalendarMemberInterface.php");
        require_once("vendor/landscape/landscape.php.calendar/CalendarEvent.php");
        require_once("vendor/landscape/landscape.php.calendar/CalendarObject.php");
    }

    class CalendarObject
    {
        protected $prodid = "LandscapeCalendarModule / dev";
        protected $items = [];
        protected $host;

        public $summary = NULL;

        public function __construct($host, $sum=NULL)
        {
            $this->summary = $sum;
            $this->host = $host;
        }

        public function addItem(CalendarMember $item)
        {
            $this->items[] = $item;
        }

        public function build()
        {
            $nl = "\r\n";

            $ret = "BEGIN:VCALENDAR".$nl."VERSION:2.0".$nl."PRODID:$this->prodid".$nl."METHOD:PUBLISH".$nl;

            if($this->summary != NULL)
            {
                $ret = $ret."SUMMARY:".$this->summary.$nl;
            }

            foreach($this->items as $item)
            {
                $ret = $ret.$item->build($this->host);
            }

            $ret = $ret."END:VCALENDAR".$nl;

            return $ret;
        }
    }




?>

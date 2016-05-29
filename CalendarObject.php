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

        public function __construct()
        {}

        public function addItem(CalendarMember $item)
        {
            $this->items[] = $item;
        }

        public function build()
        {
            $nl = "\r\n";

            $ret = "BEGIN:VCALENDAR".$nl."VERSION:2.0".$nl."PRODID:$this->prodid".$nl."METHOD:PUBLISH".$nl;

            foreach($this->items as $item)
            {
                $ret = $ret.$item->build();
            }

            $ret = $ret."END:VCALENDAR".$nl;

            return $ret;
        }
    }




?>

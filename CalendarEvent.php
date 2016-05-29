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


    class CalendarEvent implements CalendarMember
    {
        public function build()
        {
            $nl = "\r\n";
            $ret = "BEGIN:VEVENT".$nl;

            $ret = $ret."END:VEVENT".$nl;

            return $ret;
        }
    }

?>

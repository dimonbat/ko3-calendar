<?php defined('SYSPATH') OR die('No direct access allowed.');
class Kohana_Calendar
{

    public static function factory()
    {
    	return new Calendar();
    }

    /* draws a calendar */
    public function fetchCalendar()
    {
        $days = array();
        $month = (int) (@$_GET['month'] ? $_GET['month'] : date('m'));
        $year = (int)  (@$_GET['year'] ? $_GET['year'] : date('Y'));

    
       	/* days and weeks vars now ... */
       	$running_day = date('w',mktime(0,0,0,$month,1,$year));
       	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
       	$day_counter = 0;
       	$dates_array = array();
    
       	/* row for week one */
        $number = 1;
        
       	/* print "blank" days until the first of the current week */
       	for($x = 1; $x <= 7; $x++):
            //test
            if ($x < $running_day)
            {
                $days ['1'][$x] = '';
            }
            else
            {
                $days ['1'][$x] = $number;
                $number++;
            }
       	endfor;
        
        //test
        $y = 2;
        $x = 1;
        $repeattimes = $days_in_month-$number+2;
        for($i = 1; $i < $repeattimes; $i++):
            $days [$y][$x] = $number;
            $x++;
            $number++;
            if ( $x > 7 )
            {
                $x = 1;
                $y++;
            }
        endfor;
            
        for ($i = $x; $i <= 7; $i++):
            $days[$y][$i] = '';
        endfor;


       	
       	/* all done, return result */
       	return $days;
    }  
}

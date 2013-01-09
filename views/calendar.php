<?php

$month = (int) (@$_GET['month'] ? $_GET['month'] : date('m'));
$year = (int)  (@$_GET['year'] ? $_GET['year'] : date('Y'));

//echo controls

/* select month control */
$select_month_control = '<select name="month" id="month">';
for($x = 1; $x <= 12; $x++) {
	$select_month_control.= '<option value="'.$x.'"'.($x != $month ? '' : ' selected="selected"').'>'.date('F',mktime(0,0,0,$x,1,$year)).'</option>';
}
$select_month_control.= '</select>';

/* select year control */
$year_range = 7;
$select_year_control = '<select name="year" id="year">';
for($x = ($year-floor($year_range/2)); $x <= ($year+floor($year_range/2)); $x++) {
	$select_year_control.= '<option value="'.$x.'"'.($x != $year ? '' : ' selected="selected"').'>'.$x.'</option>';
}
$select_year_control.= '</select>';

/* "previous month" control */
$previous_month_link = '<br/><a href="?month='.($month != 1 ? $month - 1 : 12).'&year='.($month != 1 ? $year : $year - 1).'" class="control"><< 	Previous Month</a>';

/* "next month" control */
$next_month_link = '<a href="?month='.($month != 12 ? $month + 1 : 1).'&year='.($month != 12 ? $year : $year + 1).'" class="control">Next Month >></a>';

/* bringing the controls together */
$controls = '<form method="get">'.$select_month_control.$select_year_control.'&nbsp;<input type="submit" name="submit" value="Go" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$previous_month_link.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$next_month_link.' </form>';

echo $controls;



//echo calendar
$headings = array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');

$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';
$calendar .= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';
foreach($days as $line){
	$calendar .='<tr class="calendar-row">';

	foreach($line as $item)
	{
		if ( $item == '' )
		{
			//выводим несуществующий день
			$calendar .= '<td class="calendar-day-np">&nbsp;</td>';
		}
		else
		{
			//выводим число
			$calendar .= '<td class="calendar-day">';
			if( (isset ($day_link_base) ) AND ( $day_link_base != '') ) {
				// if we want to link to a "daily" view of 
				$calendar .= '<div class="day-number"><a href="'.$day_link_base.'?date=' . $year.'_'.$month.'_'.$item.'">'.$item.'</a></div>';
				}
			else {
				$calendar .= '<div class="day-number">'.$item.'</div>';
			}
			if(isset($events[$item])) {
					$calendar .= '<div class="event">';
					if( isset($events[$item]['detail']) ){
						$calendar.= "<b>".$events[$item]['detail']."</b> - ";
						}
						$calendar .= '<a href="'.$events[$item]['url'].'" '.( isset($events[$item]['class']) ? 'class="' . $events[$item]['class'] .'"' : '' ).'>'.$events[$item]['title'].'</a>';
						$calendar .= '</div>';
						}
			$calendar .= '</td>';
		}
	}
	$calendar .= '</tr>';
}


//print_r ($ccontent);
//exit(0);
$calendar .= '</table>';
echo $calendar;


?>

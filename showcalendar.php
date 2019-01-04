<?php
session_start();
include "setseason.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Calendar</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="shortcut icon" href="images/favicon.ico">
  

    <style>
        /* calendar */
    table.calendar		{ border-left:1px solid #999; }
    tr.calendar-row	{  }
    td.calendar-day	{ 
        height:120px; 
        font-size:14px; 
        position:relative; 
        text-align:center; } 
    * html div.calendar-day { height:120px; }
    td.calendar-day:hover	{ background:#eceff5; }
    td.calendar-day-np	{ 
        background:#eee; 
        min-height:120px; } 
    * html div.calendar-day-np { height:120x; }
    td.calendar-day-head { 
        background:#ccc; 
        font-weight:bold; 
        text-align:center; 
        width:120px; 
        padding:5px; 
        border-bottom:1px solid #999; 
        border-top:1px solid #999; 
        border-right:1px solid #999; }
    div.day-number		{ 
        position:absolute;
        top:5px;
        right:5px;
        background:#343a40; 
        padding:5px; 
        color:#fff; 
        font-weight:bold; 
        float:right; 
        margin:-5px -5px 0 0; 
        width:25px; 
    }
    /* shared */
    td.calendar-day, td.calendar-day-np { 
        width:120px; 
        padding:5px; 
        border-bottom:1px solid #999; 
        border-right:1px solid #999; }
    #boxy{
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
</head>
<body>

<?php
$month = intval($_GET['q']);
$year = intval($_GET['q']);
/**
 * Returns the calendar's html for the given year and month.
 *
 * @param $year (Integer) The year, e.g. 2015.
 * @param $month (Integer) The month, e.g. 7.
 * @param $events (Array) An array of events where the key is the day's date
 * in the format "Y-m-d", the value is an array with 'text' and 'link'.
 * @return (String) The calendar's html.
 */
function build_html_calendar($year, $month, $events = null) {

    // CSS classes
    $css_cal = 'calendar';
    $css_cal_row = 'calendar-row';
    $css_cal_day_head = 'calendar-day-head';
    $css_cal_day = 'calendar-day';
    $css_cal_day_number = 'day-number';
    $css_cal_day_blank = 'calendar-day-np';
    $css_cal_day_event = 'calendar-day-event';
    $css_cal_event = 'calendar-event';
  
    // Table headings
    $headings = ['M', 'T', 'W', 'T', 'F', 'S', 'S'];
  
    // Start: draw table
    $calendar =
      "<table cellpadding='0' cellspacing='0' class='{$css_cal}'>" .
      "<tr class='{$css_cal_row}'>" .
      "<td class='{$css_cal_day_head}'>" .
      implode("</td><td class='{$css_cal_day_head}'>", $headings) .
      "</td>" .
      "</tr>";
  
    // Days and weeks
    $running_day = date('N', mktime(0, 0, 0, $month, 1, $year));
    $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
  
    // Row for week one
    $calendar .= "<tr class='{$css_cal_row}'>";
  
    // Print "blank" days until the first of the current week
    for ($x = 1; $x < $running_day; $x++) {
      $calendar .= "<td class='{$css_cal_day_blank}'> </td>";
    }
  
    // Keep going with days...
    for ($day = 1; $day <= $days_in_month; $day++) {
  
      // Check if there is an event today
      $cur_date = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
      $draw_event = false;
      if (isset($events) && isset($events[$cur_date])) {
        $draw_event = true;
      }
  
      // Day cell
      $calendar .= $draw_event ?
        "<td class='{$css_cal_day} {$css_cal_day_event}'>" :
        "<td class='{$css_cal_day}'>";
  
      // Add the day number
      $calendar .= "<div class='{$css_cal_day_number}'>" . $day . "</div>";
  
      // Insert an event for this day
      if ($draw_event) {
        $calendar .=
          "<div class='{$css_cal_event}'>" .
          $events[$cur_date]['text'] .
          "</div>";
      }
  
      // Close day cell
      $calendar .= "</td>";
  
      // New row
      if ($running_day == 7) {
        $calendar .= "</tr>";
        if (($day + 1) <= $days_in_month) {
          $calendar .= "<tr class='{$css_cal_row}'>";
        }
        $running_day = 1;
      }
  
      // Increment the running day
      else {
        $running_day++;
      }
  
    } // for $day
  
    // Finish the rest of the days in the week
    if ($running_day != 1) {
      for ($x = $running_day; $x <= 7; $x++) {
        $calendar .= "<td class='{$css_cal_day_blank}'> </td>";
      }
    }
  
    // Final row
    $calendar .= "</tr>";
  
    // End the table
    $calendar .= '</table>';
  
    // All done, return result
    return $calendar;
  }
  $stmt = $conn->prepare("SELECT FixtureID,HomeID, AwayID, fixtdate, season,
    awsc.Schoolname as AWS, hsch.Schoolname as HS, awsc.Username as AWUN, hsch.Username as HUN,
    home.Division, away.Division FROM fixtures 
    INNER JOIN teams as home ON (fixtures.HomeID = home.teamID) 
    INNER JOIN teams as away ON (fixtures.AwayID=away.TeamID) 
    INNER JOIN schools as awsc ON away.SchoolID=awsc.SchoolID 
    INNER JOIN schools as hsch ON home.SchoolID=hsch.SchoolID 
    WHERE season=:season  ORDER BY fixtdate ASC" );
    $stmt->bindParam(':season', $_SEASON);
   
    $stmt->execute();
  
    $events=array();
    #creates associative array of associative arrays for calendar
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $events[$row['fixtdate']]=array('text'=>$row['HS']."<br> v <br>".$row['AWS']);
    }
    $disp=$month." ".$year;
    //$month=date('m');
    //$year=date('Y');
    echo '<input type="button" name="back" id="backwards" value="<" onclick "showcalendar('.$month.','.$year.'str,month,year);"><h2 style="text-align:center">'.$disp.'</h2><input type="button" name="forwards" id="forwards" value=">">';
    echo "<div id='cal'>";
    echo build_html_calendar($year, $month,$events);
    echo "</div>";
  ?>
  
  <script>
$("#forwards").on("click", function(){
    var selected=$(this).val();
    var d = new Date();
    var year = d.getFullYear();
    var month= d,getMonth()+1;
    showcalendar(selected,month,year);
    $("#boxy").html("You selected: " + year);
  })</script>
    <script>
$("#backwards").on("change", function(){
    var selected=$(this).val();
    var d = new Date();
    var year = d.getFullYear();
    var month= d,getMonth()+1;
    showcalendar(selected,month,year);
    //$("#results").html("You selected: " + selected);
  })</script>
</body>
</html>

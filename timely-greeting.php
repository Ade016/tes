<?php
//------ PHP TIMELY GREETING -------//
//---------- Version 1.8 ----------//
//-------- BY NICOLAS SAAD ---------//
//-------- nicolassaad.com ---------//

//--DESCRIPTION:------------------------------------------------------------------------------//
/* A PHP plugin that displays different greeting messages based on the user's local time.
   This plugin detect a user's time zone using jQuery. First, the current user's timezone offset
   (in minutes) is retrieved and stored in a variable. Next, PHP collects this variable using the
   $POST. Finally, the timezone is converted into a readable timezone in text-form that the code
   can then read. */

//--HOW TO USE:-------------------------------------------------------------------------------//
/* 1. Download both plugin files and store them in your project.
   2. Include the file 'timely-greeting.php' at the top of the page you want to use it in.
   Example: <?php include('includes/timely-greeting.php'); ?>
   3. In the exact spot on your page where you wan the greeting to display, add this line of code:

   <span class="timelyGreeting"></span> <!-- greeting outputs inside span tags -->
   */
//--------------------------------------------------------------------------------------------//

// Handle AJAX request (start)
if( isset($_POST['name']) ){

    // Storing the timezone offset from the jQuery code
    $timezone_offset_minutes = $_POST['name'];

    // Convert minutes to seconds
    $timezone_name = timezone_name_from_abbr("", ($timezone_offset_minutes*60), false);
    //JS code is needed to retrieve the user's timezone dynamically so we have it set statically for now
    date_default_timezone_set($timezone_name);

    // Morning start and end times 12:00AM - 11:59AM (12:00AM - 11:59AM)
    $morningStart = '0000';
    $morningEnd   = '1159';
    // Afternoon start and end times 12:00PM - 4:59PM (12:00PM - 4:59PM)
    $afterNoonStart = '1200';
    $afterNoonEnd   = '1659';
    // Evening start and end times 5:00PM - 11:59PM (5:00PM - 11:59PM)
    $eveningStart = '1700';
    $eveningEnd   = '2359';

    // The text greetings. **You can edit the values below but do not edit the keys**
    $greetings = array(
        "morning"   => "Good morning",
        "afternoon" => "Good afternoon",
        "evening"   => "Good evening"
        );

    // Retrieving the current time
    $now = date('H:i');

    //error_log(print_r($now, false));

    // Removing the colon from the $now variable
    $now = str_replace(":" , "" , "$now");

    //Checking the current time of day in order to display the correct greeting
    if ( ($now >= $morningStart) && ( $now <= $morningEnd ) ) {
        echo $greetings["morning"];

    } elseif ( ($now >= $afterNoonStart) && ( $now <= $afterNoonEnd) ) {
        echo $greetings["afternoon"];

    } elseif ( ($now >= $eveningStart) && ( $now <= $eveningEnd) ) {
         echo $greetings["evening"];
    }
}
include('timezone-ajax.html');
?>

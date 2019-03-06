<?php

require_once 'firebase.php';

// paste here getting fcm registration device token
$devicetoken [] = "dCgnXuMuC7s:APA91bEWvmUkAyYGyZ6VIS4KDhOHSTv8Eb8ZNEmWIRQQBWyrIcsN-J41gmKAN33QZIl6siiFcRoTs1vcxh_kZ8nPfk1u57XP28SoANe38ne4qgUPYZnYEL-R9cHjsdrEXQQ70FIrbyb7";

// create array that contains notification details
$res = array();

//push title, message, & image url for big notification  like as below
$res['data']['title'] = "FCM Notification";
$res['data']['message'] = "Testing message";
$res['data']['image'] = "http://www.amisungroups.com/developer/fcmNotification/android_banner.jpg";

/* //push title, message for small notification like as below
$res['data']['title'] = "FCM Demo";
$res['data']['message'] = "Testing message";*/


//creating firebase class object
$firebase = new Firebase();

//sending push notification and displaying result
echo $firebase->send($devicetoken, $res);

?>

<?php
    include("connect.php");
     $connect_1 = mysqli_connect($host, $user, $pass, $databasename) or die("Couldn't connect to database!");

     $sql= mysqli_query($connect_1,
           "SELECT * from `info_user`");
           
     while($row = mysqli_fetch_assoc($sql))
     {
       $url = "https://fcm.googleapis.com/fcm/send";
       $token = $row['FCM_ID'];
       $serverKey = 'AAAArqESQxA:APA91bEPD-zROiksdWZhFII9pxK_snPJeL4vpwqA72CYdnPdRR8yUuEnE_1vKLE-BsgyJ5DL12jhA0MK85Se5KdG8989TInZlxgCS-cpZ8BDucpw6k6A6fWxuMim_F2weFJ4Jg5SfjPr';
       $title = "A New Event is Available";
       $body = "SAMPLE EVENT NAME";
       $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
       $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
       $json = json_encode($arrayToSend);
       $headers = array();
       $headers[] = 'Content-Type: application/json';
       $headers[] = 'Authorization: key='. $serverKey;
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
       curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
       curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
       //Send the request
       $response = curl_exec($ch);
       //Close request
       if ($response === FALSE) {
       die('FCM Send Error: ' . curl_error($ch));
       }
       curl_close($ch);
     }
     mysqli_close($connect_1);
?>
<?php
    $url = 'https://jsonplaceholder.typicode.com/posts';

    $responderUrl = "/~api/calendar/calendarList?action=get";


    //Example Query to get isFeatured=1

    $responderParameter = "view=xml&fields=ActivityId,ActivityName,ParentActivityName,Description,StartDate,EndDate,StartMinute,EndMinute,ActivityTypeCode,LocationId,CampusName,BuildingCode,RoomNumber,RoomName,InstitutionId,EventMeetingByActivityId.isFeatured&sortOrder=StartDate&filter=((ActivityTypeCode%3F%3D2)%26%26(EventMeetingByActivityId.isFeatured%3F%3D1))";

$curl = curl_init();

curl_setopt_array($curl, array(

 CURLOPT_URL => $url . "/Logon.ashx",
 CURLOPT_RETURNTRANSFER => true,
 CURLOPT_ENCODING => "",
 CURLOPT_MAXREDIRS => 10,
 CURLOPT_TIMEOUT => 30,
 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
 CURLOPT_CUSTOMREQUEST => "POST",
 CURLOPT_POSTFIELDS => "{\"username\": \"test\", \"password\": \"test\"}",
 CURLOPT_HTTPHEADER => array(

   "accept: application/json",

   "cache-control: no-cache",

   "content-type: application/json"
 ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
 
curl_close($curl);

if ($err) {
 echo "cURL Error #:" . $err;
} else {
 echo $response;
}
              $request = curl_init();
              curl_setopt($request, CURLOPT_URL, $url . $responderUrl);
              curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE);
              curl_setopt($request, CURLOPT_RETURNTRANSFER, TRUE);
              curl_setopt($request, CURLOPT_CUSTOMREQUEST, "POST");
              curl_setopt($request, CURLOPT_HEADER, FALSE);
              curl_setopt($request, CURLOPT_COOKIEFILE, 'tmp_astra_cookie_file.txt');
              curl_setopt($request, CURLOPT_COOKIEJAR, 'tmp_astra_cookie_file.txt');
              curl_setopt($request, CURLOPT_POSTFIELDS, $responderParameter);
              $result = curl_exec($request);
              curl_close($request);

              if ($result) {
                $data = new SimpleXMLElement($result);
                foreach ($data->Item as $entry) {
                                echo "XML Activity Name: " . $entry->ActivityName . "<br>";
                }
              } else {
            echo "Secondary Request failure.<br>";
            exit();
              }

 
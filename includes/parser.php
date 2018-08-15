    <?php

// @include('web_listner.php');
//make sure the phone number is without a 0 before 6 (ver.1 is not acountable for that yet will be implemented later if needed) D
// $url = "http://localhost:8080/ACTIVEXSMS/includes/gsm.php?phoneNr=683598299&message=yourcodeis3333&autosubmit=yes";
// $remoteurl = "http://192.168.88.245:8080/ACTIVEXSMS/includes/gsm.php?phoneNr=683598299&message=yourcodeis=5555&autosubmit=yes";
echo $url = $_SERVER['REQUEST_URI'];
$query_str = parse_url($url, PHP_URL_QUERY);
parse_str($query_str, $query_params);
// $email = $query_params['email'];
$phoneNr = $query_params['phoneNr'];
$message = $query_params['message'];
//here we can
print_r($query_params);


    // $message=$_POST["msg"];

    // echo $message;
/*
    // curl initialize
    $ch = curl_init();

    // set curl options
    curl_setopt($ch, CURLOPT_URL, "https://jsonplaceholder.typicode.com/posts/1");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // execute request and return response
    $output = curl_exec($ch);

    echo $output;

    // close cURL request
    curl_close($ch);
*/
    

//optional 
/**
 * Parses a url to extract the query parameters from it as a assoc array
 * @param string $url
 * @param bool $decode (optional) apply url decode
 * @return array
 */
// function parseUrl($url, $decode = false)
// {
//     $urlData = parse_url($url);
//     if (empty($urlData['query'])) { return null; }
//     $query = explode("&", $urlData['query']);
//     $parameters = array();
//     foreach($query as $parameter) {
//         $param = explode("=", $parameter);
//         if (!empty($param) && count($param) == 2)
//             $parameters[$param[0]] = $decode == true ? urldecode($param[1]) : $param[1];
//     }
//     return $parameters;
// }
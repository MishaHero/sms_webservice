<?php
$url = 'https://jsonplaceholder.typicode.com/posts/1';
$request_body = file_get_contents($url);
if($_REQUEST['noshow']){
    //not required but may coe alternatives for not showing on screen

}else{
    echo "<pre>".$request_body;

}

if(isset($_REQUEST['nosave'])){
    //not required but may code alternatives for not saving as a file
}else{
    //this gonna keep record of
    $now = DateTime::createFromFormat('U.u', microtime(true));
    file_put_contents('payload_'.$now->format('m_d_Y_H_i_s_u').'txt', $request_body, FILE_APPEND);
}
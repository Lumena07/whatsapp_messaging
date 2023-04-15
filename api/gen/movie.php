<?php
header('Access-Control-Allow-Origin:*');
header('Content-type:application/json');
header('Access-Control-Allow-Method:GET');
header('Access-Control-Allow-Headers:Origin,Content-type,Accept');//handle pre-flight request

include_once('../../models/movies.php');
$movie = new Movies();
if($_SERVER['REQUEST_METHOD']=='GET'){
  echo json_encode(array('success'=>1,'Movies'=>$movie->get_movies()));
}
else{
    die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
?>
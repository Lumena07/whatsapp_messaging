<?php
header('Access-Control-Allow-Origin:*');
header('Content-type:application/json');
header('Access-Control-Allow-Method:GET');
header('Access-Control-Allow-Headers:Origin,Content-type,Accept');//handle pre-flight request

include_once('../../models/trending_movies.php');
$trending_movies = new TrendingMovies();
if($_SERVER['REQUEST_METHOD']=='GET'){
  echo json_encode(array('success'=>1,'Movies'=>$trending_movies->get_movies()));
}
else{
    die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
?>
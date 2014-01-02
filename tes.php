<?php 
$url = "http://pemilu.okezone.com/read/2013/12/31/567/919853/hidayat-kalah-di-dki-belum-tentu-kalah-di-nasional";
$info = file_get_contents('https://graph.facebook.com/comments/?ids='.$url);

$yow = json_decode($info);

if($yow){
    foreach ($yow->$url->comments->data as $value) {

        echo $value->message.'<br>';
    }
}
?>
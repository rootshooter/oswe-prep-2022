<?php

$file = $_GET['page'];
$file = str_replace( array( "etc", "passwd" ), "", $file );

if(isset($file)){
    system('cat'. " " .  $file);}

// Mul?i;\W'a'y*
?>
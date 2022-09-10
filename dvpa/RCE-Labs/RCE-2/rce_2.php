<?php

$domain = $_GET["domain"];

if(isset($domain)){
system("whois " . $domain);
}

?>
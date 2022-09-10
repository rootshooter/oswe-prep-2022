<?php
$whois_domain = $_POST["domain"];
$whois_domain = str_replace( array( "&","||" , "&&" , ";" ), " ", $whois_domain );

if(isset($whois_domain)){
system('whois' ." ".$whois_domain );
} 
?>      







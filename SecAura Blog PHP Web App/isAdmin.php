<?php
// Code to check if user came from localhost or not
function isLocalhost($whitelist = ['127.0.0.1', '::1']) {
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}

if (isLocalhost() == 1){
    // echo "Welcome localhost";
}else{
    echo "you arent localhost";
    header('Location: /blog/?error=Not allowed');
}
?>
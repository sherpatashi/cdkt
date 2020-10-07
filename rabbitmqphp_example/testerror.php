#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function Error($msg)
{
  $msg = strtolower($msg);
  if (preg_match('/error/',$msg) | preg_match('/failed/',$msg) | preg_match('/successful/',$msg))
  {
    return True;
  }
  return false;
}
function LogError($e,$myFile)
{
  $file = __FILE__.PHP_EOL;
  $user = explode("/",$file);
  $string = trim(preg_replace('/\s+/', ' ', $myFile));

  $LogError = array();
  $LogError['date'] = date("Y-m-d");
  $LogError['time'] = date("h:i:sa");
  $LogError['user'] = $user[2];
  $LogError['text'] = $e;
  $LogError['file'] = $string;

 
  $msg = implode(" - ",$LogError);
  
  if (Error($msg))
  {
    $client = new rabbitMQClient("errorListener.ini","testServer");
    $client->publish($msg);
  }
 
  error_log($msg.PHP_EOL,3,"../logs/logfile.log");
}

function LogServerMsg($e)
{
  error_log($e.PHP_EOL,3,"../logs/logfile.log");
}
?>

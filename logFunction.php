<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors,' 1);

//error detection
function logErrors($error_level, $error_message, $filename, $line_number){
	$today = date("M/d/Y");
	$time = date("h:i:sa");
	$myfile = "logs";
  
	$file  = "[$today | $time]  $error_level in $filename at line $line_number. \n";
	publishToLog($file);
	file_put_contents("log/$myfile.log", $file, FILE_APPEND);

}
set_error_handler("logErrors");

// check if username and password is null 
function ifNull($username,$password){
$username = strtolower($_GET['username']);
$password = strtolower($_GET['password']);

if($username == '' || $password == '' || $username == null || $password == null){

	$logFile = fopen("logs/login.log", "a");
	$logText = "Login attempt failed due to null entry.\n";
	fwrite($logFile, $logText);
  publishToLog($$logText);
  fclose($logFile);
}


//check if username and password exists
$response = login($username, $password);
if($response == true){
	$_SESSION['username'] = $username;

	$logFile = fopen("logs/login.log", "a");
	$logText = "[$today | $time] Login attempt from User: $username | Login Successful.\n";

	fwrite($logFile, $logText);
  publishToLog($logText);
	fclose($logFile);
}

//publish log message to the server
function publishToLog($message)
{
        $client = new rabbitMQClient('logRMQ.ini','logServer');
        $client->publish($message);
}
?>

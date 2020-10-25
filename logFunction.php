#!/usr/bin/php
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//error detection
function logErrors($error_level, $error_message, $filename, $line_number){
	$today = date("M/d/Y");
	$time = date("h:i:sa");
	//$myfile = "logs";

	$file  = "[$today | $time]  $error_level in $filename at line $line_number. \n";
	publishToLog($file);
	//file_put_contents("log/$myfile.log", $file, FILE_APPEND);

}
set_error_handler("logErrors");

// Login logging system.

//function ifNull($username,$password){

$username = strtolower($_GET['username']);
$password = strtolower($_GET['password']);

if($username == '' || $password == '' || $username == null || $password == null){
	/*
	$logFile = fopen("logs/login.log", "a");
	$logText = "Login attempt failed due to null entry.\n";
	fwrite($logFile, $logText);
  	fclose($logFile);
	*/
	$logText = "Login attempt failed due to null entry.\n";
	publishToLog($$logText);
}
$response = login($username, $password);
if($response == true){
	$_SESSION['username'] = $username;
	/*
	$logFile = fopen("logs/login.log", "a");
	$logText = "[$today | $time] Login attempt from User: $username | Login Successful.\n";

	fwrite($logFile, $logText);
	fclose($logFile);
 	*/
	$logText = "[$today | $time] Login attempt from User: $username | Login Successful.\n";
	publishToLog($logText);
}

// Registration logging system.

//$regUsername = strtolower($_GET['registerUsername']);
//$regPassword = strtolower($_GET['registerPassword']);

if($regUsername == '' || $regPassword == '' || $regUsername == null || $regPassword == null){
        echo "Username or Password field left empty, try again.";
        header("location:../index.html?registrationEmpty=blank");
	/*
	$logFile = fopen("logs/accountRegistration.log", "a");
        $logText = "[$today | $time] Account registration attempt failed due to null entry.\n";
      	fwrite($logFile, $logText);
	*/
	$logText = "[$today | $time] Account registration attempt failed due to null entry.\n";fclose($logFile);
      	publishToLog($logText);
}

$response = registration($regUsername, $regPassword);

if($response == true){
	echo "\nAccount has been created successfully.";
	#  header REFRESH THE LOGIN WITH SUCCESSFUL ACCOUNT CREATION NOTIFICATION.
	/*
	$logFile = fopen("logs/accountRegistration.log", "a");
        $logText = "[$today | $time] Account registration attempt for User: $regUsername & Password: $regPassword | Registration successful.\n";
	fwrite($logFile, $logText);
        fclose($logFile);
	*/
        $logText = "[$today | $time] Account registration attempt for User: $regUsername & Password: $regPassword | Registration successful.\n";
	publishToLog($logText);
}
elseif($response == false){
	echo "\nAccount already exists.";
        #  header REFRESH THE LOGIN WITH SUCCESSFUL ACCOUNT CREATION NOTIFICATION.
	/*
        $logFile = fopen("logs/accountRegistration.log", "a");
        $logText = "[$today | $time] Account registration attempt for User: $regUsername & Password: $regPassword | Failed because username already exists.\n";
        fwrite($logFile, $logText);
        fclose($logFile);
	*/
	$logText = "[$today | $time] Account registration attempt for User: $regUsername & Password: $regPassword | Failed because username already exists.\n";
      	publishToLog($logText);
}

//send log message to the server.
function publishToLog($message){
        $client = new rabbitMQClient('logRMQ.ini','logServer');
        $client->publish($message);
        
}
?>

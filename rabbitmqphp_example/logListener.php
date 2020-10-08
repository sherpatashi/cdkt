#!/usr/bin/php
<?php
    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');
	
    function ErrorHandler($err, $fileName){
        $myfile = fopen( $fileName . '.txt', "a" ) or die ("Unable to open file");
        for ($i = 0; $i < count($err); $i++){
          fwrite( $myfile, $err[$i] );
        }
		return true;
    }
	function requestProcessor($request){
        echo "received request".PHP_EOL;
        echo $request['type'];
		
        var_dump($request);
       
        if(!isset($request['type']))
		{
            return array('message'=>"ERROR: unsupported message type");
        }
        switch($request['type']){
            case "frontEnd":
                echo "frontend webserver";
                $response_msg = ErrorHandler($request['error_string'], 'frontEnd');
		echo "Result: " .$response_msg;
		break;
            case "backEnd": 
                echo "Backend Database" ;
                $response_msg = ErrorHandler($request['error_string'], 'backEnd');
                echo "Result: " . $response_msg;
                break;
        }
        echo $response_msg;
        return $response_msg;
    }
    $server = new rabbitMQServer('errorListener.ini', 'testServer');
    $server->process_requests('requestProcessor');
   exit();
   fclose($myfile);
?>

<?php

    //Requried files
    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');
   
    function storeError($error, $fileName){
        $fp = fopen( $fileName . '.txt', "a" );
        for ($i = 0; $i < count($error); $i++){
          fwrite( $fp, $error[$i] );
        }
        return true;
    }


    //This will route the request from server to function
    function requestProcessor($request){
        echo "received request".PHP_EOL;
        echo $request['type'];
        
        //  This will show all the requests comming in
        var_dump($request);
       
        if(!isset($request['type'])){
            return array('message'=>"ERROR: Message type is not supported");
        }
        switch($request['type']){
               
            //  This case will handle all the requests from frontend   
            case "frontend":
                echo "<br>in Frontend listner: ";
                $response_msg = storeError($request['error_string'], 'frontend_errors');
                echo "Result: " . $response_msg;
			   break;
               
            //  This case will handle all the requests from dmz
         /*   case "dmz":
                
                echo "<br>In dmz listner: ";
                
                $response_msg = storeError($request['error_string'], 'dmz_errors');
                echo "Result: " . $response_msg;
                break;
         */
            //  This case will handle all the requests from db
            case "db":
                
                echo "<br>In Database listner: ";
                
                $response_msg = storeError($request['error_string'], 'db_errors');
                echo "Result: " . $response_msg;
                break;
       
        }
        echo $response_msg;
        return $response_msg;
    }

    //creating a new server
    $server = new rabbitMQServer('rabbitMQ_rmq.ini', 'testServer');
   
    //processes the request sent by client
    $server->process_requests('requestProcessor');
   

    ?>
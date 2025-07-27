<?php

	include_once ("Clases/Material.php");

	
//No timeouts, Flush Content immediatly
    set_time_limit(0);
    ob_implicit_flush();
   
//Service Settings
    $phpPath = PHP_EXE_PATH;
    $ServiceName = 'phpServiceName';
    $ServiceDisplay = 'phpDisplayName';
	
//Windows Service Control
 //   $ServiceAction = "status";
    //$ServiceAction = "debug";
    if ( isset($_GET['ServiceAction']) and strlen($_GET['ServiceAction']) ) {
        $ServiceAction = addslashes($_GET['ServiceAction']);
    } else if ( isset($argv) and isset($argv[1]) and strlen($argv[1]) ) {
        $ServiceAction = $argv[1];
    }
    switch ($ServiceAction){
    	case "status": 
	        $ServiceStatus = win32_query_service_status($ServiceName);
	        switch ($ServiceStatus) {
			case WIN32_SERVICE_STOPPED          : echo "Service Stopped\n\n";
				break;
			case WIN32_SERVICE_START_PENDING    : echo "Service Start Pending\n\n";
				break;
			case WIN32_SERVICE_STOP_PENDING     : echo "Service Stop Pending\n\n";
				break;
			case WIN32_SERVICE_RUNNING          : echo "Service Running\n\n";
				break;
			case WIN32_SERVICE_CONTINUE_PENDING : echo "Service Continue Pending\n\n";
				break;
			case WIN32_SERVICE_PAUSE_PENDING    : echo "Service Pause Pending\n\n";
				break;
			case WIN32_SERVICE_PAUSED           : echo "Service Paused\n\n";
				break;
	        default                             : echo "Service Unknown\n\n";
	        break;
	        }
	      exit;
	      break;
    	case "install" :
    //Install Windows Service
	        win32_create_service( Array(
	            'service' => $ServiceName,
	            'display' => $ServiceDisplay,
	            'params' => __FILE__,
	            'path' => $phpPath,
	        ));
	        echo  __FILE__ . " run";
	        echo "Service Installed\n\n";
	        exit;
	        break;
    	case "uninstall" :
    //Remove Windows Service
	        win32_delete_service($ServiceName);
	        echo "Service Removed\n\n";
	        exit;
	        break;
    	case "start" :
	    //Start Windows Service
	      win32_start_service($ServiceName);
	      echo "Service Started\n\n";
	      exit;
	      break;
    	case "stop" :
	    //Stop Windows Service
	      win32_stop_service($ServiceName);
	      echo "Service Stopped\n\n";
	      exit;
	      break;
    	case "run" :
	    //Run Windows Service
	        win32_start_service_ctrl_dispatcher($ServiceName);
	        win32_set_service_status(WIN32_SERVICE_RUNNING);
	      break;
	    case "debug" :
		    //Debug Windows Service
		        set_time_limit(10);
		   break;
        default:        exit();
    }

//Server Loop
    while (1) {
    //Handle Windows Service Request
        usleep(100*1000);
            switch ( win32_get_last_control_message() ) {
                case WIN32_SERVICE_CONTROL_CONTINUE:
                    break;
                case WIN32_SERVICE_CONTROL_INTERROGATE:
                    win32_set_service_status(WIN32_NO_ERROR);
                break;
                case WIN32_SERVICE_CONTROL_STOP:
                    win32_set_service_status(WIN32_SERVICE_STOPPED);
                    exit;
                default:
                    win32_set_service_status(WIN32_ERROR_CALL_NOT_IMPLEMENTED);
            }
    //User Loop
        sleep(1);
        echo "\n<BR>YOUR CODE HERE";
    }

//Exit
    if ( $ServiceAction == "run" ) {
        win32_set_service_status(WIN32_SERVICE_STOPPED);
    }
    exit();
?>
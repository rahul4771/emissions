<?php

namespace App\Repositories;

use App\Repositories\Interfaces\LogInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LogRepository implements LogInterface
{
    public function writeLog( $name = '-custom-log', $data ) {
        $date       =  Carbon::now();
        // create a log channel
        $log        = new Logger( $name );
        $myval      = env( 'APP_ENV', null );
        if ( $myval != 'local' ) {
            $logPath    = config( 'constants.live_log_path' );
        } else {
            $logPath    = config( 'constants.log_path' );
        }
        $log->pushHandler( new StreamHandler( $logPath.'/'.$date->toDateString().$name.'.log', Logger::INFO ) );
        $log_data   = json_decode( json_encode( $data ), 1 );
        // add records to the log
        $log->info( json_encode( $log_data ) );

        return 1;
    }

    /*public static function logSerialize( $name = '-custom-log', $data ) 
    {
        $date      =  Carbon::now();
        // create a log channel
        $log       = new Logger( $name );
        $myval     = env( 'APP_ENV', null );
        if ( $myval != 'local' ) {
            $logPath = config( 'constants.live_log_path' );
        } else {
            $logPath = config( 'constants.log_path' );
        }
        $log->pushHandler( new StreamHandler( $logPath.'/'.$date->toDateString().$name.'.log', Logger::INFO ) );
        // $log_data = json_decode( json_encode( $data ), 1 );
        // add records to the log
        $log->info( $data );

        return 1;
    }*/
}

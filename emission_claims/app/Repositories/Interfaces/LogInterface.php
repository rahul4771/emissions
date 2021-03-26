<?php 

namespace App\Repositories\Interfaces;

interface LogInterface
{

    public function writeLog( $name = '-custom-log', $data );

}
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;
use Config;
class Connection extends Model
{
    public function OtherDbConnection()
    {
        $dbid=Session::get('currentvertical');
        $verticals = $this->getCurrentdb($dbid);
    if(count($verticals)>0){
            Config::set('database.connections.mysql_verticals.host',env('COM_DB_HOST_READ')); 
            Config::set('database.connections.mysql_verticals.database', $verticals[0]->db_name);       
            Config::set('database.connections.mysql_verticals.username',env('COM_DB_USERNAME'));
            Config::set('database.connections.mysql_verticals.password',env('COM_DB_PASSWORD'));
    }
        
    }

     public function OtherMasterDbConnection()
    {
        $dbid=Session::get('currentvertical');
        $verticals = $this->getCurrentdb($dbid);
    if(count($verticals)>0){
            Config::set('database.connections.master_mysql_verticals.host',env('COM_DB_HOST_WRITE')); 
            Config::set('database.connections.master_mysql_verticals.database', $verticals[0]->db_name);       
            Config::set('database.connections.master_mysql_verticals.username',env('COM_DB_USERNAME'));
            Config::set('database.connections.master_mysql_verticals.password',env('COM_DB_PASSWORD'));
    }
        
    }
    
    
    public function getCurrentdb($dbid)
    {
            $query = DB::table('domains')
            ->select('id as domainid','domain_name','domain_url','master_host','db_host','db_name','db_user','db_password')->where('id', $dbid);
            $result=$query->get();
            return $result;
    }

     public function AdtopiaDbConnection()
    {

            Config::set('database.connections.mysql_verticals.host', 'prod-atp-aur-v00-cluster.cluster-clxevf67v7i9.eu-west-2.rds.amazonaws.com'); 
            Config::set('database.connections.mysql_verticals.database', 'adtopia2');       
            Config::set('database.connections.mysql_verticals.username','dbadmin');
            Config::set('database.connections.mysql_verticals.password','Hc33dky!8z');
            /*Config::set('database.connections.mysql_verticals.host', 'localhost'); 
            Config::set('database.connections.mysql_verticals.database', 'adtopia_db');       
            Config::set('database.connections.mysql_verticals.username','root');
            Config::set('database.connections.mysql_verticals.password','');*/
    } 

    public function Adtopia1DbConnection()
    {

          Config::set('database.connections.mysql_verticals.host', '172.24.16.236'); 
           Config::set('database.connections.mysql_verticals.port', '3306'); 
            Config::set('database.connections.mysql_verticals.database', 'adtopia_db');       
            Config::set('database.connections.mysql_verticals.username','adtopia_user');
            Config::set('database.connections.mysql_verticals.password','4^QN~.a[?fWn');
            /*Config::set('database.connections.mysql_verticals.host', 'localhost'); 
            Config::set('database.connections.mysql_verticals.database', 'adtopia_db');       
            Config::set('database.connections.mysql_verticals.username','root');
            Config::set('database.connections.mysql_verticals.password','');*/


/*'mysql_master' => [
            'driver'    => 'mysql',
            'host'      => '172.24.16.236',
            'database'  => 'adtopia_db',
            'username'  => 'adtopia_user',
            'password'  => '4^QN~.a[?fWn',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],*/
    } 

    public function AdtopiaLists()
    {
        return DB::connection()->getDatabaseName();
    }  

     public function role_index()
    {
         $role =  Auth::user()->role_id;
                        $role_indexes =   DB::table('roles')
                         ->select('role_index')
                        ->where('roleId','=',$role)
                        ->first();

        $role_index =  $role_indexes->role_index;

        return $role_index;
    }
}

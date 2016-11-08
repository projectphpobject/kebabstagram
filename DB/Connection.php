<?php
namespace DB;

use Illuminate\Database\Capsule\Manager ;

class Connection {



        //fonction qui démarre eloquent
        public static  function bootEloquent($file) {
            $conf = parse_ini_file($file);

            //if (file_exists($file)) {
            //$conf = parse_ini_file(dirname(__FILE__) . '/../'.$file);}
            //create a new instance of Manager
            $db= new Manager();
            $db->addConnection($conf);
            //make this instance available globally
            $db->setAsGlobal();
            //set up the ORM Eloquent
            $db->bootEloquent();
        }
        //fonction de logs
        public static function logs() {

            return Manager::getQueryLog();
        }





}
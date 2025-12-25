<?php
namespace config;



class dbconfig {

private static $instance = NULL;
private $pdo;

private function __construct() {

        // parse the configuration file for databases
        $config = parse_ini_file('dbconfig.ini');

        $driver = $config['driver'];
        $host = $config['host'];
        $dbname = $config['dbname'];
        $username = $config['username'];
        $password = $config['password'];

    try{
        $this->pdo = new \PDO("$driver:host=$host;dbname=$dbname", $username, $password);


    } catch (\PDOException $e) {
         die("Connection failed: " . $e->getMessage());
        }
    }
    
    
      public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new dbconfig();
        }
        return self::$instance;
    }

    public function getPdo() {
        return $this->pdo;
    }

}

?>
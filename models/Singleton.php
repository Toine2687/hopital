<?php

require_once __DIR__ . '/../config/config.php';

class Singleton
{
    private static $instance = null;
    private $cnx;
    // constructeur privé pour empecher la diversité des instances
    private function __construct()
    {
        $this->cnx = new PDO(DSN, USER, PASSWORD);
    }
    public static function getInstance()
    {
        // pas de doublon
        if (!self::$instance) {
            self::$instance = new Singleton();
        }
        return self::$instance;
    }
    public function sConnect(){
        return $this->cnx;
    }
}

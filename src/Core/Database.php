<?php
namespace TaskFlow\Core;
use PDO;

class Database {
  private static ?Database $instance = null;
  private PDO $connection;

  private function __construct() {
    $host = '127.0.0.1';
    $db   = 'taskflow';
    $user = 'taskflow_user';
    $pass = 'okapi23';

    $dsn = "mysql:host=$host;dbname=$db";
    $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $this->connection = new PDO($dsn, $user, $pass, $options); // dsn = data source name 
  }

  public static function getInstance(): Database {
    if (self::$instance === null) {
      self::$instance = new Database();
    }
    return self::$instance;
  }

  public function getConnection(): PDO {
    return $this->connection;
  }
}


<?php
class Database
{
  private static $pdo = null;
  private static $dotenv;
  private static $host;
  private static $user;
  private static $password;
  private static $dbName;
  private static $dbPort;


  public static function connectDB()
  {
    if (self::$pdo === null) {
      self::$dotenv = parse_ini_file(dirname(__DIR__) . '/.env');
      self::$host = self::$dotenv['DB_HOST'];
      self::$user = self::$dotenv['DB_USER'];
      self::$password = self::$dotenv['DB_PASSWORD'];
      self::$dbName = self::$dotenv['DB_NAME'];
      self::$dbPort = self::$dotenv['DB_PORT'];

      try {
        self::$pdo = new PDO("mysql:host=" . self::$host . ";port=" . self::$dbPort . ";dbname=" . self::$dbName, self::$user, self::$password);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
      }
    }

    return self::$pdo;
  }
}

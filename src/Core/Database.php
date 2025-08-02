<?php
declare(strict_types=1);

namespace App\Core;
use PDO;
use PDOException;
class Database {

private static ?PDO $instance=null;
private static string $host;
private static string $username;
private static  string $password;
private static string $dbname;
private static string $charset = 'utf8mb4';
private static int $port ;

public static function initialize(): void {
    self::$host = $_ENV['DB_HOST'] ?? '127.0.0.1';
    self::$username = $_ENV['DB_USER'] ?? 'root';
    self::$password = $_ENV['DB_PASS'] ?? '';
    self::$dbname = $_ENV['DB_NAME'] ?? 'blog_db';
    self::$charset = $_ENV['DB_CHARSET'] ?? 'utf8mb4';
    self::$port = (int)($_ENV['DB_PORT'] ?? 3306);
}

public static function createConnection():void   {

try {
self::initialize();
$dsn ="mysql:host=".self::$host.";port=".self::$port.";dbname=".self::$dbname.";charset=".self::$charset;
self::$instance = new PDO($dsn, self::$username, self::$password,[
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);

echo "database connection established successfully\n";

} catch (PDOException $e){
    throw new Exception("Database connection failed:". $e->getmessage());
}

}


public static function getConnection():PDO{
    if(self::$instance===null){
echo "Creating new database connection...\n";
self::createConnection();
        return self::$instance;
    }
   
}





public static function databaseInfo():array{
    return [
      
"host"=>self::$host,
"username"=>self::$username,
"password"=>self::$password,
"dbname"=>self::$dbname,
"charset"=>self::$charset,
"port"=>self::$port  

    ];
}

}
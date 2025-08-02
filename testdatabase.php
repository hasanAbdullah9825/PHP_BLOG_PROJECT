<?php 
declare(strict_types=1);
require_once __DIR__.'/vendor/autoload.php';

use App\Core\Database;

try{
  

    // Initialize database connection
   $connection = Database::getConnection();
 if($connection){
    echo "database connection established successfully\n";
    $info = Database::databaseInfo();
    echo "Database Information:\n";
    print_r($info);
 }

} catch (Exception $e) {
    echo "❌ An error occurred: " . $e->getMessage() . "\n";
}
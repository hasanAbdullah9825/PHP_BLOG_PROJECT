<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;  // ← Using another class

class Post
{
    public function getMessage(): string
    {
        $database = new Database();
        return "Post model says: " . $database->getMessage();
    }
}
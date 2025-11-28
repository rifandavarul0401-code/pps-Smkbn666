<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    // Backup existing data
    $users = DB::table('users')->get();
    
    // Drop and recreate table with new constraint
    DB::statement('DROP TABLE IF EXISTS users_backup');
    DB::statement('CREATE TABLE users_backup AS SELECT * FROM users');
    
    DB::statement('DROP TABLE users');
    
    DB::statement('
        CREATE TABLE users (
            user_id INTEGER PRIMARY KEY AUTOINCREMENT,
            username VARCHAR(255) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            nama_lengkap VARCHAR(255) NOT NULL,
            level VARCHAR(255) CHECK (level IN ("admin", "kesiswaan", "guru", "kepsek", "bk", "siswa", "ortu", "wali_kelas")) NOT NULL,
            can_verify BOOLEAN DEFAULT 0 NOT NULL,
            is_active BOOLEAN DEFAULT 1 NOT NULL,
            last_login DATETIME,
            created_at DATETIME,
            updated_at DATETIME
        )
    ');
    
    // Restore data with proper level values
    foreach ($users as $user) {
        $userData = (array) $user;
        // Make sure level is set for existing users
        if (empty($userData['level'])) {
            $userData['level'] = 'admin'; // Default level
        }
        DB::table('users')->insert($userData);
    }
    
    echo "Database updated successfully!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data tanpa truncate (agar foreign key tidak masalah)
        DB::table('users')->delete();
<<<<<<< HEAD
        
        // Reset auto increment
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');
        
=======

        // Reset auto increment
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');

>>>>>>> origin/main
        // Insert data user
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'name' => 'Administrator',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'staff',
                'name' => 'Staff User',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'manager',
                'name' => 'Manager',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
<<<<<<< HEAD
        
=======

>>>>>>> origin/main
        $this->command->info('✅ Users seeded successfully!');
        $this->command->info('Username: admin, staff, manager');
        $this->command->info('Password: password123');
    }
<<<<<<< HEAD
}
=======


}
>>>>>>> origin/main

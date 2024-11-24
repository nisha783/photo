<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Deposite;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',  
            'email' => 'test@example.com',
        ]);
       
        User::create([
            'name' => 'Admin ',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
    
      
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        DB::table('users')->insert([
            'name' => 'seliji',
            'email' => 'muqa@mailinator.com',
            'password' => bcrypt('your_password_here'),
            'filepath' => 'path/to/default_or_specific_filepath', // Add this line
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        

    }
}

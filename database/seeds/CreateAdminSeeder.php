<?php

use App\User;
use App\Contract;
use Illuminate\Database\Seeder;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => "Admin",
            'email' => "admin@admin.com",
            'is_admin' => 1,
            'password' => bcrypt(123456),
        ]); 
    }
}

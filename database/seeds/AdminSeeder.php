<?php

use App\Constants\UserLevel;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->firstOrCreate([
            "name" => "Super Admin",
            "username" => "admin",
            "password" => Hash::make("admin"),
            "level" => UserLevel::ADMIN_DINAS_KESEHATAN,
        ]);
    }
}

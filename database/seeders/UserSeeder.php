<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->role = "admin";
        $user->name = "Gioele Pannetto";
        $user->username = "giopan";
        $user->password = Hash::make(env("DEFAULT_ADMIN_PASSWORD", "password"));
        $user->save();
    }
}

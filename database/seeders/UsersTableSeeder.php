<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'test@example.com',
            'role' => 'administrator',
            'password' => Hash::make(123123123),
        ]);
    }
}

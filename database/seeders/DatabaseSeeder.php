<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->createUser();
        $this->call(TypeSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(ReceiveSeeder::class);
    }

    protected function createUser(): void
    {
        \App\Models\User::updateOrCreate(['id' => 1], [
            "name" => "admin",
            "email" => "admin@app.com",
            "password" => Hash::make("password"),
        ]);
    }
}

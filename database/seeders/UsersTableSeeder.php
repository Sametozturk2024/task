<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  // DB facade'ını ekleyin
use Illuminate\Support\Facades\Hash;  // Hash facade'ını ekleyin
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // 1) Admin Kullanıcısı
        DB::table('users')->insert([
            'name' => 'admin',
            'role' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'), // Şifreyi hash'le
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2) 20 Rastgele Kullanıcı
        for ($i = 1; $i <= 20; $i++) {
            DB::table('users')->insert([
                'name' => 'user' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => Hash::make('password' . $i),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

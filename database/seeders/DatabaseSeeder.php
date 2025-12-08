<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 3 user dummy
        $user1 = (int) DB::table('users')->insertGetId([
            'Username' => 'johndoe',
            'Email' => 'john@example.com',
            'Password' => Hash::make('password'),
            'NamaLengkap' => 'John Doe',
            'Alamat' => 'Jakarta, Indonesia',
            'Role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user2 = (int) DB::table('users')->insertGetId([
            'Username' => 'janedoe',
            'Email' => 'jane@example.com',
            'Password' => Hash::make('password'),
            'NamaLengkap' => 'Jane Doe',
            'Alamat' => 'Bandung, Indonesia',
            'Role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user3 = (int) DB::table('users')->insertGetId([
            'Username' => 'admin',
            'Email' => 'admin@example.com',
            'Password' => Hash::make('admin123'),
            'NamaLengkap' => 'Admin Galeri',
            'Alamat' => 'Surabaya, Indonesia',
            'Role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Buat album dummy untuk tiap user
        DB::table('album')->insert([
            [
                'NamaAlbum' => 'Liburan 2024',
                'Deskripsi' => 'Koleksi foto liburan',
                'TanggalDibuat' => now(),
                'UserID' => $user1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'NamaAlbum' => 'Wisata Kuliner',
                'Deskripsi' => 'Dokumentasi makanan enak',
                'TanggalDibuat' => now(),
                'UserID' => $user2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'NamaAlbum' => 'Fotografi Jalanan',
                'Deskripsi' => 'Street photography',
                'TanggalDibuat' => now(),
                'UserID' => $user3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->command->info('============================');
        $this->command->info('  🎉 Seeder berhasil! 🎉');
        $this->command->info('============================');
        $this->command->info('📌 Akun Login Testing');
        $this->command->info('👤 johndoe | password: password');
        $this->command->info('👤 janedoe | password: password');
        $this->command->info('👨‍💼 admin | password: admin123');
    }
}

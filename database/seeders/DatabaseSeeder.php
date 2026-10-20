<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat akun default Super Administrator
        User::create([
            'id_user' => 'superadmin',
            'nama' => 'Super Administrator',
            'password' => 'password', // Di-hash otomatis oleh model cast
            'posisi' => 'super administrator',
            'status' => true,
        ]);

        $this->command->info('');
        $this->command->info('╔══════════════════════════════════════════════════╗');
        $this->command->info('║   ✓ Default Super Administrator berhasil dibuat  ║');
        $this->command->info('║                                                  ║');
        $this->command->info('║   ID User  : superadmin                          ║');
        $this->command->info('║   Password : password                            ║');
        $this->command->info('║                                                  ║');
        $this->command->warn('║   ⚠ SEGERA ganti password setelah login!         ║');
        $this->command->info('║   Menu: Edit Profil > Ubah Kata Sandi            ║');
        $this->command->info('╚══════════════════════════════════════════════════╝');
        $this->command->info('');
    }
}

<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class HashExistingPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:hash-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hash semua password plaintext yang sudah ada di database ke bcrypt';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        $updated = 0;

        foreach ($users as $user) {
            // Cek apakah password belum di-hash (bcrypt hash selalu diawali $2y$ atau $2a$)
            if (!str_starts_with($user->password, '$2y$') && !str_starts_with($user->password, '$2a$') && !str_starts_with($user->password, '$2b$')) {
                // Update langsung via query builder agar tidak trigger model cast (double hash)
                User::where('id_user', $user->id_user)->update([
                    'password' => Hash::make($user->password),
                ]);
                $updated++;
                $this->info("✓ Password di-hash untuk user: {$user->id_user}");
            } else {
                $this->line("⊘ Password sudah di-hash: {$user->id_user}");
            }
        }

        $this->newLine();
        $this->info("Selesai! {$updated} password berhasil di-hash dari total {$users->count()} user.");

        return Command::SUCCESS;
    }
}

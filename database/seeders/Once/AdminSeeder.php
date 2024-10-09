<?php

namespace Database\Seeders\Once;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public static string $model = User::class;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'name' => 'Admin',
            'phone' => '998977672097',
            'password' => bcrypt('admin'),
            'telegram_chat_id' => '705320870',
            'is_admin' => true,
        ]);
    }
}

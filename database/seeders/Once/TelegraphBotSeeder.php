<?php

namespace Database\Seeders\Once;

use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Database\Seeder;

class TelegraphBotSeeder extends Seeder
{
    public static string $model = TelegraphBot::class;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (env('TELEGRAM_TOKEN')) {
            self::$model::query()->create([
                'token' => env('TELEGRAM_TOKEN'),
                'name' => 'imedicbot',
            ]);
        }
    }
}

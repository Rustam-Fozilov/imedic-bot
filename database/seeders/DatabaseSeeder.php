<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected array $once_seeders = [
        Once\AdminSeeder::class,
        Once\TelegraphBotSeeder::class,
        Once\TelegraphChatSeeder::class,
    ];
 
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedOnce();
    }

    public function seedOnce(): void
    {
        $seeders = [];

        foreach ($this->once_seeders as $seed) {

            if (isset($seed::$model) && (!$seed::$model::first())) $seeders[] = $seed;
        }

        if (!empty($seeders)) $this->call($seeders);
    }
}

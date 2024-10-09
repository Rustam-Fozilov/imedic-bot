<?php

namespace Database\Seeders\Once;

use DefStudio\Telegraph\Models\TelegraphBot;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Database\Seeder;

class TelegraphChatSeeder extends Seeder
{
    public static string $model = TelegraphChat::class;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bot = TelegraphBot::query()->first();

        if (!is_null($bot)) {
            $bot->chats()->create([
                'chat_id' => '705320870',
                'name' => '[private] rustam_fozilov'
            ]);
        }
    }
}

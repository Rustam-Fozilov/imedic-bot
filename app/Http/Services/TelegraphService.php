<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\UserRequestsModel;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;

class TelegraphService
{
    protected mixed $message;
    protected mixed $chat;

    public function __construct($message, $chat)
    {
        $this->message = $message;
        $this->chat = $chat;
    }

    public function storePhoneNumber(): void
    {
        $phone = $this->message->contact()->phoneNumber();

        if (!str_contains($phone, '+')) {
            $phone = "+" . $phone;
        }

        User::query()->firstOrCreate(
            [
                'phone' => $phone,
                'telegraph_chat_id' => $this->chat->id,
            ],
            [
                'f_name' => $this->message->from()->firstName(),
                'l_name' => $this->message->from()->lastName(),
            ]
        );

        $this->chat->message('Rahmat! xabarnomalarni shu yerda kuting')->removeReplyKeyboard()->replyKeyboard(ReplyKeyboard::make()->buttons([
            ReplyButton::make("Natijalarni ko'rish")
        ]))->send();
    }

    public function showResults($id)
    {
        $this->chat->message($id)->send();
    }
}

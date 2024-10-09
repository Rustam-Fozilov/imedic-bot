<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\UserRequestsModel;
use DefStudio\Telegraph\DTO\Message;
use DefStudio\Telegraph\Enums\ChatActions;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use DefStudio\Telegraph\Models\TelegraphChat;

class TelegraphService
{
    protected Message $message;
    protected TelegraphChat $chat;

    public function __construct($message, $chat)
    {
        $this->message = $message;
        $this->chat = $chat;
    }

    public function storePhoneNumber(): void
    {
        $phone = $this->message->contact()->phoneNumber();

        if (str_contains($phone, '+')) {
            $phone = str_replace('+', '', $phone);
        }

        User::query()->updateOrCreate(
            [
                'phone' => $phone,
                'telegram_chat_id' => $this->chat->chat_id,
            ],
            [
                'name' => $this->message->from()->firstName(),
                'surname' => $this->message->from()->lastName(),
            ]
        );

        $this->chat->message('Rahmat! xabarnomalarni shu yerda kuting')->removeReplyKeyboard()->replyKeyboard(ReplyKeyboard::make()->buttons([
            ReplyButton::make("Natijalarni ko'rish")
        ])->resize())->send();
    }

    public function showResults($id)
    {
        $user = User::query()->where('telegram_chat_id', $this->chat->chat_id)->first();

        if (is_null($user)) {
            return $this->chat->message("Sizning ma'lumotlaringiz bazadan topilmadi")->send();
        }

        UserRequestsModel::query()->firstOrCreate(
            [
                'user_id' => $user->id,
                'chat_id' => $this->chat->id,
                'bejik_id' => $id,
            ],
        );

        $this->chat->message('Natijangizni qidiryapmiz. Biroz kuting...')->send();
        Telegraph::chat($this->chat)->chatAction(ChatActions::TYPING)->send();
    }
}

<?php

namespace App\Http\Controllers\Telegraph;

use App\Http\Services\TelegraphService;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Stringable;
use Throwable;

class StartHandler extends WebhookHandler
{
    public function start(): void
    {
        $this->chat->message("Salom, " . $this->message->from()->firstName() . " 👋" . PHP_EOL . "⬇️ Kontaktingizni yuboring (tugmani bosib)")
            ->replyKeyboard(ReplyKeyboard::make()->buttons([
                ReplyButton::make("☎️ Kontaktni Yuborish")->requestContact(),
            ])->resize())
            ->send();
    }

    protected function handleChatMessage(Stringable $text): void
    {
        $service = new TelegraphService($this->message, $this->chat);
        $prev_message = cache('prev_message');

        try {
            if ($this->message->contact()?->phoneNumber()) {
                $service->storePhoneNumber();
            } else if ($text == "Natijalarni ko'rish") {
                cache(['prev_message' => $text], now()->addMinutes());
                $this->chat->message("Bejik raqamingizni kiriting")->send();
            } else if ($prev_message == "Natijalarni ko'rish") {
                $service->showResults($text);
            } else {
                $this->chat->message("default message")->send();
            }
        } catch (Exception|Throwable|QueryException $exception) {
            $this->chat->message($exception->getMessage())->send();
        }
    }
}

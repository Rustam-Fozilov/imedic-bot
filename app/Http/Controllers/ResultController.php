<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRequestsModel;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function sendUsers(Request $request)
    {
        return UserRequestsModel::query()->limit(15)->get();
    }

    public function getResults(Request $request)
    {
        $userResults = $request->get('data');

        if (is_array($userResults) && count($userResults) > 0) {
            foreach($userResults as $userResult) {
                $user = User::query()->find($userResult['user_id']);

                if ($user && !is_null($user->telegram_chat_id)) {
                    $chat = TelegraphChat::query()->where('chat_id', $user->telegram_chat_id);
                    $chat->message('natijalar keldi')->send();
                }
            }
        }
    }
}

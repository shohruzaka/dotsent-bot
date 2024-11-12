<?php

namespace App\Http\Controllers;

use DefStudio\Telegraph\Telegraph;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function handle(Request $request, Telegraph $telegraph)
    {
        $update = $request->all();

        // Guruhga yangi foydalanuvchi qo'shilganini tekshiradi
        if (isset($update['message']['new_chat_members']) || isset($update['message']['left_chat_member'])) {
            $chatId = $update['message']['chat']['id'];
            $messageId = $update['message']['message_id'];

            // Xabarni o'chirib tashlaydi
            $telegraph::bot('default')
                ->chat($chatId)
                ->deleteMessage($messageId)
                ->send();
        }

        return response()->json(['status' => 'ok']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class SendMessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $data['title'] ="Một cô gái";
        $data['content'] = "Xinh đẹp";

        $options = array(
            'cluster' => 'mt1',
            'encrypted' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger('Notify', 'send-message', $data);

        return redirect()->route('send');
    }
}

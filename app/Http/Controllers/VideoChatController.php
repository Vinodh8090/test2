<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Events\StartVideoChat;
use Illuminate\Support\Facades\Log;

class VideoChatController extends Controller
{
    public function callUser(Request $request)
    {
        $data = [
            'userToCall' => $request->user_to_call,
            'from' => Auth::id(),
            'signalData' => $request->signal_data,
            'type' => 'incomingCall'
        ];

        Log::info('Broadcasting StartVideoChat', $data);

        broadcast(new StartVideoChat($data, $request->user_to_call))->toOthers();
    }

    public function acceptCall(Request $request)
    {
        $data = [
            'signal' => $request->signal,
            'to' => $request->to,
            'type' => 'callAccepted'
        ];

        Log::info('Broadcasting StartVideoChat acceptCall');

        broadcast(new StartVideoChat($data, $request->to))->toOthers();
    }
}

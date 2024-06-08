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
        $data['userToCall'] = $request->user_to_call;
        $data['from'] = Auth::id();
        $data['signalData'] = $request->signal_data;
        $data['type'] = 'incomingCall';

        Log::info('Broadcasting StartVideoChat',$data);

        broadcast(new StartVideoChat($data))->toOthers();
    }

    public function acceptCall(Request $request)
    {
        $data['signal'] = $request->signal;
        $data['to'] = $request->to;
        $data['type'] = 'callAccepted';

        Log::info('Broadcasting StartVideoChat acceptCall');

        broadcast(new StartVideoChat($data))->toOthers();
    }
}
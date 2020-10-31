<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{    
    /**
     * submit
     *
     * @param  mixed $request
     * @return void
     */
    public function submit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);

        Message::create($request->all());

        return redirect('/')->with('success', 'Message Sent');
    }

    public function getMessage()
    {
        $messages = Message::all();

        return view('message', [
            'messages' => $messages
        ]);
    }
}

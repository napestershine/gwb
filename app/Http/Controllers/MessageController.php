<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index()
    {
        return view('messages');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validator = \Validator::make($request->all(), [
            'message' => 'required|max:255',
            'user_id' => 'required'
        ]);
        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }


        $message = new \App\Message;
        $message->message = $request->message;
        $message->user_id = $request->user_id;
        $message->save();
        return redirect('/messages');
    }
}

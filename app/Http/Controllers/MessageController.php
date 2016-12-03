<?php

namespace App\Http\Controllers;

use App\Message;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MessageController extends Controller
{

    public function index($receiver_id, $job_id, Request $request)
    {
        $job = \App\Jobs::find($job_id);

        $user = $request->user();

        $messages = \App\Message::where('job_id', $job_id)
            ->whereIn('sender_id', [$receiver_id, $user->id])
            ->whereIn('receiver_id', [$receiver_id, $user->id])
            ->orderBy('updated_at', 'desc')->get();

        if($receiver_id==$job->user_id) {
            $receiver_id=$job->user_id;
        }

        return view('messages', compact(['job', 'messages', 'receiver_id']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'message' => 'required|max:255',
            'sender_id' => 'required',
            'receiver_id' => 'required',
            'job_id' => 'required'
        ]);
        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $message = new \App\Message;
        $message->message = $request->message;
        $message->sender_id = $request->sender_id;
        $message->receiver_id = $request->receiver_id;
        $message->job_id = $request->job_id;
        $message->save();
        return redirect()->back();
    }

    public function inbox($job_id, Request $request)
    {
        $job = \App\Jobs::find($job_id);
        $user = $request->user();

        $users = \App\Message::select('sender_id','job_id')->where('job_id', $job_id)
            ->where('receiver_id', '=', $user->id)
            ->distinct('sender_id')->orderBy('updated_at', 'desc')->get();

        return view('inbox', compact(['job','users']));
    }
}
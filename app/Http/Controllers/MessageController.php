<?php

namespace App\Http\Controllers;

use App\Message;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MessageController extends Controller
{

    public function index($user_id, $job_id, Request $request)
    {
        $job = \App\Jobs::find($job_id);


        $user = $request->user();

        $messages = \App\Message::where('job_id', $job_id)->whereIn('user_id', [$user_id, $user->id])->orderBy('updated_at', 'desc')->get();
        return view('messages', compact(['job', 'messages']));
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
            'user_id' => 'required',
            'job_id' => 'required'
        ]);
        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $message = new \App\Message;
        $message->message = $request->message;
        $message->user_id = $request->user_id;
        $message->job_id = $request->job_id;
        $message->save();
        return redirect()->back();
    }
}

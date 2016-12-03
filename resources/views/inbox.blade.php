@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <a href="/jobs" class="btn btn-primary">All Jobs</a>
        </div>
        <div class="row">
            <h1>{{ $job->title }}</h1>
        </div>
        <div class="row">
            <h4>Conversation</h4>
            <ul>
                @foreach($users as $user)
                    <li><a href="/{{ $user->sender_id }}/{{ $user->job_id }}/messages"> {{ $user->sender->name }} </a></li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
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
            <h4>Add a new message</h4>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops! Something went wrong!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                {!! Form::open(['url' => '/messages/store']) !!}
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" placeholder="Message"></textarea>
                </div>
                @if(Auth::check())
                    <input type="hidden" value="{{Auth::user()->id}}" name="user_id" title="user_id"/>
                @endif
                <input type="hidden" value="{{ $job->id}}" name="job_id" title="job_id"/>

                <button type="submit" class="btn btn-default">Submit</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <ul>
                @if(count($messages) > 0 )
                    @foreach($messages as $message)
                        <li>       {{ date($message->updated_at) }} - <strong> {{ $message->user->name }} </strong>
                            - {{ $message->message }}</li>
                    @endforeach
                @else
                    <li>There are no messages</li>
                @endif
            </ul>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <a href="/jobs" class="btn btn-primary">All Jobs</a>
        </div>
        <div class="row">
            <h1>Add a new Job Title</h1>

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
                {!! Form::open(['route' => 'jobs.store']) !!}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Job Titlte">
                </div>

                @if(Auth::check())
                    <input type="hidden" value="{{Auth::user()->id}}" name="user_id" title="user_id" />
                @endif

                <button type="submit" class="btn btn-default">Submit</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
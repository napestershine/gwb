@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <a href="/jobs/create" class="btn btn-primary">Add New</a>
        </div>
        <div class="row">
            <h1>All Job Titles</h1>
            <table class="table">
                <tr>
                    <td>Sr. No</td>
                    <td>Title</td>
                    <td>User Name</td>
                    <td>Action</td>
                </tr>
                @foreach ($jobs as $job)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->user->name }}</td>
                        <td> @if(Auth::check())
                                @if($job->user_id === Auth::user()->id)
                                    <a href="#">Inbox</a>
                                @endif
                            @else
                                <a href="#">Contact</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
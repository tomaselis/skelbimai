@extends('layouts.app')

@section('content')
    @if(session()->has('message'))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible">
                    {{session()->get('message')}}
                </div>
            </div>
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Messages</div>

                    @foreach($messages as $message)
                        <div class="card-body">
                            <span class="border-bottom">
                            <a href="{{route('message.show', $message->id)}}">
                                {{$message->subject}}
                            </a>
                            </span>
                        </div>
                    @endforeach
                    <a class="btn btn-outline-dark"
                       href="{{route('messages.create')}}">
                        Sukurti
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

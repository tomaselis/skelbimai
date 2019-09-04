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

                    <div class="">
                        <div class="card-body">
                            <div class="card-header">
                            {{$message->subject}}
                            </div>
                        </div>
                        <div class="card-body">
                            {{$message->message}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                    <div class="card-header">Sukurkti zinute</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('messages.store')}}">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" name="subject" placeholder="Pavadinimas">
                            </div>
                            <div class="form-group">
                                <textarea  class="form-control" name="message" placeholder="Jusu zinutes tekstas"></textarea>
                            </div>
                            <div class="form-group">
                                <select name="recipient_id" class="form-control">
                                    <option>Pasirinkti gaveja</option>
                                    @foreach($recipients as $recipient)
                                        <option value="{{$recipient->id}}">{{$recipient->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="type" class="form-control">
                                    <option>Pasirinkti zinutes formata</option>
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}">{{$type->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-light">Siusti</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




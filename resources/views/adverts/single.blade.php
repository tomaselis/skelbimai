@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">{{$advert->title}}</div>

                    <div class="card-body">
                        {{$advert->content}}
                    </div>
{{--                    {{dd($advert->category)}}--}}
                    <div class="alert">Kategorija:{{$advert->category->title}}</div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="card-body col-md-8">

                <form method="post" action="{{route('comment.store')}}">
                    @csrf
                    <textarea class="form-control" name="content_text" type="text" placeholder="Čia galite palikti savo komentarą ..."></textarea>
                    <input type="hidden" value="{{$advert->id}}" name="advert_id">
                    <button class="btn btn-light">Komentuoti</button>
                </form>
            </div>
        </div>
    </div>
@endsection

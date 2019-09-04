@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$advert->title}}</div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9">
                                <img class="card-img" src="{{$advert->image}}">
                            </div>
                            <div class="col">
                                <div class="col mt-4 col-sm-10"><img class="card-img" src="{{$advert->image}}"></div>
                                <div class="col mt-4 col-sm-10"><img class="card-img" src="{{$advert->image}}"></div>
                                <div class="col mt-4 col-sm-10"><img class="card-img" src="{{$advert->image}}"></div>
                                <div class="col mt-4 col-sm-10"><img class="card-img" src="{{$advert->image}}"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!!$advert->content!!}
                    </div>
                    {{--                    {{dd($advert->category)}}--}}
                    <div class="alert">Kategorija:{{$advert->category->title}}</div>
                    <div class="card-footer">
                        <div class="d-inline mb-4">
                            <a class="btn btn-outline-dark" href="{{route('advert.edit', $advert->slug)}}">
                                Edit
                            </a>
                        </div>
                        <form class="d-inline mb-4" method="POST" action="{{route('advert.destroy', $advert->id)}}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-outline-dark">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @foreach($comments as $comment)
        <div class="row justify-content-center">
            <div class="card-body col-md-8">
                <div class="card-footer">
                        {{$comment->content}}
                </div>
            </div>
        </div>
        @endforeach
        <div class="row justify-content-center">
            <div class="card-body col-md-8">

                <form method="post" action="{{route('comment.store')}}">
                    @csrf
                    <textarea class="form-control mb-4" name="content_text" type="text"
                              placeholder="Čia galite palikti savo komentarą ..."></textarea>
                    <input type="hidden" value="{{$advert->id}}" name="advert_id">
                    <button class="btn btn-outline-dark btn-lg btn-block">Komentuoti</button>
                </form>
            </div>
        </div>
    </div>
@endsection

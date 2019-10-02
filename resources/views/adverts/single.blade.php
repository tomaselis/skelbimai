@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$advert->title}}</div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9 big-img mt-4">
                                <img class="card-img" src="{{$advert->image}}">
                            </div>
                            <div class="col">
                                <div class="small-image">
                                <img class="col mt-4 col-sm-10 small-image" src="{{$advert->image}}" style="cursor:pointer">
                                </div>
                                @foreach($advert->imageGalery as $image)
                                    <div class="small-image">
                                        <img class="col mt-4 col-sm-10 small-image" src="{{$image->image}}" style="cursor:pointer">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!!$advert->content!!}
                    </div>
                    {{--                    {{dd($advert->category)}}--}}
                    <div class="alert">Kategorija: {{$advert->category->title}}
                        @foreach($values as $value)
                                @if($value->attribute->attributeEnd !== null)
                            {{--                        {{dd($value->attribute->label)}}--}}
                            <div class="card-columns mt-4">&#9830; {{$value->attribute->label}}
                                : {{$value->value}} {{$value->attribute->attributeEnd->name}}</div>
                            @endif
                        @endforeach
                    </div>
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
<script>
    window.onload = function () {
        $('.small-image').click(function () {
            var img = $(this).children('img').attr('src');
            $('.big-img img').attr('src', img);
        });
    }
</script>


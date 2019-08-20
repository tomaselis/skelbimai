@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header" style="border-bottom-width: 0;">Nekilnojamo turto skelbimai</div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>
    <div class="container">
        <div class="row">
                @foreach($adverts as $advert)
                    <div class="col-sm-6 col-md-4 col-lg-3 mt-4 d-flex align-items-stretch">
                        <div class="card">
                            <img class="card-img-top" src="{{$advert->image}}" alt="{{$advert->slug}}" style="height: 15vw; object-fit: cover;" >
                            <div class="card-body">
                                <h5 class="card-title">{{$advert->title}}</h5>
                                {{--                                    <p class="card-text">{{$advert->content}}</p>--}}
                                <div class="card-columns">Kaina: {{$advert->price}} €</div>
                                <a href="http://194.5.157.92/skelbimai/public/advert/{{$advert->id}}"
                                   class="btn btn-primary" style="text-decoration: none">Daugiau info</a>
                                <div class="card-footer">
                                    <small class="text-muted">Pakeitimai atlikti: {{$advert->updated_at}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
@endsection

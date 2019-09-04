@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">

            <div class="card">
                <div class="card-header">{{$category->title}}</div>
                <div class="card-body">

                    @if($category->subCategories)
                        <div class="sub-categories-wrapper">
                            @foreach($category->subCategories as $subCategory)
                                <div class="col-lg-3">
                                    <a href="{{route('category.show',$subCategory->slug)}}">{{$subCategory->title}}</a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="container">
                        <div class="row">
                            @foreach($category->adverts as $advert)
                                <div class="col-sm-6 col-md-4 col-lg-3 mt-4 d-flex align-items-stretch">
                                    <div class="card">
                                        <img class="card-img-top" src="{{$advert->image}}" alt="{{$advert->slug}}"
                                             style="height: 15vw; object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4">{{$advert->title}}</h5>
                                            {{--                                    <p class="card-text">{{$advert->content}}</p>--}}
                                            <div class="card-columns mb-4">Kaina: {{$advert->price}} €</div>
                                            <a href="http://194.5.157.92/skelbimai/public/advert/{{$advert->slug}}"
                                               class="btn btn-outline-dark btn-lg btn-block mb-4" style="text-decoration: none">Daugiau info</a>
                                            <div class="card-footer">
                                                <small class="text-muted">Pakeitimai
                                                    atlikti: {{$advert->updated_at->diffForHumans()}}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

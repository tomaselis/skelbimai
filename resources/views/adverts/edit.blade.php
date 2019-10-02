@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Skelbimas kuri reikia pakeisti</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('advert.update', $advert->id)}}">
                            @csrf
                            @method('PUT')
                            <input class="form-control" name="title" value="{{$advert->title}}">
                            <textarea class="form-control" name="contentas">{{$advert->content}}</textarea>
                            <input class="form-control" type="text" name="image" value="{{$advert->image}}">
                            @foreach($advert->imageGalery as $image)
                                    <input class="form-control"  type="text" name="galleryImage_{{$image->id}}" value="{{$image->image}}">
                            @endforeach
                            <input class="form-control" type="number" name="price" value="{{$advert->price}}">

                            @foreach($attributes as $attribute)
                                @if($attribute->attributes !== null)
{{--                                {{dd($attribute->attributes->name)}}--}}
                                <input
                                        class="form-control"
                                        type="text"
                                        name="super_attributes_{{$attribute->attributes->name}}"
                                        placeholder="{{$attribute->attributes->label}}"
                                >
                                    @endif
                            @endforeach


                            <select name="category">
                                <option>Pasirinkti kategoriją</option>
                                @foreach($categories as $cat)
                                    @if($cat->id == $advert->category_id)
                                        <option selected value="{{$cat->id}}">{{$cat->title}}</option>
                                    @else
                                        <option value="{{$cat->id}}">{{$cat->title}}</option>
                                    @endif

                                @endforeach
                            </select>
                            <select name="city_id">
                                <option>Pasirinkti miestą</option>
                                @foreach($cities as $city)
                                    @if($city->id == $advert->city_id)
                                        <option selected value="{{$city->id}}">{{$city->name}}</option>
                                    @else
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <button class="btn btn-light">Pakeisti</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




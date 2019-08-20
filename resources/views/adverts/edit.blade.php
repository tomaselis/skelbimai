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
                            <input class="form-control" name="title"  value="{{$advert->title}}">
                            <textarea class="form-control" name="contentas">{{$advert->content}}</textarea>
                            <input class="form-control" type="text" name="image"  value="{{$advert->image}}">
                            <input class="form-control" type="number" name="price"  value="{{$advert->price}}">
                            <select name="category">
                                <option>Pasirinkti kategoriją</option>
                                @foreach($categories as $cat)
                                    <option value="{{$cat->id}}">{{$cat->title}}</option>
                                @endforeach
                            </select>

                            <select name="city">
                                <option>Pasirinkti miestą</option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
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




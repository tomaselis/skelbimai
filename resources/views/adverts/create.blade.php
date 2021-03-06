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
                    <div class="card-header">Sukurk savo skelbimą</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('advert.store')}}">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" id="title" name="title" placeholder="Pavadinimas">
                            </div>
                            <div class="form-group">
                                <textarea  id="summary-ckeditor" class="form-control" name="contentas" placeholder="Skelbimo apibūdinimas"></textarea>
                            </div>
                            <div class="form-group">
                                <input class="form-control"  type="text" name="image" placeholder="Pridekite nuoroda į nuotrauką Nr1">
                            </div>
                            <div class="form-group">
                                <input class="form-control"  type="text" name="galleryImage[]" placeholder="Pridekite nuoroda į nuotrauką Nr2">
                            </div>
                            <div class="form-group">
                                <input class="form-control"  type="text" name="galleryImage[]" placeholder="Pridekite nuoroda į nuotrauką Nr3">
                            </div>
                            <div class="form-group">
                                <input class="form-control"  type="text" name="galleryImage[]" placeholder="Pridekite nuoroda į nuotrauką Nr4">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="number" name="price" placeholder="Kaina">
                            </div>
                            <div class="form-group">
                                <select name="category_id" class="form-control">
                                    <option>Pasirinkti kategorija</option>
                                    @foreach($categories as $cat)
                                        <option value="{{$cat->id}}">{{$cat->title}}</option>
                                    @endforeach
                                </select>
                                <select name="attribute_id" class="form-control mt-2" required>
                                    <option class="form-control">Atributai</option>
                                    @foreach($attribute_set as $set)
                                        <option value="{{ $set->id }}">{{$set->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="city_id" class="form-control">
                                    <option>Pasirinkti miestą</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-light">Sukurti</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

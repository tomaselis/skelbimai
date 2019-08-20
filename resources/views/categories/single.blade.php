@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ $category->title }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach($category->subCategories as $cat)
                            <a class="dropdown-item" href="#">{{$cat->title}}</a>
                            @foreach($cat->subCategories as $subCat)
                                <a style="padding-left: 20px" class="dropdown-item" href="#">{{$subCat->title}}</a>
                            @endforeach
                        @endforeach
                    </div>
                </li>

            </ul>

        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$category->title}}</div>
                    <div class="card-body">

                        @foreach($category->adverts as $advert)
                            <div class="col-3">
                                <h2 class="card-subtitle">{{$advert->title}}</h2>
                                <div class="text-center">{{$advert->content}}</div>
                            </div>

                        @endforeach

                        <a href="{{ url('/category', ['id' => $category->id])}}">
                            <button class="btn btn-light">
                                Edit
                            </button>
                        </a>
                        <a href="{{ url('/category', ['id' => $category->id]) }}/edit" class="btn-light">
                            Edit
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Kategorija</div>

                    <div class="card-body">


                        <form method="POST" action="{{route('category.update', $category->id)}}">
                            @csrf
                            @method('PUT')
                            <input class="form-control" name="title" value="{{$category->title}}">
                            <select name="parent_id">
                                <option value="0">-----</option>
                                @foreach($categories as $cat)
                                    <option value="{{$cat->id}}">{{$cat->title}}</option>
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




@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Skelbimu Kategorijos</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('category.store') }}">
                            @csrf
                            <input class="form-control" type="text" name="title" placeholder="Pavadinimas">

                            <select class="form-control"  name="parent_id">
                                <option value="0">-----</option>
                                @foreach($categories as $cat)
                                    <option value="{{$cat->id}}">{{$cat->title}}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-light">Pridėti</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



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
                    <div class="card-header">Skelbimu Kategorijos</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('category.store') }}">
                            @csrf
                            <input class="form-control mb-4" type="text" name="title" placeholder="Pavadinimas">

                            <select class="form-control mb-4"  name="parent_id">
                                <option value="0">-----</option>
                                @foreach($categories as $cat)
                                    <option value="{{$cat->id}}">{{$cat->title}}</option>
                                @endforeach
                            </select>
                            <div class="card-footer">
                                <button class="btn btn-outline-dark">Pridėti</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



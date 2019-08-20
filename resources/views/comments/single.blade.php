@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$category->title}}</div>

                    <div class="card-body">
                        <a href="{{ url('/category', ['id' => $category->id])}}">
                            <button class="btn btn-light">
                                Edit
                            </button>
                        </a>
                        <a href="{{ url('/categories', ['id' => $category->id]) }}">
                            <button class="btn btn-light">
                                Delete
                            </button>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<?php

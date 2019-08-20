@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$city->name}}</div>

                    <div class="card-body">
                        <a href="{{ url('/city', ['id' => $city->id])}}">
                            <button class="btn btn-light">
                                Edit
                            </button>
                        </a>
                        <a href="{{ url('/city', ['id' => $city->id]) }}/edit" class="btn-light">
                            Edit
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

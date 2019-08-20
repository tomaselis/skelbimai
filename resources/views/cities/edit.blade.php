@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Miestas</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('city.update', $city->id)}}">
                            @csrf
                            @method('PUT')
                            <input class="form-control" name="title" value="{{$city->name}}">
                            <select name="parent_id">
                                <option value="0">-----</option>
                            </select>
                            <button class="btn btn-light">Pakeisti</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




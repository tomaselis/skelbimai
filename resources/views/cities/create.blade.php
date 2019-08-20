@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Miestai</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('city.store')}}">
                            @csrf
                            <input class="form-control" name="title" placeholder="Pavadinimas">

                            <button class="btn btn-light">prideti</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


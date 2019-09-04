@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

                @foreach($categories->where('parent_id', 0) as $category)
                <div class="col-6 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-outline-dark btn-lg btn-block"
                               href="{{route('adverts.nt')}}">{{$category->title}}</a>
                        </div>
                        <div class="card-body">
                            @foreach($category->subCategories as $subCategory)
                                <a class="btn btn-outline-dark btn-lg btn-block"
                                   href="{{route('category.show',$subCategory->slug)}}">{{$subCategory->title}}</a>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <div class="d-inline">
                                <a class="btn btn-outline-dark"
                                   href="{{route('category.edit', $category->id)}}">
                                    Edit
                                </a>
                            </div>
                            <form class="d-inline" method="POST"
                                  action="{{route('category.destroy', $category->id)}}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-outline-dark">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach

        </div>
    </div>
@endsection




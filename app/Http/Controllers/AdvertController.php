<?php

namespace App\Http\Controllers;

use App\Advert;
use App\Category;
use App\City;
use App\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function nt()
    {
        $adverts = Advert::all();
        $data['adverts'] = $adverts;
        return view('adverts.nt', $data);
    }


    public function index()

    {
        $data['adverts'] = Advert::active()->paginate(6);
        return view('adverts.all', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if ($user && ($user->hasRole('admin') || $user->hasRole('client'))) {
            $categories = Category::where('active', '=', 1)->get();
            $data['categories'] = $categories;
            $cities = City::where('active', '=', 1)->get();
            $data['cities'] = $cities;
            return view('adverts.create', $data);
        } else {
            return view('welcome');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $advert = new Advert();
        $advert->title = $request->title;
        $advert->content = $request->contentas;
        $advert->image = $request->image;
        $advert->price = $request->price;
        $advert->user_id = $user->id;
        $advert->city_id = 1;
        $advert->slug= Str::slug($request->title, '-');
        $advert->active = 1;
        $advert->category_id = $request->category_id;
        $advert->save();
        return redirect()->back()->with('message', 'Jūsų sklebimas sėkmingai sukurtas');;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Advert $advert)
    {
        $data['advert'] = $advert;
        $data['comments'] = Comments::where('advert_id', $advert->id)->get();
//        dd($data['comments']);
        return view('adverts.single', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $advert = Advert::where('slug', $id)->first();
//        dd($advert);
        if ($user && $user->hasRole('admin|editor|moderator')){
//            || ($user->hasRole('client') && $user->id == $advert->user_id))
        $categories = Category::all();
        $data['advert'] = $advert;
        $cities = City::all();
        $data['categories'] = $categories;
        $data['cities'] = $cities;
        return view('adverts.edit', $data);
        return view('adverts.create', $data);
    } else {
            return view('welcome');
        }
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $advert = Advert::find($id);
        $advert->title = $request->title;
        $advert->content = $request->contentas;
        $advert->image = $request->image;
        $advert->price = $request->price;
        $advert->user_id = 1;
        $advert->city_id = 1;
        $advert->slug= Str::slug($request->title, '-');
        $advert->active = 1;
        $advert->category_id = $request->category;
        $advert->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $advert = Advert::find($id);

        $advert-> active = 0;
        $advert ->save();
    }
}

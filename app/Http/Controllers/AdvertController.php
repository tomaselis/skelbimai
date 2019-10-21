<?php

namespace App\Http\Controllers;

use App\Advert;
use App\AttributeSet;
use App\AttributeValues;
use App\Attributes;
use App\Category;
use App\City;
use App\Comments;
use App\ImageGalery;
use App\Mail\NewAdvert;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PHPUnit\Framework\Constraint\Attribute;


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
        $data['adverts'] = Advert::active()->paginate(4);
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
            $attribute_set = AttributeSet::all();
            $data['attribute_set'] = $attribute_set;
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $advert = new Advert();
        $advert->expiration_date = Carbon::now()->add(7, 'day');
        $advert->title = $request->title;
        $advert->content = $request->contentas;
        $advert->image = $request->image;
        $advert->price = $request->price;
        $advert->user_id = $user->id;
        $advert->attribute_set_id = $request->attribute_id;
        $advert->city_id = $request->city_id;
        $advert->slug = Str::slug($request->title, '-');
        $advert->active = 1;
        $advert->category_id = $request->category_id;
        $advert->save();

        foreach ($request->galleryImage as $image) {

            if ($image != '') {
                $imageObj = new ImageGalery();
                //priskiri
                $imageObj->image = $image;
                //seivini
                $imageObj->advert_id = $advert->id;
                $imageObj->active = 1;
                $imageObj->save();
            }
        }
        $data = [
            'name' => $user->name
        ];
        Mail::to($user->email)->send(new NewAdvert($data));
        return redirect()->route('advert.edit', $advert->slug)->with('message', 'Papildykite savo skelbimą atributais');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function show(Advert $advert)
    {
        $data['advert'] = $advert;
        $data['values'] = AttributeValues::where('advert_id', $advert->id)->get();
        $data['attributes'] = $advert->attributeSet->relations;
        $data['comments'] = Comments::where('advert_id', $advert->id)->get();
//        dd($data['values']);
        return view('adverts.single', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $advert = Advert::where('slug', $id)->first();
//        dd($advert);
        if ($user && $user->hasRole('admin|editor|moderator')) {
//            || ($user->hasRole('client') && $user->id == $advert->user_id))

            $attribute_set = AttributeSet::all();
            $data['attributes'] = $advert->attributeSet->relations;
            $data['values'] = AttributeValues::where('advert_id', $advert->id)->get();
            $data['advert'] = $advert;
            $data['categories'] = Category::all();
            $data['cities'] = City::all();
            $data['attribute_set'] = $attribute_set;

            return view('adverts.edit', $data);
//            return redirect()->route('advert.index')->with('message', 'Jūsų skelbimas įdėtas');
//            return view('adverts.create', $data);





        } else {
            return view('welcome');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        $attributes = [];
        foreach ($data as $key => $single) {
            if (strpos($key, 'super_attributes_') !== false) {
                $attributeName = str_replace('super_attributes_', '', $key);
                $attributes[$attributeName] = $single;
            }
        }
        foreach ($attributes as $name => $value) {
            $attributeObject = Attributes::where('name', $name)->first();
            $oldValue = AttributeValues::where('attribute_id', $attributeObject->id)
                ->where('advert_id', $id)->first();
            if (!is_null($value)) {
                if ($oldValue === null) {
                    $newValue = new AttributeValues();
                    $newValue->attribute_id = $attributeObject->id;
                    $newValue->advert_id = $id;
                    $newValue->value = $value;
                    $newValue->save();
                } else {
                    $oldValue->value = $value;
                    $oldValue->save();
                }
            }
        }


        //updatina images i duomenu baze

        $keysOfRequest = $request->keys();
        foreach ($keysOfRequest as $key) {
            if (strpos($key, 'galleryImage_') !== false) {
                $imageId = str_replace('galleryImage_', '', $key);
                $imageObj = ImageGalery::find($imageId);
                $imageObj->image = $request->$key;
                $imageObj->save();
            }
        }

        //uzkrauna tuscius langelius
        if (isset($request->galleryImage)) {
            foreach ($request->galleryImage as $image) {

                if ($image != '') {
                    $imageObj = new ImageGalery();
                    //priskiri
                    $imageObj->image = $image;
                    //seivini
                    $imageObj->advert_id = $imageObj->id;
                    $imageObj->active = 1;
                    $imageObj->save();
                }
            }
        }

        //Uzkrauna i duomenu baze
        $advert = Advert::find($id);
        $advert->title = $request->title;
        $advert->content = $request->contentas;
        $advert->image = $request->image;
        $advert->price = $request->price;
        $advert->user_id = Auth::id();
        $advert->city_id = $request->city_id;
        $advert->slug = Str::slug($request->title, '-');
        $advert->active = 1;
        $advert->category_id = $request->category;
        $advert->save();
        return redirect()->route('advert.show', $advert->slug)->with('message', 'Skelbimo pakeitimai atlikti');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $advert = Advert::find($id);
        $advert->active = 0;
        $advert->save();
        $user = Auth::user();
        if ($user && ($user->hasRole('admin'))) {
            return redirect()->action('AdminController@index');
        } else {
            return redirect()->action('HomeController@index');
        }
    }
}

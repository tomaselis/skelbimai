<?php

namespace App\Http\Controllers;

use App\Advert;
use App\AttributeValues;
use App\Comments;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->search;
        $advert = Advert::where('title', 'LIKE', "%{$keyword}%")
            ->orwhere('content', 'LIKE', "%{$keyword}%")->active()->paginate(6);
        $data['adverts'] = $advert;
        return view('adverts.search', $data);

    }
}

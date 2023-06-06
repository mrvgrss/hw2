<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Favourite;
use Session;

class FavouriteController extends BaseController
{
    public function favourite_list(){

        $response = [
            'status' => 'error',
            'data' => null
        ];

        if(!Session::has('user_id')){
            return response()->json($response);
        }

        $id = Session::get('user_id');

        $favourites = Favourite::select('city')
            ->where('FAVOURITE.userId', $id)
            ->get();

        if ($favourites->count() > 0) {
            $response['status'] = 'completed';
            $response['data'] = $favourites->pluck('city')->toArray();
        }

        return response()->json($response);

    }
}
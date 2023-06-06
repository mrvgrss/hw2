<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Request;
use Session;
use App\Models\User;
use App\Models\Review;
use stdClass;

class ProfileController extends BaseController{
    public function profile(){
        if(!Session::has('user_id')){
            return redirect('home');
        }
        $userId = Session::get('user_id');
        $user = User::find($userId);
        $review = Review::where('userId', $userId)->first();
        $info = new stdClass();
        $info->name = $user->name;
        $info->surname = $user->surname;
        $info->email = $user->email;
        $info->title = "";
        $info->details = "";
        $info->stars = 5;
        $info->button = "Scrivi";
        if ($review) {
            $info->title = $review->title;
            $info->details = $review->details;
            $info->stars = $review->stars;
            $info->button = "Aggiorna";
        }
        return view('profile')->with('info', $info);
    }
}
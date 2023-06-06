<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Review;
use Session;
use Request;
class ReviewController extends BaseController
{
    public function reviews_list($max = 5){
        if (!$max) {
            return response()->json(['status' => 'error', 'message' => 'Missing parameter'], 400);
        }

        $reviews = Review::select('title', 'REVIEWS.created_at', 'name', 'surname', 'stars', 'details')
            ->join('USERS', 'REVIEWS.userId', '=', 'USERS.id')
            ->orderBy('REVIEWS.created_at', 'DESC')
            ->limit($max)
            ->get();

        if ($reviews->count() > 0) {
            return response()->json(['status' => 'completed', 'data' => $reviews]);
        }

        return response()->json(['status' => 'noresult']);
    }
    public function createUpdateReview(){
        if(!Session::has('user_id')){
            return ["status" => "error"];
        }
        if(!empty(Request::get('title')) && !empty(Request::get('details')) && !empty(Request::get('stars'))){
            $title = Request::get('title');
            $details = Request::get('details');
            $stars = Request::get('stars');

            $userId =  Session::get('user_id'); 
           
            $review = Review::where('userId', $userId)->first();
            if($review){
                $review->title = $title;
                $review->details = $details;
                $review->stars = $stars;
                $review->save();
            }else{
                $review = new Review();
                $review->title = $title;
                $review->details = $details;
                $review->stars = $stars;
                $review->userId = $userId;
                $review->save();
            }
            return redirect('profile');
        }else{
           return ["status" => "error"]; 
        }
    }
}

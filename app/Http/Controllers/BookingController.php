<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\FlightOffer;
use App\Models\Flight;
use App\Models\Segment;
use App\Models\Airport;
use Carbon\Carbon; // https://carbon.nesbot.com/docs/

use Session;

use App\Services\SkyPickerService;
use App\Services\AmadeusService;


class BookingController extends BaseController
{
    private function checkCachedOffers($origin, $destination, $departureDate, $returnDate, $adults){
        $offers = array();
        $flightOffers = FlightOffer::whereNull('bookedUserId')
            ->where('destination', $destination)
            ->where('origin', $origin)
            ->where('adults', $adults)
            ->where('departureDate', '>=', $departureDate)
            ->where('last_ticketing_datetime', '>=', date('Y-m-d'))
            ->orderByRaw("DATEDIFF(departureDate, '{$departureDate}') ASC")
            ->limit(5)
            ->get();
    
        foreach($flightOffers as $flightOffer){
            // change from hw1 not more "info" element
            $offer = $flightOffer->toArray();
            $offer["flights"] = [];
            $flights = Flight::where('offertId', $flightOffer->id)->get();
    
            foreach($flights as $flight){
                $flightData = $flight->toArray();
                $flightData['segments'] = [];
                $segments = Segment::where('offertId', $flightOffer->id)
                    ->where('outbound', $flight->outbound)
                    ->get();
    
                foreach($segments as $segment){
                    $flightData["segments"][] = $segment->toArray();
                }
    
                $offer["flights"][] = $flightData;
            }
    
            $offers[] = $offer;
        }
    
        return $offers;
        
    }
    private function checkCode($term){
        $code = null;
        $airport = Airport::where('city', $term)->orWhere('iata', $term)->orWhere('term', $term)->first();
        if ($airport) 
            return $airport->iata;
        $data = SkyPickerService::getInfoByTermJSON($term);
        $code = SkyPickerService::getIATACode($data);

        $airport = Airport::where('iata', $code)->first();

        if ($airport) {
            return $code;
        }
    
        $city = SkyPickerService::getCityName($data);
        $country = SkyPickerService::getCountryName($data);
        $airport = Airport::create(
            [
                'iata' => $code,
                'city' => $city,
                'term' => $term,
                'country' => $country,
            ]
        );
        $airport->save();
        
        return $code;
    }
    private function addOffers($offers){
        foreach ($offers as $key => $value) {
            $flightOffer = FlightOffer::create($value['info']);
            $id = $flightOffer->id;
    
            foreach ($value['flights'] as $key1 => $value1) {
                $flight = new Flight();
                $flight->offertId = $id;
                $flight->outbound = $key1;
                $flight->duration = $value1['duration'];
                $flight->save();
    
                foreach ($value1['segments'] as $key2 => $value2) {
                    $segment = new Segment();
                    $segment->offertId = $id;
                    $segment->outbound = $key1;
                    $segment->segment_n = $key2;
                    $segment->duration = $value2['duration'];
                    $segment->departure_airport = $value2['departure_airport'];
                    $segment->departure_terminal = isset($value2['departure_terminal']) ? $value2['departure_terminal'] : 0;
                    $segment->departure_datetime = $value2['departure_datetime'];
                    $segment->arrival_airport = $value2['arrival_airport'];
                    $segment->arrival_datetime = $value2['arrival_datetime'];
                    $segment->company_name = $value2['company_name'];
                    $segment->aircraft = $value2['aircraft'];
                    $segment->save();
                }
            }
        }
    }
    public function searchFlight($origin, $destination, $departureDate, $returnDate, $adults){
        if (empty($origin) || empty($destination)) {
            return 'missing parameter error';
        }

        $origin_code = $this->checkCode($origin);
        $destination_code = $this->checkCode($destination);

        if (empty($departureDate)) {
            $departureDate = Carbon::now()->format('Y-m-d');
        }

        if (empty($returnDate) || $returnDate < $departureDate) {
            $returnDate = Carbon::parse($departureDate)->addDays(2)->format('Y-m-d');
        }

        if (empty($adults) || $adults > 5) {
            $adults = 1;
        }

        $offers = $this->checkCachedOffers($origin_code, $destination_code, $departureDate, $returnDate, $adults);
        if (empty($offers)) {
            $tokenInfo = AmadeusService::getToken();
            $flightOffersJSON = AmadeusService::getFlightOffers($tokenInfo[0], $tokenInfo[1], $origin_code, $destination_code, $departureDate, $returnDate, $adults, 5);
            if (isset($flightOffersJSON["data"]) && count($flightOffersJSON["data"]) > 0) {
                $extracted = AmadeusService::extractOffers($flightOffersJSON);
                $this->addOffers($extracted);
                $offers = $this->checkCachedOffers($origin_code, $destination_code, $departureDate, $returnDate, $adults);
            }
        }

        return response()->json($offers);
    }
    public function bookFlight($offerId){
        if(!Session::has('user_id')){
            return redirect('home');
        }
        if (empty($offerId)) {
            return redirect('home');
        }

        $offer = FlightOffer::find($offerId);

        if(!$offer){
            return redirect('home');
        }

        if($offer->bookedUserId == null && $offer->last_ticketing_datetime >= now()){
            $offer->bookedUserId = Session::get('user_id');
            $offer->save();
            return ["status" => "completed"];
        }

        return ["status" => "failed"];
    }
    public function preBookFlight($offerId){
        if(!Session::has('user_id')){
            return redirect('home');
        }
        if (empty($offerId)) {
            return redirect('home');
        }

        $offer = FlightOffer::find($offerId);

        if(!$offer){
            return redirect('home');
        }

        if($offer->bookedUserId == null && $offer->last_ticketing_datetime >= now()){
            return view('prebookflight')->with('offer', $offer);
        }

        return redirect('home');
    }
    public function myBookings(){
        if(!Session::has('user_id')){
            return redirect('home');
        }
        return view('mybookings');
    }
    public function listBookings(){
        if(!Session::has('user_id')){
            return redirect('home');
        }
        $userId = Session::get('user_id');
        $data = FlightOffer::where('bookedUserId', $userId)->get();
        if($data->count() > 0){
            return ["data" => $data, "status" => "completed"];
        }
        return ["data" => null, "status" => "error"];
    }
}
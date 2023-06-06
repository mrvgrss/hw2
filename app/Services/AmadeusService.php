<?php

namespace App\Services;

use App\Constants\AmadeusConstants;

class AmadeusService
{
    public static function getToken()
    {
        $url = AmadeusConstants::ENDPOINT . "/v1/security/oauth2/token";
        $data = [
            'grant_type' => 'client_credentials',
            'client_id' => AmadeusConstants::PUBLIC_KEY,
            'client_secret' => AmadeusConstants::PRIVATE_KEY
        ];
        $postfields = http_build_query($data);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($curl, CURLOPT_HTTPHEADER, AmadeusConstants::HEADERS);
    
        $response = curl_exec($curl);
        $result = json_decode($response);
    
        curl_close($curl);

    
        return [$result->access_token, $result->token_type];
    }
    public static function getFlightOffers($accessToken, $tokenType, $originLocationCode = "ROM", $destinationLocationCode = "MEX", $departureDate = "2023-07-19", $returnDate = "2023-07-29", $adults  = 1, $max = 5){
        $data = http_build_query([
            "originLocationCode" => $originLocationCode,
            "destinationLocationCode" => $destinationLocationCode,
            "departureDate" => $departureDate,
            "returnDate" => $returnDate,
            "adults" => $adults,
            "max" => $max
        ]);
        $url = AmadeusConstants::ENDPOINT . "/v2/shopping/flight-offers?" . $data;
    
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $authHeader = ["Authorization: {$tokenType} {$accessToken}"];
        curl_setopt($curl, CURLOPT_HTTPHEADER, array_merge(AmadeusConstants::HEADERS, $authHeader));
    
        $response = curl_exec($curl);
        $result = json_decode($response, true);
        curl_close($curl);
        return $result;  
    }
    public static function extractOffers($dataJSON){
        $offers = [];
        $dictionary = $dataJSON["dictionaries"];
        foreach ($dataJSON["data"] as $key => $value) {
            $offer = [];
            $offer["info"]["source_offer"] = $value["source"];
            $offer["info"]["oneway"] = $value["oneWay"];
            $offer["info"]["last_ticketing_datetime"] = $value["lastTicketingDateTime"];
            $offer["info"]["price"] = $value["price"]["total"];
            $offer["info"]["base_price"] = $value["price"]["base"];
            $offer["info"]["generated"] = time();
            $offer["info"]["origin"] = $value["itineraries"][0]["segments"][0]["departure"]["iataCode"];
            $offer["info"]["destination"] = $value["itineraries"][0]["segments"][count($value["itineraries"][0]["segments"]) - 1]["arrival"]["iataCode"];
            $offer["info"]["departureDate"] = $value["itineraries"][0]["segments"][0]["departure"]["at"];
            $offer["info"]["returnDate"] = $value["itineraries"][1]["segments"][count($value["itineraries"][0]["segments"]) - 1]["arrival"]["at"];
            $offer["info"]["adults"] = count($value["travelerPricings"]);
    
            foreach ($value["itineraries"] as $key1 => $value1) {
                $offer["flights"][$key1]["duration"] = $value1["duration"];
    
                foreach ($value1["segments"] as $key2 => $value2) {
                    $offer["flights"][$key1]["segments"][$key2] = [
                        "segment_n" => $key2,
                        "duration" => $value2["duration"],
                        "departure_airport" => $value2["departure"]["iataCode"],
                        "departure_terminal" => isset($value2["departure"]["terminal"]) ? $value2["departure"]["terminal"] : 0,
                        "departure_datetime" => $value2["departure"]["at"],
                        "arrival_airport" => $value2["arrival"]["iataCode"],
                        "arrival_datetime" => $value2["arrival"]["at"],
                        "company_name" => $dictionary["carriers"][$value2["carrierCode"]],
                        "aircraft" => $dictionary["aircraft"][$value2["aircraft"]["code"]],
                    ];
                }
            }
    
            $offers[$key] = $offer;
        }
    
        //print_r($dataJSON);

        return $offers;
    }
}
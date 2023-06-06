<?php

namespace App\Services;

use App\Constants\SkyPickerConstants;

class SkyPickerService
{
    public static function getInfoByTermJSON($term)
    {
        $data = http_build_query([
            "term" => $term,
            "location_types" => "airport",
            "active_only" => "true",
            "limit" => 1,
        ]);

        $url = SkyPickerConstants::ENDPOINT . "/locations?" . $data;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, SkyPickerConstants::HEADERS);

        $response = curl_exec($curl);
        $result = json_decode($response, true);

        curl_close($curl);

        return $result;
    }

    public static function getIATACode($response)
    {
        if ($response["results_retrieved"] == 0) {
            return "MEX";
        }

        return $response["locations"][0]["code"];
    }

    public static function getCityName($response)
    {
        if ($response["results_retrieved"] == 0) {
            return "Mexico City";
        }

        return $response["locations"][0]["city"]["name"];
    }

    public static function getCountryName($response)
    {
        if ($response["results_retrieved"] == 0) {
            return "Mexico";
        }

        return $response["locations"][0]["city"]["country"]["name"];
    }
}
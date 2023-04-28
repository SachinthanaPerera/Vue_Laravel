<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationFindController extends Controller
{
    public function find_location(Request $request)
    {
        // IP address
        // $userIP = '162.222.198.75';
// $userIP = $_SERVER['REMOTE_ADDR'];

// API end URL
        $apiURL = 'https://freegeoip.app/json/' . $request->ip;
        $ipData = json_decode(file_get_contents($apiURL), true);

        if (!empty($ipData)) {
            return response()->json([
                'location' => $ipData,
            ], 200);
        } else {
            return response()->json([
                'erroe' => 'IP data is not found!',
            ], 400);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\FixerResponse;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class FixerAPIController extends Controller
{
    /**
     * Get all the responses from the fixer_response database table
     *
     * @return array
     *
     */
    public function getConversionHistory()
    {
        $responses = FixerResponse::orderBy('date', 'desc')->get();

        return response()->json([
            'responses' => $responses
        ]);
    }


    /**
     * Check if the birthday already has a record in the database and if not make an API request. Return an array to be consumed.
     *
     * @param $birthday
     * @return array
     *
     */
    public function getBirthdayRates(Request $request)
    {

        if($request->get('birthday') == null){
            return response()->json([
                'message' => 'No Date Selected',
            ], 418);
        }

        $birthday = $request->get('birthday');

        $response = $this->fixer_api->request('GET', $birthday);

        $results = json_decode($response->getBody());

        $fixer_response = new FixerResponse();

        $rates = $fixer_response->create([
            'date' => $birthday,
            'base' => $results->base,
            'rates' => json_encode($results->rates),
        ]);

        return response()->json(
            $results
        , 200);
    }
}

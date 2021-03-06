<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\FixerResponse;
use Illuminate\Support\Facades\Config;

class FixerController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responses = FixerResponse::orderBy('date', 'desc')->get();
        return view('index',[
            'responses' => $responses,
            'rates' => []
        ]);
    }

    /**
     * Get all the responses from the fixer_response database table
     *
     * @return array
     *
     */
    public function getConversionHistory(Request $request)
    {
        $responses = FixerResponse::orderBy('date', 'desc')->get();

        if($request->ajax()) {
            return view('partials.conversion_history', [
                'responses' => $responses
            ]);
        } else {
            return view('conversion_history', [
                'responses' => $responses
            ]);
        }

    }


        /**
     * Check if the birthday already has a record in the database and if not make an API request. Return an array to be consumed.
     *
     * @param $birthday
     * @return array
     *
     */
    public function getBirthdayRates(Request $request, $birthday)
    {

        if(!isset($birthday)){
            return abort(500);
        }

        // First of all, convert the $birthday variable into Carbon
        $birthday = Carbon::createFromFormat('Y-m-d', $birthday);

        if($birthday->gt(Carbon::yesterday()) || $birthday->lt(Carbon::today()->subYear())){
            $this->fixer_api->handle_error(500);
        }

        // Check if there is already a record in the database with that date
        $rates = FixerResponse::where('date', '=', $birthday->format('Y-m-d'))->first();

        if($rates){
            $rates->update([
               'request_count' => $rates->request_count + 1
            ]);
        } else {

            $response = $this->fixer_api->request('GET', $birthday->format('Y-m-d'));

            $fixer_response = new FixerResponse();

            $rates = $fixer_response->create([
                'date' => $birthday->format('Y-m-d'),
                'base' => $response->base,
                'rates' => json_encode($response->rates),
            ]);

        }

        if($request->ajax()) {
            return view('partials.birthday_rates', [
                'rates' => $rates
            ]);
        } else {
            return view('birthday_rates', [
                'date' => $birthday->format('jS F Y'),
                'rates' => $rates
            ]);
        }
    }

}

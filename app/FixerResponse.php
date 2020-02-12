<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FixerResponse extends Model
{


    protected $table = 'fixer_responses';

    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'date',
        'base',
        'rates',
        'request_count'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'date'
    ];

    /**
     * returns a the inverse rate ie: how many of the base you get for one of the rate
     *
     * @param  string  $value
     * @return string
     */
    public function getBaseRatesAttribute($value)
    {
        $rates = json_decode($value);

        $base_rates = [];

        foreach($rates as $key => $rate){
            $base_rates[$key] = round((1 / $rate) , 6);
        }

        return $base_rates;
    }

}

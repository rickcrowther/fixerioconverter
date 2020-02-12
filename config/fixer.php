<?php
return [

/*
|--------------------------------------------------------------------------
| fixer.io API
|--------------------------------------------------------------------------
|
| This is the API endpoint info for fixer.io
|
*/
    'base_uri' => env('FIXER_IO_BASE_URI', 'http://data.fixer.io/api/'),
    'access_key' => env('FIXER_IO_API_KEY', 'ff0c346bc1c16c659ce0370b7a54c52e'),
    'symbols' => env('FIXER_IO_SYMBOLS', 'GBP, USD'),
];

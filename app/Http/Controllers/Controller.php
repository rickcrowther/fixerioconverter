<?php

namespace App\Http\Controllers;

use App\FixerApi;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $fixer_api;

    /**
     * Controller constructor.
     * @param Request $request
     * @param null $resource_route_suffix
     */
    public function __construct(Request $request)
    {
        $this->fixer_api = new FixerApi();

    }
}

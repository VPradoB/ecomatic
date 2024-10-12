<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Configuration;
use App\Http\Controllers\Api\MachineController;
use App\Http\Requests;
use App\Product;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Machine;
use Illuminate\Support\Facades\DB;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request|null $request
     * @return Response
     */
    public function index()
    {
        $configNumber = count(Configuration::all());
        $salesNumber = Sale::whereDate('created_at','>=',(new Carbon('first day of this month')))->sum('quantity');
        $machines = Machine::all();
        return view('home',compact('machines','configNumber','salesNumber'));
    }
}
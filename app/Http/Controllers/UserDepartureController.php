<?php

namespace App\Http\Controllers;

use App\Models\Departure;
use App\Models\Ship;
use Illuminate\Http\Request;

class UserDepartureController extends Controller
{
    public function index()
    {
        $ships = Ship::all();
        $departure = Departure::where('status', '!=', 'Selesai')->get();
        return view('usrDeparture', compact('ships', 'departure'));
    }
}

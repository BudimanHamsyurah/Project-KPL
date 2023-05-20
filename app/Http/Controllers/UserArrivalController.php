<?php

namespace App\Http\Controllers;

use App\Models\Arrival;
use App\Models\Ship;
use Illuminate\Http\Request;

class UserArrivalController extends Controller
{
    public function index()
    {
        $ships = Ship::all();
        $arrival = Arrival::where('status', '!=', 'Selesai')->get();
        return view('welcome', compact('ships', 'arrival'));
    }

}

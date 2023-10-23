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

    public function updateData(Request $request)
{
    // Retrieve data from the request
    $id = $request->input('id');
    $newData = 'Bersandar';

    // Perform the update operation (for example, using Eloquent)
    Arrival::where('id', $id)->update(['status' => $newData]);

    // Return a response
    return redirect()->back();
}

}

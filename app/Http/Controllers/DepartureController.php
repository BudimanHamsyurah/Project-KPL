<?php

namespace App\Http\Controllers;

use App\Models\Departure;
use App\Models\Ship;
use Illuminate\Http\Request;

class DepartureController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ships = Ship::all();
        $departure = Departure::where('status', '!=', 'Selesai')->get();
        return view('admDeparture', compact('ships', 'departure'));
    }

    public function add_departure(Request $request)
    {

        $request->validate([
            'schedule' => ['required', 'date',],
            'jam' => ['required',],
            'from' => ['required', 'string', 'alpha', 'min:3', 'max:50',],
            'destination' => ['required', 'string', 'alpha', 'min:3', 'max:50',],
        ]

        );
        Departure::create([
            'id_ship' => $request['nama_kapal'],
            'schedule' => $request['schedule'],
            'jam' => $request['jam'],
            'from' => $request['from'],
            'destination' => $request['destination'],
            'status' => 'Estimasi'
        ]);
        return redirect()->back()->with('success','Data Telah Ditambahkan');
    }

    public function edit_departure(Request $request, $id)
    {
        $request->validate([
            'schedule' => ['required', 'date',],
            'jam' => ['required',],
        ]
        );
        Departure::findOrFail($id)->update([
            'schedule' => $request['schedule'],
            'jam' => $request['jam'],
            'status' => $request['status']
        ]);
        return redirect()->back()->with('success','Data Telah Diupdate');
    }

    public function process_departure(Request $request, $id)
    {

        Departure::findOrFail($id)->update([
            'status' => 'Berangkat'
        ]);
        return redirect()->back()->with('success','Kapal Sedang Di Proses');
    }
    public function finish_departure(Request $request, $id)
    {

        Departure::findOrFail($id)->update([
            'status' => 'Selesai'
        ]);
        return redirect()->back()->with('success','Kapal Telah Selesai Di Proses');
    }

    public function destroy($id){
        Departure::findOrFail($id)->delete();
        return redirect()->back()->with('success','Data Berhasil Dihapus');
    } 
}
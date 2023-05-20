<?php

namespace App\Http\Controllers;

use App\Models\Arrival;
use App\Models\Ship;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ships = Ship::all();
        $arrival = Arrival::where('status', '!=', 'Selesai')->get();
        return view('home', compact('ships', 'arrival'));
    }

 
    public function addKapal(Request $request)
    {
        $data = $request->all();
        $fileName = time().$request->file('logo_kapal')->getClientOriginalName();
        $path = $request->file('logo_kapal')->storeAs('images', $fileName, 'public');
        $data['logo_kapal'] ='/storage/'.$path;
        Ship::create($data);
        return redirect()->back()->with('success','Data Kapal Telah Ditambahkan');
    }
    public function add_arrival(Request $request)
    {

        Arrival::create([
            'id_ship' => $request['nama_kapal'],
            'schedule' => $request['schedule'],
            'jam' => $request['jam'],
            'from' => $request['from'],
            'destination' => $request['destination'],
            'status' => 'Estimasi'
        ]);
        return redirect()->back()->with('success','Data Telah Ditambahkan');
    }

    public function edit_arrival(Request $request, $id)
    {

        Arrival::findOrFail($id)->update([
            'schedule' => $request['schedule'],
            'jam' => $request['jam'],
            'status' => $request['status']
        ]);
        return redirect()->back()->with('success','Data Telah Diupdate');
    }

    public function process_arrival(Request $request, $id)
    {

        Arrival::findOrFail($id)->update([
            'status' => 'Bersandar'
        ]);
        return redirect()->back()->with('success','Kapal Sedang Di Proses');
    }

    public function finish_arrival(Request $request, $id)
    {

        Arrival::findOrFail($id)->update([
            'status' => 'Selesai'
        ]);
        return redirect()->back()->with('success','Kapal Telah Selesai Di Proses');
    }

    public function destroy($id){
        Arrival::findOrFail($id)->delete();
        return redirect()->back()->with('success','Data Berhasil Dihapus');
    } 
}

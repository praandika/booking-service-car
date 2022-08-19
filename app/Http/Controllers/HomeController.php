<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /** PROSES BOOKING */
    public function booking($jemput = null){
        return view('member.booking', compact('jemput'));
    }

    public function tanggal(Request $request, $service = null){
        if ($service == null) {
            $layanan = $request->layanan;
        } else {
            $layanan = ($service == 'service-mesin') ? 'Service Mesin' : 'Body Repair' ;
        }
        $jemput = $request->jemput;
        return view('member.tanggal', compact('layanan','jemput'));
    }

    public function waktu(Request $request){
        $layanan = $request->layanan;
        $tanggal = $request->tanggal;
        $jemput = $request->jemput;
        return view('member.waktu', compact('tanggal','layanan','jemput'));
    }

    public function form(Request $request){
        $layanan = $request->layanan;
        $tanggal = $request->tanggal;
        $waktu = $request->waktu;
        $jemput = $request->jemput;

        // dd($layanan, $tanggal, $waktu, $jemput);
        
        return view('member.form', compact('tanggal','layanan','waktu','jemput'));
    }

    public function storeBooking(Request $request){
        if ($request->facility == 'jemput') {
            $estimation = $request->estimation + 50000;
        } else {
            $estimation = $request->estimation;
        }
        
        $data = New Booking;
        $data->user_id = $request->user_id;
        $data->frame_no = $request->frame_no;
        $data->service = $request->service;
        $data->plate_no = $request->plate_no;
        $data->complaint = $request->complaint;
        $data->brand = $request->brand;
        $data->type = $request->type;
        $data->color = $request->color;
        $data->year = $request->year;
        $data->facility = $request->facility;
        $data->transmition = $request->transmition;
        $data->date = $request->date;
        $data->time = $request->time;
        $data->estimation = $estimation;
        $data->status = 'tertunda';
        $data->reschedule = '0';
        $data->created_at = Carbon::now('GMT+8')->format('Y-m-d H:i:s');
        $data->save();

        User::where('id',$request->user_id)
        ->update([
            'phone' => $request->phone,
        ]);

        toast('Booking sukses','success');
        return redirect()->route('member');
    }
    /** END PROSES BOOKING */
}

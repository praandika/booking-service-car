<?php

namespace App\Http\Controllers;

use App\Models\Booking;
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
    public function booking(){
        return view('member.booking');
    }

    public function tanggal(Request $request){
        $layanan = $request->layanan;
        return view('member.tanggal', compact('layanan'));
    }

    public function waktu(Request $request){
        $layanan = $request->layanan;
        $tanggal = $request->tanggal;
        return view('member.waktu', compact('tanggal','layanan'));
    }

    public function form(Request $request){
        $layanan = $request->layanan;
        $tanggal = $request->tanggal;
        $waktu = $request->waktu;
        return view('member.form', compact('tanggal','layanan','waktu'));
    }

    public function storeBooking(Request $request){
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
        $data->estimation = $request->estimation;
        $data->status = 'tertunda';
        $data->reschedule = '0';
        $data->created_at = Carbon::now('GMT+8')->format('Y-m-d H:i:s');
        $data->save();

        return redirect()->route('member');
    }
    /** END PROSES BOOKING */
}

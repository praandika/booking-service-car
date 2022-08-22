<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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

    public function paket(Request $request, $service = null){
        if ($service == null) {
            $layanan = $request->layanan;
        } else {
            $layanan = ($service == 'service-mesin') ? 'Service Mesin' : 'Body Repair' ;
        }
        $jemput = $request->jemput;
        return view('member.service', compact('layanan','jemput'));
    }

    public function tanggal(Request $request){
        $layanan = $request->layanan;
        $jemput = $request->jemput;
        $paket = $request->paket;
        return view('member.tanggal', compact('layanan','jemput','paket'));
    }

    public function waktu(Request $request){
        $layanan = $request->layanan;
        $tanggal = $request->tanggal;
        $jemput = $request->jemput;
        $paket = $request->paket;
        return view('member.waktu', compact('tanggal','layanan','jemput','paket'));
    }

    public function form(Request $request){
        $layanan = $request->layanan;
        $tanggal = $request->tanggal;
        $waktu = $request->waktu;
        $jemput = $request->jemput;
        $phone = Auth::user()->phone;
        $paket = $request->paket;

        if ($layanan == "Service Mesin") {
            if ($paket == "Service Berkala A") {
                $estimation = 450000;
            } elseif($paket == "Service Berkala B") {
                $estimation = 650000;
            } elseif($paket == "Service Berkala C") {
                $estimation = 850000;
            } else {
                $estimation = 1150000;
            }
            
        } else {
            if ($paket == "Full Body Painting") {
                $estimation = 7500000;
            } elseif($paket == "Cat 1 Panel") {
                $estimation = 700000;
            } elseif($paket == "Cat 1 Panel") {
                $estimation = 1400000;
            } else {
                $estimation = 2100000;
            }
        }

        // dd($layanan, $tanggal, $waktu, $jemput);
        
        return view('member.form', compact('tanggal','layanan','waktu','jemput','phone','estimation','paket'));
    }

    public function storeBooking(Request $request){
        if ($request->facility == 'jemput') {
            $estimation = $request->estimation + 50000;
        } else {
            $estimation = $request->estimation;
        }
        
        $data = New Booking;
        $data->user_id = $request->user_id;
        $data->frame_no = strtoupper($request->frame_no);
        $data->service = $request->service;
        $data->package = $request->paket;
        $data->plate_no = strtoupper($request->plate_no);
        $data->complaint = $request->complaint;
        $data->brand = ucwords($request->brand);
        $data->type = ucwords($request->type);
        $data->color = ucwords($request->color);
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

        $cek = User::where('id',$request->user_id)->select('phone')->get();
        foreach ($cek as $o) {
            $cekPhone = $o->phone;
        }
        // dd($cekPhone);
        if ($cekPhone == null) {
            User::where('id',$request->user_id)
            ->update([
                'phone' => '62'.ltrim($request->phone, '0'),
            ]);
        }

        toast('Booking sukses','success');
        return redirect()->route('member');
    }
    /** END PROSES BOOKING */
}

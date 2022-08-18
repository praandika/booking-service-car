<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function member(){
        $date = Carbon::now('GMT+8');
        $serviceCount = Booking::where([
            ['user_id', Auth::user()->id],
            ['status','!=','selesai'],
        ])
        ->count();

        $estimasiBiaya = Booking::where([
            ['user_id', Auth::user()->id],
            ['status','!=','selesai'],
        ])
        ->sum('estimation');

        $reschedule = Booking::where([
            ['user_id', Auth::user()->id],
            ['status','!=','selesai'],
            ['reschedule','1'],
        ])
        ->count();

        $tertunda = Booking::where([
            ['user_id', Auth::user()->id],
            ['status','=','tertunda'],
        ])
        ->count();

        $dikerjakan = Booking::where([
            ['user_id', Auth::user()->id],
            ['status','=','dikerjakan'],
        ])
        ->count();

        $selesai = Booking::where([
            ['user_id', Auth::user()->id],
            ['status','=','selesai'],
        ])
        ->count();

        $data = Booking::where([
            ['user_id', Auth::user()->id],
            ['status','!=','selesai'],
        ])
        ->orderBy('date','desc')
        ->get();
        return view('member.index', compact('date','data','serviceCount','estimasiBiaya','reschedule','tertunda','dikerjakan','selesai'));
    }

    public function memberBookingList(){
        $date = Carbon::now('GMT+8');
        $data = Booking::where('user_id', Auth::user()->id)
        ->orderBy('date','desc')
        ->get();
        return view('member.booking-list', compact('date','data'));
    }

    public function memberHistory(){
        $date = Carbon::now('GMT+8');
        $data = Booking::where([
            ['user_id', Auth::user()->id],
            ['status','selesai'],
        ])
        ->orderBy('date','desc')
        ->get();
        return view('member.history', compact('date','data'));
    }

    public function reschedule($id){
        $date = Carbon::now('GMT+8');
        $data = Booking::find($id)->first();
        return view('member.reschedule', compact('data','date'));
    }

    public function updateBooking(Request $request, Booking $booking){

        toast('Jadwal Ulang sukses','success');
        return redirect()->route('member');
    }
}

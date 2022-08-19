<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Employee;
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

        $data = Booking::where([
            ['user_id', Auth::user()->id],
            ['status','!=','selesai'],
        ])
        ->orderBy('date','desc')
        ->get();
        return view('member.index', compact('date','data','serviceCount','estimasiBiaya','reschedule'));
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
        $data = Booking::where('id',$id)->get();
        // dd($data);
        return view('member.reschedule', compact('data','date'));
    }

    public function updateBooking(Request $request, $id){
        Booking::where('id', $id)
        ->update([
            'date' => $request->date,
            'time' => $request->time,
            'reschedule' => '1',
        ]);
        toast('Jadwal Ulang sukses','success');
        if (Auth::user()->access = 'customer') {
            return redirect()->route('member');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    /** Admin */
    public function dashboard(){
        $date = Carbon::now('GMT+8');
        $now = Carbon::now('GMT+8')->format('Y-m-d');

        $data = Booking::where([
            ['status','!=','selesai'],
            ['date',$now],
        ])
        ->orderBy('date','desc')
        ->get();

        $serviceCount = Booking::where([
            ['status','!=','selesai'],
        ])
        ->count();

        $pelanggan = Booking::where([
            ['status','!=','selesai'],
            ['date',$now],
        ])
        ->count();

        $svcMesin = Booking::where([
            ['status','!=','selesai'],
            ['service','Service Mesin'],
        ])
        ->count();

        $bodyRepair = Booking::where([
            ['status','!=','selesai'],
            ['service','Body Repair'],
        ])
        ->count();

        $reschedule = Booking::where([
            ['status','!=','selesai'],
            ['reschedule','1'],
        ])
        ->count();

        $tertunda = Booking::where([
            ['status','=','tertunda'],
        ])
        ->count();

        $dikerjakan = Booking::where([
            ['status','=','dikerjakan'],
        ])
        ->count();

        $selesai = Booking::where([
            ['status','=','selesai'],
        ])
        ->count();

        return view('admin.index', compact('date','data','serviceCount','pelanggan','svcMesin','bodyRepair','reschedule','tertunda','dikerjakan','selesai'));
    }

    public function workOrderForm($id){
        $date = Carbon::now('GMT+8');
        $data = Booking::where('id',$id)->get();
        $emp = Employee::orderBy('name','asc')->get();

        return view('admin.work-order-form', compact('date','data','emp'));
    }
    
    public function workOrder(){
        $date = Carbon::now('GMT+8');
        $data = Booking::where([
            ['status','dikerjakan'],
        ])
        ->orderBy('date','desc')
        ->get();

        return view('admin.work-order', compact('date','data'));
    }
    /** END Admin */
}

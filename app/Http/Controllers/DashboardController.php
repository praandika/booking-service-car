<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Employee;
use App\Models\WorkOrder;
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
            'updated_at' => Carbon::now('GMT+8')->format('Y-m-d H:i:s'),
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

        $bookingAll = Booking::where('status','!=','selesai')
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

        return view('admin.index', compact('date','data','serviceCount','pelanggan','svcMesin','bodyRepair','reschedule','tertunda','dikerjakan','selesai','bookingAll'));
    }

    public function bookingList(){
        $date = Carbon::now('GMT+8');
        $data = Booking::where('status','tertunda')
        ->orderBy('date','desc')->get();

        return view('admin.booking-list', compact('date','data'));
    }

    public function workOrderForm($id){
        $date = Carbon::now('GMT+8');
        $data = Booking::where('id',$id)->get();
        $emp = Employee::where('position','Teknisi')
        ->orderBy('name','asc')->get();

        return view('admin.work-order-form', compact('date','data','emp'));
    }

    public function workOrderStore(Request $request, $id){
        Booking::where('id',$id)
        ->update([
            'frame_no' => strtoupper($request->frame_no),
            'status' => 'dikerjakan',
            'updated_at' => Carbon::now('GMT+8')->format('Y-m-d H:i:s'),
        ]);

        $wo = New WorkOrder;
        $wo->booking_id = $id;
        $wo->employee_id = $request->employee;
        $wo->created_at = Carbon::now('GMT+8')->format('Y-m-d H:i:s');
        $wo->save();

        toast('Yes!, Teknisi sedang mengerjakan service-nya','success');
        return redirect()->route('admin.work-order');
    }
    
    public function workOrder(){
        $date = Carbon::now('GMT+8');
        $data = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
        ->join('employees','work_orders.employee_id','=','employees.id')
        ->where('bookings.status','dikerjakan')
        ->get();

        return view('admin.work-order', compact('date','data'));
    }

    public function workOrderFinishing($id){
        Booking::where('id',$id)
        ->update([
            'status' => 'selesai',
            'updated_at' => Carbon::now('GMT+8')->format('Y-m-d H:i:s'),
        ]);

        toast('Yay! Perngerjaan Selesai', 'success');
        return redirect()->route('admin.work-finished');
    }

    public function workFinished(){
        $date = Carbon::now('GMT+8');
        $data = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
        ->join('employees','work_orders.employee_id','=','employees.id')
        ->where('bookings.status','selesai')
        ->get();

        return view('admin.work-finished', compact('date','data'));
    }

    public function employee(){
        $date = Carbon::now('GMT+8');
        $data = Employee::orderBy('name','asc')->get();
        return view('admin.employee', compact('date','data'));
    }

    public function employeeStore(Request $request){
        $data = New Employee;
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->position = $request->position;
        $data->save();

        toast('Yay! berhasil tambah karyawan baru', 'success');
        return redirect()->route('admin.employee');
    }

    public function employeeEdit($id){
        $date = Carbon::now('GMT+8');
        $data = Employee::where('id',$id)->get();
        
        return view('admin.employee-edit', compact('data','date'));
    }

    public function employeeUpdate(Request $request, $id){
        Employee::where('id',$id)
        ->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'position' => $request->position,
            'updated_at' => Carbon::now('GMT+8')->format('Y-m-d H:i:s')
        ]);

        toast('Yay! berhasil ubah karyawan baru', 'success');
        return redirect()->route('admin.employee');
    }

    public function showBookingAll(){
        $title = 'Daftar Booking';
        $date = Carbon::now('GMT+8');
        $data = Booking::orderBy('date','asc')->get();

        return view('admin.show-booking', compact('date','data','title'));
    }

    public function showBookingService(){
        $title = 'Daftar Service Mesin';
        $date = Carbon::now('GMT+8');
        $data = Booking::where('service','Service Mesin')
        ->orderBy('date','asc')->get();

        return view('admin.show-booking', compact('date','data','title'));
    }

    public function showBookingRepair(){
        $title = 'Daftar Body Repair';
        $date = Carbon::now('GMT+8');
        $data = Booking::where('service','Body Repair')
        ->orderBy('date','asc')->get();

        return view('admin.show-booking', compact('date','data','title'));
    }
    /** END Admin */
}

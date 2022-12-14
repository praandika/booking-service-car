<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Employee;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Charts\ChartJS;

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
        $year = Carbon::now('GMT+8')->format('Y');
        $month = Carbon::now('GMT+8')->format('m');
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

        $tertunda = Booking::where('status','=','tertunda')->count();
        $dikerjakan = Booking::where('status','=','dikerjakan')->count();
        $selesai = Booking::where('status','=','selesai')->count();

        /**Chart Booking By Month */
        $jan = Booking::whereMonth('date','01')->whereYear('date',$year)->count();
        $feb = Booking::whereMonth('date','02')->whereYear('date',$year)->count();
        $mar = Booking::whereMonth('date','03')->whereYear('date',$year)->count();
        $apr = Booking::whereMonth('date','04')->whereYear('date',$year)->count();
        $may = Booking::whereMonth('date','05')->whereYear('date',$year)->count();
        $jun = Booking::whereMonth('date','06')->whereYear('date',$year)->count();
        $jul = Booking::whereMonth('date','07')->whereYear('date',$year)->count();
        $aug = Booking::whereMonth('date','08')->whereYear('date',$year)->count();
        $sep = Booking::whereMonth('date','09')->whereYear('date',$year)->count();
        $oct = Booking::whereMonth('date','10')->whereYear('date',$year)->count();
        $nov = Booking::whereMonth('date','11')->whereYear('date',$year)->count();
        $dec = Booking::whereMonth('date','12')->whereYear('date',$year)->count();

        $chartBooking = new ChartJS;
        $chartBooking->title('Grafik Booking Tahun Ini');
        $chartBooking->displayLegend(true);
        $chartBooking->labels(['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']);
        $chartBooking->dataset($year,'line',[$jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec])
        ->linetension(0.0)
        ->color("#f00a0a")
        ->backgroundcolor("transparent");

        /**Chart Booking By Package */
        $sA = Booking::whereMonth('date',$month)->whereYear('date',$year)->where('package','Service Berkala A')->count();
        $sB = Booking::whereMonth('date',$month)->whereYear('date',$year)->where('package','Service Berkala B')->count();
        $sC = Booking::whereMonth('date',$month)->whereYear('date',$year)->where('package','Service Berkala C')->count();
        $sD = Booking::whereMonth('date',$month)->whereYear('date',$year)->where('package','Service Berkala D')->count();

        $fB = Booking::whereMonth('date',$month)->whereYear('date',$year)->where('package','Full Body Painting')->count();
        $c1 = Booking::whereMonth('date',$month)->whereYear('date',$year)->where('package','Cat 1 Panel')->count();
        $c2 = Booking::whereMonth('date',$month)->whereYear('date',$year)->where('package','Cat 2 Panel')->count();
        $c3 = Booking::whereMonth('date',$month)->whereYear('date',$year)->where('package','Cat 3 Panel')->count();

        $chartPaket = new ChartJS;
        $chartPaket->title('Grafik Paket Bulan Ini');
        $chartPaket->displayLegend(true);
        $chartPaket->labels(['Berkala A','Berkala B','Berkala C','Berkala D','Full Body Paint','Cat 1 Panel','Cat 2 Panel','Cat 3 Panel']);
        $chartPaket->dataset($year,'bar',[$sA, $sB, $sC, $sD, $fB, $c1, $c2, $c3])
        ->color(["#eb0c0f","#eb690c","#ebc20c","#04cc1b","#0003b5","#fc28d9","#c202a2","#c20232"])
        ->backgroundcolor(["#eb0c0f","#eb690c","#ebc20c","#04cc1b","#0003b5","#fc28d9","#c202a2","#c20232"]);

        return view('admin.index', compact('date','data','serviceCount','pelanggan','svcMesin','bodyRepair','reschedule','tertunda','dikerjakan','selesai','bookingAll','chartBooking','chartPaket'));
    }

    public function bookingList(){
        $date = Carbon::now('GMT+8');
        $data = Booking::where('status','tertunda')
        ->orderBy('date','desc')->get();

        return view('admin.booking-list', compact('date','data'));
    }

    public function workOrderForm($id){
        $date = Carbon::now('GMT+8');
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $data = Booking::where('id',$id)->get();
        $empName = [];
        foreach ($data as $o) {
            $time = $o->time;
        }
        $cekEmp = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
        ->join('employees','work_orders.employee_id','=','employees.id')
        ->where([
            ['bookings.time',$time],
            ['bookings.date',$today],
        ])
        ->pluck('employees.name');

        for ($i=0; $i < count($cekEmp); $i++) {
            array_push($empName, $cekEmp[$i]);
        }
        
        $emp = Employee::where('position','Teknisi')
        ->whereNotIn('name', $empName)
        ->orderBy('name','asc')
        ->get();
        
        $countEmp = Employee::where('position','Teknisi')
        ->count();

        return view('admin.work-order-form', compact('date','data','emp','countEmp'));
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

        toast('Yay! Pengerjaan Selesai', 'success');
        return redirect()->route('admin.work-finished');
    }

    public function workFinished(){
        $date = Carbon::now('GMT+8');
        $data = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
        ->join('employees','work_orders.employee_id','=','employees.id')
        ->where('bookings.status','selesai')
        ->orderBy('bookings.date','desc')
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

    public function employeeStoreAtWoPage(Request $request){
        $data = New Employee;
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->position = $request->position;
        $data->save();

        toast('Yay! berhasil tambah karyawan baru', 'success');
        return redirect()->back();
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
        $countTertunda = Booking::orderBy('date','asc')->where('status','tertunda')->count();
        $countDikerjakan = Booking::orderBy('date','asc')->where('status','dikerjakan')->count();
        $countSelesai = Booking::orderBy('date','asc')->where('status','selesai')->count();
        $title = 'Daftar Booking';
        $date = Carbon::now('GMT+8');
        $data = Booking::orderBy('date','asc')->get();

        return view('admin.show-booking', compact('date','data','title','countTertunda','countDikerjakan','countSelesai'));
    }

    public function showBookingService(){
        $countTertunda = Booking::orderBy('date','asc')->where([
            ['service','Service Mesin'],
            ['status','tertunda'],
        ])->count();
        
        $countDikerjakan = Booking::orderBy('date','asc')->where([
            ['service','Service Mesin'],
            ['status','dikerjakan'],
        ])->count();
        
        $countSelesai = Booking::orderBy('date','asc')->where([
            ['service','Service Mesin'],
            ['status','selesai'],
        ])->count();
        
        $title = 'Daftar Service Mesin';
        $date = Carbon::now('GMT+8');
        $data = Booking::where('service','Service Mesin')
        ->orderBy('date','asc')->get();

        return view('admin.show-booking', compact('date','data','title','countTertunda','countDikerjakan','countSelesai'));
    }

    public function showBookingRepair(){
        $countTertunda = Booking::orderBy('date','asc')->where([
            ['service','Body Repair'],
            ['status','tertunda'],
        ])->count();
        
        $countDikerjakan = Booking::orderBy('date','asc')->where([
            ['service','Body Repair'],
            ['status','dikerjakan'],
        ])->count();
        
        $countSelesai = Booking::orderBy('date','asc')->where([
            ['service','Body Repair'],
            ['status','selesai'],
        ])->count();
        
        $title = 'Daftar Body Repair';
        $date = Carbon::now('GMT+8');
        $data = Booking::where('service','Body Repair')
        ->orderBy('date','asc')->get();

        return view('admin.show-booking', compact('date','data','title','countTertunda','countDikerjakan','countSelesai'));
    }

    public function showReport($type){
        $date = Carbon::now('GMT+8');
        $report = 'Laporan '.ucwords($type);
        if ($type == 'teknisi') {
            $employee = Employee::orderBy('name','asc')->get();
        } else {
            $employee = 'no employee';
        }
        
        return view('admin.report', compact('date','report','type','employee'));
    }

    public function reportSearch(Request $request, $type){
        $report = 'Laporan '.ucwords($type);
        $start = $request->start;
        $end = $request->end;
        $status = $request->status;
        $service = $request->service;
        $date = Carbon::now('GMT+8');
        if (($request->status == "semua" ) && ($request->service == "semua")) {
            if ($type == 'teknisi') {
                $data = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
                ->join('employees','work_orders.employee_id','=','employees.id')
                ->whereBetween('bookings.date',[$request->start, $request->end])
                ->get();
            } else {
                $data = Booking::whereBetween('date',[$request->start, $request->end])->get();
            }
            $status = 'semua';
            $service = 'semua';
        } elseif($request->status == "semua") {
            if ($type == 'teknisi') {
                $data = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
                ->join('employees','work_orders.employee_id','=','employees.id')
                ->whereBetween('bookings.date',[$request->start, $request->end])
                ->get();
            } else {
                $data = Booking::whereBetween('date',[$request->start, $request->end])
                ->where('service',$request->service)
                ->get();
            }
            $status = 'semua';
        } elseif($request->service == "semua") {
            if ($type == 'teknisi') {
                $data = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
                ->join('employees','work_orders.employee_id','=','employees.id')
                ->whereBetween('bookings.date',[$request->start, $request->end])
                ->get();
            } else {
                $data = Booking::whereBetween('date',[$request->start, $request->end])
                ->where('status',$request->status)
                ->get();
            }
            $service = 'semua';
        } else {
            if ($type == 'teknisi') {
                $data = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
                ->join('employees','work_orders.employee_id','=','employees.id')
                ->whereBetween('bookings.date',[$request->start, $request->end])
                ->get();
            } else {
                $data = Booking::whereBetween('date',[$request->start, $request->end])
                ->where([
                    ['status',$request->status],
                    ['service',$request->service],
                ])
                ->get();
            }
        }
        
        return view('admin.report-search', compact('date','data','start','end','status','service','report','type'));
    }

    public function changeEstimation(Request $request, $id){
        Booking::where('id',$id)
        ->update([
            'estimation' => $request->estimation,
        ]);

        toast('Yay! berhasil ubah estimasi', 'success');
        return redirect()->route('admin.work-order');
    }
    /** END Admin */
}

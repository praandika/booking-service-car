<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\WorkOrder;
use GuzzleHttp\Psr7\Request;
use PDF;
use Illuminate\Support\Carbon;

class PDFController extends Controller
{
    public function printNota($id){
        $data = Booking::where('id',$id)->get();
        $date = Carbon::now('GMT+8')->format('Y-m-d');
        $inv = Carbon::now('GMT+8')->format('Y');
        $ref = 'NOTA-'.$inv.'/'.rand();
        $pdf = PDF::loadView('print.nota', compact('data','ref','date'));

        return $pdf->download('nota_'.$ref.'.pdf');
    }

    public function printReport($start, $end, $service, $status, $type){
        $date = Carbon::now('GMT+8')->format('Y-m-d H:i:s');
        
        if (($status == "semua" ) && ($service == "semua")) {
            $data = Booking::whereBetween('date',[$start, $end])->get();
            $estimasiBiaya = Booking::whereBetween('date',[$start, $end])->sum('estimation');

        } elseif($status == "semua") {
            $data = Booking::whereBetween('date',[$start, $end])
            ->where('service',$service)
            ->get();
            $estimasiBiaya = Booking::whereBetween('date',[$start, $end])
            ->where('service',$service)
            ->sum('estimation');
            
        } elseif($service == "semua") {
            $data = Booking::whereBetween('date',[$start, $end])
            ->where('status',$status)
            ->get();
            $estimasiBiaya = Booking::whereBetween('date',[$start, $end])
            ->where('status',$status)
            ->sum('estimation');

        } else {
            $data = Booking::whereBetween('date',[$start, $end])
            ->where([
                ['status',$status],
                ['service',$service],
            ])
            ->get();
            $estimasiBiaya = Booking::whereBetween('date',[$start, $end])
            ->where([
                ['status',$status],
                ['service',$service],
            ])
            ->sum('estimation');
        }

        if ($type == 'booking') {
            $pdf = PDF::loadView('print.report', compact('data','date','estimasiBiaya','start','end','status','service'));

            if (($status == "" ) && ($service == "")) {
                return $pdf->download('laporan_booking'.$start.'-'.$end.'.pdf');
            } elseif($status == "") {
                return $pdf->download('laporan_booking'.$start.'-'.$end.'_'.$service.'.pdf');
            } elseif($service == "") {
                return $pdf->download('laporan_booking'.$start.'-'.$end.'_'.$status.'.pdf');
            } else {
                return $pdf->download('laporan_booking'.$start.'-'.$end.'_'.$service.'_'.$status.'.pdf');
            }

        } elseif($type == 'pendapatan') {
            $pdf = PDF::loadView('print.report-pendapatan', compact('data','date','estimasiBiaya','start','end','status','service'));

            if (($status == "" ) && ($service == "")) {
                return $pdf->download('laporan_pendapatan'.$start.'-'.$end.'.pdf');
            } elseif($status == "") {
                return $pdf->download('laporan_pendapatan'.$start.'-'.$end.'_'.$service.'.pdf');
            } elseif($service == "") {
                return $pdf->download('laporan_pendapatan'.$start.'-'.$end.'_'.$status.'.pdf');
            } else {
                return $pdf->download('laporan_pendapatan'.$start.'-'.$end.'_'.$service.'_'.$status.'.pdf');
            }
        }
        
        
    }

    public function printReportTeknisi($start, $end, $service, $status, $teknisi){
        $date = Carbon::now('GMT+8')->format('Y-m-d H:i:s');
        
        if (($status == "semua" ) && ($service == "semua")) {
            $data = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
            ->join('employees','work_orders.employee_id','=','employees.id')
            ->whereBetween('bookings.date',[$start, $end])
            ->where('employees.name',$teknisi)
            ->get();

            $estimasiBiaya = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
            ->join('employees','work_orders.employee_id','=','employees.id')
            ->whereBetween('bookings.date',[$start, $end])
            ->where('employees.name',$teknisi)
            ->sum('bookings.estimation');

        } elseif($status == "semua") {
            $data = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
            ->join('employees','work_orders.employee_id','=','employees.id')
            ->whereBetween('bookings.date',[$start, $end])
            ->where([
                ['employees.name',$teknisi],
                ['service',$service],
            ])
            ->get();

            $estimasiBiaya = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
            ->join('employees','work_orders.employee_id','=','employees.id')
            ->whereBetween('bookings.date',[$start, $end])
            ->where([
                ['employees.name',$teknisi],
                ['service',$service],
            ])
            ->sum('bookings.estimation');
            
        } elseif($service == "semua") {
            $data = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
            ->join('employees','work_orders.employee_id','=','employees.id')
            ->whereBetween('bookings.date',[$start, $end])
            ->where([
                ['employees.name',$teknisi],
                ['status',$status],
            ])
            ->get();

            $estimasiBiaya = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
            ->join('employees','work_orders.employee_id','=','employees.id')
            ->whereBetween('bookings.date',[$start, $end])
            ->where([
                ['employees.name',$teknisi],
                ['status',$status],
            ])
            ->sum('bookings.estimation');

        } else {
            $data = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
            ->join('employees','work_orders.employee_id','=','employees.id')
            ->whereBetween('bookings.date',[$start, $end])
            ->where([
                ['employees.name',$teknisi],
                ['status',$status],
                ['service',$service],
            ])
            ->get();

            $estimasiBiaya =  WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
            ->join('employees','work_orders.employee_id','=','employees.id')
            ->whereBetween('bookings.date',[$start, $end])
            ->where([
                ['employees.name',$teknisi],
                ['status',$status],
                ['service',$service],
            ])
            ->sum('bookings.estimation');
        }

        $pdf = PDF::loadView('print.report-teknisi', compact('data','date','start','end','status','service','estimasiBiaya','teknisi'));

        if (($status == "" ) && ($service == "")) {
            return $pdf->download('laporan_teknisi_'.$teknisi.'-'.$start.'-'.$end.'.pdf');
        } elseif($status == "") {
            return $pdf->download('laporan_teknisi_'.$teknisi.'-'.$start.'-'.$end.'_'.$service.'.pdf');
        } elseif($service == "") {
            return $pdf->download('laporan_teknisi_'.$teknisi.'-'.$start.'-'.$end.'_'.$status.'.pdf');
        } else {
            return $pdf->download('laporan_teknisi_'.$teknisi.'-'.$start.'-'.$end.'_'.$service.'_'.$status.'.pdf');
        }
    }
}

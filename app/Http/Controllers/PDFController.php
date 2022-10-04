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
            if ($type == 'teknisi') {
                $data = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
                ->join('employees','work_orders.employee_id','=','employees.id')
                ->whereBetween('bookings.date',[$start, $end])
                ->get();

                $estimasiBiaya = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
                ->join('employees','work_orders.employee_id','=','employees.id')
                ->whereBetween('bookings.date',[$start, $end])
                ->sum('bookings.estimation');
            } else {
                $data = Booking::whereBetween('date',[$start, $end])->get();
                $estimasiBiaya = Booking::whereBetween('date',[$start, $end])->sum('estimation');
            }

        } elseif($status == "semua") {
            if ($type == 'teknisi') {
                $data = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
                ->join('employees','work_orders.employee_id','=','employees.id')
                ->whereBetween('bookings.date',[$start, $end])
                ->where('service',$service)
                ->get();

                $estimasiBiaya = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
                ->join('employees','work_orders.employee_id','=','employees.id')
                ->whereBetween('bookings.date',[$start, $end])
                ->where('service',$service)
                ->sum('bookings.estimation');
            } else {
                $data = Booking::whereBetween('date',[$start, $end])
                ->where('service',$service)
                ->get();
                $estimasiBiaya = Booking::whereBetween('date',[$start, $end])
                ->where('service',$service)
                ->sum('estimation');
            }
            
        } elseif($service == "semua") {
            if ($type == 'teknisi') {
                $data = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
                ->join('employees','work_orders.employee_id','=','employees.id')
                ->whereBetween('bookings.date',[$start, $end])
                ->where('status',$status)
                ->get();

                $estimasiBiaya = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
                ->join('employees','work_orders.employee_id','=','employees.id')
                ->whereBetween('bookings.date',[$start, $end])
                ->where('status',$status)
                ->sum('bookings.estimation');
            } else {
                $data = Booking::whereBetween('date',[$start, $end])
                ->where('status',$status)
                ->get();
                $estimasiBiaya = Booking::whereBetween('date',[$start, $end])
                ->where('status',$status)
                ->sum('estimation');
            }

        } else {
            if ($type == 'teknisi') {
                $data = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
                ->join('employees','work_orders.employee_id','=','employees.id')
                ->whereBetween('bookings.date',[$start, $end])
                ->where([
                    ['status',$status],
                    ['service',$service],
                ])
                ->get();

                $estimasiBiaya =  WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
                ->join('employees','work_orders.employee_id','=','employees.id')
                ->whereBetween('bookings.date',[$start, $end])
                ->where([
                    ['status',$status],
                    ['service',$service],
                ])
                ->sum('bookings.estimation');
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
        }

        if ($type == 'booking') {
            $pdf = PDF::loadView('print.report', compact('data','date','estimasiBiaya','start','end','status','service'));

            if (($status == "" ) && ($service == "")) {
                return $pdf->download('laporan_booking_'.$start.'-'.$end.'.pdf');
            } elseif($status == "") {
                return $pdf->download('laporan_booking_'.$start.'-'.$end.'_'.$service.'.pdf');
            } elseif($service == "") {
                return $pdf->download('laporan_booking_'.$start.'-'.$end.'_'.$status.'.pdf');
            } else {
                return $pdf->download('laporan_booking_'.$start.'-'.$end.'_'.$service.'_'.$status.'.pdf');
            }

        } elseif($type == 'pendapatan') {
            $pdf = PDF::loadView('print.report-pendapatan', compact('data','date','estimasiBiaya','start','end','status','service'));

            if (($status == "" ) && ($service == "")) {
                return $pdf->download('laporan_pendapatan_'.$start.'-'.$end.'.pdf');
            } elseif($status == "") {
                return $pdf->download('laporan_pendapatan_'.$start.'-'.$end.'_'.$service.'.pdf');
            } elseif($service == "") {
                return $pdf->download('laporan_pendapatan_'.$start.'-'.$end.'_'.$status.'.pdf');
            } else {
                return $pdf->download('laporan_pendapatan_'.$start.'-'.$end.'_'.$service.'_'.$status.'.pdf');
            }
        } elseif($type == 'teknisi'){
            $pdf = PDF::loadView('print.report-teknisi', compact('data','date','start','end','status','service','estimasiBiaya'));

            if (($status == "" ) && ($service == "")) {
                return $pdf->download('laporan_teknisi_'.$start.'-'.$end.'.pdf');
            } elseif($status == "") {
                return $pdf->download('laporan_teknisi_'.$start.'-'.$end.'_'.$service.'.pdf');
            } elseif($service == "") {
                return $pdf->download('laporan_teknisi_'.$start.'-'.$end.'_'.$status.'.pdf');
            } else {
                return $pdf->download('laporan_teknisi_'.$start.'-'.$end.'_'.$service.'_'.$status.'.pdf');
            }
        }
    }

    public function printRank($start, $end, $service, $status, $type){
        $date = Carbon::now('GMT+8')->format('Y-m-d H:i:s');
        
        if (($status == "semua" ) && ($service == "semua")) {
            $data = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
            ->join('employees','work_orders.employee_id','=','employees.id')
            ->selectRaw('employees.name as name, (SUM(bookings.estimation) * 0.2) as reward, (SUM(bookings.estimation) * 0.2 / 170000000) * 100 as percentage')
            ->groupBy('employees.name')
            ->orderBy('reward','desc')
            ->whereBetween('bookings.date',[$start, $end])
            ->get();

        } elseif($status == "semua") {
            $data = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
            ->join('employees','work_orders.employee_id','=','employees.id')
            ->selectRaw('employees.name as name, (SUM(bookings.estimation) * 0.2) as reward, (SUM(bookings.estimation) * 0.2 / 170000000) * 100 as percentage')
            ->groupBy('employees.name')
            ->orderBy('reward','desc')
            ->whereBetween('bookings.date',[$start, $end])
            ->where('bookings.service',$service)
            ->get();

        } elseif($service == "semua") {
            $data = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
            ->join('employees','work_orders.employee_id','=','employees.id')
            ->selectRaw('employees.name as name, (SUM(bookings.estimation) * 0.2) as reward, (SUM(bookings.estimation) * 0.2 / 170000000) * 100 as percentage')
            ->groupBy('employees.name')
            ->orderBy('reward','desc')
            ->whereBetween('bookings.date',[$start, $end])
            ->where('bookings.status',$status)
            ->get();

        } else {
            $data = WorkOrder::join('bookings','work_orders.booking_id','=','bookings.id')
            ->join('employees','work_orders.employee_id','=','employees.id')
            ->selectRaw('employees.name as name, (SUM(bookings.estimation) * 0.2) as reward, (SUM(bookings.estimation) * 0.2 / 170000000) * 100 as percentage')
            ->groupBy('employees.name')
            ->orderBy('reward','desc')
            ->whereBetween('bookings.date',[$start, $end])
            ->where([
                ['bookings.service',$service],
                ['bookings.status',$status],
            ])
            ->get();
        }

        $pdf = PDF::loadView('print.report-rank', compact('data','date','start','end','status','service'));

        if (($status == "" ) && ($service == "")) {
            return $pdf->download('laporan_rank_'.$start.'-'.$end.'.pdf');
        } elseif($status == "") {
            return $pdf->download('laporan_rank_'.$start.'-'.$end.'_'.$service.'.pdf');
        } elseif($service == "") {
            return $pdf->download('laporan_rank_'.$start.'-'.$end.'_'.$status.'.pdf');
        } else {
            return $pdf->download('laporan_rank_'.$start.'-'.$end.'_'.$service.'_'.$status.'.pdf');
        }
    }
}

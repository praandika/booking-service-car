<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
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

    public function printReport($start, $end, $service, $status){
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

        $pdf = PDF::loadView('print.report', compact('data','date','estimasiBiaya','start','end','status','service'));

        if (($status == "" ) && ($service == "")) {
            return $pdf->download('laporan_'.$start.'-'.$end.'.pdf');
        } elseif($status == "") {
            return $pdf->download('laporan_'.$start.'-'.$end.'_'.$service.'.pdf');
        } elseif($service == "") {
            return $pdf->download('laporan_'.$start.'-'.$end.'_'.$status.'.pdf');
        } else {
            return $pdf->download('laporan_'.$start.'-'.$end.'_'.$service.'_'.$status.'.pdf');
        }
    }
}

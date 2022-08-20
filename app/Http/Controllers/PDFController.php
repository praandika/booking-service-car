<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
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
}

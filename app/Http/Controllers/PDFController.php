<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ComplaintReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dompdf\Options;

class PDFController extends Controller
{
    public function complaint_pdf(Request $request, $compid)
    {
        $options = new Options(); 

        // Set custom margins (in millimeters)
        $options->set('defaultPaperSize', 'legal');
        $options->set('defaultPaperOrientation', 'portrait'); // Set the orientation if needed
        $options->set('margin-top', 10); // Adjust top margin
        $options->set('margin-right', 15); // Adjust right margin
        $options->set('margin-bottom', 10); // Adjust bottom margin
        $options->set('margin-left', 15); // Adjust left margin


        $comps = ComplaintReport::select('*')
            ->where('id', $compid)
            ->get();
 
        // Create the DOMPDF instance with the custom options
        $pdf = app('dompdf.wrapper', ['options' => $options]);

        $name = Auth::guard('team')->user()->name;
        $rundate = Carbon::now();
 
        $pdf->loadView('team.team_complaintreportpdf', ['rundate'=>$rundate, 'comps'=>$comps]);
 
        return $pdf->stream('complaint_report.pdf'); 
    }
}

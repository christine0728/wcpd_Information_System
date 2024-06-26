<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ComplaintReport;
use App\Models\Offender;
use App\Models\Victim;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dompdf\Options;

class PDFController extends Controller
{
    public function complaint_pdf(Request $request, $compid)
    {
        $acc_type = Auth::guard('account')->user()->acc_type;

        $options = new Options(); 
 
        $options->set('defaultPaperSize', 'legal');
        $options->set('defaultPaperOrientation', 'portrait');  
        $options->set('margin-top', 10);  
        $options->set('margin-right', 15);  
        $options->set('margin-bottom', 10);  
        $options->set('margin-left', 15);  


        $comps = ComplaintReport::join('accounts', 'accounts.id', '=', 'complaint_reports.complaint_report_author')
            ->select('*')
            ->where('complaint_reports.id', $compid)
            ->get();

        $vics = Victim::where('comp_report_id', '=', $compid)->get();
        $offs = Offender::where('comp_report_id', '=', $compid)->get();
  
        $pdf = app('dompdf.wrapper', ['options' => $options]);

        $name = Auth::guard('account')->user()->firstname;
        $rundate = Carbon::now();
 
        if ($acc_type == 'investigator'){
            $pdf->loadView('investigator.investigator_complaintreportpdf', ['rundate'=>$rundate, 'comps'=>$comps, 'vics'=>$vics, 'offs'=>$offs]);
 
            return $pdf->stream('complaint_report.pdf'); 
        }

        elseif ($acc_type == 'superadmin'){
            $pdf->loadView('superadmin.superadmin_complaintreportpdf', ['rundate'=>$rundate, 'comps'=>$comps, 'vics'=>$vics, 'offs'=>$offs]);
 
            return $pdf->stream('complaint_report.pdf'); 
        }
        
    }
}

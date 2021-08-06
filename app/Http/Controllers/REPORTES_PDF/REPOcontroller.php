<?php

namespace App\Http\Controllers\REPORTES_PDF;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use PDOException;

class REPOcontroller extends Controller
{
    protected function createEventReport(Request $request)
    {
        try {
            $data = $request->all();
            dd($data);
            $reporteid= $data['code'];

            $data = [
                'title' => 'Welcome to ItSolutionStuff.com',
                'date' => date('m/d/Y')
            ];

            $pdf = PDF::loadView('pdf.events_report', $data);

            return $pdf->stream('evento.pdf');
        } catch (Exception $e) {
            return dd($e);
        }


    }

    protected function createPostReport(Request $request)
    {

    }

    protected function createAnimalReport(Request $request)
    {

    }
}

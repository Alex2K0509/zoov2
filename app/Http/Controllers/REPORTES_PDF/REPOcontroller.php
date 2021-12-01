<?php

namespace App\Http\Controllers\REPORTES_PDF;

use App\Http\Controllers\Controller;
use App\Models\ANIMALES\ANIMales;
use App\Models\CATALOGOS\CATEventos;
use App\Models\PUBLICACIONES\PUBlicaciones;
use Illuminate\Http\Request;
use PDF;
use PDOException;
use Hashids\Hashids;
use Illuminate\Support\Facades\Response;

class REPOcontroller extends Controller
{
    protected function createEventReport(Request $request)
    {
        try {
            $hash = new Hashids('', 10);
            $data = $request->all();
            $reporteid = $hash->decode($data['code']);
            //dd($reporteid[0]);
            #buscando el evento por el id
            $Evento = CATEventos::find($reporteid[0]);
            #dd($Evento);

            $pdf = app('dompdf.wrapper')->setPaper('L', 'portrait')->loadView('pdf.events_report', [
                'Evento' => $Evento
            ]);
            $content = base64_encode($pdf->download()->getOriginalContent());

            //dd(base64_encode($content));

            return response()->json([
                "pdf" => 'data:application/pdf;base64,' . $content

            ]);
            return true;
        } catch (Exception $e) {
            return dd($e);
        }


    }

    protected function createPostReport(Request $request)
    {
        try {
            $hash = new Hashids('', 10);
            $data = $request->all();
            $postid = $hash->decode($data['code']);

            $Post = PUBlicaciones::find($postid[0]);


            $pdf = app('dompdf.wrapper')->setPaper('L', 'portrait')->loadView('pdf.posts_report', [
                'Post' => $Post
            ]);
            $content = base64_encode($pdf->download()->getOriginalContent());


            return response()->json([
                "pdf" => 'data:application/pdf;base64,' . $content

            ]);
            return true;
        } catch (Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $e->getMessage()
                ]
            );
        }
    }

    protected function createAnimalReport(Request $request)
    {
        try {
            $hash = new Hashids('', 10);
            $data = $request->all();
            $anid = $hash->decode($data['code']);

            $Animal = ANIMales::find($anid[0]);


            $pdf = app('dompdf.wrapper')->setPaper('L', 'portrait')->loadView('pdf.animals_report', [
                'Animal' => $Animal
            ]);
            $content = base64_encode($pdf->download()->getOriginalContent());


            return response()->json([
                "pdf" => 'data:application/pdf;base64,' . $content

            ]);
            return true;
        } catch (Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $e->getMessage()
                ]
            );
        }
    }
}

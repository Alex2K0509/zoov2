<?php


namespace App\Http\Controllers\Records;
use App\Http\Controllers\Controller;

use App\Models\ANIMALES\ANIMales;
use App\Models\CATALOGOS\CATEventos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DataTables;
use Hashids\Hashids;

class RecordsController extends Controller
{
protected function tableeventos(Request $request){
$alleventos = CATEventos::getEventos();
    $hash = new Hashids('', 10);
    if ($request->ajax()) {
        return Datatables::of($alleventos)
            ->addIndexColumn()
            ->addColumn('eventonombre', function ($data) {
                $desc = $data->getEveNombre();
                $btn = '<div data-toggle="tooltip" data-placement="left" title="' . $desc . '">"' . $desc . '"</div>';
                return $btn;
            })->addColumn('eventodescrip', function ($data) {
                $desc = $data->getEveDescripcion();
                $btn = '<div data-toggle="tooltip" data-placement="left" title="' . $desc . '">"' . $desc . '"</div>';
                return $btn;
            })
            ->addColumn('eventohoraini', function ($data) {
                $desc = $data->getEveHorarioIni();
                $btn = '<div data-toggle="tooltip" data-placement="left" title="' . $desc . '">"' . $desc . '"</div>';
                return $btn;
            })
            ->addColumn('eventohorafin', function ($data) {
                $desc = $data->getEveHorarioFin();
                $btn = '<div data-toggle="tooltip" data-placement="left" title="' . $desc . '">"' . $desc . '"</div>';
                return $btn;
            })
            ->addColumn('eventofechaini', function ($data) {
                $desc = $data->getEveFechaIni();
                $btn = '<div data-toggle="tooltip" data-placement="left" title="' . $desc . '">"' . $desc . '"</div>';
                return $btn;
            })
            ->addColumn('eventofechafin', function ($data) {
                $desc = $data->getEveFechaFin();
                $btn = '<div data-toggle="tooltip" data-placement="left" title="' . $desc . '">"' . $desc . '"</div>';
                return $btn;
            })
            ->addColumn('action', function ($data) use ($hash) {
                $eventid = $hash->encode($data->eve_eve);
                return '<div>
                            <button href="javascript:void(0)" onclick="deleteEvento(\'' . $eventid . '\')"
                            class="btn btn-outline-danger btn-sm"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Eliminar evento">
                            <i class="uil uil-trash"></i>
                            </button>

                        </div>';
            })
            ->rawColumns(['action', 'eventonombre', 'eventodescrip', 'eventohoraini','eventohorafin','eventofechaini','eventofechafin','eventoimage'])
            ->make(true);
    }
    return view('dashboard', [
        'eventos' => $alleventos,
    ]);

}

protected function editeventos(Request $request, $idevento){
    dd("hola");
}
}


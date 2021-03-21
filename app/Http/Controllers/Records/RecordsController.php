<?php


namespace App\Http\Controllers\Records;
use App\Http\Controllers\Controller;

use App\Models\ANIMALES\ANIMales;
use App\Models\CATALOGOS\CATEventos;
use App\Models\PUBLICACIONES\PUBlicaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DataTables;
use Hashids\Hashids;

class RecordsController extends Controller
{
    /**
     * @autor Alex vergara
     * @function Retorna la datatable de eventos
     * @param request
     * @return mixed
     */
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
                // onclick="editEvento(\'' . $eventid . '\')"
                $eventid = $hash->encode($data->eve_eve);
                return '<div>
                            <button href="javascript:void(0)" onclick="deleteEvento(\'' . $eventid . '\')"
                            class="btn btn-outline-danger btn-sm"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Eliminar evento">
                            <i class="fa fa-trash"></i>
                            </button>

                <button href="javascript:void(0)"
                            data-target="#modal-evento"
                            class="btn btn-outline-success btn-sm"
                            data-toggle="modal"
                            data-placement="bottom"
                            title="Editar evento">
                            <i class="far fa-edit"></i>
                            </button>
                        <button href="javascript:void(0)" onclick="notiEvento(\'' . $eventid . '\')"
                            class="btn btn-outline-warning btn-sm"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Mandar notificaciones">
                            <i class="far fa-bell"></i>
                            </button>

                        </div>';

            })
            ->rawColumns(['action', 'eventonombre', 'eventodescrip', 'eventohoraini','eventohorafin','eventofechaini','eventofechafin','eventoimage'])
            ->make(true);
    }
    return view('dashboard', compact('alleventos'));

}

protected function editeventos(Request $request, $idevento){
    dd("hola");
}
    /**
     * @autor Alex vergara
     * @function Retorna la la info de los animales para el select2
     * @param request
     * @return mixed
     */
protected function getAnimals(){
  $Animales = ANIMales::all();
    $hash       = new Hashids('', 20);
    $response = array();
    foreach ($Animales as $An){
        $response[] = array(
            "id"=>$hash->encode($An->getId()),
            "text"=>$An->getNombre()
        );
    }
    echo json_encode($response);
    exit;
}

    /**
     * @autor Alex vergara
     * @function Retorna la datatable de las publicaciones
     * @param request
     * @return mixed
     */
protected function tablepublicaciones(Request $request)
{

    $allPublicaciones = PUBlicaciones::with('animales')->get();

    $hash = new Hashids('', 10);

    if($request->ajax()){
        return Datatables::of($allPublicaciones)
            ->addIndexColumn()
            ->addColumn('animalpub', function ($data) {
                $desc = $data->animales->getNombre();
                $btn = '<div data-toggle="tooltip" data-placement="left" title="' . $desc . '">"' . $desc . '"</div>';
                return $btn;
            })
            ->addColumn('titulopub', function ($data) {
                $desc = $data->getTitle();
                $btn = '<div data-toggle="tooltip" data-placement="left" title="' . $desc . '">"' . $desc . '"</div>';
                return $btn;
            })
            ->addColumn('contenidopub', function ($data) {
                $desc = $data->getDescrip();
                $btn = '<div data-toggle="tooltip" data-placement="left" title="' . $desc . '">"' . $desc . '"</div>';
                return $btn;
            })
            ->addColumn('createdpub', function ($data) {
                $desc = $data->getCreatedAt();
                $btn = '<div data-toggle="tooltip" data-placement="left" title="' . $desc . '">"' . $desc . '"</div>';
                return $btn;
            })
            ->addColumn('action', function ($data) use ($hash) {
                $pubtid = $hash->encode($data->pub_id);
                return '<div>
                            <button href="javascript:void(0)" onclick="deleteEvento(\'' . $pubtid . '\')"
                            class="btn btn-outline-danger btn-sm"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Eliminar publicación">
                            <i class="fa fa-trash"></i>
                            </button>
                <button href="javascript:void(0)" onclick="editEvento(\'' . $pubtid . '\')"
                            class="btn btn-outline-success btn-sm"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Editar publicación">
                            <i class="far fa-edit"></i>
                            </button>
                        <button href="javascript:void(0)" onclick="notiEvento(\'' . $pubtid . '\')"
                            class="btn btn-outline-warning btn-sm"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Mandar notificaciones">
                            <i class="far fa-bell"></i>
                            </button>

                        </div>';

            })
            ->rawColumns(['animalpub', 'titulopub', 'contenidopub', 'createdpub','action'])
            ->make(true);
    }

}

protected function editPublicaciones(Request $request){
    dd("hola");
}


}


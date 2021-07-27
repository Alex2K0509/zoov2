<?php


namespace App\Models\TOKENS;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
class TOKen extends Model
{
    protected $table = 'token';
    protected $primaryKey = 'token_id';
    public $timestamps = false;
    protected $guarded = [];

    public function setId($id)
    {
        $this->setAttribute($this->primaryKey, $id);
        return $this;

    }
    public function getId()
    {
        return $this->getAttribute($this->primaryKey);
    }

    public function setToken($token)
    {
        $this->setAttribute('token', $token);
        return $this;
    }

    public function getToken()
    {
        return $this->getAttribute('token');
    }

    public static function InsertToken($data){
        #dd($data);
        try {

           DB::beginTransaction();
            $insert  = self::create([
                'token' => $data['token'],
            ]);
            DB::commit();
            $response = [
                "mensaje" => "Insercion ejecutada correctamente",
            ];
            return response()->json($response, 200);
        }catch (\Exception $exception){
            dd($exception);
            DB::rollBack();
            $response = [
                "mensaje" => "Error en la transaccion",
                "Error"=>$exception->getMessage(),
                "Linea"=>$exception->getLine(),
                "File"=>$exception->getFile()
            ];
            return response()->json($response, 400);
        }
    }

    public static function apiclima(){


        $product = Http::get('api.openweathermap.org/data/2.5/weather',
                ['id' => '3531023',
                'appid' => '878ee1891bfbdbcfff364b3a0b11db80',
                ]
        );
        $body = $product->json();
        #dd($body);
        $information = [
            "datehour"=>$fecha=Carbon::now()->toDateTimeString(),
            "temp"=>$body['main']['temp'] - 273.15,
            "humedad"=> $body['main']['humidity'],
            "velocidadViento"=>$body['wind']['speed'],
            "temperatura_min"=>$body['main']['temp_min'] - 273.15,
            "temperatura_max"=>$body['main']['temp_max'] - 273.15
        ];

        return view('welcome', ['information' => $information]);

    }
}

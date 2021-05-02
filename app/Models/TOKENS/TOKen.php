<?php


namespace App\Models\TOKENS;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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

}
